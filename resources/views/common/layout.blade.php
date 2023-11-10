<!DOCTYPE html>
<html lang="ja">
  <head>
    <meta charset="UTF-8">
    <title>{{ $page_meta_tags['title'] ?? '' }}</title>
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <meta name="description" content="{{ $page_meta_tags['description'] ?? '' }}">
    <meta name="keywords" content="{{ $page_meta_tags['keywords'] ?? '' }}">
    <meta name="format-detection" content="telephone=no">
    <link rel="icon" href="{{ url('images/favicon.ico') }}">
    <link rel="apple-touch-icon" href="{{ url('images/apple-touch-icon.png') }}">
    <link rel="stylesheet" href="https://unpkg.com/swiper/swiper-bundle.css" / media="print" onload="this.media='all'">
    <link rel="stylesheet" href="{{ url('css/style.css') }}">
    <!-- Font Awesome 6 -->
    <script src="https://kit.fontawesome.com/7f2a70e336.js" crossorigin="anonymous"></script>
    <script src="https://unpkg.com/swiper/swiper-bundle.js" defer></script>
    <script src="{{ url('js/script.js') }}" defer></script>
    <script src="https://d.shutto-translation.com/trans.js?id=33255"></script>
  </head>
  <body id="top">
    <div class="wrapper">
<!-- ここからheader ********************************************************************************-->
      <header>
        <h1>
          <a href="{{ url(config('custom.page.index.url')) }}">
            <img src="{{ url('images/logo.png') }}" alt="{{ $page_meta_tags['h1'] ?? '' }}" loading="lazy">
          </a>
        </h1>
        <ul role="navigation" aria-label="メイン">
          <li>{{ link_to_route(config('custom.page.category1.route'), config('custom.page.category1.name')) }}</li>
          <li>{{ link_to_route(config('custom.page.category2.route'), config('custom.page.category2.name')) }}</li>
          <li>{{ link_to_route(config('custom.page.category3.route'), config('custom.page.category3.name')) }}</li>
          <li>{{ link_to_route(config('custom.page.category4.route'), config('custom.page.category4.name')) }}</li>
          <li>{{ link_to_route(config('custom.page.category5.route'), config('custom.page.category5.name')) }}</li>
        </ul>
        <p class="tel">
          <a href="tel:{{ $company->tel }}">
            <i class="fa-solid fa-phone"></i><span>{{ $company->tel }}</span>
          </a>
        </p>
        <p class="mail">
          <a href="{{ url(config('custom.page.contact.url')) }}">
            <i class="fa-solid fa-envelope"></i><span>お問い合わせメール</span>
          </a>
        </p>
          <nav aria-label="メイン">
            <input type="checkbox" class="menu-btn" id="menu-btn" autocomplete="off">
            <label for="menu-btn" class="menu-icon"><span class="navicon"></span></label>
            <div class="nav_list">
              <ul>
                <li><a href="{{ url(config('custom.page.index.url')) }}">{{ config('custom.page.index.name') }}<span class="fa-stack"><i class="fa-solid fa-circle fa-stack-1x"></i><i class="fa-solid fa-caret-right fa-stack-1x"></i></span></a></li>
                <li><a href="{{ url(config('custom.page.category1.url')) }}">{{ config('custom.page.category1.name') }}<span class="fa-stack"><i class="fa-solid fa-circle fa-stack-1x"></i><i class="fa-solid fa-caret-right fa-stack-1x"></i></span></a></li>
                <li><a href="{{ url(config('custom.page.category2.url')) }}">{{ config('custom.page.category2.name') }}<span class="fa-stack"><i class="fa-solid fa-circle fa-stack-1x"></i><i class="fa-solid fa-caret-right fa-stack-1x"></i></span></a></li>
                <li><a href="{{ url(config('custom.page.category3.url')) }}">{{ config('custom.page.category3.name') }}<span class="fa-stack"><i class="fa-solid fa-circle fa-stack-1x"></i><i class="fa-solid fa-caret-right fa-stack-1x"></i></span></a></li>
                <li><a href="{{ url(config('custom.page.category4.url')) }}">{{ config('custom.page.category4.name') }}<span class="fa-stack"><i class="fa-solid fa-circle fa-stack-1x"></i><i class="fa-solid fa-caret-right fa-stack-1x"></i></span></a></li>
                <li><a href="{{ url(config('custom.page.category5.url')) }}">{{ config('custom.page.category5.name') }}<span class="fa-stack"><i class="fa-solid fa-circle fa-stack-1x"></i><i class="fa-solid fa-caret-right fa-stack-1x"></i></span></a></li>
                <li><a href="{{ url(config('custom.page.category7.url')) }}">{{ config('custom.page.category7.name') }}<span class="fa-stack"><i class="fa-solid fa-circle fa-stack-1x"></i><i class="fa-solid fa-caret-right fa-stack-1x"></i></span></a></li>
                <li><a href="{{ url(config('custom.page.category6.url')) }}">{{ config('custom.page.category6.name') }}<span class="fa-stack"><i class="fa-solid fa-circle fa-stack-1x"></i><i class="fa-solid fa-caret-right fa-stack-1x"></i></span></a></li>
                <li><a href="{{ url(config('custom.page.category8.url')) }}">{{ config('custom.page.category8.name') }}<span class="fa-stack"><i class="fa-solid fa-circle fa-stack-1x"></i><i class="fa-solid fa-caret-right fa-stack-1x"></i></span></a></li>
                <li><a href="{{ url(config('custom.page.contact.url')) }}">{{ config('custom.page.contact.name') }}<span class="fa-stack"><i class="fa-solid fa-circle fa-stack-1x"></i><i class="fa-solid fa-caret-right fa-stack-1x"></i></span></a></li>
                <li>
                  <span class="sns">
                    <a href="{{ $company->twitter }}" target="_blank" class="icon"><i class="fa-brands fa-twitter"></i></a>
                    <a href="{{ $company->line }}" target="_blank" class="icon"><i class="fa-brands fa-line"></i></a>
                    <a href="{{ $company->instagram }}" target="_blank" class="icon"><i class="fa-brands fa-instagram"></i></a>
                  </span>
                </li>
              </ul>
            </div>
          </nav>
      </header>
