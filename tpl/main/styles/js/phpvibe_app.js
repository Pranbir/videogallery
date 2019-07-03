/*!
 * MediaVibe v6
 *
 * Copyright Interact.Software
 * https://www.phpvibe.com
 * MediaVibe IS NOT FREE SOFTWARE
 * If you have downloaded this CMS from a website other
 * than phpvibe.com or if you have received
 * this CMS from someone who is not a representative of phpVibe, you are involved in an illegal activity.
 * The phpVibe team takes actions against all unlincensed websites using Google, local authorities and 3rd party agencies.
 * Designed and built exclusively for sale @ phpVibe.com .
 */
//Initialize
jQuery(function($) {
    /*Detect touch device*/
    var tryTouch;
    try {
        document.createEvent("TouchEvent");
        tryTouch = 1;
    } catch (e) {
        tryTouch = 0;
    }
    /*Browser detection*/
    var $is_mobile = false;
    var $is_tablet = false;
    var $is_pc = false;
    if ($(window).width() < 600) {
        $is_mobile = true;
    } else if ($(window).width() < 1000) {
        $is_tablet = true;
    } else {
        $is_pc = true;
    }
	if ($(window).width() < 1000) {
		$('.searchWidget').removeClass('hide');
		 $('.searchWidget').clone().appendTo('.search-now-clone');       
		 $('.header > .searchWidget').remove();
		 
	}
    $('.tags').tagsInput({
        width: '100%',
        height: '44px'
    });
    $(".select").minimalect();
 	$(".pv_pop ,[rel=popover], .doPop").popover(); 
	$('.pv_tip, .tipN, .tipS, .tipW, .tipE').tooltip({
    'trigger' : 'hover'
    }); 
    $('#share-embed-code, #share-embed-code-small, #share-embed-code-large, #share-this-link').tooltip({
        'trigger': 'focus'
    });
	$('#myTab a,#myTabs a').click(function (e) {
     e.preventDefault();
     $(this).tab('show');
    });
  
    $('.dropdown-toggle').dropdown();
    var bodyHeight = $(window).height();
    var convBody = bodyHeight - 164;
    $('.app-message-chats').slimScroll({
        height: convBody,
        size: 9,
        start: 'bottom',
        color: '#a3afb7',
        railOpacity: 0.45,
        wheelStep : 10,
        touchScrollStep : 75,
        allowPageScroll: false
    });
    $('.page-aside-inner ').slimScroll({
        height: convBody,
        size: 5,
        start: 'top',
        color: '#a3afb7',
        railOpacity: 0.2
    });
	
    
    /* Ajax forms */
    $('.ajax-form').ajaxForm({
        target: '.ajax-form-result',
        success: function(data) {
            $('.ajax-form').hide();
        }
    });
    $('.ajax-form-video').ajaxForm({
		beforeSubmit: function() {
			$('.ajax-form-video').validator('validate');
		},
        target: '.ajax-form-result',
        success: function(data) {}
    });
    /* Infinite scroll for videos */
    var $container = $('.loop-content:last');
    if ($('#page_nav').html()) {
        $container.infiniteScroll({
                path: '#page_nav a', 
                append: '.video', 
				status: '.page-load-status',
                history: 'push'
            },
            function(newElements) {
                var $newElems = jQuery(newElements).hide(); // hide to begin with
                // ensure that images load before adding to layout
                $newElems.imagesLoaded(function() {
                    $newElems.fadeIn(); // fade in when ready	
                });
            });
    };
	/* Infinite scroll for comments */
    var $comstainer = $('ul.comments');
    if ($('#page_nav').html()) {
		var $ComsPath = $('#page_nav a').attr("href").slice(0,-1) +'{{#}}';
        $comstainer.infiniteScroll({
				path: '#page_nav a',
                append: '.comment-0', 
				status: '.page-load-status',
				button: '.view-more-button',
				scrollThreshold: false,
                history: false
            },
            function(newElements) {
                var $newElems = jQuery(newElements).hide(); // hide to begin with
                // ensure that images load before adding to layout
                $newElems.imagesLoaded(function() {
                    $newElems.fadeIn(); // fade in when ready										
                });
				
            });
    };
	$comstainer.on( 'append.infiniteScroll', function( ) {	
	$('.tipS').tooltip();
                       $('.deleteCom').on({
						mouseenter: function () {
						   $(this).parent().closest('li').addClass('indanger');
						},
						mouseleave: function () {
							$(this).parent().closest('li').removeClass('indanger');
						}
					   });
	});

    /* Infinite scroll for music */
    var $mcontainer = $('ul.songs');
    if ($('#page_nav').html()) {
        $mcontainer.infiniteScroll({
                history: false,
                path: '#page_nav a', // selector for the NEXT link (to page 2)
                append: 'li.song', // selector for all items you'll retrieve
                bufferPx: 60,
                loading: {
                    msgText: 'Loading next',
                    finishedMsg: 'The End.',
                    img: site_url + 'tpl/main/images/load.gif'
                }
            },
            function(newmElements) {
                var $newmElems = jQuery(newmElements).hide(); // hide to begin with
                // ensure that images load before adding to layout
                $newmElems.imagesLoaded(function() {
                    $newmElems.fadeIn(); // fade in when ready	
                });
            });
    };
  
  
    if ($('#home-content').html()) {
        setTimeout(function() {
            $('.loop-content, .gfluid').removeClass('hide');
            $('.homeLoader').hide();
        }, 600);
    }
	if($('p[class="empty-content"]').html()) {
		$("#imagelist-content").removeClass('hides');
			$(".removeonload").remove();	
		}
    if ($('.gfluid').html()) {
        /* Gallery grid */
      	
		$(".gfluid").imagesLoaded(function() {			
			var $mgrid = $(".gfluid").masonry({
           //columnWidth: $gitem,
           itemSelector: '.image-item',
		   isAnimated: true,
		   stagger: 30
        });
			$("#imagelist-content").removeClass('hides');
			$(".removeonload").remove();
		

        /* Infinite scroll for image gallery */
        var $igcontainer = $('.gfluid');
		var msnry = $mgrid.data('masonry');

        if ($('#page_nav').html() && !$igcontainer.hasClass('noInf')) {
            $igcontainer.infiniteScroll({
                    history: 'push',
                    path: '#page_nav a', 
                    append: '.image-item',
					status: '.page-load-status',
					outlayer: msnry                 
                },
                function(newmElements) {
                    var $newigElems = jQuery(newmElements).hide(); // hide to begin with
                    // ensure that images load before adding to layout
                    $newigElems.imagesLoaded(function() {
                        //$newigElems.fadeIn(); // fade in when ready	
                 $mgrid.masonry().append( elem ).masonry( 'appended', $newigElems ).masonry();
                 $mgrid.masonry('layout');
                    });
                });
        };
		});
        /* End gallery */
    }
	
    /* Size categories */
	if ($('.load-cats').html()) {
	var catType = $('.load-cats').data('type');	
	var catUrl = site_url + 'api/categories?list=' + catType;	
	$(".load-cats").load(catUrl, function() {
    if ($('.cats').html()) {
		$('.NoAvatar').initial({charCount:2}); 
        if ($is_mobile || $is_tablet ) {
		var $size = parseInt($(".cats").width());	
		} else {
        var $size = parseInt($(".cats").width() - 42);
		}
        $('.cats').css({
            right: "-" + $size + "px"
        });
        $('.cats').prepend('<span class="cats-pull opull-left"><i class="material-icons">&#xE314;</i></span>');
        //Cats bar
        $(".cats-pull").click(function() {
            $(".cats").toggleClass("cats-visible");
            if ($(".cats-pull").hasClass("opull-left")) {
                $(".cats").css({
                    right: 0
                });
            } else {
                $('.cats').css({
                    right: "-" + $size + "px"
                });
            }
            $(".cats-pull").toggleClass("opull-left").toggleClass("opull-right");
			$(".cats-pull.opull-left").html('<i class="material-icons">&#xE314;</i>');
			$(".cats-pull.opull-right").html('<i class="material-icons">&#xE315;</i>');
        });
		
        //Cats scroll
        var catsBody = parseInt($(".cats").height() - 2);
        $('.cats-inner').slimScroll({
            height: catsBody,
            size: 5,
            color: '#a3afb7',
            railOpacity: 0.2,
            wheelStep: 10,
            allowPageScroll: false
        });
		
    }
	});	
	 }
    $('#searchform input').blur(function()
    {
        if ($(this).val()) {
            $('#searchform input').removeClass('empty');
        }
        if (!$(this).val()) {
            $('#searchform input').addClass('empty');
        }
    });
    /* END */
});
$(window).resize(function() {
    if ($(window).width() < 1530) {
        $("#sidebar").addClass("hide");
		 $("#wrapper").removeClass('haside');
    }
  
    //Goes both ways
    if ($(window).width() > 1000) {
        if ($(".searchWidget").hasClass("hide")) {
            $(".searchWidget").removeClass("hide");
        }
    }
    //Chat app resize
    var bodyHeight = $(window).height();
    var convBody = bodyHeight - 178;
    $('.app-message-chats').slimScroll({
        height: convBody,
        start: 'bottom'
    });
    $('.page-aside-inner ').slimScroll({
        height: convBody,
        start: 'top'
    });
});
/*! Ripple */
!function(t){t.fn.ripple=function(e){if(this.length>1)return this.each(function(n,i){t(i).ripple(e)});if(e=e||{},this.off(".ripple").data("unbound",!0),e.unbind)return this;var n=function(){return d&&!d.data("unbound")};this.addClass("legitRipple").removeData("unbound").on("tap.ripple",function(e){n()||(d=t(this),w(e.coords))}).on("dragstart.ripple",function(t){g.allowDragging||t.preventDefault()}),t(document).on("move.ripple",function(t){n()&&b(t.coords)}).on("end.ripple",function(){n()&&y()}),t(window).on("scroll.ripple",function(t){n()&&y()});var i,o,a,r,s=function(t){return!!t.type.match(/^touch/)},l=function(t,e){return s(t)&&(t=c(t.originalEvent.touches,e)),[t.pageX,t.pageY]},c=function(e,n){return t.makeArray(e).filter(function(t,e){return t.identifier==n})[0]},p=0,u=function(t){"touchstart"==t.type&&(p=3),"scroll"==t.type&&(p=0);var e=p&&!s(t);return e&&p--,!e};this.on("mousedown.ripple touchstart.ripple",function(e){u(e)&&(i=s(e)?e.originalEvent.changedTouches[0].identifier:-1,o=t(this),a=t.Event("tap",{coords:l(e,i)}),~i?r=setTimeout(function(){o.trigger(a),r=null},g.touchDelay):o.trigger(a))}),t(document).on("mousemove.ripple touchmove.ripple mouseup.ripple touchend.ripple touchcancel.ripple",function(e){var n=e.type.match(/move/);r&&!n&&(clearTimeout(r),r=null,o.trigger(a)),u(e)&&(s(e)?c(e.originalEvent.changedTouches,i):!~i)&&t(this).trigger(n?t.Event("move",{coords:l(e,i)}):"end")}).on("contextmenu.ripple",function(t){u(t)}).on("touchmove",function(){clearTimeout(r),r=null});var d,f,h,m,g={},v=0,x=function(){var n={fixedPos:null,get dragging(){return!g.fixedPos},get adaptPos(){return g.dragging},get maxDiameter(){return Math.sqrt(Math.pow(h[0],2)+Math.pow(h[1],2))/d.outerWidth()*Math.ceil(g.adaptPos?100:200)+"%"},scaleMode:"fixed",template:null,allowDragging:!1,touchDelay:100,callback:null};t.each(n,function(t,n){g[t]=t in e?e[t]:n})},w=function(e){h=[d.outerWidth(),d.outerHeight()],x(),m=e,f=t("<span/>").addClass("legitRipple-ripple"),g.template&&f.append(("object"==typeof g.template?g.template:d.children(".legitRipple-template").last()).clone().removeClass("legitRipple-template")).addClass("legitRipple-custom"),f.appendTo(d),D(e,!1);var n=f.css("transition-duration").split(","),i=[5.5*parseFloat(n[0])+"s"].concat(n.slice(1)).join(",");f.css("transition-duration",i).css("width",g.maxDiameter),f.on("transitionend webkitTransitionEnd oTransitionEnd",function(){t(this).data("oneEnded")?t(this).off().remove():t(this).data("oneEnded",!0)})},b=function(t){var e;if(v++,"proportional"===g.scaleMode){var n=Math.pow(v,v/100*.6);e=n>40?40:n}else if("fixed"==g.scaleMode&&Math.abs(t[1]-m[1])>6)return void y();D(t,e)},y=function(){f.css("width",f.css("width")).css("transition","none").css("transition","").css("width",f.css("width")).css("width",g.maxDiameter).css("opacity","0"),d=null,v=0},D=function(e,n){var i=[],o=g.fixedPos===!0?[.5,.5]:[(g.fixedPos?g.fixedPos[0]:e[0]-d.offset().left)/h[0],(g.fixedPos?g.fixedPos[1]:e[1]-d.offset().top)/h[1]],a=[.5-o[0],.5-o[1]],r=[100/parseFloat(g.maxDiameter),100/parseFloat(g.maxDiameter)*(h[1]/h[0])],s=[a[0]*r[0],a[1]*r[1]],l=g.dragging||0===v;if(l&&"inline"==d.css("display")){var c=t("<span/>").text("Hi!").css("font-size",0).prependTo(d),p=c.offset().left;c.remove(),i=[e[0]-p+"px",e[1]-d.offset().top+"px"]}l&&f.css("left",i[0]||100*o[0]+"%").css("top",i[1]||100*o[1]+"%"),f.css("transform","translate3d(-50%, -50%, 0)"+(g.adaptPos?"translate3d("+100*s[0]+"%, "+100*s[1]+"%, 0)":"")+(n?"scale("+n+")":"")),g.callback&&g.callback(d,f,o,g.maxDiameter)};return this},t.ripple=function(e){t.each(e,function(e,n){t(e).ripple(n)})},t.ripple.destroy=function(){t(".legitRipple").removeClass("legitRipple").add(window).add(document).off(".ripple"),t(".legitRipple-ripple").remove()}}(jQuery);
//Initial plugin
 !function(e){var t=function(e,t){var a,n=e.charCodeAt(t);return 55296>n||n>56319||e.length<=t+1||(a=e.charCodeAt(t+1),56320>a||a>57343)?e[t]:e.substring(t,t+2)},a=function(e,a,n){for(var i,r="",o=0,c=0,d=e.length;d>o;)i=t(e,o),c>=a&&n>c&&(r+=i),o+=i.length,c+=1;return r};e.fn.initial=function(t){var n,i=["#1abc9c","#16a085","#f1c40f","#f39c12","#2ecc71","#27ae60","#e67e22","#d35400","#3498db","#2980b9","#e74c3c","#c0392b","#9b59b6","#8e44ad","#bdc3c7","#34495e","#2c3e50","#95a5a6","#7f8c8d","#ec87bf","#d870ad","#f69785","#9ba37e","#b49255","#b49255","#a94136"];return this.each(function(){var r=e(this),o=e.extend({name:"Name",color:null,seed:0,charCount:1,textColor:"#ffffff",height:100,width:100,fontSize:60,fontWeight:400,fontFamily:"HelveticaNeue-Light,Helvetica Neue Light,Helvetica Neue,Helvetica, Arial,Lucida Grande, sans-serif",radius:0},t);o=e.extend(o,r.data());var c=a(o.name,0,o.charCount).toUpperCase(),d=e('<text text-anchor="middle"></text>').attr({y:"50%",x:"50%",dy:"0.35em","pointer-events":"auto",fill:o.textColor,"font-family":o.fontFamily}).html(c).css({"font-weight":o.fontWeight,"font-size":o.fontSize+"px"});if(null==o.color){var h=Math.floor((c.charCodeAt(0)+o.seed)%i.length);n=i[h]}else n=o.color;var f=e("<svg></svg>").attr({xmlns:"http://www.w3.org/2000/svg","pointer-events":"none",width:o.width,height:o.height}).css({"background-color":n,width:o.width+"px",height:o.height+"px","border-radius":o.radius+"px","-moz-border-radius":o.radius+"px"});f.append(d);var l=window.btoa(unescape(encodeURIComponent(e("<div>").append(f.clone()).html())));r.attr("src","data:image/svg+xml;base64,"+l)})}}(jQuery);
