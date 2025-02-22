/*
Template Name: ShaqsHouse - Food Order Directory, Restaurants, Fast Food, Bars Mobile Template
Author: Askbootstrap
Author URI: https://themeforest.net/user/askbootstrap
Version: 1.0
*/

(function($) {
  "use strict";

    $("body").on("contextmenu",function(e){
        return false;
    });
    $(document).keydown(function(e){
         if (e.ctrlKey && (e.keyCode === 67 || e.keyCode === 86 || e.keyCode === 85 || e.keyCode === 117)){
           return false;
         }
         if(e.which === 123){
             return false;
         }
         if(e.metaKey){
             return false;
         }
         //document.onkeydown = function(e) {
         // "I" key
         if (e.ctrlKey && e.shiftKey && e.keyCode == 73) {
             return false;
         }
         // "J" key
         if (e.ctrlKey && e.shiftKey && e.keyCode == 74) {
             return false;
         }
         // "S" key + macOS
         if (e.keyCode == 83 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
             return false;
         }
         if (e.keyCode == 224 && (navigator.platform.match("Mac") ? e.metaKey : e.ctrlKey)) {
             return false;
         }
         // "U" key
         if (e.ctrlKey && e.keyCode == 85) {
            return false;
         }
         // "F12" key
         if (e.keyCode == 123) {
            return false;
         }
    });





    (function(i,s,o,g,r,a,m){
        i['GoogleAnalyticsObject']=r;
        i[r]=i[r]||function(){
            (i[r].q=i[r].q||[]).push(arguments)
        }, i[r].l=1*new Date();
        a=s.createElement(o), m=s.getElementsByTagName(o)[0];
        a.async=1; a.src='https://www.google-analytics.com/analytics.js';
        m.parentNode.insertBefore(a,m)
    })(window,document,'script','','ga');

ga('create', 'UA-120909275-a1', 'auto');
ga('send', 'pageview');

$(document).ready(function(){
    $('.index_slider').slick({ infinite: true, arrows: false, slidesToShow: 1, slidesToScroll: 1, dots: true });
    $('.yum_slider').slick({ infinite: false, arrows: false, slidesToShow: 2.4, slidesToScroll: 1 });
    $('.new_slider').slick({ infinite: false, arrows: false, slidesToShow: 2, slidesToScroll: 1 });
    $('.fav_slider').slick({ infinite: false, arrows: false, slidesToShow: 1, slidesToScroll: 0.3 });
    $('.featured_slider').slick({ infinite: false, arrows: false, slidesToShow: 1.2, slidesToScroll: 1 });
    $('.near_slider').slick({ infinite: false, arrows: false, slidesToShow: 2.4, slidesToScroll: 2 });
    $('.card_slider').slick({ infinite: false, arrows: false, slidesToShow: 2.5, slidesToScroll: 2 });
    $('.pay_slider').slick({ infinite: false, arrows: false, slidesToShow: 3.1, slidesToScroll: 2 });
    $('.nearyou_slider').slick({ infinite: false, arrows: false, slidesToShow: 1.2, slidesToScroll: 1 });
    $('.detail_slider').slick({ infinite: false, arrows: false, slidesToShow: 1, slidesToScroll: 1, dots: true });
    $('.tabs_slider').slick({ infinite: false, arrows: false, slidesToShow: 4.2, slidesToScroll: 1 });
    $(".loading-img").hide();
});





    $('#submitLogin').submit(function(e) {
        e.preventDefault();
        var actionurl = e.currentTarget.action;
        $(".loading-img").show();
        $.ajax({
            url: actionurl,
            type: 'post',
            dataType: 'json',
            data: $('#submitLogin').serialize(),
            success: function(data) {
               $(".loading-img").hide();
               var host = window.location.protocol + "//" + window.location.host + "/mobile/get-started";
               if(data['message'] == "Success"){
                  window.location.replace(host);
               }else{
                  alert('Wrong Username or Password');
               }
            }
        });
    });

    $('#submitSignUp').submit(function(e) {
        e.preventDefault();
        var actionurl = e.currentTarget.action;
        $(".loading-img").show();
        $.ajax({
            url: actionurl,
            type: 'post',
            dataType: 'json',
            data: $('#submitSignUp').serialize(),
            success: function(data) {
               $(".loading-img").hide();
               var host = window.location.protocol + "//" + window.location.host + "/mobile/veryfy-number";
               if(data['message'] == "Success"){
                  window.location.replace(host);
               }else{
                  alert(data['message']);
               }
            }
        });
    });

    $( ".order-btn" ).click(function(event) {
        event.preventDefault();
        $(".loading-img").show();
        var productID = $(this).attr('id');
        var host = window.location.protocol + "//" + window.location.host + "/mobile/shopping-cart/add-to-cart/" + productID;
        $.ajax({
            url: host,
            method: "GET",
            success: function(response) {
                setTimeout(function() {
                    $('#myCart').load(location.href + ' #myCart');
                }, 1000);
                $(".loading-img").hide();
                alert(response);
            },
            error: function(xhr, status, error) {
                alert("Error adding item to cart.");
            }
        });
        event.stopImmediatePropagation();
        return false;

    });

    $('#Veryfy-Form').submit(function(e) {
        e.preventDefault();
        var actionurl = e.currentTarget.action;
        $(".loading-img").show();
        $.ajax({
            url: actionurl,
            type: 'post',
            dataType: 'json',
            data: $('#Veryfy-Form').serialize(),
            success: function(data) {
               $(".loading-img").hide();
               var host = window.location.protocol + "//" + window.location.host + "/mobile/verification-code";
               if(data['message'] == "Success"){
                  window.location.replace(host);
               }else{
                  alert(data['message']);
               }
            }
        });
    });

    $('#stk-push').submit(function(e) {
        e.preventDefault();
        var actionurl = e.currentTarget.action;
        $(".loading-img").show();
        $.ajax({
            url: actionurl,
            type: 'post',
            dataType: 'json',
            data: $('#stk-push').serialize(),
            success: function(data) {
               $(".loading-img").hide();
               var host = window.location.protocol + "//" + window.location.host + "/mobile/profile";
               if(data['message'] == "Success"){
                  window.location.replace(host);
               }else{
                  alert(data['message']);
               }
            }
        });
        e.stopImmediatePropagation();
        return false;
    });


    $('#Veryfy').submit(function(e) {
        e.preventDefault();
        var actionurl = e.currentTarget.action;
        $(".loading-img").show();
        $.ajax({
            url: actionurl,
            type: 'post',
            dataType: 'json',
            data: $('#Veryfy').serialize(),
            success: function(data) {
               $(".loading-img").hide();
               var host = window.location.protocol + "//" + window.location.host + "/mobile/get-started";
               if(data['message'] == "Success"){
                  window.location.replace(host);
               }else{
                  alert(data['message']);
                  window.location.reload();
               }
            }
        });
    });

      var $main_nav = $('#main-nav');
      var $toggle = $('.toggle');

      var defaultOptions = {
          disableAt: false,
          customToggle: $toggle,
          levelSpacing: 40,
          navTitle: "Shaq's House",
          levelTitles: true,
          levelTitleAsBack: true,
          pushContent: '#container',
          insertClose: 2
      };

        // call our plugin
      var Nav = $main_nav.hcOffcanvasNav(defaultOptions);

})(jQuery);
