/* *********************************************************************************
 * Weaver II JavaScript support Library
 *
 * Author: WeaverTheme - www.weavertheme.com
 * @version 2.0
 * @license GNU Lesser General Public License, http://www.gnu.org/copyleft/lesser.html
 * @author  Bruce Wampler
 *
 * Notes - this library requires jQuery to be loaded
 *  this library was cobbled together over a long period of time, so it contains a
 *  bit of a jumble of straight JavaScript and jQuery calls. So it goes. It works.
 *
 *
 *	(CSS minimization by YUI Compressor.)
 ************************************************************************************* */
/* superfish for desktop - file combines hoverintent.js  + superfish.js + desktop code */
(function($){
	/* hoverIntent by Brian Cherne */
	$.fn.hoverIntent = function(f,g) {
		// default configuration options
		var cfg = {
			sensitivity: 7,
			interval: 100,
			timeout: 0
		};
		// override configuration options with user supplied object
		cfg = $.extend(cfg, g ? { over: f, out: g } : f );

		// instantiate variables
		// cX, cY = current X and Y position of mouse, updated by mousemove event
		// pX, pY = previous X and Y position of mouse, set by mouseover and polling interval
		var cX, cY, pX, pY;

		// A private function for getting mouse position
		var track = function(ev) {
			cX = ev.pageX;
			cY = ev.pageY;
		};

		// A private function for comparing current and previous mouse position
		var compare = function(ev,ob) {
			ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
			// compare mouse positions to see if they've crossed the threshold
			if ( ( Math.abs(pX-cX) + Math.abs(pY-cY) ) < cfg.sensitivity ) {
				$(ob).unbind("mousemove",track);
				// set hoverIntent state to true (so mouseOut can be called)
				ob.hoverIntent_s = 1;
				return cfg.over.apply(ob,[ev]);
			} else {
				// set previous coordinates for next time
				pX = cX; pY = cY;
				// use self-calling timeout, guarantees intervals are spaced out properly (avoids JavaScript timer bugs)
				ob.hoverIntent_t = setTimeout( function(){compare(ev, ob);} , cfg.interval );
			}
		};

		// A private function for delaying the mouseOut function
		var delay = function(ev,ob) {
			ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t);
			ob.hoverIntent_s = 0;
			return cfg.out.apply(ob,[ev]);
		};

		// A private function for handling mouse 'hovering'
		var handleHover = function(e) {
			// next three lines copied from jQuery.hover, ignore children onMouseOver/onMouseOut
			var p = (e.type == "mouseover" ? e.fromElement : e.toElement) || e.relatedTarget;
			while ( p && p != this ) { try { p = p.parentNode; } catch(e) { p = this; } }
			if ( p == this ) { return false; }

			// copy objects to be passed into t (required for event object to be passed in IE)
			var ev = jQuery.extend({},e);
			var ob = this;

			// cancel hoverIntent timer if it exists
			if (ob.hoverIntent_t) { ob.hoverIntent_t = clearTimeout(ob.hoverIntent_t); }

			// else e.type == "onmouseover"
			if (e.type == "mouseover") {
				// set "previous" X and Y position based on initial entry point
				pX = ev.pageX; pY = ev.pageY;
				// update "current" X and Y position based on mousemove
				$(ob).bind("mousemove",track);
				// start polling interval (self-calling timeout) to compare mouse coordinates over time
				if (ob.hoverIntent_s != 1) { ob.hoverIntent_t = setTimeout( function(){compare(ev,ob);} , cfg.interval );}

			// else e.type == "onmouseout"
			} else {
				// unbind expensive mousemove event
				$(ob).unbind("mousemove",track);
				// if hoverIntent state is true, then call the mouseOut function after the specified delay
				if (ob.hoverIntent_s == 1) { ob.hoverIntent_t = setTimeout( function(){delay(ev,ob);} , cfg.timeout );}
			}
		};

		// bind the function to the two event listeners
		return this.mouseover(handleHover).mouseout(handleHover);
	};

})(jQuery);

/*
 * Superfish v1.4.8 - jQuery menu widget
 * Copyright (c) 2008 Joel Birch
 *
 * Dual licensed under the MIT and GPL licenses:
 * 	http://www.opensource.org/licenses/mit-license.php
 * 	http://www.gnu.org/licenses/gpl.html
 *
 * CHANGELOG: http://users.tpg.com.au/j_birch/plugins/superfish/changelog.txt
 */

