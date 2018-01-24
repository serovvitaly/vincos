<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Symfony\Component\DomCrawler\Crawler;

class Import extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'import';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $json = file_get_contents(base_path() . '/pages.json');
        $json = json_decode($json);
        $index = 120;
        $exts = ['html', ''];
        foreach ($json as $row) {

            if ($row[1] !== 'text/html') continue;
            if (!in_array(pathinfo($row[0], PATHINFO_EXTENSION), $exts)) continue;

            $url = 'https://web.archive.org/web/' . $row[3] . '/' . $row[0];

            echo $url, PHP_EOL;

            try {
                $content = file_get_contents($url);
            } catch (\Exception $e) {
                echo $e->getMessage(), PHP_EOL;
                sleep(5);
                continue;
            }


            $crawler = new Crawler($content);

            $contentElement = $crawler->filter('#content');

            if (!$contentElement->count()) {
                $content = 'EMPTY';
            } else {
                $content = $contentElement->html();
            }

            $title = $crawler->filter('head > title');
            $title = $title->count() ? $title->text() : '';

            $metaTitle = $crawler->filterXPath('//head/meta[@name="title"]');
            $metaTitle = $metaTitle->count() ? $metaTitle->attr('content') : '';

            $metaDescription = $crawler->filterXPath('//head/meta[@name="description"]');
            $metaDescription = $metaDescription->count() ? $metaDescription->attr('content') : '';

            $url = trim($row[0], '"');
            $url = parse_url($url, PHP_URL_PATH);

            $page = \DB::table('pages')->whereIn('url', [$url, $url . '/'])->first();

            if ($page) {
                \DB::table('pages')->where('id', $page->id)->update([
                    //'content' => $content,
                    'title' => $title,
                    'meta_title' => $metaTitle,
                    'meta_description' => $metaDescription,
                ]);
            } else {
                \DB::table('pages')->insert([
                    'id' => $index,
                    'url' => $url,
                    'content' => $content,
                    'title' => $title,
                    'meta_title' => $metaTitle,
                    'meta_description' => $metaDescription,
                ]);
                $index++;
            }
        }
    }
}
