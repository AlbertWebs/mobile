<!doctype html>
<html lang="en">
   <head>
      <meta charset="utf-8">
      <meta name="viewport" content="width=device-width, initial-scale=1">
      <meta name="description" content="Pilau, Hot Burgers, Nyama Choma, Mbuzi Choma, Beef, Pizza and More Powered By Shaq's House Limited">
      <meta name="author" content="Designekta Studios">
      <link rel="icon" type="image/png" href="{{asset('uploads/VENSHAQ001-41.png')}}">
      {{-- @include('favicon') --}}
      <title>Shaq's Bites - Food Order Directory</title>
      <link rel="icon" type="image/png" href="{{asset('uploads/VENSHAQ001-41.png')}}">
      <link rel="manifest" href="{{asset('manifest.json')}}">
      <link href="{{asset('mobileTheme/vendor/bootstrap/css/bootstrap.min.css')}}" rel="stylesheet">
      <link href="{{asset('mobileTheme/vendor/icons/css/materialdesignicons.min.css')}}" rel="stylesheet" type="text/css">
      <link rel="stylesheet" type="text/css" href="{{asset('mobileTheme/vendor/slick/slick.min.css')}}" />
      <link rel="stylesheet" type="text/css" href="{{asset('mobileTheme/vendor/slick/slick-theme.min.css')}}" />
      <link href="{{asset('mobileTheme/css/style.css')}}" rel="stylesheet" type="text/css">
      <link href="{{asset('mobileTheme/vendor/sidebar/demo.css')}}" rel="stylesheet">
   </head>
   <body class="index_bg">
      @yield('content')
      <script src="{{asset('mobileTheme/vendor/jquery/jquery.min.js')}}" type="text/javascript"></script>
      <script src="{{asset('mobileTheme/vendor/bootstrap/js/bootstrap.bundle.min.js')}}" crossorigin="anonymous" type="text/javascript"></script>
      <script type="text/javascript" src="{{asset('mobileTheme/vendor/slick/slick.min.js')}}"></script>
      <script type="1774f278b0e80a1ae5b262c9-text/javascript" src="{{asset('mobileTheme/vendor/sidebar/hc-offcanvas-nav.js')}}"></script>
      <script src="{{asset('mobileTheme/js/custom.js')}}" type="text/javascript"></script>
      <script src="{{asset('mobileTheme/vendor/scripts/rocket-loader.min.js')}}" defer=""></script>
      <script defer src="https://static.cloudflareinsights.com/beacon.min.js" integrity="sha512-Gi7xpJR8tSkrpF7aordPZQlW2DLtzUlZcumS8dMQjwDHEnw9I7ZLyiOj/6tZStRBGtGgN6ceN6cMH8z7etPGlw==" data-cf-beacon='{"rayId":"71fc36dd4b75d73d","version":"2022.6.0","r":1,"token":"dd471ab1978346bbb991feaa79e6ce5c","si":100}' crossorigin="anonymous"></script>

      {{--  --}}
      <script src="{{asset('mobileTheme/vendor/jquery/jquery.min.js')}}" type="1774f278b0e80a1ae5b262c9-text/javascript"></script>

      <script src="{{asset('mobileTheme/vendor/bootstrap/js/bootstrap.bundle.min.js')}}" type="1774f278b0e80a1ae5b262c9-text/javascript"></script>

      <script type="1774f278b0e80a1ae5b262c9-text/javascript" src="{{asset('mobileTheme/vendor/slick/slick.min.js')}}"></script>

      <script type="1774f278b0e80a1ae5b262c9-text/javascript" src="{{asset('mobileTheme/vendor/sidebar/hc-offcanvas-nav.js')}}"></script>

      <script src="{{asset('mobileTheme/js/custom.js')}}" type="1774f278b0e80a1ae5b262c9-text/javascript"></script>
      <script src="{{asset('cdn-cgi/scripts/7d0fa10a/cloudflare-static/rocket-loader.min.js')}}" data-cf-settings="1774f278b0e80a1ae5b262c9-|49" defer=""></script>
      <script defer src="https://static.cloudflareinsights.com/beacon.min.js/v652eace1692a40cfa3763df669d7439c1639079717194"  crossorigin="anonymous"></script>
      {{--  --}}
      <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
      <script>

        var ENDPOINT = "{{ route('index.mobile') }}";
        var page = 1;
        /*------------------------------------------
        --------------------------------------------

        Call on Scroll

        --------------------------------------------
        --------------------------------------------*/

        $(window).scroll(function () {

            if ($(window).scrollTop() + $(window).height() >= ($(document).height() - 20)) {

                page++;

                infinteLoadMore(page);

            }

        });



        /*------------------------------------------

        --------------------------------------------

        call infinteLoadMore()

        --------------------------------------------

        --------------------------------------------*/

        function infinteLoadMore(page) {


            $.ajax({

                    url: ENDPOINT + "/get-started?page=" + page,

                    datatype: "html",

                    type: "get",

                    beforeSend: function () {

                        $('.auto-load').show();

                    }

                })

                .done(function (response) {

                    if (response.html == '') {

                        $('.auto-load').html("We don't have more items in our menu to display :( <br> Wish to call? <a href='tel:+254706788440'>0706788440</a> ");

                        return;

                    }



                    $('.auto-load').hide();

                    $("#data-wrapper").append(response.html);

                })

                .fail(function (jqXHR, ajaxOptions, thrownError) {

                    console.log('Server error occured');

                });

        }

    </script>

      {{--  --}}
   </body>
</html>