(function($){
	$.fn.superfish = function(op){

		var sf = $.fn.superfish,
			c = sf.c,
			$arrow = $(['<span class="',c.arrowClass,'"> &#187;</span>'].join('')),
			over = function(){
				var $$ = $(this), menu = getMenu($$);
				clearTimeout(menu.sfTimer);
				$$.showSuperfishUl().siblings().hideSuperfishUl();
			},
			out = function(){
				var $$ = $(this), menu = getMenu($$), o = sf.op;
				clearTimeout(menu.sfTimer);
				menu.sfTimer=setTimeout(function(){
					o.retainPath=($.inArray($$[0],o.$path)>-1);
					$$.hideSuperfishUl();
					if (o.$path.length && $$.parents(['li.',o.hoverClass].join('')).length<1){over.call(o.$path);}
				},o.delay);
			},
			getMenu = function($menu){
				var menu = $menu.parents(['ul.',c.menuClass,':first'].join(''))[0];
				sf.op = sf.o[menu.serial];
				return menu;
			},
			addArrow = function($a){ $a.addClass(c.anchorClass).append($arrow.clone()); };

		return this.each(function() {
			var s = this.serial = sf.o.length;
			var o = $.extend({},sf.defaults,op);
			o.$path = $('li.'+o.pathClass,this).slice(0,o.pathLevels).each(function(){
				$(this).addClass([o.hoverClass,c.bcClass].join(' '))
					.filter('li:has(ul)').removeClass(o.pathClass);
			});
			sf.o[s] = sf.op = o;

			$('li:has(ul)',this)[($.fn.hoverIntent && !o.disableHI) ? 'hoverIntent' : 'hover'](over,out).each(function() {
				if (o.autoArrows) addArrow( $('>a:first-child',this) );
			})
			.not('.'+c.bcClass)
				.hideSuperfishUl();

			var $a = $('a',this);
			$a.each(function(i){
				var $li = $a.eq(i).parents('li');
				$a.eq(i).focus(function(){over.call($li);}).blur(function(){out.call($li);});
			});
			o.onInit.call(this);

		}).each(function() {
			var menuClasses = [c.menuClass];
			if (sf.op.dropShadows  && !($.browser.msie && $.browser.version < 7)) menuClasses.push(c.shadowClass);
			$(this).addClass(menuClasses.join(' '));
		});
	};

	var sf = $.fn.superfish;
	sf.o = [];
	sf.op = {};
	sf.IE7fix = function(){
		var o = sf.op;
		if ($.browser.msie && $.browser.version > 6 && o.dropShadows && o.animation.opacity!=undefined)
			this.toggleClass(sf.c.shadowClass+'-off');
		};
	sf.c = {
		bcClass     : 'sf-breadcrumb',
		menuClass   : 'sf-js-enabled',
		anchorClass : 'sf-with-ul',
		arrowClass  : 'sf-sub-indicator',
		shadowClass : 'sf-shadow'
	};
	sf.defaults = {
		hoverClass	: 'sfHover',
		pathClass	: 'overideThisToUse',
		pathLevels	: 1,
		delay		: 800,
		animation	: {opacity:'show'},
		speed		: 'normal',
		autoArrows	: true,
		dropShadows : true,
		disableHI	: false,		// true disables hoverIntent detection
		onInit		: function(){}, // callback functions
		onBeforeShow: function(){},
		onShow		: function(){},
		onHide		: function(){}
	};
	$.fn.extend({
		hideSuperfishUl : function(){
			var o = sf.op,
				not = (o.retainPath===true) ? o.$path : '';
			o.retainPath = false;
			var $ul = $(['li.',o.hoverClass].join(''),this).add(this).not(not).removeClass(o.hoverClass)
					.find('>ul').hide().css('visibility','hidden');
			o.onHide.call($ul);
			return this;
		},
		showSuperfishUl : function(){
			var o = sf.op,
				sh = sf.c.shadowClass+'-off',
				$ul = this.addClass(o.hoverClass)
					.find('>ul:hidden').css('visibility','visible');
			sf.IE7fix.call($ul);
			o.onBeforeShow.call($ul);
			$ul.animate(o.animation,o.speed,function(){ sf.IE7fix.call($ul); o.onShow.call($ul); });
			return this;
		}
	});

})(jQuery);

if (weaverUseSuperfish)
    jQuery(function(){jQuery('.menu_bar ul.sf-menu').superfish({ disableHI:true, speed:200, dropshadows:false});});

/* ----------------------------------------------------
    hide tool tips for Weaver */
if (weaverHideTooltip) {
jQuery(document).ready(function() {
jQuery('a[title]').mouseover(function(e) {
var tip = jQuery(this).attr('title');
jQuery(this).attr('title','');
}).mouseout(function() {
jQuery(this).attr('title',jQuery('.tipBody').html());
});
});
};

/* ------------------------------------------------------
 Fix drop-down menus for Android devices

Credits: Based on:Marco Chiesi - Black Studio Touch Dropedown Menu plugin - www.blackstudio.it
	Originally partially inspired by the one from Ross McKay found here
http://snippets.webaware.com.au/snippets/make-css-drop-down-menus-work-on-touch-devices/
*/

