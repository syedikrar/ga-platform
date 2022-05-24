var NioApp=function(n,d){"use strict";var t=d(window),s=d("body"),a="nio-theme",e="lite-dash";function l(t,a){return Object.keys(a).forEach(function(e){t[e]=a[e]}),t}return d.fn.exists=function(){return 0<this.length},d.fn.csskey=function(e,t){for(var a=t?t+"-":"",o=e?e.split(" "):"",s=0;s<o.length;s++)o[s]=a+o[s];return o.toString().replace(","," ")},n.BS={},n.TGL={},n.Ani={},n.Addons={},n.Slider={},n.Picker={},n.Win={height:t.height(),width:t.outerWidth()},n.Break={mb:420,sm:576,md:768,lg:992,xl:1200,xxl:1540,any:1/0},n.Host={name:window.location.hostname,locat:e.slice(-4)+e.slice(0,4)},n.isDark=!(!s.hasClass("dark-mode")&&"dark"!==s.data("theme")),n.State={isRTL:!(!s.hasClass("has-rtl")&&"rtl"!==s.attr("dir")),isTouch:"ontouchstart"in document.documentElement,isMobile:!!navigator.userAgent.match(/Android|webOS|iPhone|iPad|iPod|BlackBerry|IEMobile|Opera Mini|Windows Phone|/i),asMobile:n.Win.width<n.Break.md,asServe:n.Host.name.split(".").indexOf(n.Host.locat)},n.hexRGB=function(e,t){t=t||1;if(/^#([A-Fa-f0-9]{3}){1,2}$/.test(e))return e=[(e="0x"+(e=3===(e=e.substring(1).split("")).length?[e[0],e[0],e[1],e[1],e[2],e[2]]:e).join(""))>>16&255,e>>8&255,255&e].join(","),1<=t?"rgba("+e+")":"rgba("+e+","+t+")";throw new Error("bad hex")},n.StateUpdate=function(){n.Win={height:t.height(),width:t.outerWidth()},n.State.asMobile=n.Win.width<n.Break.md},n.ClassInit=function(){function e(){!0===n.State.asMobile?s.addClass("as-mobile"):s.removeClass("as-mobile")}!0===n.State.isTouch?s.addClass("has-touch"):s.addClass("no-touch"),e(),!0===n.State.isRTL&&s.addClass("has-rtl"),s.addClass("nk-"+a),t.on("resize",e)},n.ColorBG=function(){function e(e,t){var a=d(e),e=t||"bg",t=a.data(e);""!==t&&("bg-color"===e?a.css("background-color",t):"bg-image"===e?a.css("background-image",'url("'+t+'")'):a.css("background",t))}d("[data-bg]").each(function(){e(this,"bg")}),d("[data-bg-color]").each(function(){e(this,"bg-color")}),d("[data-bg-image]").each(function(){e(this,"bg-image")})},n.ColorTXT=function(){d("[data-color]").each(function(){var e,t;t="color",e=d(e=this),""!==(t=e.data(t||"color"))&&e.css("color",t)})},n.BreakClass=function(e,t,a){var o=e||".header-menu",s=t||n.Break.md,t={timeOut:1e3,classAdd:"mobile-menu"},i=a?l(t,a):t,t=i.ignore||!1;if(t&&d(o).hasClass(t))return!1;n.Win.width<s?setTimeout(function(){n.Win.width<s&&d(o).addClass(i.classAdd)},i.timeOut):d(o).removeClass(i.classAdd)},n.Passcode=function(e,t){var a={showClass:"is-shown",hideClass:"is-hidden"},o=t?l(a,t):a;d(e).exists()&&d(e).on("click",function(e){var t=d(this),a=t.data("target"),a=d("#"+a);e.preventDefault(),a.hasClass(o.showClass)?(t.add(a).addClass(o.hideClass).removeClass(o.showClass),a.attr("type","password")):(t.add(a).addClass(o.showClass).removeClass(o.hideClass),a.attr("type","text"))})},n.LinkOff=function(e){d(e).on("click",function(e){e.preventDefault()})},n.SetHW=function(e,t){t="height"==t||"h"==t?"height":"width",e=e||"[data-"+t+"]";d(e).exists()&&d(e).each(function(){d(this).css(t,d(this).data(t))})},n.AddInBody=function(e,t){var a={prefix:"nk-",class:"",has:"has"},t=t?l(a,t):a,a=e.replace(".","").replace(t.prefix,""),e=a;t.prefix=!1!==t.prefix?t.prefix:"",t.has=""!==t.has?t.has+"-":"",e=""!==t.class?t.class:t.has+e,d("."+t.prefix+a).exists()&&!s.hasClass(e)&&s.addClass(e)},n.Toggle={trigger:function(e,t){var a={self:e,active:"active",content:"expanded",data:"content",olay:"toggle-overlay",speed:400},o=t?l(a,t):a,t=d("[data-target="+e+"]"),a=d("[data-"+o.data+"="+e+"]"),e=a.data("toggle-body");a.data("toggle-overlay")&&(o.overlay=o.olay),e&&(o.body="toggle-shown"),a.hasClass(o.content)?(t.removeClass(o.active),(1==o.toggle?a.slideUp(o.speed):a).removeClass(o.content)):(t.addClass(o.active),(1==o.toggle?a.slideDown(o.speed):a).addClass(o.content)),o.body&&s.toggleClass(o.body),o.overlay&&this.overlay(a,o.overlay,o)},removed:function(e,t){var a={self:e,active:"active",content:"expanded",body:"",data:"content",olay:"toggle-overlay"},o=t?l(a,t):a,t=d("[data-target="+e+"]"),a=d("[data-"+o.data+"="+e+"]"),e=a.data("toggle-body");a.data("toggle-overlay")&&(o.overlay=o.olay),e&&(o.body="toggle-shown"),(t.hasClass(o.active)||a.hasClass(o.content))&&(t.removeClass(o.active),a.removeClass(o.content),!0===o.toggle&&a.slideUp(o.speed)),o.body&&s.hasClass(o.body)&&s.removeClass(o.body),o.close&&(!0===o.close.profile&&this.closeProfile(a),!0===o.close.menu&&this.closeMenu(a)),o.overlay&&this.overlayRemove(o.overlay)},overlay:function(e,t,a){var o;!0===a.break&&(o=d(e).data("toggle-screen"),a.break=n.Break[o]),d(e).hasClass(a.content)&&n.Win.width<a.break?d(e).after('<div class="'+t+'" data-target="'+a.self+'"></div>'):this.overlayRemove(t)},overlayRemove:function(e){d("."+e).fadeOut(300).remove()},dropMenu:function(e,t){var a={active:"active",self:"link-toggle",child:"menu-sub",speed:400},t=t?l(a,t):a,a=d(e).parent(),e=a.children("."+t.child);t.speed=5<e.children().length?t.speed+20*e.children().length:t.speed,e.slideToggle(t.speed).find("."+t.child).slideUp(t.speed),a.toggleClass(t.active).siblings().removeClass(t.active).find("."+t.child).slideUp(t.speed)},closeProfile:function(e){var t=d(e).find(".nk-profile-toggle.active"),e=d(e).find(".nk-profile-content.expanded");t.exists()&&(t.removeClass("active"),e.slideUp().removeClass("expanded"))},closeMenu:function(e){e=d(e).find(".nk-menu-item.active");e.exists()&&e.removeClass("active").find(".nk-menu-sub").slideUp()}},n.BS.tooltip=function(e,t){var a={boundary:"window",trigger:"hover"},a=t?l(a,t):a;d(e).exists()&&"function"==typeof d.fn.tooltip&&d(e).tooltip(a)},n.BS.menutip=function(e){n.BS.tooltip(e,{boundary:"window",placement:"right"})},n.BS.popover=function(e){d(e).exists()&&"function"==typeof d.fn.popover&&d(e).popover()},n.BS.progress=function(e){d(e).exists()&&d(e).each(function(){d(this).css("width",d(this).data("progress")+"%")})},n.BS.modalfix=function(e){e=e||".modal";d(e).exists()&&"function"==typeof d.fn.modal&&d(e).on("shown.bs.modal",function(){s.hasClass("modal-open")||s.addClass("modal-open")})},n.BS.fileinput=function(e){d(e).exists()&&d(e).each(function(){var t=d(this).next().text(),a=[];d(this).on("change",function(){for(var e=0;e<this.files.length;e++)a[e]=this.files[e].name;t=a?a.join(", "):t,d(this).next().html(t)})})},n.Picker.date=function(e,t){d(e).exists()&&"function"==typeof d.fn.datepicker&&d(e).each(function(){var e=d(this).data("date-format"),e={format:""!==e?e:"mm/dd/yyyy",maxViewMode:2,clearBtn:!0,autoclose:!0,todayHighlight:!0,rtl:n.State.isRTL},e=t?l(e,t):e;d(this).datepicker(e).on("changeDate",function(e){0!==e.dates.length?d(this).parent().addClass("focused"):d(this).parent().removeClass("focused")})})},n.Picker.dob=function(e,t){var a={startView:2,todayHighlight:!1},a=t?l(a,t):a;n.Picker.date(e,a)},n.Picker.time=function(e,a){d(e).exists()&&"function"==typeof d.fn.timepicker&&d(e).each(function(){d(this).parent().addClass("has-timepicker");var e=d(this).data("time-format"),t=d(this).data("time-interval"),t={timeFormat:""!==e?e:"HH:mm",interval:""!==t?t:15,change:function(e){!1!==e?d(this).parent().addClass("focused"):d(this).parent().removeClass("focused")}},t=a?l(t,a):t;d(this).timepicker(t)})},n.Select2=function(e,a){d(e).exists()&&"function"==typeof d.fn.select2&&d(e).each(function(){var e=d(this),t={placeholder:e.data("placeholder"),clear:e.data("clear"),search:e.data("search"),width:e.data("width"),theme:e.data("theme"),ui:e.data("ui")};t.ui=t.ui?" "+e.csskey(t.ui,"select2"):"";t={theme:t.theme?t.theme+" "+t.ui:"default"+t.ui,allowClear:t.clear||!1,placeholder:t.placeholder||"",dropdownAutoWidth:!(!t.width||"auto"!==t.width),minimumResultsForSearch:t.search&&"on"===t.search?1:-1,dir:n.State.isRTL?"rtl":"ltr"},t=a?l(t,a):t;d(this).select2(t)})},n.coreInit=function(){n.coms.onResize.push(n.StateUpdate),n.coms.docReady.push(n.ClassInit)},n.coreInit(),n}(NioApp=function(e,t,a){"use strict";var o={AppInfo:{name:"NioApp",version:"1.0.8",author:"Softnio"},Package:{name:"DashLite",version:"2.3"}},s={docReady:[],docReadyDefer:[],winLoad:[],winLoadDefer:[],onResize:[],onResizeDefer:[]};function i(t){t=void 0===t?e:t,s.docReady.concat(s.docReadyDefer).forEach(function(e){null!=e&&e(t)})}function n(t){t="object"==typeof t?e:t,s.winLoad.concat(s.winLoadDefer).forEach(function(e){null!=e&&e(t)})}function d(t){t="object"==typeof t?e:t,s.onResize.concat(s.onResizeDefer).forEach(function(e){null!=e&&e(t)})}return e(a).ready(i),e(t).on("load",n),e(t).on("resize",d),o.coms=s,o.docReady=i,o.winLoad=n,o.onResize=d,o}(jQuery,window,document),jQuery);
!(function (NioApp, $) {
    "use strict";
    NioApp.Package.name = "DashLite";
    NioApp.Package.version = "2.3";

    var $win = $(window), $body = $('body'), $doc = $(document), 

    //class names
    _body_theme  = 'nio-theme',
    _menu        = 'nk-menu',
    _mobile_nav  = 'mobile-menu',
    _header      = 'nk-header', 
    _header_menu = 'nk-header-menu', 
    _sidebar     = 'nk-sidebar', 
    _sidebar_mob = 'nk-sidebar-mobile', 
    //breakpoints
    _break       = NioApp.Break;
    
    function extend(obj, ext) {
        Object.keys(ext).forEach(function(key) { obj[key] = ext[key]; });
        return obj;
    }
    // ClassInit @v1.0
    NioApp.ClassBody = function() {
        NioApp.AddInBody(_sidebar);
    };

    // ClassInit @v1.0
    NioApp.ClassNavMenu = function() {
        NioApp.BreakClass('.'+_header_menu, _break.lg, { timeOut: 0 } );
        NioApp.BreakClass('.'+_sidebar, _break.lg, {timeOut: 0, classAdd: _sidebar_mob} );
        $win.on('resize', function() {
            NioApp.BreakClass('.'+_header_menu, _break.lg);
            NioApp.BreakClass('.'+_sidebar, _break.lg, {classAdd: _sidebar_mob} );
        });
    };

    // Code Prettify @v1.0
    NioApp.Prettify = function(){
        window.prettyPrint && prettyPrint();
    };

    // Copied @v1.0
    NioApp.Copied = function() {
        var clip   = '.clipboard-init', target = '.clipboard-text', 
            sclass = 'clipboard-success', eclass = 'clipboard-error';

        // Feedback
        function feedback (el, state) {
            var $elm = $(el), $elp = $elm.parent(), copy = {text: 'Copy', done: 'Copied', fail: 'Failed'},
                data = {text: $elm.data('clip-text'), done: $elm.data('clip-success'), fail: $elm.data('clip-error')};

                copy.text = (data.text) ? data.text : copy.text;
                copy.done = (data.done) ? data.done : copy.done;
                copy.fail = (data.fail) ? data.fail : copy.fail;

            var copytext = (state==='success') ? copy.done : copy.fail, 
                addclass = (state==='success') ? sclass : eclass;
            
            $elp.addClass(addclass).find(target).html(copytext);

            setTimeout(function(){
                $elp.removeClass(sclass + ' ' + eclass).find(target).html(copy.text).blur();
                $elp.find('input').blur();
            }, 2000);
        }

        // Init ClipboardJS
        // if(ClipboardJS.isSupported()){
        //     var clipboard = new ClipboardJS(clip);
        //     clipboard.on('success', function(e) {
        //         feedback(e.trigger, 'success'); 
        //         e.clearSelection();
        //     }).on('error', function(e) {
        //         feedback(e.trigger, 'error');
        //     });
        // } else {
        //     $(clip).css('display','none');
        // };
    };

    // CurrentLink Detect @v1.0
    NioApp.CurrentLink = function(){
        var _link = '.nk-menu-link, .menu-link, .nav-link',
            _currentURL = window.location.href,
            fileName = _currentURL.substring(0, (_currentURL.indexOf("#") == -1) ? _currentURL.length : _currentURL.indexOf("#")), 
            fileName = fileName.substring(0, (fileName.indexOf("?") == -1) ? fileName.length : fileName.indexOf("?"));

        $(_link).each(function() {
            var self = $(this), _self_link = self.attr('href');
            if (fileName.match(_self_link)) {
                self.closest("li").addClass('active current-page').parents().closest("li").addClass("active current-page");
                self.closest("li").children('.nk-menu-sub').css('display','block');
                self.parents().closest("li").children('.nk-menu-sub').css('display','block');
            } else {
                self.closest("li").removeClass('active current-page').parents().closest("li:not(.current-page)").removeClass("active");
            }
        });
    };

    // PasswordSwitch @v1.0
    NioApp.PassSwitch = function(){
        NioApp.Passcode('.passcode-switch');
    };

    // Toastr Message @v1.0 
    NioApp.Toast = function (msg, ttype, opt) {
        var ttype   = (ttype) ? ttype : 'info', msi = '',
            ticon   = (ttype==='info') ? 'ni ni-info-fill' : ((ttype==='success') ? 'ni ni-check-circle-fill' : ((ttype==='error') ? 'ni ni-cross-circle-fill' : ((ttype==='warning') ? 'ni ni-alert-fill' : '') ) ), 
            def     = {position:'bottom-right', ui: '', icon: 'auto', clear: false}, attr = (opt) ? extend(def, opt) : def;

            attr.position = (attr.position) ? 'toast-'+attr.position : 'toast-bottom-right';
            attr.icon = (attr.icon==='auto') ? ticon : ((attr.icon) ? attr.icon : '' ); 
            attr.ui = (attr.ui) ? ' '+ attr.ui : '';

            msi  = (attr.icon!=='') ? '<span class="toastr-icon"><em class="icon '+ attr.icon +'"></em></span>' : '',
            msg = (msg!=='') ? msi + '<div class="toastr-text">'+ msg + '</div>' : '';

        if(msg!=="") {
            if(attr.clear===true) { toastr.clear(); }
            var option = {
                    "closeButton": true,
                    "debug": false,
                    "newestOnTop": false,
                    "progressBar": false,
                    "positionClass": attr.position + attr.ui,
                    "closeHtml": '<span class="btn-trigger">Close</span>',
                    "preventDuplicates": true,
                    "showDuration": "1500",
                    "hideDuration": "1500",
                    "timeOut": "2000",
                    "toastClass": "toastr",
                    "extendedTimeOut": "3000"
                };
            toastr.options = extend(option, attr);
            toastr[ttype](msg);
        }
    };

    // Toggle Screen @v1.0
    NioApp.TGL.screen = function (elm){
        if($(elm).exists()) {        
            $(elm).each(function(){
                var ssize = $(this).data('toggle-screen');
                if(ssize){ $(this).addClass('toggle-screen-' + ssize ); }
            });
        }
    };

    // Toggle Content @v1.0
    NioApp.TGL.content = function (elm, opt){
        var toggle = (elm) ? elm : '.toggle', $toggle = $(toggle), $contentD = $('[data-content]'), 
            toggleBreak = true, toggleCurrent = false, def = { active: 'active', content: 'content-active', break: toggleBreak}, attr = (opt) ? extend(def, opt) : def;

        NioApp.TGL.screen($contentD);

        $toggle.on('click', function(e){
            toggleCurrent = this;
            NioApp.Toggle.trigger($(this).data('target'), attr);
            e.preventDefault();
        });

        $doc.on('mouseup', function(e){
            if (toggleCurrent) {
                var $toggleCurrent = $(toggleCurrent), $s2c = $('.select2-container'), $dpd = $('.datepicker-dropdown'), $tpc = $('.ui-timepicker-container');
                if (!$toggleCurrent.is(e.target) && $toggleCurrent.has(e.target).length===0 && !$contentD.is(e.target) && $contentD.has(e.target).length===0
                    && !$s2c.is(e.target) && $s2c.has(e.target).length===0 && !$dpd.is(e.target) && $dpd.has(e.target).length===0
                    && !$tpc.is(e.target) && $tpc.has(e.target).length===0) {
                    NioApp.Toggle.removed($toggleCurrent.data('target'), attr);
                    toggleCurrent = false;
                }
            }
        });

        $win.on('resize', function(){
            $contentD.each(function(){
                var content = $(this).data('content'), ssize = $(this).data('toggle-screen'), toggleBreak = _break[ssize];
                if(NioApp.Win.width > toggleBreak){ 
                    NioApp.Toggle.removed(content, attr);
                } 
            });
        });
    };

    // ToggleExpand @v1.0
    NioApp.TGL.expand = function(elm, opt){
        var toggle = (elm) ? elm : '.expand', def = {toggle: true}, attr = (opt) ? extend(def, opt) : def;

        $(toggle).on('click', function(e){
            NioApp.Toggle.trigger($(this).data('target'), attr);
            e.preventDefault();
        });
    };

    // Dropdown Menu @v1.0
    NioApp.TGL.ddmenu = function(elm, opt){
        var imenu = (elm) ? elm : '.nk-menu-toggle',
            def = { active: 'active', self: 'nk-menu-toggle', child: 'nk-menu-sub'},
            attr = (opt) ? extend(def, opt) : def;

        $(imenu).on('click', function(e){
            if ((NioApp.Win.width < _break.lg) || ($(this).parents().hasClass(_sidebar))) {
                NioApp.Toggle.dropMenu($(this), attr);
            }
            e.preventDefault();
        });
    };

    // Show Menu @v1.0
    NioApp.TGL.showmenu = function(elm, opt){
        var toggle = (elm) ? elm : '.nk-nav-toggle', $toggle = $(toggle), $contentD = $('[data-content]'),
            toggleBreak = $contentD.hasClass(_header_menu) ? _break.lg : _break.xl,
            toggleOlay = _sidebar + '-overlay', toggleClose = {profile: true, menu: false}, 
            def = { active: 'toggle-active', content: _sidebar + '-active', body: 'nav-shown', overlay: toggleOlay, break: toggleBreak, close: toggleClose }, 
            attr = (opt) ? extend(def, opt) : def;

        $toggle.on('click', function(e){
            NioApp.Toggle.trigger($(this).data('target'), attr);
            e.preventDefault();
        });

        $doc.on('mouseup', function(e){
            if (!$toggle.is(e.target) && $toggle.has(e.target).length===0 && !$contentD.is(e.target) && $contentD.has(e.target).length===0 && NioApp.Win.width < toggleBreak) {
                NioApp.Toggle.removed($toggle.data('target'), attr);
            }
        });

        $win.on('resize', function(){
            if(NioApp.Win.width < _break.xl || NioApp.Win.width < toggleBreak ){ 
                NioApp.Toggle.removed($toggle.data('target'), attr);
            } 
        });
    };

    // Compact Sidebar @v1.0
    NioApp.sbCompact = function(){
        var toggle = '.nk-nav-compact', $toggle = $(toggle), $content = $('[data-content]'), $sidebar = $('.' + _sidebar ), $sidebar_body = $('.' + _sidebar + '-body');

        $toggle.on('click', function(e){
            e.preventDefault();
            var $self = $(this), get_target = $self.data('target'), 
                $self_content = $('[data-content=' + get_target + ']');

                $self.toggleClass('compact-active');
                $self_content.toggleClass('is-compact');
                if(!$self_content.hasClass('is-compact')){
                    $self_content.removeClass('has-hover');
                }
        });
        $sidebar_body.on('mouseenter', function(e){
            if($sidebar.hasClass('is-compact')){
                $sidebar.addClass('has-hover');
            }
        });
        $sidebar_body.on('mouseleave', function(e){
            if($sidebar.hasClass('is-compact')){
                $sidebar.removeClass('has-hover');
            }
        });
    };

    // Animate FormSearch @v1.0
    NioApp.Ani.formSearch= function(elm, opt){
        var def = {active: 'active', timeout: 400, target: '[data-search]'}, attr = (opt) ? extend(def, opt) : def;
        var $elem = $(elm), $target = $(attr.target);

        if($elem.exists()) {
            $elem.on('click', function(e){
                e.preventDefault();
                var $self = $(this), the_target = $self.data('target'),
                    $self_st = $('[data-search=' + the_target + ']'),
                    $self_tg = $('[data-target=' + the_target + ']');

                if(!$self_st.hasClass(attr.active)){
                    $self_tg.add($self_st).addClass(attr.active);
                    $self_st.find('input').focus();
                } else{
                    $self_tg.add($self_st).removeClass(attr.active);
                    setTimeout(function(){
                        $self_st.find('input').val('');
                    }, attr.timeout);
                }
            });

            $doc.on({
                keyup: function(e) {
                    if (e.key === "Escape") {
                        $elem.add($target).removeClass(attr.active);
                    }
                },
                mouseup: function(e){
                    if (!$target.find('input').val() && !$target.is(e.target) && $target.has(e.target).length===0 && !$elem.is(e.target) && $elem.has(e.target).length===0) {
                        $elem.add($target).removeClass(attr.active);
                    }
                }
            });
        }
    };

    // Animate FormElement @v1.0
    NioApp.Ani.formElm = function(elm, opt){
        var def = {focus: 'focused'}, attr = (opt) ? extend(def, opt) : def;

        if($(elm).exists()) {
            $(elm).each(function(){
                var $self = $(this);

                if($self.val()){ 
                    $self.parent().addClass(attr.focus); 
                }
                $self.on({
                    focus: function(){
                        $self.parent().addClass(attr.focus);
                    },
                    blur: function(){
                        if(!$self.val()){ $self.parent().removeClass(attr.focus); }
                    }
                });
            });
        }
    };

    // Form Validate @v1.0
    NioApp.Validate = function(elm, opt) {
        if ($(elm).exists()) {
            $(elm).each(function(){
                var def = {errorElement: "span"}, attr = (opt) ? extend(def, opt) : def;
                $(this).validate(attr);
            });
        }
    };

    NioApp.Validate.init = function() {
        NioApp.Validate('.form-validate', 
        {
            errorElement: "span",
            errorClass: "invalid",
            errorPlacement: function errorPlacement(error, element) {
                if (element.parents().hasClass('input-group')) {
                    error.appendTo(element.parent().parent());
                } else {
                    error.appendTo(element.parent());
                }
            }
        });
    }

    // Dropzone @v1.1
    NioApp.Dropzone = function(elm, opt) {
        if ($(elm).exists()) {
            $(elm).each(function(){
                var maxFiles = $(elm).data('max-files'), maxFiles = maxFiles ? maxFiles : null;
                var maxFileSize = $(elm).data('max-file-size'), maxFileSize = maxFileSize ? maxFileSize : 256;
                var acceptedFiles = $(elm).data('accepted-files'), acceptedFiles = acceptedFiles ? acceptedFiles : null;
                var def = {
                        autoDiscover: false,
                        maxFiles:maxFiles,
                        maxFilesize: maxFileSize,
                        acceptedFiles: acceptedFiles
                    }, 
                    attr = (opt) ? extend(def, opt) : def;
                $(this).addClass('dropzone').dropzone(attr);
            });
        }
    };

    // Dropzone Init @v1.0
    NioApp.Dropzone.init = function() {
        NioApp.Dropzone('.upload-zone', {url: "/images"} );
    };

    // Wizard @v1.0
    NioApp.Wizard = function(){
        var $wizard = $(".nk-wizard");
        if ($wizard.exists()) {
            $wizard.each(function(){
                var $self = $(this), _self_id = $self.attr('id'),$self_id = $('#'+_self_id).show();
                $self_id.steps({
                    headerTag: ".nk-wizard-head",
                    bodyTag: ".nk-wizard-content",
                    labels: {
                        finish: "Submit",
                        next: "Next",
                        previous: "Prev",
                        loading: "Loading ..."
                    },
                    titleTemplate: '<span class="number">0#index#</span> #title#',
                    onStepChanging: function (event, currentIndex, newIndex)
                    {
                        // Allways allow previous action even if the current form is not valid!
                        if (currentIndex > newIndex)
                        {
                            return true;
                        }
                        // Needed in some cases if the user went back (clean up)
                        if (currentIndex < newIndex)
                        {
                            // To remove error styles
                            $self_id.find(".body:eq(" + newIndex + ") label.error").remove();
                            $self_id.find(".body:eq(" + newIndex + ") .error").removeClass("error");
                        }
                        $self_id.validate().settings.ignore = ":disabled,:hidden";
                        return $self_id.valid();
                    },
                    onFinishing: function (event, currentIndex)
                    {
                        $self_id.validate().settings.ignore = ":disabled";
                        return $self_id.valid();
                    },
                    onFinished: function (event, currentIndex){window.location.href = "#";}
                    
                }).validate({
                    errorElement: "span",
                    errorClass: "invalid",
                    errorPlacement: function(error, element) {
                        error.appendTo( element.parent() );
                    }
                });
            });
        }
    }

    // DataTable @1.1
    NioApp.DataTable = function(elm, opt) {
        if ($(elm).exists()) {
            $(elm).each(function(){
                var auto_responsive = $(this).data('auto-responsive'), has_export = (typeof(opt.buttons) !== 'undefined' && opt.buttons) ? true : false;
                var export_title = $(this).data('export-title') ? $(this).data('export-title') : 'Export';
                var btn = (has_export) ? '<"dt-export-buttons d-flex align-center"<"dt-export-title d-none d-md-inline-block">B>' : '', btn_cls = (has_export) ? ' with-export' : '';
                var dom_normal = '<"row justify-between g-2'+btn_cls+'"<"col-7 col-sm-4 text-left"f><"col-5 col-sm-8 text-right"<"datatable-filter"<"d-flex justify-content-end g-2"'+btn+'l>>>><"datatable-wrap my-3"t><"row align-items-center"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-left text-md-right"i>>'; 
                var dom_separate = '<"row justify-between g-2'+btn_cls+'"<"col-7 col-sm-4 text-left"f><"col-5 col-sm-8 text-right"<"datatable-filter"<"d-flex justify-content-end g-2"'+btn+'l>>>><"my-3"t><"row align-items-center"<"col-7 col-sm-12 col-md-9"p><"col-5 col-sm-12 col-md-3 text-left text-md-right"i>>'; 
                var dom = $(this).hasClass('is-separate') ? dom_separate : dom_normal;
                var def = {
                        responsive: true,
                        autoWidth: false,
                        dom: dom,
                        language: {
                            search : "",
                            searchPlaceholder: "Type in to Search",
                            lengthMenu: "<span class='d-none d-sm-inline-block'>Show</span><div class='form-control-select'> _MENU_ </div>",
                            info: "_START_ -_END_ of _TOTAL_",
                            infoEmpty: "No records found",
                            infoFiltered: "( Total _MAX_  )",
                            paginate: {
                                "first":      "First",
                                "last":       "Last",
                                "next":       "Next",
                                "previous":   "Prev"
                            },
                        }
                    }, 
                    attr = (opt) ? extend(def, opt) : def;
                    attr =(auto_responsive === false) ?  extend(attr, {responsive: false}) : attr;

                $(this).DataTable(attr);
                $('.dt-export-title').text(export_title);
            });
        }
    };

    // DataTable Init @v1.0
    NioApp.DataTable.init = function () {
        NioApp.DataTable('.datatable-init', {
            responsive: {
                details: true
            }
        });

        NioApp.DataTable('.datatable-init-export', {
            responsive: {
                details: true
            },
            buttons: [ 'copy', 'excel', 'csv', 'pdf', 'colvis' ]
        });
        $.fn.DataTable.ext.pager.numbers_length = 7;
    }


    // BootStrap Extended
    NioApp.BS.ddfix = function(elm, exc) {
        var dd = (elm) ? elm : '.dropdown-menu',
            ex = (exc) ? exc : 'a:not(.clickable), button:not(.clickable), a:not(.clickable) *, button:not(.clickable) *';

        $(dd).on('click', function (e) {
            if(!$(e.target).is(ex)){ 
                e.stopPropagation();
                return;
            }
        });
        if(NioApp.State.isRTL){
            var $dMenu = $('.dropdown-menu');
            $dMenu.each(function(){
                var $self = $(this);
                if($self.hasClass('dropdown-menu-right') && !$self.hasClass('dropdown-menu-center')){
                    $self.prev('[data-toggle="dropdown"]').dropdown({
                        popperConfig: {
                            placement: 'bottom-start'
                        }
                    });
                }else if(!$self.hasClass('dropdown-menu-right') && !$self.hasClass('dropdown-menu-center')){
                    $self.prev('[data-toggle="dropdown"]').dropdown({
                        popperConfig: {
                            placement: 'bottom-end'
                        }
                    });
                }
            });
        }
    }

    // BootStrap Specific Tab Open
    NioApp.BS.tabfix = function(elm) {
        var tab = (elm) ? elm : '[data-toggle="modal"]';
        $(tab).on('click', function(){
            var _this = $(this), target = _this.data('target'), target_href = _this.attr('href'),
                tg_tab = _this.data('tab-target');

            var modal = (target) ? $body.find(target) : $body.find(target_href);
            if (tg_tab && tg_tab !=='#' && modal) {
                modal.find('[href="'+tg_tab+'"]').tab('show');
            } else if(modal) {
                var tabdef = modal.find('.nk-nav.nav-tabs');
                var link = $(tabdef[0]).find('[data-toggle="tab"]');
                $(link[0]).tab('show');
            }
        });
    }

    // Dark Mode Switch @since v2.0
    NioApp.ModeSwitch = function() {
        var toggle = $('.dark-switch');
        if($body.hasClass('dark-mode')){
            toggle.addClass('active');
        }else {
            toggle.removeClass('active');
        }
        toggle.on('click', function(e){
            e.preventDefault();
            $(this).toggleClass('active');
            $body.toggleClass('dark-mode');
        })
    }

    // Knob @v1.0
    NioApp.Knob = function(elm, opt) {
        if($(elm).exists() && typeof($.fn.knob) === 'function') {
            var def = {min: 0}, attr = (opt) ? extend(def, opt) : def;
            $(elm).each(function(){ $(this).knob(attr); });
        }
    };
    // Knob Init @v1.0
    NioApp.Knob.init = function() {
        var knob = {
                default: {readOnly: true, lineCap: "round"}, 
                half: { angleOffset: -90, angleArc: 180, readOnly: true, lineCap: "round"} 
            };
        
        NioApp.Knob('.knob', knob.default);
        NioApp.Knob('.knob-half', knob.half);
    };

    // Range @v1.0.1
    NioApp.Range = function(elm, opt) {
        if($(elm).exists() && typeof(noUiSlider) !== 'undefined') {
            $(elm).each(function(){
                var $self = $(this), self_id = $self.attr('id');
                var _start = $self.data('start'), _start = /\s/g.test(_start) ? _start.split(' ') : _start, _start = _start ? _start : 0,
                    _connect = $self.data('connect'), _connect = /\s/g.test(_connect) ? _connect.split(' ') : _connect, _connect = typeof _connect == 'undefined' ? 'lower' : _connect,
                    _min = $self.data('min') , _min = _min ? _min : 0, 
                    _max = $self.data('max'), _max = _max ? _max : 100,
                    _min_distance = $self.data('min-distance'), _min_distance = _min_distance ? _min_distance : null,
                    _max_distance = $self.data('max-distance'), _max_distance = _max_distance ? _max_distance : null,
                    _step = $self.data('step'), _step = _step ? _step : 1,
                    _orientation = $self.data('orientation'), _orientation = _orientation ? _orientation : 'horizontal',
                    _tooltip = $self.data('tooltip'), _tooltip = _tooltip ? _tooltip : false;
                    console.log(_tooltip);
                var target = document.getElementById(self_id);
                var def = {
                        start: _start,
                        connect: _connect,
                        direction: NioApp.State.isRTL ? "rtl" : "ltr",
                        range: {
                            'min': _min,
                            'max': _max
                        },
                        margin: _min_distance,
                        limit: _max_distance,
                        step: _step,
                        orientation: _orientation,
                        tooltips: _tooltip
                    }, 
                    attr = (opt) ? extend(def, opt) : def;

                noUiSlider.create(target, attr);
            });
        }
    };

    // Range Init @v1.0
    NioApp.Range.init = function() {
        NioApp.Range('.form-control-slider');
        NioApp.Range('.form-range-slider');
    };

    NioApp.Select2.init = function() {
        // NioApp.Select2('.select');
        NioApp.Select2('.form-select');
    };

    // Slick Slider @v1.0.1
    NioApp.Slick = function(elm, opt) {
        if($(elm).exists() && typeof($.fn.slick) === 'function') {
            $(elm).each(function(){
                var def = {
                        'prevArrow':'<div class="slick-arrow-prev"><a href="javascript:void(0);" class="slick-prev"><em class="icon ni ni-chevron-left"></em></a></div>',
                        'nextArrow':'<div class="slick-arrow-next"><a href="javascript:void(0);" class="slick-next"><em class="icon ni ni-chevron-right"></em></a></div>',
                        rtl: NioApp.State.isRTL
                    }, 
                    attr = (opt) ? extend(def, opt) : def;
                $(this).slick(attr);
            });
        }
    };

    // Slick Init @v1.0
    NioApp.Slider.init = function() {
        NioApp.Slick('.slider-init');
    };

    // Magnific Popup @v1.0.0
    NioApp.Lightbox = function(elm, type, opt) {
        if($(elm).exists()) {
            $(elm).each(function(){
                var def = {};
                if (type=='video' || type=='iframe') {
                    def = { type: 'iframe',
                            removalDelay: 160,
                            preloader: true,
                            fixedContentPos: false,
                            callbacks: {
                                beforeOpen: function() {
                                    this.st.image.markup = this.st.image.markup.replace('mfp-figure', 'mfp-figure mfp-with-anim');
                                    this.st.mainClass = this.st.el.attr('data-effect');
                                }
                            },
                        };

                } else if (type=='content') {
                    def = {
                        type: 'inline',
                        preloader: true,
                        removalDelay: 400,
                        mainClass: 'mfp-fade content-popup'
                    };
                } else {
                    def = {
                        type: 'image',
                        mainClass: 'mfp-fade image-popup'
                    };
                }
                var attr = (opt) ? extend(def, opt) : def;

                $(this).magnificPopup(attr);
            });
        }
    };

    // Controls @v1.0.0
    NioApp.Control = function(elm) {
        var control = document.querySelectorAll(elm);
        control.forEach(function(item, index, arr){
            item.checked ? item.parentNode.classList.add('checked') : null;
            item.addEventListener("change", function(){
                if(item.type == "checkbox"){
                    item.checked ? item.parentNode.classList.add('checked') : item.parentNode.classList.remove('checked');
                }
                if(item.type == "radio"){
                    document.querySelectorAll('input[name="'+ item.name +'"]').forEach(function(item,index,arr){
                        item.parentNode.classList.remove('checked');
                    })
                    item.checked ? item.parentNode.classList.add('checked') : null;
                }
            });
        });
    };

    // Number Spinner @v1.0
    NioApp.NumberSpinner = function(elm, opt) {
        var plus = document.querySelectorAll("[data-number='plus']");
        var minus = document.querySelectorAll("[data-number='minus']");

        plus.forEach(function(item,index,arr){
            var parent = plus[index].parentNode;
            plus[index].addEventListener("click", function() {
                var child = plus[index].parentNode.children;
                child.forEach(function(item,index,arr){
                    if(child[index].classList.contains("number-spinner")){
                        var value = (!child[index].value == "") ? parseInt(child[index].value) : 0;
                        var step = (!child[index].step == "") ? parseInt(child[index].step) : 1;
                        var max = (!child[index].max == "") ? parseInt(child[index].max) : Infinity;
                        if(max + 1 > (value + step)){
                            child[index].value = value + step;
                        }else{
                            child[index].value = value;
                        }
                    }
                });
            })
        });

        minus.forEach(function(item,index,arr){
            var parent = minus[index].parentNode;
            minus[index].addEventListener("click", function() {
                var child = minus[index].parentNode.children;
                child.forEach(function(item,index,arr){
                    if(child[index].classList.contains("number-spinner")){
                        var value = (!child[index].value == "") ? parseInt(child[index].value) : 0;
                        var step = (!child[index].step == "") ? parseInt(child[index].step) : 1;
                        var min = (!child[index].min == "") ? parseInt(child[index].min) : 0;
                        if(min - 1 < (value - step)){
                            child[index].value = value - step;
                        }else{
                            child[index].value = value;
                        }
                    }
                });
            })
        });

    };

    // Extra @v1.1
    NioApp.OtherInit = function() {
        NioApp.ClassBody();
        NioApp.PassSwitch();
        NioApp.CurrentLink();
        NioApp.LinkOff('.is-disable');
        NioApp.ClassNavMenu();
        NioApp.SetHW('[data-height]', 'height');
        NioApp.SetHW('[data-width]', 'width');
        NioApp.NumberSpinner();
        NioApp.Lightbox('.popup-video', 'video');
        NioApp.Lightbox('.popup-iframe', 'iframe');
        NioApp.Lightbox('.popup-image', 'image');
        NioApp.Lightbox('.popup-content', 'content');
        NioApp.Control('.custom-control-input');
    };
    
    // Animate Init @v1.0
    NioApp.Ani.init = function() {
        NioApp.Ani.formElm('.form-control-outlined');
        NioApp.Ani.formSearch('.toggle-search');
    };

    // BootstrapExtend Init @v1.0
    NioApp.BS.init = function() {
        NioApp.BS.menutip('a.nk-menu-link');
        NioApp.BS.tooltip('.nk-tooltip');
        NioApp.BS.tooltip('.btn-tooltip', {placement: 'top'});
        NioApp.BS.tooltip('[data-toggle="tooltip"]');
        NioApp.BS.tooltip('.tipinfo,.nk-menu-tooltip', {placement: 'right'});
        NioApp.BS.popover('[data-toggle="popover"]');
        NioApp.BS.progress('[data-progress]');
        NioApp.BS.fileinput('.custom-file-input');
        NioApp.BS.modalfix();
        NioApp.BS.ddfix();
        NioApp.BS.tabfix();
    }

    // Picker Init @v1.0
    NioApp.Picker.init = function() {
        NioApp.Picker.date('.date-picker');
        NioApp.Picker.dob('.date-picker-alt'); 
        NioApp.Picker.time('.time-picker');
        NioApp.Picker.date('.date-picker-range', {
            todayHighlight: false,
            autoclose: false
        });
    };

    // Addons @v1
    NioApp.Addons.Init = function() {
        NioApp.Knob.init();
        NioApp.Range.init();
        NioApp.Select2.init();
        NioApp.Dropzone.init();
        NioApp.Slider.init();
        NioApp.DataTable.init();
    };

    // Toggler @v1
    NioApp.TGL.init = function() {
        NioApp.TGL.content('.toggle');
        NioApp.TGL.expand('.toggle-expand'); 
        NioApp.TGL.expand('.toggle-opt', {toggle: false}); 
        NioApp.TGL.showmenu('.nk-nav-toggle');
        NioApp.TGL.ddmenu('.'+ _menu + '-toggle', {self: _menu + '-toggle', child: _menu + '-sub' }); 
    };

    NioApp.BS.modalOnInit = function() {
        $('.modal').on('shown.bs.modal', function () {
            NioApp.Select2.init();
            NioApp.Validate.init();
        });

    };

    // Initial by default
    /////////////////////////////
    NioApp.init = function(){
        NioApp.coms.docReady.push(NioApp.OtherInit);
        NioApp.coms.docReady.push(NioApp.Prettify);
        NioApp.coms.docReady.push(NioApp.ColorBG);
        NioApp.coms.docReady.push(NioApp.ColorTXT);
        NioApp.coms.docReady.push(NioApp.Copied);
        NioApp.coms.docReady.push(NioApp.Ani.init);
        NioApp.coms.docReady.push(NioApp.TGL.init);
        NioApp.coms.docReady.push(NioApp.BS.init);
        NioApp.coms.docReady.push(NioApp.Validate.init);
        NioApp.coms.docReady.push(NioApp.Picker.init);
        NioApp.coms.docReady.push(NioApp.Addons.Init);
        NioApp.coms.docReady.push(NioApp.Wizard);
        NioApp.coms.docReady.push(NioApp.sbCompact);
        NioApp.coms.winLoad.push(NioApp.ModeSwitch);
    }

    NioApp.init();

	return NioApp;
})(NioApp, jQuery);
/*!
 * The Final Countdown for jQuery v2.2.0 (http://hilios.github.io/jQuery.countdown/)
 * Copyright (c) 2016 Edson Hilios
 * 
 * Permission is hereby granted, free of charge, to any person obtaining a copy of
 * this software and associated documentation files (the "Software"), to deal in
 * the Software without restriction, including without limitation the rights to
 * use, copy, modify, merge, publish, distribute, sublicense, and/or sell copies of
 * the Software, and to permit persons to whom the Software is furnished to do so,
 * subject to the following conditions:
 * 
 * The above copyright notice and this permission notice shall be included in all
 * copies or substantial portions of the Software.
 * 
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS
 * FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR
 * COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER
 * IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN
 * CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
 */
!function(a){"use strict";"function"==typeof define&&define.amd?define(["jquery"],a):a(jQuery)}(function(a){"use strict";function b(a){if(a instanceof Date)return a;if(String(a).match(g))return String(a).match(/^[0-9]*$/)&&(a=Number(a)),String(a).match(/\-/)&&(a=String(a).replace(/\-/g,"/")),new Date(a);throw new Error("Couldn't cast `"+a+"` to a date object.")}function c(a){var b=a.toString().replace(/([.?*+^$[\]\\(){}|-])/g,"\\$1");return new RegExp(b)}function d(a){return function(b){var d=b.match(/%(-|!)?[A-Z]{1}(:[^;]+;)?/gi);if(d)for(var f=0,g=d.length;f<g;++f){var h=d[f].match(/%(-|!)?([a-zA-Z]{1})(:[^;]+;)?/),j=c(h[0]),k=h[1]||"",l=h[3]||"",m=null;h=h[2],i.hasOwnProperty(h)&&(m=i[h],m=Number(a[m])),null!==m&&("!"===k&&(m=e(l,m)),""===k&&m<10&&(m="0"+m.toString()),b=b.replace(j,m.toString()))}return b=b.replace(/%%/,"%")}}function e(a,b){var c="s",d="";return a&&(a=a.replace(/(:|;|\s)/gi,"").split(/\,/),1===a.length?c=a[0]:(d=a[0],c=a[1])),Math.abs(b)>1?c:d}var f=[],g=[],h={precision:100,elapse:!1,defer:!1};g.push(/^[0-9]*$/.source),g.push(/([0-9]{1,2}\/){2}[0-9]{4}( [0-9]{1,2}(:[0-9]{2}){2})?/.source),g.push(/[0-9]{4}([\/\-][0-9]{1,2}){2}( [0-9]{1,2}(:[0-9]{2}){2})?/.source),g=new RegExp(g.join("|"));var i={Y:"years",m:"months",n:"daysToMonth",d:"daysToWeek",w:"weeks",W:"weeksToMonth",H:"hours",M:"minutes",S:"seconds",D:"totalDays",I:"totalHours",N:"totalMinutes",T:"totalSeconds"},j=function(b,c,d){this.el=b,this.$el=a(b),this.interval=null,this.offset={},this.options=a.extend({},h),this.instanceNumber=f.length,f.push(this),this.$el.data("countdown-instance",this.instanceNumber),d&&("function"==typeof d?(this.$el.on("update.countdown",d),this.$el.on("stoped.countdown",d),this.$el.on("finish.countdown",d)):this.options=a.extend({},h,d)),this.setFinalDate(c),this.options.defer===!1&&this.start()};a.extend(j.prototype,{start:function(){null!==this.interval&&clearInterval(this.interval);var a=this;this.update(),this.interval=setInterval(function(){a.update.call(a)},this.options.precision)},stop:function(){clearInterval(this.interval),this.interval=null,this.dispatchEvent("stoped")},toggle:function(){this.interval?this.stop():this.start()},pause:function(){this.stop()},resume:function(){this.start()},remove:function(){this.stop.call(this),f[this.instanceNumber]=null,delete this.$el.data().countdownInstance},setFinalDate:function(a){this.finalDate=b(a)},update:function(){if(0===this.$el.closest("html").length)return void this.remove();var b,c=void 0!==a._data(this.el,"events"),d=new Date;b=this.finalDate.getTime()-d.getTime(),b=Math.ceil(b/1e3),b=!this.options.elapse&&b<0?0:Math.abs(b),this.totalSecsLeft!==b&&c&&(this.totalSecsLeft=b,this.elapsed=d>=this.finalDate,this.offset={seconds:this.totalSecsLeft%60,minutes:Math.floor(this.totalSecsLeft/60)%60,hours:Math.floor(this.totalSecsLeft/60/60)%24,days:Math.floor(this.totalSecsLeft/60/60/24)%7,daysToWeek:Math.floor(this.totalSecsLeft/60/60/24)%7,daysToMonth:Math.floor(this.totalSecsLeft/60/60/24%30.4368),weeks:Math.floor(this.totalSecsLeft/60/60/24/7),weeksToMonth:Math.floor(this.totalSecsLeft/60/60/24/7)%4,months:Math.floor(this.totalSecsLeft/60/60/24/30.4368),years:Math.abs(this.finalDate.getFullYear()-d.getFullYear()),totalDays:Math.floor(this.totalSecsLeft/60/60/24),totalHours:Math.floor(this.totalSecsLeft/60/60),totalMinutes:Math.floor(this.totalSecsLeft/60),totalSeconds:this.totalSecsLeft},this.options.elapse||0!==this.totalSecsLeft?this.dispatchEvent("update"):(this.stop(),this.dispatchEvent("finish")))},dispatchEvent:function(b){var c=a.Event(b+".countdown");c.finalDate=this.finalDate,c.elapsed=this.elapsed,c.offset=a.extend({},this.offset),c.strftime=d(this.offset),this.$el.trigger(c)}}),a.fn.countdown=function(){var b=Array.prototype.slice.call(arguments,0);return this.each(function(){var c=a(this).data("countdown-instance");if(void 0!==c){var d=f[c],e=b[0];j.prototype.hasOwnProperty(e)?d[e].apply(d,b.slice(1)):null===String(e).match(/^[$A-Z_][0-9A-Z_$]*$/i)?(d.setFinalDate.call(d,e),d.start()):a.error("Method %s does not exist on jQuery.countdown".replace(/\%s/gi,e))}else new j(this,b[0],b[1])})}});
//================================================================================
// [pg-calendar]
// version: 1.4.31
// update: 2019.07.11
//================================================================================


!function(e,t){if(void 0===e&&void 0!==window&&(e=window),"function"==typeof define&&define.amd)define(["jquery"],function(e){return t(e)});else if("object"==typeof module&&module.exports){var n=t(require("jquery"));module.exports=n}else t(e.jquery)}(this,function(e){var t,Zn,n,f,r,i,m,g,p,y,_,v,s,a,k,o,l;function w(e,t){return s.call(e,t)}function u(e,t){var n,s,a,r,i,o,l,u,d,c,h,f=t&&t.split("/"),m=_.map,g=m&&m["*"]||{};if(e){for(i=(e=e.split("/")).length-1,_.nodeIdCompat&&k.test(e[i])&&(e[i]=e[i].replace(k,"")),"."===e[0].charAt(0)&&f&&(e=f.slice(0,f.length-1).concat(e)),d=0;d<e.length;d++)if("."===(h=e[d]))e.splice(d,1),d-=1;else if(".."===h){if(0===d||1===d&&".."===e[2]||".."===e[d-1])continue;0<d&&(e.splice(d-1,2),d-=2)}e=e.join("/")}if((f||g)&&m){for(d=(n=e.split("/")).length;0<d;d-=1){if(s=n.slice(0,d).join("/"),f)for(c=f.length;0<c;c-=1)if(a=(a=m[f.slice(0,c).join("/")])&&a[s]){r=a,o=d;break}if(r)break;!l&&g&&g[s]&&(l=g[s],u=d)}!r&&l&&(r=l,o=u),r&&(n.splice(0,o,r),e=n.join("/"))}return e}function M(t,n){return function(){var e=a.call(arguments,0);return"string"!=typeof e[0]&&1===e.length&&e.push(null),i.apply(f,e.concat([t,n]))}}function D(t){return function(e){p[t]=e}}function b(e){if(w(y,e)){var t=y[e];delete y[e],v[e]=!0,r.apply(f,t)}if(!w(p,e)&&!w(v,e))throw new Error("No "+e);return p[e]}function d(e){var t,n=e?e.indexOf("!"):-1;return-1<n&&(t=e.substring(0,n),e=e.substring(n+1,e.length)),[t,e]}function S(e){return e?d(e):[]}function U(e){return(U="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}function U(e){return(U="function"==typeof Symbol&&"symbol"==typeof Symbol.iterator?function(e){return typeof e}:function(e){return e&&"function"==typeof Symbol&&e.constructor===Symbol&&e!==Symbol.prototype?"symbol":typeof e})(e)}p={},y={},_={},v={},s=Object.prototype.hasOwnProperty,a=[].slice,k=/\.js$/,m=function(e,t){var n,s=d(e),a=s[0],r=t[1];return e=s[1],a&&(n=b(a=u(a,r))),a?e=n&&n.normalize?n.normalize(e,function(t){return function(e){return u(e,t)}}(r)):u(e,r):(a=(s=d(e=u(e,r)))[0],e=s[1],a&&(n=b(a))),{f:a?a+"!"+e:e,n:e,pr:a,p:n}},g={require:function(e){return M(e)},exports:function(e){var t=p[e];return void 0!==t?t:p[e]={}},module:function(e){return{id:e,uri:"",exports:p[e],config:function(e){return function(){return _&&_.config&&_.config[e]||{}}}(e)}}},r=function(e,t,n,s){var a,r,i,o,l,u,d,c=[],h=typeof n;if(u=S(s=s||e),"undefined"==h||"function"==h){for(t=!t.length&&n.length?["require","exports","module"]:t,l=0;l<t.length;l+=1)if("require"===(r=(o=m(t[l],u)).f))c[l]=g.require(e);else if("exports"===r)c[l]=g.exports(e),d=!0;else if("module"===r)a=c[l]=g.module(e);else if(w(p,r)||w(y,r)||w(v,r))c[l]=b(r);else{if(!o.p)throw new Error(e+" missing "+r);o.p.load(o.n,M(s,!0),D(r),{}),c[l]=p[r]}i=n?n.apply(p[e],c):void 0,e&&(a&&a.exports!==f&&a.exports!==p[e]?p[e]=a.exports:i===f&&d||(p[e]=i))}else e&&(p[e]=n)},t=Zn=i=function(e,t,n,s,a){if("string"==typeof e)return g[e]?g[e](t):b(m(e,S(t)).f);if(!e.splice){if((_=e).deps&&i(_.deps,_.callback),!t)return;t.splice?(e=t,t=n,n=null):e=f}return t=t||function(){},"function"==typeof n&&(n=s,s=a),s?r(f,e,t,n):setTimeout(function(){r(f,e,t,n)},4),i},i.config=function(e){return i(e)},t._defined=p,(n=function(e,t,n){if("string"!=typeof e)throw new Error("See almond README: incorrect module build, no module name");t.splice||(n=t,t=[]),w(p,e)||w(y,e)||(y[e]=[e,t,n])}).amd={jQuery:!0},n("almond",function(){}),n("component/models",[],function(){return{name:"pignoseCalendar",version:"1.4.31",preference:{supports:{themes:["light","dark","blue"]}}}}),n("component/helper",["./models"],function(u){function n(){}var i={},d={},s={},c=/[A-Z]/;return n.format=function(e){if(e){var t=Array.prototype.slice.call(arguments,1),n=e+t.join(".");if(i[n])return i[n];for(var s=t.length,a=0;a<s;a++){var r=t[a];e=e.replace(new RegExp("((?!\\\\)?\\{"+a+"(?!\\\\)?\\})","g"),r)}return e=e.replace(new RegExp("\\\\{([0-9]+)\\\\}","g"),"{$1}"),i[n]=e}return""},n.getClass=function(e){var t=[u.name,e].join(".");if(d[t])return d[t];for(var n=e.split(""),s=[],a=n.length,r=0,i=0;r<a;r++){var o=n[r];!0===c.test(o)&&(s[i++]="-",o=o.toString().toLowerCase()),s[i++]=o}var l=s.join("");return d[t]=l},n.getSubClass=function(e){if(e&&e.length){var t=e.split("");t[0]=t[0].toUpperCase(),e=t.join("")}return s[e]||(s[e]=n.getClass(n.format("{0}{1}",u.name,e))),s[e]},n}),o=this,l=function(){"use strict";var e,a;function _(){return e.apply(null,arguments)}function o(e){return e instanceof Array||"[object Array]"===Object.prototype.toString.call(e)}function l(e){return null!=e&&"[object Object]"===Object.prototype.toString.call(e)}function u(e){return void 0===e}function d(e){return"number"==typeof e||"[object Number]"===Object.prototype.toString.call(e)}function c(e){return e instanceof Date||"[object Date]"===Object.prototype.toString.call(e)}function h(e,t){var n,s=[];for(n=0;n<e.length;++n)s.push(t(e[n],n));return s}function v(e,t){return Object.prototype.hasOwnProperty.call(e,t)}function f(e,t){for(var n in t)v(t,n)&&(e[n]=t[n]);return v(t,"toString")&&(e.toString=t.toString),v(t,"valueOf")&&(e.valueOf=t.valueOf),e}function m(e,t,n,s){return St(e,t,n,s,!0).utc()}function k(e){return null==e._pf&&(e._pf={empty:!1,unusedTokens:[],unusedInput:[],overflow:-2,charsLeftOver:0,nullInput:!1,invalidMonth:null,invalidFormat:!1,userInvalidated:!1,iso:!1,parsedDateParts:[],meridiem:null,rfc2822:!1,weekdayMismatch:!1}),e._pf}function g(e){if(null==e._isValid){var t=k(e),n=a.call(t.parsedDateParts,function(e){return null!=e}),s=!isNaN(e._d.getTime())&&t.overflow<0&&!t.empty&&!t.invalidMonth&&!t.invalidWeekday&&!t.weekdayMismatch&&!t.nullInput&&!t.invalidFormat&&!t.userInvalidated&&(!t.meridiem||t.meridiem&&n);if(e._strict&&(s=s&&0===t.charsLeftOver&&0===t.unusedTokens.length&&void 0===t.bigHour),null!=Object.isFrozen&&Object.isFrozen(e))return s;e._isValid=s}return e._isValid}function p(e){var t=m(NaN);return null!=e?f(k(t),e):k(t).userInvalidated=!0,t}a=Array.prototype.some?Array.prototype.some:function(e){for(var t=Object(this),n=t.length>>>0,s=0;s<n;s++)if(s in t&&e.call(this,t[s],s,t))return!0;return!1};var r=_.momentProperties=[];function y(e,t){var n,s,a;if(u(t._isAMomentObject)||(e._isAMomentObject=t._isAMomentObject),u(t._i)||(e._i=t._i),u(t._f)||(e._f=t._f),u(t._l)||(e._l=t._l),u(t._strict)||(e._strict=t._strict),u(t._tzm)||(e._tzm=t._tzm),u(t._isUTC)||(e._isUTC=t._isUTC),u(t._offset)||(e._offset=t._offset),u(t._pf)||(e._pf=k(t)),u(t._locale)||(e._locale=t._locale),0<r.length)for(n=0;n<r.length;n++)u(a=t[s=r[n]])||(e[s]=a);return e}var t=!1;function w(e){y(this,e),this._d=new Date(null!=e._d?e._d.getTime():NaN),this.isValid()||(this._d=new Date(NaN)),!1===t&&(t=!0,_.updateOffset(this),t=!1)}function M(e){return e instanceof w||null!=e&&null!=e._isAMomentObject}function D(e){return e<0?Math.ceil(e)||0:Math.floor(e)}function b(e){var t=+e,n=0;return 0!=t&&isFinite(t)&&(n=D(t)),n}function i(e,t,n){var s,a=Math.min(e.length,t.length),r=Math.abs(e.length-t.length),i=0;for(s=0;s<a;s++)(n&&e[s]!==t[s]||!n&&b(e[s])!==b(t[s]))&&i++;return i+r}function S(e){!1===_.suppressDeprecationWarnings&&"undefined"!=typeof console&&console.warn&&console.warn("Deprecation warning: "+e)}function n(a,r){var i=!0;return f(function(){if(null!=_.deprecationHandler&&_.deprecationHandler(null,a),i){for(var e,t=[],n=0;n<arguments.length;n++){if(e="","object"==typeof arguments[n]){for(var s in e+="\n["+n+"] ",arguments[0])e+=s+": "+arguments[0][s]+", ";e=e.slice(0,-2)}else e=arguments[n];t.push(e)}S(a+"\nArguments: "+Array.prototype.slice.call(t).join("")+"\n"+(new Error).stack),i=!1}return r.apply(this,arguments)},r)}var s,Y={};function C(e,t){null!=_.deprecationHandler&&_.deprecationHandler(e,t),Y[e]||(S(t),Y[e]=!0)}function O(e){return e instanceof Function||"[object Function]"===Object.prototype.toString.call(e)}function T(e,t){var n,s=f({},e);for(n in t)v(t,n)&&(l(e[n])&&l(t[n])?(s[n]={},f(s[n],e[n]),f(s[n],t[n])):null!=t[n]?s[n]=t[n]:delete s[n]);for(n in e)v(e,n)&&!v(t,n)&&l(e[n])&&(s[n]=f({},s[n]));return s}function x(e){null!=e&&this.set(e)}_.suppressDeprecationWarnings=!1,_.deprecationHandler=null,s=Object.keys?Object.keys:function(e){var t,n=[];for(t in e)v(e,t)&&n.push(t);return n};var W={};function P(e,t){var n=e.toLowerCase();W[n]=W[n+"s"]=W[t]=e}function L(e){return"string"==typeof e?W[e]||W[e.toLowerCase()]:void 0}function A(e){var t,n,s={};for(n in e)v(e,n)&&(t=L(n))&&(s[t]=e[n]);return s}var H={};function F(e,t){H[e]=t}function R(e,t,n){var s=""+Math.abs(e),a=t-s.length;return(0<=e?n?"+":"":"-")+Math.pow(10,Math.max(0,a)).toString().substr(1)+s}var j=/(\[[^\[]*\])|(\\)?([Hh]mm(ss)?|Mo|MM?M?M?|Do|DDDo|DD?D?D?|ddd?d?|do?|w[o|w]?|W[o|W]?|Qo?|YYYYYY|YYYYY|YYYY|YY|gg(ggg?)?|GG(GGG?)?|e|E|a|A|hh?|HH?|kk?|mm?|ss?|S{1,9}|x|X|zz?|ZZ?|.)/g,N=/(\[[^\[]*\])|(\\)?(LTS|LT|LL?L?L?|l{1,4})/g,U={},G={};function V(e,t,n,s){var a=s;"string"==typeof s&&(a=function(){return this[s]()}),e&&(G[e]=a),t&&(G[t[0]]=function(){return R(a.apply(this,arguments),t[1],t[2])}),n&&(G[n]=function(){return this.localeData().ordinal(a.apply(this,arguments),e)})}function E(e,t){return e.isValid()?(t=I(t,e.localeData()),U[t]=U[t]||function(s){var e,a,t,r=s.match(j);for(e=0,a=r.length;e<a;e++)G[r[e]]?r[e]=G[r[e]]:r[e]=(t=r[e]).match(/\[[\s\S]/)?t.replace(/^\[|\]$/g,""):t.replace(/\\/g,"");return function(e){var t,n="";for(t=0;t<a;t++)n+=O(r[t])?r[t].call(e,s):r[t];return n}}(t),U[t](e)):e.localeData().invalidDate()}function I(e,t){var n=5;function s(e){return t.longDateFormat(e)||e}for(N.lastIndex=0;0<=n&&N.test(e);)e=e.replace(N,s),N.lastIndex=0,n-=1;return e}var z=/\d/,J=/\d\d/,Z=/\d{3}/,q=/\d{4}/,$=/[+-]?\d{6}/,B=/\d\d?/,Q=/\d\d\d\d?/,K=/\d\d\d\d\d\d?/,X=/\d{1,3}/,ee=/\d{1,4}/,te=/[+-]?\d{1,6}/,ne=/\d+/,se=/[+-]?\d+/,ae=/Z|[+-]\d\d:?\d\d/gi,re=/Z|[+-]\d\d(?::?\d\d)?/gi,ie=/[0-9]{0,256}['a-z\u00A0-\u05FF\u0700-\uD7FF\uF900-\uFDCF\uFDF0-\uFF07\uFF10-\uFFEF]{1,256}|[\u0600-\u06FF\/]{1,256}(\s*?[\u0600-\u06FF]{1,256}){1,2}/i,oe={};function le(e,n,s){oe[e]=O(n)?n:function(e,t){return e&&s?s:n}}function ue(e){return e.replace(/[-\/\\^$*+?.()|[\]{}]/g,"\\$&")}var de={};function ce(e,n){var t,s=n;for("string"==typeof e&&(e=[e]),d(n)&&(s=function(e,t){t[n]=b(e)}),t=0;t<e.length;t++)de[e[t]]=s}function he(e,a){ce(e,function(e,t,n,s){n._w=n._w||{},a(e,n._w,n,s)})}var fe=0,me=1,ge=2,pe=3,ye=4,_e=5,ve=6,ke=7,we=8;function Me(e){return De(e)?366:365}function De(e){return e%4==0&&e%100!=0||e%400==0}V("Y",0,0,function(){var e=this.year();return e<=9999?""+e:"+"+e}),V(0,["YY",2],0,function(){return this.year()%100}),V(0,["YYYY",4],0,"year"),V(0,["YYYYY",5],0,"year"),V(0,["YYYYYY",6,!0],0,"year"),P("year","y"),F("year",1),le("Y",se),le("YY",B,J),le("YYYY",ee,q),le("YYYYY",te,$),le("YYYYYY",te,$),ce(["YYYYY","YYYYYY"],fe),ce("YYYY",function(e,t){t[fe]=2===e.length?_.parseTwoDigitYear(e):b(e)}),ce("YY",function(e,t){t[fe]=_.parseTwoDigitYear(e)}),ce("Y",function(e,t){t[fe]=parseInt(e,10)}),_.parseTwoDigitYear=function(e){return b(e)+(68<b(e)?1900:2e3)};var be,Se=Ye("FullYear",!0);function Ye(t,n){return function(e){return null!=e?(Oe(this,t,e),_.updateOffset(this,n),this):Ce(this,t)}}function Ce(e,t){return e.isValid()?e._d["get"+(e._isUTC?"UTC":"")+t]():NaN}function Oe(e,t,n){e.isValid()&&!isNaN(n)&&("FullYear"===t&&De(e.year())&&1===e.month()&&29===e.date()?e._d["set"+(e._isUTC?"UTC":"")+t](n,e.month(),Te(n,e.month())):e._d["set"+(e._isUTC?"UTC":"")+t](n))}function Te(e,t){if(isNaN(e)||isNaN(t))return NaN;var n=(t%12+12)%12;return e+=(t-n)/12,1==n?De(e)?29:28:31-n%7%2}be=Array.prototype.indexOf?Array.prototype.indexOf:function(e){var t;for(t=0;t<this.length;++t)if(this[t]===e)return t;return-1},V("M",["MM",2],"Mo",function(){return this.month()+1}),V("MMM",0,0,function(e){return this.localeData().monthsShort(this,e)}),V("MMMM",0,0,function(e){return this.localeData().months(this,e)}),P("month","M"),F("month",8),le("M",B),le("MM",B,J),le("MMM",function(e,t){return t.monthsShortRegex(e)}),le("MMMM",function(e,t){return t.monthsRegex(e)}),ce(["M","MM"],function(e,t){t[me]=b(e)-1}),ce(["MMM","MMMM"],function(e,t,n,s){var a=n._locale.monthsParse(e,s,n._strict);null!=a?t[me]=a:k(n).invalidMonth=e});var xe=/D[oD]?(\[[^\[\]]*\]|\s)+MMMM?/,We="January_February_March_April_May_June_July_August_September_October_November_December".split("_"),Pe="Jan_Feb_Mar_Apr_May_Jun_Jul_Aug_Sep_Oct_Nov_Dec".split("_");function Le(e,t){var n;if(!e.isValid())return e;if("string"==typeof t)if(/^\d+$/.test(t))t=b(t);else if(!d(t=e.localeData().monthsParse(t)))return e;return n=Math.min(e.date(),Te(e.year(),t)),e._d["set"+(e._isUTC?"UTC":"")+"Month"](t,n),e}function Ae(e){return null!=e?(Le(this,e),_.updateOffset(this,!0),this):Ce(this,"Month")}var He=ie,Fe=ie;function Re(){function e(e,t){return t.length-e.length}var t,n,s=[],a=[],r=[];for(t=0;t<12;t++)n=m([2e3,t]),s.push(this.monthsShort(n,"")),a.push(this.months(n,"")),r.push(this.months(n,"")),r.push(this.monthsShort(n,""));for(s.sort(e),a.sort(e),r.sort(e),t=0;t<12;t++)s[t]=ue(s[t]),a[t]=ue(a[t]);for(t=0;t<24;t++)r[t]=ue(r[t]);this._monthsRegex=new RegExp("^("+r.join("|")+")","i"),this._monthsShortRegex=this._monthsRegex,this._monthsStrictRegex=new RegExp("^("+a.join("|")+")","i"),this._monthsShortStrictRegex=new RegExp("^("+s.join("|")+")","i")}function je(e){var t;if(e<100&&0<=e){var n=Array.prototype.slice.call(arguments);n[0]=e+400,t=new Date(Date.UTC.apply(null,n)),isFinite(t.getUTCFullYear())&&t.setUTCFullYear(e)}else t=new Date(Date.UTC.apply(null,arguments));return t}function Ne(e,t,n){var s=7+t-n;return-(7+je(e,0,s).getUTCDay()-t)%7+s-1}function Ue(e,t,n,s,a){var r,i,o=1+7*(t-1)+(7+n-s)%7+Ne(e,s,a);return i=o<=0?Me(r=e-1)+o:o>Me(e)?(r=e+1,o-Me(e)):(r=e,o),{year:r,dayOfYear:i}}function Ge(e,t,n){var s,a,r=Ne(e.year(),t,n),i=Math.floor((e.dayOfYear()-r-1)/7)+1;return i<1?s=i+Ve(a=e.year()-1,t,n):i>Ve(e.year(),t,n)?(s=i-Ve(e.year(),t,n),a=e.year()+1):(a=e.year(),s=i),{week:s,year:a}}function Ve(e,t,n){var s=Ne(e,t,n),a=Ne(e+1,t,n);return(Me(e)-s+a)/7}function Ee(e,t){return e.slice(t,7).concat(e.slice(0,t))}V("w",["ww",2],"wo","week"),V("W",["WW",2],"Wo","isoWeek"),P("week","w"),P("isoWeek","W"),F("week",5),F("isoWeek",5),le("w",B),le("ww",B,J),le("W",B),le("WW",B,J),he(["w","ww","W","WW"],function(e,t,n,s){t[s.substr(0,1)]=b(e)}),V("d",0,"do","day"),V("dd",0,0,function(e){return this.localeData().weekdaysMin(this,e)}),V("ddd",0,0,function(e){return this.localeData().weekdaysShort(this,e)}),V("dddd",0,0,function(e){return this.localeData().weekdays(this,e)}),V("e",0,0,"weekday"),V("E",0,0,"isoWeekday"),P("day","d"),P("weekday","e"),P("isoWeekday","E"),F("day",11),F("weekday",11),F("isoWeekday",11),le("d",B),le("e",B),le("E",B),le("dd",function(e,t){return t.weekdaysMinRegex(e)}),le("ddd",function(e,t){return t.weekdaysShortRegex(e)}),le("dddd",function(e,t){return t.weekdaysRegex(e)}),he(["dd","ddd","dddd"],function(e,t,n,s){var a=n._locale.weekdaysParse(e,s,n._strict);null!=a?t.d=a:k(n).invalidWeekday=e}),he(["d","e","E"],function(e,t,n,s){t[s]=b(e)});var Ie="Sunday_Monday_Tuesday_Wednesday_Thursday_Friday_Saturday".split("_"),ze="Sun_Mon_Tue_Wed_Thu_Fri_Sat".split("_"),Je="Su_Mo_Tu_We_Th_Fr_Sa".split("_"),Ze=ie,qe=ie,$e=ie;function Be(){function e(e,t){return t.length-e.length}var t,n,s,a,r,i=[],o=[],l=[],u=[];for(t=0;t<7;t++)n=m([2e3,1]).day(t),s=this.weekdaysMin(n,""),a=this.weekdaysShort(n,""),r=this.weekdays(n,""),i.push(s),o.push(a),l.push(r),u.push(s),u.push(a),u.push(r);for(i.sort(e),o.sort(e),l.sort(e),u.sort(e),t=0;t<7;t++)o[t]=ue(o[t]),l[t]=ue(l[t]),u[t]=ue(u[t]);this._weekdaysRegex=new RegExp("^("+u.join("|")+")","i"),this._weekdaysShortRegex=this._weekdaysRegex,this._weekdaysMinRegex=this._weekdaysRegex,this._weekdaysStrictRegex=new RegExp("^("+l.join("|")+")","i"),this._weekdaysShortStrictRegex=new RegExp("^("+o.join("|")+")","i"),this._weekdaysMinStrictRegex=new RegExp("^("+i.join("|")+")","i")}function Qe(){return this.hours()%12||12}function Ke(e,t){V(e,0,0,function(){return this.localeData().meridiem(this.hours(),this.minutes(),t)})}function Xe(e,t){return t._meridiemParse}V("H",["HH",2],0,"hour"),V("h",["hh",2],0,Qe),V("k",["kk",2],0,function(){return this.hours()||24}),V("hmm",0,0,function(){return""+Qe.apply(this)+R(this.minutes(),2)}),V("hmmss",0,0,function(){return""+Qe.apply(this)+R(this.minutes(),2)+R(this.seconds(),2)}),V("Hmm",0,0,function(){return""+this.hours()+R(this.minutes(),2)}),V("Hmmss",0,0,function(){return""+this.hours()+R(this.minutes(),2)+R(this.seconds(),2)}),Ke("a",!0),Ke("A",!1),P("hour","h"),F("hour",13),le("a",Xe),le("A",Xe),le("H",B),le("h",B),le("k",B),le("HH",B,J),le("hh",B,J),le("kk",B,J),le("hmm",Q),le("hmmss",K),le("Hmm",Q),le("Hmmss",K),ce(["H","HH"],pe),ce(["k","kk"],function(e,t,n){var s=b(e);t[pe]=24===s?0:s}),ce(["a","A"],function(e,t,n){n._isPm=n._locale.isPM(e),n._meridiem=e}),ce(["h","hh"],function(e,t,n){t[pe]=b(e),k(n).bigHour=!0}),ce("hmm",function(e,t,n){var s=e.length-2;t[pe]=b(e.substr(0,s)),t[ye]=b(e.substr(s)),k(n).bigHour=!0}),ce("hmmss",function(e,t,n){var s=e.length-4,a=e.length-2;t[pe]=b(e.substr(0,s)),t[ye]=b(e.substr(s,2)),t[_e]=b(e.substr(a)),k(n).bigHour=!0}),ce("Hmm",function(e,t,n){var s=e.length-2;t[pe]=b(e.substr(0,s)),t[ye]=b(e.substr(s))}),ce("Hmmss",function(e,t,n){var s=e.length-4,a=e.length-2;t[pe]=b(e.substr(0,s)),t[ye]=b(e.substr(s,2)),t[_e]=b(e.substr(a))});var et,tt=Ye("Hours",!0),nt={calendar:{sameDay:"[Today at] LT",nextDay:"[Tomorrow at] LT",nextWeek:"dddd [at] LT",lastDay:"[Yesterday at] LT",lastWeek:"[Last] dddd [at] LT",sameElse:"L"},longDateFormat:{LTS:"h:mm:ss A",LT:"h:mm A",L:"MM/DD/YYYY",LL:"MMMM D, YYYY",LLL:"MMMM D, YYYY h:mm A",LLLL:"dddd, MMMM D, YYYY h:mm A"},invalidDate:"Invalid date",ordinal:"%d",dayOfMonthOrdinalParse:/\d{1,2}/,relativeTime:{future:"in %s",past:"%s ago",s:"a few seconds",ss:"%d seconds",m:"a minute",mm:"%d minutes",h:"an hour",hh:"%d hours",d:"a day",dd:"%d days",M:"a month",MM:"%d months",y:"a year",yy:"%d years"},months:We,monthsShort:Pe,week:{dow:0,doy:6},weekdays:Ie,weekdaysMin:Je,weekdaysShort:ze,meridiemParse:/[ap]\.?m?\.?/i},st={},at={};function rt(e){return e?e.toLowerCase().replace("_","-"):e}function it(e){var t=null;if(!st[e]&&"undefined"!=typeof module&&module&&module.exports)try{t=et._abbr,Zn("./locale/"+e),ot(t)}catch(e){}return st[e]}function ot(e,t){var n;return e&&((n=u(t)?ut(e):lt(e,t))?et=n:"undefined"!=typeof console&&console.warn&&console.warn("Locale "+e+" not found. Did you forget to load it?")),et._abbr}function lt(e,t){if(null===t)return delete st[e],null;var n,s=nt;if(t.abbr=e,null!=st[e])C("defineLocaleOverride","use moment.updateLocale(localeName, config) to change an existing locale. moment.defineLocale(localeName, config) should only be used for creating a new locale See http://momentjs.com/guides/#/warnings/define-locale/ for more info."),s=st[e]._config;else if(null!=t.parentLocale)if(null!=st[t.parentLocale])s=st[t.parentLocale]._config;else{if(null==(n=it(t.parentLocale)))return at[t.parentLocale]||(at[t.parentLocale]=[]),at[t.parentLocale].push({name:e,config:t}),null;s=n._config}return st[e]=new x(T(s,t)),at[e]&&at[e].forEach(function(e){lt(e.name,e.config)}),ot(e),st[e]}function ut(e){var t;if(e&&e._locale&&e._locale._abbr&&(e=e._locale._abbr),!e)return et;if(!o(e)){if(t=it(e))return t;e=[e]}return function(e){for(var t,n,s,a,r=0;r<e.length;){for(t=(a=rt(e[r]).split("-")).length,n=(n=rt(e[r+1]))?n.split("-"):null;0<t;){if(s=it(a.slice(0,t).join("-")))return s;if(n&&n.length>=t&&i(a,n,!0)>=t-1)break;t--}r++}return et}(e)}function dt(e){var t,n=e._a;return n&&-2===k(e).overflow&&(t=n[me]<0||11<n[me]?me:n[ge]<1||n[ge]>Te(n[fe],n[me])?ge:n[pe]<0||24<n[pe]||24===n[pe]&&(0!==n[ye]||0!==n[_e]||0!==n[ve])?pe:n[ye]<0||59<n[ye]?ye:n[_e]<0||59<n[_e]?_e:n[ve]<0||999<n[ve]?ve:-1,k(e)._overflowDayOfYear&&(t<fe||ge<t)&&(t=ge),k(e)._overflowWeeks&&-1===t&&(t=ke),k(e)._overflowWeekday&&-1===t&&(t=we),k(e).overflow=t),e}function ct(e,t,n){return null!=e?e:null!=t?t:n}function ht(e){var t,n,s,a,r,i=[];if(!e._d){var o,l;for(o=e,l=new Date(_.now()),s=o._useUTC?[l.getUTCFullYear(),l.getUTCMonth(),l.getUTCDate()]:[l.getFullYear(),l.getMonth(),l.getDate()],e._w&&null==e._a[ge]&&null==e._a[me]&&function(e){var t,n,s,a,r,i,o,l;if(null!=(t=e._w).GG||null!=t.W||null!=t.E)r=1,i=4,n=ct(t.GG,e._a[fe],Ge(Yt(),1,4).year),s=ct(t.W,1),((a=ct(t.E,1))<1||7<a)&&(l=!0);else{r=e._locale._week.dow,i=e._locale._week.doy;var u=Ge(Yt(),r,i);n=ct(t.gg,e._a[fe],u.year),s=ct(t.w,u.week),null!=t.d?((a=t.d)<0||6<a)&&(l=!0):null!=t.e?(a=t.e+r,(t.e<0||6<t.e)&&(l=!0)):a=r}s<1||s>Ve(n,r,i)?k(e)._overflowWeeks=!0:null!=l?k(e)._overflowWeekday=!0:(o=Ue(n,s,a,r,i),e._a[fe]=o.year,e._dayOfYear=o.dayOfYear)}(e),null!=e._dayOfYear&&(r=ct(e._a[fe],s[fe]),(e._dayOfYear>Me(r)||0===e._dayOfYear)&&(k(e)._overflowDayOfYear=!0),n=je(r,0,e._dayOfYear),e._a[me]=n.getUTCMonth(),e._a[ge]=n.getUTCDate()),t=0;t<3&&null==e._a[t];++t)e._a[t]=i[t]=s[t];for(;t<7;t++)e._a[t]=i[t]=null==e._a[t]?2===t?1:0:e._a[t];24===e._a[pe]&&0===e._a[ye]&&0===e._a[_e]&&0===e._a[ve]&&(e._nextDay=!0,e._a[pe]=0),e._d=(e._useUTC?je:function(e,t,n,s,a,r,i){var o;return e<100&&0<=e?(o=new Date(e+400,t,n,s,a,r,i),isFinite(o.getFullYear())&&o.setFullYear(e)):o=new Date(e,t,n,s,a,r,i),o}).apply(null,i),a=e._useUTC?e._d.getUTCDay():e._d.getDay(),null!=e._tzm&&e._d.setUTCMinutes(e._d.getUTCMinutes()-e._tzm),e._nextDay&&(e._a[pe]=24),e._w&&void 0!==e._w.d&&e._w.d!==a&&(k(e).weekdayMismatch=!0)}}var ft=/^\s*((?:[+-]\d{6}|\d{4})-(?:\d\d-\d\d|W\d\d-\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?::\d\d(?::\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,mt=/^\s*((?:[+-]\d{6}|\d{4})(?:\d\d\d\d|W\d\d\d|W\d\d|\d\d\d|\d\d))(?:(T| )(\d\d(?:\d\d(?:\d\d(?:[.,]\d+)?)?)?)([\+\-]\d\d(?::?\d\d)?|\s*Z)?)?$/,gt=/Z|[+-]\d\d(?::?\d\d)?/,pt=[["YYYYYY-MM-DD",/[+-]\d{6}-\d\d-\d\d/],["YYYY-MM-DD",/\d{4}-\d\d-\d\d/],["GGGG-[W]WW-E",/\d{4}-W\d\d-\d/],["GGGG-[W]WW",/\d{4}-W\d\d/,!1],["YYYY-DDD",/\d{4}-\d{3}/],["YYYY-MM",/\d{4}-\d\d/,!1],["YYYYYYMMDD",/[+-]\d{10}/],["YYYYMMDD",/\d{8}/],["GGGG[W]WWE",/\d{4}W\d{3}/],["GGGG[W]WW",/\d{4}W\d{2}/,!1],["YYYYDDD",/\d{7}/]],yt=[["HH:mm:ss.SSSS",/\d\d:\d\d:\d\d\.\d+/],["HH:mm:ss,SSSS",/\d\d:\d\d:\d\d,\d+/],["HH:mm:ss",/\d\d:\d\d:\d\d/],["HH:mm",/\d\d:\d\d/],["HHmmss.SSSS",/\d\d\d\d\d\d\.\d+/],["HHmmss,SSSS",/\d\d\d\d\d\d,\d+/],["HHmmss",/\d\d\d\d\d\d/],["HHmm",/\d\d\d\d/],["HH",/\d\d/]],_t=/^\/?Date\((\-?\d+)/i;function vt(e){var t,n,s,a,r,i,o=e._i,l=ft.exec(o)||mt.exec(o);if(l){for(k(e).iso=!0,t=0,n=pt.length;t<n;t++)if(pt[t][1].exec(l[1])){a=pt[t][0],s=!1!==pt[t][2];break}if(null==a)return void(e._isValid=!1);if(l[3]){for(t=0,n=yt.length;t<n;t++)if(yt[t][1].exec(l[3])){r=(l[2]||" ")+yt[t][0];break}if(null==r)return void(e._isValid=!1)}if(!s&&null!=r)return void(e._isValid=!1);if(l[4]){if(!gt.exec(l[4]))return void(e._isValid=!1);i="Z"}e._f=a+(r||"")+(i||""),Dt(e)}else e._isValid=!1}var kt=/^(?:(Mon|Tue|Wed|Thu|Fri|Sat|Sun),?\s)?(\d{1,2})\s(Jan|Feb|Mar|Apr|May|Jun|Jul|Aug|Sep|Oct|Nov|Dec)\s(\d{2,4})\s(\d\d):(\d\d)(?::(\d\d))?\s(?:(UT|GMT|[ECMP][SD]T)|([Zz])|([+-]\d{4}))$/;var wt={UT:0,GMT:0,EDT:-240,EST:-300,CDT:-300,CST:-360,MDT:-360,MST:-420,PDT:-420,PST:-480};function Mt(e){var t,n,s,a=kt.exec(e._i.replace(/\([^)]*\)|[\n\t]/g," ").replace(/(\s\s+)/g," ").replace(/^\s\s*/,"").replace(/\s\s*$/,""));if(a){var r=function(e,t,n,s,a,r){var i,o=[(i=parseInt(e,10),i<=49?2e3+i:i<=999?1900+i:i),Pe.indexOf(t),parseInt(n,10),parseInt(s,10),parseInt(a,10)];return r&&o.push(parseInt(r,10)),o}(a[4],a[3],a[2],a[5],a[6],a[7]);if(n=r,s=e,(t=a[1])&&ze.indexOf(t)!==new Date(n[0],n[1],n[2]).getDay()&&(k(s).weekdayMismatch=!0,!(s._isValid=!1)))return;e._a=r,e._tzm=function(e,t,n){if(e)return wt[e];if(t)return 0;var s=parseInt(n,10),a=s%100;return(s-a)/100*60+a}(a[8],a[9],a[10]),e._d=je.apply(null,e._a),e._d.setUTCMinutes(e._d.getUTCMinutes()-e._tzm),k(e).rfc2822=!0}else e._isValid=!1}function Dt(e){if(e._f!==_.ISO_8601)if(e._f!==_.RFC_2822){e._a=[],k(e).empty=!0;var t,n,s,a,r,i,o,l,u=""+e._i,d=u.length,c=0;for(s=I(e._f,e._locale).match(j)||[],t=0;t<s.length;t++)a=s[t],(n=(u.match((y=e,v(oe,p=a)?oe[p](y._strict,y._locale):new RegExp(ue(p.replace("\\","").replace(/\\(\[)|\\(\])|\[([^\]\[]*)\]|\\(.)/g,function(e,t,n,s,a){return t||n||s||a})))))||[])[0])&&(0<(r=u.substr(0,u.indexOf(n))).length&&k(e).unusedInput.push(r),u=u.slice(u.indexOf(n)+n.length),c+=n.length),G[a]?(n?k(e).empty=!1:k(e).unusedTokens.push(a),i=a,l=e,null!=(o=n)&&v(de,i)&&de[i](o,l._a,l,i)):e._strict&&!n&&k(e).unusedTokens.push(a);k(e).charsLeftOver=d-c,0<u.length&&k(e).unusedInput.push(u),e._a[pe]<=12&&!0===k(e).bigHour&&0<e._a[pe]&&(k(e).bigHour=void 0),k(e).parsedDateParts=e._a.slice(0),k(e).meridiem=e._meridiem,e._a[pe]=(h=e._locale,f=e._a[pe],null==(m=e._meridiem)?f:null!=h.meridiemHour?h.meridiemHour(f,m):(null!=h.isPM&&((g=h.isPM(m))&&f<12&&(f+=12),g||12!==f||(f=0)),f)),ht(e),dt(e)}else Mt(e);else vt(e);var h,f,m,g,p,y}function bt(e){var t,n,s,a,r=e._i,i=e._f;return e._locale=e._locale||ut(e._l),null===r||void 0===i&&""===r?p({nullInput:!0}):("string"==typeof r&&(e._i=r=e._locale.preparse(r)),M(r)?new w(dt(r)):(c(r)?e._d=r:o(i)?function(e){var t,n,s,a,r;if(0===e._f.length)return k(e).invalidFormat=!0,e._d=new Date(NaN);for(a=0;a<e._f.length;a++)r=0,t=y({},e),null!=e._useUTC&&(t._useUTC=e._useUTC),t._f=e._f[a],Dt(t),g(t)&&(r+=k(t).charsLeftOver,r+=10*k(t).unusedTokens.length,k(t).score=r,(null==s||r<s)&&(s=r,n=t));f(e,n||t)}(e):i?Dt(e):u(n=(t=e)._i)?t._d=new Date(_.now()):c(n)?t._d=new Date(n.valueOf()):"string"==typeof n?(s=t,null===(a=_t.exec(s._i))?(vt(s),!1===s._isValid&&(delete s._isValid,Mt(s),!1===s._isValid&&(delete s._isValid,_.createFromInputFallback(s)))):s._d=new Date(+a[1])):o(n)?(t._a=h(n.slice(0),function(e){return parseInt(e,10)}),ht(t)):l(n)?function(e){if(!e._d){var t=A(e._i);e._a=h([t.year,t.month,t.day||t.date,t.hour,t.minute,t.second,t.millisecond],function(e){return e&&parseInt(e,10)}),ht(e)}}(t):d(n)?t._d=new Date(n):_.createFromInputFallback(t),g(e)||(e._d=null),e))}function St(e,t,n,s,a){var r,i={};return!0!==n&&!1!==n||(s=n,n=void 0),(l(e)&&function(e){if(Object.getOwnPropertyNames)return 0===Object.getOwnPropertyNames(e).length;var t;for(t in e)if(e.hasOwnProperty(t))return!1;return!0}(e)||o(e)&&0===e.length)&&(e=void 0),i._isAMomentObject=!0,i._useUTC=i._isUTC=a,i._l=n,i._i=e,i._f=t,i._strict=s,(r=new w(dt(bt(i))))._nextDay&&(r.add(1,"d"),r._nextDay=void 0),r}function Yt(e,t,n,s){return St(e,t,n,s,!1)}_.createFromInputFallback=n("value provided is not in a recognized RFC2822 or ISO format. moment construction falls back to js Date(), which is not reliable across all browsers and versions. Non RFC2822/ISO date formats are discouraged and will be removed in an upcoming major release. Please refer to http://momentjs.com/guides/#/warnings/js-date/ for more info.",function(e){e._d=new Date(e._i+(e._useUTC?" UTC":""))}),_.ISO_8601=function(){},_.RFC_2822=function(){};var Ct=n("moment().min is deprecated, use moment.max instead. http://momentjs.com/guides/#/warnings/min-max/",function(){var e=Yt.apply(null,arguments);return this.isValid()&&e.isValid()?e<this?this:e:p()}),Ot=n("moment().max is deprecated, use moment.min instead. http://momentjs.com/guides/#/warnings/min-max/",function(){var e=Yt.apply(null,arguments);return this.isValid()&&e.isValid()?this<e?this:e:p()});function Tt(e,t){var n,s;if(1===t.length&&o(t[0])&&(t=t[0]),!t.length)return Yt();for(n=t[0],s=1;s<t.length;++s)t[s].isValid()&&!t[s][e](n)||(n=t[s]);return n}var xt=["year","quarter","month","week","day","hour","minute","second","millisecond"];function Wt(e){var t=A(e),n=t.year||0,s=t.quarter||0,a=t.month||0,r=t.week||t.isoWeek||0,i=t.day||0,o=t.hour||0,l=t.minute||0,u=t.second||0,d=t.millisecond||0;this._isValid=function(e){for(var t in e)if(-1===be.call(xt,t)||null!=e[t]&&isNaN(e[t]))return!1;for(var n=!1,s=0;s<xt.length;++s)if(e[xt[s]]){if(n)return!1;parseFloat(e[xt[s]])!==b(e[xt[s]])&&(n=!0)}return!0}(t),this._milliseconds=+d+1e3*u+6e4*l+1e3*o*60*60,this._days=+i+7*r,this._months=+a+3*s+12*n,this._data={},this._locale=ut(),this._bubble()}function Pt(e){return e instanceof Wt}function Lt(e){return e<0?-1*Math.round(-1*e):Math.round(e)}function At(e,n){V(e,0,0,function(){var e=this.utcOffset(),t="+";return e<0&&(e=-e,t="-"),t+R(~~(e/60),2)+n+R(~~e%60,2)})}At("Z",":"),At("ZZ",""),le("Z",re),le("ZZ",re),ce(["Z","ZZ"],function(e,t,n){n._useUTC=!0,n._tzm=Ft(re,e)});var Ht=/([\+\-]|\d\d)/gi;function Ft(e,t){var n=(t||"").match(e);if(null===n)return null;var s=((n[n.length-1]||[])+"").match(Ht)||["-",0,0],a=60*s[1]+b(s[2]);return 0===a?0:"+"===s[0]?a:-a}function Rt(e,t){var n,s;return t._isUTC?(n=t.clone(),s=(M(e)||c(e)?e.valueOf():Yt(e).valueOf())-n.valueOf(),n._d.setTime(n._d.valueOf()+s),_.updateOffset(n,!1),n):Yt(e).local()}function jt(e){return 15*-Math.round(e._d.getTimezoneOffset()/15)}function Nt(){return!!this.isValid()&&this._isUTC&&0===this._offset}_.updateOffset=function(){};var Ut=/^(\-|\+)?(?:(\d*)[. ])?(\d+)\:(\d+)(?:\:(\d+)(\.\d*)?)?$/,Gt=/^(-|\+)?P(?:([-+]?[0-9,.]*)Y)?(?:([-+]?[0-9,.]*)M)?(?:([-+]?[0-9,.]*)W)?(?:([-+]?[0-9,.]*)D)?(?:T(?:([-+]?[0-9,.]*)H)?(?:([-+]?[0-9,.]*)M)?(?:([-+]?[0-9,.]*)S)?)?$/;function Vt(e,t){var n,s,a,r,i,o,l=e,u=null;return Pt(e)?l={ms:e._milliseconds,d:e._days,M:e._months}:d(e)?(l={},t?l[t]=e:l.milliseconds=e):(u=Ut.exec(e))?(n="-"===u[1]?-1:1,l={y:0,d:b(u[ge])*n,h:b(u[pe])*n,m:b(u[ye])*n,s:b(u[_e])*n,ms:b(Lt(1e3*u[ve]))*n}):(u=Gt.exec(e))?(n="-"===u[1]?-1:1,l={y:Et(u[2],n),M:Et(u[3],n),w:Et(u[4],n),d:Et(u[5],n),h:Et(u[6],n),m:Et(u[7],n),s:Et(u[8],n)}):null==l?l={}:"object"==typeof l&&("from"in l||"to"in l)&&(r=Yt(l.from),i=Yt(l.to),a=r.isValid()&&i.isValid()?(i=Rt(i,r),r.isBefore(i)?o=It(r,i):((o=It(i,r)).milliseconds=-o.milliseconds,o.months=-o.months),o):{milliseconds:0,months:0},(l={}).ms=a.milliseconds,l.M=a.months),s=new Wt(l),Pt(e)&&v(e,"_locale")&&(s._locale=e._locale),s}function Et(e,t){var n=e&&parseFloat(e.replace(",","."));return(isNaN(n)?0:n)*t}function It(e,t){var n={};return n.months=t.month()-e.month()+12*(t.year()-e.year()),e.clone().add(n.months,"M").isAfter(t)&&--n.months,n.milliseconds=+t-+e.clone().add(n.months,"M"),n}function zt(s,a){return function(e,t){var n;return null===t||isNaN(+t)||(C(a,"moment()."+a+"(period, number) is deprecated. Please use moment()."+a+"(number, period). See http://momentjs.com/guides/#/warnings/add-inverted-param/ for more info."),n=e,e=t,t=n),Jt(this,Vt(e="string"==typeof e?+e:e,t),s),this}}function Jt(e,t,n,s){var a=t._milliseconds,r=Lt(t._days),i=Lt(t._months);e.isValid()&&(s=null==s||s,i&&Le(e,Ce(e,"Month")+i*n),r&&Oe(e,"Date",Ce(e,"Date")+r*n),a&&e._d.setTime(e._d.valueOf()+a*n),s&&_.updateOffset(e,r||i))}Vt.fn=Wt.prototype,Vt.invalid=function(){return Vt(NaN)};var Zt=zt(1,"add"),qt=zt(-1,"subtract");function $t(e,t){var n=12*(t.year()-e.year())+(t.month()-e.month()),s=e.clone().add(n,"months");return-(n+(t-s<0?(t-s)/(s-e.clone().add(n-1,"months")):(t-s)/(e.clone().add(1+n,"months")-s)))||0}function Bt(e){var t;return void 0===e?this._locale._abbr:(null!=(t=ut(e))&&(this._locale=t),this)}_.defaultFormat="YYYY-MM-DDTHH:mm:ssZ",_.defaultFormatUtc="YYYY-MM-DDTHH:mm:ss[Z]";var Qt=n("moment().lang() is deprecated. Instead, use moment().localeData() to get the language configuration. Use moment().locale() to change languages.",function(e){return void 0===e?this.localeData():this.locale(e)});function Kt(){return this._locale}var Xt=126227808e5;function en(e,t){return(e%t+t)%t}function tn(e,t,n){return e<100&&0<=e?new Date(e+400,t,n)-Xt:new Date(e,t,n).valueOf()}function nn(e,t,n){return e<100&&0<=e?Date.UTC(e+400,t,n)-Xt:Date.UTC(e,t,n)}function sn(e,t){V(0,[e,e.length],0,t)}function an(e,t,n,s,a){var r;return null==e?Ge(this,s,a).year:((r=Ve(e,s,a))<t&&(t=r),function(e,t,n,s,a){var r=Ue(e,t,n,s,a),i=je(r.year,0,r.dayOfYear);return this.year(i.getUTCFullYear()),this.month(i.getUTCMonth()),this.date(i.getUTCDate()),this}.call(this,e,t,n,s,a))}V(0,["gg",2],0,function(){return this.weekYear()%100}),V(0,["GG",2],0,function(){return this.isoWeekYear()%100}),sn("gggg","weekYear"),sn("ggggg","weekYear"),sn("GGGG","isoWeekYear"),sn("GGGGG","isoWeekYear"),P("weekYear","gg"),P("isoWeekYear","GG"),F("weekYear",1),F("isoWeekYear",1),le("G",se),le("g",se),le("GG",B,J),le("gg",B,J),le("GGGG",ee,q),le("gggg",ee,q),le("GGGGG",te,$),le("ggggg",te,$),he(["gggg","ggggg","GGGG","GGGGG"],function(e,t,n,s){t[s.substr(0,2)]=b(e)}),he(["gg","GG"],function(e,t,n,s){t[s]=_.parseTwoDigitYear(e)}),V("Q",0,"Qo","quarter"),P("quarter","Q"),F("quarter",7),le("Q",z),ce("Q",function(e,t){t[me]=3*(b(e)-1)}),V("D",["DD",2],"Do","date"),P("date","D"),F("date",9),le("D",B),le("DD",B,J),le("Do",function(e,t){return e?t._dayOfMonthOrdinalParse||t._ordinalParse:t._dayOfMonthOrdinalParseLenient}),ce(["D","DD"],ge),ce("Do",function(e,t){t[ge]=b(e.match(B)[0])});var rn=Ye("Date",!0);V("DDD",["DDDD",3],"DDDo","dayOfYear"),P("dayOfYear","DDD"),F("dayOfYear",4),le("DDD",X),le("DDDD",Z),ce(["DDD","DDDD"],function(e,t,n){n._dayOfYear=b(e)}),V("m",["mm",2],0,"minute"),P("minute","m"),F("minute",14),le("m",B),le("mm",B,J),ce(["m","mm"],ye);var on=Ye("Minutes",!1);V("s",["ss",2],0,"second"),P("second","s"),F("second",15),le("s",B),le("ss",B,J),ce(["s","ss"],_e);var ln,un=Ye("Seconds",!1);for(V("S",0,0,function(){return~~(this.millisecond()/100)}),V(0,["SS",2],0,function(){return~~(this.millisecond()/10)}),V(0,["SSS",3],0,"millisecond"),V(0,["SSSS",4],0,function(){return 10*this.millisecond()}),V(0,["SSSSS",5],0,function(){return 100*this.millisecond()}),V(0,["SSSSSS",6],0,function(){return 1e3*this.millisecond()}),V(0,["SSSSSSS",7],0,function(){return 1e4*this.millisecond()}),V(0,["SSSSSSSS",8],0,function(){return 1e5*this.millisecond()}),V(0,["SSSSSSSSS",9],0,function(){return 1e6*this.millisecond()}),P("millisecond","ms"),F("millisecond",16),le("S",X,z),le("SS",X,J),le("SSS",X,Z),ln="SSSS";ln.length<=9;ln+="S")le(ln,ne);function dn(e,t){t[ve]=b(1e3*("0."+e))}for(ln="S";ln.length<=9;ln+="S")ce(ln,dn);var cn=Ye("Milliseconds",!1);V("z",0,0,"zoneAbbr"),V("zz",0,0,"zoneName");var hn=w.prototype;function fn(e){return e}hn.add=Zt,hn.calendar=function(e,t){var n=e||Yt(),s=Rt(n,this).startOf("day"),a=_.calendarFormat(this,s)||"sameElse",r=t&&(O(t[a])?t[a].call(this,n):t[a]);return this.format(r||this.localeData().calendar(a,this,Yt(n)))},hn.clone=function(){return new w(this)},hn.diff=function(e,t,n){var s,a,r;if(!this.isValid())return NaN;if(!(s=Rt(e,this)).isValid())return NaN;switch(a=6e4*(s.utcOffset()-this.utcOffset()),t=L(t)){case"year":r=$t(this,s)/12;break;case"month":r=$t(this,s);break;case"quarter":r=$t(this,s)/3;break;case"second":r=(this-s)/1e3;break;case"minute":r=(this-s)/6e4;break;case"hour":r=(this-s)/36e5;break;case"day":r=(this-s-a)/864e5;break;case"week":r=(this-s-a)/6048e5;break;default:r=this-s}return n?r:D(r)},hn.endOf=function(e){var t;if(void 0===(e=L(e))||"millisecond"===e||!this.isValid())return this;var n=this._isUTC?nn:tn;switch(e){case"year":t=n(this.year()+1,0,1)-1;break;case"quarter":t=n(this.year(),this.month()-this.month()%3+3,1)-1;break;case"month":t=n(this.year(),this.month()+1,1)-1;break;case"week":t=n(this.year(),this.month(),this.date()-this.weekday()+7)-1;break;case"isoWeek":t=n(this.year(),this.month(),this.date()-(this.isoWeekday()-1)+7)-1;break;case"day":case"date":t=n(this.year(),this.month(),this.date()+1)-1;break;case"hour":t=this._d.valueOf(),t+=36e5-en(t+(this._isUTC?0:6e4*this.utcOffset()),36e5)-1;break;case"minute":t=this._d.valueOf(),t+=6e4-en(t,6e4)-1;break;case"second":t=this._d.valueOf(),t+=1e3-en(t,1e3)-1}return this._d.setTime(t),_.updateOffset(this,!0),this},hn.format=function(e){e=e||(this.isUtc()?_.defaultFormatUtc:_.defaultFormat);var t=E(this,e);return this.localeData().postformat(t)},hn.from=function(e,t){return this.isValid()&&(M(e)&&e.isValid()||Yt(e).isValid())?Vt({to:this,from:e}).locale(this.locale()).humanize(!t):this.localeData().invalidDate()},hn.fromNow=function(e){return this.from(Yt(),e)},hn.to=function(e,t){return this.isValid()&&(M(e)&&e.isValid()||Yt(e).isValid())?Vt({from:this,to:e}).locale(this.locale()).humanize(!t):this.localeData().invalidDate()},hn.toNow=function(e){return this.to(Yt(),e)},hn.get=function(e){return O(this[e=L(e)])?this[e]():this},hn.invalidAt=function(){return k(this).overflow},hn.isAfter=function(e,t){var n=M(e)?e:Yt(e);return!(!this.isValid()||!n.isValid())&&("millisecond"===(t=L(t)||"millisecond")?this.valueOf()>n.valueOf():n.valueOf()<this.clone().startOf(t).valueOf())},hn.isBefore=function(e,t){var n=M(e)?e:Yt(e);return!(!this.isValid()||!n.isValid())&&("millisecond"===(t=L(t)||"millisecond")?this.valueOf()<n.valueOf():this.clone().endOf(t).valueOf()<n.valueOf())},hn.isBetween=function(e,t,n,s){var a=M(e)?e:Yt(e),r=M(t)?t:Yt(t);return!!(this.isValid()&&a.isValid()&&r.isValid())&&("("===(s=s||"()")[0]?this.isAfter(a,n):!this.isBefore(a,n))&&(")"===s[1]?this.isBefore(r,n):!this.isAfter(r,n))},hn.isSame=function(e,t){var n,s=M(e)?e:Yt(e);return!(!this.isValid()||!s.isValid())&&("millisecond"===(t=L(t)||"millisecond")?this.valueOf()===s.valueOf():(n=s.valueOf(),this.clone().startOf(t).valueOf()<=n&&n<=this.clone().endOf(t).valueOf()))},hn.isSameOrAfter=function(e,t){return this.isSame(e,t)||this.isAfter(e,t)},hn.isSameOrBefore=function(e,t){return this.isSame(e,t)||this.isBefore(e,t)},hn.isValid=function(){return g(this)},hn.lang=Qt,hn.locale=Bt,hn.localeData=Kt,hn.max=Ot,hn.min=Ct,hn.parsingFlags=function(){return f({},k(this))},hn.set=function(e,t){if("object"==typeof e)for(var n=function(e){var t=[];for(var n in e)t.push({unit:n,priority:H[n]});return t.sort(function(e,t){return e.priority-t.priority}),t}(e=A(e)),s=0;s<n.length;s++)this[n[s].unit](e[n[s].unit]);else if(O(this[e=L(e)]))return this[e](t);return this},hn.startOf=function(e){var t;if(void 0===(e=L(e))||"millisecond"===e||!this.isValid())return this;var n=this._isUTC?nn:tn;switch(e){case"year":t=n(this.year(),0,1);break;case"quarter":t=n(this.year(),this.month()-this.month()%3,1);break;case"month":t=n(this.year(),this.month(),1);break;case"week":t=n(this.year(),this.month(),this.date()-this.weekday());break;case"isoWeek":t=n(this.year(),this.month(),this.date()-(this.isoWeekday()-1));break;case"day":case"date":t=n(this.year(),this.month(),this.date());break;case"hour":t=this._d.valueOf(),t-=en(t+(this._isUTC?0:6e4*this.utcOffset()),36e5);break;case"minute":t=this._d.valueOf(),t-=en(t,6e4);break;case"second":t=this._d.valueOf(),t-=en(t,1e3)}return this._d.setTime(t),_.updateOffset(this,!0),this},hn.subtract=qt,hn.toArray=function(){var e=this;return[e.year(),e.month(),e.date(),e.hour(),e.minute(),e.second(),e.millisecond()]},hn.toObject=function(){var e=this;return{years:e.year(),months:e.month(),date:e.date(),hours:e.hours(),minutes:e.minutes(),seconds:e.seconds(),milliseconds:e.milliseconds()}},hn.toDate=function(){return new Date(this.valueOf())},hn.toISOString=function(e){if(!this.isValid())return null;var t=!0!==e,n=t?this.clone().utc():this;return n.year()<0||9999<n.year()?E(n,t?"YYYYYY-MM-DD[T]HH:mm:ss.SSS[Z]":"YYYYYY-MM-DD[T]HH:mm:ss.SSSZ"):O(Date.prototype.toISOString)?t?this.toDate().toISOString():new Date(this.valueOf()+60*this.utcOffset()*1e3).toISOString().replace("Z",E(n,"Z")):E(n,t?"YYYY-MM-DD[T]HH:mm:ss.SSS[Z]":"YYYY-MM-DD[T]HH:mm:ss.SSSZ")},hn.inspect=function(){if(!this.isValid())return"moment.invalid(/* "+this._i+" */)";var e="moment",t="";this.isLocal()||(e=0===this.utcOffset()?"moment.utc":"moment.parseZone",t="Z");var n="["+e+'("]',s=0<=this.year()&&this.year()<=9999?"YYYY":"YYYYYY",a=t+'[")]';return this.format(n+s+"-MM-DD[T]HH:mm:ss.SSS"+a)},hn.toJSON=function(){return this.isValid()?this.toISOString():null},hn.toString=function(){return this.clone().locale("en").format("ddd MMM DD YYYY HH:mm:ss [GMT]ZZ")},hn.unix=function(){return Math.floor(this.valueOf()/1e3)},hn.valueOf=function(){return this._d.valueOf()-6e4*(this._offset||0)},hn.creationData=function(){return{input:this._i,format:this._f,locale:this._locale,isUTC:this._isUTC,strict:this._strict}},hn.year=Se,hn.isLeapYear=function(){return De(this.year())},hn.weekYear=function(e){return an.call(this,e,this.week(),this.weekday(),this.localeData()._week.dow,this.localeData()._week.doy)},hn.isoWeekYear=function(e){return an.call(this,e,this.isoWeek(),this.isoWeekday(),1,4)},hn.quarter=hn.quarters=function(e){return null==e?Math.ceil((this.month()+1)/3):this.month(3*(e-1)+this.month()%3)},hn.month=Ae,hn.daysInMonth=function(){return Te(this.year(),this.month())},hn.week=hn.weeks=function(e){var t=this.localeData().week(this);return null==e?t:this.add(7*(e-t),"d")},hn.isoWeek=hn.isoWeeks=function(e){var t=Ge(this,1,4).week;return null==e?t:this.add(7*(e-t),"d")},hn.weeksInYear=function(){var e=this.localeData()._week;return Ve(this.year(),e.dow,e.doy)},hn.isoWeeksInYear=function(){return Ve(this.year(),1,4)},hn.date=rn,hn.day=hn.days=function(e){if(!this.isValid())return null!=e?this:NaN;var t,n,s=this._isUTC?this._d.getUTCDay():this._d.getDay();return null!=e?(t=e,n=this.localeData(),e="string"!=typeof t?t:isNaN(t)?"number"==typeof(t=n.weekdaysParse(t))?t:null:parseInt(t,10),this.add(e-s,"d")):s},hn.weekday=function(e){if(!this.isValid())return null!=e?this:NaN;var t=(this.day()+7-this.localeData()._week.dow)%7;return null==e?t:this.add(e-t,"d")},hn.isoWeekday=function(e){if(!this.isValid())return null!=e?this:NaN;if(null==e)return this.day()||7;var t,n,s=(t=e,n=this.localeData(),"string"==typeof t?n.weekdaysParse(t)%7||7:isNaN(t)?null:t);return this.day(this.day()%7?s:s-7)},hn.dayOfYear=function(e){var t=Math.round((this.clone().startOf("day")-this.clone().startOf("year"))/864e5)+1;return null==e?t:this.add(e-t,"d")},hn.hour=hn.hours=tt,hn.minute=hn.minutes=on,hn.second=hn.seconds=un,hn.millisecond=hn.milliseconds=cn,hn.utcOffset=function(e,t,n){var s,a=this._offset||0;if(!this.isValid())return null!=e?this:NaN;if(null==e)return this._isUTC?a:jt(this);if("string"==typeof e){if(null===(e=Ft(re,e)))return this}else Math.abs(e)<16&&!n&&(e*=60);return!this._isUTC&&t&&(s=jt(this)),this._offset=e,this._isUTC=!0,null!=s&&this.add(s,"m"),a!==e&&(!t||this._changeInProgress?Jt(this,Vt(e-a,"m"),1,!1):this._changeInProgress||(this._changeInProgress=!0,_.updateOffset(this,!0),this._changeInProgress=null)),this},hn.utc=function(e){return this.utcOffset(0,e)},hn.local=function(e){return this._isUTC&&(this.utcOffset(0,e),this._isUTC=!1,e&&this.subtract(jt(this),"m")),this},hn.parseZone=function(){if(null!=this._tzm)this.utcOffset(this._tzm,!1,!0);else if("string"==typeof this._i){var e=Ft(ae,this._i);null!=e?this.utcOffset(e):this.utcOffset(0,!0)}return this},hn.hasAlignedHourOffset=function(e){return!!this.isValid()&&(e=e?Yt(e).utcOffset():0,(this.utcOffset()-e)%60==0)},hn.isDST=function(){return this.utcOffset()>this.clone().month(0).utcOffset()||this.utcOffset()>this.clone().month(5).utcOffset()},hn.isLocal=function(){return!!this.isValid()&&!this._isUTC},hn.isUtcOffset=function(){return!!this.isValid()&&this._isUTC},hn.isUtc=Nt,hn.isUTC=Nt,hn.zoneAbbr=function(){return this._isUTC?"UTC":""},hn.zoneName=function(){return this._isUTC?"Coordinated Universal Time":""},hn.dates=n("dates accessor is deprecated. Use date instead.",rn),hn.months=n("months accessor is deprecated. Use month instead",Ae),hn.years=n("years accessor is deprecated. Use year instead",Se),hn.zone=n("moment().zone is deprecated, use moment().utcOffset instead. http://momentjs.com/guides/#/warnings/zone/",function(e,t){return null!=e?("string"!=typeof e&&(e=-e),this.utcOffset(e,t),this):-this.utcOffset()}),hn.isDSTShifted=n("isDSTShifted is deprecated. See http://momentjs.com/guides/#/warnings/dst-shifted/ for more information",function(){if(!u(this._isDSTShifted))return this._isDSTShifted;var e={};if(y(e,this),(e=bt(e))._a){var t=e._isUTC?m(e._a):Yt(e._a);this._isDSTShifted=this.isValid()&&0<i(e._a,t.toArray())}else this._isDSTShifted=!1;return this._isDSTShifted});var mn=x.prototype;function gn(e,t,n,s){var a=ut(),r=m().set(s,t);return a[n](r,e)}function pn(e,t,n){if(d(e)&&(t=e,e=void 0),e=e||"",null!=t)return gn(e,t,n,"month");var s,a=[];for(s=0;s<12;s++)a[s]=gn(e,s,n,"month");return a}function yn(e,t,n,s){"boolean"==typeof e?d(t)&&(n=t,t=void 0):(t=e,e=!1,d(n=t)&&(n=t,t=void 0)),t=t||"";var a,r=ut(),i=e?r._week.dow:0;if(null!=n)return gn(t,(n+i)%7,s,"day");var o=[];for(a=0;a<7;a++)o[a]=gn(t,(a+i)%7,s,"day");return o}mn.calendar=function(e,t,n){var s=this._calendar[e]||this._calendar.sameElse;return O(s)?s.call(t,n):s},mn.longDateFormat=function(e){var t=this._longDateFormat[e],n=this._longDateFormat[e.toUpperCase()];return t||!n?t:(this._longDateFormat[e]=n.replace(/MMMM|MM|DD|dddd/g,function(e){return e.slice(1)}),this._longDateFormat[e])},mn.invalidDate=function(){return this._invalidDate},mn.ordinal=function(e){return this._ordinal.replace("%d",e)},mn.preparse=fn,mn.postformat=fn,mn.relativeTime=function(e,t,n,s){var a=this._relativeTime[n];return O(a)?a(e,t,n,s):a.replace(/%d/i,e)},mn.pastFuture=function(e,t){var n=this._relativeTime[0<e?"future":"past"];return O(n)?n(t):n.replace(/%s/i,t)},mn.set=function(e){var t,n;for(n in e)O(t=e[n])?this[n]=t:this["_"+n]=t;this._config=e,this._dayOfMonthOrdinalParseLenient=new RegExp((this._dayOfMonthOrdinalParse.source||this._ordinalParse.source)+"|"+/\d{1,2}/.source)},mn.months=function(e,t){return e?o(this._months)?this._months[e.month()]:this._months[(this._months.isFormat||xe).test(t)?"format":"standalone"][e.month()]:o(this._months)?this._months:this._months.standalone},mn.monthsShort=function(e,t){return e?o(this._monthsShort)?this._monthsShort[e.month()]:this._monthsShort[xe.test(t)?"format":"standalone"][e.month()]:o(this._monthsShort)?this._monthsShort:this._monthsShort.standalone},mn.monthsParse=function(e,t,n){var s,a,r;if(this._monthsParseExact)return function(e,t,n){var s,a,r,i=e.toLocaleLowerCase();if(!this._monthsParse)for(this._monthsParse=[],this._longMonthsParse=[],this._shortMonthsParse=[],s=0;s<12;++s)r=m([2e3,s]),this._shortMonthsParse[s]=this.monthsShort(r,"").toLocaleLowerCase(),this._longMonthsParse[s]=this.months(r,"").toLocaleLowerCase();return n?"MMM"===t?-1!==(a=be.call(this._shortMonthsParse,i))?a:null:-1!==(a=be.call(this._longMonthsParse,i))?a:null:"MMM"===t?-1!==(a=be.call(this._shortMonthsParse,i))?a:-1!==(a=be.call(this._longMonthsParse,i))?a:null:-1!==(a=be.call(this._longMonthsParse,i))?a:-1!==(a=be.call(this._shortMonthsParse,i))?a:null}.call(this,e,t,n);for(this._monthsParse||(this._monthsParse=[],this._longMonthsParse=[],this._shortMonthsParse=[]),s=0;s<12;s++){if(a=m([2e3,s]),n&&!this._longMonthsParse[s]&&(this._longMonthsParse[s]=new RegExp("^"+this.months(a,"").replace(".","")+"$","i"),this._shortMonthsParse[s]=new RegExp("^"+this.monthsShort(a,"").replace(".","")+"$","i")),n||this._monthsParse[s]||(r="^"+this.months(a,"")+"|^"+this.monthsShort(a,""),this._monthsParse[s]=new RegExp(r.replace(".",""),"i")),n&&"MMMM"===t&&this._longMonthsParse[s].test(e))return s;if(n&&"MMM"===t&&this._shortMonthsParse[s].test(e))return s;if(!n&&this._monthsParse[s].test(e))return s}},mn.monthsRegex=function(e){return this._monthsParseExact?(v(this,"_monthsRegex")||Re.call(this),e?this._monthsStrictRegex:this._monthsRegex):(v(this,"_monthsRegex")||(this._monthsRegex=Fe),this._monthsStrictRegex&&e?this._monthsStrictRegex:this._monthsRegex)},mn.monthsShortRegex=function(e){return this._monthsParseExact?(v(this,"_monthsRegex")||Re.call(this),e?this._monthsShortStrictRegex:this._monthsShortRegex):(v(this,"_monthsShortRegex")||(this._monthsShortRegex=He),this._monthsShortStrictRegex&&e?this._monthsShortStrictRegex:this._monthsShortRegex)},mn.week=function(e){return Ge(e,this._week.dow,this._week.doy).week},mn.firstDayOfYear=function(){return this._week.doy},mn.firstDayOfWeek=function(){return this._week.dow},mn.weekdays=function(e,t){var n=o(this._weekdays)?this._weekdays:this._weekdays[e&&!0!==e&&this._weekdays.isFormat.test(t)?"format":"standalone"];return!0===e?Ee(n,this._week.dow):e?n[e.day()]:n},mn.weekdaysMin=function(e){return!0===e?Ee(this._weekdaysMin,this._week.dow):e?this._weekdaysMin[e.day()]:this._weekdaysMin},mn.weekdaysShort=function(e){return!0===e?Ee(this._weekdaysShort,this._week.dow):e?this._weekdaysShort[e.day()]:this._weekdaysShort},mn.weekdaysParse=function(e,t,n){var s,a,r;if(this._weekdaysParseExact)return function(e,t,n){var s,a,r,i=e.toLocaleLowerCase();if(!this._weekdaysParse)for(this._weekdaysParse=[],this._shortWeekdaysParse=[],this._minWeekdaysParse=[],s=0;s<7;++s)r=m([2e3,1]).day(s),this._minWeekdaysParse[s]=this.weekdaysMin(r,"").toLocaleLowerCase(),this._shortWeekdaysParse[s]=this.weekdaysShort(r,"").toLocaleLowerCase(),this._weekdaysParse[s]=this.weekdays(r,"").toLocaleLowerCase();return n?"dddd"===t?-1!==(a=be.call(this._weekdaysParse,i))?a:null:"ddd"===t?-1!==(a=be.call(this._shortWeekdaysParse,i))?a:null:-1!==(a=be.call(this._minWeekdaysParse,i))?a:null:"dddd"===t?-1!==(a=be.call(this._weekdaysParse,i))?a:-1!==(a=be.call(this._shortWeekdaysParse,i))?a:-1!==(a=be.call(this._minWeekdaysParse,i))?a:null:"ddd"===t?-1!==(a=be.call(this._shortWeekdaysParse,i))?a:-1!==(a=be.call(this._weekdaysParse,i))?a:-1!==(a=be.call(this._minWeekdaysParse,i))?a:null:-1!==(a=be.call(this._minWeekdaysParse,i))?a:-1!==(a=be.call(this._weekdaysParse,i))?a:-1!==(a=be.call(this._shortWeekdaysParse,i))?a:null}.call(this,e,t,n);for(this._weekdaysParse||(this._weekdaysParse=[],this._minWeekdaysParse=[],this._shortWeekdaysParse=[],this._fullWeekdaysParse=[]),s=0;s<7;s++){if(a=m([2e3,1]).day(s),n&&!this._fullWeekdaysParse[s]&&(this._fullWeekdaysParse[s]=new RegExp("^"+this.weekdays(a,"").replace(".","\\.?")+"$","i"),this._shortWeekdaysParse[s]=new RegExp("^"+this.weekdaysShort(a,"").replace(".","\\.?")+"$","i"),this._minWeekdaysParse[s]=new RegExp("^"+this.weekdaysMin(a,"").replace(".","\\.?")+"$","i")),this._weekdaysParse[s]||(r="^"+this.weekdays(a,"")+"|^"+this.weekdaysShort(a,"")+"|^"+this.weekdaysMin(a,""),this._weekdaysParse[s]=new RegExp(r.replace(".",""),"i")),n&&"dddd"===t&&this._fullWeekdaysParse[s].test(e))return s;if(n&&"ddd"===t&&this._shortWeekdaysParse[s].test(e))return s;if(n&&"dd"===t&&this._minWeekdaysParse[s].test(e))return s;if(!n&&this._weekdaysParse[s].test(e))return s}},mn.weekdaysRegex=function(e){return this._weekdaysParseExact?(v(this,"_weekdaysRegex")||Be.call(this),e?this._weekdaysStrictRegex:this._weekdaysRegex):(v(this,"_weekdaysRegex")||(this._weekdaysRegex=Ze),this._weekdaysStrictRegex&&e?this._weekdaysStrictRegex:this._weekdaysRegex)},mn.weekdaysShortRegex=function(e){return this._weekdaysParseExact?(v(this,"_weekdaysRegex")||Be.call(this),e?this._weekdaysShortStrictRegex:this._weekdaysShortRegex):(v(this,"_weekdaysShortRegex")||(this._weekdaysShortRegex=qe),this._weekdaysShortStrictRegex&&e?this._weekdaysShortStrictRegex:this._weekdaysShortRegex)},mn.weekdaysMinRegex=function(e){return this._weekdaysParseExact?(v(this,"_weekdaysRegex")||Be.call(this),e?this._weekdaysMinStrictRegex:this._weekdaysMinRegex):(v(this,"_weekdaysMinRegex")||(this._weekdaysMinRegex=$e),this._weekdaysMinStrictRegex&&e?this._weekdaysMinStrictRegex:this._weekdaysMinRegex)},mn.isPM=function(e){return"p"===(e+"").toLowerCase().charAt(0)},mn.meridiem=function(e,t,n){return 11<e?n?"pm":"PM":n?"am":"AM"},ot("en",{dayOfMonthOrdinalParse:/\d{1,2}(th|st|nd|rd)/,ordinal:function(e){var t=e%10;return e+(1===b(e%100/10)?"th":1==t?"st":2==t?"nd":3==t?"rd":"th")}}),_.lang=n("moment.lang is deprecated. Use moment.locale instead.",ot),_.langData=n("moment.langData is deprecated. Use moment.localeData instead.",ut);var _n=Math.abs;function vn(e,t,n,s){var a=Vt(t,n);return e._milliseconds+=s*a._milliseconds,e._days+=s*a._days,e._months+=s*a._months,e._bubble()}function kn(e){return e<0?Math.floor(e):Math.ceil(e)}function wn(e){return 4800*e/146097}function Mn(e){return 146097*e/4800}function Dn(e){return function(){return this.as(e)}}var bn=Dn("ms"),Sn=Dn("s"),Yn=Dn("m"),Cn=Dn("h"),On=Dn("d"),Tn=Dn("w"),xn=Dn("M"),Wn=Dn("Q"),Pn=Dn("y");function Ln(e){return function(){return this.isValid()?this._data[e]:NaN}}var An=Ln("milliseconds"),Hn=Ln("seconds"),Fn=Ln("minutes"),Rn=Ln("hours"),jn=Ln("days"),Nn=Ln("months"),Un=Ln("years"),Gn=Math.round,Vn={ss:44,s:45,m:45,h:22,d:26,M:11},En=Math.abs;function In(e){return(0<e)-(e<0)||+e}function zn(){if(!this.isValid())return this.localeData().invalidDate();var e,t,n=En(this._milliseconds)/1e3,s=En(this._days),a=En(this._months);t=D((e=D(n/60))/60),n%=60,e%=60;var r=D(a/12),i=a%=12,o=s,l=t,u=e,d=n?n.toFixed(3).replace(/\.?0+$/,""):"",c=this.asSeconds();if(!c)return"P0D";var h=c<0?"-":"",f=In(this._months)!==In(c)?"-":"",m=In(this._days)!==In(c)?"-":"",g=In(this._milliseconds)!==In(c)?"-":"";return h+"P"+(r?f+r+"Y":"")+(i?f+i+"M":"")+(o?m+o+"D":"")+(l||u||d?"T":"")+(l?g+l+"H":"")+(u?g+u+"M":"")+(d?g+d+"S":"")}var Jn=Wt.prototype;return Jn.isValid=function(){return this._isValid},Jn.abs=function(){var e=this._data;return this._milliseconds=_n(this._milliseconds),this._days=_n(this._days),this._months=_n(this._months),e.milliseconds=_n(e.milliseconds),e.seconds=_n(e.seconds),e.minutes=_n(e.minutes),e.hours=_n(e.hours),e.months=_n(e.months),e.years=_n(e.years),this},Jn.add=function(e,t){return vn(this,e,t,1)},Jn.subtract=function(e,t){return vn(this,e,t,-1)},Jn.as=function(e){if(!this.isValid())return NaN;var t,n,s=this._milliseconds;if("month"===(e=L(e))||"quarter"===e||"year"===e)switch(t=this._days+s/864e5,n=this._months+wn(t),e){case"month":return n;case"quarter":return n/3;case"year":return n/12}else switch(t=this._days+Math.round(Mn(this._months)),e){case"week":return t/7+s/6048e5;case"day":return t+s/864e5;case"hour":return 24*t+s/36e5;case"minute":return 1440*t+s/6e4;case"second":return 86400*t+s/1e3;case"millisecond":return Math.floor(864e5*t)+s;default:throw new Error("Unknown unit "+e)}},Jn.asMilliseconds=bn,Jn.asSeconds=Sn,Jn.asMinutes=Yn,Jn.asHours=Cn,Jn.asDays=On,Jn.asWeeks=Tn,Jn.asMonths=xn,Jn.asQuarters=Wn,Jn.asYears=Pn,Jn.valueOf=function(){return this.isValid()?this._milliseconds+864e5*this._days+this._months%12*2592e6+31536e6*b(this._months/12):NaN},Jn._bubble=function(){var e,t,n,s,a,r=this._milliseconds,i=this._days,o=this._months,l=this._data;return 0<=r&&0<=i&&0<=o||r<=0&&i<=0&&o<=0||(r+=864e5*kn(Mn(o)+i),o=i=0),l.milliseconds=r%1e3,e=D(r/1e3),l.seconds=e%60,t=D(e/60),l.minutes=t%60,n=D(t/60),l.hours=n%24,o+=a=D(wn(i+=D(n/24))),i-=kn(Mn(a)),s=D(o/12),o%=12,l.days=i,l.months=o,l.years=s,this},Jn.clone=function(){return Vt(this)},Jn.get=function(e){return e=L(e),this.isValid()?this[e+"s"]():NaN},Jn.milliseconds=An,Jn.seconds=Hn,Jn.minutes=Fn,Jn.hours=Rn,Jn.days=jn,Jn.weeks=function(){return D(this.days()/7)},Jn.months=Nn,Jn.years=Un,Jn.humanize=function(e){if(!this.isValid())return this.localeData().invalidDate();var t,n,s,a,r,i,o,l,u,d,c=this.localeData(),h=(t=!e,n=c,s=Vt(this).abs(),a=Gn(s.as("s")),r=Gn(s.as("m")),i=Gn(s.as("h")),o=Gn(s.as("d")),l=Gn(s.as("M")),u=Gn(s.as("y")),(d=a<=Vn.ss&&["s",a]||a<Vn.s&&["ss",a]||r<=1&&["m"]||r<Vn.m&&["mm",r]||i<=1&&["h"]||i<Vn.h&&["hh",i]||o<=1&&["d"]||o<Vn.d&&["dd",o]||l<=1&&["M"]||l<Vn.M&&["MM",l]||u<=1&&["y"]||["yy",u])[2]=t,d[3]=0<+this,d[4]=n,function(e,t,n,s,a){return a.relativeTime(t||1,!!n,e,s)}.apply(null,d));return e&&(h=c.pastFuture(+this,h)),c.postformat(h)},Jn.toISOString=zn,Jn.toString=zn,Jn.toJSON=zn,Jn.locale=Bt,Jn.localeData=Kt,Jn.toIsoString=n("toIsoString() is deprecated. Please use toISOString() instead (notice the capitals)",zn),Jn.lang=Qt,V("X",0,0,"unix"),V("x",0,0,"valueOf"),le("x",se),le("X",/[+-]?\d+(\.\d{1,3})?/),ce("X",function(e,t,n){n._d=new Date(1e3*parseFloat(e,10))}),ce("x",function(e,t,n){n._d=new Date(b(e))}),_.version="2.24.0",e=Yt,_.fn=hn,_.min=function(){return Tt("isBefore",[].slice.call(arguments,0))},_.max=function(){return Tt("isAfter",[].slice.call(arguments,0))},_.now=function(){return Date.now?Date.now():+new Date},_.utc=m,_.unix=function(e){return Yt(1e3*e)},_.months=function(e,t){return pn(e,t,"months")},_.isDate=c,_.locale=ot,_.invalid=p,_.duration=Vt,_.isMoment=M,_.weekdays=function(e,t,n){return yn(e,t,n,"weekdays")},_.parseZone=function(){return Yt.apply(null,arguments).parseZone()},_.localeData=ut,_.isDuration=Pt,_.monthsShort=function(e,t){return pn(e,t,"monthsShort")},_.weekdaysMin=function(e,t,n){return yn(e,t,n,"weekdaysMin")},_.defineLocale=lt,_.updateLocale=function(e,t){if(null!=t){var n,s,a=nt;null!=(s=it(e))&&(a=s._config),(n=new x(t=T(a,t))).parentLocale=st[e],st[e]=n,ot(e)}else null!=st[e]&&(null!=st[e].parentLocale?st[e]=st[e].parentLocale:null!=st[e]&&delete st[e]);return st[e]},_.locales=function(){return s(st)},_.weekdaysShort=function(e,t,n){return yn(e,t,n,"weekdaysShort")},_.normalizeUnits=L,_.relativeTimeRounding=function(e){return void 0===e?Gn:"function"==typeof e&&(Gn=e,!0)},_.relativeTimeThreshold=function(e,t){return void 0!==Vn[e]&&(void 0===t?Vn[e]:(Vn[e]=t,"s"===e&&(Vn.ss=t-1),!0))},_.calendarFormat=function(e,t){var n=e.diff(t,"days",!0);return n<-6?"sameElse":n<-1?"lastWeek":n<0?"lastDay":n<1?"sameDay":n<2?"nextDay":n<7?"nextWeek":"sameElse"},_.prototype=hn,_.HTML5_FMT={DATETIME_LOCAL:"YYYY-MM-DDTHH:mm",DATETIME_LOCAL_SECONDS:"YYYY-MM-DDTHH:mm:ss",DATETIME_LOCAL_MS:"YYYY-MM-DDTHH:mm:ss.SSS",DATE:"YYYY-MM-DD",TIME:"HH:mm",TIME_SECONDS:"HH:mm:ss",TIME_MS:"HH:mm:ss.SSS",WEEK:"GGGG-[W]WW",MONTH:"YYYY-MM"},_},"object"==typeof exports&&"undefined"!=typeof module?module.exports=l():"function"==typeof n&&n.amd?n("moment",l):o.moment=l(),n("manager/index",["../component/helper","moment"],function(a,r){function e(e){if(!e)throw new Error("first parameter `date` must be gave");if(e instanceof r==!1){if("string"!=typeof e&&"number"!=typeof e)throw new Error("`date` option is invalid type. (date: "+e+").");e=r(e)}this.year=parseInt(e.format("YYYY"),10),this.month=parseInt(e.format("MM"),10),this.prevMonth=parseInt(e.clone().add(-1,"months").format("MM"),10),this.nextMonth=parseInt(e.clone().add(1,"months").format("MM"),10),this.day=parseInt(e.format("DD"),10),this.firstDay=1,this.lastDay=parseInt(e.clone().endOf("month").format("DD"),10),this.weekDay=e.weekday(),this.date=e}var i={};return e.prototype.toString=function(){return this.date.format("YYYY-MM-DD")},e.Convert=function(e,t,n){var s=a.format("{0}-{1}-{2}",e,t,n);return i[s]||(i[s]=r(s,"YYYY-MM-DD")),i[s]},e}),n("component/classNames",["../component/helper"],function(e){return{top:e.getSubClass("top"),header:e.getSubClass("header"),body:e.getSubClass("body"),button:e.getSubClass("button")}}),n("configures/i18n",[],function(){return{defaultLanguage:"en",supports:["ar","en","ko","fr","ch","de","nl","jp","pt","da","pl","es","cs","uk","ru","ka","ca"],weeks:{ar:["أحد","إثنين","ثلاثاء","أربعاء","خميس","جمعة","سبت"],en:["Sun","Mon","Tue","Wed","Thu","Fri","Sat"],ko:["일","월","화","수","목","금","토"],fa:["شنبه","آدینه","پنج","چهار","سه","دو","یک"],fr:["Dim","Lun","Mar","Mer","Jeu","Ven","Sam"],ch:["日","一","二","三","四","五","六"],de:["SO","MO","DI","MI","DO","FR","SA"],nl:["Zo","Ma","Di","Wo","Do","Vr","Za"],jp:["日","月","火","水","木","金","土"],pt:["Dom","Seg","Ter","Qua","Qui","Sex","Sab"],da:["Søn","Man","Tir","Ons","Tor","Fre","Lør"],pl:["Nie","Pon","Wto","Śro","Czw","Pią","Sob"],es:["Dom","Lun","Mar","Mié","Jue","Vie","Sáb"],it:["Dom","Lun","Mar","Mer","Gio","Ven","Sab"],cs:["Ne","Po","Út","St","Čt","Pá","So"],uk:["Нд","Пн","Вт","Ср","Чт","Пт","Сб"],ru:["Вс","Пн","Вт","Ср","Чт","Пт","Сб"],ka:["კვ","ორ","სმ","ოთ","ხთ","პრ","შბ"],ca:["Dg","Dl","Dm","Dc","Dj","Dv","Ds"]},monthsLong:{ar:["يناير","فبراير","مارس","إبريل","مايو","يونيو","يوليو","أغسطس","سبتمبر","أكتوبر","نوفمبر","ديسمبر"],en:["January","February","March","April","May","Jun","July","August","September","October","November","December"],ko:["1월","2월","3월","4월","5월","6월","7월","8월","9월","10월","11월","12월"],fa:["آذر","آبان","مهر","شهریور","مرداد","تیر","خرداد","اردیبهشت","فروردین","اسفند","بهمن","دی"],fr:["Janvier","Février","Mars","Avril","Mai","Juin","Juillet","Août","Septembre","Octobre","Novembre","Décembre"],ch:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],de:["Januar","Februar","März","April","Mai","Juni","Juli","August","September","Oktober","November","Dezember"],nl:["Januari","Februari","Maart","April","Mei","Juni","Juli","Augustus","September","Oktober","November","December"],jp:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],pt:["Janeiro","Fevereiro","Março","Abril","Maio","Junho","Julho","Agosto","Setembro","Outubro","Novembro","Dezembro"],da:["Januar","Februar","Marts","April","Maj","Juni","Juli","August","September","Oktober","November","December"],pl:["Styczeń","Luty","Marzec","Kwiecień","Maj","Czerwiec","Lipiec","Sierpień","Wrzesień","Październik","Listopad","Grudzień"],es:["Enero","Febrero","Marzo","Abril","Mayo","Junio","Julio","Agosto","Septiembre","Octubre","Noviembre","Diciembre"],it:["Gennaio","Febbraio","Marzo","Aprile","Maggio","Giugno","Luglio","Agosto","Settembre","Ottobre","Novembre","Dicembre"],cs:["Leden","Únor","Březen","Duben","Květen","Červen","Cervenec","Srpen","Září","Říjen","Listopad","Prosinec"],uk:["Січень","Лютий","Березень","Квітень","Травень","Червень","Липень","Серпень","Вересень","Жовтень","Листопад","Грудень"],ru:["Январь","Февраль","Март","Апрель","Май","Июнь","Июль","Август","Сентябрь","Октябрь","Ноябрь","Декабрь"],ka:["იანვარი","თებერვალი","მარტი","აპრილი","მაისი","ივნისი","ივლისი","აგვისტო","სექტემბერი","ოქტომბერი","ნოემბერი","დეკემბერი"],ca:["Gener","Febrer","Març","Abril","Maig","Juny","Juliol","Agost","Setembre","Octubre","Novembre","Desembre"]},months:{ar:["يناير","فبراير","مارس","إبريل","مايو","يونيو","يوليو","أغسطس","سبتمبر","أكتوبر","نوفمبر","ديسمبر"],en:["Jan","Feb","Mar","Apr","May","Jun","Jul","Aug","Sep","Oct","Nov","Dec"],ko:["1월","2월","3월","4월","5월","6월","7월","8월","9월","10월","11월","12월"],fa:["آذر","آبان","مهر","شهریور","مرداد","تیر","خرداد","اردیبهشت","فروردین","اسفند","بهمن","دی"],fr:["Jan","Fév","Mar","Avr","Mai","Juin","Juil","Aoû","Sep","Oct","Nov","Déc"],ch:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],de:["Jan","Feb","Mär","Apr","Mai","Jun","Jul","Aug","Sep","Okt","Nov","Dez"],nl:["Jan","Feb","Mrt","Apr","Mei","Jun","Jul","Aug","Sep","Okt","Nov","Dec"],jp:["一月","二月","三月","四月","五月","六月","七月","八月","九月","十月","十一月","十二月"],pt:["Jan","Fev","Mar","Abr","Mai","Jun","Jul","Ago","Set","Out","Nov","Dez"],da:["Jan","Feb","Mar","Apr","Maj","Jun","Jul","Aug","Sep","Okt","Nov","Dec"],pl:["Sty","Lut","Mar","Kwi","Maj","Cze","Lip","Sie","Wrz","Paź","Lis","Gru"],es:["Ene","Feb","Mar","Abr","May","Jun","Jul","Ago","Sep","Oct","Nov","Dec"],it:["Gen","Feb","Mar","Apr","Mag","Giu","Lug","Ago","Set","Ott","Nov","Dic"],cs:["Led","Úno","Bře","Dub","Kvě","Čvn","Čvc","Srp","Zář","Říj","Lis","Pro"],uk:["Січ","Лют","Бер","Квіт","Трав","Черв","Лип","Серп","Вер","Жовт","Лист","Груд"],ru:["Янв","Февр","Март","Апр","Май","Июнь","Июль","Авг","Сент","Окт","Нояб","Дек"],ka:["იან","თებ","მარ","აპრ","მაი","ივნ","ივლ","აგვ","სექ","ოქტ","ნოე","დეკ"],ca:["Gen","Feb","Mar","Abr","Mai","Jun","Jul","Ago","Set","Oct","Nov","Des"]},controls:{ar:{ok:"حسناً",cancel:"إلغاء"},en:{ok:"OK",cancel:"Cancel"},ko:{ok:"확인",cancel:"취소"},fa:{ok:"چک کنید",cancel:"لغو"},fr:{ok:"Vérifier",cancel:"Annuler"},ch:{ok:"确认",cancel:"取消"},de:{ok:"Okay",cancel:"Abbrechen"},nl:{ok:"Oké",cancel:"Annuleren"},jp:{ok:"確認",cancel:"キャンセル"},pt:{ok:"Verifique",cancel:"Cancelar"},da:{ok:"Bekræftelse",cancel:"aflyst"},pl:{ok:"Sprawdź",cancel:"Anuluj"},es:{ok:"Cheque",cancel:"Cancelar"},it:{ok:"conferma",cancel:"annullato"},cs:{ok:"Zkontrolujte",cancel:"Zrušit"},uk:{ok:"Вибрати",cancel:"Скасувати"},ru:{ok:"Выбрать",cancel:"Отмена"},ka:{ok:"არჩევა",cancel:"გაუქმება"},ca:{ok:"Confirmar",cancel:"Cancel·lar"}}}}),n("component/global",["../configures/i18n"],function(e){return{language:e.defaultLanguage,languages:e,week:0,format:"YYYY-MM-DD"}}),n("component/options",["moment","./global"],function(e,t){return{lang:null,languages:t.languages,theme:"light",date:e(),format:t.format,enabledDates:[],disabledDates:[],disabledWeekdays:[],disabledRanges:[],schedules:[],scheduleOptions:{colors:{}},week:t.week,weeks:t.languages.weeks.en,monthsLong:t.languages.monthsLong.en,months:t.languages.months.en,controls:t.languages.controls.en,pickWeeks:!1,initialize:!0,multiple:!1,toggle:!1,reverse:!1,buttons:!1,modal:!1,selectOver:!1,minDate:null,maxDate:null,init:null,select:null,apply:null,click:null,page:null,prev:null,next:null}}),n("shim/utils",[],function(){return{register:function(e,t,n){if(!n){var s="PIGNOSE Calendar needs ".concat(e," library.\nIf you want to use built-in plugin, Import dist/pignose.calendar.full.js.\nType below code in your command line to install the library.");console&&"function"==typeof console.error&&(console.warn(s),console.warn("$ ".concat(t)))}return n}}}),n("jquery",["./shim/utils"],function(e){var t;try{t=jQuery||Y}catch(e){}return e.register("jquery","npm install jquery --save",t)}),n("methods/configure",["../component/global","../component/models","../component/options","../configures/i18n","jquery"],function(n,s,a,r,i){return function(e){var t=this;t.settings=i.extend(!0,{},a,e),t.settings.lang||(t.settings.lang=n.language),t.settings.lang!==r.defaultLanguage&&-1!==i.inArray(t.settings.lang,n.languages.supports)&&(t.settings.weeks=n.languages.weeks[t.settings.lang]||n.languages.weeks[r.defaultLanguage],t.settings.monthsLong=n.languages.monthsLong[t.settings.lang]||n.languages.monthsLong[r.defaultLanguage],t.settings.months=n.languages.months[t.settings.lang]||n.languages.months[r.defaultLanguage],t.settings.controls=n.languages.controls[t.settings.lang]||n.languages.controls[r.defaultLanguage]),"light"!==t.settings.theme&&-1===i.inArray(t.settings.theme,s.preference.supports.themes)&&(t.settings.theme="light"),!0===t.settings.pickWeeks&&(!1===t.settings.multiple?console.error("You must give true at settings.multiple options on PIGNOSE-Calendar for using in pickWeeks option."):!0===t.settings.toggle&&console.error("You must give false at settings.toggle options on PIGNOSE-Calendar for using in pickWeeks option.")),t.settings.week%=t.settings.weeks.length}}),n("methods/init",["../manager/index","../component/classNames","../component/helper","../component/models","../component/global","./configure","jquery","moment"],function(L,A,H,F,R,t,j,N){var r=j(window);j(document);return function(e){var b=this;b.settings={},t.call(b,e),b.global={calendarHtml:H.format('<div class="{0} {0}-{4}">                                    <div class="{1}">                                      <a href="#" class="{1}-nav {1}-prev">                                          <span class="icon-arrow-left {1}-icon"></span>                                      </a>                                      <div class="{1}-date">                                          <span class="{1}-month"></span>                                          <span class="{1}-year"></span>                                      </div>                                      <a href="#" class="{1}-nav {1}-next">                                          <span class="icon-arrow-right {1}-icon"></span>                                      </a>                                    </div>                                    <div class="{2}"></div>                                    <div class="{3}"></div>                                  </div>',H.getClass(F.name),A.top,A.header,A.body,b.settings.theme),calendarButtonsHtml:H.format('<div class="{0}-group">                                            <a href="#" class="{0} {0}-cancel">{1}</a>                                            <a href="#" class="{0} {0}-apply">{2}</a>                                          </div>',A.button,b.settings.controls.cancel,b.settings.controls.ok),calendarScheduleContainerHtml:H.format('<div class="{0}-schedule-container"></div>',A.button),calendarSchedulePinHtml:H.format('<span class="{0}-schedule-pin {0}-schedule-pin-\\{0\\}" style="background-color: \\{1\\};"></span>',A.button)};var S=H.getSubClass("unitRange"),Y=H.getSubClass("unitRangeFirst"),C=H.getSubClass("unitRangeLast"),O=H.getSubClass("unitActive"),T=[H.getSubClass("unitFirstActive"),H.getSubClass("unitSecondActive")],x=H.getSubClass("unitToggleActive"),W=H.getSubClass("unitToggleInactive"),P=null;return b.each(function(){var v=j(this),k={initialize:null,element:v,calendar:j(b.global.calendarHtml),input:v.is("input"),renderer:null,current:[null,null],date:{all:[],enabled:[],disabled:[]},storage:{activeDates:[],schedules:[]},dateManager:new L(b.settings.date),calendarWrapperHtml:H.format('<div class="{0}"></div>',H.getSubClass("wrapper")),calendarWrapperOverlayHtml:H.format('<div class="{0}"></div>',H.getSubClass("wrapperOverlay")),context:b},w=v;!0===b.settings.initialize&&(k.initialize=k.current[0]=k.dateManager.date.clone()),this.local=k,!0===b.settings.reverse?k.calendar.addClass(H.getSubClass("reverse")):k.calendar.addClass(H.getSubClass("default"));for(var e=b.settings.week;e<b.settings.weeks.length+b.settings.week;e++){e<0&&(e=R.languages.weeks.en.length-e);var t=b.settings.weeks[e%b.settings.weeks.length];if("string"==typeof t)t=t.toUpperCase(),j(H.format('<div class="{0} {0}-{2}">{1}</div>',H.getSubClass("week"),t,R.languages.weeks.en[e%R.languages.weeks.en.length].toLowerCase())).appendTo(k.calendar.find("."+A.header))}if(!0===b.settings.buttons&&(P=j(b.global.calendarButtonsHtml)).appendTo(k.calendar),!0===k.input||!0===b.settings.modal){var n,s=H.getSubClass("wrapperActive"),a=H.getSubClass("wrapperOverlayActive");(w=j(k.calendarWrapperHtml)).bind("click",function(e){e.stopPropagation()}),v.bind("click",function(e){e.preventDefault(),e.stopPropagation(),e.stopImmediatePropagation(),(n=j("."+H.getSubClass("wrapperOverlay"))).length<1&&(n=j(k.calendarWrapperOverlayHtml)).appendTo("body"),n.unbind("click."+H.getClass(F.name)).bind("click."+H.getClass(F.name),function(e){e.stopPropagation(),w.trigger("cancel."+H.getClass(F.name))}),!1===w.parent().is("body")&&w.appendTo("body"),w.show(),n.show(),r.unbind("resize."+H.getClass(F.name)).bind("resize."+H.getClass(F.name),function(){w.css({marginLeft:-w.outerWidth()/2,marginTop:-w.outerHeight()/2})}).triggerHandler("resize."+H.getClass(F.name)),v[F.name]("set",v.val()),setTimeout(function(){n.addClass(a),w.addClass(s)},25)}).bind("focus",function(e){j(this).blur()}),w.unbind("cancel."+H.getClass(F.name)+" apply."+H.getClass(F.name)).bind("cancel."+H.getClass(F.name)+" apply."+H.getClass(F.name),function(){n.removeClass(a).hide(),w.removeClass(s).hide()})}function M(){if(!k.current[0]||!k.current[1])return!1;var e=k.current[0].format("YYYY-MM-DD"),t=k.current[1].format("YYYY-MM-DD"),n=N(Math.max(k.current[0].valueOf(),k.dateManager.date.clone().startOf("month").valueOf())),s=N(Math.min(k.current[1].valueOf(),k.dateManager.date.clone().endOf("month").valueOf())),a=n.format("YYYY-MM-DD")!==e,r=s.format("YYYY-MM-DD")!==t;!1==a&&n.add(1,"days"),!1==r&&s.add(-1,"days");for(var i=n.format("YYYY-MM-DD"),o=s.format("YYYY-MM-DD");n.format("YYYY-MM-DD")<=s.format("YYYY-MM-DD");n.add(1,"days")){var l=n.format("YYYY-MM-DD"),u=k.calendar.find(H.format('.{0}[data-date="{1}"]',H.getSubClass("unit"),l)).addClass(S);l===i&&u.addClass(Y),l===o&&u.addClass(C)}}function D(e,t,n){return!!n&&(e.diff(n)<0&&0<t.diff(n))}k.renderer=function(){if(k.calendar.appendTo(w.empty()),k.calendar.find("."+A.top+"-year").text(k.dateManager.year),k.calendar.find("."+A.top+"-month").text(b.settings.monthsLong[k.dateManager.month-1]),k.calendar.find(H.format(".{0}-prev .{0}-value",A.top)).text(b.settings.months[k.dateManager.prevMonth-1].toUpperCase()),k.calendar.find(H.format(".{0}-next .{0}-value",A.top)).text(b.settings.months[k.dateManager.nextMonth-1].toUpperCase()),!0===b.settings.buttons&&P){var a=v;P.find("."+A.button).bind("click",function(e){e.preventDefault(),e.stopPropagation();var t=j(this);if(t.hasClass(A.button+"-apply")){t.trigger("apply."+F.name,k);var n="";if(!0===b.settings.toggle)n=k.storage.activeDates.join(", ");else if(!0===b.settings.multiple){var s=[];null!==k.current[0]&&s.push(k.current[0].format(b.settings.format)),null!==k.current[1]&&s.push(k.current[1].format(b.settings.format)),n=s.join(" ~ ")}else n=null===k.current[0]?"":N(k.current[0]).format(b.settings.format);!0===k.input&&a.val(n).triggerHandler("change"),"function"==typeof b.settings.apply&&b.settings.apply.call(k.calendar,k.current,k),w.triggerHandler("apply."+H.getClass(F.name))}else w.triggerHandler("cancel."+H.getClass(F.name))})}var e=k.calendar.find("."+A.body).empty(),t=L.Convert(k.dateManager.year,k.dateManager.month,k.dateManager.firstDay),n=L.Convert(k.dateManager.year,k.dateManager.month,k.dateManager.lastDay),s=t.weekday()-b.settings.week,r=n.weekday()-b.settings.week;s<0&&(s+=b.settings.weeks.length);for(var d=[],c=[null===k.current[0]?null:k.current[0].format("YYYY-MM-DD"),null===k.current[1]?null:k.current[1].format("YYYY-MM-DD")],h=null===b.settings.minDate?null:N(b.settings.minDate),f=null===b.settings.maxDate?null:N(b.settings.maxDate),i=0;i<s;i++){var o=j(H.format('<div class="{0} {0}-{1}"></div>',H.getSubClass("unit"),R.languages.weeks.en[i].toLowerCase()));d.push(o)}function l(e){var t=L.Convert(k.dateManager.year,k.dateManager.month,e),n=t.format("YYYY-MM-DD"),s=j(H.format('<div class="{0} {0}-date {0}-{3}" data-date="{1}"><a href="#">{2}</a></div>',H.getSubClass("unit"),t.format("YYYY-MM-DD"),e,R.languages.weeks.en[t.weekday()].toLowerCase()));if(0<b.settings.enabledDates.length)-1===j.inArray(n,b.settings.enabledDates)&&s.addClass(H.getSubClass("unitDisabled"));else if(0<b.settings.disabledWeekdays.length&&-1!==j.inArray(t.weekday(),b.settings.disabledWeekdays))s.addClass(H.getSubClass("unitDisabled")).addClass(H.getSubClass("unitDisabledWeekdays"));else if(null!==h&&0<h.diff(t)||null!==f&&f.diff(t)<0)s.addClass(H.getSubClass("unitDisabled")).addClass(H.getSubClass("unitDisabledRange"));else if(-1!==j.inArray(n,b.settings.disabledDates))s.addClass(H.getSubClass("unitDisabled"));else if(0<b.settings.disabledRanges.length)for(var a=b.settings.disabledRanges.length,r=0;r<a;r++){var i=b.settings.disabledRanges[r];i.length;if(0<=t.diff(N(i[0]))&&t.diff(N(i[1]))<=0){s.addClass(H.getSubClass("unitDisabled")).addClass(H.getSubClass("unitDisabledRange")).addClass(H.getSubClass("unitDisabledMultipleRange"));break}}if(0<b.settings.schedules.length&&"object"===U(b.settings.scheduleOptions)&&"object"===U(b.settings.scheduleOptions.colors)){var o=b.settings.schedules.filter(function(e){return e.date===n}),l=j.unique(o.map(function(e,t){return e.name}).sort());if(0<l.length){var u=j(b.global.calendarScheduleContainerHtml);u.appendTo(s),l.map(function(e,t){if(b.settings.scheduleOptions.colors[e]){var n=b.settings.scheduleOptions.colors[e];j(H.format(b.global.calendarSchedulePinHtml,e,n)).appendTo(u)}})}}!0===b.settings.toggle?-1!==j.inArray(n,k.storage.activeDates)&&0<k.storage.activeDates.length?s.addClass(x):s.addClass(W):!1===s.hasClass(H.getSubClass("unitDisabled"))&&(!0===b.settings.multiple?(c[0]&&n===c[0]&&s.addClass(O).addClass(T[0]),c[1]&&n===c[1]&&s.addClass(O).addClass(T[1])):c[0]&&n===c[0]&&-1===j.inArray(c[0],b.settings.disabledDates)&&(b.settings.enabledDates.length<1||-1!==j.inArray(c[0],b.settings.enabledDates))&&s.addClass(O).addClass(T[0])),d.push(s);var g=v;s.bind("click",function(e){e.preventDefault(),e.stopPropagation();var t=j(this),n=t.data("date"),s=0,a=!1;if(t.hasClass(H.getSubClass("unitDisabled")))a=!0;else if(!0===k.input&&!1===b.settings.multiple&&!1===b.settings.buttons)g.val(N(n).format(b.settings.format)),w.triggerHandler("apply."+H.getClass(F.name));else if(null!==k.initialize&&k.initialize.format("YYYY-MM-DD")===n&&!1===b.settings.toggle);else{if(!0===b.settings.toggle){var r=k.storage.activeDates.filter(function(e,t){return e===n});if(k.current[s]=N(n),r.length<1)k.storage.activeDates.push(n),t.addClass(x).removeClass(W);else{for(var i=0,o=0;o<k.storage.activeDates.length;o++){var l=k.storage.activeDates[o];if(n===l){i=o;break}}k.storage.activeDates.splice(i,1),t.removeClass(x).addClass(W)}}else if(!0===t.hasClass(O)&&!1===b.settings.pickWeeks)!0===b.settings.multiple&&(t.hasClass(T[0])?s=0:T[1]&&(s=1)),t.removeClass(O).removeClass(T[s]),k.current[s]=null;else{if(!0===b.settings.pickWeeks)if(!0===t.hasClass(O)||!0===t.hasClass(S)){for(var u=0;u<2;u++)k.calendar.find("."+O+"."+T[u]).removeClass(O).removeClass(T[u]);k.current[0]=null,k.current[1]=null}else{k.current[0]=N(n).startOf("week").add(b.settings.week,"days"),k.current[1]=N(n).endOf("week").add(b.settings.week,"days");for(var d=0;d<2;d++)k.calendar.find("."+O+"."+T[d]).removeClass(O).removeClass(T[d]),k.calendar.find(H.format('.{0}[data-date="{1}"]',H.getSubClass("unit"),k.current[d].format("YYYY-MM-DD"))).addClass(O).addClass(T[d])}else!0===b.settings.multiple&&(null===k.current[0]?s=0:null===k.current[1]?s=1:(s=0,k.current[1]=null,k.calendar.find("."+O+"."+T[1]).removeClass(O).removeClass(T[1]))),k.calendar.find("."+O+"."+T[s]).removeClass(O).removeClass(T[s]),t.addClass(O).addClass(T[s]),k.current[s]=N(n);if(k.current[0]&&k.current[1]){if(0<k.current[0].diff(k.current[1])){var c=k.current[0];k.current[0]=k.current[1],k.current[1]=c,c=null,k.calendar.find("."+O).each(function(){var e=j(this);for(var t in T){var n=T[t];e.toggleClass(n)}})}if(!1===function(e,t){var n;for(var s in b.settings.disabledDates)if(n=N(b.settings.disabledDates[s]),D(e,t,n))return!1;if(D(e,t,b.settings.maxDate))return!1;if(D(e,t,b.settings.minDate))return!1;for(var a in b.settings.disabledRanges){var r=b.settings.disabledRanges[a],i=N(r[0]),o=N(r[1]);if(D(e,t,i)||D(e,t,o))return!1}var l,u=e.weekday(),d=t.weekday();d<u&&(l=u,u=d,d=l);for(var c=0,h=0;c<b.settings.disabledWeekdays.length&&h<7;c++){h++;var f=b.settings.disabledWeekdays[c];if(u<=f&&f<=d)return!1}return!0}(k.current[0],k.current[1])&&!1===b.settings.selectOver&&(k.current[0]=null,k.current[1]=null,k.calendar.find("."+O).removeClass(O).removeClass(T[0]).removeClass(T[1])),!0===k.input&&!1===b.settings.buttons){var h=[];null!==k.current[0]&&h.push(k.current[0].format(b.settings.format)),null!==k.current[1]&&h.push(k.current[1].format(b.settings.format)),t.val(h.join(", ")),w.trigger("apply."+H.getClass(F.name))}}}!0===b.settings.multiple&&(k.calendar.find("."+S).removeClass(S).removeClass(Y).removeClass(C),M.call()),0<b.settings.schedules.length&&(k.storage.schedules=b.settings.schedules.filter(function(e){return e.date===n}))}function f(e){k.date.all.push(e),!function(e){if(-1!==b.settings.disabledDates.indexOf(e))return!1;if(0<=e.diff(b.settings.maxDate))return!1;if(e.diff(b.settings.minDate)<=0)return!1;for(var t in b.settings.disabledRanges){var n=b.settings.disabledRanges[t],s=N(n[0]),a=N(n[1]);if(D(s,a,e))return!1}var r=e.weekday();return-1===b.settings.disabledWeekdays.indexOf(r)}(N(e))?k.date.disabled.push(e):k.date.enabled.push(e)}if(k.current[0])if(k.current[1])for(var m=k.current[0].clone();m.format("YYYY-MM-DD")<=k.current[1].format("YYYY-MM-DD");m.add("1","days"))f(m.clone());else f(k.current[0].clone());!1===a&&(k.initialize=null,"function"==typeof b.settings.select&&b.settings.select.call(t,k.current,k)),"function"==typeof b.settings.click&&b.settings.click.call(t,e,k)})}for(var u=k.dateManager.firstDay;u<=k.dateManager.lastDay;u++)l(u);for(var m=1+r;d.length<5*b.settings.weeks.length;m++){m<0&&(m=R.languages.weeks.en.length-m);var g=j(H.format('<div class="{0} {0}-{1}"></div>',H.getSubClass("unit"),R.languages.weeks.en[m%R.languages.weeks.en.length].toLowerCase()));d.push(g)}for(var p=null,y=0;y<d.length;y++){var _=d[y];(y%b.settings.weeks.length==0||y+1>=d.length)&&(null!==p&&p.appendTo(e),y+1<d.length&&(p=j(H.format('<div class="{0}"></div>',H.getSubClass("row"))))),p.append(_)}k.calendar.find("."+A.top+"-nav").bind("click",function(e){e.preventDefault(),e.stopPropagation();var t=j(this),n="unkown";t.hasClass(A.top+"-prev")?(n="prev",k.dateManager=new L(k.dateManager.date.clone().add(-1,"months"))):t.hasClass(A.top+"-next")&&(n="next",k.dateManager=new L(k.dateManager.date.clone().add(1,"months"))),"function"==typeof b.settings.page&&b.settings.page.call(t,{type:n,year:k.dateManager.year,month:k.dateManager.month,day:k.dateManager.day},k),"function"==typeof b.settings[n]&&b.settings[n].call(t,{type:n,year:k.dateManager.year,month:k.dateManager.month,day:k.dateManager.day},k),k.renderer.call()}),!0===b.settings.multiple&&(k.calendar.find("."+S).removeClass(S).removeClass(Y).removeClass(C),M.call())},k.renderer.call(),v[0][F.name]=k,"function"==typeof b.settings.init&&b.settings.init.call(v,k)})}}),n("methods/setting",["../component/global","../configures/i18n","jquery"],function(a,e,r){return function(e){var s=r.extend({language:a.language,languages:{},week:null,format:null},e);if(a.language=s.language,0<Object.keys(s.languages).length){function t(t){var n=s.languages[t];if("string"!=typeof t&&console.error("global configuration is failed.\nMessage: language key is not a string type.",t),!n.weeks)return console.warn("Warning: `weeks` option of `"+t+"` language is missing."),"break";if(!n.monthsLong)return console.warn("Warning: `monthsLong` option of `"+t+"` language is missing."),"break";if(!n.months)return console.warn("Warning: `months` option of `"+t+"` language is missing."),"break";if(!n.controls)return console.warn("Warning: `controls` option of `"+t+"` language is missing."),"break";if(n.weeks){if(n.weeks.length<7)return console.error("`weeks` must have least 7 items."),"break";7!==n.weeks.length&&console.warn("`weeks` option over 7 items. We recommend to give 7 items.")}if(n.monthsLong){if(n.monthsLong.length<12)return console.error("`monthsLong` must have least 12 items."),"break";12!==n.monthsLong.length&&console.warn("`monthsLong` option over 12 items. We recommend to give 12 items.")}if(n.months){if(n.months.length<12)return console.error("`months` must have least 12 items."),"break";12!==n.months.length&&console.warn("`months` option over 12 items. We recommend to give 12 items.")}if(n.controls){if(!n.controls.ok)return console.error("`controls.ok` value is missing in your language setting"),"break";if(!n.controls.cancel)return console.error("`controls.cancel` value is missing in your language setting"),"break"}-1===a.languages.supports.indexOf(t)&&a.languages.supports.push(t),["weeks","monthsLong","months","controls"].map(function(e){a.languages[e][t]&&console.warn("`"+t+"` language is already given however it will be overwriten."),a.languages[e][t]=n[e]||a.languages[e][t.defaultLanguage]})}for(var n in s.languages){if("break"===t(n))break}}s.week&&("number"==typeof s.week?a.week=s.week:console.error("global configuration is failed.\nMessage: You must give `week` option as number type.")),s.format&&("string"==typeof s.format?a.format=s.format:console.error("global configuration is failed.\nMessage: You must give `format` option as string type."))}}),n("methods/select",["../component/helper","jquery"],function(s,a){return function(n){this.each(function(){var e=this.local.dateManager,t=s.format("{0}-{1}-{2}",e.year,e.month,n);a(this).find(s.format('.{0}[data-date="{1}"]',s.getSubClass("unit"),t)).triggerHandler("click")})}}),n("methods/set",["jquery","moment","../manager/index","../component/models"],function(r,i,o,l){return function(e){if(e){var a=e.split("~").map(function(e){var t=r.trim(e);return t||null});this.each(function(){var e=r(this)[0][l.name],t=e.context,n=[a[0]?i(a[0],t.settings.format):null,a[1]?i(a[1],t.settings.format):null];if(e.dateManager=new o(n[0]),!0===t.settings.pickWeeks&&n[0]){var s=n[0];n[0]=s.clone().startOf("week"),n[1]=s.clone().endOf("week")}!0===t.settings.toggle?e.storage.activeDates=a:e.current=n,e.renderer.call()})}}}),n("methods/index",["./init","./configure","./setting","./select","./set"],function(e,t,n,s,a){return{init:e,configure:t,setting:n,select:s,set:a}}),n("component/polyfills",[],function(){Array.prototype.filter||(Array.prototype.filter=function(e){"use strict";if(null===this)throw new TypeError;var t=Object(this),n=t.length>>>0;if("function"!=typeof e)return[];for(var s=[],a=arguments[1],r=0;r<n;r++)if(r in t){var i=t[r];e.call(a,i,r,t)&&s.push(i)}return s})}),n("core",["./methods/index","./component/models","./component/polyfills"],function(e,t){"use strict";return window[t.name]={version:t.version},e}),n("main",["core","component/models"],function(n,e){"use strict";function t(e,t){return void 0!==n[t]?n[t].apply(e,Array.prototype.slice.call(arguments,2)):"object"!==U(t)&&t?void console.error("Argument error are occured."):n.init.apply(e,Array.prototype.slice.call(arguments,1))}for(var s in t.component={},e)t.component[s]=e[s];return t});var c=Zn("main"),h=Zn("component/models"),Y=Zn("jquery"),C=window||{};for(var O in C.moment=Zn("moment"),Y.fn[h.name]=function(e){return c.apply(c,[this,e].concat(Array.prototype.splice.call(arguments,1)))},h)Y.fn[h.name][O]=h[O];n("plugins/jquery.js",function(){})});
$(document).on('click', '.delete', function () {
    let url = $(this).data('url');
    let reload = $(this).data('reload');
    let tableId = '#' + $(this).data('table');
    let redirect = $(this).data('redirect');
    deleteConfirmation(url, tableId, reload, redirect);
});
function changeStatus(url, tableId, formData, message, inputField) {
    var html = `<p> ` + message + ` </p>`;
    if (formData.status == 'rejected') {
        html += `<label class="col-form-label">
                    Please, provide disapproval reason:
                </label>
                <textarea name="rejected_reason" id="rejection-reason" class="form-control" rows="3" required></textarea>`;
    }
    window.swal.fire({
        title: 'Are you sure?',
        text: message,
        icon: 'warning',
        html: html,
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes",
        preConfirm: () => {
            if (formData.status == 'rejected') {
                if (document.getElementById('rejection-reason').value) {
                    // Handle return value 
                    formData['rejection_reason'] = document.getElementById('rejection-reason').value;
                } else {
                    window.swal.showValidationMessage('Rejection reason is required')
                }
            }
        }
    }).then((result) => {
        let toggleStatus = inputField.is(':checked') ? false : true;
        // if alert is confirmed
        if (result.isConfirmed) {
            // axios put method request here
            window.axios.put(url, formData).then(response => {
                if (response.status === 200) {
                    window.swal.close();
                    $(tableId).DataTable().ajax.reload(null, false);

                    // // Show toast message
                    // Toast.fire({
                    //     icon: 'success',
                    //     title: response.data.message
                    // });

                    //show alert message
                    alertMessage(response.data.message, 'success');
                }
            }).catch(error => {
                inputField.prop('checked', toggleStatus);

                // Show toast message
                Toast.fire({
                    icon: 'error',
                    title: error.response.data.message
                });
            });
        }

        // if alert is dismissed
        if (result.isDismissed) {
            inputField.prop('checked', toggleStatus);
        }
    });
}
function deleteConfirmation(url, tableId, reload=false, redirect=false) {
    window.swal.fire({
        title: 'Are you sure?',
        text: "You want to delete this record",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes, delete it!"
    }).then((result) => {
        if (result.value) {
            window.swal.fire({
                title: "",
                text: "Please wait...",
                showConfirmButton: false,
                backdrop: true
            });
            window.axios.delete(url).then(response => {
                if (response.status === 200) {
                    window.swal.close();
                    // Show toast message
                    Toast.fire({
                        icon: 'success',
                        title: response.data.message
                    });
                    if (reload == true) {
                        window.location.reload();
                    }

                    if (redirect) {
                        window.location.href = redirect;
                    }

                    $(tableId).DataTable().ajax.reload();
                    
                    
                }
            }).catch(error => {
                window.swal.close();
                // Show toast message
                Toast.fire({
                    icon: 'error',
                    title: error.response.data.message
                });
            });
        }
    });
}

function toastMessage(message = '', status = '') {
    status = status=='' ? 'error' : status;

    if (message=='')
        message = status=='error' ? 'Something went wrong' : 'Success';

    Toast.fire({
        title: message,
        icon: status,
    });
}

$('body').on('click', '[data-act=ajax-modal]', function () {
    const _self = $(this);

    const content = $("#ajax_model_content");
    const spinner = $("#ajax_model_spinner");

    content.hide();
    spinner.show();

    $("#ajax_model").modal({backdrop: "static"});
    $("#ajax_model_title").html(_self.attr('data-title'));
    var metaData = {};
    $(this).each(function () {
        $.each(this.attributes, function () {
            if (this.specified && this.name.match("^data-post-")) {
                var dataName = this.name.replace("data-post-", "");
                metaData[dataName] = this.value;
            }
        });
    });

    axios({
        method: _self.attr('data-method'),
        url: _self.attr('data-action-url'),
        data: metaData
    })
    .then(response => {
        spinner.hide();
        
        if (response.status === 200) 
        {
            content.html(response.data).show();
            $('#ajax_model select').css('width', '100%');
            $('.form-select-modal').select2({
                width:'100%',
                
            });
            $(document).trigger('ajaxmodal.loaded');
            $('.datepicker').datepicker({
                format: "yyyy-mm-dd",
               
             });
            initMap('map-popup','searchInputPopup', 'latitude-popup', 'longitude-popup', false,'',0,0)
        }
        else toastMessage();
        $('input.open-time-picker').timepicker({
            timeFormat: 'HH:mm:ss',
        });
        $('input.close-time-picker').timepicker({
            timeFormat: 'HH:mm:ss',
        });
        $('textarea:not(.without-summernote)').summernote({
            height: 200
        });

   
   

    }).catch(error => {
        spinner.hide();
        // toastMessage(error.response.data.message);
    });
});

$('body').on('submit', '[data-form=ajax-form]', function(e) {
    e.preventDefault();
    const form = this;
    const confirm = $(form).data('confirm');

    if (confirm=='yes') {
        window.swal.fire({
            title: 'Are you sure?',
            text: "Do you really want to submit this form?",
            icon: 'warning',
            showCancelButton: true,
            confirmButtonColor: '#3085d6',
            cancelButtonColor: '#d33',
            confirmButtonText: "Yes, do it!"
        }).then((result) => {
            if (result.value) sendAjaxForm(form);
        });
    } else {
        sendAjaxForm(form);
    }
});

function sendAjaxForm(form) {
    const _self = $(form);
    const btn = _self.find('[data-button=submit]');
    const btnHtml = btn.html();
    const modal = _self.data('modal');
    const dt = _self.data('datatable');
    const reload = _self.data('reload');
    const redirect = _self.data('redirect');
    const formReset = _self.data('form-reset');

    btn.attr('disabled', 'disabled');
    btn.html(btnHtml + '&nbsp;&nbsp;<span class="spinner-border spinner-border-sm"></span>');

    axios({
        url: _self.attr('action'),
        method: _self.attr('method'),
        data: new FormData(_self[0]),
    })
    .then(response => {
        if (response.status == 200) {
            if (modal !== '') $(modal).modal('hide');
            if (dt !== '') $(dt).DataTable().ajax.reload();
           

            toastMessage(response.data.message, 'success');

            if (formReset==true)  _self.trigger('reset');

            if (reload==true) window.location.reload();

            if (redirect) {
                window.location.href = redirect;
            }
        }

        else toastMessage();
    })
    .catch(error => {
        toastMessage(error.response.data.message);
    })
    .finally(response => {
        btn.removeAttr('disabled');
        btn.html(btnHtml);
    });
}

// setting up toast
const Toast = Swal.mixin({
    toast: true,
    position: 'bottom-end',
    showConfirmButton: false,
    timer: 3000,
    timerProgressBar: true,
    didOpen: (toast) => {
        toast.addEventListener('mouseenter', Swal.stopTimer)
        toast.addEventListener('mouseleave', Swal.resumeTimer)
    }
});

// Logo Preview
$(document).on('click','.modal-logo', function(e) {
    $(this).siblings('.logo').click();
});

$(document).on('change','.logo', function(e) {
    var input = e.target;
    if (input.files && input.files[0]) {
    var file = input.files[0];

    var reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = function(e) {
        $('.modalCompanyLgo').attr('src', reader.result).addClass('hasImage');
        }
    }
});

$(document).on('click','#modal-logo', function(e) {
    $(this).siblings('#avatar').click();
});

$(document).on('change','#avatar', function(e) {


    var input = e.target;
    if (input.files && input.files[0]) {
    var file = input.files[0];

    var reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = function(e) {
        $('#modalAvatar').attr('src', reader.result).addClass('hasImage');
        }
    }
});

$(document).on('click','#modal-logo', function(e) {
    $(this).siblings('#avatar-edit').click();
});

$(document).on('change','#avatar-edit', function(e) {


    var input = e.target;
    if (input.files && input.files[0]) {
    var file = input.files[0];

    var reader = new FileReader();

    reader.readAsDataURL(file);
    reader.onload = function(e) {
        $('#modalAvatarEdit').attr('src', reader.result).addClass('hasImage');
        }
    }
});
$(function () {
    $('#wrapper .version strong').text('v' + $.fn.pignoseCalendar.version);

    function onSelectHandler(date, context) {

        var $element = context.element;
        var $calendar = context.calendar;
        var $box = $element.siblings('.box').show();
        var text = 'You selected date ';

        if (date[0] !== null) {
            text += date[0].format('YYYY-MM-DD');
        }

        if (date[0] !== null && date[1] !== null) {
            text += ' ~ ';
        }
        else if (date[0] === null && date[1] == null) {
            text += 'nothing';
        }

        if (date[1] !== null) {
            text += date[1].format('YYYY-MM-DD');
        }

        $box.text(text);
    }

    function onApplyHandler(date, context) {

        var $element = context.element;
        var $calendar = context.calendar;
        var $box = $element.siblings('.box').show();
        var text = 'You applied date ';

        if (date[0] !== null) {
            text += date[0].format('YYYY-MM-DD');
        }

        if (date[0] !== null && date[1] !== null) {
            text += ' ~ ';
        }
        else if (date[0] === null && date[1] == null) {
            text += 'nothing';
        }

        if (date[1] !== null) {
            text += date[1].format('YYYY-MM-DD');
        }

        $box.text(text);
    }

    // Blue theme type Calendar
    $('.calendar-blue').pignoseCalendar({
        theme: 'blue', // light, dark, blue
        select: onSelectHandler
    });

});

$('#clock').countdown('2022/04/30', function(event) {
    $(this).html(event.strftime(
        '<div class="day_wrap"> <div class="days colorRed">%D</div>days</div>  <div class="day_wrap dot">:</div> <div class="day_wrap"><div class="days">%H</div>hours</div> <div class="day_wrap dot">:</div> <div class="day_wrap"><div class="days">%M</div>minutes</div>'
    
    ));
});

$('#clock2').countdown('2022/01/10', function(event) {
    $(this).html(event.strftime(
        '<div class="day_wrap"> <div class="days colorRed">%D</div>days</div>  <div class="day_wrap dot">:</div> <div class="day_wrap"><div class="days">%H</div>hours</div> <div class="day_wrap dot">:</div> <div class="day_wrap"><div class="days">%M</div>minutes</div>'
    
    ));
});

function initMap(mapDiv, searchInput, latitudeInput, longitudeInput, isEdit, addressValue,latitudeValue, longitudeValue) {
    var map = new google.maps.Map(document.getElementById(mapDiv), {
        center: {lat: 24.453884, lng: 54.3773438},
        zoom: 18
    });
    var input = document.getElementById( searchInput);
    map.controls[google.maps.ControlPosition.TOP_LEFT].push(input);
    var autocomplete = new google.maps.places.Autocomplete(input);
    autocomplete.setComponentRestrictions({'country': 'AE'});
    autocomplete.bindTo('bounds', map);
    var infowindow = new google.maps.InfoWindow();
    var marker = new google.maps.Marker({
        map: map,
        anchorPoint: new google.maps.Point(0, -29),
        draggable: true
    });
    if (isEdit && addressValue!='' && latitudeValue && longitudeValue) {
        document.getElementById(searchInput).value = addressValue;
        let lat = latitudeValue
        let lng = longitudeValue
        addMarkerOnMap(map, marker, infowindow, lat, lng,addressValue)
    }
    google.maps.event.addListener(marker, 'dragend', async function() {
        const geocoder = new google.maps.Geocoder();
        const pos = {
            lat: parseFloat(marker.getPosition().lat()),
            lng: parseFloat(marker.getPosition().lng()),
        };
        var address = await geocodePosition(pos, geocoder, marker, infowindow);
        document.getElementById( searchInput).value = address;
        document.getElementById(latitudeInput).value = marker.getPosition().lat();
        document.getElementById(longitudeInput).value = marker.getPosition().lng();
    })
    autocomplete.addListener('place_changed', function() {
        infowindow.close();
        marker.setVisible(false);
        var place = autocomplete.getPlace();
        if (!place.geometry) {
            window.alert("Autocomplete's returned place contains no geometry");
            return;
        }
        // If the place has a geometry, then present it on a map.
        if (place.geometry.viewport) {
            map.fitBounds(place.geometry.viewport);
        } else {
            map.setCenter(place.geometry.location);
            map.setZoom(18);
        }
        marker.setIcon(({
            url: place.icon,
            size: new google.maps.Size(71, 71),
            origin: new google.maps.Point(0, 0),
            anchor: new google.maps.Point(17, 34),
            scaledSize: new google.maps.Size(35, 35)
        }));
        marker.setPosition(place.geometry.location);
        marker.setVisible(true);
    
        var address = '';
        if (place.address_components) {
            address = [
                (place.address_components[0] && place.address_components[0].short_name || ''),
                (place.address_components[1] && place.address_components[1].short_name || ''),
                (place.address_components[2] && place.address_components[2].short_name || '')
                ].join(' ');
        }
    
        infowindow.setContent('<div><strong>' + place.name + '</strong><br>' + address);
        infowindow.open(map, marker);
        document.getElementById(latitudeInput).value = place.geometry.location.lat();
        document.getElementById(longitudeInput).value = place.geometry.location.lng();
        
    });
}
async function geocodePosition(pos, geocoder, marker, infowindow) {
    var address = '';
    await new Promise((resolve, reject) => {
        geocoder.geocode({
            latLng: pos
        }, function(responses) {
            if (responses && responses.length > 0) {
                address = responses[0].formatted_address;
                resolve(address);
            } else {
                address = 'Cannot determine address at this location.';
                reject(address);
            }
            infowindow.setContent('<div><strong>' + address + '</strong><br>' + address);
            infowindow.open(map, marker);
        });
    })
    return address;        
}
function addMarkerOnMap (map, marker, infowindow, lat, lng, address) {
    marker.setPosition(new google.maps.LatLng(lat, lng));
    map.setZoom(18)
    map.panTo(marker.getPosition())
    infowindow.setContent('<div><strong>' + address + '</strong><br>' + address);
    infowindow.open(map, marker);
}


function changeStatus(url, tableId, formData, message, inputField) {
    newStatus = formData.status ? 'activate':'deactivate';
    window.swal.fire({
        title: 'Are you sure?',
        text: "You want to "+newStatus +" this record",
        icon: 'warning',
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: "Yes"
    }).then((result) => {
        let toggleStatus = inputField.is(':checked') ? false : true;
        // if alert is confirmed
        if (result.isConfirmed) {
            // axios put method request here
            window.axios.put(url, formData).then(response => {
                if (response.status === 200) {
                    window.swal.close();
                    $(tableId).DataTable().ajax.reload(null, false);

                    // Show toast message
                    Toast.fire({
                        icon: 'success',
                        title: response.data.message
                    });
                }
            }).catch(error => {
                inputField.prop('checked', toggleStatus);
                
                // Show toast message
                Toast.fire({
                    icon: 'error',
                    title: error.response.data.message
                });
            });
        }

        // if alert is dismissed
        if (result.isDismissed) {
            inputField.prop('checked', toggleStatus);
        }
    });
}

$(document).on('click', '.toggle-clicked', function (e) {
    _self = $(this);
    var data = {
        'status': _self.data('status')
        // 'reason': $('[name=rejected_reason]').val(),
    }
    let url = _self.data('url');
    let table = _self.data('table');
    const message = ""

    changeStatus(url, table, data, message, _self);
});

$('.language-item').on('click', function (e) {
            e.preventDefault();
    var locale = $(this).attr('data-code');
    $.ajax({
        url: "/set-locale/"+locale,
        method: "get",
        success: function(response) {
            if (response.status) {
                window.location.reload();
            }
        }
    });
});

$(document).on('click', '.change-status-clicked', function (e) {
    alert('main yaha ho ');
    _self = $(this);
    var data = {
        'status': _self.data('status')
        // 'reason': $('[name=rejected_reason]').val(),
    }
    let url = _self.data('url');
    let table = _self.data('table');
    const message = ""

    changeStatus(url, table, data, message, _self);
});
