/*!
 * Bootstrap v3.3.6 (http://getbootstrap.com)
 * Copyright 2011-2015 Twitter, Inc.
 * Licensed under the MIT license
 */
if("undefined"==typeof jQuery)throw new Error("Bootstrap's JavaScript requires jQuery");+function(a){"use strict";var b=a.fn.jquery.split(" ")[0].split(".");if(b[0]<2&&b[1]<9||1==b[0]&&9==b[1]&&b[2]<1||b[0]>2)throw new Error("Bootstrap's JavaScript requires jQuery version 1.9.1 or higher, but lower than version 3")}(jQuery),+function(a){"use strict";function b(){var a=document.createElement("bootstrap"),b={WebkitTransition:"webkitTransitionEnd",MozTransition:"transitionend",OTransition:"oTransitionEnd otransitionend",transition:"transitionend"};for(var c in b)if(void 0!==a.style[c])return{end:b[c]};return!1}a.fn.emulateTransitionEnd=function(b){var c=!1,d=this;a(this).one("bsTransitionEnd",function(){c=!0});var e=function(){c||a(d).trigger(a.support.transition.end)};return setTimeout(e,b),this},a(function(){a.support.transition=b(),a.support.transition&&(a.event.special.bsTransitionEnd={bindType:a.support.transition.end,delegateType:a.support.transition.end,handle:function(b){return a(b.target).is(this)?b.handleObj.handler.apply(this,arguments):void 0}})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var c=a(this),e=c.data("bs.alert");e||c.data("bs.alert",e=new d(this)),"string"==typeof b&&e[b].call(c)})}var c='[data-dismiss="alert"]',d=function(b){a(b).on("click",c,this.close)};d.VERSION="3.3.6",d.TRANSITION_DURATION=150,d.prototype.close=function(b){function c(){g.detach().trigger("closed.bs.alert").remove()}var e=a(this),f=e.attr("data-target");f||(f=e.attr("href"),f=f&&f.replace(/.*(?=#[^\s]*$)/,""));var g=a(f);b&&b.preventDefault(),g.length||(g=e.closest(".alert")),g.trigger(b=a.Event("close.bs.alert")),b.isDefaultPrevented()||(g.removeClass("in"),a.support.transition&&g.hasClass("fade")?g.one("bsTransitionEnd",c).emulateTransitionEnd(d.TRANSITION_DURATION):c())};var e=a.fn.alert;a.fn.alert=b,a.fn.alert.Constructor=d,a.fn.alert.noConflict=function(){return a.fn.alert=e,this},a(document).on("click.bs.alert.data-api",c,d.prototype.close)}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.button"),f="object"==typeof b&&b;e||d.data("bs.button",e=new c(this,f)),"toggle"==b?e.toggle():b&&e.setState(b)})}var c=function(b,d){this.$element=a(b),this.options=a.extend({},c.DEFAULTS,d),this.isLoading=!1};c.VERSION="3.3.6",c.DEFAULTS={loadingText:"loading..."},c.prototype.setState=function(b){var c="disabled",d=this.$element,e=d.is("input")?"val":"html",f=d.data();b+="Text",null==f.resetText&&d.data("resetText",d[e]()),setTimeout(a.proxy(function(){d[e](null==f[b]?this.options[b]:f[b]),"loadingText"==b?(this.isLoading=!0,d.addClass(c).attr(c,c)):this.isLoading&&(this.isLoading=!1,d.removeClass(c).removeAttr(c))},this),0)},c.prototype.toggle=function(){var a=!0,b=this.$element.closest('[data-toggle="buttons"]');if(b.length){var c=this.$element.find("input");"radio"==c.prop("type")?(c.prop("checked")&&(a=!1),b.find(".active").removeClass("active"),this.$element.addClass("active")):"checkbox"==c.prop("type")&&(c.prop("checked")!==this.$element.hasClass("active")&&(a=!1),this.$element.toggleClass("active")),c.prop("checked",this.$element.hasClass("active")),a&&c.trigger("change")}else this.$element.attr("aria-pressed",!this.$element.hasClass("active")),this.$element.toggleClass("active")};var d=a.fn.button;a.fn.button=b,a.fn.button.Constructor=c,a.fn.button.noConflict=function(){return a.fn.button=d,this},a(document).on("click.bs.button.data-api",'[data-toggle^="button"]',function(c){var d=a(c.target);d.hasClass("btn")||(d=d.closest(".btn")),b.call(d,"toggle"),a(c.target).is('input[type="radio"]')||a(c.target).is('input[type="checkbox"]')||c.preventDefault()}).on("focus.bs.button.data-api blur.bs.button.data-api",'[data-toggle^="button"]',function(b){a(b.target).closest(".btn").toggleClass("focus",/^focus(in)?$/.test(b.type))})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.carousel"),f=a.extend({},c.DEFAULTS,d.data(),"object"==typeof b&&b),g="string"==typeof b?b:f.slide;e||d.data("bs.carousel",e=new c(this,f)),"number"==typeof b?e.to(b):g?e[g]():f.interval&&e.pause().cycle()})}var c=function(b,c){this.$element=a(b),this.$indicators=this.$element.find(".carousel-indicators"),this.options=c,this.paused=null,this.sliding=null,this.interval=null,this.$active=null,this.$items=null,this.options.keyboard&&this.$element.on("keydown.bs.carousel",a.proxy(this.keydown,this)),"hover"==this.options.pause&&!("ontouchstart"in document.documentElement)&&this.$element.on("mouseenter.bs.carousel",a.proxy(this.pause,this)).on("mouseleave.bs.carousel",a.proxy(this.cycle,this))};c.VERSION="3.3.6",c.TRANSITION_DURATION=600,c.DEFAULTS={interval:5e3,pause:"hover",wrap:!0,keyboard:!0},c.prototype.keydown=function(a){if(!/input|textarea/i.test(a.target.tagName)){switch(a.which){case 37:this.prev();break;case 39:this.next();break;default:return}a.preventDefault()}},c.prototype.cycle=function(b){return b||(this.paused=!1),this.interval&&clearInterval(this.interval),this.options.interval&&!this.paused&&(this.interval=setInterval(a.proxy(this.next,this),this.options.interval)),this},c.prototype.getItemIndex=function(a){return this.$items=a.parent().children(".item"),this.$items.index(a||this.$active)},c.prototype.getItemForDirection=function(a,b){var c=this.getItemIndex(b),d="prev"==a&&0===c||"next"==a&&c==this.$items.length-1;if(d&&!this.options.wrap)return b;var e="prev"==a?-1:1,f=(c+e)%this.$items.length;return this.$items.eq(f)},c.prototype.to=function(a){var b=this,c=this.getItemIndex(this.$active=this.$element.find(".item.active"));return a>this.$items.length-1||0>a?void 0:this.sliding?this.$element.one("slid.bs.carousel",function(){b.to(a)}):c==a?this.pause().cycle():this.slide(a>c?"next":"prev",this.$items.eq(a))},c.prototype.pause=function(b){return b||(this.paused=!0),this.$element.find(".next, .prev").length&&a.support.transition&&(this.$element.trigger(a.support.transition.end),this.cycle(!0)),this.interval=clearInterval(this.interval),this},c.prototype.next=function(){return this.sliding?void 0:this.slide("next")},c.prototype.prev=function(){return this.sliding?void 0:this.slide("prev")},c.prototype.slide=function(b,d){var e=this.$element.find(".item.active"),f=d||this.getItemForDirection(b,e),g=this.interval,h="next"==b?"left":"right",i=this;if(f.hasClass("active"))return this.sliding=!1;var j=f[0],k=a.Event("slide.bs.carousel",{relatedTarget:j,direction:h});if(this.$element.trigger(k),!k.isDefaultPrevented()){if(this.sliding=!0,g&&this.pause(),this.$indicators.length){this.$indicators.find(".active").removeClass("active");var l=a(this.$indicators.children()[this.getItemIndex(f)]);l&&l.addClass("active")}var m=a.Event("slid.bs.carousel",{relatedTarget:j,direction:h});return a.support.transition&&this.$element.hasClass("slide")?(f.addClass(b),f[0].offsetWidth,e.addClass(h),f.addClass(h),e.one("bsTransitionEnd",function(){f.removeClass([b,h].join(" ")).addClass("active"),e.removeClass(["active",h].join(" ")),i.sliding=!1,setTimeout(function(){i.$element.trigger(m)},0)}).emulateTransitionEnd(c.TRANSITION_DURATION)):(e.removeClass("active"),f.addClass("active"),this.sliding=!1,this.$element.trigger(m)),g&&this.cycle(),this}};var d=a.fn.carousel;a.fn.carousel=b,a.fn.carousel.Constructor=c,a.fn.carousel.noConflict=function(){return a.fn.carousel=d,this};var e=function(c){var d,e=a(this),f=a(e.attr("data-target")||(d=e.attr("href"))&&d.replace(/.*(?=#[^\s]+$)/,""));if(f.hasClass("carousel")){var g=a.extend({},f.data(),e.data()),h=e.attr("data-slide-to");h&&(g.interval=!1),b.call(f,g),h&&f.data("bs.carousel").to(h),c.preventDefault()}};a(document).on("click.bs.carousel.data-api","[data-slide]",e).on("click.bs.carousel.data-api","[data-slide-to]",e),a(window).on("load",function(){a('[data-ride="carousel"]').each(function(){var c=a(this);b.call(c,c.data())})})}(jQuery),+function(a){"use strict";function b(b){var c,d=b.attr("data-target")||(c=b.attr("href"))&&c.replace(/.*(?=#[^\s]+$)/,"");return a(d)}function c(b){return this.each(function(){var c=a(this),e=c.data("bs.collapse"),f=a.extend({},d.DEFAULTS,c.data(),"object"==typeof b&&b);!e&&f.toggle&&/show|hide/.test(b)&&(f.toggle=!1),e||c.data("bs.collapse",e=new d(this,f)),"string"==typeof b&&e[b]()})}var d=function(b,c){this.$element=a(b),this.options=a.extend({},d.DEFAULTS,c),this.$trigger=a('[data-toggle="collapse"][href="#'+b.id+'"],[data-toggle="collapse"][data-target="#'+b.id+'"]'),this.transitioning=null,this.options.parent?this.$parent=this.getParent():this.addAriaAndCollapsedClass(this.$element,this.$trigger),this.options.toggle&&this.toggle()};d.VERSION="3.3.6",d.TRANSITION_DURATION=350,d.DEFAULTS={toggle:!0},d.prototype.dimension=function(){var a=this.$element.hasClass("width");return a?"width":"height"},d.prototype.show=function(){if(!this.transitioning&&!this.$element.hasClass("in")){var b,e=this.$parent&&this.$parent.children(".panel").children(".in, .collapsing");if(!(e&&e.length&&(b=e.data("bs.collapse"),b&&b.transitioning))){var f=a.Event("show.bs.collapse");if(this.$element.trigger(f),!f.isDefaultPrevented()){e&&e.length&&(c.call(e,"hide"),b||e.data("bs.collapse",null));var g=this.dimension();this.$element.removeClass("collapse").addClass("collapsing")[g](0).attr("aria-expanded",!0),this.$trigger.removeClass("collapsed").attr("aria-expanded",!0),this.transitioning=1;var h=function(){this.$element.removeClass("collapsing").addClass("collapse in")[g](""),this.transitioning=0,this.$element.trigger("shown.bs.collapse")};if(!a.support.transition)return h.call(this);var i=a.camelCase(["scroll",g].join("-"));this.$element.one("bsTransitionEnd",a.proxy(h,this)).emulateTransitionEnd(d.TRANSITION_DURATION)[g](this.$element[0][i])}}}},d.prototype.hide=function(){if(!this.transitioning&&this.$element.hasClass("in")){var b=a.Event("hide.bs.collapse");if(this.$element.trigger(b),!b.isDefaultPrevented()){var c=this.dimension();this.$element[c](this.$element[c]())[0].offsetHeight,this.$element.addClass("collapsing").removeClass("collapse in").attr("aria-expanded",!1),this.$trigger.addClass("collapsed").attr("aria-expanded",!1),this.transitioning=1;var e=function(){this.transitioning=0,this.$element.removeClass("collapsing").addClass("collapse").trigger("hidden.bs.collapse")};return a.support.transition?void this.$element[c](0).one("bsTransitionEnd",a.proxy(e,this)).emulateTransitionEnd(d.TRANSITION_DURATION):e.call(this)}}},d.prototype.toggle=function(){this[this.$element.hasClass("in")?"hide":"show"]()},d.prototype.getParent=function(){return a(this.options.parent).find('[data-toggle="collapse"][data-parent="'+this.options.parent+'"]').each(a.proxy(function(c,d){var e=a(d);this.addAriaAndCollapsedClass(b(e),e)},this)).end()},d.prototype.addAriaAndCollapsedClass=function(a,b){var c=a.hasClass("in");a.attr("aria-expanded",c),b.toggleClass("collapsed",!c).attr("aria-expanded",c)};var e=a.fn.collapse;a.fn.collapse=c,a.fn.collapse.Constructor=d,a.fn.collapse.noConflict=function(){return a.fn.collapse=e,this},a(document).on("click.bs.collapse.data-api",'[data-toggle="collapse"]',function(d){var e=a(this);e.attr("data-target")||d.preventDefault();var f=b(e),g=f.data("bs.collapse"),h=g?"toggle":e.data();c.call(f,h)})}(jQuery),+function(a){"use strict";function b(b){var c=b.attr("data-target");c||(c=b.attr("href"),c=c&&/#[A-Za-z]/.test(c)&&c.replace(/.*(?=#[^\s]*$)/,""));var d=c&&a(c);return d&&d.length?d:b.parent()}function c(c){c&&3===c.which||(a(e).remove(),a(f).each(function(){var d=a(this),e=b(d),f={relatedTarget:this};e.hasClass("open")&&(c&&"click"==c.type&&/input|textarea/i.test(c.target.tagName)&&a.contains(e[0],c.target)||(e.trigger(c=a.Event("hide.bs.dropdown",f)),c.isDefaultPrevented()||(d.attr("aria-expanded","false"),e.removeClass("open").trigger(a.Event("hidden.bs.dropdown",f)))))}))}function d(b){return this.each(function(){var c=a(this),d=c.data("bs.dropdown");d||c.data("bs.dropdown",d=new g(this)),"string"==typeof b&&d[b].call(c)})}var e=".dropdown-backdrop",f='[data-toggle="dropdown"]',g=function(b){a(b).on("click.bs.dropdown",this.toggle)};g.VERSION="3.3.6",g.prototype.toggle=function(d){var e=a(this);if(!e.is(".disabled, :disabled")){var f=b(e),g=f.hasClass("open");if(c(),!g){"ontouchstart"in document.documentElement&&!f.closest(".navbar-nav").length&&a(document.createElement("div")).addClass("dropdown-backdrop").insertAfter(a(this)).on("click",c);var h={relatedTarget:this};if(f.trigger(d=a.Event("show.bs.dropdown",h)),d.isDefaultPrevented())return;e.trigger("focus").attr("aria-expanded","true"),f.toggleClass("open").trigger(a.Event("shown.bs.dropdown",h))}return!1}},g.prototype.keydown=function(c){if(/(38|40|27|32)/.test(c.which)&&!/input|textarea/i.test(c.target.tagName)){var d=a(this);if(c.preventDefault(),c.stopPropagation(),!d.is(".disabled, :disabled")){var e=b(d),g=e.hasClass("open");if(!g&&27!=c.which||g&&27==c.which)return 27==c.which&&e.find(f).trigger("focus"),d.trigger("click");var h=" li:not(.disabled):visible a",i=e.find(".dropdown-menu"+h);if(i.length){var j=i.index(c.target);38==c.which&&j>0&&j--,40==c.which&&j<i.length-1&&j++,~j||(j=0),i.eq(j).trigger("focus")}}}};var h=a.fn.dropdown;a.fn.dropdown=d,a.fn.dropdown.Constructor=g,a.fn.dropdown.noConflict=function(){return a.fn.dropdown=h,this},a(document).on("click.bs.dropdown.data-api",c).on("click.bs.dropdown.data-api",".dropdown form",function(a){a.stopPropagation()}).on("click.bs.dropdown.data-api",f,g.prototype.toggle).on("keydown.bs.dropdown.data-api",f,g.prototype.keydown).on("keydown.bs.dropdown.data-api",".dropdown-menu",g.prototype.keydown)}(jQuery),+function(a){"use strict";function b(b,d){return this.each(function(){var e=a(this),f=e.data("bs.modal"),g=a.extend({},c.DEFAULTS,e.data(),"object"==typeof b&&b);f||e.data("bs.modal",f=new c(this,g)),"string"==typeof b?f[b](d):g.show&&f.show(d)})}var c=function(b,c){this.options=c,this.$body=a(document.body),this.$element=a(b),this.$dialog=this.$element.find(".modal-dialog"),this.$backdrop=null,this.isShown=null,this.originalBodyPad=null,this.scrollbarWidth=0,this.ignoreBackdropClick=!1,this.options.remote&&this.$element.find(".modal-content").load(this.options.remote,a.proxy(function(){this.$element.trigger("loaded.bs.modal")},this))};c.VERSION="3.3.6",c.TRANSITION_DURATION=300,c.BACKDROP_TRANSITION_DURATION=150,c.DEFAULTS={backdrop:!0,keyboard:!0,show:!0},c.prototype.toggle=function(a){return this.isShown?this.hide():this.show(a)},c.prototype.show=function(b){var d=this,e=a.Event("show.bs.modal",{relatedTarget:b});this.$element.trigger(e),this.isShown||e.isDefaultPrevented()||(this.isShown=!0,this.checkScrollbar(),this.setScrollbar(),this.$body.addClass("modal-open"),this.escape(),this.resize(),this.$element.on("click.dismiss.bs.modal",'[data-dismiss="modal"]',a.proxy(this.hide,this)),this.$dialog.on("mousedown.dismiss.bs.modal",function(){d.$element.one("mouseup.dismiss.bs.modal",function(b){a(b.target).is(d.$element)&&(d.ignoreBackdropClick=!0)})}),this.backdrop(function(){var e=a.support.transition&&d.$element.hasClass("fade");d.$element.parent().length||d.$element.appendTo(d.$body),d.$element.show().scrollTop(0),d.adjustDialog(),e&&d.$element[0].offsetWidth,d.$element.addClass("in"),d.enforceFocus();var f=a.Event("shown.bs.modal",{relatedTarget:b});e?d.$dialog.one("bsTransitionEnd",function(){d.$element.trigger("focus").trigger(f)}).emulateTransitionEnd(c.TRANSITION_DURATION):d.$element.trigger("focus").trigger(f)}))},c.prototype.hide=function(b){b&&b.preventDefault(),b=a.Event("hide.bs.modal"),this.$element.trigger(b),this.isShown&&!b.isDefaultPrevented()&&(this.isShown=!1,this.escape(),this.resize(),a(document).off("focusin.bs.modal"),this.$element.removeClass("in").off("click.dismiss.bs.modal").off("mouseup.dismiss.bs.modal"),this.$dialog.off("mousedown.dismiss.bs.modal"),a.support.transition&&this.$element.hasClass("fade")?this.$element.one("bsTransitionEnd",a.proxy(this.hideModal,this)).emulateTransitionEnd(c.TRANSITION_DURATION):this.hideModal())},c.prototype.enforceFocus=function(){a(document).off("focusin.bs.modal").on("focusin.bs.modal",a.proxy(function(a){this.$element[0]===a.target||this.$element.has(a.target).length||this.$element.trigger("focus")},this))},c.prototype.escape=function(){this.isShown&&this.options.keyboard?this.$element.on("keydown.dismiss.bs.modal",a.proxy(function(a){27==a.which&&this.hide()},this)):this.isShown||this.$element.off("keydown.dismiss.bs.modal")},c.prototype.resize=function(){this.isShown?a(window).on("resize.bs.modal",a.proxy(this.handleUpdate,this)):a(window).off("resize.bs.modal")},c.prototype.hideModal=function(){var a=this;this.$element.hide(),this.backdrop(function(){a.$body.removeClass("modal-open"),a.resetAdjustments(),a.resetScrollbar(),a.$element.trigger("hidden.bs.modal")})},c.prototype.removeBackdrop=function(){this.$backdrop&&this.$backdrop.remove(),this.$backdrop=null},c.prototype.backdrop=function(b){var d=this,e=this.$element.hasClass("fade")?"fade":"";if(this.isShown&&this.options.backdrop){var f=a.support.transition&&e;if(this.$backdrop=a(document.createElement("div")).addClass("modal-backdrop "+e).appendTo(this.$body),this.$element.on("click.dismiss.bs.modal",a.proxy(function(a){return this.ignoreBackdropClick?void(this.ignoreBackdropClick=!1):void(a.target===a.currentTarget&&("static"==this.options.backdrop?this.$element[0].focus():this.hide()))},this)),f&&this.$backdrop[0].offsetWidth,this.$backdrop.addClass("in"),!b)return;f?this.$backdrop.one("bsTransitionEnd",b).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION):b()}else if(!this.isShown&&this.$backdrop){this.$backdrop.removeClass("in");var g=function(){d.removeBackdrop(),b&&b()};a.support.transition&&this.$element.hasClass("fade")?this.$backdrop.one("bsTransitionEnd",g).emulateTransitionEnd(c.BACKDROP_TRANSITION_DURATION):g()}else b&&b()},c.prototype.handleUpdate=function(){this.adjustDialog()},c.prototype.adjustDialog=function(){var a=this.$element[0].scrollHeight>document.documentElement.clientHeight;this.$element.css({paddingLeft:!this.bodyIsOverflowing&&a?this.scrollbarWidth:"",paddingRight:this.bodyIsOverflowing&&!a?this.scrollbarWidth:""})},c.prototype.resetAdjustments=function(){this.$element.css({paddingLeft:"",paddingRight:""})},c.prototype.checkScrollbar=function(){var a=window.innerWidth;if(!a){var b=document.documentElement.getBoundingClientRect();a=b.right-Math.abs(b.left)}this.bodyIsOverflowing=document.body.clientWidth<a,this.scrollbarWidth=this.measureScrollbar()},c.prototype.setScrollbar=function(){var a=parseInt(this.$body.css("padding-right")||0,10);this.originalBodyPad=document.body.style.paddingRight||"",this.bodyIsOverflowing&&this.$body.css("padding-right",a+this.scrollbarWidth)},c.prototype.resetScrollbar=function(){this.$body.css("padding-right",this.originalBodyPad)},c.prototype.measureScrollbar=function(){var a=document.createElement("div");a.className="modal-scrollbar-measure",this.$body.append(a);var b=a.offsetWidth-a.clientWidth;return this.$body[0].removeChild(a),b};var d=a.fn.modal;a.fn.modal=b,a.fn.modal.Constructor=c,a.fn.modal.noConflict=function(){return a.fn.modal=d,this},a(document).on("click.bs.modal.data-api",'[data-toggle="modal"]',function(c){var d=a(this),e=d.attr("href"),f=a(d.attr("data-target")||e&&e.replace(/.*(?=#[^\s]+$)/,"")),g=f.data("bs.modal")?"toggle":a.extend({remote:!/#/.test(e)&&e},f.data(),d.data());d.is("a")&&c.preventDefault(),f.one("show.bs.modal",function(a){a.isDefaultPrevented()||f.one("hidden.bs.modal",function(){d.is(":visible")&&d.trigger("focus")})}),b.call(f,g,this)})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tooltip"),f="object"==typeof b&&b;(e||!/destroy|hide/.test(b))&&(e||d.data("bs.tooltip",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.type=null,this.options=null,this.enabled=null,this.timeout=null,this.hoverState=null,this.$element=null,this.inState=null,this.init("tooltip",a,b)};c.VERSION="3.3.6",c.TRANSITION_DURATION=150,c.DEFAULTS={animation:!0,placement:"top",selector:!1,template:'<div class="tooltip" role="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',trigger:"hover focus",title:"",delay:0,html:!1,container:!1,viewport:{selector:"body",padding:0}},c.prototype.init=function(b,c,d){if(this.enabled=!0,this.type=b,this.$element=a(c),this.options=this.getOptions(d),this.$viewport=this.options.viewport&&a(a.isFunction(this.options.viewport)?this.options.viewport.call(this,this.$element):this.options.viewport.selector||this.options.viewport),this.inState={click:!1,hover:!1,focus:!1},this.$element[0]instanceof document.constructor&&!this.options.selector)throw new Error("`selector` option must be specified when initializing "+this.type+" on the window.document object!");for(var e=this.options.trigger.split(" "),f=e.length;f--;){var g=e[f];if("click"==g)this.$element.on("click."+this.type,this.options.selector,a.proxy(this.toggle,this));else if("manual"!=g){var h="hover"==g?"mouseenter":"focusin",i="hover"==g?"mouseleave":"focusout";this.$element.on(h+"."+this.type,this.options.selector,a.proxy(this.enter,this)),this.$element.on(i+"."+this.type,this.options.selector,a.proxy(this.leave,this))}}this.options.selector?this._options=a.extend({},this.options,{trigger:"manual",selector:""}):this.fixTitle()},c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.getOptions=function(b){return b=a.extend({},this.getDefaults(),this.$element.data(),b),b.delay&&"number"==typeof b.delay&&(b.delay={show:b.delay,hide:b.delay}),b},c.prototype.getDelegateOptions=function(){var b={},c=this.getDefaults();return this._options&&a.each(this._options,function(a,d){c[a]!=d&&(b[a]=d)}),b},c.prototype.enter=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),b instanceof a.Event&&(c.inState["focusin"==b.type?"focus":"hover"]=!0),c.tip().hasClass("in")||"in"==c.hoverState?void(c.hoverState="in"):(clearTimeout(c.timeout),c.hoverState="in",c.options.delay&&c.options.delay.show?void(c.timeout=setTimeout(function(){"in"==c.hoverState&&c.show()},c.options.delay.show)):c.show())},c.prototype.isInStateTrue=function(){for(var a in this.inState)if(this.inState[a])return!0;return!1},c.prototype.leave=function(b){var c=b instanceof this.constructor?b:a(b.currentTarget).data("bs."+this.type);return c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c)),b instanceof a.Event&&(c.inState["focusout"==b.type?"focus":"hover"]=!1),c.isInStateTrue()?void 0:(clearTimeout(c.timeout),c.hoverState="out",c.options.delay&&c.options.delay.hide?void(c.timeout=setTimeout(function(){"out"==c.hoverState&&c.hide()},c.options.delay.hide)):c.hide())},c.prototype.show=function(){var b=a.Event("show.bs."+this.type);if(this.hasContent()&&this.enabled){this.$element.trigger(b);var d=a.contains(this.$element[0].ownerDocument.documentElement,this.$element[0]);if(b.isDefaultPrevented()||!d)return;var e=this,f=this.tip(),g=this.getUID(this.type);this.setContent(),f.attr("id",g),this.$element.attr("aria-describedby",g),this.options.animation&&f.addClass("fade");var h="function"==typeof this.options.placement?this.options.placement.call(this,f[0],this.$element[0]):this.options.placement,i=/\s?auto?\s?/i,j=i.test(h);j&&(h=h.replace(i,"")||"top"),f.detach().css({top:0,left:0,display:"block"}).addClass(h).data("bs."+this.type,this),this.options.container?f.appendTo(this.options.container):f.insertAfter(this.$element),this.$element.trigger("inserted.bs."+this.type);var k=this.getPosition(),l=f[0].offsetWidth,m=f[0].offsetHeight;if(j){var n=h,o=this.getPosition(this.$viewport);h="bottom"==h&&k.bottom+m>o.bottom?"top":"top"==h&&k.top-m<o.top?"bottom":"right"==h&&k.right+l>o.width?"left":"left"==h&&k.left-l<o.left?"right":h,f.removeClass(n).addClass(h)}var p=this.getCalculatedOffset(h,k,l,m);this.applyPlacement(p,h);var q=function(){var a=e.hoverState;e.$element.trigger("shown.bs."+e.type),e.hoverState=null,"out"==a&&e.leave(e)};a.support.transition&&this.$tip.hasClass("fade")?f.one("bsTransitionEnd",q).emulateTransitionEnd(c.TRANSITION_DURATION):q()}},c.prototype.applyPlacement=function(b,c){var d=this.tip(),e=d[0].offsetWidth,f=d[0].offsetHeight,g=parseInt(d.css("margin-top"),10),h=parseInt(d.css("margin-left"),10);isNaN(g)&&(g=0),isNaN(h)&&(h=0),b.top+=g,b.left+=h,a.offset.setOffset(d[0],a.extend({using:function(a){d.css({top:Math.round(a.top),left:Math.round(a.left)})}},b),0),d.addClass("in");var i=d[0].offsetWidth,j=d[0].offsetHeight;"top"==c&&j!=f&&(b.top=b.top+f-j);var k=this.getViewportAdjustedDelta(c,b,i,j);k.left?b.left+=k.left:b.top+=k.top;var l=/top|bottom/.test(c),m=l?2*k.left-e+i:2*k.top-f+j,n=l?"offsetWidth":"offsetHeight";d.offset(b),this.replaceArrow(m,d[0][n],l)},c.prototype.replaceArrow=function(a,b,c){this.arrow().css(c?"left":"top",50*(1-a/b)+"%").css(c?"top":"left","")},c.prototype.setContent=function(){var a=this.tip(),b=this.getTitle();a.find(".tooltip-inner")[this.options.html?"html":"text"](b),a.removeClass("fade in top bottom left right")},c.prototype.hide=function(b){function d(){"in"!=e.hoverState&&f.detach(),e.$element.removeAttr("aria-describedby").trigger("hidden.bs."+e.type),b&&b()}var e=this,f=a(this.$tip),g=a.Event("hide.bs."+this.type);return this.$element.trigger(g),g.isDefaultPrevented()?void 0:(f.removeClass("in"),a.support.transition&&f.hasClass("fade")?f.one("bsTransitionEnd",d).emulateTransitionEnd(c.TRANSITION_DURATION):d(),this.hoverState=null,this)},c.prototype.fixTitle=function(){var a=this.$element;(a.attr("title")||"string"!=typeof a.attr("data-original-title"))&&a.attr("data-original-title",a.attr("title")||"").attr("title","")},c.prototype.hasContent=function(){return this.getTitle()},c.prototype.getPosition=function(b){b=b||this.$element;var c=b[0],d="BODY"==c.tagName,e=c.getBoundingClientRect();null==e.width&&(e=a.extend({},e,{width:e.right-e.left,height:e.bottom-e.top}));var f=d?{top:0,left:0}:b.offset(),g={scroll:d?document.documentElement.scrollTop||document.body.scrollTop:b.scrollTop()},h=d?{width:a(window).width(),height:a(window).height()}:null;return a.extend({},e,g,h,f)},c.prototype.getCalculatedOffset=function(a,b,c,d){return"bottom"==a?{top:b.top+b.height,left:b.left+b.width/2-c/2}:"top"==a?{top:b.top-d,left:b.left+b.width/2-c/2}:"left"==a?{top:b.top+b.height/2-d/2,left:b.left-c}:{top:b.top+b.height/2-d/2,left:b.left+b.width}},c.prototype.getViewportAdjustedDelta=function(a,b,c,d){var e={top:0,left:0};if(!this.$viewport)return e;var f=this.options.viewport&&this.options.viewport.padding||0,g=this.getPosition(this.$viewport);if(/right|left/.test(a)){var h=b.top-f-g.scroll,i=b.top+f-g.scroll+d;h<g.top?e.top=g.top-h:i>g.top+g.height&&(e.top=g.top+g.height-i)}else{var j=b.left-f,k=b.left+f+c;j<g.left?e.left=g.left-j:k>g.right&&(e.left=g.left+g.width-k)}return e},c.prototype.getTitle=function(){var a,b=this.$element,c=this.options;return a=b.attr("data-original-title")||("function"==typeof c.title?c.title.call(b[0]):c.title)},c.prototype.getUID=function(a){do a+=~~(1e6*Math.random());while(document.getElementById(a));return a},c.prototype.tip=function(){if(!this.$tip&&(this.$tip=a(this.options.template),1!=this.$tip.length))throw new Error(this.type+" `template` option must consist of exactly 1 top-level element!");return this.$tip},c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".tooltip-arrow")},c.prototype.enable=function(){this.enabled=!0},c.prototype.disable=function(){this.enabled=!1},c.prototype.toggleEnabled=function(){this.enabled=!this.enabled},c.prototype.toggle=function(b){var c=this;b&&(c=a(b.currentTarget).data("bs."+this.type),c||(c=new this.constructor(b.currentTarget,this.getDelegateOptions()),a(b.currentTarget).data("bs."+this.type,c))),b?(c.inState.click=!c.inState.click,c.isInStateTrue()?c.enter(c):c.leave(c)):c.tip().hasClass("in")?c.leave(c):c.enter(c)},c.prototype.destroy=function(){var a=this;clearTimeout(this.timeout),this.hide(function(){a.$element.off("."+a.type).removeData("bs."+a.type),a.$tip&&a.$tip.detach(),a.$tip=null,a.$arrow=null,a.$viewport=null})};var d=a.fn.tooltip;a.fn.tooltip=b,a.fn.tooltip.Constructor=c,a.fn.tooltip.noConflict=function(){return a.fn.tooltip=d,this}}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.popover"),f="object"==typeof b&&b;(e||!/destroy|hide/.test(b))&&(e||d.data("bs.popover",e=new c(this,f)),"string"==typeof b&&e[b]())})}var c=function(a,b){this.init("popover",a,b)};if(!a.fn.tooltip)throw new Error("Popover requires tooltip.js");c.VERSION="3.3.6",c.DEFAULTS=a.extend({},a.fn.tooltip.Constructor.DEFAULTS,{placement:"right",trigger:"click",content:"",template:'<div class="popover" role="tooltip"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'}),c.prototype=a.extend({},a.fn.tooltip.Constructor.prototype),c.prototype.constructor=c,c.prototype.getDefaults=function(){return c.DEFAULTS},c.prototype.setContent=function(){var a=this.tip(),b=this.getTitle(),c=this.getContent();a.find(".popover-title")[this.options.html?"html":"text"](b),a.find(".popover-content").children().detach().end()[this.options.html?"string"==typeof c?"html":"append":"text"](c),a.removeClass("fade top bottom left right in"),a.find(".popover-title").html()||a.find(".popover-title").hide()},c.prototype.hasContent=function(){return this.getTitle()||this.getContent()},c.prototype.getContent=function(){var a=this.$element,b=this.options;return a.attr("data-content")||("function"==typeof b.content?b.content.call(a[0]):b.content)},c.prototype.arrow=function(){return this.$arrow=this.$arrow||this.tip().find(".arrow")};var d=a.fn.popover;a.fn.popover=b,a.fn.popover.Constructor=c,a.fn.popover.noConflict=function(){return a.fn.popover=d,this}}(jQuery),+function(a){"use strict";function b(c,d){this.$body=a(document.body),this.$scrollElement=a(a(c).is(document.body)?window:c),this.options=a.extend({},b.DEFAULTS,d),this.selector=(this.options.target||"")+" .nav li > a",this.offsets=[],this.targets=[],this.activeTarget=null,this.scrollHeight=0,this.$scrollElement.on("scroll.bs.scrollspy",a.proxy(this.process,this)),this.refresh(),this.process()}function c(c){return this.each(function(){var d=a(this),e=d.data("bs.scrollspy"),f="object"==typeof c&&c;e||d.data("bs.scrollspy",e=new b(this,f)),"string"==typeof c&&e[c]()})}b.VERSION="3.3.6",b.DEFAULTS={offset:10},b.prototype.getScrollHeight=function(){return this.$scrollElement[0].scrollHeight||Math.max(this.$body[0].scrollHeight,document.documentElement.scrollHeight)},b.prototype.refresh=function(){var b=this,c="offset",d=0;this.offsets=[],this.targets=[],this.scrollHeight=this.getScrollHeight(),a.isWindow(this.$scrollElement[0])||(c="position",d=this.$scrollElement.scrollTop()),this.$body.find(this.selector).map(function(){var b=a(this),e=b.data("target")||b.attr("href"),f=/^#./.test(e)&&a(e);return f&&f.length&&f.is(":visible")&&[[f[c]().top+d,e]]||null}).sort(function(a,b){return a[0]-b[0]}).each(function(){b.offsets.push(this[0]),b.targets.push(this[1])})},b.prototype.process=function(){var a,b=this.$scrollElement.scrollTop()+this.options.offset,c=this.getScrollHeight(),d=this.options.offset+c-this.$scrollElement.height(),e=this.offsets,f=this.targets,g=this.activeTarget;if(this.scrollHeight!=c&&this.refresh(),b>=d)return g!=(a=f[f.length-1])&&this.activate(a);if(g&&b<e[0])return this.activeTarget=null,this.clear();for(a=e.length;a--;)g!=f[a]&&b>=e[a]&&(void 0===e[a+1]||b<e[a+1])&&this.activate(f[a])},b.prototype.activate=function(b){this.activeTarget=b,this.clear();var c=this.selector+'[data-target="'+b+'"],'+this.selector+'[href="'+b+'"]',d=a(c).parents("li").addClass("active");
d.parent(".dropdown-menu").length&&(d=d.closest("li.dropdown").addClass("active")),d.trigger("activate.bs.scrollspy")},b.prototype.clear=function(){a(this.selector).parentsUntil(this.options.target,".active").removeClass("active")};var d=a.fn.scrollspy;a.fn.scrollspy=c,a.fn.scrollspy.Constructor=b,a.fn.scrollspy.noConflict=function(){return a.fn.scrollspy=d,this},a(window).on("load.bs.scrollspy.data-api",function(){a('[data-spy="scroll"]').each(function(){var b=a(this);c.call(b,b.data())})})}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.tab");e||d.data("bs.tab",e=new c(this)),"string"==typeof b&&e[b]()})}var c=function(b){this.element=a(b)};c.VERSION="3.3.6",c.TRANSITION_DURATION=150,c.prototype.show=function(){var b=this.element,c=b.closest("ul:not(.dropdown-menu)"),d=b.data("target");if(d||(d=b.attr("href"),d=d&&d.replace(/.*(?=#[^\s]*$)/,"")),!b.parent("li").hasClass("active")){var e=c.find(".active:last a"),f=a.Event("hide.bs.tab",{relatedTarget:b[0]}),g=a.Event("show.bs.tab",{relatedTarget:e[0]});if(e.trigger(f),b.trigger(g),!g.isDefaultPrevented()&&!f.isDefaultPrevented()){var h=a(d);this.activate(b.closest("li"),c),this.activate(h,h.parent(),function(){e.trigger({type:"hidden.bs.tab",relatedTarget:b[0]}),b.trigger({type:"shown.bs.tab",relatedTarget:e[0]})})}}},c.prototype.activate=function(b,d,e){function f(){g.removeClass("active").find("> .dropdown-menu > .active").removeClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!1),b.addClass("active").find('[data-toggle="tab"]').attr("aria-expanded",!0),h?(b[0].offsetWidth,b.addClass("in")):b.removeClass("fade"),b.parent(".dropdown-menu").length&&b.closest("li.dropdown").addClass("active").end().find('[data-toggle="tab"]').attr("aria-expanded",!0),e&&e()}var g=d.find("> .active"),h=e&&a.support.transition&&(g.length&&g.hasClass("fade")||!!d.find("> .fade").length);g.length&&h?g.one("bsTransitionEnd",f).emulateTransitionEnd(c.TRANSITION_DURATION):f(),g.removeClass("in")};var d=a.fn.tab;a.fn.tab=b,a.fn.tab.Constructor=c,a.fn.tab.noConflict=function(){return a.fn.tab=d,this};var e=function(c){c.preventDefault(),b.call(a(this),"show")};a(document).on("click.bs.tab.data-api",'[data-toggle="tab"]',e).on("click.bs.tab.data-api",'[data-toggle="pill"]',e)}(jQuery),+function(a){"use strict";function b(b){return this.each(function(){var d=a(this),e=d.data("bs.affix"),f="object"==typeof b&&b;e||d.data("bs.affix",e=new c(this,f)),"string"==typeof b&&e[b]()})}var c=function(b,d){this.options=a.extend({},c.DEFAULTS,d),this.$target=a(this.options.target).on("scroll.bs.affix.data-api",a.proxy(this.checkPosition,this)).on("click.bs.affix.data-api",a.proxy(this.checkPositionWithEventLoop,this)),this.$element=a(b),this.affixed=null,this.unpin=null,this.pinnedOffset=null,this.checkPosition()};c.VERSION="3.3.6",c.RESET="affix affix-top affix-bottom",c.DEFAULTS={offset:0,target:window},c.prototype.getState=function(a,b,c,d){var e=this.$target.scrollTop(),f=this.$element.offset(),g=this.$target.height();if(null!=c&&"top"==this.affixed)return c>e?"top":!1;if("bottom"==this.affixed)return null!=c?e+this.unpin<=f.top?!1:"bottom":a-d>=e+g?!1:"bottom";var h=null==this.affixed,i=h?e:f.top,j=h?g:b;return null!=c&&c>=e?"top":null!=d&&i+j>=a-d?"bottom":!1},c.prototype.getPinnedOffset=function(){if(this.pinnedOffset)return this.pinnedOffset;this.$element.removeClass(c.RESET).addClass("affix");var a=this.$target.scrollTop(),b=this.$element.offset();return this.pinnedOffset=b.top-a},c.prototype.checkPositionWithEventLoop=function(){setTimeout(a.proxy(this.checkPosition,this),1)},c.prototype.checkPosition=function(){if(this.$element.is(":visible")){var b=this.$element.height(),d=this.options.offset,e=d.top,f=d.bottom,g=Math.max(a(document).height(),a(document.body).height());"object"!=typeof d&&(f=e=d),"function"==typeof e&&(e=d.top(this.$element)),"function"==typeof f&&(f=d.bottom(this.$element));var h=this.getState(g,b,e,f);if(this.affixed!=h){null!=this.unpin&&this.$element.css("top","");var i="affix"+(h?"-"+h:""),j=a.Event(i+".bs.affix");if(this.$element.trigger(j),j.isDefaultPrevented())return;this.affixed=h,this.unpin="bottom"==h?this.getPinnedOffset():null,this.$element.removeClass(c.RESET).addClass(i).trigger(i.replace("affix","affixed")+".bs.affix")}"bottom"==h&&this.$element.offset({top:g-b-f})}};var d=a.fn.affix;a.fn.affix=b,a.fn.affix.Constructor=c,a.fn.affix.noConflict=function(){return a.fn.affix=d,this},a(window).on("load",function(){a('[data-spy="affix"]').each(function(){var c=a(this),d=c.data();d.offset=d.offset||{},null!=d.offsetBottom&&(d.offset.bottom=d.offsetBottom),null!=d.offsetTop&&(d.offset.top=d.offsetTop),b.call(c,d)})})}(jQuery);
/*! enscroll - v0.6.2 - 2016-03-24
* Copyright (c) 2016 ; Licensed  */
!function(a,b,c,d){var e={verticalScrolling:!0,horizontalScrolling:!1,verticalScrollerSide:"right",showOnHover:!1,scrollIncrement:20,minScrollbarLength:40,pollChanges:!0,drawCorner:!0,drawScrollButtons:!1,clickTrackToScroll:!0,easingDuration:500,propagateWheelEvent:!0,verticalTrackClass:"vertical-track",horizontalTrackClass:"horizontal-track",horizontalHandleClass:"horizontal-handle",verticalHandleClass:"vertical-handle",scrollUpButtonClass:"scroll-up-btn",scrollDownButtonClass:"scroll-down-btn",scrollLeftButtonClass:"scroll-left-btn",scrollRightButtonClass:"scroll-right-btn",cornerClass:"scrollbar-corner",zIndex:1,addPaddingToPane:!0,horizontalHandleHTML:'<div class="left"></div><div class="right"></div>',verticalHandleHTML:'<div class="top"></div><div class="bottom"></div>'},f=function(a){a.preventDefault?a.preventDefault():a.returnValue=!1,a.stopPropagation?a.stopPropagation():a.cancelBubble=!0},g=b.requestAnimationFrame||b.mozRequestAnimationFrame||b.webkitRequestAnimationFrame||b.oRequestAnimationFrame||b.msRequestAnimationFrame||function(a){setTimeout(a,17)},h=function(b,c){var d=a(b).css(c),e=/^-?\d+/.exec(d);return e?+e[0]:0},i=function(a){var b,c,d={width:"5px",height:"1px",overflow:"hidden",padding:"8px 0",visibility:"hidden",whiteSpace:"pre-line",font:"10px/1 serif"},e=document.createElement(a),f=document.createTextNode("a\na");for(c in d)e.style[c]=d[c];return e.appendChild(f),document.body.appendChild(e),b=e.scrollHeight<28,document.body.removeChild(e),b},j=.5*Math.PI,k=10*Math.log(2),l=function(a,b,c){var d=j/b,e=a*d;return Math.round(e*Math.cos(d*c))},m=function(a,b,c){return Math.round(a*k*Math.pow(2,-10*c/b+1)/b)},n=function(a,b,c,d){return 2*c/Math.PI*Math.asin((d-a)/b)},o=function(b){var c=a(this).data("enscroll"),d=this,e=c.settings,f=function(){var b=a(this).data("enscroll"),c=b.settings;b&&c.showOnHover&&(c.verticalScrolling&&a(b.verticalTrackWrapper).is(":visible")&&a(b.verticalTrackWrapper).stop().fadeTo(275,0),c.horizontalScrolling&&a(b.horizontalTrackWrapper).is(":visible")&&a(b.horizontalTrackWrapper).stop().fadeTo(275,0),b._fadeTimer=null)};c&&e.showOnHover&&(c._fadeTimer?clearTimeout(c._fadeTimer):(e.verticalScrolling&&a(c.verticalTrackWrapper).is(":visible")&&a(c.verticalTrackWrapper).stop().fadeTo(275,1),e.horizontalScrolling&&a(c.horizontalTrackWrapper).is(":visible")&&a(c.horizontalTrackWrapper).stop().fadeTo(275,1)),b!==!1&&(c._fadeTimer=setTimeout(function(){f.call(d)},1750)))},p=function(b,c){var d=a(b),e=d.data("enscroll"),f=d.scrollTop();e&&e.settings.verticalScrolling&&(d.scrollTop(f+c),e.settings.showOnHover&&o.call(b))},q=function(b,c){var d=a(b),e=d.data("enscroll"),f=d.scrollLeft();e&&e.settings.horizontalScrolling&&(d.scrollLeft(f+c),e.settings.showOnHover&&o.call(b))},r=function(b){if(1===b.which){var d,e,f,h,i,j,k,l,m,n=b.data.pane,p=a(n),q=p.data("enscroll"),r=!0,s=function(){r&&(f!==h&&(q._scrollingY||(q._scrollingY=!0,q._startY=p.scrollTop(),g(function(){t(p)})),e.style.top=f+"px",q._endY=f*m/l,h=f),g(s),q.settings.showOnHover&&o.call(n))},u=function(a){return r&&(f=a.clientY-j-i,f=Math.min(0>f?0:f,l)),!1},v=function(){return r=!1,c.body.style.cursor=k,this.style.cursor="",d.removeClass("dragging"),a(c.body).off("mousemove.enscroll.vertical").off("mouseup.enscroll.vertical"),a(c).off("mouseout.enscroll.vertical"),p.on("scroll.enscroll.pane",function(a){x.call(this,a)}),!1};return d=a(q.verticalTrackWrapper).find(".enscroll-track"),e=d.children().first()[0],f=parseInt(e.style.top,10),m=n.scrollHeight-(q._scrollHeightNoPadding?a(n).height():a(n).innerHeight()),i=b.clientY-a(e).offset().top,l=d.height()-a(e).outerHeight(),j=d.offset().top,p.off("scroll.enscroll.pane"),a(c.body).on({"mousemove.enscroll.vertical":u,"mouseup.enscroll.vertical":function(a){v.call(e,a)}}),a(c).on("mouseout.enscroll.vertical",function(a){a.target.nodeName&&"HTML"===a.target.nodeName.toUpperCase()&&v.call(e,a)}),d.hasClass("dragging")||(d.addClass("dragging"),k=a(c.body).css("cursor"),this.style.cursor=c.body.style.cursor="ns-resize"),g(s),!1}},s=function(b){if(1===b.which){var d,e,f,h,i,j,k,l,m,n=b.data.pane,p=a(n),q=a(n).data("enscroll"),r=!0,s=function(){r&&(f!==h&&(q._scrollingX||(q._scrollingX=!0,q._startX=p.scrollLeft(),g(function(){t(p)})),e.style.left=f+"px",q._endX=f*i/m,h=f),g(s),q.settings.showOnHover&&o.call(n))},u=function(a){return r&&(f=a.clientX-k-j,f=Math.min(0>f?0:f,m)),!1},v=function(){return r=!1,d.removeClass("dragging"),c.body.style.cursor=l,this.style.cursor="",d.removeClass("dragging"),a(c.body).off("mousemove.enscroll.horizontal").off("mouseup.enscroll.horizontal"),a(c).off("mouseout.enscroll.horizontal"),p.on("scroll.enscroll.pane",function(a){x.call(this,a)}),!1};return d=a(q.horizontalTrackWrapper).find(".enscroll-track"),e=d.children().first()[0],f=parseInt(e.style.left,10),i=n.scrollWidth-a(n).innerWidth(),j=b.clientX-a(e).offset().left,m=d.width()-a(e).outerWidth(),k=d.offset().left,p.off("scroll.enscroll.pane"),a(c.body).on({"mousemove.enscroll.horizontal":u,"mouseup.enscroll.horizontal":function(a){v.call(e,a)}}),a(c).on("mouseout.enscroll.horizontal",function(a){a.target.nodeName&&"HTML"===a.target.nodeName.toUpperCase()&&v.call(e,a)}),d.hasClass("dragging")||(d.addClass("dragging"),l=a("body").css("cursor"),this.style.cursor=c.body.style.cursor="ew-resize"),g(s),!1}},t=function(a){var b,c,d,e=a.data("enscroll"),f=e._duration;e._scrollingX===!0&&(b=e._endX-e._startX,0===b?e._scrollingX=!1:(c=a.scrollLeft(),d=n(e._startX,b,f,c),b>0?c>=e._endX||c<e._startX?e._scrollingX=!1:(q(a,Math.max(1,l(b,f,d))),g(function(){t(a)})):c<=e._endX||c>e._startX?e._scrollingX=!1:(q(a,Math.min(-1,l(b,f,d))),g(function(){t(a)})))),e._scrollingY===!0&&(b=e._endY-e._startY,0===b?e._scrollingY=!1:(c=a.scrollTop(),d=n(e._startY,b,f,c),b>0?c>=e._endY||c<e._startY?e._scrollingY=!1:(p(a,Math.max(1,l(b,f,d))),g(function(){t(a)})):c<=e._endY||c>e._startY?e._scrollingY=!1:(p(a,Math.min(-1,l(b,f,d))),g(function(){t(a)}))))},u=function(a,b){var c=a.data("enscroll"),d=a.scrollLeft(),e=a[0].scrollWidth-a.innerWidth();return!c.settings.horizontalScrolling||c._scrollingY?!1:(c._scrollingX||(c._scrollingX=!0,c._startX=d,c._endX=c._startX,g(function(){t(a)})),c._endX=b>0?Math.min(d+b,e):Math.max(0,d+b),0>b&&d>0||b>0&&e>d)},v=function(a,b){var c=a.data("enscroll"),d=a.scrollTop(),e=a[0].scrollHeight-(c._scrollHeightNoPadding?a.height():a.innerHeight());return!c.settings.verticalScrolling||c._scrollingX?!1:(c._scrollingY||(c._scrollingY=!0,c._startY=d,c._endY=c._startY,g(function(){t(a)})),c._endY=b>0?Math.min(d+b,e):Math.max(0,d+b),0>b&&d>0||b>0&&e>d)},w=function(b){var c,d=a(this),e=d.data("enscroll"),g=e.settings.scrollIncrement,h="deltaX"in b?-b.deltaX:"wheelDeltaX"in b?b.wheelDeltaX:0,i="deltaY"in b?-b.deltaY:"wheelDeltaY"in b?b.wheelDeltaY:"wheelDelta"in b?b.wheelDelta:0;Math.abs(h)>Math.abs(i)&&0!==h?(c=(h>0?-g:g)<<2,(u(d,c)||!e.settings.propagateWheelEvent)&&f(b)):0!==i&&(c=(i>0?-g:g)<<2,(v(d,c)||!e.settings.propagateWheelEvent)&&f(b))},x=function(){var b,c,d,e=a(this),f=e.data("enscroll");f&&(f.settings.verticalScrolling&&(c=a(f.verticalTrackWrapper).find(".enscroll-track")[0],b=c.firstChild,d=e.scrollTop()/(this.scrollHeight-(f._scrollHeightNoPadding?e.height():e.innerHeight())),d=isNaN(d)?0:d,b.style.top=d*(a(c).height()-a(b).outerHeight())+"px"),f.settings.horizontalScrolling&&(c=a(f.horizontalTrackWrapper).find(".enscroll-track")[0],b=c.firstChild,d=e.scrollLeft()/(this.scrollWidth-e.innerWidth()),d=isNaN(d)?0:d,b.style.left=d*(a(c).width()-a(b).innerWidth())+"px"))},y=function(b){var c,d=a(this),e=d.data("enscroll");if(!/(input)|(select)|(textarea)/i.test(this.nodeName)&&b.target===this&&e){switch(c=e.settings.scrollIncrement,b.keyCode){case 32:case 34:return v(d,d.height()),!1;case 33:return v(d,-d.height()),!1;case 35:return v(d,this.scrollHeight),!1;case 36:return v(d,-this.scrollHeight),!1;case 37:return u(d,-c),!1;case 38:return v(d,-c),!1;case 39:return u(d,c),!1;case 40:return v(d,c),!1}return!0}},z=function(){var b=this,d=a(b).data("enscroll").settings,e=!0,f=0,h=0,i=a(b).offset().top,j=i+a(b).outerHeight(),k=a(b).offset().left,l=k+a(b).outerWidth(),m=function(a){var b=a.pageX,c=a.pageY;f=k>b?b-k:b>l?b-l:0,h=i>c?c-i:c>j?c-j:0},n=function(){d.horizontalScrolling&&f&&q(b,parseInt(f/4,10)),d.verticalScrolling&&h&&p(b,parseInt(h/4,10)),e&&g(n)},o=function(){e=!1,a(c).off("mousemove.enscroll.pane").off("mouseup.enscroll.pane")};g(n),a(c).on({"mousemove.enscroll.pane":m,"mouseup.enscroll.pane":o})},A=function(a){var b,c,e,h,i,j,k,l=this,n=function(a){b=a.touches[0].clientX,c=a.touches[0].clientY,e||(e=c===i&&b===h?d:Math.abs(i-c)>Math.abs(h-b)?"y":"x"),f(a)},o=function(){j&&("y"===e?(p(l,i-c),k=i-c,i=c):"x"===e&&(q(l,h-b),k=h-b,h=b),g(o))},r=function(){var a=0,b=Math.abs(1.5*k);this.removeEventListener("touchmove",n,!1),this.removeEventListener("touchend",r,!1),j=!1,g(function c(){var d;a===b||j||(d=m(k,b,a),isNaN(d)||0===d||(a+=1,"y"===e?p(l,d):q(l,d),g(c)))})};1===a.touches.length&&(h=a.touches[0].clientX,i=a.touches[0].clientY,j=!0,this.addEventListener("touchmove",n,!1),this.addEventListener("touchend",r,!1),g(o))},B={reposition:function(){return this.each(function(){var b,c,d,e=a(this),f=e.data("enscroll"),g=function(a,b,c){a.style.left=b+"px",a.style.top=c+"px"};f&&(d=e.position(),b=f.corner,f.settings.verticalScrolling&&(c=f.verticalTrackWrapper,g(c,"right"===f.settings.verticalScrollerSide?d.left+e.outerWidth()-a(c).width()-h(this,"border-right-width"):d.left+h(this,"border-left-width"),d.top+h(this,"border-top-width"))),f.settings.horizontalScrolling&&(c=f.horizontalTrackWrapper,g(c,d.left+h(this,"border-left-width"),d.top+e.outerHeight()-a(c).height()-h(this,"border-bottom-width"))),b&&g(b,d.left+e.outerWidth()-a(b).outerWidth()-h(this,"border-right-width"),d.top+e.outerHeight()-a(b).outerHeight()-h(this,"border-bottom-width")))})},resize:function(){return this.each(function(){var b,c,d,e,f,g,h,i,j,k,l,m,n,o,p,q,r=a(this),s=r.data("enscroll");return s?(b=s.settings,void(r.is(":visible")?(b.verticalScrolling&&(e=s.verticalTrackWrapper,c=r.innerHeight(),f=c/this.scrollHeight,g=a(e).find(".enscroll-track")[0],j=a(e).find("."+b.scrollUpButtonClass),k=a(e).find("."+b.scrollDownButtonClass),i=b.horizontalScrolling?c-a(s.horizontalTrackWrapper).find(".enscroll-track").outerHeight():c,i-=a(g).outerHeight()-a(g).height()+j.outerHeight()+k.outerHeight(),n=g.firstChild,p=Math.max(f*i,b.minScrollbarLength),p-=a(n).outerHeight()-a(n).height(),e.style.display="none",g.style.height=i+"px",n.style.height=p+"px",1>f&&(f=r.scrollTop()/(this.scrollHeight-r.height()),n.style.top=f*(i-p)+"px",e.style.display="block")),b.horizontalScrolling&&(e=s.horizontalTrackWrapper,d=r.innerWidth(),f=d/this.scrollWidth,g=a(e).find(".enscroll-track")[0],l=a(e).find("."+b.scrollLeftButtonClass),m=a(e).find("."+b.scrollRightButtonClass),h=b.verticalScrolling?d-a(s.verticalTrackWrapper).find(".enscroll-track").outerWidth():d,h-=a(g).outerWidth()-a(g).width()+l.outerWidth()+m.outerWidth(),n=g.firstChild,o=Math.max(f*h,b.minScrollbarLength),o-=a(n).outerWidth()-a(n).width(),e.style.display="none",g.style.width=h+"px",n.style.width=o+"px",1>f&&(f=r.scrollLeft()/(this.scrollWidth-r.width()),n.style.left=f*(h-o)+"px",e.style.display="block"),s._prybar&&(q=s._prybar,this.removeChild(q),b.verticalScrolling&&(q.style.width=this.scrollWidth+a(s.verticalTrackWrapper).find(".enscroll-track").outerWidth()+"px",this.appendChild(q)))),s.corner&&(s.corner.style.display=s.verticalTrackWrapper&&s.horizontalTrackWrapper&&a(s.verticalTrackWrapper).is(":visible")&&a(s.horizontalTrackWrapper).is(":visible")?"":"none")):(b.verticalScrolling&&(s.verticalTrackWrapper.style.display="none"),b.horizontalScrolling&&(s.horizontalTrackWrapper.style.display="none"),s.corner&&(s.corner.style.display="none")))):!0})},startPolling:function(){return this.each(function(){var b,c=a(this).data("enscroll"),d=this,e=a(d),f=-1,g=-1,h=-1,i=-1,j=function(){if(c.settings.pollChanges){var a=d.scrollWidth,k=d.scrollHeight,l=e.width(),m=e.height(),n=e.offset();(c.settings.verticalScrolling&&(m!==g||k!==i)||c.settings.horizontalScrolling&&(l!==f||a!==h))&&(h=a,i=k,B.resize.call(e)),(b.left!==n.left||b.top!==n.top||l!==f||m!==g)&&(b=n,f=l,g=m,B.reposition.call(e)),setTimeout(j,350)}};c&&(c.settings.pollChanges=!0,i=d.scrollHeight,h=d.scrollWidth,b=e.offset(),j())})},stopPolling:function(){return this.each(function(){var b=a(this).data("enscroll");b&&(b.settings.pollChanges=!1)})},destroy:function(){return this.each(function(){var c,d,e=a(this),f=e.data("enscroll");f&&(B.stopPolling.call(e),d=f._mouseScrollHandler,f.settings.verticalScrolling&&(c=f.verticalTrackWrapper,a(c).remove(),c=null),f.settings.horizontalScrolling&&(c=f.horizontalTrackWrapper,a(c).remove(),c=null),f._fadeTimer&&clearTimeout(f._fadeTimer),f.corner&&a(f.corner).remove(),f._prybar&&f._prybar.parentNode&&f._prybar.parentNode===this&&a(f._prybar).remove(),this.setAttribute("style",f._style||""),f._hadTabIndex||e.removeAttr("tabindex"),e.off("scroll.enscroll.pane").off("keydown.enscroll.pane").off("mouseenter.enscroll.pane").off("mousedown.enscroll.pane").data("enscroll",null),this.removeEventListener?(this.removeEventListener("wheel",d,!1),this.removeEventListener("mousewheel",d,!1),this.removeEventListener("touchstart",A,!1)):this.detachEvent&&this.detachEvent("onmousewheel",d),a(b).off("resize.enscroll.window"))})}};a.fn.enscroll=function(d){var f;return B[d]?B[d].call(this):(f=a.extend({},e,d),this.each(function(){if(f.verticalScrolling||f.horizontalScrolling){var d,e,g,j,k,l,m,n,t,C,D,E,F,G,H,I,J,K,L=a(this),M=this,N=L.attr("style"),O=!0,P={position:"absolute","z-index":f.zIndex,margin:0,padding:0},Q=function(a){w.call(M,a)},R=function(b,c){"string"==typeof c?a(b).html(c):b.appendChild(c)};if(f.verticalScrolling){e=c.createElement("div"),j=c.createElement("div"),l=c.createElement("a"),a(j).css("position","relative").addClass("enscroll-track").addClass(f.verticalTrackClass).appendTo(e),f.drawScrollButtons&&(m=c.createElement("a"),n=c.createElement("a"),a(m).css({display:"block","text-decoration":"none"}).attr("href","").html("&nbsp;").addClass(f.scrollUpButtonClass).on("click",function(){return p(M,-f.scrollIncrement),!1}).insertBefore(j),a(n).css({display:"block","text-decoration":"none"}).attr("href","").html("&nbsp;").on("click",function(){return p(M,f.scrollIncrement),!1}).addClass(f.scrollDownButtonClass).appendTo(e)),f.clickTrackToScroll&&a(j).on("click",function(b){b.target===this&&v(L,b.pageY>a(l).offset().top?L.height():-L.height())}),a(l).css({position:"absolute","z-index":1}).attr("href","").addClass(f.verticalHandleClass).mousedown({pane:this},r).click(function(){return!1}).appendTo(j),R(l,f.verticalHandleHTML),a(e).css(P).insertAfter(this),f.showOnHover&&a(e).css("opacity",0).on("mouseover.enscroll.vertical",function(){o.call(M,!1)}).on("mouseout.enscroll.vertical",function(){o.call(M)}),E=a(j).outerWidth(),f.addPaddingToPane&&(K="right"===f.verticalScrollerSide?{"padding-right":h(this,"padding-right")+E+"px"}:{"padding-left":h(this,"padding-left")+E+"px"},L.css(a.extend({width:L.width()-E+"px"},K)));try{I=parseInt(L.css("outline-width"),10),0!==I&&!isNaN(I)||"none"!==L.css("outline-style")||L.css("outline","none")}catch(S){L.css("outline","none")}}f.horizontalScrolling&&(d=c.createElement("div"),g=c.createElement("div"),k=c.createElement("a"),a(g).css({position:"relative","z-index":1}).addClass("enscroll-track").addClass(f.horizontalTrackClass).appendTo(d),f.drawScrollButtons&&(t=c.createElement("a"),C=c.createElement("a"),a(t).css("display","block").attr("href","").on("click",function(){return q(M,-f.scrollIncrement),!1}).addClass(f.scrollLeftButtonClass).insertBefore(g),a(C).css("display","block").attr("href","").on("click",function(){return q(M,f.scrollIncrement),!1}).addClass(f.scrollRightButtonClass).appendTo(d)),f.clickTrackToScroll&&a(g).on("click",function(b){b.target===this&&u(L,b.pageX>a(k).offset().left?L.width():-L.width())}),a(k).css({position:"absolute","z-index":1}).attr("href","").addClass(f.horizontalHandleClass).click(function(){return!1}).mousedown({pane:this},s).appendTo(g),R(k,f.horizontalHandleHTML),a(d).css(P).insertAfter(this),f.showOnHover&&a(d).css("opacity",0).on("mouseover.enscroll.horizontal",function(){o.call(M,!1)}).on("mouseout.enscroll.horizontal",function(){o.call(M)}),D=a(g).outerHeight(),f.addPaddingToPane&&L.css({height:L.height()-D+"px","padding-bottom":parseInt(L.css("padding-bottom"),10)+D+"px"}),f.verticalScrolling&&(J=document.createElement("div"),a(J).css({width:"1px",height:"1px",visibility:"hidden",padding:0,margin:"-1px"}).appendTo(this))),f.verticalScrolling&&f.horizontalScrolling&&f.drawCorner&&(F=c.createElement("div"),a(F).addClass(f.cornerClass).css(P).insertAfter(this)),H=L.attr("tabindex"),H||(L.attr("tabindex",0),O=!1);try{G=L.css("outline"),(!G||G.length<1)&&L.css("outline","none")}catch(S){L.css("outline","none")}L.on({"scroll.enscroll.pane":function(a){x.call(this,a)},"keydown.enscroll.pane":y,"mousedown.enscroll.pane":z}).css("overflow","hidden").data("enscroll",{settings:f,horizontalTrackWrapper:d,verticalTrackWrapper:e,corner:F,_prybar:J,_mouseScrollHandler:Q,_hadTabIndex:O,_style:N,_scrollingX:!1,_scrollingY:!1,_startX:0,_startY:0,_endX:0,_endY:0,_duration:parseInt(f.easingDuration/16.66666,10),_scrollHeightNoPadding:i(this.nodeName)}),a(b).on("resize.enscroll.window",function(){B.reposition.call(L)}),f.showOnHover&&L.on("mouseenter.enscroll.pane",function(){o.call(this)}),this.addEventListener?("onwheel"in this||"WheelEvent"in b&&navigator.userAgent.toLowerCase().indexOf("msie")>=0?this.addEventListener("wheel",Q,!1):"onmousewheel"in this&&this.addEventListener("mousewheel",Q,!1),this.addEventListener("touchstart",A,!1)):this.attachEvent&&this.attachEvent("onmousewheel",Q),f.pollChanges&&B.startPolling.call(L),B.resize.call(L),B.reposition.call(L)}}))}}(jQuery,window,document);


//layout js
//function doLogin(){if(formSubmit("login_user")){$(".load-layout-image").show();var o=$("#login_email").val(),r=$("#remberme").is(':checked'),s=$("#login_pass").val();$.ajax({url:base_url+"user/doLogin",type:"POST",async:!1,data:"ajax=true&email="+o+"&remberme="+r+"&pass="+s,success:function(o,s,r,e){return"success"!=o?($(".load-layout-image").hide(),$(".login_error_msg").html('<i class="fa fa-times-circle"></i> Invalid Username or Password').css("display","block"),!1):($(".load-layout-image").hide(),void(window.location.href=base_url))}})}return!1}function doForgot(){if($(".forgot_error_msg").hide(),$("#forgot_user").find(".error").remove(),formSubmit("forgot_user")){$(".load-forgot-image").show();var o=$("#forgotusername").val(),s={ajax:"true",email:o};$.ajax({url:base_url+"user/savechangepassword",type:"POST",dataType:"json",async:!1,data:s,success:function(o){"success"==o.status?($(".forgot_error_msg").hide(),$(".forgot_success_msg").html('<i class="fa fa-check-circle-o"></i>'+o.message).show()):($(".forgot_success_msg").hide(),$(".forgot_error_msg").html('<i class="fa fa-times-circle"></i>'+o.message).show()),$(".load-forgot-image").hide()}})}return!1}function updatepoststatus(){$.ajax({url:base_url+"posts/updatepoststatus",method:"POST",dataType:"json"}).done(function(o){$("#badge").css("display","none")})}function helpBlock(){$(".error_msg").css("display","none"),$(".login-holder").css("display","none"),$(".forgot-holder").css("display","block")}function loginblock(){$(".forgot_error_msg").css("display","none"),$(".forgot_success_msg").css("display","none"),$(".forgot-holder").css("display","none"),$(".login-holder").css("display","block")}function layout_loadmore(){$(".load-top-image").show();var o=$("#layout_postdata").find("li").last().attr("id"),s=o.split("notifiction_");o=s[1],$.ajax({url:base_url+"home/getnotificationpost",method:"POST",data:{post_id:o},dataType:"json",async:!1}).done(function(o){$(".notifi-count").removeClass("openv").addClass("openv"),$("#layout_postdata").append(o),$(".load-top-image").hide()})}function formSubmit(o){$("#shipping_terms").length>0&&($("#shipping_terms").is(":checked")?error_remove($("#shipping_terms")):(globalError="Accept Terms and Conditons",error_display($("#shipping_terms")))),$("#"+o+" .required").each(function(){console.log($(this)),required_valid($(this))});var s="",e="",a="",r="";return $("#"+o+" .pass").each(function(){s=$(this).val(),e=$(this),required_valid($(this))}),$("#"+o+" .pincode").each(function(){pincode_valid($(this))}),$("#"+o+" .cpass").each(function(){a=$(this).val(),r=$(this),required_valid($(this))}),""!=s&&""!=a&&s!=a&&(globalError="Confirm Password is not Matching",error_display(r)),$("#"+o+" .email").each(function(){email_valid($(this))}),$("#"+o+" .mobile").each(function(){mobile_valid($(this))}),$("#"+o+" .door").each(function(){door_valid($(this))}),$("#"+o+" .alpha").each(function(){alpha_valid($(this))}),$("#"+o+" .numeric").each(function(){numeric_valid($(this))}),$("#"+o+" .float").each(function(){float_valid($(this))}),$("#"+o+" .url").each(function(){globalError="Enter valid website url",url_valid($(this))}),$("#"+o+" .invalid").length>0?($(".tab-content").length>0&&(flag=!0,i=0,$(".tab-content .tab-pane").each(function(){$(this).find(".invalid").length>0&&1==flag&&(flag=!1,$("#myTab li").removeClass("active"),$("#myTab li:eq("+i+")").addClass("active"),$(".tab-content .tab-pane").removeClass("active").removeClass("in"),$(this).addClass("active").addClass("in")),i++})),!1):!0}$(document).ready(function(){$("#helpBlock").click(function(){$(".login-holder").css("display","none"),$(".forgot-holder").css("display","block")}),$("#login-block").click(function(){$(".forgot_error_msg").css("display","none"),$(".forgot_success_msg").css("display","none"),$(".forgot-holder").css("display","none"),$(".login-holder").css("display","block")}),$("#scrollbox4").enscroll({verticalTrackClass:"track4",verticalHandleClass:"handle4",minScrollbarLength:28}),$("#scrollbox4").on("scroll",function(){$(this).scrollTop()+$(this).innerHeight()>=$(this)[0].scrollHeight&&layout_loadmore()})}),$("#myModal").on("show.bs.modal",function(o){$("#login_user")[0].reset(),$("#forgot_user")[0].reset(),$("#register_user").length>0&&$("#register_user")[0].reset(),$("p.error").hide(),$(".required").removeClass("invalid"),$('.login_error_msg').css('display','none'),$(".email").removeClass("invalid"),$(".forgot_error_msg").hide(),$(".home_login_error_msg").hide(),$(".forgot_success_msg").hide(),$(".error_msg").hide()});var globalError="";

function doLogin()
		  {
			  
			   if(formSubmit('login_user'))
			   {        $('.load-layout-image').show();
						var email = $('#login_email').val(); 
						var pass = $('#login_pass').val();
						var dest_url = $('#dest_url').val();
						 
						$.ajax({
							url:  base_url+ 'user/doLogin',
							type: 'POST',
							async : false,
							data: 'ajax=true&email='+email+'&pass='+pass+'&dest_url='+dest_url,
							success: function(data, textStatus, jqXHR)
							{
								 var msg = jQuery.parseJSON(data); 
								 
								 if(msg.isLoggedin)
								 {
									if(msg.email_exist)
									{
										 if(dest_url!=''){
											window.location.href=dest_url;
									      }
										 else{ 
										      
											 if(msg.showBranch){
                                             window.location.href=base_url+'user/brachUpdate';
											 }else{
											  window.location.href=base_url;	 
											 }
										 }
									} 
									 else
									     { 
									      if(msg.showBranch){
											  
									       window.location.href=base_url+'user/brachUpdate';
										   }else if(msg.mobile_exist){
											 window.location.href=base_url+'user/registeremail';
												}else{
													  
												  window.location.href=base_url;
												}
										   }
								 } 
							   else
							   {
								      $('.load-layout-image').hide();
									  $('.login_error_msg').html('<i class="fa fa-times-circle"></i> Invalid Username or Password').css('display','block')
									  return false;
								}
							}
							 
						}); 
			   
		      }
		      return false;
		  }
		  
function insertBrachDetails(){
	{
			  
			   if(formSubmit('login_branch'))
			   {        $('.load-layout-image').show();
						var branch = $('#branch_name').val(); 
						var passout_year = $('#passout_year').val();
						var course = $('#course').val();
						$.ajax({
							url:  base_url+ 'user/insertbranchdetails' ,
							type: 'POST',
							async : false,
							data: 'ajax=true&branch_name='+branch+'&passout_year='+passout_year+'&course='+course,
							success: function(data, textStatus, jqXHR)
							{
								
								
								var msg = jQuery.parseJSON(data); 
								 
								 if(msg.isLoggedin)
								 {
									if(msg.email_exist)
									{
										 if(dest_url!='')
											window.location.href=dest_url;
										 else
											window.location.href=base_url;
									} 
									 else
									    window.location.href=base_url+'user/registeremail';
								 } 
							   else
							   {
								      $('.load-layout-image').hide();
									  $('.login_error_msg').html('<i class="fa fa-times-circle"></i> Invalid Username or Password').css('display','block')
									  return false;
								}
							}
							 
						}); 
			   
		      }
		      return false;
		  }
	
}		  
function doForgot()
  {
	   $('.forgot_error_msg').hide();
	   $('#forgot_user').find('.error').remove();
	   if(formSubmit('forgot_user'))
	   {
		        $('.load-forgot-image').show();
				var uname = $('#forgotusername').val(); 
				 var fu  = {'ajax':'true','email':uname};
				$.ajax({
					url:  base_url+ 'user/savechangepassword' ,
					type: 'POST',
				    dataType: "json",
					async : false,
					data: fu,
					success: function(data)
					{
					 	 
					  if(data.status=='success')
					  {
						   
						  $('.forgot_error_msg').hide();
						  $('.load-forgot-image').hide();
						   $('.forgot_success_msg').html('<i class="fa fa-check-circle-o"></i>'+data.message).show();
					  }else
					  {
						   $('.forgot_success_msg').hide();
						   $('.forgot_error_msg').html('<i class="fa fa-times-circle"></i>'+data.message).show();
					  } 
					   $('.load-forgot-image').hide();
					}
				}); 
	   }
	  
	   return false;
  }
function updatepoststatus(){
	$.ajax({
		url: base_url+"posts/updatepoststatus",
		method: "POST",
		//data: postdata,
		dataType: "json"
	}).done(function(msg){
		$("#badge").css('display','none');
	});
}
function helpBlock()
{
	$('.error_msg').css('display','none');
	 $('.login-holder').css('display','none');
    $('.forgot-holder').css('display','block');
}

function loginblock()
{
 
	 $('.forgot_error_msg').css('display','none');
	 $('.forgot_success_msg').css('display','none');
	 $('.forgot-holder').css('display','none');
	 $('.login-holder').css('display','block'); 
}

$( document ).ready(function() {
   $( "#helpBlock" ).click(function() {
	 
	$('.login-holder').css('display','none');
    $('.forgot-holder').css('display','block');
});
$( "#login-block" ).click(function() {
	 $('.forgot_error_msg').css('display','none');
	 $('.forgot_success_msg').css('display','none');
	 $('.forgot-holder').css('display','none');
	 $('.login-holder').css('display','block')
});
$('#scrollbox4').enscroll({
    verticalTrackClass: 'track4',
    verticalHandleClass: 'handle4',
    minScrollbarLength: 28
});
 $('#scrollbox4').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
           layout_loadmore();
        }
    });
    
$('.scrollbox6').enscroll({
    verticalTrackClass: 'track4',
    verticalHandleClass: 'handle4',
    minScrollbarLength: 28
});

    $('.scrollbox6').on('scroll', function() {
        if($(this).scrollTop() + $(this).innerHeight() >= $(this)[0].scrollHeight) {
           layout_loadmore();
        }
    });    
     
 
})