// jquery.alertable.js - Minimal alert, confirmation, and prompt alternatives.  Developed by Cory LaViska for A Beautiful Site, LLC
// alert
jQuery&&function(e){"use strict";function t(t,u,s){var d=e.Deferred();return i=document.activeElement,i.blur(),e(l).add(r).remove(),s=e.extend({},e.alertable.defaults,s),l=e(s.modal).hide(),r=e(s.overlay).hide(),n=e(s.okButton),o=e(s.cancelButton),s.html?l.find(".alertable-message").html(u):l.find(".alertable-message").text(u),"prompt"===t?l.find(".alertable-prompt").html(s.prompt):l.find(".alertable-prompt").remove(),e(l).find(".alertable-buttons").append("alert"===t?"":o).append(n),e(s.container).append(r).append(l),s.show.call({modal:l,overlay:r}),"prompt"===t?e(l).find(".alertable-prompt :input:first").focus():e(l).find(':input[type="submit"]').focus(),e(l).on("submit.alertable",function(r){var n,o,i=[];if(r.preventDefault(),"prompt"===t)for(o=e(l).serializeArray(),n=0;n<o.length;n++)i[o[n].name]=o[n].value;else i=null;a(s),d.resolve(i)}),o.on("click.alertable",function(){a(s),d.reject()}),e(document).on("keydown.alertable",function(e){27===e.keyCode&&(e.preventDefault(),a(s),d.reject())}),e(document).on("focus.alertable","*",function(t){e(t.target).parents().is(".alertable")||(t.stopPropagation(),t.target.blur(),e(l).find(":input:first").focus())}),d.promise()}function a(t){t.hide.call({modal:l,overlay:r}),e(document).off(".alertable"),l.off(".alertable"),o.off(".alertable"),i.focus()}var l,r,n,o,i;e.alertable={alert:function(e,a){return t("alert",e,a)},confirm:function(e,a){return t("confirm",e,a)},prompt:function(e,a){return t("prompt",e,a)},defaults:{container:"body",html:!1,cancelButton:'<button class="alertable-cancel btn btn-default" type="button">Cancel</button>',okButton:'<button class="alertable-ok btn btn-primary" type="submit">OK</button>',overlay:'<div class="alertable-overlay"></div>',prompt:'<input class="alertable-input" type="text" name="value">',modal:'<form class="alertable"><div class="alertable-message"></div><div class="alertable-prompt"></div><div class="alertable-buttons"></div></form>',hide:function(){e(this.modal).add(this.overlay).fadeOut(100)},show:function(){e(this.modal).add(this.overlay).fadeIn(100)}}}}(jQuery);
/*!
 * @preserve  *  * Readmore.js jQuery plugin  * Author: @jed_foster  * Project home: http://jedfoster.github.io/Readmore.js
 * Licensed under the MIT license  *  * Debounce function from http://davidwalsh.name/javascript-debounce-function  */
