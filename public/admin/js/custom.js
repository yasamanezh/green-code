!function (e) {
    var o = {};

    function t(n) {
        if (o[n]) return o[n].exports;
        var a = o[n] = {i: n, l: !1, exports: {}};
        return e[n].call(a.exports, a, a.exports, t), a.l = !0, a.exports
    }

    t.m = e, t.c = o, t.d = function (e, o, n) {
        t.o(e, o) || Object.defineProperty(e, o, {enumerable: !0, get: n})
    }, t.r = function (e) {
        "undefined" != typeof Symbol && Symbol.toStringTag && Object.defineProperty(e, Symbol.toStringTag, {value: "Module"}), Object.defineProperty(e, "__esModule", {value: !0})
    }, t.t = function (e, o) {
        if (1 & o && (e = t(e)), 8 & o) return e;
        if (4 & o && "object" == typeof e && e && e.__esModule) return e;
        var n = Object.create(null);
        if (t.r(n), Object.defineProperty(n, "default", {
            enumerable: !0,
            value: e
        }), 2 & o && "string" != typeof e) for (var a in e) t.d(n, a, function (o) {
            return e[o]
        }.bind(null, a));
        return n
    }, t.n = function (e) {
        var o = e && e.__esModule ? function () {
            return e.default
        } : function () {
            return e
        };
        return t.d(o, "a", o), o
    }, t.o = function (e, o) {
        return Object.prototype.hasOwnProperty.call(e, o)
    }, t.p = "/", t(t.s = 49)
}({
    49: function (e, o, t) {
        e.exports = t(50)
    }, 50: function (e, o, t) {
        function n(e) {
            return (n = "function" == typeof Symbol && "symbol" == typeof Symbol.iterator ? function (e) {
                return typeof e
            } : function (e) {
                return e && "function" == typeof Symbol && e.constructor === Symbol && e !== Symbol.prototype ? "symbol" : typeof e
            })(e)
        }

        $((function () {
            "use strict";
            $("#global-loader").fadeOut("slow");
            $(document).on("click", '[data-toggle="card-remove"]', (function (e) {
                return $(this).closest("div.card").remove(), e.preventDefault(), !1
            })), $(document).on("click", '[data-toggle="card-collapse"]', (function (e) {
                return $(this).closest("div.card").toggleClass("card-collapsed"), e.preventDefault(), !1
            })), $(document).on("click", '[data-toggle="card-fullscreen"]', (function (e) {
                return $(this).closest("div.card").toggleClass("card-fullscreen").removeClass("card-collapsed"), e.preventDefault(), !1
            })), window.matchMedia("(min-width: 992px)").matches && ($(".main-navbar .active").removeClass("show"), $(".main-header-menu .active").removeClass("show")), $(".main-header .dropdown > a").on("click", (function (e) {
                e.preventDefault(), $(this).parent().toggleClass("show"), $(this).parent().siblings().removeClass("show")
            })), $(".mobile-main-header .dropdown > a").on("click", (function (e) {
                e.preventDefault(), $(this).parent().toggleClass("show"), $(this).parent().siblings().removeClass("show")
            })), $(".main-navbar .with-sub").on("click", (function (e) {
                e.preventDefault(), $(this).parent().toggleClass("show"), $(this).parent().siblings().removeClass("show")
            })), $(".dropdown-menu .main-header-arrow").on("click", (function (e) {
                e.preventDefault(), $(this).closest(".dropdown").removeClass("show")
            })), $("#mainNavShow").on("click", (function (e) {
                e.preventDefault(), $("body").toggleClass("main-navbar-show")
            })), $("#mainContentLeftShow").on("click touch", (function (e) {
                e.preventDefault(), $("body").addClass("main-content-left-show")
            })), $("#mainContentLeftHide").on("click touch", (function (e) {
                e.preventDefault(), $("body").removeClass("main-content-left-show")
            })), $("#mainContentBodyHide").on("click touch", (function (e) {
                e.preventDefault(), $("body").removeClass("main-content-body-show")
            })), $("body").append('<div class="main-navbar-backdrop"></div>'), $(".main-navbar-backdrop").on("click touchstart", (function () {
                $("body").removeClass("main-navbar-show")
            })), $(document).on("click touchstart", (function (e) {
                (e.stopPropagation(), $(e.target).closest(".main-header .dropdown").length || $(".main-header .dropdown").removeClass("show"), window.matchMedia("(min-width: 992px)").matches) ? ($(e.target).closest(".main-navbar .nav-item").length || $(".main-navbar .show").removeClass("show"), $(e.target).closest(".main-header-menu .nav-item").length || $(".main-header-menu .show").removeClass("show"), $(e.target).hasClass("main-menu-sub-mega") && $(".main-header-menu .show").removeClass("show")) : $(e.target).closest("#mainMenuShow").length || $(e.target).closest(".main-header-menu").length || $("body").removeClass("main-header-menu-show")
            })), $("#mainMenuShow").on("click", (function (e) {
                e.preventDefault(), $("body").toggleClass("main-header-menu-show")
            })), $(".main-header-menu .with-sub").on("click", (function (e) {
                e.preventDefault(), $(this).parent().toggleClass("show"), $(this).parent().siblings().removeClass("show")
            })), $(".main-header-menu-header .close").on("click", (function (e) {
                e.preventDefault(), $("body").removeClass("main-header-menu-show")
            })), $('[data-toggle="tooltip"]').tooltip(), $(".toast").toast(), $(window).on("scroll", (function (e) {
                $(this).scrollTop() > 0 ? $("#back-to-top").fadeIn("slow") : $("#back-to-top").fadeOut("slow")
            })), $(document).on("click", "#back-to-top", (function (e) {
                return $("html, body").animate({scrollTop: 0}, 600), !1
            })), $(document).on("click", ".fullscreen-button", (function () {
                $("html").addClass("fullscreen"), void 0 !== document.fullScreenElement && null === document.fullScreenElement || void 0 !== document.msFullscreenElement && null === document.msFullscreenElement || void 0 !== document.mozFullScreen && !document.mozFullScreen || void 0 !== document.webkitIsFullScreen && !document.webkitIsFullScreen ? document.documentElement.requestFullScreen ? document.documentElement.requestFullScreen() : document.documentElement.mozRequestFullScreen ? document.documentElement.mozRequestFullScreen() : document.documentElement.webkitRequestFullScreen ? document.documentElement.webkitRequestFullScreen(Element.ALLOW_KEYBOARD_INPUT) : document.documentElement.msRequestFullscreen && document.documentElement.msRequestFullscreen() : ($("html").removeClass("fullscreen"), document.cancelFullScreen ? document.cancelFullScreen() : document.mozCancelFullScreen ? document.mozCancelFullScreen() : document.webkitCancelFullScreen ? document.webkitCancelFullScreen() : document.msExitFullscreen && document.msExitFullscreen())
            })), $(".cover-image").each((function () {
                var e = $(this).attr("data-image-src");
                "undefined" !== n(e) && !1 !== e && $(this).css("background", "url(" + e + ") center center")
            })), $(".select2-no-search").select2({
                minimumResultsForSearch: 1 / 0,
                placeholder: "همه دسته بندی ها",
                width: "100%"
            });
            var e = location.pathname.split("/").slice(-1)[0].replace(/^\/|\/$/g, "");
            $(".main-navbar .nav li a").each((function () {
                var o, t = $(this);
                o = t, "" === e ? -1 !== o.attr("href").indexOf("#") && (o.parents(".main-navbar .nav-item").last().addClass("active"), o.parents(".main-navbar .nav-sub").length && o.parents(".main-navbar .nav-sub-item").last().addClass("active")) : -1 !== o.attr("href").indexOf(e) && (o.parents(".main-navbar .nav-item").last().addClass("active"), o.parents(".main-navbar .nav-sub").length && o.parents(".main-navbar .nav-sub-item").last().addClass("active"))
            })), $(document).on("click", "#myonoffswitch51", (function () {
                this.checked ? ($("body").addClass("icon-style"), $("body").removeClass("light-leftmenu"), $("body").removeClass("dark-leftmenu"), $("body").removeClass("color-leftmenu"), $("body").removeClass("light-header"), $("body").removeClass("color-header"), $("body").removeClass("dark-header"), localStorage.setItem("icon-style", "True")) : ($("body").removeClass("icon-style"), localStorage.setItem("icon-style", "false"))
            })), $(document).on("click", "#myonoffswitch52", (function () {
                this.checked ? $("body").addClass("theme-style") : ($("body").removeClass("theme-style"), localStorage.setItem("theme-style", "false"))
            })), $("#background1").on("click", (function () {
                return $("body").addClass("color-leftmenu"), $("body").removeClass("light-leftmenu"), !1
            })), $("#background2").on("click", (function () {
                return $("body").addClass("light-leftmenu"), $("body").removeClass("color-leftmenu"), !1
            })), $("#background3").on("click", (function () {
                return $("body").addClass("header-dark"), $("body").addClass("light-horizontal"), $("body").addClass("light-theme"), $("body").removeClass("color-leftmenu"), $("body").removeClass("color-header"), !1
            })), $("#background4").on("click", (function () {
                return $("body").addClass("color-header"), $("body").addClass("light-horizontal"), $("body").removeClass("color-leftmenu"), $("body").removeClass("color-horizontal"), $("body").removeClass("header-dark"), !1
            })), $("#background5").on("click", (function () {
                return $("body").addClass("dark-theme"), $("body").removeClass("light-leftmenu"), $("body").removeClass("light-theme"), $("body").removeClass("color-header"), $("body").removeClass("light-horizontal"), !1
            })), $("#background6").on("click", (function () {
                return $("body").addClass("light-theme"), $("body").addClass("light-leftmenu"), $("body").addClass("light-horizontal"), $("body").removeClass("color-header"), $("body").removeClass("header-dark"), $("body").removeClass("color-leftmenu"), $("body").removeClass("dark-theme"), !1
            })), $("#background7").on("click", (function () {
                return $("body").addClass("color-horizontal"), $("body").removeClass("light-horizontal"), $("body").removeClass("header-dark"), $("body").removeClass("color-header"), $("body").removeClass("light-horizontal"), !1
            })), $("#background8").on("click", (function () {
                return $("body").addClass("light-horizontal"), $("body").removeClass("color-horizontal"), !1
            })), $("a[data-theme]").click((function () {
                $("head link#theme").attr("href", $(this).data("theme")), $(this).toggleClass("active").siblings().removeClass("active")
            }))
        }))
    }
});