function layout_loadmore(){
	  
		 
		$('.load-top-image').show();
		var id=$("#layout_postdata").find('li').last().attr('id');
		var strsplt = id.split('notifiction_');
		id = strsplt[1];
		
		$.ajax({
		url: base_url+"home/getnotificationpost",
		method: "POST",
		data: { post_id: id},
		dataType: "json",
		async: false
	}).done(function(msg){
		$('.notifi-count').removeClass('openv').addClass('openv'); 
		$('#layout_postdata').append(msg); 
		$('.load-top-image').hide(); 
	});
}
 
 $('#myModal').on('show.bs.modal', function (e) {
    $('#login_user')[0].reset();
    $('#forgot_user')[0].reset();
    if($('#register_user').length>0)
     $('#register_user')[0].reset();
    $('p.error').hide();
    $('.required').removeClass('invalid');
    $('.email').removeClass('invalid');
    $('.forgot_error_msg').hide();
    $('.home_login_error_msg').hide();
    $('.forgot_success_msg').hide();
    $('.error_msg').hide();
})

 
/*function formSubmit(r){$("#shipping_terms").length>0&&($("#shipping_terms").is(":checked")?error_remove($("#shipping_terms")):(globalError="Accept Terms and Conditons",error_display($("#shipping_terms")))),$("#"+r+" .required").each(function(){console.log($(this)),required_valid($(this))});var a="",e="",t="",o="";return $("#"+r+" .pass").each(function(){a=$(this).val(),e=$(this),required_valid($(this))}),$("#"+r+" .pincode").each(function(){pincode_valid($(this))}),$("#"+r+" .cpass").each(function(){t=$(this).val(),o=$(this),required_valid($(this))}),$("#"+r+" .passwordstrength").each(function(){checkPassStrength($(this))}),""!=a&&""!=t&&a!=t&&(globalError="Confirm Password is not Matching",error_display(o)),$("#"+r+" .email").each(function(){email_valid($(this))}),$("#"+r+" .mobile").each(function(){mobile_valid($(this))}),$("#"+r+" .door").each(function(){door_valid($(this))}),$("#"+r+" .alpha").each(function(){alpha_valid($(this))}),$("#"+r+" .numeric").each(function(){numeric_valid($(this))}),$("#"+r+" .float").each(function(){float_valid($(this))}),$("#"+r+" .url").each(function(){globalError="Enter valid website url",url_valid($(this))}),$("#"+r+" .invalid").length>0?($(".tab-content").length>0&&(flag=!0,i=0,$(".tab-content .tab-pane").each(function(){$(this).find(".invalid").length>0&&1==flag&&(flag=!1,$("#myTab li").removeClass("active"),$("#myTab li:eq("+i+")").addClass("active"),$(".tab-content .tab-pane").removeClass("active").removeClass("in"),$(this).addClass("active").addClass("in")),i++})),!1):!0}function required_valid(r){var a="";a=$("#message_form").length>0?$.trim(r.select2("val")):$.trim(r.val()),$.trim(r.val()),""==a?(globalError=r.attr("alt")+" should be required",error_display(r)):error_remove(r)}function mobile_valid(r){var a=$.trim(r.val());return""==a?!0:(mobilepattern=/^[0-9]+$/,void(mobilepattern.test(a)&&10==a.length?error_remove(r):(globalError="Invalid "+r.attr("alt"),error_display(r))))}function mobile_value_check(r){$.trim(r.val())}function email_valid(r){var a=$.trim(r.val());if(""==a)return!0;var e=/^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,3}(?:\.[a-z]{2})?)$/i;e.test(a)?error_remove(r):(globalError=" Enter a valid email address",error_display(r))}function door_valid(r){var a=$.trim(r.val());if(""==a)return!0;var e=/^[a-zA-z0-9\-.\\_\/-:;\[\]]+$/;e.test(a)?error_remove(r):(globalError=r.attr("alt")+" should be Valid Door number",error_display(r))}function float_valid(r){var a=$.trim(r.val());if(""==a)return!0;var e=/^(?:[0-9]\d*|1)?(?:\.\d+)?$/;return e.test(a)&&a>0?(error_remove(r),!0):(globalError="Please enter the correct price",error_display(r),!1)}function url_valid(r){var a=$.trim(r.val());if(""==a)return!0;var e=/^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.|http:\/\/|https:\/\/){1}([0-9A-Za-z_?&=-]+\.)/;return e.test(a)?(error_remove(r),!0):(globalError="Please enter valid url",error_display(r),!1)}function numeric_valid(r){var a=$.trim(r.val());if(""==a)return!0;var e=/^[0-9]+$/;return e.test(a)?(error_remove(r),!0):(globalError=r.attr("alt")+" should be in Numeric",error_display(r),!1)}function checkPassStrength(r){var a=0,e=r.val();return e.length<6?($("#password_strength").removeClass(),$("#password_strength").addClass("short"),pass_error_display(r)):(e.length>7&&(a+=1),e.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/)&&(a+=1),e.match(/([a-zA-Z])/)&&e.match(/([0-9])/)&&(a+=1),e.match(/([!,%,&,@,#,$,^,*,?,_,~])/)&&(a+=1),e.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)&&(a+=1),2>a?($("#password_strength").removeClass(),$("#password_strength").addClass("weak"),pass_error_display(r)):2==a?($("#password_strength").removeClass(),$("#password_strength").addClass("good"),!0):($("#password_strength").removeClass(),$("#password_strength").addClass("strong"),!0))}function pincode_valid(r){var a=$.trim(r.val());if(""==a)return!0;var e=/^[0-9]+$/;e.test(a)?a.length<=6?(globalError=r.attr("alt")+"contains 6 digits",error_display(r)):error_remove(r):(globalError=r.attr("alt")+" should be in Numeric and pincode contains 6 digits",error_display(r))}function alpha_valid(r){var a=$.trim(r.val());if(""==a)return!0;var e=/^[A-Za-z]{0,80}$/;e.test(a)?error_remove(r):(globalError=r.attr("alt")+" should be in Alphabetic",error_display(r))}function error_display(r){r.hasClass("invalid")||(r.addClass("invalid"),r.parents("div.form-group").find("p").remove(),r.parents("div.form-group").append('<p class="error">'+globalError+"</p>"),0==r.next("p").length&&r.after(""))}function pass_error_display(r){r.hasClass("invalid")||(r.addClass("invalid"),r.parents("div.form-group").find("p").remove(),r.parents("div.form-group").append('<p class="error">Password should be atleast Good</p>'),0==r.next("p").length&&r.after(""))}function error_remove(r){r.removeClass("invalid"),r.parent("div.form-group").find("p").remove()}var globalError="";
*/
var globalError = '';
function formSubmit(fid)
{
	 
	if($('#shipping_terms').length>0)
	  {  
		  if($('#shipping_terms').is(':checked'))
		 {
			  error_remove($("#shipping_terms"))
		 }else{
			// alert('Accept terms and conditions...');
			globalError ="Accept Terms and Conditons";
			 error_display($("#shipping_terms"));
		 }
	  }
	 
	$('#'+fid+" .required").each(function(){ 
		console.log($(this));
		required_valid($(this));
	});
	
//	$('#'+fid+" .alpha").each(function(){
//		alpha_valid($(this));
//	});
//	
//	$('#'+fid+" .numeric").each(function(){
//		required_valid($(this));
//	});
	
	//password validation
	var pas = '';
	var pasid = '';
	var cpas = '';
	var cpasid = '';
	 
	$('#'+fid+" .pass").each(function(){
		 
			pas = $(this).val(); 
			pasid = $(this); 
		    required_valid($(this));
	});
	
	//pincodelengthvalidation
	$('#'+fid+" .pincode").each(function(){
        pincode_valid($(this));
    });
	 
	$('#'+fid+" .cpass").each(function(){
		
		cpas = $(this).val();
		cpasid = $(this);
		required_valid($(this));
	});
	
	$('#'+fid+" .passwordstrength").each(function(){ 
		 
		checkPassStrength($(this));
	});
	
	 
	if((pas!='' && cpas!='') && pas!=cpas)
	{
		globalError = "Confirm Password is not Matching";
		error_display(cpasid);
	} 
	
	//email validation
	$('#'+fid+" .email").each(function(){
		email_valid($(this));
	});
	
	//mobile validation
	$('#'+fid+" .mobile").each(function(){
		mobile_valid($(this));
	});
	
		//door number validation
	$('#'+fid+" .door").each(function(){
		door_valid($(this));
	});
	
	
	
	//alpha characters validation
	$('#'+fid+" .alpha").each(function(){
		alpha_valid($(this));
	});
	
	//numeric validation
	$('#'+fid+" .numeric").each(function(){
		numeric_valid($(this));
	});
	//Float validation
	$('#'+fid+" .float").each(function(){
		float_valid($(this));
	});
	
	//Url validation
	$('#'+fid+" .url").each(function(){
		globalError = "Enter valid website url";
		url_valid($(this));
	});
	$('#'+fid+" .username").each(function(){
		 
		username_valid($(this));
	});
		$('#'+fid+" .validate_passedout").each(function(){ 
		  validate_passedout($(this));
	});
	if($('#'+fid+" .invalid").length >0) {
		
		
		
		
		/*if($(".tab-content").length > 0)
		{
		  flag = true;
		  i = 0;
		  $(".tab-content .tab-pane").each(function(){
			  if($(this).find(".invalid").length >0 && flag == true)
				  {
				    flag = false;
				    $("#myTab li").removeClass("active")
				    $("#myTab li:eq("+i+")").addClass("active");
				  	$(".tab-content .tab-pane").removeClass("active").removeClass("in");
				    $(this).addClass("active").addClass("in");
				    //err_scroll = $("#"+fid+" .invalid:eq(0)").offset().top;
				    //$('html, body').animate({scrollTop: err_scroll}, "slow");
				  }
			  i++;
		  });
		}*/
		
		//$(window).scrollTop(err_scroll);
		//err_scroll = $("#"+fid+" .invalid:eq(0)").offset().top;
		//$('html, body').animate({scrollTop: err_scroll}, "slow");
		
		return false;
    }
	else{
		
		return true;	
		
	}
		
}