<!-- //ここまでheader ********************************************************************************-->
      @yield('main')
<!-- ここからfooter ********************************************************************************-->
      <footer>
        <div class="inner">
          <address>
            <h2 class="title">
              <span>CONTACT</span>お問い合わせ
            </h2>
            <p>
              {{ $company->name }}に関するお問い合わせは下記の電話番号<br>またはメールフォームより承っております。
            </p>
            <div class="btn">
              <a href="tel:{{ $company->tel }}" class="btn_03 tel_btn">
                <i class="fa-solid fa-phone"></i>{{ $company->tel }}
              </a>
              <a href="{{ url(config('custom.page.contact.url')) }}" class="btn_03 mail_btn">
                <i class="fa-solid fa-user"></i>無料お見積り・ご相談<br>メールフォーム
              </a>
            </div>
          </address>
          <div class="footer_bottom">
            <figure>
              <a href="{{ url(config('custom.page.index.url')) }}">
                <img src="{{ url('images/logo_2.png') }}" alt="LOGO" loading="lazy">
              </a>
            </figure>
            <ul role="navigation" aria-label="メイン">
              <li>{{ link_to_route(config('custom.page.category1.route'), config('custom.page.category1.name')) }}</li>
              <li>{{ link_to_route(config('custom.page.category2.route'), config('custom.page.category2.name')) }}</li>
              <li>{{ link_to_route(config('custom.page.category3.route'), config('custom.page.category3.name')) }}</li>
              <li>{{ link_to_route(config('custom.page.category4.route'), config('custom.page.category4.name')) }}</li>
              <li>{{ link_to_route(config('custom.page.category5.route'), config('custom.page.category5.name')) }}</li>
              <li>{{ link_to_route(config('custom.page.contact.route'), config('custom.page.contact.name')) }}</li>
            </ul>
            <div class="sns">
              <a href="{{ $company->twitter }}" target="_blank" class="icon"><i class="fa-brands fa-twitter"></i></a>
              <a href="{{ $company->line }}" target="_blank" class="icon"><i class="fa-brands fa-line"></i></a>
              <a href="{{ $company->instagram }}" target="_blank" class="icon"><i class="fa-brands fa-instagram"></i></a>
            </div>
            <span>&copy;&nbsp;202100000&nbsp;All&nbsp;Rights&nbsp;Reserved.</span>
          </div>
        </div>
        <div class="arrow_top">
          <a href="#top" class="arrow_top"><i class="fa-solid fa-angles-up"></i></a>
        </div>
      </footer>
<!-- //ここまでfooter ********************************************************************************-->
    </div>
  </body>
</html>