(function($) {
    /* Detect device in use  */
    var weaver_isTouch =  ("ontouchstart" in window);
    var weaver_isIOS5 = /iPad|iPod|iPhone/.test(navigator.platform) && "matchMedia" in window;
    var weaver_touch_dropdown_menu_apply =  weaver_isTouch && ! weaver_isIOS5;
    var weaver_superfish_fix = false;

    /* Apply dropdown effect on first click */
    if (weaver_touch_dropdown_menu_apply) {
	$(document).ready(function(){
	    $(weaver_menu_params.selector).each(function() {
		var $this = $(this);

		// Initial setting to handle first click
		$this.data('dataNoclick', false);

		// Touch Handler
		$this.bind('touchstart', function() {

		// Hack for superfish menus with low delay
		if (!weaver_superfish_fix && $.fn.superfish != undefined) {
		    for (var i=0; i<$.fn.superfish.o.length; i++) {
			$.fn.superfish.o[i].delay = 800;
		    }
		    weaver_superfish_fix = true;
		}

		var noclick = !($this.data('dataNoclick'));
		$(weaver_menu_params.selector).each(function(){
		    $(this).data('dataNoclick', false);
		});
		$this.data('dataNoclick', noclick);
		$this.focus();
		}); // end touchstart

		// Click Handler
		$this.bind('click', function(event){
		    if ($this.data('dataNoclick')) {
			event.preventDefault();
		    }
		    $this.focus();
		}); // end click
	    }); // end each

	    // Fix for 3rd+ level menus not working in some circumstances
	    $(weaver_menu_params.selector_leaf).each(function(){
		$(this).bind('touchstart', function(){
		    window.location = this.href;
		}); // end touchstart
	    }); // end each

	}); // end ready
    } //end if
})(jQuery); // end self-invoked wrapper function

/* -------------------------
    weaveriip_hide_css, JavaScript specialized hide table row
*/
function weaveriip_ToggleDIV(his, me, show, hide, text) {

    if (his.style.display != 'none') {
        his.style.display = 'none';
        if (text == 'img') {
            me.innerHTML = '<img src="' + show + '" alt="show" />';
        } else {
            me.innerHTML = '<span class="weaveriip_showhide_show">' + show + '</span>';
        }
    } else {
        his.style.display = '';
        if (text == 'img') {
            me.innerHTML = '<img src="' + hide + '" alt="hide" />';
        } else {
            me.innerHTML = '<span class="weaveriip_showhide_hide">' + hide + '</span>';
        }
    }
}

/* -----------
  Toggle Mobile Menu button
*/

var weaverii_menu_open = false;
function weaverii_ToggleMenu(his, me, show, hide) {
    if (jQuery(his).css('display') != 'none') {
        me.innerHTML = show;
        jQuery(his).slideUp('normal');
    } else {
        me.innerHTML = hide;
        jQuery(his).slideDown('normal');
        weaverii_menu_open = true;
    }
}

/* ---------
    Weaver iFrame fixer
*/
function weaverii_fixVideo(myframe,vert)
{
var iframeW =  myframe.clientWidth;
myframe.height= (iframeW * vert) + 5 ;
}

/**
 * Weaver II colorFlow
 *  beginning with Version 1.2.9
 *
 */
(function($) {
    $.fn.weaverii_flowColor = function(addToContainer) {
        if ( !weaverFlowToBottom ) return false;	// do nothing

        myWidth = weaverii_winWidth();
        if ( (myWidth <= 640 || weaverIsSimMobile) && !weaverMobileDisabled) {
            $("#sidebar_wrap_left").css("min-height", "auto");
            $("#container_wrap").css("min-height", "auto");
            $("#sidebar_wrap_right").css("min-height", "auto");
            return false;
        }

        var leftH = $('#sidebar_wrap_left').height();
        var containerH = $('#container_wrap').height() + addToContainer;
        var rightH = $('#sidebar_wrap_right').height();

        var tallest = 0;
        if (leftH > tallest) tallest = leftH;
        if (containerH > tallest) tallest = containerH;
        if (rightH > tallest) tallest = rightH;

        if (leftH > 0 || rightH > 0) {
            $("#sidebar_wrap_left").css("min-height", tallest + "px");
            $("#container_wrap").css("min-height", tallest + "px");
            $("#sidebar_wrap_right").css("min-height", tallest + "px");
        }

            return false;
    }
})(jQuery);

/*  ------------
    Weaver II on Resize handler - fixes sidebars for mobile, fixes mobile menus
*/