//validating required fields
function required_valid(tval)
{
	 
	var temp = '';
	if($('#message_form').length>0 )
	 {
		 temp =  $.trim(tval.select2('val'));
	 }else
	 {
		  temp =  $.trim(tval.val());
	 }
	 $.trim(tval.val());
	 
 	if(temp == '') {
		globalError = tval.attr("alt")+" is required";
		//globalError = " Required";
		error_display(tval);
	}
	else
		error_remove(tval); 
}



function username_valid(tval)
{
	 
	var username = $.trim(tval.val());
	if(username == '')
		   return true;
	usernamepattern = /^[a-zA-Z0-9]+(\.{1}[a-zA-Z0-9]+)?$/;
	if( username.length<8 )
	{
		globalError = "Username should be contain 8 chars";
   		error_display(tval);
	}else if(!usernamepattern.test(username)) {
		globalError = "Invalid Username";
   		error_display(tval);
	}
   else
      	error_remove(tval);	
}
function validate_passedout(tval)
{
	
	var yr = $.trim(tval.val());
	var d = new Date();
	var n = d.getFullYear();
	if(yr == '')
		   return true;
	  
	if( parseInt(yr) < 1946 ||  parseInt(yr) > parseInt(n) )
	{
		 
		globalError = "Passedout should be in between 1946 and "+n;
   		error_display(tval);
	} 
    else
      	error_remove(tval);	
}