!function(t){"function"==typeof define&&define.amd?define(["jquery"],t):"object"==typeof exports?module.exports=t(require("jquery")):t(jQuery)}(function(t){"use strict";function e(t,e,i){var o;return function(){var n=this,a=arguments,s=function(){o=null,i||t.apply(n,a)},r=i&&!o;clearTimeout(o),o=setTimeout(s,e),r&&t.apply(n,a)}}function i(t){var e=++h;return String(null==t?"rmjs-":t)+e}function o(t){var e=t.clone().css({height:"auto",width:t.width(),maxHeight:"none",overflow:"hidden"}).insertAfter(t),i=e.outerHeight(),o=parseInt(e.css({maxHeight:""}).css("max-height").replace(/[^-\d\.]/g,""),10),n=t.data("defaultHeight");e.remove();var a=o||t.data("collapsedHeight")||n;t.data({expandedHeight:i,maxHeight:o,collapsedHeight:a}).css({maxHeight:"none"})}function n(t){if(!d[t.selector]){var e=" ";t.embedCSS&&""!==t.blockCSS&&(e+=t.selector+" + [data-readmore-toggle], "+t.selector+"[data-readmore]{"+t.blockCSS+"}"),e+=t.selector+"[data-readmore]{transition: height "+t.speed+"ms;overflow: hidden;}",function(t,e){var i=t.createElement("style");i.type="text/css",i.styleSheet?i.styleSheet.cssText=e:i.appendChild(t.createTextNode(e)),t.getElementsByTagName("head")[0].appendChild(i)}(document,e),d[t.selector]=!0}}function a(e,i){this.element=e,this.options=t.extend({},r,i),n(this.options),this._defaults=r,this._name=s,this.init(),window.addEventListener?(window.addEventListener("load",c),window.addEventListener("resize",c)):(window.attachEvent("load",c),window.attachEvent("resize",c))}var s="readmore",r={speed:100,collapsedHeight:200,heightMargin:16,moreLink:'<a href="#">Read More</a>',lessLink:'<a href="#">Close</a>',embedCSS:!0,blockCSS:"display: block; width: 100%;",startOpen:!1,blockProcessed:function(){},beforeToggle:function(){},afterToggle:function(){}},d={},h=0,c=e(function(){t("[data-readmore]").each(function(){var e=t(this),i="true"===e.attr("aria-expanded");o(e),e.css({height:e.data(i?"expandedHeight":"collapsedHeight")})})},100);a.prototype={init:function(){var e=t(this.element);e.data({defaultHeight:this.options.collapsedHeight,heightMargin:this.options.heightMargin}),o(e);var n=e.data("collapsedHeight"),a=e.data("heightMargin");if(e.outerHeight(!0)<=n+a)return this.options.blockProcessed&&"function"==typeof this.options.blockProcessed&&this.options.blockProcessed(e,!1),!0;var s=e.attr("id")||i(),r=this.options.startOpen?this.options.lessLink:this.options.moreLink;e.attr({"data-readmore":"","aria-expanded":this.options.startOpen,id:s}),e.after(t(r).on("click",function(t){return function(i){t.toggle(this,e[0],i)}}(this)).attr({"data-readmore-toggle":s,"aria-controls":s})),this.options.startOpen||e.css({height:n}),this.options.blockProcessed&&"function"==typeof this.options.blockProcessed&&this.options.blockProcessed(e,!0)},toggle:function(e,i,o){o&&o.preventDefault(),e||(e=t('[aria-controls="'+this.element.id+'"]')[0]),i||(i=this.element);var n=t(i),a="",s="",r=!1,d=n.data("collapsedHeight");n.height()<=d?(a=n.data("expandedHeight")+"px",s="lessLink",r=!0):(a=d,s="moreLink"),this.options.beforeToggle&&"function"==typeof this.options.beforeToggle&&this.options.beforeToggle(e,n,!r),n.css({height:a}),n.on("transitionend",function(i){return function(){i.options.afterToggle&&"function"==typeof i.options.afterToggle&&i.options.afterToggle(e,n,r),t(this).attr({"aria-expanded":r}).off("transitionend")}}(this)),t(e).replaceWith(t(this.options[s]).on("click",function(t){return function(e){t.toggle(this,i,e)}}(this)).attr({"data-readmore-toggle":n.attr("id"),"aria-controls":n.attr("id")}))},destroy:function(){t(this.element).each(function(){var e=t(this);e.attr({"data-readmore":null,"aria-expanded":null}).css({maxHeight:"",height:""}).next("[data-readmore-toggle]").remove(),e.removeData()})}},t.fn.readmore=function(e){var i=arguments,o=this.selector;return e=e||{},"object"==typeof e?this.each(function(){if(t.data(this,"plugin_"+s)){var i=t.data(this,"plugin_"+s);i.destroy.apply(i)}e.selector=o,t.data(this,"plugin_"+s,new a(this,e))}):"string"==typeof e&&"_"!==e[0]&&"init"!==e?this.each(function(){var o=t.data(this,"plugin_"+s);o instanceof a&&"function"==typeof o[e]&&o[e].apply(o,Array.prototype.slice.call(i,1))}):void 0}});
 
