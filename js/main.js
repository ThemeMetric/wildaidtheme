
$('.single-item').slick();

var contRight = $('.contact-page .colmn-right').outerHeight();
$('.contact-page .colmn-left').css({'height':contRight})

var theToggle = document.getElementById('toggle');

// based on Todd Motto functions
// https://toddmotto.com/labs/reusable-js/

// hasClass
function hasClass(elem, className) {
	return new RegExp(' ' + className + ' ').test(' ' + elem.className + ' ');
}
// addClass
function addClass(elem, className) {
    if (!hasClass(elem, className)) {
    	elem.className += ' ' + className;
    }
}
// removeClass
function removeClass(elem, className) {
	var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, ' ') + ' ';
	if (hasClass(elem, className)) {
        while (newClass.indexOf(' ' + className + ' ') >= 0 ) {
            newClass = newClass.replace(' ' + className + ' ', ' ');
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, '');
    }
}
// toggleClass
function toggleClass(elem, className) {
	var newClass = ' ' + elem.className.replace( /[\t\r\n]/g, " " ) + ' ';
    if (hasClass(elem, className)) {
        while (newClass.indexOf(" " + className + " ") >= 0 ) {
            newClass = newClass.replace( " " + className + " " , " " );
        }
        elem.className = newClass.replace(/^\s+|\s+$/g, '');
    } else {
        elem.className += ' ' + className;
    }
}

theToggle.onclick = function() {
   toggleClass(this, 'on');
   return false;
}

$(window).scroll(function(){
  if ($(window).scrollTop() >= 100) {
    $('.sticky-header').addClass('fixed');
    $('.tagline').fadeOut();
   }
   else {
    $('.sticky-header').removeClass('fixed');
    $('.tagline').fadeIn();
   }

    if ($(window).scrollTop() >= ($(".header-background").height() - 60)  ) {
            $('.filter-panel').addClass('fixed');
        }
        else {
            $('.filter-panel').removeClass('fixed');
        }
   
});

jQuery(".close").on("click", function() {
        jQuery("iframe").attr("src", jQuery("iframe").attr("src"));
});

$('.pause').on('click', function() {
    $('.vertical-center-4, .footerslider')
        .slick('slickPause')
});

$('.close').on('click', function() {
    $('.vertical-center-4, .footerslider')
        .slick('slickPlay')
});


/* Equal-height */

equalheight = function(a) {
    
        var e, b = 0,
            c = 0,
            d = new Array;
        $(a).each(function() {
            if (e = $(this), $(e).height("auto"), topPostion = e.position().top, c != topPostion) {
                for (currentDiv = 0; currentDiv < d.length; currentDiv++) d[currentDiv].height(b);
                d.length = 0, c = topPostion, b = e.height(), d.push(e)
            } else d.push(e), b = b < e.height() ? e.height() : b;
            for (currentDiv = 0; currentDiv < d.length; currentDiv++) d[currentDiv].height(b)
        })
    }, $(window).on("load resize ready orientationchange", function() {
    
        equalheight(".eq-height");
            
           
    });


    equalheights = function(a) {
    
        var e, b = 0,
            c = 0,
            d = new Array;
        $(a).each(function() {
            if (e = $(this), $(e).height("auto"), topPostion = e.position().top, c != topPostion) {
                for (currentDiv = 0; currentDiv < d.length; currentDiv++) d[currentDiv].height(b);
                d.length = 0, c = topPostion, b = e.height(), d.push(e)
            } else d.push(e), b = b < e.height() ? e.height() : b;
            for (currentDiv = 0; currentDiv < d.length; currentDiv++) d[currentDiv].height(b)
        })
    }, $(window).on("load resize ready orientationchange", function() {
    
        equalheights(".eq-heights");
            
           
    });

        equalheightse = function(a) {
    
        var e, b = 0,
            c = 0,
            d = new Array;
        $(a).each(function() {
            if (e = $(this), $(e).height("auto"), topPostion = e.position().top, c != topPostion) {
                for (currentDiv = 0; currentDiv < d.length; currentDiv++) d[currentDiv].height(b);
                d.length = 0, c = topPostion, b = e.height(), d.push(e)
            } else d.push(e), b = b < e.height() ? e.height() : b;
            for (currentDiv = 0; currentDiv < d.length; currentDiv++) d[currentDiv].height(b)
        })
    }, $(window).on("load resize ready orientationchange", function() {
    
        equalheightse(".eq-heightse");
            
           
    });