function mobile_valid(tval)
{
	
	var mob_value = $.trim(tval.val());
	if(mob_value == '')
		   return true;
	mobilepattern = /^[0-9]+$/;
	if(!mobilepattern.test(mob_value) || mob_value.length!=10 ) {
		globalError = "Invalid "+tval.attr("alt");
   		error_display(tval);
	}
   else
      	error_remove(tval);	
}


function mobile_value_check(tval)
{
	var mob_value = $.trim(tval.val());
	
}

function email_valid(tval)
{
   var email_value = $.trim(tval.val());
   if(email_value == '')
	   return true;
  var emailPattern = /^([\w-]+(?:\.[\w-]+)*)@((?:[\w-]+\.)*\w[\w-]{0,66})\.([a-z]{2,3}(?:\.[a-z]{2})?)$/i;
    if(!emailPattern.test(email_value)) {
	//globalError = tval.attr("alt")+" Should be Valid Email ID";
    globalError = " Enter a valid email address";
   	error_display(tval);
   }	
   else
      	error_remove(tval);	
}

function door_valid(tval)
{
   var door_value = $.trim(tval.val());
   if(door_value == '')
	   return true;
   var doorPattern =  /^[a-zA-z0-9\-.\\_\/-:;\[\]]+$/;
   if(!doorPattern.test(door_value)) {
	globalError = tval.attr("alt")+" should be Valid Door number";
   	error_display(tval);
   }	
   else
      	error_remove(tval);	
}
function float_valid(tval)
{
   var num_value = $.trim(tval.val());
   if(num_value == '')
	   return true;
   var numPattern = /^(?:[0-9]\d*|1)?(?:\.\d+)?$/;
   if(!numPattern.test(num_value)) {
	globalError = "Please enter the correct price";//tval.attr("alt")+" Should be in Numeric";
   	error_display(tval);
   	return false;
   }
   else {
	   if(num_value > 0)
		   {
      	error_remove(tval);	
		   }
	   else
		   {
		   globalError = "Please enter the correct price";//tval.attr("alt")+" Should be in Numeric";
		   	error_display(tval);
		   	return false;
		   }
   }
   return true;
}

