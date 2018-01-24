<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/sitemap.xml', function () use ($router) {

    $documents = app('db')->table('posts')->get();
    $xml = new \DOMDocument('1.0', 'UTF-8');
    $urlSet = $xml->createElement('urlset');
    $urlSet->setAttribute('xmlns', 'http://www.sitemaps.org/schemas/sitemap/0.9');
    foreach ($documents as $document) {
        $pubDate = new \DateTime();
        $loc = 'http://vincos.ru/' . $document->url . '/&amp;from=sm';
        $url = $xml->createElement('url');
        $url->appendChild($xml->createElement('loc', $loc));
        $url->appendChild($xml->createElement('lastmod', $pubDate->format('Y-m-d')));
        $url->appendChild($xml->createElement('priority', 0.8));
        $url->appendChild($xml->createElement('changefreq', 'monthly'));
        $urlSet->appendChild($url);
    }
    $xml->appendChild($urlSet);
    return response($xml->saveXml(), 200)
        ->header('Content-Type', 'text/xml');
});

Route::get('{url}', function ($url) use ($router) {
    $url = '/' .$url;
    $page = DB::table('pages')->whereIn('url', [$url, $url . '/'])->first();
    if (!$page) {
        $content = 'Содержимое скоро появится';
    } else {
        $content = $page->content;
    }

    $title = $page->title;
    $metaTitle = !empty($page->meta_title) ? $page->meta_title : $page->title;
    $metaDescription = $page->meta_description;

    return view('default.page', [
        'content' => $content,
        'title' => $title,
        'metaTitle' => $metaTitle,
        'metaDescription' => $metaDescription,
    ]);
})->where(['url' => '.+']);

Route::get('/{postUrl}', function ($postUrl) use ($router) {

    $post = app('db')->select("SELECT * FROM posts WHERE url=:url limit 1", ['url' => $postUrl]);

    if (empty($post)) {
        abort(404);
    }

    return view('default.post', (array)$post[0]);
});

Route::get('/', function () {
    $posts = DB::table('posts')->paginate(10);
    return view('default.index', ['posts' => $posts]);
});
