// JavaScript Document


/*
  loader
  show elements
  teaser
  preload
  countdown SETUP
  niceScroll
    niceScroll.resize
  fire sections
  snow
  menu active state
  mobile detect
*/


$(function() {
    "use strict";
	
	
    $(window).on("load", function() {
        // loader
        $(".screen-loader").fadeOut("slow");
		
        // show elements
        setTimeout(function() {
            $("#preload").delay(250).fadeOut(1500);
            $(".borders").delay(2000).css({
                display: "none"
            }).fadeIn(3000);
            $("#intro-wrapper").delay(2000).css({
                display: "none"
            }).fadeIn(3000);
            $(".menu").delay(2000).css({
                display: "none"
            }).fadeIn(3000);
            $(".menu-mobile").delay(2000).css({
                display: "none"
            }).fadeIn(3000);
            $("#countdown-wrapper").delay(2000).css({
                display: "none"
            }).fadeIn(3000);
            $("#subscribe-form").delay(2000).css({
                display: "none"
            }).fadeIn(3000);
            $(".social-icons-wrapper").delay(2000).css({
                display: "none"
            }).fadeIn(3000);
        }, 0);
		
        // teaser
        var tid = setInterval(animateTeaser, 4000);
        var animCount = 0;

        function animateTeaser() {
            animCount++;
            if (animCount > 3) {
                animCount = 0;
                $(".teaser-text-animation.active").fadeTo(300, 0, function() {
                    $(".teaser-text-animation").removeClass("active");
                    $(".teaser-text-animation").removeClass("first");
                    $(".teaser-normal").css({
                        marginTop: "100px"
                    });
                    $(".teaser-highlight").css({
                        marginTop: "-100px"
                    });
                    $(".teaser-text-animation:first").addClass("active").fadeTo(300, 1, function() {
                        $(".teaser-normal, .teaser-highlight, .teaser-text-animation:first").each(function(wordCount) {
                            $(this).animate({
                                marginTop: 0
                            }, {
                                duration: 400,
                                queue: false
                            });
                        });
                    });
                });
            } else {
                var nextAnim = $(".teaser-text-animation").get(animCount);
                $(".teaser-text-animation.active").fadeTo(300, 0, function() {
                    $(".teaser-text-animation").removeClass("active");
                    $(".teaser-normal").css({
                        marginTop: "100px"
                    });
                    $(".teaser-highlight").css({
                        marginTop: "-100px"
                    });
                    $(nextAnim).addClass("active").fadeTo(300, 1, function() {
                        $(".teaser-normal, .teaser-highlight", nextAnim).each(function(wordCount) {
                            $(this).animate({
                                marginTop: 0
                            }, {
                                duration: 400,
                                queue: false
                            });
                        });
                    });
                });
            }
        }
    });
	
    // preload
    $("#preload").css({
        display: "table"
    });
	
    $(document).on("ready", function() {
        // countdown SETUP
        $("#countdown").countdown({
            date: "05 May 2025 12:00:00", // countdown target date settings
            format: "on"
        }, function() {});
		
        // niceScroll
        $("body").niceScroll({
            cursorcolor: "#fff",
            cursorwidth: "5px",
            cursorborder: "1px solid #fff",
            cursorborderradius: "0px",
            zindex: "9999",
            scrollspeed: "60",
            mousescrollstep: "40"
        });
    });
	
    // niceScroll.resize
    $("body").getNiceScroll().resize();
	
    // fire sections
    $("#fire-home, #fire-home-mobile").on("click", function(e) {
        e.preventDefault();
        $(".current").fadeOut(900, function() {
            $(".upper-page").fadeIn(1200);
            $(".current").removeClass("current");
            $(".upper-page").addClass("current");
        });
    });
    $("#fire-about, #fire-about-mobile").on("click", function(e) {
        e.preventDefault();
        $(".current").fadeOut(900, function() {
            $("#about").fadeIn(1200);
            $(".current").removeClass("current");
            $("#about").addClass("current");
        });
    });
    $("#fire-services, #fire-services-mobile").on("click", function(e) {
        e.preventDefault();
        $(".current").fadeOut(900, function() {
            $("#services").fadeIn(1200);
            $(".current").removeClass("current");
            $("#services").addClass("current");
        });
    });
    $("#fire-contact, #fire-contact-mobile").on("click", function(e) {
        e.preventDefault();
        $(".current").fadeOut(900, function() {
            $("#contact").fadeIn(1200);
            $(".current").removeClass("current");
            $("#contact").addClass("current");
        });
    });
    $("#fire-about-closer, #fire-services-closer, #fire-contact-closer").on("click", function(e) {
        e.preventDefault();
        $(".current").fadeOut(900, function() {
            $(".upper-page").fadeIn(1200);
            $(".current").removeClass("current");
            $(".upper-page").addClass("current");
        });
    });
	
	// snow
    $("#snow").each(function() {
        snowBind();
    });
	
	// menu active state
	$("a.menu-state").click(function() {
    	$("a.menu-state").removeClass("active");
    	$(this).addClass("active");
	});
	
    // mobile detect
    var isMobile = {
        Android: function() {
            return navigator.userAgent.match(/Android/i);
        },
        BlackBerry: function() {
            return navigator.userAgent.match(/BlackBerry/i);
        },
        iOS: function() {
            return navigator.userAgent.match(/iPhone|iPad|iPod/i);
        },
        Opera: function() {
            return navigator.userAgent.match(/Opera Mini/i);
        },
        Windows: function() {
            return navigator.userAgent.match(/IEMobile/i);
        },
        any: function() {
            return (isMobile.Android() || isMobile.BlackBerry() || isMobile.iOS() || isMobile.Opera() || isMobile.Windows());
        }
    };


});