var $header = $('.fixed-top'),
    scrollClass = 'on-scroll',
    activateAtY = 125;

function deactivateHeader() {
    if (!$header.hasClass(scrollClass)) {
        $header.addClass(scrollClass);
		$('body').addClass('noheader');
    }
}

function activateHeader() {
    if ($header.hasClass(scrollClass)) {
        $header.removeClass(scrollClass);
		$('body').removeClass('noheader');
    }
}

$(window).scroll(function() {
    if($(window).scrollTop() > activateAtY) {
        deactivateHeader();
    } else {
        activateHeader();
    }
});
/* Doc ready*/
$(document).ready(function() {
	$('.icon-material,button:not(".vjs-control"):not(".vjs-button"), a.btn').ripple();
	if($(window).width() < 1000) {
		$('body').addClass('isdevice');			
    }
	
	
    //Process image errors
    $('img').error(function() {
         $(this).removeAttr("src").data('name', 'X').addClass("NoAvatar");
    });
	 var rougueAvatars = $('img[src*="def-avatar.jpg"]');
	 $.each( rougueAvatars, function( key, value ) {
	 $(this).removeAttr("src").addClass("NoAvatar");	  
     });
	 $('.NoAvatar').initial({charCount:2}); 
	 //Notifs
    $.getJSON(site_url + "api/noty/", function(data) {
        if (data) {
            if(data.msg) {
            $("li.my-inbox > a").append('<span class="badge badge-danger pull-right">'+ data.msg + '</span>');
			}	
            if(data.buzz) {
			$("a#notifs").append('<span class="badge badge-primary">'+ data.buzz + '</span>');
			}
			 var $da =  parseInt(data.msg);
			 var $db =  parseInt(data.buzz);
             var $dc = 	$da + $db;		
			if($dc > 0) {
			$("a#openusr").prepend('<span class="badge badge-success pull-right">'+ $dc + '</span>');
			}
        }
    }).error(function(jqXHR, textStatus, errorThrown) {
        console.log("error " + textStatus);
        console.log("incoming Text " + jqXHR.responseText);
    });
	
	// Hide owl on mobiles	
    $(".owl-carousel").owlCarousel({
	  responsiveClass:true,
        items: 1,
        navigation: true,
		navText: ["<i class='material-icons icon-white'>&#xE314;</i>","<i class='material-icons icon-white'>&#xE315;</i>"],
		loop : true,
		 lazyLoad:true,
       responsive:{
        0:{
            items:1,
            nav:true
        },
		460:{
            items:2,
            nav:true
        },
        668:{
            items:3,
            nav:true
        },
		920:{
            items:4,
            nav:true
        },
        1200:{
            items:5,
            nav:true,
            loop:true
        }
		,
        1600:{
            items:6,
            nav:true,
            loop:true
        }
    }
    });
    if ($(window).width() < 1530) {
        $("#sidebar").addClass("hide");
		 $("#wrapper").removeClass('haside');
    }
   
    //Chat
	
$("#insertChat").emojioneArea({
    standalone: false,
	 inline: true,
	 hideSource: true,
        autocomplete: true,
		useSprite: false,
		shortnames : true,
		filtersPosition: "bottom"
});
    $(".emoji-holder > img").click(function() {
        var emojiT = $(this).attr('title');
        var currentText = $('textarea#insertChat').val();
        $('textarea#insertChat').val(currentText + " :" + emojiT + ": ")
    });
    $("#sendChat").click(function() {
          if ($('textarea#insertChat').val()) {
            var conv = $('.chats').attr("id");
			if ($('textarea#insertChat').parent().find(".emoj-editor").length > 0){
	   var initialTxt = $('textarea#insertChat').parent().find(".emoj-editor").html();		
       var toAddTXT = encodeURIComponent(String.fromHtmlEntities(initialTxt));
	   $('textarea#insertChat').parent().find(".emoj-editor").html('');
		} else {
		var initialTxt =	$('textarea#insertChat').val();
		var toAddTXT = encodeURIComponent(initialTxt);
		}	

            var fakebody = '<div class="chat chat-left animated rollIn">' + $(".dummy-chat").html() + '</div>';
            $('.chats').append(fakebody);
            $(".chat-content:last").html("<p>" + initialTxt + "</p>");
            $('.app-message-chats').slimscroll({
                scrollBy: '39px',
				 start: 'bottom'
            });
           
            $('.tipS').tooltip();
			
            $.post(
                site_url + 'lib/ajax/reply.php', {
                    message: toAddTXT,
                    conversation: conv
                },
                function(data) {
                    if (data.ok > 0) {
                        $('textarea#insertChat').val('');
						$('textarea#insertChat').parent().find(".emoj-editor").html('')
                    } else {
                        $(".chat-content:last").addClass("errored");
                    }
                }, "json");
        } else {
            $('#insertChat').focus();
        }
        return false;
    });
    
    //Kill ad
    $(".close-ad").click(function() {
        $(this).closest(".adx").hide();
    });
    //Add to
    $("#addtolist").click(function() {
        $("#bookit").slideToggle();
    });
    //Disabled comments
    $('textarea#addDisable').on("focus", function() {
        showLogin();
    });
	$('textarea#addDisable').change(function(){
		showLogin();
     });
	$('.deleteCom').on({
    mouseenter: function () {
       $(this).parent().closest('li').addClass('indanger');
    },
    mouseleave: function () {
        $(this).parent().closest('li').removeClass('indanger');
    }
   });
    //Show more desc
    $('#media-description').readmore({
     speed: 75,
	 collapsedHeight: 80,
     moreLink: '<a href="#" class="readmore">'+ $('#media-description').data("small") +' <i class="material-icons">&#xE313;</i></a>',
	 lessLink: '<a href="#" class="readmore">'+ $('#media-description').data("big") +' <i class="material-icons">&#xE316;</i></a>'
    });
	
     //Mobi Share
    $("#social-share").click(function() {
        $(".sharing-icos").toggleClass('hide');
    });
    //Chat handler
    $(".page-aside-switch , page-aside-switch > i").click(function() {
        $(".page-aside").toggleClass('open');
    });
    //Sidebar 
    $("#show-sidebar").click(function() {
        $("#sidebar").toggleClass('hide');
        $("#wrapper").toggleClass('haside');
        if (!$("#sidebar").hasClass("hide")) {
            var sideSpace = parseInt($("#wrapper").offset().left);
            if (sideSpace < 240) {
                $("#wrapper").css({
                    "margin-left": "240px",
                    "margin-right": "auto"
                });
            }
        } else {
            var sideSpace = $("#wrapper").offset().left;
            if (sideSpace == 240) {
                $("#wrapper").css({
                    "margin-left": "auto",
                    "margin-right": "auto"
                });
            }
        }
    });
    if (!$("#sidebar").hasClass("hide")) {
        var sideSpace = $("#wrapper").offset().left;
        if (sideSpace < 240) {
            $("#wrapper").css({
                "margin-left": "240px",
                "margin-right": "auto"
            }).addClass('haside');
        }
		 
    }
    //End sidebar
  
    //VideoPlayer Container
    var vpWidth = $('.video-player').width();
    var vpHeight = Math.round((vpWidth / 16) * 9);
	//Related & Lists
    $(".video-player").css("min-height", vpHeight);
    var vh = $("#video-content").height() - 2;	
	if ($('.video-player-sidebar').html()) {
	var RRUrl = $('.ajaxreqList').data('url');	
	var RUrl = site_url + 'api/' + RRUrl;	
	$(".ajaxreqList").load(RUrl, function() {
	$(".ajaxreqList").contents().unwrap();	
      if ($(window).width() < 600) {        
        $('.items').slimScroll({
            height: 280,
			start: $('li#playingNow'),
			size: 5,
		    railVisible: true,
            railOpacity: '0.9',
            color: '#c6c6c6',
            railColor: '#f5f5f5',
		    wheelStep : 22
        });
    } else {        
        $('.items').slimScroll({
            height: vh,
			start: $('li#playingNow'),
			size: 5,
		    railVisible: true,
            railOpacity: '0.9',
            color: '#c6c6c6',
            railColor: '#f5f5f5',
		    wheelStep : 12
        });
    }
	//Get next in playlist
	if($("li#playingNow").html()) {	
	var nextPlayed = $("li#playingNow").next().find("a.clip-link");
	$('#ComingNext').attr('href',nextPlayed.attr("href"));
	$('#ComingNext').attr('data-original-title', nextPlayed.attr("title"));
	}
    });	 	
	}
	if ($('.ajaxreqRelated').html()) {		
	var RRUrl = $('.ajaxreqRelated').data('url');

	var RUrl = site_url + 'api/' + RRUrl;	
	$(".ajaxreqRelated").load(RUrl, function(data) {
	if ($(window).width() < 990) {
       var $mobiR = $('.related').clone();
        $('.related-mobi').prepend($mobiR);
		$('.rur').remove();
		$('.related li:nth-child(8)').nextAll().addClass('hide');
	}	
	$(".ajaxreqRelated").contents().unwrap();	
	    //Autoplay
	
	$('#autoplayHandler').change(function(){
		$.get( site_url + "api/autoplay/" );		
		if($(".PlayUP").is("#autoplay")) {
		$(".PlayUP").attr("id","NoAuto");	
		} else {
		$(".PlayUP").attr("id","autoplay");	
		}
	});
	var $autoR = $('li.AutoplHold').clone();
	$( "li.AutoplHold").addClass('toRemoveLI');	
	$( "li.toRemoveLI").remove();
    $('.related ul:first-of-type').prepend($autoR);	
    });	 	
	}
	
	//Show more related
    $("#revealRelated").click(function() {
		$('.related li:nth-child(8)').nextAll().toggleClass('hide');
		$("#revealRelated > span").toggleClass('hide');
    });
	
	if (!$('.ajaxreqRelated').html()) {
		if ($(window).width() < 990) {
		var $mobiR = $('.related').clone();
        $('.related-mobi').prepend($mobiR);
		$('.rur').remove();
		$('.related li:nth-child(8)').nextAll().addClass('hide');
	}
	}
	
	var $autoR = $('li.AutoplHold').clone();
	$( "li.AutoplHold" ).remove();
	$('.related ul').prepend($autoR);
	
	if ($(window).width() < 990) {
	   var hinit = $('.vibe-interactions > h1').html();
	   $('ul#media-info').parent('.mtop10').addClass('hide');
	   $('.vibe-interactions > h1').html(hinit + '<a href="javascript:void(0)" class="description-pull pull-right"><i class="material-icons mpulldown"></i></a>');
       $(".description-pull").click(function() {
	   $("ul#media-info").parent('.mtop10').toggleClass("hide");
       $(".description-pull > i").toggleClass("mpullup").toggleClass("mpulldown");
	   $('#media-description').readmore({
		 speed: 75,
		 collapsedHeight: 80,
		 moreLink: '<a href="#" class="readmore">'+ $('#media-description').data("small") +' <i class="material-icons">&#xE313;</i></a>',
		 lessLink: '<a href="#" class="readmore">'+ $('#media-description').data("big") +' <i class="material-icons">&#xE316;</i></a>'
		});
	   });
       $('.sharing-icos').addClass('hide');     
       var $listH = $('.playlistvibe').clone();
	   $('#ListRelated').prepend($listH);
	   $('#LH, .fullit').remove();
	   $('.next-an').html('');
	   $('.next-an').html('<a href="javascript:void(0)" class="vlist-pull"><i class="material-icons mpullup"></i></a>');
       $(".vlist-pull").click(function() {
	   $("#ListRelated > .video-player-sidebar").toggleClass("hide");
       $(".vlist-pull > i").toggleClass("mpullup").toggleClass("mpulldown");
	   });  
	}
	if ($(window).width() < 800) {
        $('.scroll-items').slimScroll({
            height: 280,
			wheelStep : 20
        });      
    } else {
        $('.scroll-items').slimScroll({
            height: 340,
			wheelStep : 10
        });       
    }
	  var sum = 0;
	   $('li#playingNow').prevAll().each(function() {
	   sum += 66;
	   }); 
	   sum = sum - 190; 
	   $('.items').animate({scrollTop: sum}, 'slow');
	//Autoplay for non-ajax
	$('#autoplayHandler').change(function(){
		$.get( site_url + "api/autoplay/" );		
		if($(".PlayUP").is("#autoplay")) {
		$(".PlayUP").attr("id","NoAuto");	
		} else {
		$(".PlayUP").attr("id","autoplay");	
		}
	});
   //Fill the screen
    $(".fullit").click(function() {
        $(".video-holder").toggleClass('gofullscreen');	   
    });
	  
	   
	var sidebarsh = screen.height - 67;
    $('.sidescroll').slimScroll({
        height: sidebarsh,
        position: 'right',
        size: 5,
		railVisible: true,
        railOpacity: '0.66',
        color: '#c6c6c6',
        railColor: '#f5f5f5',
		wheelStep : 12
    });
	//Emoji
	$(".addEmComment").emojioneArea({
        hideSource: true,
        autocomplete: true,
		useSprite: false,
		shortnames : true,
		filtersPosition: "bottom"
      });
	//Table checks
	$('#DashContent .check-all').click(function(){
		var parentTable = $('.content--items');										   
		var ch = parentTable.find('input[type=checkbox]');										 
		if($(this).is(':checked')) {
		
			//check all rows in table
			ch.each(function(){ 
				$(this).attr('checked',true);
				
			});
						
			//check both table header and footer
			parentTable.find('.check-all').each(function(){ $(this).attr('checked',true); });
		
		} else {
			
			//uncheck all rows in table
			ch.each(function(){ 
				$(this).attr('checked',false); 
				$(this).parent().removeClass('checked');	//used for the custom checkbox style
				$(this).parents('tr').removeClass('selected');
			});	
			
			//uncheck both table header and footer
			parentTable.find('.check-all').each(function(){ $(this).attr('checked',false); });
		}
	});
    $(".backtotop").addClass("hidden");
    $(window).scroll(function() {
        if ($(this).scrollTop() === 0) {
            $(".backtotop").addClass("hidden")
        } else {
            $(".backtotop").removeClass("hidden")
        }
    });
    $('.backtotop').click(function() {
        $('body,html').animate({
            scrollTop: 0
        }, 1200);
        return false;
    });
    $('.form-material').each(function() {
        var $this = $(this);
        if ($this.data('material') === true) {
            return;
        }
        var $control = $this.find('.form-control');
        // Add hint label if required
        if ($control.attr("data-hint")) {
            $control.after("<div class=hint>" + $control.attr("data-hint") + "</div>");
        }
        if ($this.hasClass("floating")) {
            // Add floating label if required
            if ($control.hasClass("floating-label")) {
                var placeholder = $control.attr("placeholder");
                $control.attr("placeholder", null).removeClass("floating-label");
                $control.after("<div class=floating-label>" + placeholder + "</div>");
            }
            // Set as empty if is empty
            if ($control.val() === null || $control.val() == "undefined" || $control.val() === "") {
                $control.addClass("empty");
            }
        }
        // Support for file input
        if ($control.next().is("[type=file]")) {
            $this.addClass('form-material-file');
        }
        $this.data('material', true);
    });
    $('.form-material-file [type=file]').on("focus", function() {
        $(".form-material-file .form-control").addClass("focus");
    });
    $('.form-material-file [type=file]').on("blur", function() {
        $(".form-material-file .form-control").removeClass("focus");
    });
    $('.form-material-file [type=file]').on("change", function() {
        var value = "";
        $.each($(this)[0].files, function(i, file) {
            value += file.name + ", ";
        });
        value = value.substring(0, value.length - 2);
        if (value) {
            $(this).prev().removeClass("empty");
        } else {
            $(this).prev().addClass("empty");
        }
        $(this).prev().val(value);
    });
    $('.form-control').on("keyup", function() {
        var $this = $(this);
        if ($this.val() === "") {
            $this.addClass("empty");
        } else {
            $this.removeClass("empty");
        }
    });
	
	
$('#CustomWidth').keyup(function() {
modIframeW($(this).val());	
});	
$('#CustomHeight').keyup(function() {
modIframeH($(this).val());	
});	
$("input:radio[name=changeEmbed]").click(function() {
    var value = $(this).val();
	 switch (value) {
        case '1':
          modIframeW(1920);
          modIframeH(1080);
          break;
        case '2':
          modIframeW(1280);
          modIframeH(720);
          break;
        case '3':
         modIframeW(854);
         modIframeH(480);
          break;
        case '4':
         modIframeW(640);
         modIframeH(360);
          break;
        default:
          modIframeW(426);
          modIframeH(240);
      }
});	
	
	
    /* End document ready */
});
function SearchSwitch(com) {	
	$('input#switch-com').val(com);
	//alert($('a#s-' +com + ' > i').html());
	var $button = $('a#s-' +com + ' > i').clone();
	$('a#switch-search').html($button);
}
function iHeartThis(vid) {
    $.post(
        site_url + 'lib/ajax/heart.php', {
            video_id: vid,
            type: 1
        },
        function(data) {   
            var $hearts = $('#i-like-it > span').html();
			$hearts = $hearts.replace(/[^0-9\.]/g, '').trim();
            var decH = $hearts-1;			
            var a = JSON.parse(data);
			if(a.type == 1) {
			$('#i-like-it').addClass('done-like');	
			$('#i-like-it > span').html(++$hearts)
			} else {
			$('#i-like-it').removeClass('done-like');	
			$('#i-like-it > span').html(decH)
			}
		   $.notify(a.title + ' ' + a.text);
        });
}
function iLikeThis(vid) {
	if($('#i-like-it').hasClass('done-like')) {
	RemoveLike(vid);	
	} else {
    $.post(
        site_url + 'lib/ajax/like.php', {
            video_id: vid,
            type: 1
        },
        function(data) {            
            var a = JSON.parse(data);          
			if(typeof a.added != 'undefined') {
			var ahandler = a.added;
			} else {
			var ahandler = 0;
			}
			if(ahandler == "1") {
			$('#i-like-it').addClass('done-like');	
			var likesNr = $('#i-like-it > span').text();
			likesNr = likesNr.replace(/[^0-9\.]/g, '').trim();
			$('#i-like-it > span').html(++likesNr);
			}
		 $.notify(a.title + ' ' + a.text);	
        });
}
}
function iHateThis(vid) {
	if(!$('#i-dislike-it').hasClass('done-dislike')) {
    $.post(
        site_url + 'lib/ajax/like.php', {
            video_id: vid,
            type: 2
        },
        function(data) {
           
            var a = JSON.parse(data);
         	$.notify(a.title + ' ' + a.text);
			//console.log(a);
			var likesNr = $('#i-dislike-it > span').text();
			likesNr = likesNr.replace(/[^0-9\.]/g, '').trim();
			if(typeof a.added != 'undefined') {
			var ahandler = a.added;
			} else {
			var ahandler = 0;
			}
			if(ahandler == "2") {
			$('#i-dislike-it > span').html(likesNr -1);
            $('#i-dislike-it').removeClass('done-dislike');			
			} else if (ahandler == "3") {
			 $('#i-dislike-it > span').html(++likesNr);
			  $('#i-dislike-it').addClass('done-dislike');
			}
			
        });
}
}
function DOtrackview(vid) {
    $.post(site_url + 'lib/ajax/track.php', {
            video_id: vid
        },
        function(data) {
            //console.log(data);	
        }
    );
}
function DOtrackviewIMG(vid) {
    $.post(site_url + 'lib/ajax/track-img.php', {
            video_id: $.trim(vid)
        },
        function(data) {
            console.log(data);	
        }
    );
}
function Padd(vid, pid) {
    $.post(
        site_url + 'lib/ajax/addto.php', {
            video_id: vid,
            playlist: pid
        },
        function(data) {
            var a = JSON.parse(data);
            $.notify(a.title + ' ' + a.text);
            if ($('li#PAdd-' + pid).html()) {
                $('li#PAdd-' + pid).remove();
            }
            if ($('#video-' + vid).html()) {
                $('#video-' + vid + ' a.laterit').remove();
            }
        });
}
function ReplyCom(cid) {
    $('li#' + cid).toggleClass('hide');
}
function RemoveLike(vid) {
    $.post(
        site_url + 'lib/ajax/dislike.php', {
            video_id: vid,
            type: 1
        },
        function(data) {
			if($('#i-like-it').hasClass('done-like')) {
			 var a = JSON.parse(data);
            $.notify(a.title + ' ' + a.text);	
			}
            $('#i-like-it').removeClass('isLiked').removeClass('done-like');           
			 var likesNr = $('#i-like-it > span').text();	
			 if(likesNr >= 1) {
			 $('#i-like-it > span').html(likesNr - 1);
			 }
        });
}