function weaverii_winWidth() {
    var myWidth = 0;
    if( typeof( window.innerWidth ) == 'number' ) {
        myWidth = window.innerWidth;    //Non-IE
    } else if( document.documentElement &&
            ( document.documentElement.clientWidth || document.documentElement.clientHeight ) ) {
         myWidth = document.documentElement.clientWidth; //IE 6+ in 'standards compliant mode'
    } else if ( document.body && ( document.body.clientWidth || document.body.clientHeight ) ) {
        myWidth = document.body.clientWidth;    //IE 4 compatible
    }

    /* document.innerWidth does not work the same on all devices, partly depending on how "viewport"
	is set. This breaks things when switching to Full View in smart mode. So we will manually
	override the width when we are in FUll View mode which can be determined by the value
	of the viewport meta tag.
    */
    var metas = document.getElementsByTagName('meta');
    var i;
    for (i=0; i<metas.length; i++) {
	if (metas[i].name == "viewport") {
	    if (metas[i].content.indexOf('device-width') < 0) { // have specified theme width
		myWidth = weaverThemeWidth;
		break;
	    }
	}
    }
    return myWidth;
}

function weaverii_onResize() {
    if (weaverMobileDisabled) return;

    var leftSidebar = document.getElementById("sidebar_wrap_left");
    var menuThreshold = 640;
    var sw = weaverMenuThreshold;
    if (sw >= 0 && sw < 10000) {	// use passed in threshold if reasonable value
        menuThreshold = sw;
    }
    var isIE7 = document.getElementById("ie7");
    var isIE8 = document.getElementById("ie8");
    var main = document.getElementById("main");

    if (main && !isIE7 && !isIE8) {
        /* depending on current values, swap the divs */
        var myWidth = weaverii_winWidth();

        if ( (myWidth <= 640 || weaverIsSimMobile) && weaverIsStacked) {
            if (leftSidebar) { // swap left sidebar if it exists
                var container = document.getElementById ("container_wrap");
                var oldContainer = container.parentNode.removeChild(container); // remove container
                // leftSidebar now first child, so insert container before it
                main.insertBefore (oldContainer, main.firstChild);
                if (weaverIsStacked)
                    jQuery('#sidebar_wrap_left').css('display','block');
            }
        }
        if (myWidth > 640) {
            if (leftSidebar && main.firstChild != leftSidebar) {
                // if here, we've swapped leftsidbar and the container, so swap it back
                var oldSidebar = leftSidebar.parentNode.removeChild(leftSidebar);
                // container now first child, so insert the left sidebar before it
                main.insertBefore (oldSidebar, main.firstChild);
                if (weaverIsStacked)
                    jQuery('#sidebar_wrap_left').css('display','block');
            }
        }

        if ( myWidth <= menuThreshold || weaverIsSimMobile) {   // change to mobile menu
            jQuery('#mobile-bottom-nav').css('display','block');
            jQuery('#mobile-top-nav').css('display','block');

            if (!weaverii_menu_open) {   // don't close them if the menu button opened them
                jQuery('#nav-top-menu').css('display','none');
                jQuery('#nav-bottom-menu').css('display','none');
            }

            jQuery('#access').removeClass('menu_bar');      // these swap from pulldown to slide open
            jQuery('#access2').removeClass('menu_bar');

            jQuery('#access').addClass('menu-vertical');
            jQuery('#access2').addClass('menu-vertical');

        }
	if ( (myWidth > menuThreshold && !weaverIsSimMobile) ) {
	    // fix menus - change to default drop down
            weaverii_menu_open = false;
            jQuery('#mobile-bottom-nav').css('display','none');
            jQuery('#mobile-top-nav').css('display','none');
            jQuery('#nav-top-menu').css('display','block');
            jQuery('#nav-bottom-menu').css('display','block');

            jQuery('#access').removeClass('menu-vertical');
            jQuery('#access2').removeClass('menu-vertical');
            jQuery('#access').addClass('menu_bar');
            jQuery('#access2').addClass('menu_bar');
	}

        if (weaverHideMenuBar) {
            jQuery('#nav-top-menu').css('display','none');
            jQuery('#nav-bottom-menu').css('display','none');
        }
    }
}


//Initial load of page
jQuery(window).load(weaverii_RunOnLoad);
jQuery(document).ready(weaverii_RunOnReady);

//Every resize of window
jQuery(window).resize(weaverii_RunOnResize);

function weaverii_RunOnReady() {
   weaverii_onResize();
   // Open menu on first tap on touch devices.
   jQuery(".page_item").has("ul").children("a").attr("aria-haspopup", "true");

}

function weaverii_RunOnLoad() {
   jQuery("#main").weaverii_flowColor(0);
}

function weaverii_RunOnResize() {
   weaverii_onResize();
   jQuery("#main").weaverii_flowColor(0);
}
