<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>CTRL+D</title>
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/website/css/bootstrap-grid.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/website/css/font-awesome.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/website/css/main.css') }}">
    <link rel="stylesheet" type="text/css" media="screen" href="{{ asset('assets/website/css/animations.css') }}">
    <link rel="stylesheet" type="text/css" media="screen and (max-width: 576px)" href="{{ asset('assets/website/css/576.css') }}">
</head>
<body class="home">
    @include('website.content_block.header')
    <nav class="navbar-fixed">
        {!! OlCmsMenu::show('menu-principal') !!}
        @include('website.content_block.sociables')
    </nav>
    <main id="main">
        <div id="bg-2">
            <div id="bg-3">
                <section class="container-fluid">
                    <div class="container">
                        <div class="row">
                            <div class="col-md-5 col-12 pl-0">
                                <picture data-edit="true" data-id="1"><source media="(max-width: 360px)" srcset="/storage/ctrld_360_392_.png"><source media="(max-width: 576px)" srcset="/storage/ctrld.png"><source media="(max-width: 1024px)" srcset="/storage/ctrld.png"><source media="(max-width: 1140px)" srcset="/storage/ctrld.png"><img src="/storage/ctrld.png"></picture>
                            </div>
                            <div class="col-md-7 col-12 home-featured">
                                <h1 data-edit="true" class="title-home">Todas as formas <br> de ser criativo.</h1>
                                <div data-edit="true">
                                    <p>Dez anos no comando!<br> Para o ser humano, criança. Para uma agência,
                                        maturidade.<br>Material PDV, Mídias Sociais, sites, embalagens, eventos,
                                        brindes, anúncios, vídeos, ações, naming, logo, identidade de marca.<br><br>A
                                        gente faz de tudo um pouco: o que importa é entregar muita qualidade. Atendendo
                                        todo tipo de cliente (de empresas do ramo turístico, até farmacêuticas e marcas
                                        alimentícias), a CTRL+D se tornou a<br>favorita de tantas marcas porque é
                                        diferente.<br>Trabalhando tanto em forma digital quanto impressa, sempre
                                        buscamos estratégias inteligentes e soluções criativas.<br>Foi assim que
                                        conquistamos nossa primeira década e é assim que construímos nosso futuro.</p>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="container box-video-home">
                        <div class="row">
                            <div data-edit="true" class="col-12">
                                <div style="padding:56.25% 0 0 0;position:relative;">
                                <iframe src="https://player.vimeo.com/video/187834763?color=ff0179" style="position:absolute;top:0;left:0;width:100%;height:100%;" allow="autoplay; fullscreen" allowfullscreen="" frameborder="0"></iframe>
                                </div>
                                <script src="https://player.vimeo.com/api/player.js"></script>
                            </div>
                        </div>
                    </div>
                </section>
                <section>
                    <div class="container">
                        <div class="row">
                            <div class="col-12 clients-list plr-default">
                                <h2 data-edit="true" data-id="5" class="subtitle text-pink">Nossos clientes</h2>
                            </div>
                        </div>
                    </div>
                    <div class="container-fluid clients-home">
                        <div class="container">
                            <div class="row">
                                <div class="col-12 clients-list plr-mini-default text-center">
                                    <img data-edit="true" data-id="6" src="/storage/clientes-v2.png" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>
                </section>
            </div>
        </div>
    </main>
    @include('website.content_block.footer')
    <script src="{{ asset('assets/website/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/website/js/bootstrap.js') }}"></script>
    <script src="{{ asset('assets/website/js/main.js') }}"></script>
</body>
</html>