/* End-of-Equal-height */

$('p, ul').each(function() {
    var $this = $(this);
    if($this.html().replace(/\s|&nbsp;/g, '').length == 0)
        $this.remove();
});



$('#loadMore').click(function(){

    equalheights(".eq-heights");
     equalheight(".eq-height");

});

$(document).ready(function(){

    $('.more-link').on('click', function(e){
        e.preventDefault();
        var href = $(this).attr('href');
        // Show hidden
        //console.log(href);
        $('.' + href).removeClass('hidden');
        $('.more-link').addClass('hidden');
        $(this).parent().hide();


        //console.log("Text");
    });

    $('.imageCarousel div').slick({
        slidesToShow: 1,
        slidesToScroll: 1,
        arrows: true,
    });

    setTimeout(function(){

        $(".headerVideoCarousel").fadeIn(1500);
    },2000);
    setTimeout(function(){

        $(".headerVideoCarousel .inner").fadeIn(1500);
    },3000);
    $(".headerVideoCarousel button.prev").on("click",function(evt){
        evt.preventDefault();
        currentSelected =$(".headerVideoCarousel div.slide:visible");
        nextSelected = $(".headerVideoCarousel div.slide:visible").prev("div.slide");

       if($(nextSelected).length == 0 ){
           nextSelected =  $(".headerVideoCarousel div.slide:last");

       }
        currentSelected.addClass("hide");
        nextSelected.removeClass("hide");
    });


    $(".headerVideoCarousel button.next").on("click",function(evt){
        evt.preventDefault();
        currentSelected = $(".headerVideoCarousel div.slide:visible");
        nextSelected = $(".headerVideoCarousel div.slide:visible").next("div.slide");

        if($(nextSelected).length == 0 ){
            nextSelected=  $(".headerVideoCarousel div.slide:first");
        }
        currentSelected.addClass("hide");
        nextSelected.removeClass("hide");
    });
    $(".video.banner-container .headerVideoPlaylist li").click("click",function(evt){
        evt.preventDefault();
    });
    /**/
    if($(".video-gallery-navigation").length) {

        $(".video-gallery-navigation li a").on("click", function (evt) {
            evt.preventDefault();
            $(".video-gallery-navigation li.current").removeClass('current');
            $(this).parent().addClass("current");
            $(".video-gallery .video.current").removeClass('current');
            $("#content-" + $(this).attr("data-id")).addClass('current');


        });
    }
    $("#result-section-filters input").on("change",function(evt){
        if($(this).is(':checked')){
            if($(this).hasClass("uncheck-others")){
                $("#result-section-filters input:not(.uncheck-others)").prop("checked",false);
                $(".loaded-container,.text-right").fadeIn();

            }
            else{
                $("#result-section-filters .uncheck-others").prop("checked",false);

                showHideResultSections();

            }

        }
        else{
            section = $("." + $(this).val());
            $(section).hide();
        }
        if($(".loaded-container.programs").is(":hidden")
            & $(".loaded-container.news").is(":hidden")
            & $(".loaded-container.campaigns").is(":hidden")
            & $(".loaded-container.videos").is(":hidden")
            & $(".loaded-container.publications").is(":hidden")){

                    $(".noResults").show();

        }
        else{
            $(".noResults").hide();
            //console.log("show");
        }
    });
    function showHideResultSections(){
        $("#result-section-filters input").each(function(i, input){
            var section = "."+$(input).val();
            if($(input).is(":checked")){
                $(section).fadeIn();
            }
            else{
                $(section).fadeOut();
            }
        });
    }


    $(".custom-select select").on("change",function(evt){
        this.form.submit();
    });

    $("#searchbtn").on("click",function(evt){
        evt.preventDefault();
        if($("#searchField").val()){

            $("#hiddenSearchText").val($("#searchField").val());
            console.log($("#hiddenSearchText").val()) + "fun times";
        }

       $("#resform").submit();

    });

    //Search type dropdown on load shows only one section on resource page

    if( $("#hiddenSearchType").val()){
        $sectionFilter = $("#hiddenSearchType").val();
        var resourceType, aryTypes = $sectionFilter.split(",");
        console.log(aryTypes);
        if(aryTypes != "all"){
        $("#all-chk").prop("checked", false);
          for(resourceType of aryTypes) {

              $("#" + resourceType + "-chk").prop("checked", true);
              console.log("test"+resourceType );

          }
            showHideResultSections();
        }

    }

    /* View toggle on News page */
    $(".view-toggle a").on("click",function(evt){
        evt.preventDefault();
        if($(this).not('.selected')){
            previousSelected=$(".view-toggle a.selected");

            $(previousSelected).removeClass('selected');
            $(this).addClass("selected");
            $(".loaddiv").removeClass($(previousSelected).attr("data-view"));
            $(".loaddiv").addClass($(this).attr("data-view"));

        }

    });
    $("a.loadAmbassadors").on("click", function(evt){
        evt.preventDefault();
        var totalPages=$(this).attr("data-total-pages");
        var page = $(this).attr("data-page");
        var contentContainer=$(".loaddiv");
        var moreLink=this;
        var initLoad=false;

        // If initial load
        if(totalPages == -1 ) {
            initLoad=true;
        }

        $.ajax({
            url : "/wp-admin/admin-ajax.php",
            type : 'post',
            data : {
                action : 'moreAmbassadors',
                initLoad:initLoad,
                offset : page
            },
            success : function( response ) {
                if(response){
                    page=parseInt(page)+1;
                    console.log(response);
                    $(contentContainer).append(response.html);
                    //console.log(page);
                    totalPages=response.totalPages;
                    $(moreLink).attr("data-page",page);
                    $(moreLink).attr("data-total-pages",totalPages);
                    if(page > totalPages){
                        $(moreLink).fadeOut();
                    }
                }
            }
        });

    });
    $("a.loadMore").on("click", function(evt){
        evt.preventDefault();
        var loadMoreElem = $(this);
        var contentContainer= $(loadMoreElem).parent().prev();
        var type= $(loadMoreElem).attr("data-id");
        var program = $('#program-dropdown').val();
        var ambassador = $('#ambassador-dropdown').val();
        var location = $('#location-dropdown').val();
        var language = $('#language-dropdown').val();
        var totalPages=$(contentContainer).attr("data-total-pages");
        var page=$(contentContainer).attr("data-page");
        
        page=parseInt(page)+1;

        
      
     
        $.ajax({
            url : "/wp-admin/admin-ajax.php",
            type : 'post',
            data : {
                action : 'moreResults',
                resultType:type,
                program: program,
                ambassador: ambassador,
                location: location,
                language: language,
                offset : page
            },
            success : function( response ) {
               if(response){
                   //console.log(contentContainer);
                    $(contentContainer).append(response);
                    //console.log(page);
                    $(contentContainer).attr("data-page",page);
                    if(page>=totalPages){
                      $(loadMoreElem).fadeOut();
                    }
               }

            }
        });
    });

    if(window.matchMedia("(max-width: 767px)").matches){

        $('.filter-panel-button').on("click", function(evt){
            evt.preventDefault();
            if($('.filter-panel').hasClass("active")){
                $('.filter-panel').removeClass("active");
            }
            else{
                $('.filter-panel').addClass("active");
            }
        });
        $('header .nav ul > li.search-icon a').unbind("click");
    }
    setTimeout(function(){$(".btn-link").addClass("loaded");},1000);
});