function showLogin() {
    $('#login-now').modal('toggle');
}
function Subscribe(user, type) {
	
    $.post(
        site_url + 'lib/ajax/subscribe.php', {
            the_user: user,
            the_type: type
        },
        function(data) {
            var a = JSON.parse(data);
            $.notify(a.title + ' ' + a.text);
			if($('#subscribe-' + user).attr('data-next')){
		    $('#subscribe-' + user).text($('#subscribe-' + user).data('next'));
	        }
        });
}
String.fromHtmlEntities = function(string) {
    return (string+"").replace(/&#\d+;/gm,function(s) {
        return String.fromCharCode(s.match(/\d+/gm)[0]);
    })
};
function addEMComment(oid, toid) {
    if ($('textarea#addEmComment_' + toid).val()) {
		if ($('textarea#addEmComment_' + toid).parent().find(".emoj-editor").length > 0){
	   var initialTxt = $('textarea#addEmComment_' + toid).parent().find(".emoj-editor").html();		
       var toAddTXT = encodeURIComponent(String.fromHtmlEntities(initialTxt));
	   $('textarea#addEmComment_' + toid).parent().find(".emoj-editor").html('');
		} else {
		var initialTxt =	$('textarea#addEmComment_' + toid).val();
		var toAddTXT = encodeURIComponent(initialTxt);
		}	

        $.post(
            site_url + 'lib/ajax/addComment.php', {
                comment: toAddTXT,
                object_id: oid,
                reply: toid
            },
            function(data) {				
                $('#emContent_' + oid + '-' + toid + ' li:first').after('<li id="comment-' + data.id + '" class="left animated rollIn"><img class="avatar" src="' + data.image + '" /><div class="message"><span class="arrow"> </span><a class="name" href="' + data.url + '">' + data.name + '</a> <span class="date-time"> ' + data.date + ' </span> <div class="body"></div> </div></li>');
				var shtml = data.text;
				$('#comment-' + data.id).find('.body').html(shtml);
				$('textarea#addEmComment_' + toid).val('');
                
            }, "json");
    } else {
        $('#addEmComment_' + toid).focus();
    }
    return false;
}
function iLikeThisComment(cid) {
    $.post(
        site_url + 'lib/ajax/likeComment.php', {
            comment_id: cid
        },
        function(data) {
            $('#iLikeThis_' + cid + '> a').remove();
            $('#iLikeThis_' + cid + '> .tooltip').remove();
            $('#iLikeThis_' + cid).prepend(data.text + '! &nbsp;');
        }, "json");
}
function DeleteThisComment(id,key) {
	$.alertable.confirm(delete_com_text).then(function() {
    RemoveThisComment(id,key);
    });
}
function RemoveThisComment(id,key) {	
    $.post(
        site_url + 'lib/ajax/delComment.php', {
           key: key,
		   id : id
        },
        function(data) {
            $('li#comment-id-' + id).hide("slow", function(){ $(this).remove()});
        }, "json");
}
function processVid(file) {
    $('#vfile').val(file);
    $('#Subtn').prop('disabled', false).html('Save').addClass("btn-success");
}
function DOtrackview(vid) {
    $.post(site_url + 'lib/ajax/track.php', {
            video_id: vid
        },
        function(data) {
            //console.log(data);	
        }
    );
}
function modIframeW(w){
var str = $('#share-embed-code-small').val();                        
str = str.replace(/width="[\s\S]*?"/, 'width="'+ w +'"');
$('#share-embed-code-small').val(str);
}
function modIframeH(h){
var str = $('#share-embed-code-small').val();                        
str = str.replace(/height="[\s\S]*?"/, 'height="'+ h +'"');	
$('#share-embed-code-small').val(str);
}