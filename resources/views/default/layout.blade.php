<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" dir="ltr" lang="ru-RU">
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8"/>
    <title>@yield('title')</title>
    <meta name="robots" content="index,follow,noodp,noydir"/>
    <meta name="title" content="@yield('metaTitle')"/>
    <meta name="description" content="@yield('metaDescription')"/>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css"/>
    <link rel="stylesheet" href="/default/css/style.css"/>
    <link rel="stylesheet" href="/default/css/MenuMatic.css"/>
    <link rel="stylesheet" href="/default/css/screen.css"/>

</head>
<body>
<div id="wrap-wrapper">
    <div id="wrapper">
        <div id="container" class="container">
            <div id="header" class="span-24">
                <div class="span-11">
                    <a href="/">
                        <img src="/default/img/logo.png" alt="Заметки путешественника" title="Заметки путешественника" class="logoimg"/></a>
                </div>
                <div class="span-13 last">
                    <div id="pagemenucontainer">
                        <ul id="pagemenu">
                            <li class="current_page_item"><a href="/">Главная</a></li>
                            <li class="page_item page-item-846"><a href="/deshevye-aviabilety/">Дешевые авиабилеты</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="span-24">
                @include('default.navbar')
            </div>
            <div class="span-24" id="contentwrap">
                <div class="span-16">
                    <div id="content">
                        @yield('content')
                    </div>
                </div>
            </div>
            <div class="span-24">
                <div id="footer">© 2013 <a href="/">Заметки путешественника</a><br></div>
            </div>
            <div class="span-8 last">
                <div class="sidebar">

                </div>
            </div>
        </div>
    </div>
</div>
</body></html>
