! function(o) { o.isScrollToFixed = function(i) { return !!o(i).data("ScrollToFixed") }, o.ScrollToFixed = function(i, e) { var t = this;
        t.$el = o(i), t.el = i, t.$el.data("ScrollToFixed", t); var n, s, r, l, d = !1,
            c = t.$el,
            p = 0,
            x = 0,
            f = -1,
            a = -1,
            u = null;

        function F() { var o = t.options.limit; return o ? "function" == typeof o ? o.apply(c) : o : 0 }

        function g() { return "fixed" === n }

        function T() { return "absolute" === n }

        function S() { return !(g() || T()) }

        function b() { g() || (u.css({ display: c.css("display"), width: c.outerWidth(!0), height: c.outerHeight(!0), float: c.css("float") }), cssOptions = { "z-index": t.options.zIndex, position: "fixed", top: -1 == t.options.bottom ? v() : "", bottom: -1 == t.options.bottom ? "" : t.options.bottom, "margin-left": "0px" }, t.options.dontSetWidth || (cssOptions.width = c.css("width")), c.css(cssOptions), c.addClass(t.options.baseClassName), t.options.className && c.addClass(t.options.className), n = "fixed") }

        function m() { var o = F(),
                i = x;
            t.options.removeOffsets && (i = "", o -= p), cssOptions = { position: "absolute", top: o, left: i, "margin-left": "0px", bottom: "" }, t.options.dontSetWidth || (cssOptions.width = c.css("width")), c.css(cssOptions), n = "absolute" }

        function w() { S() || (a = -1, u.css("display", "none"), c.css({ "z-index": l, width: "", position: s, left: "", top: r, "margin-left": "" }), c.removeClass("scroll-to-fixed-fixed"), t.options.className && c.removeClass(t.options.className), n = null) }

        function h(o) { o != a && (c.css("left", x - o), a = o) }

        function v() { var o = t.options.marginTop; return o ? "function" == typeof o ? o.apply(c) : o : 0 }

        function U() { if (o.isScrollToFixed(c)) { var i = d;
                d ? S() && (p = c.offset().top, x = c.offset().left) : (c.trigger("preUnfixed.ScrollToFixed"), w(), c.trigger("unfixed.ScrollToFixed"), a = -1, p = c.offset().top, x = c.offset().left, t.options.offsets && (x += c.offset().left - c.position().left), -1 == f && (f = x), n = c.css("position"), d = !0, -1 != t.options.bottom && (c.trigger("preFixed.ScrollToFixed"), b(), c.trigger("fixed.ScrollToFixed"))); var e = o(window).scrollLeft(),
                    r = o(window).scrollTop(),
                    l = F();
                t.options.minWidth && o(window).width() < t.options.minWidth ? S() && i || (A(), c.trigger("preUnfixed.ScrollToFixed"), w(), c.trigger("unfixed.ScrollToFixed")) : t.options.maxWidth && o(window).width() > t.options.maxWidth ? S() && i || (A(), c.trigger("preUnfixed.ScrollToFixed"), w(), c.trigger("unfixed.ScrollToFixed")) : -1 == t.options.bottom ? l > 0 && r >= l - v() ? T() && i || (A(), c.trigger("preAbsolute.ScrollToFixed"), m(), c.trigger("unfixed.ScrollToFixed")) : r >= p - v() ? (g() && i || (A(), c.trigger("preFixed.ScrollToFixed"), b(), a = -1, c.trigger("fixed.ScrollToFixed")), h(e)) : S() && i || (A(), c.trigger("preUnfixed.ScrollToFixed"), w(), c.trigger("unfixed.ScrollToFixed")) : l > 0 ? r + o(window).height() - c.outerHeight(!0) >= l - (v() || -(t.options.bottom ? t.options.bottom : 0)) ? g() && (A(), c.trigger("preUnfixed.ScrollToFixed"), "absolute" === s ? m() : w(), c.trigger("unfixed.ScrollToFixed")) : (g() || (A(), c.trigger("preFixed.ScrollToFixed"), b()), h(e), c.trigger("fixed.ScrollToFixed")) : h(e) } }

        function A() { var o = c.css("position"); "absolute" == o ? c.trigger("postAbsolute.ScrollToFixed") : "fixed" == o ? c.trigger("postFixed.ScrollToFixed") : c.trigger("postUnfixed.ScrollToFixed") } var z = function(o) { c.is(":visible") && (d = !1, U()) },
            y = function(o) { window.requestAnimationFrame ? requestAnimationFrame(U) : U() };
        t.init = function() { t.options = o.extend({}, o.ScrollToFixed.defaultOptions, e), l = c.css("z-index"), t.$el.css("z-index", t.options.zIndex), u = o("<div />"), n = c.css("position"), s = c.css("position"), r = c.css("top"), S() && t.$el.after(u), o(window).bind("resize.ScrollToFixed", z), o(window).bind("scroll.ScrollToFixed", y), "ontouchmove" in window && o(window).bind("touchmove.ScrollToFixed", U), t.options.preFixed && c.bind("preFixed.ScrollToFixed", t.options.preFixed), t.options.postFixed && c.bind("postFixed.ScrollToFixed", t.options.postFixed), t.options.preUnfixed && c.bind("preUnfixed.ScrollToFixed", t.options.preUnfixed), t.options.postUnfixed && c.bind("postUnfixed.ScrollToFixed", t.options.postUnfixed), t.options.preAbsolute && c.bind("preAbsolute.ScrollToFixed", t.options.preAbsolute), t.options.postAbsolute && c.bind("postAbsolute.ScrollToFixed", t.options.postAbsolute), t.options.fixed && c.bind("fixed.ScrollToFixed", t.options.fixed), t.options.unfixed && c.bind("unfixed.ScrollToFixed", t.options.unfixed), t.options.spacerClass && u.addClass(t.options.spacerClass), c.bind("resize.ScrollToFixed", function() { u.height(c.height()) }), c.bind("scroll.ScrollToFixed", function() { c.trigger("preUnfixed.ScrollToFixed"), w(), c.trigger("unfixed.ScrollToFixed"), U() }), c.bind("detach.ScrollToFixed", function(i) { var e;
                (e = (e = i) || window.event).preventDefault && e.preventDefault(), e.returnValue = !1, c.trigger("preUnfixed.ScrollToFixed"), w(), c.trigger("unfixed.ScrollToFixed"), o(window).unbind("resize.ScrollToFixed", z), o(window).unbind("scroll.ScrollToFixed", y), c.unbind(".ScrollToFixed"), u.remove(), t.$el.removeData("ScrollToFixed") }), z() }, t.init() }, o.ScrollToFixed.defaultOptions = { marginTop: 0, limit: 0, bottom: -1, zIndex: 1e3, baseClassName: "scroll-to-fixed-fixed" }, o.fn.scrollToFixed = function(i) { return this.each(function() { new o.ScrollToFixed(this, i) }) } }(jQuery), $(document).ready(function() { $("#spHeader, #header").wrapAll('<div id="fixedHeadeGnavi" />'), $("#fixedHeadeGnavi").scrollToFixed() });