;(function(root, factory) {
    if (typeof define === 'function' && define.amd) {
        define(['jquery'], factory);
    } else if (typeof exports === 'object') {
        module.exports = factory(require('jquery'));
    } else {
        root.jquery_dotdotdot_js = factory(root.jQuery);
    }
}(this, function(jQuery) {
    /*
     *	jQuery dotdotdot 3.1.0
     *	@requires jQuery 1.7.0 or later
     *
     *	dotdotdot.frebsite.nl
     *
     *	Copyright (c) Fred Heusschen
     *	www.frebsite.nl
     *
     *	License: CC-BY-NC-4.0
     *	http://creativecommons.org/licenses/by-nc/4.0/
     */
    !function(t){"use strict";function e(){h=t(window),s={},r={},o={},t.each([s,r,o],function(t,e){e.add=function(t){t=t.split(" ");for(var n=0,i=t.length;n<i;n++)e[t[n]]=e.ddd(t[n])}}),s.ddd=function(t){return"ddd-"+t},s.add("truncated keep text"),r.ddd=function(t){return"ddd-"+t},r.add("text"),o.ddd=function(t){return t+".ddd"},o.add("resize"),e=function(){}}var n="dotdotdot",i="3.1.0";if(!(t[n]&&t[n].version>i)){t[n]=function(t,e){this.$dot=t,this.api=["getInstance","truncate","restore","destroy","watch","unwatch"],this.opts=e;var i=this.$dot.data(n);return i&&i.destroy(),this.init(),this.truncate(),this.opts.watch&&this.watch(),this},t[n].version=i,t[n].uniqueId=0,t[n].defaults={ellipsis:"… ",callback:function(t){},truncate:"word",tolerance:0,keep:null,watch:"window",height:null},t[n].prototype={init:function(){this.watchTimeout=null,this.watchInterval=null,this.uniqueId=t[n].uniqueId++,this.originalContent=this.$dot.contents(),this.originalStyle=this.$dot.attr("style")||"","break-word"!==this.$dot.css("word-wrap")&&this.$dot.css("word-wrap","break-word"),"nowrap"===this.$dot.css("white-space")&&this.$dot.css("white-space","normal"),null===this.opts.height&&(this.opts.height=this._getMaxHeight())},getInstance:function(){return this},truncate:function(){var e=this;this.$inner=this.$dot.wrapInner("<div />").children().css({display:"block",height:"auto",width:"auto",border:"none",padding:0,margin:0}),this.$inner.contents().detach().end().append(this.originalContent.clone(!0)),this.$inner.find("script, style").addClass(s.keep),this.opts.keep&&this.$inner.find(this.opts.keep).addClass(s.keep),this.$inner.find("*").not("."+s.keep).add(this.$inner).contents().each(function(){var n=this,i=t(this);if(3==n.nodeType){if(i.parent().is("table, thead, tfoot, tr, dl, ul, ol, video"))return void i.remove();if(i.parent().contents().length>1){var r=t('<span class="'+s.text+'">'+e.__getTextContent(n)+"</span>").css({display:"inline",height:"auto",width:"auto",border:"none",padding:0,margin:0});i.replaceWith(r)}}else 8==n.nodeType&&i.remove()}),this.maxHeight=this._getMaxHeight();var n=this._truncateNode(this.$dot);return this.$dot[n?"addClass":"removeClass"](s.truncated),this.$inner.find("."+s.text).each(function(){t(this).replaceWith(t(this).contents())}),this.$inner.find("."+s.keep).removeClass(s.keep),this.$inner.replaceWith(this.$inner.contents()),this.$inner=null,this.opts.callback.call(this.$dot[0],n),n},restore:function(){this.unwatch(),this.$dot.contents().detach().end().append(this.originalContent).attr("style",this.originalStyle).removeClass(s.truncated)},destroy:function(){this.restore(),this.$dot.data(n,null)},watch:function(){var t=this;this.unwatch();var e={};"window"==this.opts.watch?h.on(o.resize+t.uniqueId,function(n){t.watchTimeout&&clearTimeout(t.watchTimeout),t.watchTimeout=setTimeout(function(){e=t._watchSizes(e,h,"width","height")},100)}):this.watchInterval=setInterval(function(){e=t._watchSizes(e,t.$dot,"innerWidth","innerHeight")},500)},unwatch:function(){h.off(o.resize+this.uniqueId),this.watchInterval&&clearInterval(this.watchInterval),this.watchTimeout&&clearTimeout(this.watchTimeout)},_api:function(){var e=this,n={};return t.each(this.api,function(t){var i=this;n[i]=function(){var t=e[i].apply(e,arguments);return"undefined"==typeof t?n:t}}),n},_truncateNode:function(e){var n=this,i=!1,r=!1;return t(e.children().get().reverse()).not("."+s.keep).each(function(){var e=(t(this).contents()[0],t(this));if(!i&&!e.hasClass(s.keep)){if(e.children().length)i=n._truncateNode(e);else if(!n._fits()||r){var o=t("<span>").css("display","none");if(e.replaceWith(o),e.detach(),n._fits()){if("node"==n.opts.truncate)return!0;o.replaceWith(e),i=n._truncateWord(e),i||(r=!0,e.detach())}else o.remove()}e.contents().length||e.remove()}}),i},_truncateWord:function(t){var e=t.contents()[0];if(!e)return!1;for(var n=this,i=this.__getTextContent(e),s=i.indexOf(" ")!==-1?" ":"　",r=i.split(s),o="",h=r.length;h>=0;h--){if(o=r.slice(0,h).join(s),0==h)return"letter"==n.opts.truncate&&(n.__setTextContent(e,r.slice(0,h+1).join(s)),n._truncateLetter(e));if(o.length&&(n.__setTextContent(e,n._addEllipsis(o)),n._fits()))return"letter"!=n.opts.truncate||(n.__setTextContent(e,r.slice(0,h+1).join(s)),n._truncateLetter(e))}return!1},_truncateLetter:function(t){for(var e=this,n=this.__getTextContent(t),i=n.split(""),s="",r=i.length;r>=0;r--)if(s=i.slice(0,r).join(""),s.length&&(e.__setTextContent(t,e._addEllipsis(s)),e._fits()))return!0;return!1},_fits:function(){return this.$inner.innerHeight()<=this.maxHeight+this.opts.tolerance},_addEllipsis:function(e){for(var n=[" ","　",",",";",".","!","?"];t.inArray(e.slice(-1),n)>-1;)e=e.slice(0,-1);return e+=this.opts.ellipsis},_getMaxHeight:function(){if("number"==typeof this.opts.height)return this.opts.height;for(var t=["maxHeight","height"],e=0,n=0;n<t.length;n++)if(e=window.getComputedStyle(this.$dot[0])[t[n]],"px"==e.slice(-2)){e=parseFloat(e);break}var t=[];switch(this.$dot.css("boxSizing")){case"border-box":t.push("borderTopWidth"),t.push("borderBottomWidth");case"padding-box":t.push("paddingTop"),t.push("paddingBottom")}for(var n=0;n<t.length;n++){var i=window.getComputedStyle(this.$dot[0])[t[n]];"px"==i.slice(-2)&&(e-=parseFloat(i))}return Math.max(e,0)},_watchSizes:function(t,e,n,i){if(this.$dot.is(":visible")){var s={width:e[n](),height:e[i]()};return t.width==s.width&&t.height==s.height||this.truncate(),s}return t},__getTextContent:function(t){for(var e=["nodeValue","textContent","innerText"],n=0;n<e.length;n++)if("string"==typeof t[e[n]])return t[e[n]];return""},__setTextContent:function(t,e){for(var n=["nodeValue","textContent","innerText"],i=0;i<n.length;i++)t[n[i]]=e}},t.fn[n]=function(i){return e(),i=t.extend(!0,{},t[n].defaults,i),this.each(function(){t(this).data(n,new t[n](t(this),i)._api())})};var s,r,o,h}}(jQuery);
    return true;
}));

jQuery(document).ready(function( $ ) {


    $(".ellipsis-multiline").dotdotdot({
        height: "watch",
        truncate: "word",
        watch: "window"
    });

});