function url_valid(tval)
{
   var num_value = $.trim(tval.val());
   if(num_value == '')
	   return true;
   var numPattern = /^(http:\/\/www.|https:\/\/www.|ftp:\/\/www.|www.|http:\/\/|https:\/\/){1}([0-9A-Za-z_?&=-]+\.)/;
   if(!numPattern.test(num_value)) {
	globalError = "Please enter valid url";
   	error_display(tval);
   	return false;
   }
   else
      	error_remove(tval);	
   return true;
}
  
function numeric_valid(tval)
{
   var num_value = $.trim(tval.val());
   if(num_value == '')
	   return true;
   var numPattern = /^[0-9]+$/;
   if(!numPattern.test(num_value)) {
	globalError = tval.attr("alt")+" should be in Numeric";
   	error_display(tval);
   	return false;
   }
   else
      	error_remove(tval);	
   return true;
}
function checkPassStrength(dis)
{
		//initial strength
		var strength = 0
		var password = dis.val();
		//if the password length is less than 6, return message.
		if (password.length < 6) { 
			$('#password_strength').removeClass();
			$('#password_strength').addClass('short');
			return 	pass_error_display(dis);
		}
		
		//length is ok, lets continue.
		
		//if length is 8 characters or more, increase strength value
		if (password.length > 7) strength += 1
		
		//if password contains both lower and uppercase characters, increase strength value
		if (password.match(/([a-z].*[A-Z])|([A-Z].*[a-z])/))  strength += 1
		
		//if it has numbers and characters, increase strength value
		if (password.match(/([a-zA-Z])/) && password.match(/([0-9])/))  strength += 1 
		
		//if it has one special character, increase strength value
		if (password.match(/([!,%,&,@,#,$,^,*,?,_,~])/))  strength += 1
		
		//if it has two special characters, increase strength value
		if (password.match(/(.*[!,%,&,@,#,$,^,*,?,_,~].*[!,%,&,@,#,$,^,*,?,_,~])/)) strength += 1
		
		//now we have calculated strength value, we can return messages
		
		//if value is less than 2
		if (strength < 2 )
		{
			$('#password_strength').removeClass();
			$('#password_strength').addClass('weak');
			return 	pass_error_display(dis);		
		}
		else if (strength == 2 )
		{
			$('#password_strength').removeClass();
			$('#password_strength').addClass('good');
			return true;	
		}
		else
		{
			$('#password_strength').removeClass();
			$('#password_strength').addClass('strong');
			return true;
		}
}
function pincode_valid(tval)
{   
   var num_value = $.trim(tval.val());
   if(num_value == '')
       return true;
   var numPattern = /^[0-9]+$/;
   if(!numPattern.test(num_value) ) {
    globalError = tval.attr("alt")+" should be in Numeric and pincode contains 6 digits";
       error_display(tval);
   }else if(num_value.length<=6) { //alert('tets');
	   globalError = tval.attr("alt")+"contains 6 digits";
       error_display(tval); 
	   }
   else   { //alert('tetsiii');
          error_remove(tval); 
   }
}

function alpha_valid(tval)
{
   var alpha_value = $.trim(tval.val());
   if(alpha_value == '')
	   return true;
   //var alphaPattern = /^[a-zA-Z. ,-]+$/;
   var alphaPattern = /^[A-Za-z]{0,80}$/;
   if(!alphaPattern.test(alpha_value)) {
		globalError = tval.attr("alt")+" should be in Alphabetic";
   		error_display(tval);
   }
   else
      	error_remove(tval);	
}

//validation 
function error_display(tval)
{
	if(!tval.hasClass('invalid'))
	{
		 tval.addClass('invalid');	
		 tval.parents('div.form-group').find('p').remove();
		 
		tval.parents('div.form-group').append('<p class="error">'+globalError+'</p>');
		//v = tval.attr("alt");
		if(tval.next("p").length == 0)
		   tval.after("");
	}
}
function pass_error_display(tval)
{
	if(!tval.hasClass('invalid'))
	{
		 tval.addClass('invalid');	
		 tval.parents('div.form-group').find('p').remove();
		 
		tval.parents('div.form-group').append('<p class="error">Password should be atleast Good</p>');
		//v = tval.attr("alt");
		if(tval.next("p").length == 0)
		   tval.after("");
	}
}


function error_remove(tval)
{
	 
	  tval.removeClass('invalid');
	  tval.parents('div.form-group').find('p').remove();
}


$(document).ready(function(){
	
	dynamicvalidation();
	//Check to see if the window is top if not then display button
	$(window).scroll(function(){
		if ($(this).scrollTop() > 100) {
			$('.scrollToTop').fadeIn();
		} else {
			$('.scrollToTop').fadeOut();
		}
	});
	
	//Click event to scroll to top
	$('.scrollToTop').click(function(){
		$('html, body').animate({scrollTop : 0},800);
		return false;
	});
	
	 $(document).ready( function() {
                  //enabling stickUp on the '.navbar-wrapper' class
                  //$('.navbar-static-top').stickUp();

     });
var cookieval = getCookie('rightlinkusername');
	console.log(cookieval);
});

function getCookie(cname) {
    var name = cname + "=";
    var ca = document.cookie.split(';');
    for(var i = 0; i < ca.length; i++) {
        var c = ca[i];
        while (c.charAt(0) == ' ') {
            c = c.substring(1);
        }
        if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
        }
    }
    return "";
}
 function dynamicvalidation()
{
	
	 $('form').each(function(){
		//  $("#monthlyincome input[type=text]").each(function() {
		var fname = $(this).attr('id');
		   $('#'+fname+' input[type=text]').each(function(){
			       $( this ).keyup(function() {
                        if($(this).hasClass('required'))
                        {
                          required_valid($(this));   
					    } 
					    
					    if($(this).hasClass('email'))
                        {
                          email_valid($(this));   
					    } 
					     
					});
					 $( this ).change(function() {
                        if($(this).hasClass('hasDatepicker'))
                        {
                          required_valid($(this));   
					    } 
					    
					     
					     
					});
					 
		  });
		  $('#'+fname+' input[type=password]').each(function(){
			         $( this ).keyup(function() {
                        if($(this).hasClass('required'))
                        {
                          required_valid($(this));   
					    }  
					    if($(this).hasClass('cpass'))
                        {
						  
                                var pas=$('.pass').val();
                                var cpas=$('.cpass').val();
                                
								if(pas!=cpas)
								{
									console.log('ff');
									globalError = "Confirm Password is not Matching";
									error_display($(this));
								} 
						  
					    }  
					});
					
		  });
		  $('#'+fname+' select').each(function(){
			       $( this ).change(function() {
                        if($(this).hasClass('required'))
                        {
                          required_valid($(this));   
					    }  
					});
		  });
		 		  
     });
}
function show_site_loader()
{
	$('.site-wait-loader').show();
}
function hide_site_loader()
{
	$('.site-wait-loader').hide();
}
/*
// theme color js
$(document).ready(function($){

$(".custom-show").hide();
 
 $(".custom-close").click(function(){
  $(this).hide();
  $(".custom-show").show();
  $('#switcher').animate({'left': '+=120px'},'medium');
 });
 
 $(".custom-show").click(function(){
  $(this).hide();
  $(".custom-close").show();
  $(this).parent().animate({'left': '-=120px'},'medium');
 });
 

 
         $(".selector").change(function(){
			changeStyles(this.value);
		});
		
		$(".selector > option").each(function() {
			if($.cookie('bodyClassList') != null && $.cookie('bodyClassList').match($(this).val())){
				$(this).attr("selected","selected"); 
			}
		});
		
		$("#reset").click(function(){
			console.log("Here");
			$("body").removeClass();
			$(".selector").each(function(){
				$(this[0]).attr('selected', true);
			})
			$.cookie('bodyClassList');
		});
		
		if(!$.cookie('bodyClassList') != null) { 
			 
			$("body").removeClass();
			$("body").addClass($.cookie('bodyClassList'));
		}

 
 });
 
 function changeStyles(optValue){
			var property = optValue.split("-")[0];
			removeOldClass(property);
			$("body").addClass(optValue);
			$.cookie('bodyClassList', $("body").attr('class') , {  path: '/' });
		}	
		
function removeOldClass(property){
	
	$("#mainBody").removeClass();
	var classList = $("body").attr('class').split(/\s+/);
	$.each(classList, function(index, item){
		if (item.match(property)){
			$("body").removeClass(item);
		}
	});
}

*/

 
// popup for social login       
var newwindow;
var intId;
function loginURL(url){
	var  screenX    = typeof window.screenX != 'undefined' ? window.screenX : window.screenLeft,
		 screenY    = typeof window.screenY != 'undefined' ? window.screenY : window.screenTop,
		 outerWidth = typeof window.outerWidth != 'undefined' ? window.outerWidth : document.body.clientWidth,
		 outerHeight = typeof window.outerHeight != 'undefined' ? window.outerHeight : (document.body.clientHeight - 22),
		 width    = 500,
		 height   = 370,
		 left     = parseInt(screenX + ((outerWidth - width) / 2), 10),
		 top      = parseInt(screenY + ((outerHeight - height) / 2.5), 10),
		 features = (
			'width=' + width +
			',height=' + height +
			',left=' + left +
			',top=' + top
		  );

	newwindow=window.open(url,'Login_by_facebook',features);
$('.load-layout-image').show();
   if (window.focus) {
	   newwindow.focus();
	   //setTimeout(function() {
		  // $('.load-layout-image').hide();
		   //window.location.reload();
		//}, 5000);
	   
	   }
	  
  return false;
}

//admin user default select 
function selectadminuser(id){ 
	window.location.href = base_url+'message/add/'+id;
}
        
        
        
        
 
      
