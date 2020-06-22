!function(t) {
    "use strict";
    var e = t(window)
      , a = t("body")
      , o = t(document);
    function i() {
        return e.width()
    }
    "ontouchstart"in document.documentElement || a.addClass("no-touch");
    var n = i();
    e.on("resize", function() {
        n = i()
    });
    var s = t(".is-sticky")
      , l = t(".topbar")
      , r = t(".topbar-wrap");
    if (s.length > 0) {
        var c = s.offset();
        e.scroll(function() {
            var t = e.scrollTop()
              , a = l.height();
            t > c.top ? s.hasClass("has-fixed") || (s.addClass("has-fixed"),
            r.css("padding-top", a)) : s.hasClass("has-fixed") && (s.removeClass("has-fixed"),
            r.css("padding-top", 0))
        })
    }
    var d = t("[data-percent]");
    d.length > 0 && d.each(function() {
        var e = t(this)
          , a = e.data("percent");
        e.css("width", a + "%")
    });
    var g = window.location.href
      , h = g.split("#")
      , f = t("a");
    f.length > 0 && f.each(function() {
        g === this.href && "" !== h[1] && t(this).closest("li").addClass("active").parent().closest("li").addClass("active")
    });
    
    var v = t(".select");
    v.length > 0 && v.each(function() {
        t(this).select2({
            theme: "flat"
        })
    });
    var u = t(".select-bordered");
    u.length > 0 && u.each(function() {
        t(this).select2({
            theme: "flat bordered"
        })
    });
    var m = ".toggle-tigger";
    t(m).length > 0 && o.on("click", m, function(e) {
        var a = t(this);
        t(m).not(a).removeClass("active"),
        t(".toggle-class").not(a.parent().children()).removeClass("active"),
        a.toggleClass("active").parent().find(".toggle-class").toggleClass("active"),
        e.preventDefault()
    }),
    o.on("click", "body", function(e) {
        var a = t(m)
          , o = t(".toggle-class");
        o.is(e.target) || 0 !== o.has(e.target).length || a.is(e.target) || 0 !== a.has(e.target).length || (o.removeClass("active"),
        a.removeClass("active"))
    });
    var C = t(".toggle-nav")
      , b = t(".navbar");
    function w(t) {
        n < 991 ? t.delay(500).addClass("navbar-mobile") : t.delay(500).removeClass("navbar-mobile")
    }
    C.length > 0 && C.on("click", function(t) {
        C.toggleClass("active"),
        b.toggleClass("active"),
        t.preventDefault()
    }),
    o.on("click", "body", function(t) {
        C.is(t.target) || 0 !== C.has(t.target).length || b.is(t.target) || 0 !== b.has(t.target).length || (C.removeClass("active"),
        b.removeClass("active"))
    }),
    w(b),
    e.on("resize", function() {
        w(b)
    });
    
    
    var R = t(".drop-toggle");
    R.length > 0 && R.on("click", function(a) {
        e.width() < 991 && (t(this).parent().children(".navbar-dropdown").slideToggle(400),
        t(this).parent().siblings().children(".navbar-dropdown").slideUp(400),
        t(this).parent().toggleClass("current"),
        t(this).parent().siblings().removeClass("current"),
        a.preventDefault())
    });
    
}(jQuery);
