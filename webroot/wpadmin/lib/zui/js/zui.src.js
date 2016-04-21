/*!
 * ZUI - v1.3.0 - 2015-05-18
 * http://zui.sexy
 * GitHub: https://github.com/easysoft/zui.git
 * Copyright (c) 2015 cnezsoft.com; Licensed MIT
 */

/* Some code copy from Bootstrap v3.0.0 by @fat and @mdo. (Copyright 2013 Twitter, Inc. Licensed under http://www.apache.org/licenses/)*/

!
        function (a, b) {
            "use strict";
            if ("undefined" == typeof a)
                throw new Error("ZUI requires jQuery");
            a.zui || (a.zui = function (b) {
                a.isPlainObject(b) && a.extend(a.zui, b)
            });
            var c = 0;
            a.zui({
                uuid: function () {
                    return 1e3 * (new Date).getTime() + c++ % 1e3
                },
                callEvent: function (b, c, d) {
                    if (a.isFunction(b)) {
                        "undefined" != typeof d && (b = a.proxy(b, d));
                        var e = b(c);
                        return c && (c.result = e), !(void 0 !== e && !e)
                    }
                    return 1
                },
                clientLang: function () {
                    var c, d = b.config;
                    if ("undefined" != typeof d && d.clientLang)
                        c = d.clientLang;
                    else {
                        var e = a("html").attr("lang");
                        c = e ? e : navigator.userLanguage || navigator.userLanguage || "zh_cn"
                    }
                    return c.replace("-", "_").toLowerCase()
                }
            }), a.fn.callEvent = function (b, c, d) {
                var e = a(this),
                        f = b.indexOf(".zui."),
                        g = b;
                0 > f && d && d.name ? b += "." + d.name : g = b.substring(0, f);
                var h = a.Event(b, c);
                if ("undefined" == typeof d && f > 0 && (d = e.data(b.substring(f + 1))), d && d.options) {
                    var i = d.options[g];
                    a.isFunction(i) && a.zui.callEvent(d.options[g], h, d)
                }
                return h
            }
        }(jQuery, window), function () {
    "use strict";
    var a = "function";
    Array.prototype.forEach || (Array.prototype.forEach = function (b) {
        var c = this.length;
        if (typeof b != a)
            throw new TypeError;
        for (var d = arguments[1], e = 0; c > e; e++)
            e in this && b.call(d, this[e], e, this)
    }), Array.isArray || (Array.isArray = function (a) {
        return "[object Array]" === Object.toString.call(a)
    }), Array.prototype.lastIndexOf || (Array.prototype.lastIndexOf = function (a) {
        var b = this.length,
                c = Number(arguments[1]);
        for (isNaN(c) ? c = b - 1 : (c = 0 > c ? Math.ceil(c) : Math.floor(c), 0 > c ? c += b : c >= b && (c = b - 1)); c > - 1; c--)
            if (c in this && this[c] === a)
                return c;
        return -1
    }), Array.prototype.every || (Array.prototype.every = function (b) {
        var c = this.length;
        if (typeof b != a)
            throw new TypeError;
        for (var d = arguments[1], e = 0; c > e; e++)
            if (e in this && !b.call(d, this[e], e, this))
                return !1;
        return !0
    }), Array.prototype.filter || (Array.prototype.filter = function (b) {
        var c = this.length;
        if (typeof b != a)
            throw new TypeError;
        for (var d = [], e = arguments[1], f = 0; c > f; f++)
            if (f in this) {
                var g = this[f];
                b.call(e, g, f, this) && d.push(g)
            }
        return d
    }), Array.prototype.indexOf || (Array.prototype.indexOf = function (a) {
        var b = this.length,
                c = Number(arguments[1]) || 0;
        for (c = 0 > c ? Math.ceil(c) : Math.floor(c), 0 > c && (c += b); b > c; c++)
            if (c in this && this[c] === a)
                return c;
        return -1
    }), Array.prototype.map || (Array.prototype.map = function (b) {
        var c = this.length;
        if (typeof b != a)
            throw new TypeError;
        for (var d = new Array(c), e = arguments[1], f = 0; c > f; f++)
            f in this && (d[f] = b.call(e, this[f], f, this));
        return d
    }), Array.prototype.mawherep || (Array.prototype.where = function (b, c) {
        c = c || [];
        var d, e, f;
        return this.forEach(function (g) {
            e = !0;
            for (var h in b)
                if (d = b[h], typeof d === a ? e = d(g) : (f = g[h], e = f && f === d), !e)
                    break;
            e && c.push(g)
        }), c
    }), Array.prototype.groupBy || (Array.prototype.groupBy = function (a) {
        var b = {};
        return this.forEach(function (c) {
            var d = c[a];
            d || (d = "unkown"), b[d] || (b[d] = []), b[d].push(c)
        }), b
    }), Array.prototype.has || (Array.prototype.has = function (b) {
        var c, d, e, f = !1;
        return this.forEach(function (g) {
            d = !0;
            for (var h in b)
                if (c = b[h], typeof c === a ? d = c(g) : (e = g[h], d = e && e === c), !d)
                    break;
            return d ? (f = !0, !1) : void 0
        }), f
    })
}(), +
        function (a) {
            "use strict";
            var b = '[data-dismiss="alert"]',
                    c = "zui.alert",
                    d = function (c) {
                        a(c).on("click", b, this.close)
                    };
            d.prototype.close = function (b) {
                function d() {
                    g.trigger("closed." + c).remove()
                }
                var e = a(this),
                        f = e.attr("data-target");
                f || (f = e.attr("href"), f = f && f.replace(/.*(?=#[^\s]*$)/, ""));
                var g = a(f);
                b && b.preventDefault(), g.length || (g = e.hasClass("alert") ? e : e.parent()), g.trigger(b = a.Event("close." + c)), b.isDefaultPrevented() || (g.removeClass("in"), a.support.transition && g.hasClass("fade") ? g.one(a.support.transition.end, d).emulateTransitionEnd(150) : d())
            };
            var e = a.fn.alert;
            a.fn.alert = function (b) {
                return this.each(function () {
                    var e = a(this),
                            f = e.data(c);
                    f || e.data(c, f = new d(this)), "string" == typeof b && f[b].call(e)
                })
            }, a.fn.alert.Constructor = d, a.fn.alert.noConflict = function () {
                return a.fn.alert = e, this
            }, a(document).on("click." + c + ".data-api", b, d.prototype.close)
        }(window.jQuery), +
        function (a) {
            "use strict";
            var b = "zui.tab",
                    c = function (b) {
                        this.element = a(b)
                    };
            c.prototype.show = function () {
                var c = this.element,
                        d = c.closest("ul:not(.dropdown-menu)"),
                        e = c.attr("data-target");
                if (e || (e = c.attr("href"), e = e && e.replace(/.*(?=#[^\s]*$)/, "")), !c.parent("li").hasClass("active")) {
                    var f = d.find(".active:last a")[0],
                            g = a.Event("show." + b, {
                                relatedTarget: f
                            });
                    if (c.trigger(g), !g.isDefaultPrevented()) {
                        var h = a(e);
                        this.activate(c.parent("li"), d), this.activate(h, h.parent(), function () {
                            c.trigger({
                                type: "shown." + b,
                                relatedTarget: f
                            })
                        })
                    }
                }
            }, c.prototype.activate = function (b, c, d) {
                function e() {
                    f.removeClass("active").find("> .dropdown-menu > .active").removeClass("active"), b.addClass("active"), g ? (b[0].offsetWidth, b.addClass("in")) : b.removeClass("fade"), b.parent(".dropdown-menu") && b.closest("li.dropdown").addClass("active"), d && d()
                }
                var f = c.find("> .active"),
                        g = d && a.support.transition && f.hasClass("fade");
                g ? f.one(a.support.transition.end, e).emulateTransitionEnd(150) : e(), f.removeClass("in")
            };
            var d = a.fn.tab;
            a.fn.tab = function (d) {
                return this.each(function () {
                    var e = a(this),
                            f = e.data(b);
                    f || e.data(b, f = new c(this)), "string" == typeof d && f[d]()
                })
            }, a.fn.tab.Constructor = c, a.fn.tab.noConflict = function () {
                return a.fn.tab = d, this
            }, a(document).on("click.zui.tab.data-api", '[data-toggle="tab"], [data-toggle="pill"]', function (b) {
                b.preventDefault(), a(this).tab("show")
            })
        }(window.jQuery), +
        function (a) {
            "use strict";

            function b() {
                var a = document.createElement("bootstrap"),
                        b = {
                            WebkitTransition: "webkitTransitionEnd",
                            MozTransition: "transitionend",
                            OTransition: "oTransitionEnd otransitionend",
                            transition: "transitionend"
                        };
                for (var c in b)
                    if (void 0 !== a.style[c])
                        return {
                            end: b[c]
                        };
                return !1
            }
            a.fn.emulateTransitionEnd = function (b) {
                var c = !1,
                        d = this;
                a(this).one("bsTransitionEnd", function () {
                    c = !0
                });
                var e = function () {
                    c || a(d).trigger(a.support.transition.end)
                };
                return setTimeout(e, b), this
            }, a(function () {
                a.support.transition = b(), a.support.transition && (a.event.special.bsTransitionEnd = {
                    bindType: a.support.transition.end,
                    delegateType: a.support.transition.end,
                    handle: function (b) {
                        return a(b.target).is(this) ? b.handleObj.handler.apply(this, arguments) : void 0
                    }
                })
            })
        }(jQuery), +
        function (a) {
            "use strict";
            var b = "zui.collapse",
                    c = function (b, d) {
                        this.$element = a(b), this.options = a.extend({}, c.DEFAULTS, d), this.transitioning = null, this.options.parent && (this.$parent = a(this.options.parent)), this.options.toggle && this.toggle()
                    };
            c.DEFAULTS = {
                toggle: !0
            }, c.prototype.dimension = function () {
                var a = this.$element.hasClass("width");
                return a ? "width" : "height"
            }, c.prototype.show = function () {
                if (!this.transitioning && !this.$element.hasClass("in")) {
                    var c = a.Event("show." + b);
                    if (this.$element.trigger(c), !c.isDefaultPrevented()) {
                        var d = this.$parent && this.$parent.find("> .panel > .in");
                        if (d && d.length) {
                            var e = d.data(b);
                            if (e && e.transitioning)
                                return;
                            d.collapse("hide"), e || d.data(b, null)
                        }
                        var f = this.dimension();
                        this.$element.removeClass("collapse").addClass("collapsing")[f](0), this.transitioning = 1;
                        var g = function () {
                            this.$element.removeClass("collapsing").addClass("in")[f]("auto"), this.transitioning = 0, this.$element.trigger("shown." + b)
                        };
                        if (!a.support.transition)
                            return g.call(this);
                        var h = a.camelCase(["scroll", f].join("-"));
                        this.$element.one(a.support.transition.end, a.proxy(g, this)).emulateTransitionEnd(350)[f](this.$element[0][h])
                    }
                }
            }, c.prototype.hide = function () {
                if (!this.transitioning && this.$element.hasClass("in")) {
                    var c = a.Event("hide." + b);
                    if (this.$element.trigger(c), !c.isDefaultPrevented()) {
                        var d = this.dimension();
                        this.$element[d](this.$element[d]())[0].offsetHeight, this.$element.addClass("collapsing").removeClass("collapse").removeClass("in"), this.transitioning = 1;
                        var e = function () {
                            this.transitioning = 0, this.$element.trigger("hidden." + b).removeClass("collapsing").addClass("collapse")
                        };
                        return a.support.transition ? void this.$element[d](0).one(a.support.transition.end, a.proxy(e, this)).emulateTransitionEnd(350) : e.call(this)
                    }
                }
            }, c.prototype.toggle = function () {
                this[this.$element.hasClass("in") ? "hide" : "show"]()
            };
            var d = a.fn.collapse;
            a.fn.collapse = function (d) {
                return this.each(function () {
                    var e = a(this),
                            f = e.data(b),
                            g = a.extend({}, c.DEFAULTS, e.data(), "object" == typeof d && d);
                    f || e.data(b, f = new c(this, g)), "string" == typeof d && f[d]()
                })
            }, a.fn.collapse.Constructor = c, a.fn.collapse.noConflict = function () {
                return a.fn.collapse = d, this
            }, a(document).on("click." + b + ".data-api", "[data-toggle=collapse]", function (c) {
                var d, e = a(this),
                        f = e.attr("data-target") || c.preventDefault() || (d = e.attr("href")) && d.replace(/.*(?=#[^\s]+$)/, ""),
                        g = a(f),
                        h = g.data(b),
                        i = h ? "toggle" : e.data(),
                        j = e.attr("data-parent"),
                        k = j && a(j);
                h && h.transitioning || (k && k.find('[data-toggle=collapse][data-parent="' + j + '"]').not(e).addClass("collapsed"), e[g.hasClass("in") ? "addClass" : "removeClass"]("collapsed")), g.collapse(i)
            })
        }(window.jQuery), function (a, b) {
    "use strict";
    var c = 1200,
            d = 992,
            e = 768,
            f = {
                desktop: "screen-desktop",
                desktopLg: "screen-desktop-wide",
                tablet: "screen-tablet",
                phone: "screen-phone",
                isMobile: "device-mobile",
                isDesktop: "device-desktop"
            },
    g = b(a),
            h = function () {
                var a = g.width();
                b("html").toggleClass(f.desktop, a >= d && c > a).toggleClass(f.desktopLg, a >= c).toggleClass(f.tablet, a >= e && d > a).toggleClass(f.phone, e > a).toggleClass(f.isMobile, d > a).toggleClass(f.isDesktop, a >= d)
            };
    g.resize(h), h()
}(window, jQuery), function (a) {
    "use strict";
    var b = {
        zh_cn: '鎮ㄧ殑娴忚鍣ㄧ増鏈繃浣庯紝鏃犳硶浣撻獙鎵€鏈夊姛鑳斤紝寤鸿鍗囩骇鎴栬€呮洿鎹㈡祻瑙堝櫒銆� <a href="http://browsehappy.com/" target="_blank" class="alert-link">浜嗚В鏇村...</a>',
        zh_tw: '鎮ㄧ殑鐎忚鍣ㄧ増鏈亷浣庯紝鐒℃硶楂旈鎵€鏈夊姛鑳斤紝寤鸿鍗囩礆鎴栬€呮洿鎹㈢€忚鍣ㄣ€�<a href="http://browsehappy.com/" target="_blank" class="alert-link">浜嗚В鏇村...</a>',
        en: 'Your browser is too old, it has been unable to experience the colorful internet. We strongly recommend that you upgrade a better one. <a href="http://browsehappy.com/" target="_blank" class="alert-link">Learn more...</a>'
    },
    c = function () {
        var a = this.isIE,
                b = a();
        if (b)
            for (var c = 10; c > 5; c--)
                if (a(c)) {
                    b = c;
                    break
                }
        this.ie = b, this.cssHelper()
    };
    c.prototype.cssHelper = function () {
        var b = this.ie,
                c = a("html");
        c.toggleClass("ie", b).removeClass("ie-6 ie-7 ie-8 ie-9 ie-10"), b && c.addClass("ie-" + b).toggleClass("gt-ie-7 gte-ie-8 support-ie", b >= 8).toggleClass("lte-ie-7 lt-ie-8 outdated-ie", 8 > b).toggleClass("gt-ie-8 gte-ie-9", b >= 9).toggleClass("lte-ie-8 lt-ie-9", 9 > b).toggleClass("gt-ie-9 gte-ie-10", b >= 10).toggleClass("lte-ie-9 lt-ie-10", 10 > b)
    }, c.prototype.tip = function () {
        if (this.ie && this.ie < 8) {
            var c = a("#browseHappyTip");
            c.length || (c = a('<div id="browseHappyTip" class="alert alert-dismissable alert-danger alert-block" style="position: relative; z-index: 99999"><button type="button" class="close" data-dismiss="alert" aria-hidden="true">脳</button><div class="container"><div class="content text-center"></div></div></div>'), c.prependTo("body")), c.find(".content").html(this.browseHappyTip || b[a.zui.clientLang() || "zh_cn"])
        }
    }, c.prototype.isIE = function (a) {
        var b = document.createElement("b");
        return b.innerHTML = "<!--[if IE " + (a || "") + "]><i></i><![endif]-->", 1 === b.getElementsByTagName("i").length
    }, c.prototype.isIE10 = function () {
        return !1
    }, a.zui({
        browser: new c
    }), a(function () {
        a("body").hasClass("disabled-browser-tip") || a.zui.browser.tip()
    })
}(jQuery), function () {
    "use strict";
    Date.ONEDAY_TICKS = 864e5, Date.prototype.format || (Date.prototype.format = function (a) {
        var b = {
            "M+": this.getMonth() + 1,
            "d+": this.getDate(),
            "h+": this.getHours(),
            "m+": this.getMinutes(),
            "s+": this.getSeconds(),
            "q+": Math.floor((this.getMonth() + 3) / 3),
            "S+": this.getMilliseconds()
        };
        /(y+)/i.test(a) && (a = a.replace(RegExp.$1, (this.getFullYear() + "").substr(4 - RegExp.$1.length)));
        for (var c in b)
            new RegExp("(" + c + ")").test(a) && (a = a.replace(RegExp.$1, 1 == RegExp.$1.length ? b[c] : ("00" + b[c]).substr(("" + b[c]).length)));
        return a
    }), Date.prototype.addMilliseconds || (Date.prototype.addMilliseconds = function (a) {
        return this.setTime(this.getTime() + a), this
    }), Date.prototype.addDays || (Date.prototype.addDays = function (a) {
        return this.addMilliseconds(a * Date.ONEDAY_TICKS), this
    }), Date.prototype.clone || (Date.prototype.clone = function () {
        var a = new Date;
        return a.setTime(this.getTime()), a
    }), Date.isLeapYear || (Date.isLeapYear = function (a) {
        return a % 4 === 0 && a % 100 !== 0 || a % 400 === 0
    }), Date.getDaysInMonth || (Date.getDaysInMonth = function (a, b) {
        return [31, Date.isLeapYear(a) ? 29 : 28, 31, 30, 31, 30, 31, 31, 30, 31, 30, 31][b]
    }), Date.prototype.isLeapYear || (Date.prototype.isLeapYear = function () {
        return Date.isLeapYear(this.getFullYear())
    }), Date.prototype.clearTime || (Date.prototype.clearTime = function () {
        return this.setHours(0), this.setMinutes(0), this.setSeconds(0), this.setMilliseconds(0), this
    }), Date.prototype.getDaysInMonth || (Date.prototype.getDaysInMonth = function () {
        return Date.getDaysInMonth(this.getFullYear(), this.getMonth())
    }), Date.prototype.addMonths || (Date.prototype.addMonths = function (a) {
        var b = this.getDate();
        return this.setDate(1), this.setMonth(this.getMonth() + a), this.setDate(Math.min(b, this.getDaysInMonth())), this
    }), Date.prototype.getLastWeekday || (Date.prototype.getLastWeekday = function (a) {
        a = a || 1;
        for (var b = this.clone(); b.getDay() != a; )
            b.addDays(-1);
        return b.clearTime(), b
    }), Date.prototype.isSameDay || (Date.prototype.isSameDay = function (a) {
        return a.toDateString() === this.toDateString()
    }), Date.prototype.isSameWeek || (Date.prototype.isSameWeek = function (a) {
        var b = this.getLastWeekday(),
                c = b.clone().addDays(7);
        return a >= b && c > a
    }), Date.prototype.isSameYear || (Date.prototype.isSameYear = function (a) {
        return this.getFullYear() === a.getFullYear()
    })
}(), function () {
    "use strict";
    String.prototype.format || (String.prototype.format = function (a) {
        var b = this;
        if (arguments.length > 0) {
            var c;
            if (1 == arguments.length && "object" == typeof a)
                for (var d in a)
                    void 0 !== a[d] && (c = new RegExp("({" + d + "})", "g"), b = b.replace(c, a[d]));
            else
                for (var e = 0; e < arguments.length; e++)
                    void 0 !== arguments[e] && (c = new RegExp("({[" + e + "]})", "g"), b = b.replace(c, arguments[e]))
        }
        return b
    }), String.prototype.isNum || (String.prototype.isNum = function (a) {
        if (null !== a) {
            var b, c;
            return c = /\d*/i, b = a.match(c), b == a ? !0 : !1
        }
        return !1
    })
}(), function (a, b, c) {
    "$:nomunge";

    function d() {
        e = b[h](function () {
            f.each(function () {
                var b = a(this),
                        c = b.width(),
                        d = b.height(),
                        e = a.data(this, j);
                (c !== e.w || d !== e.h) && b.trigger(i, [e.w = c, e.h = d])
            }), d()
        }, g[k])
    }
    var e, f = a([]),
            g = a.resize = a.extend(a.resize, {}),
            h = "setTimeout",
            i = "resize",
            j = i + "-special-event",
            k = "delay",
            l = "throttleWindow";
    g[k] = 250, g[l] = !0, a.event.special[i] = {
        setup: function () {
            if (!g[l] && this[h])
                return !1;
            var b = a(this);
            f = f.add(b), a.data(this, j, {
                w: b.width(),
                h: b.height()
            }), 1 === f.length && d()
        },
        teardown: function () {
            if (!g[l] && this[h])
                return !1;
            var b = a(this);
            f = f.not(b), b.removeData(j), f.length || clearTimeout(e)
        },
        add: function (b) {
            function d(b, d, f) {
                var g = a(this),
                        h = a.data(this, j) || {};
                h.w = d !== c ? d : g.width(), h.h = f !== c ? f : g.height(), e.apply(this, arguments)
            }
            if (!g[l] && this[h])
                return !1;
            var e;
            return a.isFunction(b) ? (e = b, d) : (e = b.handler, void(b.handler = d))
        }
    }
}(jQuery, this), +
        function (a) {
            "use strict";

            function b(d, e) {
                var f, g = a.proxy(this.process, this);
                this.$element = a(a(d).is("body") ? window : d), this.$body = a("body"), this.$scrollElement = this.$element.on("scroll. " + c + " .data-api", g), this.options = a.extend({}, b.DEFAULTS, e), this.selector || (this.selector = (this.options.target || (f = a(d).attr("href")) && f.replace(/.*(?=#[^\s]+$)/, "") || "") + " .nav li > a"), this.offsets = a([]), this.targets = a([]), this.activeTarget = null, this.refresh(), this.process()
            }
            var c = "zui.scrollspy";
            b.DEFAULTS = {
                offset: 10
            }, b.prototype.refresh = function () {
                var b = this.$element[0] == window ? "offset" : "position";
                this.offsets = a([]), this.targets = a([]);
                {
                    var c = this;
                    this.$body.find(this.selector).map(function () {
                        var d = a(this),
                                e = d.data("target") || d.attr("href"),
                                f = /^#./.test(e) && a(e);
                        return f && f.length && f.is(":visible") && [
                            [f[b]().top + (!a.isWindow(c.$scrollElement.get(0)) && c.$scrollElement.scrollTop()), e]
                        ] || null
                    }).sort(function (a, b) {
                        return a[0] - b[0]
                    }).each(function () {
                        c.offsets.push(this[0]), c.targets.push(this[1])
                    })
                }
            }, b.prototype.process = function () {
                var a, b = this.$scrollElement.scrollTop() + this.options.offset,
                        c = this.$scrollElement[0].scrollHeight || this.$body[0].scrollHeight,
                        d = c - this.$scrollElement.height(),
                        e = this.offsets,
                        f = this.targets,
                        g = this.activeTarget;
                if (b >= d)
                    return g != (a = f.last()[0]) && this.activate(a);
                if (g && b <= e[0])
                    return g != (a = f[0]) && this.activate(a);
                for (a = e.length; a--; )
                    g != f[a] && b >= e[a] && (!e[a + 1] || b <= e[a + 1]) && this.activate(f[a])
            }, b.prototype.activate = function (b) {
                this.activeTarget = b, a(this.selector).parentsUntil(this.options.target, ".active").removeClass("active");
                var d = this.selector + '[data-target="' + b + '"],' + this.selector + '[href="' + b + '"]',
                        e = a(d).parents("li").addClass("active");
                e.parent(".dropdown-menu").length && (e = e.closest("li.dropdown").addClass("active")), e.trigger("activate." + c)
            };
            var d = a.fn.scrollspy;
            a.fn.scrollspy = function (d) {
                return this.each(function () {
                    var e = a(this),
                            f = e.data(c),
                            g = "object" == typeof d && d;
                    f || e.data(c, f = new b(this, g)), "string" == typeof d && f[d]()
                })
            }, a.fn.scrollspy.Constructor = b, a.fn.scrollspy.noConflict = function () {
                return a.fn.scrollspy = d, this
            }, a(window).on("load", function () {
                a('[data-spy="scroll"]').each(function () {
                    var b = a(this);
                    b.scrollspy(b.data())
                })
            })
        }(jQuery), function (a, b) {
    "use strict";
    var c = "localStorage",
            d = a[c],
            e = (a.store, "page_" + a.location.pathname + a.location.search),
            f = function () {
                this.slience = !0, this.enable = c in a && a[c] && a[c].setItem, this.storage = d, this.page = this.get(e, {})
            };
    f.prototype.pageSave = function () {
        if (b.isEmptyObject(this.page))
            this.remove(e);
        else {
            var a, c = [];
            for (a in this.page) {
                var d = this.page[a];
                null === d && c.push(a)
            }
            for (a = c.length - 1; a >= 0; a--)
                delete this.page[c[a]];
            this.set(e, this.page)
        }
    }, f.prototype.pageRemove = function (a) {
        "undefined" != typeof this.page[a] && (this.page[a] = null, this.pageSave())
    }, f.prototype.pageClear = function () {
        this.page = {}, this.pageSave()
    }, f.prototype.pageGet = function (a, b) {
        var c = this.page[a];
        return void 0 === b || null !== c && void 0 !== c ? c : b
    }, f.prototype.pageSet = function (a, c) {
        b.isPlainObject(a) ? b.extend(!0, this.page, a) : this.page[this.serialize(a)] = c, this.pageSave()
    }, f.prototype.check = function () {
        if (!this.enable && !this.slience)
            throw new Error("Browser not support localStorage or enable status been set true.");
        return this.enable
    }, f.prototype.length = function () {
        return this.check() ? d.getLength ? d.getLength() : d.length : 0
    }, f.prototype.removeItem = function (a) {
        return d.removeItem(a), this
    }, f.prototype.remove = function (a) {
        return this.removeItem(a)
    }, f.prototype.getItem = function (a) {
        return d.getItem(a)
    }, f.prototype.get = function (a, b) {
        var c = this.deserialize(this.getItem(a));
        return "undefined" != typeof c && null !== c || "undefined" == typeof b ? c : b
    }, f.prototype.key = function (a) {
        return d.key(a)
    }, f.prototype.setItem = function (a, b) {
        return d.setItem(a, b), this
    }, f.prototype.set = function (a, b) {
        return void 0 === b ? this.remove(a) : (this.setItem(a, this.serialize(b)), this)
    }, f.prototype.clear = function () {
        return d.clear(), this
    }, f.prototype.forEach = function (a) {
        for (var b = d.length - 1; b >= 0; b--) {
            var c = d.key(b);
            a(c, this.get(c))
        }
        return this
    }, f.prototype.getAll = function () {
        var a = {};
        return this.forEach(function (b, c) {
            a[b] = c
        }), a
    }, f.prototype.serialize = function (a) {
        return "string" == typeof a ? a : JSON.stringify(a)
    }, f.prototype.deserialize = function (a) {
        if ("string" != typeof a)
            return void 0;
        try {
            return JSON.parse(a)
        } catch (b) {
            return a || void 0
        }
    }, b.zui({
        store: new f
    })
}(window, jQuery), function (a) {
    "use strict";
    var b = function (b, c) {
        this.$ = a(b), this.options = this.getOptions(c), this.init()
    };
    b.DEFAULTS = {
        container: "body",
        move: !0
    }, b.prototype.getOptions = function (c) {
        return c = a.extend({}, b.DEFAULTS, this.$.data(), c)
    }, b.prototype.init = function () {
        this.handleMouseEvents()
    }, b.prototype.handleMouseEvents = function () {
        var b, c, d, e, f, g = this.$,
                h = "before",
                i = "drag",
                j = "finish",
                k = this.options,
                l = function (i) {
                    if (k.hasOwnProperty(h) && a.isFunction(k[h])) {
                        var j = k[h]({
                            event: i,
                            element: g
                        });
                        if (void 0 !== j && !j)
                            return
                    }
                    var l = a(k.container),
                            o = g.offset();
                    c = l.offset(), b = {
                        x: i.pageX,
                        y: i.pageY
                    }, d = {
                        x: i.pageX - o.left + c.left,
                        y: i.pageY - o.top + c.top
                    }, e = a.extend({}, b), f = !1, g.addClass("drag-ready"), a(document).bind("mousemove", m).bind("mouseup", n), i.preventDefault(), k.stopPropagation && i.stopPropagation()
                },
                m = function (c) {
                    f = !0;
                    var h = c.pageX,
                            j = c.pageY,
                            l = {
                                left: h - d.x,
                                top: j - d.y
                            };
                    g.removeClass("drag-ready").addClass("dragging"), k.move && g.css(l), k.hasOwnProperty(i) && a.isFunction(k[i]) && k[i]({
                        event: c,
                        element: g,
                        startOffset: d,
                        pos: l,
                        offset: {
                            x: h - b.x,
                            y: j - b.y
                        },
                        smallOffset: {
                            x: h - e.x,
                            y: j - e.y
                        }
                    }), e.x = h, e.y = j, k.stopPropagation && c.stopPropagation()
                },
                n = function (c) {
                    if (a(document).unbind("mousemove", m).unbind("mouseup", n), !f)
                        return void g.removeClass("drag-ready");
                    var h = {
                        left: c.pageX - d.x,
                        top: c.pageY - d.y
                    };
                    g.removeClass("drag-ready").removeClass("dragging"), k.move && g.css(h), k.hasOwnProperty(j) && a.isFunction(k[j]) && k[j]({
                        event: c,
                        element: g,
                        pos: h,
                        offset: {
                            x: c.pageX - b.x,
                            y: c.pageY - b.y
                        },
                        smallOffset: {
                            x: c.pageX - e.x,
                            y: c.pageY - e.y
                        }
                    }), c.preventDefault(), k.stopPropagation && c.stopPropagation()
                };
        k.handle ? g.on("mousedown", k.handle, l) : g.on("mousedown", l)
    }, a.fn.draggable = function (c) {
        return this.each(function () {
            var d = a(this),
                    e = d.data("zui.draggable"),
                    f = "object" == typeof c && c;
            e || d.data("zui.draggable", e = new b(this, f)), "string" == typeof c && e[c]()
        })
    }, a.fn.draggable.Constructor = b
}(jQuery), function (a, b, c) {
    "use strict";
    var d = function (b, c) {
        this.$ = a(b), this.options = this.getOptions(c), this.init()
    };
    d.DEFAULTS = {
        container: "body",
        deviation: 5,
        sensorOffsetX: 0,
        sensorOffsetY: 0
    }, d.prototype.getOptions = function (b) {
        return b = a.extend({}, d.DEFAULTS, this.$.data(), b)
    }, d.prototype.callEvent = function (b, c) {
        return a.zui.callEvent(this.options[b], c, this)
    }, d.prototype.init = function () {
        this.handleMouseEvents()
    }, d.prototype.handleMouseEvents = function () {
        var d = this.$,
                e = this,
                f = this.options,
                g = "before";
        this.$triggerTarget = f.trigger ? (a.isFunction(f.trigger) ? f.trigger(d) : d.find(f.trigger)).first() : d, this.$triggerTarget.on("mousedown", function (h) {
            function i(b) {
                var g = {
                    left: b.pageX,
                    top: b.pageY
                };
                if (!(c.abs(g.left - t.left) < f.deviation && c.abs(g.top - t.top) < f.deviation)) {
                    if (null === o) {
                        var h = p.css("position");
                        "absolute" != h && "relative" != h && "fixed" != h && (l = h, p.css("position", "relative")), o = d.clone().removeClass("drag-from").addClass("drag-shadow").css({
                            position: "absolute",
                            width: d.outerWidth(),
                            transition: "none"
                        }).appendTo(p), d.addClass("dragging"), e.callEvent("start", {
                            event: b,
                            element: d
                        })
                    }
                    var i = {
                        left: g.left - v.left,
                        top: g.top - v.top
                    },
                    j = {
                        left: i.left - u.left,
                        top: i.top - u.top
                    };
                    o.css(j), w.left = g.left, w.top = g.top;
                    var k = !1;
                    q = !1, f.flex || m.removeClass("drop-to");
                    var s = null;
                    if (m.each(function () {
                        var b = a(this),
                                c = b.offset(),
                                d = b.outerWidth(),
                                e = b.outerHeight(),
                                h = c.left + f.sensorOffsetX,
                                i = c.top + f.sensorOffsetY;
                        return g.left > h && g.top > i && g.left < h + d && g.top < i + e && (s && s.removeClass("drop-to"), s = b, !f.nested) ? !1 : void 0
                    }), s) {
                        q = !0;
                        var x = s.data("id");
                        d.data("id") != x && (r = !1), (null === n || n.data("id") !== x && !r) && (k = !0), n = s, f.flex && m.removeClass("drop-to"), n.addClass("drop-to")
                    }
                    f.flex ? null !== n && n.length && (q = !0) : (d.toggleClass("drop-in", q), o.toggleClass("drop-in", q)), e.callEvent("drag", {
                        event: b,
                        isIn: q,
                        target: n,
                        element: d,
                        isNew: k,
                        selfTarget: r,
                        clickOffset: v,
                        offset: i,
                        position: {
                            left: i.left - u.left,
                            top: i.top - u.top
                        },
                        mouseOffset: g
                    }), b.preventDefault()
                }
            }
            function j(c) {
                if (l && p.css("position", l), null === o)
                    return d.removeClass("drag-from"), a(b).unbind("mousemove", i).unbind("mouseup", j), void e.callEvent("always", {
                        event: c,
                        cancel: !0
                    });
                q || (n = null);
                var f = !0,
                        g = {
                            left: c.pageX,
                            top: c.pageY
                        },
                h = {
                    left: g.left - v.left,
                    top: g.top - v.top
                },
                k = {
                    left: g.left - w.left,
                    top: g.top - w.top
                };
                w.left = g.left, w.top = g.top;
                var s = {
                    event: c,
                    isIn: q,
                    target: n,
                    element: d,
                    isNew: !r && null !== n,
                    selfTarget: r,
                    offset: h,
                    mouseOffset: g,
                    position: {
                        left: h.left - u.left,
                        top: h.top - u.top
                    },
                    lastMouseOffset: w,
                    moveOffset: k
                };
                f = e.callEvent("beforeDrop", s), f && q && e.callEvent("drop", s), a(b).unbind("mousemove", i).unbind("mouseup", j), m.removeClass("drop-to"), d.removeClass("dragging").removeClass("drag-from"), o.remove(), e.callEvent("finish", s), e.callEvent("always", s), c.preventDefault()
            }
            if (f.hasOwnProperty(g) && a.isFunction(f[g])) {
                var k = f[g]({
                    event: h,
                    element: d
                });
                if (void 0 !== k && !k)
                    return
            }
            var l, m = a.isFunction(f.target) ? f.target(d) : a(f.target),
                    n = null,
                    o = null,
                    p = a(f.container).first(),
                    q = !1,
                    r = !0,
                    s = d.offset(),
                    t = {
                        left: h.pageX,
                        top: h.pageY
                    },
            u = p.offset(),
                    v = {
                        left: t.left - s.left,
                        top: t.top - s.top
                    },
            w = {
                left: t.left,
                top: t.top
            };
            d.addClass("drag-from"), a(b).bind("mousemove", i).bind("mouseup", j), h.preventDefault()
        })
    }, d.prototype.reset = function () {
        this.$triggerTarget.off("mousedown"), this.handleMouseEvents()
    }, a.fn.droppable = function (b) {
        return this.each(function () {
            var c = a(this),
                    e = c.data("zui.droppable"),
                    f = "object" == typeof b && b;
            e || c.data("zui.droppable", e = new d(this, f)), "string" == typeof b && e[b]()
        })
    }, a.fn.droppable.Constructor = d
}(jQuery, document, Math), +
        function (a, b, c, d) {
            "use strict";
            var e = function (b, c) {
                this.$ = a(b), this.options = this.getOptions(c), this.init()
            };
            e.DEFAULTS = {
                selector: "li, div",
                dragCssClass: "invisible"
            }, e.prototype.getOptions = function (b) {
                return b = a.extend({}, e.DEFAULTS, this.$.data(), b)
            }, e.prototype.init = function () {
                this.bindEventToList(this.$.children(this.options.selector))
            }, e.prototype.reset = function () {
                var b = this,
                        c = this.$.children(this.options.selector).not(".drag-shadow");
                c.each(function () {
                    var d = a(this);
                    d.data("zui.droppable") ? (d.data("zui.droppable").options.target = c, d.droppable("reset")) : b.bindEventToList(d)
                })
            }, e.prototype.bindEventToList = function (b) {
                function c(b) {
                    var c = [];
                    b.each(function () {
                        var b = a(this).data("order");
                        "number" == typeof b && c.push(b)
                    }), c.sort(function (a, b) {
                        return a - b
                    });
                    for (var d = b.length; c.length < d; )
                        c.push(c.length ? c[c.length - 1] + 1 : 0);
                    e.reverse && c.reverse();
                    var f = 0;
                    b.each(function () {
                        a(this).attr("data-order", c[f++])
                    })
                }
                var d = this.$,
                        e = this.options;
                c(b), b.droppable({
                    trigger: e.trigger,
                    target: d.children(e.selector),
                    container: d,
                    always: e.always,
                    flex: !0,
                    start: function (b) {
                        e.dragCssClass && b.element.addClass(e.dragCssClass), a.zui.callEvent(e.start)
                    },
                    drag: function (b) {
                        if (d.addClass("sortable-sorting"), b.isIn) {
                            var f = b.element,
                                    g = b.target,
                                    h = f.attr("data-order"),
                                    i = g.attr("data-order");
                            if (h == i)
                                return;
                            h > i ? g.before(f) : g.after(f);
                            var j = d.children(e.selector).not(".drag-shadow");
                            c(j), a.zui.callEvent(e.order, {
                                list: j,
                                element: f
                            })
                        }
                    },
                    finish: function (b) {
                        e.dragCssClass && b.element && b.element.removeClass(e.dragCssClass), a.zui.callEvent(e.finish, {
                            list: d.children(e.selector),
                            element: b.element
                        }), d.removeClass("sortable-sorting")
                    }
                })
            }, a.fn.sortable = function (b) {
                return this.each(function () {
                    var c = a(this),
                            d = c.data("zui.sortable"),
                            f = "object" == typeof b && b;
                    d ? "object" == typeof b && d.reset() : c.data("zui.sortable", d = new e(this, f)), "string" == typeof b && d[b]()
                })
            }, a.fn.sortable.Constructor = e
        }(jQuery, window, document, Math), +
        function (a) {
            "use strict";

            function b(b, e, f) {
                return this.each(function () {
                    var g = a(this),
                            h = g.data(c),
                            i = a.extend({}, d.DEFAULTS, g.data(), "object" == typeof b && b);
                    h || g.data(c, h = new d(this, i)), "string" == typeof b ? h[b](e, f) : i.show && h.show(e, f)
                })
            }
            var c = "zui.modal",
                    d = function (b, d) {
                        this.options = d, this.$body = a(document.body), this.$element = a(b), this.$backdrop = this.isShown = null, this.scrollbarWidth = 0, "undefined" == typeof this.options.moveable && (this.options.moveable = this.$element.hasClass("modal-moveable")), this.options.remote && this.$element.find(".modal-content").load(this.options.remote, a.proxy(function () {
                            this.$element.trigger("loaded." + c)
                        }, this))
                    };
            d.VERSION = "3.2.0", d.TRANSITION_DURATION = 300, d.BACKDROP_TRANSITION_DURATION = 150, d.DEFAULTS = {
                backdrop: !0,
                keyboard: !0,
                show: !0,
                rememberPos: !0,
                position: "fit"
            }, d.prototype.toggle = function (a, b) {
                return this.isShown ? this.hide() : this.show(a, b)
            }, d.prototype.ajustPosition = function (b) {
                if ("undefined" == typeof b && (b = this.options.position), "undefined" != typeof b) {
                    var c = this.$element.find(".modal-dialog"),
                            d = Math.max(0, (a(window).height() - c.outerHeight()) / 2),
                            e = "fit" == b ? 2 * d / 3 : "center" == b ? d : b;
                    if (c.hasClass("modal-moveable")) {
                        var f = this.options.rememberPos ? this.$element.data("modal-pos") : null;
                        f || (f = {
                            left: Math.max(0, (a(window).width() - c.outerWidth()) / 2),
                            top: e
                        }), c.css(f)
                    } else
                        c.css("margin-top", e)
                }
            }, d.prototype.setMoveale = function () {
                var a = this,
                        b = a.options,
                        c = a.$element.find(".modal-dialog").removeClass("modal-dragged");
                c.toggleClass("modal-moveable", b.moveable), a.$element.data("modal-moveable-setup") || c.draggable({
                    container: a.$element,
                    handle: ".modal-header",
                    before: function () {
                        c.css("margin-top", "").addClass("modal-dragged")
                    },
                    finish: function (b) {
                        a.$element.data("modal-pos", b.pos)
                    }
                })
            }, d.prototype.show = function (b, e) {
                var f = this,
                        g = a.Event("show." + c, {
                            relatedTarget: b
                        });
                f.$element.trigger(g), f.isShown || g.isDefaultPrevented() || (f.isShown = !0, f.options.draggable && f.setMoveale(), f.checkScrollbar(), f.$body.addClass("modal-open"), f.setScrollbar(), f.escape(), f.$element.on("click.dismiss." + c, '[data-dismiss="modal"]', a.proxy(f.hide, f)), f.backdrop(function () {
                    var g = a.support.transition && f.$element.hasClass("fade");
                    f.$element.parent().length || f.$element.appendTo(f.$body), f.$element.show().scrollTop(0), g && f.$element[0].offsetWidth, f.$element.addClass("in").attr("aria-hidden", !1), f.ajustPosition(e), f.enforceFocus();
                    var h = a.Event("shown." + c, {
                        relatedTarget: b
                    });
                    g ? f.$element.find(".modal-dialog").one("bsTransitionEnd", function () {
                        f.$element.trigger("focus").trigger(h)
                    }).emulateTransitionEnd(d.TRANSITION_DURATION) : f.$element.trigger("focus").trigger(h)
                }))
            }, d.prototype.hide = function (b) {
                b && b.preventDefault(), b = a.Event("hide." + c), this.$element.trigger(b), this.isShown && !b.isDefaultPrevented() && (this.isShown = !1, this.$body.removeClass("modal-open"), this.resetScrollbar(), this.escape(), a(document).off("focusin." + c), this.$element.removeClass("in").attr("aria-hidden", !0).off("click.dismiss." + c), a.support.transition && this.$element.hasClass("fade") ? this.$element.one("bsTransitionEnd", a.proxy(this.hideModal, this)).emulateTransitionEnd(d.TRANSITION_DURATION) : this.hideModal())
            }, d.prototype.enforceFocus = function () {
                a(document).off("focusin." + c).on("focusin." + c, a.proxy(function (a) {
                    this.$element[0] === a.target || this.$element.has(a.target).length || this.$element.trigger("focus")
                }, this))
            }, d.prototype.escape = function () {
                this.isShown && this.options.keyboard ? a(document).on("keydown.dismiss." + c, a.proxy(function (b) {
                    if (27 == b.which) {
                        var d = a.Event("escaping." + c),
                                e = this.$element.triggerHandler(d, "esc");
                        if (void 0 != e && !e)
                            return;
                        this.hide()
                    }
                }, this)) : this.isShown || a(document).off("keydown.dismiss." + c)
            }, d.prototype.hideModal = function () {
                var a = this;
                this.$element.hide(), this.backdrop(function () {
                    a.$element.trigger("hidden." + c)
                })
            }, d.prototype.removeBackdrop = function () {
                this.$backdrop && this.$backdrop.remove(), this.$backdrop = null
            }, d.prototype.backdrop = function (b) {
                var e = this,
                        f = this.$element.hasClass("fade") ? "fade" : "";
                if (this.isShown && this.options.backdrop) {
                    var g = a.support.transition && f;
                    if (this.$backdrop = a('<div class="modal-backdrop ' + f + '" />').appendTo(this.$body), this.$element.on("mousedown.dismiss." + c, a.proxy(function (a) {
                        a.target === a.currentTarget && ("static" == this.options.backdrop ? this.$element[0].focus.call(this.$element[0]) : this.hide.call(this))
                    }, this)), g && this.$backdrop[0].offsetWidth, this.$backdrop.addClass("in"), !b)
                        return;
                    g ? this.$backdrop.one("bsTransitionEnd", b).emulateTransitionEnd(d.BACKDROP_TRANSITION_DURATION) : b()
                } else if (!this.isShown && this.$backdrop) {
                    this.$backdrop.removeClass("in");
                    var h = function () {
                        e.removeBackdrop(), b && b()
                    };
                    a.support.transition && this.$element.hasClass("fade") ? this.$backdrop.one("bsTransitionEnd", h).emulateTransitionEnd(d.BACKDROP_TRANSITION_DURATION) : h()
                } else
                    b && b()
            }, d.prototype.checkScrollbar = function () {
                document.body.clientWidth >= window.innerWidth || (this.scrollbarWidth = this.scrollbarWidth || this.measureScrollbar())
            }, d.prototype.setScrollbar = function () {
                var a = parseInt(this.$body.css("padding-right") || 0, 10);
                this.scrollbarWidth && this.$body.css("padding-right", a + this.scrollbarWidth)
            }, d.prototype.resetScrollbar = function () {
                this.$body.css("padding-right", "")
            }, d.prototype.measureScrollbar = function () {
                var a = document.createElement("div");
                a.className = "modal-scrollbar-measure", this.$body.append(a);
                var b = a.offsetWidth - a.clientWidth;
                return this.$body[0].removeChild(a), b
            };
            var e = a.fn.modal;
            a.fn.modal = b, a.fn.modal.Constructor = d, a.fn.modal.noConflict = function () {
                return a.fn.modal = e, this
            }, a(document).on("click." + c + ".data-api", '[data-toggle="modal"]', function (d) {
                var e = a(this),
                        f = e.attr("href"),
                        g = null;
                try {
                    g = a(e.attr("data-target") || f && f.replace(/.*(?=#[^\s]+$)/, ""))
                } catch (h) {
                    return
                }
                if (g.length) {
                    var i = g.data(c) ? "toggle" : a.extend({
                        remote: !/#/.test(f) && f
                    }, g.data(), e.data());
                    e.is("a") && d.preventDefault(), g.one("show." + c, function (a) {
                        a.isDefaultPrevented() || g.one("hidden." + c, function () {
                            e.is(":visible") && e.trigger("focus")
                        })
                    }), b.call(g, i, this, e.data("position"))
                }
            })
        }(jQuery), function (a, b) {
    "use strict";
    if (!a.fn.modal)
        throw new Error("Modal trigger requires modal.js");
    var c = "zui.modaltrigger",
            d = "ajax",
            e = ".zui.modal",
            f = "string",
            g = function (b) {
                b = a.extend({}, g.DEFAULTS, a.ModalTriggerDefaults, b), this.isShown, this.options = b, this.id = a.zui.uuid()
            };
    g.DEFAULTS = {
        type: "custom",
        height: "auto",
        name: "triggerModal",
        fade: !0,
        position: "fit",
        showHeader: !0,
        delay: 0,
        backdrop: !0,
        keyboard: !0
    }, g.prototype.init = function (g) {
        var h = this;
        if (g.url && (!g.type || g.type != d && "iframe" != g.type) && (g.type = d), g.remote)
            g.type = d, typeof g.remote === f && (g.url = g.remote);
        else if (g.iframe)
            g.type = "iframe", typeof g.iframe === f && (g.url = g.iframe);
        else if (g.custom && (g.type = "custom", typeof g.custom === f)) {
            var i;
            try {
                i = a(g.custom)
            } catch (j) {
            }
            i && i.length ? g.custom = i : a.isFunction(b[g.custom]) && (g.custom = b[g.custom])
        }
        var k = a("#" + g.name);
        k.length && (h.isShown || k.off(e), k.remove()), k = a('<div id="' + g.name + '" class="modal modal-trigger"><div class="icon-spinner icon-spin loader"></div><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><button class="close" data-dismiss="modal">脳</button><h4 class="modal-title"><i class="modal-icon"></i> <span class="modal-title-name"></span></h4></div><div class="modal-body"></div></div></div></div>').appendTo("body").data(c, h);
        var l = function (b, c) {
            var d = g[b];
            a.isFunction(d) && k.on(c + e, d)
        };
        l("onShow", "show"), l("shown", "shown"), l("onHide", "hide"), l("hidden", "hidden"), l("loaded", "loaded"), k.on("shown" + e, function () {
            h.isShown = !0
        }).on("hidden" + e, function () {
            h.isShown = !1
        }), this.$modal = k, this.$dialog = k.find(".modal-dialog")
    }, g.prototype.show = function (g) {
        var h = a.extend({}, this.options, g);
        this.init(h);
        var i = this,
                j = this.$modal,
                k = this.$dialog,
                l = h.custom,
                m = k.find(".modal-body").css("padding", ""),
                n = k.find(".modal-header"),
                o = k.find(".modal-content");
        j.toggleClass("fade", h.fade).addClass(h.cssClass).toggleClass("modal-md", "md" === h.size).toggleClass("modal-sm", "sm" === h.size).toggleClass("modal-lg", "lg" === h.size).toggleClass("modal-fullscreen", "fullscreen" === h.size).toggleClass("modal-loading", !this.isShown), n.toggle(h.showHeader), n.find(".modal-icon").attr("class", "modal-icon icon-" + h.icon), n.find(".modal-title-name").html(h.title || ""), h.size && "fullscreen" === h.size && (h.width = "", h.height = "");
        var p = function (a) {
            "undefined" == typeof a && (a = 300), setTimeout(function () {
                k = j.find(".modal-dialog"), h.width && "auto" != h.width && k.css("width", h.width), h.height && "auto" != h.height && (k.css("height", h.height), "iframe" === h.type && m.css("height", k.height() - n.outerHeight())), i.ajustPosition(h.position), j.removeClass("modal-loading"), "iframe" != h.type && k.off("resize." + c).on("resize." + c, function () {
                    i.ajustPosition()
                })
            }, a)
        };
        if ("custom" === h.type && l)
            if (a.isFunction(l)) {
                var q = l({
                    modal: j,
                    options: h,
                    modalTrigger: i,
                    ready: p
                });
                typeof q === f && (m.html(q), p())
            } else
                l instanceof a ? (m.html(a("<div>").append(l.clone()).html()), p()) : (m.html(l), p());
        else if (h.url)
            if (j.attr("ref", h.url), "iframe" === h.type) {
                j.addClass("modal-iframe"), this.firstLoad = !0;
                var r = "iframe-" + h.name;
                n.detach(), m.detach(), o.empty().append(n).append(m), m.css("padding", 0).html('<iframe id="' + r + '" name="' + r + '" src="' + h.url + '" frameborder="no" allowtransparency="true" scrolling="auto" style="width: 100%; height: 100%; left: 0px;"></iframe>'), h.waittime > 0 && (i.waitTimeout = setTimeout(p, h.waittime));
                var s = document.getElementById(r);
                s.onload = s.onreadystatechange = function () {
                    if (i.firstLoad && j.addClass("modal-loading"), !this.readyState || "complete" == this.readyState) {
                        i.firstLoad = !1, h.waittime > 0 && clearTimeout(i.waitTimeout);
                        try {
                            j.attr("ref", s.contentWindow.location.href);
                            var a = b.frames[r].$;
                            if (a && "auto" === h.height && "fullscreen" != h.size) {
                                var d = a("body").addClass("body-modal"),
                                        f = function () {
                                            j.removeClass("fade");
                                            var a = d.outerHeight();
                                            m.css("height", a), h.fade && j.addClass("fade"), p()
                                        };
                                j.callEvent("loaded" + e, {
                                    modalType: "iframe"
                                }), setTimeout(f, 100), d.off("resize." + c).on("resize." + c, f)
                            }
                            a.extend({
                                closeModal: b.closeModal
                            })
                        } catch (g) {
                            p()
                        }
                    }
                }
            } else
                a.get(h.url, function (b) {
                    try {
                        var c = a(b);
                        c.hasClass("modal-dialog") ? k.replaceWith(c) : c.hasClass("modal-content") ? k.find(".modal-content").replaceWith(c) : m.wrapInner(c)
                    } catch (f) {
                        j.html(b)
                    }
                    j.callEvent("loaded" + e, {
                        modalType: d
                    }), p()
                });
        j.modal({
            show: "show",
            backdrop: h.backdrop,
            keyboard: h.keyboard
        })
    }, g.prototype.close = function (c, d) {
        (c || d) && this.$modal.on("hidden" + e, function () {
            a.isFunction(c) && c(), typeof d === f && ("this" === d ? b.location.reload() : b.location = d)
        }), this.$modal.modal("hide")
    }, g.prototype.toggle = function (a) {
        this.isShown ? this.close() : this.show(a)
    }, g.prototype.ajustPosition = function (a) {
        this.$modal.modal("ajustPosition", a || this.options.position)
    }, a.zui({
        ModalTrigger: g,
        modalTrigger: new g
    }), a.fn.modalTrigger = function (b, d) {
        return a(this).each(function () {
            var e = a(this),
                    h = e.data(c),
                    i = a.extend({
                        title: e.attr("title") || e.text(),
                        url: e.attr("href"),
                        type: e.hasClass("iframe") ? "iframe" : ""
                    }, e.data(), a.isPlainObject(b) && b);
            h || e.data(c, h = new g(i)), typeof b == f ? h[b](d) : i.show && h.show(d), e.on((i.trigger || "click") + ".toggle." + c, function (a) {
                h.toggle(i), e.is("a") && a.preventDefault()
            })
        })
    };
    var h = a.fn.modal;
    a.fn.modal = function (b, c) {
        return a(this).each(function () {
            var d = a(this);
            d.hasClass("modal") ? h.call(d, b, c) : d.modalTrigger(b, c)
        })
    };
    var i = function (b) {
        var c = typeof b;
        return "undefined" === c ? b = a(".modal.modal-trigger") : c === f && (b = a(b)), b && b instanceof a ? b : null
    },
            j = function (b, d, e) {
                if (a.isFunction(b)) {
                    var f = e;
                    e = d, d = b, b = f
                }
                b = i(b), b && b.length && b.each(function () {
                    a(this).data(c).close(d, e)
                })
            },
            k = function (a, b) {
                b = i(b), b && b.length && b.modal("ajustPosition", a)
            };
    a.zui({
        closeModal: j,
        ajustModalPosition: k
    }), a(document).on("click." + c + ".data-api", '[data-toggle="modal"]', function (b) {
        var d = a(this),
                e = d.attr("href"),
                f = null;
        try {
            f = a(d.attr("data-target") || e && e.replace(/.*(?=#[^\s]+$)/, ""))
        } catch (g) {
        }
        f && f.length || (d.data(c) ? d.trigger(".toggle." + c) : d.modalTrigger({
            show: !0
        })), d.is("a") && b.preventDefault()
    })
}(window.jQuery, window), +
        function (a) {
            "use strict";
            var b = function (a, b) {
                this.type = this.options = this.enabled = this.timeout = this.hoverState = this.$element = null, this.init("tooltip", a, b)
            };
            b.DEFAULTS = {
                animation: !0,
                placement: "top",
                selector: !1,
                template: '<div class="tooltip"><div class="tooltip-arrow"></div><div class="tooltip-inner"></div></div>',
                trigger: "hover focus",
                title: "",
                delay: 0,
                html: !1,
                container: !1
            }, b.prototype.init = function (b, c, d) {
                this.enabled = !0, this.type = b, this.$element = a(c), this.options = this.getOptions(d);
                for (var e = this.options.trigger.split(" "), f = e.length; f--; ) {
                    var g = e[f];
                    if ("click" == g)
                        this.$element.on("click." + this.type, this.options.selector, a.proxy(this.toggle, this));
                    else if ("manual" != g) {
                        var h = "hover" == g ? "mouseenter" : "focus",
                                i = "hover" == g ? "mouseleave" : "blur";
                        this.$element.on(h + "." + this.type, this.options.selector, a.proxy(this.enter, this)), this.$element.on(i + "." + this.type, this.options.selector, a.proxy(this.leave, this))
                    }
                }
                this.options.selector ? this._options = a.extend({}, this.options, {
                    trigger: "manual",
                    selector: ""
                }) : this.fixTitle()
            }, b.prototype.getDefaults = function () {
                return b.DEFAULTS
            }, b.prototype.getOptions = function (b) {
                return b = a.extend({}, this.getDefaults(), this.$element.data(), b), b.delay && "number" == typeof b.delay && (b.delay = {
                    show: b.delay,
                    hide: b.delay
                }), b
            }, b.prototype.getDelegateOptions = function () {
                var b = {},
                        c = this.getDefaults();
                return this._options && a.each(this._options, function (a, d) {
                    c[a] != d && (b[a] = d)
                }), b
            }, b.prototype.enter = function (b) {
                var c = b instanceof this.constructor ? b : a(b.currentTarget)[this.type](this.getDelegateOptions()).data("zui." + this.type);
                return clearTimeout(c.timeout), c.hoverState = "in", c.options.delay && c.options.delay.show ? void(c.timeout = setTimeout(function () {
                    "in" == c.hoverState && c.show()
                }, c.options.delay.show)) : c.show()
            }, b.prototype.leave = function (b) {
                var c = b instanceof this.constructor ? b : a(b.currentTarget)[this.type](this.getDelegateOptions()).data("zui." + this.type);
                return clearTimeout(c.timeout), c.hoverState = "out", c.options.delay && c.options.delay.hide ? void(c.timeout = setTimeout(function () {
                    "out" == c.hoverState && c.hide()
                }, c.options.delay.hide)) : c.hide()
            }, b.prototype.show = function () {
                var b = a.Event("show.zui." + this.type);
                if (this.hasContent() && this.enabled) {
                    if (this.$element.trigger(b), b.isDefaultPrevented())
                        return;
                    var c = this.tip();
                    this.setContent(), this.options.animation && c.addClass("fade");
                    var d = "function" == typeof this.options.placement ? this.options.placement.call(this, c[0], this.$element[0]) : this.options.placement,
                            e = /\s?auto?\s?/i,
                            f = e.test(d);
                    f && (d = d.replace(e, "") || "top"), c.detach().css({
                        top: 0,
                        left: 0,
                        display: "block"
                    }).addClass(d), this.options.container ? c.appendTo(this.options.container) : c.insertAfter(this.$element);
                    var g = this.getPosition(),
                            h = c[0].offsetWidth,
                            i = c[0].offsetHeight;
                    if (f) {
                        var j = this.$element.parent(),
                                k = d,
                                l = document.documentElement.scrollTop || document.body.scrollTop,
                                m = "body" == this.options.container ? window.innerWidth : j.outerWidth(),
                                n = "body" == this.options.container ? window.innerHeight : j.outerHeight(),
                                o = "body" == this.options.container ? 0 : j.offset().left;
                        d = "bottom" == d && g.top + g.height + i - l > n ? "top" : "top" == d && g.top - l - i < 0 ? "bottom" : "right" == d && g.right + h > m ? "left" : "left" == d && g.left - h < o ? "right" : d, c.removeClass(k).addClass(d)
                    }
                    var p = this.getCalculatedOffset(d, g, h, i);
                    this.applyPlacement(p, d), this.$element.trigger("shown.zui." + this.type)
                }
            }, b.prototype.applyPlacement = function (a, b) {
                var c, d = this.tip(),
                        e = d[0].offsetWidth,
                        f = d[0].offsetHeight,
                        g = parseInt(d.css("margin-top"), 10),
                        h = parseInt(d.css("margin-left"), 10);
                isNaN(g) && (g = 0), isNaN(h) && (h = 0), a.top = a.top + g, a.left = a.left + h, d.offset(a).addClass("in");
                var i = d[0].offsetWidth,
                        j = d[0].offsetHeight;
                if ("top" == b && j != f && (c = !0, a.top = a.top + f - j), /bottom|top/.test(b)) {
                    var k = 0;
                    a.left < 0 && (k = -2 * a.left, a.left = 0, d.offset(a), i = d[0].offsetWidth, j = d[0].offsetHeight), this.replaceArrow(k - e + i, i, "left")
                } else
                    this.replaceArrow(j - f, j, "top");
                c && d.offset(a)
            }, b.prototype.replaceArrow = function (a, b, c) {
                this.arrow().css(c, a ? 50 * (1 - a / b) + "%" : "")
            }, b.prototype.setContent = function () {
                var a = this.tip(),
                        b = this.getTitle();
                this.options.tipId && a.attr("id", this.options.tipId), this.options.tipClass && a.addClass(this.options.tipClass), a.find(".tooltip-inner")[this.options.html ? "html" : "text"](b), a.removeClass("fade in top bottom left right")
            }, b.prototype.hide = function () {
                function b() {
                    "in" != c.hoverState && d.detach()
                }
                var c = this,
                        d = this.tip(),
                        e = a.Event("hide.zui." + this.type);
                return this.$element.trigger(e), e.isDefaultPrevented() ? void 0 : (d.removeClass("in"), a.support.transition && this.$tip.hasClass("fade") ? d.one(a.support.transition.end, b).emulateTransitionEnd(150) : b(), this.$element.trigger("hidden.zui." + this.type), this)
            }, b.prototype.fixTitle = function () {
                var a = this.$element;
                (a.attr("title") || "string" != typeof a.attr("data-original-title")) && a.attr("data-original-title", a.attr("title") || "").attr("title", "")
            }, b.prototype.hasContent = function () {
                return this.getTitle()
            }, b.prototype.getPosition = function () {
                var b = this.$element[0];
                return a.extend({}, "function" == typeof b.getBoundingClientRect ? b.getBoundingClientRect() : {
                    width: b.offsetWidth,
                    height: b.offsetHeight
                }, this.$element.offset())
            }, b.prototype.getCalculatedOffset = function (a, b, c, d) {
                return "bottom" == a ? {
                    top: b.top + b.height,
                    left: b.left + b.width / 2 - c / 2
                } : "top" == a ? {
                    top: b.top - d,
                    left: b.left + b.width / 2 - c / 2
                } : "left" == a ? {
                    top: b.top + b.height / 2 - d / 2,
                    left: b.left - c
                } : {
                    top: b.top + b.height / 2 - d / 2,
                    left: b.left + b.width
                }
            }, b.prototype.getTitle = function () {
                var a, b = this.$element,
                        c = this.options;
                return a = b.attr("data-original-title") || ("function" == typeof c.title ? c.title.call(b[0]) : c.title)
            }, b.prototype.tip = function () {
                return this.$tip = this.$tip || a(this.options.template)
            }, b.prototype.arrow = function () {
                return this.$arrow = this.$arrow || this.tip().find(".tooltip-arrow")
            }, b.prototype.validate = function () {
                this.$element[0].parentNode || (this.hide(), this.$element = null, this.options = null)
            }, b.prototype.enable = function () {
                this.enabled = !0
            }, b.prototype.disable = function () {
                this.enabled = !1
            }, b.prototype.toggleEnabled = function () {
                this.enabled = !this.enabled
            }, b.prototype.toggle = function (b) {
                var c = b ? a(b.currentTarget)[this.type](this.getDelegateOptions()).data("zui." + this.type) : this;
                c.tip().hasClass("in") ? c.leave(c) : c.enter(c)
            }, b.prototype.destroy = function () {
                this.hide().$element.off("." + this.type).removeData("zui." + this.type)
            };
            var c = a.fn.tooltip;
            a.fn.tooltip = function (c) {
                return this.each(function () {
                    var d = a(this),
                            e = d.data("zui.tooltip"),
                            f = "object" == typeof c && c;
                    e || d.data("zui.tooltip", e = new b(this, f)), "string" == typeof c && e[c]()
                })
            }, a.fn.tooltip.Constructor = b, a.fn.tooltip.noConflict = function () {
                return a.fn.tooltip = c, this
            }
        }(window.jQuery), +
        function (a) {
            "use strict";
            var b = function (a, b) {
                this.init("popover", a, b)
            };
            if (!a.fn.tooltip)
                throw new Error("Popover requires tooltip.js");
            b.DEFAULTS = a.extend({}, a.fn.tooltip.Constructor.DEFAULTS, {
                placement: "right",
                trigger: "click",
                content: "",
                template: '<div class="popover"><div class="arrow"></div><h3 class="popover-title"></h3><div class="popover-content"></div></div>'
            }), b.prototype = a.extend({}, a.fn.tooltip.Constructor.prototype), b.prototype.constructor = b, b.prototype.getDefaults = function () {
                return b.DEFAULTS
            }, b.prototype.setContent = function () {
                var a = this.tip(),
                        b = this.getTarget();
                if (b)
                    return b.find(".arrow").length < 1 && a.addClass("no-arrow"), void a.html(b.html());
                var c = this.getTitle(),
                        d = this.getContent();
                a.find(".popover-title")[this.options.html ? "html" : "text"](c), a.find(".popover-content")[this.options.html ? "html" : "text"](d), a.removeClass("fade top bottom left right in"), a.find(".popover-title").html() || a.find(".popover-title").hide()
            }, b.prototype.hasContent = function () {
                return this.getTarget() || this.getTitle() || this.getContent()
            }, b.prototype.getContent = function () {
                var a = this.$element,
                        b = this.options;
                return a.attr("data-content") || ("function" == typeof b.content ? b.content.call(a[0]) : b.content)
            }, b.prototype.getTarget = function () {
                var b = this.$element,
                        c = this.options,
                        d = b.attr("data-target") || ("function" == typeof c.target ? c.target.call(b[0]) : c.target);
                return d ? "$next" == d ? b.next(".popover") : a(d) : !1
            }, b.prototype.arrow = function () {
                return this.$arrow = this.$arrow || this.tip().find(".arrow")
            }, b.prototype.tip = function () {
                return this.$tip || (this.$tip = a(this.options.template)), this.$tip
            };
            var c = a.fn.popover;
            a.fn.popover = function (c) {
                return this.each(function () {
                    var d = a(this),
                            e = d.data("zui.popover"),
                            f = "object" == typeof c && c;
                    e || d.data("zui.popover", e = new b(this, f)), "string" == typeof c && e[c]()
                })
            }, a.fn.popover.Constructor = b, a.fn.popover.noConflict = function () {
                return a.fn.popover = c, this
            }
        }(window.jQuery), +
        function (a) {
            "use strict";

            function b() {
                a(e).remove(), a(f).each(function (b) {
                    var e = c(a(this));
                    e.hasClass("open") && (e.trigger(b = a.Event("hide." + d)), b.isDefaultPrevented() || e.removeClass("open").trigger("hidden." + d))
                })
            }
            function c(b) {
                var c = b.attr("data-target");
                c || (c = b.attr("href"), c = c && /#/.test(c) && c.replace(/.*(?=#[^\s]*$)/, ""));
                var d = c && a(c);
                return d && d.length ? d : b.parent()
            }
            var d = "zui.dropdown",
                    e = ".dropdown-backdrop",
                    f = "[data-toggle=dropdown]",
                    g = function (b) {
                        a(b).on("click." + d, this.toggle)
                    };
            g.prototype.toggle = function (e) {
                var f = a(this);
                if (!f.is(".disabled, :disabled")) {
                    var g = c(f),
                            h = g.hasClass("open");
                    if (b(), !h) {
                        if ("ontouchstart" in document.documentElement && !g.closest(".navbar-nav").length && a('<div class="dropdown-backdrop"/>').insertAfter(a(this)).on("click", b), g.trigger(e = a.Event("show." + d)), e.isDefaultPrevented())
                            return;
                        g.toggleClass("open").trigger("shown." + d), f.focus()
                    }
                    return !1
                }
            }, g.prototype.keydown = function (b) {
                if (/(38|40|27)/.test(b.keyCode)) {
                    var d = a(this);
                    if (b.preventDefault(), b.stopPropagation(), !d.is(".disabled, :disabled")) {
                        var e = c(d),
                                g = e.hasClass("open");
                        if (!g || g && 27 == b.keyCode)
                            return 27 == b.which && e.find(f).focus(), d.click();
                        var h = a("[role=menu] li:not(.divider):visible a", e);
                        if (h.length) {
                            var i = h.index(h.filter(":focus"));
                            38 == b.keyCode && i > 0 && i--, 40 == b.keyCode && i < h.length - 1 && i++, ~i || (i = 0), h.eq(i).focus()
                        }
                    }
                }
            };
            var h = a.fn.dropdown;
            a.fn.dropdown = function (b) {
                return this.each(function () {
                    var c = a(this),
                            d = c.data("dropdown");
                    d || c.data("dropdown", d = new g(this)), "string" == typeof b && d[b].call(c)
                })
            }, a.fn.dropdown.Constructor = g, a.fn.dropdown.noConflict = function () {
                return a.fn.dropdown = h, this
            };
            var i = d + ".data-api";
            a(document).on("click." + i, b).on("click." + i, ".dropdown form", function (a) {
                a.stopPropagation()
            }).on("click." + i, f, g.prototype.toggle).on("keydown." + i, f + ", [role=menu]", g.prototype.keydown)
        }(window.jQuery), +
        function (a) {
            "use strict";
            var b = function (b, c) {
                this.$element = a(b), this.$indicators = this.$element.find(".carousel-indicators"), this.options = c, this.paused = this.sliding = this.interval = this.$active = this.$items = null, "hover" == this.options.pause && this.$element.on("mouseenter", a.proxy(this.pause, this)).on("mouseleave", a.proxy(this.cycle, this))
            };
            b.DEFAULTS = {
                interval: 5e3,
                pause: "hover",
                wrap: !0,
                touchable: !0
            }, b.prototype.touchable = function () {
                function b(b) {
                    var b = b || window.event;
                    b.originalEvent && (b = b.originalEvent);
                    var f = a(this);
                    switch (b.type) {
                        case "touchstart":
                            d = b.touches[0].pageX, e = b.touches[0].pageY;
                            break;
                        case "touchend":
                            var g = b.changedTouches[0].pageX - d,
                                    h = b.changedTouches[0].pageY - e;
                            if (Math.abs(g) > Math.abs(h))
                                c(f, g), Math.abs(g) > 10 && b.preventDefault();
                            else {
                                var i = a(window);
                                a("body,html").animate({
                                    scrollTop: i.scrollTop() - h
                                }, 400)
                            }
                    }
                }
                function c(a, b) {
                    b > 10 && a.find(".left.carousel-control").click(), -10 > b && a.find(".right.carousel-control").click()
                }
                if (this.options.touchable) {
                    this.$element.on("touchstart touchmove touchend", b);
                    var d, e
                }
            }, b.prototype.cycle = function (b) {
                return b || (this.paused = !1), this.interval && clearInterval(this.interval), this.options.interval && !this.paused && (this.interval = setInterval(a.proxy(this.next, this), this.options.interval)), this
            }, b.prototype.getActiveIndex = function () {
                return this.$active = this.$element.find(".item.active"), this.$items = this.$active.parent().children(), this.$items.index(this.$active)
            }, b.prototype.to = function (b) {
                var c = this,
                        d = this.getActiveIndex();
                return b > this.$items.length - 1 || 0 > b ? void 0 : this.sliding ? this.$element.one("slid", function () {
                    c.to(b)
                }) : d == b ? this.pause().cycle() : this.slide(b > d ? "next" : "prev", a(this.$items[b]))
            }, b.prototype.pause = function (b) {
                return b || (this.paused = !0), this.$element.find(".next, .prev").length && a.support.transition.end && (this.$element.trigger(a.support.transition.end), this.cycle(!0)), this.interval = clearInterval(this.interval), this
            }, b.prototype.next = function () {
                return this.sliding ? void 0 : this.slide("next")
            }, b.prototype.prev = function () {
                return this.sliding ? void 0 : this.slide("prev")
            }, b.prototype.slide = function (b, c) {
                var d = this.$element.find(".item.active"),
                        e = c || d[b](),
                        f = this.interval,
                        g = "next" == b ? "left" : "right",
                        h = "next" == b ? "first" : "last",
                        i = this;
                if (!e.length) {
                    if (!this.options.wrap)
                        return;
                    e = this.$element.find(".item")[h]()
                }
                this.sliding = !0, f && this.pause();
                var j = a.Event("slide.zui.carousel", {
                    relatedTarget: e[0],
                    direction: g
                });
                if (!e.hasClass("active")) {
                    if (this.$indicators.length && (this.$indicators.find(".active").removeClass("active"), this.$element.one("slid", function () {
                        var b = a(i.$indicators.children()[i.getActiveIndex()]);
                        b && b.addClass("active")
                    })), a.support.transition && this.$element.hasClass("slide")) {
                        if (this.$element.trigger(j), j.isDefaultPrevented())
                            return;
                        e.addClass(b), e[0].offsetWidth, d.addClass(g), e.addClass(g), d.one(a.support.transition.end, function () {
                            e.removeClass([b, g].join(" ")).addClass("active"), d.removeClass(["active", g].join(" ")), i.sliding = !1, setTimeout(function () {
                                i.$element.trigger("slid")
                            }, 0)
                        }).emulateTransitionEnd(600)
                    } else {
                        if (this.$element.trigger(j), j.isDefaultPrevented())
                            return;
                        d.removeClass("active"), e.addClass("active"), this.sliding = !1, this.$element.trigger("slid")
                    }
                    return f && this.cycle(), this
                }
            };
            var c = a.fn.carousel;
            a.fn.carousel = function (c) {
                return this.each(function () {
                    var d = a(this),
                            e = d.data("zui.carousel"),
                            f = a.extend({}, b.DEFAULTS, d.data(), "object" == typeof c && c),
                            g = "string" == typeof c ? c : f.slide;
                    e || d.data("zui.carousel", e = new b(this, f)), "number" == typeof c ? e.to(c) : g ? e[g]() : f.interval && e.pause().cycle(), f.touchable && e.touchable()
                })
            }, a.fn.carousel.Constructor = b, a.fn.carousel.noConflict = function () {
                return a.fn.carousel = c, this
            }, a(document).on("click.zui.carousel.data-api", "[data-slide], [data-slide-to]", function (b) {
                var c, d = a(this),
                        e = a(d.attr("data-target") || (c = d.attr("href")) && c.replace(/.*(?=#[^\s]+$)/, "")),
                        f = a.extend({}, e.data(), d.data()),
                        g = d.attr("data-slide-to");
                g && (f.interval = !1), e.carousel(f), (g = d.attr("data-slide-to")) && e.data("zui.carousel").to(g), b.preventDefault()
            }), a(window).on("load", function () {
                a('[data-ride="carousel"]').each(function () {
                    var b = a(this);
                    b.carousel(b.data())
                })
            })
        }(window.jQuery), function () {
    "use strict";
    $.zui.imgReady = function () {
        var a = [],
                b = null,
                c = function () {
                    for (var b = 0; b < a.length; b++)
                        a[b].end ? a.splice(b--, 1) : a[b]();
                    !a.length && d()
                },
                d = function () {
                    clearInterval(b), b = null
                };
        return function (d, e, f, g) {
            var h, i, j, k, l, m = new Image;
            return m.src = d, m.complete ? (e.call(m), void(f && f.call(m))) : (i = m.width, j = m.height, m.onerror = function () {
                g && g.call(m), h.end = !0, m = m.onload = m.onerror = null
            }, h = function () {
                k = m.width, l = m.height, (k !== i || l !== j || k * l > 1024) && (e.call(m), h.end = !0)
            }, h(), m.onload = function () {
                !h.end && h(), f && f.call(m), m = m.onload = m.onerror = null
            }, void(h.end || (a.push(h), null === b && (b = setInterval(c, 40)))))
        }
    }()
}(), function (a, b, c) {
    "use strict";
    if (!a.fn.modalTrigger)
        throw new Error("modal & modalTrigger requires for lightbox");
    if (!a.zui.imgReady)
        throw new Error("imgReady requires for lightbox");
    var d = function (b, c) {
        this.$ = a(b), this.options = this.getOptions(c), this.init()
    };
    d.DEFAULTS = {
        modalTeamplate: '<div class="icon-spinner icon-spin loader"></div><div class="modal-dialog"><button class="close" data-dismiss="modal" aria-hidden="true"><i class="icon-remove"></i></button><button class="controller prev"><i class="icon icon-chevron-left"></i></button><button class="controller next"><i class="icon icon-chevron-right"></i></button><img class="lightbox-img" src="{image}" alt="" data-dismiss="modal" /><div class="caption"><div class="content">{caption}<div></div></div>'
    }, d.prototype.getOptions = function (b) {
        var c = "image";
        return b = a.extend({}, d.DEFAULTS, this.$.data(), b), b[c] || (b[c] = this.$.attr("src") || this.$.attr("href") || this.$.find("img").attr("src"), this.$.data(c, b[c])), b
    }, d.prototype.init = function () {
        this.bindEvents()
    }, d.prototype.initGroups = function () {
        var b = this.$.data("groups");
        b || (b = a('[data-toggle="lightbox"][data-group="' + this.options.group + '"], [data-lightbox-group="' + this.options.group + '"]'), this.$.data("groups", b), b.each(function (b) {
            a(this).attr("data-group-index", b)
        })), this.groups = b, this.groupIndex = parseInt(this.$.data("group-index"))
    }, d.prototype.bindEvents = function () {
        var d = this.$,
                e = this,
                f = this.options;
        return f.image ? void d.modalTrigger({
            type: "custom",
            name: "lightboxModal",
            position: "center",
            custom: function (d) {
                e.initGroups();
                var g = d.modal,
                        h = e.groups,
                        i = e.groupIndex;
                g.addClass("modal-lightbox").html(f.modalTeamplate.format(f)).toggleClass("lightbox-with-caption", "string" == typeof f.caption).removeClass("lightbox-full").data("group-index", i);
                var j = g.find(".modal-dialog"),
                        k = a(b).width();
                a.zui.imgReady(f.image, function () {
                    j.css({
                        width: c.min(k, this.width)
                    }), k < this.width + 30 && g.addClass("lightbox-full"), d.ready()
                }), g.find(".prev").toggleClass("show", h.filter('[data-group-index="' + (i - 1) + '"]').length > 0), g.find(".next").toggleClass("show", h.filter('[data-group-index="' + (i + 1) + '"]').length > 0), g.find(".controller").click(function () {
                    var e = a(this),
                            f = g.data("group-index") + (e.hasClass("prev") ? -1 : 1),
                            i = h.filter('[data-group-index="' + f + '"]');
                    if (i.length) {
                        var l = i.data("image"),
                                m = i.data("caption");
                        g.addClass("modal-loading").data("group-index", f).toggleClass("lightbox-with-caption", "string" == typeof m).removeClass("lightbox-full"), g.find(".lightbox-img").attr("src", l), k = a(b).width(), a.zui.imgReady(l, function () {
                            j.css({
                                width: c.min(k, this.width)
                            }), k < this.width + 30 && g.addClass("lightbox-full"), d.ready()
                        })
                    }
                    return g.find(".prev").toggleClass("show", h.filter('[data-group-index="' + (f - 1) + '"]').length > 0), g.find(".next").toggleClass("show", h.filter('[data-group-index="' + (f + 1) + '"]').length > 0), !1
                })
            }
        }) : !1
    }, a.fn.lightbox = function (b) {
        var c = "group" + (new Date).getTime();
        return this.each(function () {
            var e = a(this),
                    f = "object" == typeof b && b;
            "object" == typeof f && f.group ? e.attr("data-lightbox-group", f.group) : e.data("group") ? e.attr("data-lightbox-group", e.data("group")) : e.attr("data-lightbox-group", c), e.data("group", e.data("lightbox-group"));
            var g = e.data("zui.lightbox");
            g || e.data("zui.lightbox", g = new d(this, f)), "string" == typeof b && g[b]()
        })
    }, a.fn.lightbox.Constructor = d, a(function () {
        a('[data-toggle="lightbox"]').lightbox()
    })
}(jQuery, window, Math), function (a, b) {
    "use strict";
    var c, d = 0,
            e = '<div class="messager messager-{type} {placement}" id="messager{id}" style="display:none"><div class="messager-content"></div><div class="messager-actions"><button type="button" class="close action">&times;</button></div></div>',
            f = {
                type: "default",
                placement: "top",
                time: 4e3,
                parent: "body",
                icon: null,
                close: !0,
                fade: !0,
                scale: !0
            },
    g = function (b, c) {
        var g = this;
        g.id = d++, c = g.options = a.extend({}, f, c), g.message = (c.icon ? '<i class="icon-' + c.icon + ' icon"></i> ' : "") + b, g.$ = a(e.format(c)).toggleClass("fade", c.fade).toggleClass("scale", c.scale).attr("id", "messager-" + g.id), c.close ? g.$.on("click", ".close", function () {
            g.hide()
        }) : g.$.find(".close").remove(), g.$.find(".messager-content").html(g.message), g.$.data("zui.messager", g)
    };
    g.prototype.show = function (d) {
        var e = this,
                f = this.options;
        c && (c.id == e.id ? e.$.removeClass("in") : c.isShow && c.hide()), e.hiding && (clearTimeout(e.hiding), e.hiding = null), d && (e.message = (f.icon ? '<i class="icon-' + f.icon + ' icon"></i> ' : "") + d, e.$.find(".messager-content").html(e.message)), e.$.appendTo(f.parent).show(), ("top" === f.placement || "bottom" === f.placement || "center" === f.placement) && e.$.css("left", (a(b).width() - e.$.width() - 50) / 2), ("left" === f.placement || "right" === f.placement || "center" === f.placement) && e.$.css("top", (a(b).height() - e.$.height() - 50) / 2), e.$.addClass("in"), f.time && (e.hiding = setTimeout(function () {
            e.hide()
        }, f.time)), e.isShow = !0, c = e
    }, g.prototype.hide = function () {
        var a = this;
        a.$.hasClass("in") && (a.$.removeClass("in"), setTimeout(function () {
            a.$.remove()
        }, 200)), a.isShow = !1
    };
    var h = function (a, b) {
        "string" == typeof b && (b = {
            type: b
        });
        var c = new g(a, b);
        return c.show(), c
    },
            i = function (a) {
                return "string" == typeof a ? {
                    placement: a
                } : a
            };
    a.zui({
        Messager: g,
        showMessager: h,
        messager: {
            show: h,
            primary: function (b, c) {
                return h(b, a.extend({
                    type: "primary"
                }, i(c)))
            },
            success: function (b, c) {
                return h(b, a.extend({
                    type: "success",
                    icon: "ok-sign"
                }, i(c)))
            },
            info: function (b, c) {
                return h(b, a.extend({
                    type: "info",
                    icon: "info-sign"
                }, i(c)))
            },
            warning: function (b, c) {
                return h(b, a.extend({
                    type: "warning",
                    icon: "warning-sign"
                }, i(c)))
            },
            danger: function (b, c) {
                return h(b, a.extend({
                    type: "danger",
                    icon: "exclamation-sign"
                }, i(c)))
            },
            important: function (b, c) {
                return h(b, a.extend({
                    type: "important"
                }, i(c)))
            },
            special: function (b, c) {
                return h(b, a.extend({
                    type: "special"
                }, i(c)))
            }
        }
    })
}(jQuery, window), function (a) {
    "use strict";
    var b = function (b, c) {
        this.$ = a(b), this.options = this.getOptions(c), this.init()
    };
    b.DEFAULTS = {
        auto: !1,
        foldicon: "icon-chevron-right"
    }, b.prototype.getOptions = function (c) {
        return c = a.extend({}, b.DEFAULTS, this.$.data(), c)
    }, b.prototype.init = function () {
        var a = this.$.children(".nav");
        a.find(".nav").closest("li").addClass("nav-parent"), a.find(".nav > li.active").closest("li").addClass("active"), a.find(".nav-parent > a").append('<i class="' + this.options.foldicon + ' nav-parent-fold-icon"></i>'), this.handleFold()
    }, b.prototype.handleFold = function () {
        var b = this.options.auto,
                c = this.$;
        this.$.on("click", ".nav-parent > a", function (d) {
            b && (c.find(".nav-parent.show").find(".nav").slideUp(function () {
                a(this).closest(".nav-parent").removeClass("show")
            }), c.find(".icon-rotate-90").removeClass("icon-rotate-90"));
            var e = a(this).closest(".nav-parent");
            return e.hasClass("show") ? (e.find(".icon-rotate-90").removeClass("icon-rotate-90"), e.find(".nav").slideUp(function () {
                a(this).closest(".nav-parent").removeClass("show")
            })) : (e.find(".nav-parent-fold-icon").addClass("icon-rotate-90"), e.find(".nav").slideDown(function () {
                a(this).closest(".nav-parent").addClass("show")
            })), d.preventDefault(), !1
        })
    }, a.fn.menu = function (c) {
        return this.each(function () {
            var d = a(this),
                    e = d.data("zui.menu"),
                    f = "object" == typeof c && c;
            e || d.data("zui.menu", e = new b(this, f)), "string" == typeof c && e[c]()
        })
    }, a.fn.menu.Constructor = b, a(function () {
        a('[data-toggle="menu"]').menu()
    })
}(jQuery), function (a, b) {
    "use strict";
    "function" == typeof define && define.amd ? define(["jquery"], b) : "object" == typeof exports ? module.exports = b(require("jquery")) : a.bootbox = b(a.jQuery)
}(this, function a(b, c) {
    "use strict";

    function d() {
        var a;
        if ("undefined" != typeof config && config.clientLang)
            a = config.clientLang;
        else {
            var c = b("html").attr("lang");
            a = c ? c : "en"
        }
        return a.replace("-", "_").toLowerCase()
    }
    function e(a) {
        var b = r[p.locale];
        return b ? b[a] : r.en[a]
    }
    function f(a, c, d) {
        a.stopPropagation(), a.preventDefault();
        var e = b.isFunction(d) && d(a) === !1;
        e || c.modal("hide")
    }
    function g(a) {
        var b, c = 0;
        for (b in a)
            c++;
        return c
    }
    function h(a, c) {
        var d = 0;
        b.each(a, function (a, b) {
            c(a, b, d++)
        })
    }
    function i(a) {
        var c, d;
        if ("object" != typeof a)
            throw new Error("Please supply an object of options");
        if (!a.message)
            throw new Error("Please specify a message");
        return a = b.extend({}, p, a), a.buttons || (a.buttons = {}), a.backdrop = a.backdrop ? "static" : !1, c = a.buttons, d = g(c), h(c, function (a, e, f) {
            if (b.isFunction(e) && (e = c[a] = {
                callback: e
            }), "object" !== b.type(e))
                throw new Error("button with key " + a + " must be an object");
            e.label || (e.label = a), e.className || (e.className = 1 == d || d >= 2 && "confirm" === a ? "btn-primary" : "btn-default")
        }), a
    }
    function j(a, b) {
        var c = a.length,
                d = {};
        if (1 > c || c > 2)
            throw new Error("Invalid argument length");
        return 2 === c || "string" == typeof a[0] ? (d[b[0]] = a[0], d[b[1]] = a[1]) : d = a[0], d
    }
    function k(a, c, d) {
        return b.extend(!0, {}, a, j(c, d))
    }
    function l(a, b, c, d) {
        var e = {
            className: "bootbox-" + a,
            buttons: m.apply(null, b)
        };
        return n(k(e, d, c), b)
    }
    function m() {
        for (var a = {}, b = 0, c = arguments.length; c > b; b++) {
            var d = arguments[b],
                    f = d.toLowerCase(),
                    g = d.toUpperCase();
            a[f] = {
                label: e(g)
            }
        }
        return a
    }
    function n(a, b) {
        var d = {};
        return h(b, function (a, b) {
            d[b] = !0
        }), h(a.buttons, function (a) {
            if (d[a] === c)
                throw new Error("button key " + a + " is not allowed (options are " + b.join("\n") + ")")
        }), a
    }
    var o = {
        dialog: "<div class='bootbox modal' tabindex='-1' role='dialog'><div class='modal-dialog'><div class='modal-content'><div class='modal-body'><div class='bootbox-body'></div></div></div></div></div>",
        header: "<div class='modal-header'><h4 class='modal-title'></h4></div>",
        footer: "<div class='modal-footer'></div>",
        closeButton: "<button type='button' class='bootbox-close-button close' data-dismiss='modal' aria-hidden='true'>&times;</button>",
        form: "<form class='bootbox-form'></form>",
        inputs: {
            text: "<input class='bootbox-input bootbox-input-text form-control' autocomplete=off type=text />",
            textarea: "<textarea class='bootbox-input bootbox-input-textarea form-control'></textarea>",
            email: "<input class='bootbox-input bootbox-input-email form-control' autocomplete='off' type='email' />",
            select: "<select class='bootbox-input bootbox-input-select form-control'></select>",
            checkbox: "<div class='checkbox'><label><input class='bootbox-input bootbox-input-checkbox' type='checkbox' /></label></div>",
            date: "<input class='bootbox-input bootbox-input-date form-control' autocomplete=off type='date' />",
            time: "<input class='bootbox-input bootbox-input-time form-control' autocomplete=off type='time' />",
            number: "<input class='bootbox-input bootbox-input-number form-control' autocomplete=off type='number' />",
            password: "<input class='bootbox-input bootbox-input-password form-control' autocomplete='off' type='password' />"
        }
    },
    p = {
        locale: d(),
        backdrop: !0,
        animate: !0,
        className: null,
        closeButton: !0,
        show: !0,
        container: "body"
    },
    q = {};
    q.alert = function () {
        var a;
        if (a = l("alert", ["ok"], ["message", "callback"], arguments), a.callback && !b.isFunction(a.callback))
            throw new Error("alert requires callback property to be a function when provided");
        return a.buttons.ok.callback = a.onEscape = function () {
            return b.isFunction(a.callback) ? a.callback() : !0
        }, q.dialog(a)
    }, q.confirm = function () {
        var a;
        if (a = l("confirm", ["confirm", "cancel"], ["message", "callback"], arguments), a.buttons.cancel.callback = a.onEscape = function () {
            return a.callback(!1)
        }, a.buttons.confirm.callback = function () {
            return a.callback(!0)
        }, !b.isFunction(a.callback))
            throw new Error("confirm requires a callback");
        return q.dialog(a)
    }, q.prompt = function () {
        var a, d, e, f, g, i, j;
        f = b(o.form), d = {
            className: "bootbox-prompt",
            buttons: m("confirm", "cancel"),
            value: "",
            inputType: "text"
        }, a = n(k(d, arguments, ["title", "callback"]), ["cancel", "confirm"]), i = a.show === c ? !0 : a.show;
        var l = ["date", "time", "number"],
                p = document.createElement("input");
        if (p.setAttribute("type", a.inputType), l[a.inputType] && (a.inputType = p.type), a.message = f, a.buttons.cancel.callback = a.onEscape = function () {
            return a.callback(null)
        }, a.buttons.confirm.callback = function () {
            var c;
            switch (a.inputType) {
                case "text":
                case "textarea":
                case "email":
                case "select":
                case "date":
                case "time":
                case "number":
                case "password":
                    c = g.val();
                    break;
                case "checkbox":
                    var d = g.find("input:checked");
                    c = [], h(d, function (a, d) {
                        c.push(b(d).val())
                    })
            }
            return a.callback(c)
        }, a.show = !1, !a.title)
            throw new Error("prompt requires a title");
        if (!b.isFunction(a.callback))
            throw new Error("prompt requires a callback");
        if (!o.inputs[a.inputType])
            throw new Error("invalid prompt type");
        switch (g = b(o.inputs[a.inputType]), a.inputType) {
            case "text":
            case "textarea":
            case "email":
            case "date":
            case "time":
            case "number":
            case "password":
                g.val(a.value);
                break;
            case "select":
                var r = {};
                if (j = a.inputOptions || [], !j.length)
                    throw new Error("prompt with select requires options");
                h(j, function (a, d) {
                    var e = g;
                    if (d.value === c || d.text === c)
                        throw new Error("given options in wrong format");
                    d.group && (r[d.group] || (r[d.group] = b("<optgroup/>").attr("label", d.group)), e = r[d.group]), e.append("<option value='" + d.value + "'>" + d.text + "</option>")
                }), h(r, function (a, b) {
                    g.append(b)
                }), g.val(a.value);
                break;
            case "checkbox":
                var s = b.isArray(a.value) ? a.value : [a.value];
                if (j = a.inputOptions || [], !j.length)
                    throw new Error("prompt with checkbox requires options");
                if (!j[0].value || !j[0].text)
                    throw new Error("given options in wrong format");
                g = b("<div/>"), h(j, function (c, d) {
                    var e = b(o.inputs[a.inputType]);
                    e.find("input").attr("value", d.value), e.find("label").append(d.text), h(s, function (a, b) {
                        b === d.value && e.find("input").prop("checked", !0)
                    }), g.append(e)
                })
        }
        return a.placeholder && g.attr("placeholder", a.placeholder), a.pattern && g.attr("pattern", a.pattern), f.append(g), f.on("submit", function (a) {
            a.preventDefault(), a.stopPropagation(), e.find(".btn-primary").click()
        }), e = q.dialog(a), e.off("shown.bs.modal"), e.on("shown.bs.modal", function () {
            g.focus()
        }), i === !0 && e.modal("show"), e
    }, q.dialog = function (a) {
        a = i(a);
        var c = b(o.dialog),
                d = c.find(".modal-dialog"),
                e = c.find(".modal-body"),
                g = a.buttons,
                j = "",
                k = {
                    onEscape: a.onEscape
                };
        if (h(g, function (a, b) {
            j += "<button data-bb-handler='" + a + "' type='button' class='btn " + b.className + "'>" + b.label + "</button>", k[a] = b.callback
        }), e.find(".bootbox-body").html(a.message), a.animate === !0 && c.addClass("fade"), a.className && c.addClass(a.className), "large" === a.size && d.addClass("modal-lg"), "small" === a.size && d.addClass("modal-sm"), a.title && e.before(o.header), a.closeButton) {
            var l = b(o.closeButton);
            a.title ? c.find(".modal-header").prepend(l) : l.css("margin-top", "-10px").prependTo(e)
        }
        return a.title && c.find(".modal-title").html(a.title), j.length && (e.after(o.footer), c.find(".modal-footer").html(j)), c.on("hidden.bs.modal", function (a) {
            a.target === this && c.remove()
        }), c.on("shown.bs.modal", function () {
            c.find(".btn-primary:first").focus()
        }), c.on("escape.close.bb", function (a) {
            k.onEscape && f(a, c, k.onEscape)
        }), c.on("click", ".modal-footer button", function (a) {
            var d = b(this).data("bb-handler");
            f(a, c, k[d])
        }), c.on("click", ".bootbox-close-button", function (a) {
            f(a, c, k.onEscape)
        }), c.on("keyup", function (a) {
            27 === a.which && c.trigger("escape.close.bb")
        }), b(a.container).append(c), c.modal({
            backdrop: a.backdrop,
            keyboard: !1,
            show: !1
        }), a.show && c.modal("show"), c
    }, q.setDefaults = function () {
        var a = {};
        2 === arguments.length ? a[arguments[0]] = arguments[1] : a = arguments[0], b.extend(p, a)
    }, q.hideAll = function () {
        b(".bootbox").modal("hide")
    };
    var r = {
        en: {
            OK: "OK",
            CANCEL: "Cancel",
            CONFIRM: "OK"
        },
        zh_cn: {
            OK: "纭",
            CANCEL: "鍙栨秷",
            CONFIRM: "纭"
        },
        zh_tw: {
            OK: "纰鸿獚",
            CANCEL: "鍙栨秷",
            CONFIRM: "纰鸿獚"
        }
    };
    return q.init = function (c) {
        return a(c || b)
    }, q
}), function (a, b) {
    "use strict";

    function c(b) {
        var c = b.data("url");
        c && (b.addClass("panel-loading").find(".panel-heading .icon-refresh,.panel-heading .icon-repeat").addClass("icon-spin"), a.ajax({
            url: c,
            dataType: "html"
        }).done(function (a) {
            b.find(".panel-body").html(a)
        }).fail(function () {
            b.addClass("panel-error")
        }).always(function () {
            b.removeClass("panel-loading"), b.find(".panel-heading .icon-refresh,.panel-heading .icon-repeat").removeClass("icon-spin")
        }))
    }
    function d(a, c, d, e) {
        return b.abs((d - a) * (e - c))
    }
    function e(a, b, c, d, e, f) {
        return a >= c && e >= a && b >= d && f >= b
    }
    function f(a, c, f, g, h, i, j, k) {
        var l = b.max(a, h),
                m = b.max(c, i),
                n = b.min(f, j),
                o = b.min(g, k);
        return e(l, m, a, c, f, g) && e(n, o, a, c, f, g) && e(l, m, h, i, j, k) && e(n, o, h, i, j, k) ? d(l, m, n, o) : 0
    }
    var g = function (b, c) {
        this.$ = a(b), this.options = this.getOptions(c), this.draggable = this.$.hasClass("dashboard-draggable") || this.options.draggable, this.init()
    };
    g.DEFAULTS = {
        height: 360,
        shadowType: "normal",
        sensitive: !1,
        circleShadowSize: 100
    }, g.prototype.getOptions = function (b) {
        return b = a.extend({}, g.DEFAULTS, this.$.data(), b)
    }, g.prototype.handleRemoveEvent = function () {
        var b = this.options.afterPanelRemoved,
                c = this.options.panelRemovingTip;
        this.$.on("click", ".remove-panel", function () {
            var d = a(this).closest(".panel"),
                    e = d.data("name") || d.find(".panel-heading").text().replace("\n", "").replace(/(^\s*)|(\s*$)/g, ""),
                    f = d.attr("data-id");
            (void 0 === c || confirm(c.format(e))) && (d.parent().remove(), b && a.isFunction(b) && b(f))
        })
    }, g.prototype.handleRefreshEvent = function () {
        this.$.on("click", ".refresh-panel", function () {
            var b = a(this).closest(".panel");
            c(b)
        })
    }, g.prototype.handleDraggable = function () {
        var c = this.$,
                e = this.options,
                g = "circle" === e.shadowType,
                h = e.circleShadowSize,
                i = h / 2,
                j = e.afterOrdered;
        this.$.addClass("dashboard-draggable"), this.$.find(".panel-actions").mousedown(function (a) {
            a.preventDefault(), a.stopPropagation()
        });
        var k;
        this.$.find(".panel-heading").mousedown(function (l) {
            function m(c) {
                var g = A.data("mouseOffset");
                p = c.pageX - g.x, q = c.pageY - g.y, r = p + E, s = q + F, A.css({
                    left: p,
                    top: q
                }), z.find(".dragging-in").removeClass("dragging-in"), v = !1, u = null;
                var h, i = 0;
                z.children(":not(.dragging-col)").each(function () {
                    var g = a(this);
                    if (g.hasClass("dragging-col-holder"))
                        return v = !e.sensitive || 100 > i, !0;
                    var j = g.children(".panel"),
                            k = j.offset(),
                            l = j.width(),
                            m = j.height(),
                            n = k.left,
                            o = k.top;
                    if (e.sensitive)
                        n -= C.left, o -= C.top, h = f(p, q, r, s, n, o, n + l, o + m), h > 100 && h > i && h > b.min(d(p, q, r, s), d(n, o, n + l, o + m)) / 3 && (i = h, u = g);
                    else {
                        var t = c.pageX,
                                w = c.pageY;
                        if (t > n && w > o && n + l > t && o + m > w)
                            return u = g, !1
                    }
                }), u && (t && clearTimeout(t), w = u, t = setTimeout(n, 50)), c.preventDefault()
            }
            function n() {
                w && (w.addClass("dragging-in"), v ? D.insertAfter(w) : D.insertBefore(w), c.addClass("dashboard-holding"), t = null, w = null)
            }
            function o(b) {
                t && clearTimeout(t);
                var d = x.data("order");
                x.parent().insertAfter(D);
                var e = 0,
                        f = {};
                z.children(":not(.dragging-col-holder)").each(function () {
                    var b = a(this).children(".panel");
                    b.data("order", ++e), f[b.attr("id")] = e, b.parent().attr("data-order", e)
                }), d != f[x.attr("id")] && (z.data("orders", f), j && a.isFunction(j) && j(f)), A.remove(), c.removeClass("dashboard-holding"), c.find(".dragging-col").removeClass("dragging-col"), c.find(".panel-dragging").removeClass("panel-dragging"), z.find(".dragging-in").removeClass("dragging-in"), c.removeClass("dashboard-dragging"), a(document).unbind("mousemove", m).unbind("mouseup", o), b.preventDefault()
            }
            var p, q, r, s, t, u, v, w, x = a(this).closest(".panel"),
                    y = x.parent(),
                    z = x.closest(".row"),
                    A = x.clone().addClass("panel-dragging-shadow"),
                    B = x.offset(),
                    C = c.offset(),
                    D = z.find(".dragging-col-holder"),
                    E = x.width(),
                    F = x.height();
            D.length || (D = a('<div class="dragging-col-holder"><div class="panel"></div></div>').removeClass("dragging-col").appendTo(z)), k && D.removeClass(k), D.addClass(k = y.attr("class")), D.insertBefore(y).find(".panel").replaceWith(x.clone().addClass("panel-dragging panel-dragging-holder")), c.addClass("dashboard-dragging"), x.addClass("panel-dragging").parent().addClass("dragging-col"), A.css({
                left: B.left - C.left,
                top: B.top - C.top,
                width: E,
                height: F
            }).appendTo(c).data("mouseOffset", {
                x: l.pageX - B.left + C.left,
                y: l.pageY - B.top + C.top
            }), g && (A.addClass("circle"), setTimeout(function () {
                A.css({
                    left: l.pageX - C.left - i,
                    top: l.pageY - C.top - i,
                    width: h,
                    height: h
                }).data("mouseOffset", {
                    x: C.left + i,
                    y: C.top + i
                })
            }, 100)), a(document).bind("mousemove", m).bind("mouseup", o), l.preventDefault()
        })
    }, g.prototype.handlePanelPadding = function () {
        this.$.find(".panel-body > table, .panel-body > .list-group").closest(".panel-body").addClass("no-padding")
    }, g.prototype.handlePanelHeight = function () {
        var c = this.options.height;
        this.$.find(".row").each(function () {
            var d = a(this),
                    e = d.find(".panel"),
                    f = d.data("height") || c;
            "number" != typeof f && (f = 0, e.each(function () {
                f = b.max(f, a(this).innerHeight())
            })), e.each(function () {
                var b = a(this);
                b.find(".panel-body").css("height", f - b.find(".panel-heading").outerHeight() - 2)
            })
        })
    }, g.prototype.init = function () {
        this.handlePanelHeight(), this.handlePanelPadding(), this.handleRemoveEvent(), this.handleRefreshEvent(), this.draggable && this.handleDraggable();
        var b = 0;
        this.$.find(".panel").each(function () {
            var d = a(this);
            d.data("order", ++b), d.attr("id") || d.attr("id", "panel" + b), d.attr("data-id") || d.attr("data-id", b), c(d)
        })
    }, a.fn.dashboard = function (b) {
        return this.each(function () {
            var c = a(this),
                    d = c.data("zui.dashboard"),
                    e = "object" == typeof b && b;
            d || c.data("zui.dashboard", d = new g(this, e)), "string" == typeof b && d[b]()
        })
    }, a.fn.dashboard.Constructor = g
}(jQuery, Math), function (a) {
    "use strict";
    if (!a.fn.droppable)
        throw new Error("droppable requires for boards");
    var b = function (b, c) {
        this.$ = a(b), this.options = this.getOptions(c), this.getLang(), this.init()
    };
    b.DEFAULTS = {
        lang: "zh-cn",
        langs: {
            "zh-cn": {
                append2end: "绉诲姩鍒版湯灏�"
            },
            "zh-tw": {
                append2end: "绉诲姩鍒版湯灏�"
            },
            en: {
                append2end: "Move to the end."
            }
        }
    }, b.prototype.getOptions = function (c) {
        return c = a.extend({}, b.DEFAULTS, this.$.data(), c)
    }, b.prototype.getLang = function () {
        var c = window.config;
        if (!this.options.lang) {
            if ("undefined" != typeof c && c.clientLang)
                this.options.lang = c.clientLang;
            else {
                var d = a("html").attr("lang");
                this.options.lang = d ? d : "en"
            }
            this.options.lang = this.options.lang.replace(/-/, "_").toLowerCase()
        }
        this.lang = this.options.langs[this.options.lang] || this.options.langs[b.DEFAULTS.lang]
    }, b.prototype.init = function () {
        var b = 1,
                c = this.lang;
        this.$.find('.board-item:not(".disable-drop"), .board:not(".disable-drop")').each(function () {
            var d = a(this);
            d.attr("id") ? d.attr("data-id", d.attr("id")) : d.attr("data-id") || d.attr("data-id", "board" + b++), d.hasClass("board") && d.find(".board-list").append('<div class="board-item board-item-empty"><i class="icon-plus"></i> {append2end}</div>'.format(c)).append('<div class="board-item board-item-shadow"></div>'.format(c))
        }), this.bind()
    }, b.prototype.bind = function (b) {
        var c = this.$,
                d = this.options;
        "undefined" == typeof b && (b = c.find('.board-item:not(".disable-drop, .board-item-shadow")')), b.droppable({
            target: '.board-item:not(".disable-drop, .board-item-shadow")',
            flex: !0,
            start: function (a) {
                c.addClass("dragging").find(".board-item-shadow").height(a.element.outerHeight())
            },
            drag: function (a) {
                if (c.find(".board.drop-in-empty").removeClass("drop-in-empty"), a.isIn) {
                    var b = a.target.closest(".board").addClass("drop-in"),
                            d = b.find(".board-item-shadow"),
                            e = a.target;
                    c.addClass("drop-in").find(".board.drop-in").not(b).removeClass("drop-in"), d.insertBefore(e), b.toggleClass("drop-in-empty", e.hasClass("board-item-empty"))
                }
            },
            drop: function (b) {
                if (b.isNew) {
                    var c, e = "drop";
                    d.hasOwnProperty(e) && a.isFunction(d[e]) && (c = d[e](b)), c !== !1 && b.element.insertBefore(b.target)
                }
            },
            finish: function () {
                c.removeClass("dragging").removeClass("drop-in").find(".board.drop-in").removeClass("drop-in")
            }
        })
    }, a.fn.boards = function (c) {
        return this.each(function () {
            var d = a(this),
                    e = d.data("zui.boards"),
                    f = "object" == typeof c && c;
            e || d.data("zui.boards", e = new b(this, f)), "string" == typeof c && e[c]()
        })
    }, a.fn.boards.Constructor = b, a(function () {
        a('[data-toggle="boards"]').boards()
    })
}(jQuery), function (a) {
    "use strict";
    var b = "zui.datatable",
            c = (a.zui.store, function (c, d) {
                this.name = b, this.$ = a(c), this.isTable = "TABLE" === this.$[0].tagName, this.firstShow = !0, this.isTable ? (this.$table = this.$, this.id = "datatable-" + (this.$.attr("id") || a.zui.uuid())) : (this.$datatable = this.$.addClass("datatable"), this.$.attr("id") ? this.id = this.$.attr("id") : (this.id = "datatable-" + a.zui.uuid(), this.$.attr("id", this.id))), this.getOptions(d), this.load(), this.callEvent("ready")
            });
    c.DEFAULTS = {
        checkable: !1,
        checkByClickRow: !0,
        checkedClass: "active",
        checkboxName: null,
        sortable: !1,
        storage: !0,
        fixedHeader: !0,
        fixedHeaderOffset: 0,
        fixedLeftWidth: "30%",
        fixedRightWidth: "30%",
        flexHeadDrag: !0,
        scrollPos: "in",
        rowHover: !0,
        colHover: !0,
        hoverClass: "hover",
        colHoverClass: "col-hover",
        mergeRows: !1,
        minColWidth: 20,
        minFixedLeftWidth: 200,
        minFixedRightWidth: 200,
        minFlexAreaWidth: 200
    }, c.prototype.getOptions = function (b) {
        var d = this.$;
        b = a.extend({}, c.DEFAULTS, this.$.data(), b), b.tableClass = b.tableClass || "", b.tableClass = " " + b.tableClass + " table-datatable", a.each(["bordered", "condensed", "striped", "condensed", "fixed"], function (a, c) {
            c = "table-" + c, d.hasClass(c) && (b.tableClass += " " + c)
        }), (d.hasClass("table-hover") || b.rowHover) && (b.tableClass += " table-hover"), this.options = b
    }, c.prototype.load = function (c) {
        var d, e = this.options;
        if (a.isPlainObject(c))
            this.data = c;
        else if ("string" == typeof c) {
            var f = a(c);
            f.length && (this.$table = f.first(), this.$table.data(b, this), this.isTable = !0), c = null
        } else
            c = e.data;
        if (!c) {
            if (!this.isTable)
                throw new Error("No data avaliable!");
            c = {
                cols: [],
                rows: []
            }, d = c.cols;
            var g, h, i, j, k, l, m = c.rows,
                    n = this.$table;
            n.find("thead > tr:first").children("th").each(function () {
                h = a(this), d.push(a.extend({
                    text: h.html(),
                    flex: !1 || h.hasClass("flex-col"),
                    width: "auto",
                    cssClass: h.attr("class"),
                    css: h.attr("style"),
                    type: "string",
                    ignore: h.hasClass("ignore"),
                    sort: !h.hasClass("sort-disabled"),
                    mergeRows: h.attr("merge-rows")
                }, h.data()))
            }), n.find("tbody > tr").each(function () {
                i = a(this), k = a.extend({
                    data: [],
                    checked: !1,
                    cssClass: i.attr("class"),
                    css: i.attr("style"),
                    id: i.attr("id")
                }, i.data()), i.children("td").each(function () {
                    if (j = a(this), l = j.attr("colspan") || 1, k.data.push(a.extend({
                        cssClass: j.attr("class"),
                        css: j.attr("style"),
                        text: j.html(),
                        colSpan: l
                    }, j.data())), l > 1)
                        for (g = 1; l > g; g++)
                            k.data.push({
                                empty: !0
                            })
                }), m.push(k)
            });
            var o = n.find("tfoot");
            o.length && (c.footer = a('<table class="table' + e.tableClass + '"></table>').append(o))
        }
        c.flexStart = -1, c.flexEnd = -1, d = c.cols, c.colsLength = d.length;
        for (var g = 0; g < c.colsLength; ++g) {
            var p = d[g];
            p.flex && (c.flexStart < 0 && (c.flexStart = g), c.flexEnd = g)
        }
        0 === c.flexStart && c.flexEnd === c.colsLength && (c.flexStart = -1, c.flexEnd = -1), c.flexArea = c.flexStart >= 0, c.fixedRight = c.flexEnd >= 0 && c.flexEnd < c.colsLength - 1, c.fixedLeft = c.flexStart > 0, c.flexStart < 0 && c.flexEnd < 0 && (c.fixedLeft = !0, c.flexStart = c.colsLength, c.flexEnd = c.colsLength), this.data = c, this.callEvent("afterLoad", {
            data: c
        }), this.render()
    }, c.prototype.render = function () {
        var c, d, e, f, g = this,
                h = g.$datatable || (g.isTable ? a('<div class="datatable" id="' + g.id + '"/>') : g.$datatable),
                i = g.options,
                j = g.data,
                k = g.data.cols,
                l = g.data.rows,
                m = i.checkable,
                n = '<div class="datatable-rows-span datatable-span"><div class="datatable-wrapper"><table class="table"></table></div></div>',
                o = '<div class="datatable-head-span datatable-span"><div class="datatable-wrapper"><table class="table"><thead></thead></table></div></div>';
        h.children(".datatable-head, .datatable-rows, .scroll-wrapper").remove(), h.toggleClass("sortable", i.sortable);
        var p, q, r, s = a('<div class="datatable-head"/>');
        for (c = a("<tr/>"), e = a("<tr/>"), f = a("<tr/>"), d = 0; d < k.length; d++)
            r = k[d], p = d < j.flexStart ? c : d >= j.flexStart && d <= j.flexEnd ? f : e, 0 === d && m && p.append('<th data-index="check" class="check-all check-btn"><i class="icon-check-empty"></i></th>'), r.ignore || (q = a("<th/>"), q.toggleClass("sort-down", "down" === r.sort).toggleClass("sort-up", "up" === r.sort).toggleClass("sort-disabled", r.sort === !1), q.addClass(r.cssClass).addClass(r.colClass).html(r.text).attr({
                "data-index": d,
                "data-type": r.type,
                style: r.css
            }), p.append(q));
        var t;
        j.fixedLeft && (t = a(o), t.addClass("fixed-left").find("table").addClass(i.tableClass).find("thead").append(c), s.append(t)), j.flexArea && (t = a(o), t.addClass("flexarea").find(".datatable-wrapper").append('<div class="scrolled-shadow scrolled-in-shadow"></div><div class="scrolled-shadow scrolled-out-shadow"></div>').find("table").addClass(i.tableClass).find("thead").append(f), s.append(t)), j.fixedRight && (t = a(o), t.addClass("fixed-right").find("table").addClass(i.tableClass).find("thead").append(e), s.append(t)), h.append(s);
        var u, v, w, x, y, z, A, B, C = a('<div class="datatable-rows">'),
                D = l.length;
        c = a("<tbody/>"), e = a("<tbody/>"), f = a("<tbody/>");
        for (var E = 0; D > E; ++E) {
            for (z = l[E], "undefined" == typeof z.id && (z.id = E), z.index = E, u = a("<tr/>"), u.addClass(z.cssClass).toggleClass(i.checkedClass, z.checked).attr({
            "data-index": E,
                    "data-id": z.id
            }), v = u.clone(), w = u.clone(), B = z.data.length, d = 0; B > d; ++d)
                A = z.data[d], d > 0 && A.empty || (p = d < j.flexStart ? u : d >= j.flexStart && d <= j.flexEnd ? v : w, 0 === d && m && (y = a('<td data-index="check" class="check-row check-btn"><i class="icon-check-empty"></i></td>'), i.checkboxName && y.append('<input class="hide" type="checkbox" name="' + i.checkboxName + '" value="' + z.id + '">'), p.append(y)), k[d].ignore || (a.isPlainObject(A) ? (A.row = E, A.index = d) : A = {
                    text: A,
                    row: E,
                    index: d
                }, z.data[d] = A, x = a("<td/>"), x.html(A.text).addClass(A.cssClass).addClass(k[d].colClass).attr("colspan", A.colSpan).attr({
                    "data-row": E,
                    "data-index": d,
                    "data-flex": !1,
                    "data-type": k[d].type,
                    style: A.css
                }), p.append(x)));
            c.append(u), f.append(v), e.append(w)
        }
        var F;
        j.fixedLeft && (F = a(n), F.addClass("fixed-left").find("table").addClass(i.tableClass).append(c), C.append(F)), j.flexArea && (F = a(n), F.addClass("flexarea").find(".datatable-wrapper").append('<div class="scrolled-shadow scrolled-in-shadow"></div><div class="scrolled-shadow scrolled-out-shadow"></div>').find("table").addClass(i.tableClass).append(f), C.append(F)), j.fixedRight && (F = a(n), F.addClass("fixed-right").find("table").addClass(i.tableClass).append(e), C.append(F)), h.append(C), j.flexArea && h.append('<div class="scroll-wrapper"><div class="scroll-slide scroll-pos-' + i.scrollPos + '"><div class="bar"></div></div></div>');
        var G = h.children(".datatable-footer").detach();
        j.footer ? (h.append(a('<div class="datatable-footer"/>').append(j.footer)), j.footer = null) : G.length && h.append(G), g.$datatable = h.data(b, g), g.isTable && g.firstShow && (g.$table.attr("data-datatable-id", this.id).hide().after(h), g.firstShow = !1), g.bindEvents(), g.refreshSize(), g.callEvent("render")
    }, c.prototype.bindEvents = function () {
        var b = this,
                c = this.data,
                d = this.options,
                e = a.zui.store,
                f = this.$datatable,
                g = b.$dataSpans = f.children(".datatable-head, .datatable-rows").find(".datatable-span"),
                h = b.$rowsSpans = f.children(".datatable-rows").children(".datatable-rows-span"),
                i = b.$headSpans = f.children(".datatable-head").children(".datatable-head-span"),
                j = b.$cells = g.find("td, th"),
                k = b.$dataCells = j.filter("td");
        b.$headCells = j.filter("th");
        var l = b.$rows = b.$rowsSpans.find(".table > tbody > tr");
        if (d.rowHover) {
            var m = d.hoverClass;
            h.on("mouseenter", "td", function () {
                k.filter("." + m).removeClass(m), l.filter("." + m).removeClass(m), l.filter('[data-index="' + a(this).addClass(m).closest("tr").data("index") + '"]').addClass(m)
            }).on("mouseleave", "td", function () {
                k.filter("." + m).removeClass(m), l.filter("." + m).removeClass(m)
            })
        }
        if (d.colHover) {
            var n = d.colHoverClass;
            i.on("mouseenter", "th", function () {
                j.filter("." + n).removeClass(n), j.filter('[data-index="' + a(this).data("index") + '"]').addClass(n)
            }).on("mouseleave", "th", function () {
                j.filter("." + n).removeClass(n)
            })
        }
        if (c.flexArea) {
            var o, p, q, r, s, t, u, v = f.find(".scroll-slide"),
                    w = f.find(".datatable-span.flexarea"),
                    x = f.find(".datatable-span.fixed-left"),
                    y = f.find(".datatable-span.flexarea .table"),
                    z = v.children(".bar"),
                    A = b.id + "_scrollOffset";
            b.width = f.width(), f.resize(function () {
                b.width = f.width()
            });
            var B = function (a, b) {
                s = Math.max(0, Math.min(o - p, a)), b || f.addClass("scrolling"), z.css("left", s), u = 0 - Math.floor((q - o) * s / (o - p)), y.css("left", u), r = s, f.toggleClass("scrolled-in", s > 2).toggleClass("scrolled-out", o - p - 2 > s), d.storage && e.pageSet(A, s)
            },
                    C = function () {
                        o = w.width(), v.width(o).css("left", x.width()), q = y.width(), p = Math.floor(o * o / q), z.css("width", p), y.css("min-width", o), f.toggleClass("show-scroll-slide", q > o), t || o === p || (t = !0, B(e.pageGet(A, 0), !0)), f.hasClass("size-changing") && B(s, !0)
                    };
            w.resize(C), d.storage && C();
            var D = {
                move: !1,
                stopPropagation: !0,
                drag: function (a) {
                    B(z.position().left + a.smallOffset.x * (a.element.hasClass("bar") ? 1 : -1))
                },
                finish: function () {
                    f.removeClass("scrolling")
                }
            };
            z.draggable(D), d.flexHeadDrag && f.find(".datatable-head-span.flexarea").draggable(D), v.mousedown(function (a) {
                var b = a.pageX - v.offset().left;
                B(b - p / 2)
            })
        }
        if (d.checkable) {
            var E, F = b.id + "_checkedStatus",
                    G = d.checkedClass,
                    H = function () {
                        var f = h.first().find(".table > tbody > tr"),
                                g = f.filter("." + G);
                        f.find(".check-row input:checkbox").prop("checked", !1);
                        var j = {
                            checkedAll: f.length === g.length && g.length > 0,
                            checks: g.map(function () {
                                return E = a(this).data("id"), d.checkboxName && a(this).find(".check-row input:checkbox").prop("checked", !0), E
                            }).toArray()
                        };
                        a.each(c.rows, function (b, c) {
                            c.checked = a.inArray(c.id, j.checks) > -1
                        }), i.find(".check-all").toggleClass("checked", j.checkedAll), d.storage && e.pageSet(F, j), b.callEvent("checksChanged", {
                            checks: j
                        })
                    };
            this.$rowsSpans.on("click", d.checkByClickRow ? "tr" : ".check-row", function () {
                l.filter('[data-index="' + a(this).closest("tr").data("index") + '"]').toggleClass(G), H()
            });
            var I = "click.zui.datatable.check-all";
            if (this.$datatable.off(I).on(I, ".check-all", function () {
                l.toggleClass(G, a(this).toggleClass("checked").hasClass("checked")), H()
            }).on("click", ".check-none", function () {
                l.toggleClass(G, !1), H()
            }).on("click", ".check-inverse", function () {
                l.toggleClass(G), H()
            }), d.storage) {
                var J = e.pageGet(F);
                J && (i.find(".check-all").toggleClass("checked", J.checkedAll), J.checkedAll ? l.addClass(G) : (l.removeClass(G), a.each(J.checks, function (a, b) {
                    l.filter('[data-id="' + b + '"]').addClass(G)
                })), J.checks.length && H())
            }
        }
        if (d.fixedHeader) {
            var K, L, M, N = f.children(".datatable-head"),
                    O = d.fixedHeaderOffset || a(".navbar.navbar-fixed-top").height() || 0,
                    P = function () {
                        K = f.offset().top, M = a(window).scrollTop(), L = f.height(), f.toggleClass("head-fixed", M + O > K && K + L > M + O), f.hasClass("head-fixed") ? N.css({
                            width: f.width(),
                            top: O
                        }) : N.attr("style", "")
                    };
            a(window).scroll(P), P()
        }
        d.sortable ? (i.on("click", "th:not(.sort-disabled, .check-btn)", function () {
            f.hasClass("size-changing") || b.sortTable(a(this))
        }), d.storage && b.sortTable()) : d.mergeRows && this.mergeRows()
    }, c.prototype.mergeRows = function () {
        for (var b = this.$rowsSpans.find(".table > tbody > tr > td"), c = this.data.cols, d = 0; d < c.length; d++) {
            var e = c[d];
            if (e.mergeRows) {
                var f = b.filter('[data-index="' + d + '"]');
                if (f.length > 1) {
                    var g, h;
                    f.each(function () {
                        var b = a(this);
                        g && b.html() === g.html() ? (h = g.attr("rowspan") || 1, "number" != typeof h && (h = parseInt(h), isNaN(h) && (h = 1)), g.attr("rowspan", h + 1).css("vertical-align", "middle"), b.remove()) : g = b
                    })
                }
            }
        }
    }, c.prototype.sortTable = function (b) {
        var c = a.zui.store,
                d = this.options,
                e = this.id + "_datatableSorter",
                f = d.storage ? c.pageGet(e) : null;
        if (b || (b = f ? this.$headCells.filter('[data-index="' + f.index + '"]').addClass("sort-" + f.type) : this.$headCells.filter(".sort-up, .sort-down").first()), b.length) {
            var g, h, i, j = this.data,
                    k = j.cols,
                    l = j.rows,
                    m = this.$headCells;
            g = !b.hasClass("sort-up"), m.removeClass("sort-up sort-down"), b.addClass(g ? "sort-up" : "sort-down"), i = b.data("index"), g = b.hasClass("sort-up"), a.each(k, function (a, b) {
                a == i || "up" !== b.sort && "down" !== b.sort ? a == i && (b.sort = g ? "up" : "down", h = b.type) : b.sort = !0
            });
            var n, o, p, q = this.$dataCells.filter('[data-index="' + i + '"]');
            l.sort(function (a, b) {
                return a = a.data[i], b = b.data[i], n = q.filter('[data-row="' + a.row + '"]').text(), o = q.filter('[data-row="' + b.row + '"]').text(), "number" === h ? (n = parseFloat(n), o = parseFloat(o)) : "date" === h ? (n = Date.parse(n), o = Date.parse(o)) : (n = n.toLowerCase(), o = o.toLowerCase()), p = n > o ? 1 : o > n ? -1 : 0, g && (p = -1 * p), p
            });
            var r, s, t, u = this.$rows,
                    v = [];
            a.each(l, function (b, c) {
                r = u.filter('[data-index="' + c.index + '"]'), r.each(function (b) {
                    t = a(this), s = v[b], s ? s.after(t) : t.parent().prepend(t), v[b] = t
                })
            }), f = {
                index: i,
                type: g ? "up" : "down"
            }, d.storage && c.pageSet(e, f), this.callEvent("sort", {
                sorter: f
            })
        }
    }, c.prototype.refreshSize = function () {
        var b, c = this.$datatable,
                d = this.options,
                e = this.data.rows,
                f = this.data.cols;
        c.find(".datatable-span.fixed-left").css("width", d.fixedLeftWidth), c.find(".datatable-span.fixed-right").css("width", d.fixedRightWidth);
        var g = function (b) {
            var c, d, e = 0;
            return b.css("height", "auto"), b.each(function () {
                c = a(this), d = c.attr("rowspan"), d && 1 != d || (e = Math.max(e, c.outerHeight()))
            }), e
        },
                h = this.$dataCells,
                i = this.$cells,
                j = this.$headCells;
        for (b = 0; b < f.length; ++b)
            i.filter('[data-index="' + b + '"]').css("width", f[b].width);
        var k = g(j);
        j.css("min-height", k).css("height", k);
        var l;
        for (b = 0; b < e.length; ++b) {
            l = h.filter('[data-row="' + b + '"]');
            var m = g(l);
            l.css("min-height", m).css("height", m)
        }
    }, c.prototype.callEvent = function (a, b) {
        var c = this.$.callEvent(a + "." + this.name, b, this).result;
        return !(void 0 !== c && !c)
    }, a.fn.datatable = function (d) {
        return this.each(function () {
            var e = a(this),
                    f = e.data(b),
                    g = "object" == typeof d && d;
            f || e.data(b, f = new c(this, g)), "string" == typeof d && f[d]()
        })
    }, a.fn.datatable.Constructor = c
}(jQuery), function (a, b, c) {
    "use strict";

    function d(a) {
        if (a = a.toLowerCase(), a && j.test(a)) {
            var b;
            if (4 === a.length) {
                var c = "#";
                for (b = 1; 4 > b; b += 1)
                    c += a.slice(b, b + 1).concat(a.slice(b, b + 1));
                a = c
            }
            var d = [];
            for (b = 1; 7 > b; b += 2)
                d.push(parseInt("0x" + a.slice(b, b + 2)));
            return {
                r: d[0],
                g: d[1],
                b: d[2],
                a: 1
            }
        }
        throw new Error("function hexToRgb: Wrong hex string! (hex: " + a + ")")
    }
    function e(b) {
        return "string" == typeof b && ("transparent" === b.toLowerCase() || k[b.toLowerCase()] || j.test(a.trim(b.toLowerCase())))
    }
    function f(a) {
        function b(a) {
            return a = 0 > a ? a + 1 : a > 1 ? a - 1 : a, 1 > 6 * a ? j + (g - j) * a * 6 : 1 > 2 * a ? g : 2 > 3 * a ? j + (g - j) * (2 / 3 - a) * 6 : j
        }
        var c = a.h,
                d = a.s,
                e = a.l,
                f = a.a;
        c = i(c) % 360 / 360, d = h(i(d)), e = h(i(e)), f = h(i(f));
        var g = .5 >= e ? e * (d + 1) : e + d - e * d,
                j = 2 * e - g,
                k = {
                    r: 255 * b(c + 1 / 3),
                    g: 255 * b(c),
                    b: 255 * b(c - 1 / 3),
                    a: f
                };
        return k
    }
    function g(a, c, d) {
        return void 0 === d && (d = 0), void 0 === c && (c = 255), b.min(b.max(a, d), c)
    }
    function h(a, b) {
        return g(a, b)
    }
    function i(a) {
        return "number" == typeof a ? a : parseFloat(a)
    }
    var j = /^#([0-9a-fA-f]{3}|[0-9a-fA-f]{6})$/,
            k = {
                aliceblue: "#f0f8ff",
                antiquewhite: "#faebd7",
                aqua: "#00ffff",
                aquamarine: "#7fffd4",
                azure: "#f0ffff",
                beige: "#f5f5dc",
                bisque: "#ffe4c4",
                black: "#000000",
                blanchedalmond: "#ffebcd",
                blue: "#0000ff",
                blueviolet: "#8a2be2",
                brown: "#a52a2a",
                burlywood: "#deb887",
                cadetblue: "#5f9ea0",
                chartreuse: "#7fff00",
                chocolate: "#d2691e",
                coral: "#ff7f50",
                cornflowerblue: "#6495ed",
                cornsilk: "#fff8dc",
                crimson: "#dc143c",
                cyan: "#00ffff",
                darkblue: "#00008b",
                darkcyan: "#008b8b",
                darkgoldenrod: "#b8860b",
                darkgray: "#a9a9a9",
                darkgreen: "#006400",
                darkkhaki: "#bdb76b",
                darkmagenta: "#8b008b",
                darkolivegreen: "#556b2f",
                darkorange: "#ff8c00",
                darkorchid: "#9932cc",
                darkred: "#8b0000",
                darksalmon: "#e9967a",
                darkseagreen: "#8fbc8f",
                darkslateblue: "#483d8b",
                darkslategray: "#2f4f4f",
                darkturquoise: "#00ced1",
                darkviolet: "#9400d3",
                deeppink: "#ff1493",
                deepskyblue: "#00bfff",
                dimgray: "#696969",
                dodgerblue: "#1e90ff",
                firebrick: "#b22222",
                floralwhite: "#fffaf0",
                forestgreen: "#228b22",
                fuchsia: "#ff00ff",
                gainsboro: "#dcdcdc",
                ghostwhite: "#f8f8ff",
                gold: "#ffd700",
                goldenrod: "#daa520",
                gray: "#808080",
                green: "#008000",
                greenyellow: "#adff2f",
                honeydew: "#f0fff0",
                hotpink: "#ff69b4",
                indianred: "#cd5c5c",
                indigo: "#4b0082",
                ivory: "#fffff0",
                khaki: "#f0e68c",
                lavender: "#e6e6fa",
                lavenderblush: "#fff0f5",
                lawngreen: "#7cfc00",
                lemonchiffon: "#fffacd",
                lightblue: "#add8e6",
                lightcoral: "#f08080",
                lightcyan: "#e0ffff",
                lightgoldenrodyellow: "#fafad2",
                lightgray: "#d3d3d3",
                lightgreen: "#90ee90",
                lightpink: "#ffb6c1",
                lightsalmon: "#ffa07a",
                lightseagreen: "#20b2aa",
                lightskyblue: "#87cefa",
                lightslategray: "#778899",
                lightsteelblue: "#b0c4de",
                lightyellow: "#ffffe0",
                lime: "#00ff00",
                limegreen: "#32cd32",
                linen: "#faf0e6",
                magenta: "#ff00ff",
                maroon: "#800000",
                mediumaquamarine: "#66cdaa",
                mediumblue: "#0000cd",
                mediumorchid: "#ba55d3",
                mediumpurple: "#9370db",
                mediumseagreen: "#3cb371",
                mediumslateblue: "#7b68ee",
                mediumspringgreen: "#00fa9a",
                mediumturquoise: "#48d1cc",
                mediumvioletred: "#c71585",
                midnightblue: "#191970",
                mintcream: "#f5fffa",
                mistyrose: "#ffe4e1",
                moccasin: "#ffe4b5",
                navajowhite: "#ffdead",
                navy: "#000080",
                oldlace: "#fdf5e6",
                olive: "#808000",
                olivedrab: "#6b8e23",
                orange: "#ffa500",
                orangered: "#ff4500",
                orchid: "#da70d6",
                palegoldenrod: "#eee8aa",
                palegreen: "#98fb98",
                paleturquoise: "#afeeee",
                palevioletred: "#db7093",
                papayawhip: "#ffefd5",
                peachpuff: "#ffdab9",
                peru: "#cd853f",
                pink: "#ffc0cb",
                plum: "#dda0dd",
                powderblue: "#b0e0e6",
                purple: "#800080",
                red: "#ff0000",
                rosybrown: "#bc8f8f",
                royalblue: "#4169e1",
                saddlebrown: "#8b4513",
                salmon: "#fa8072",
                sandybrown: "#f4a460",
                seagreen: "#2e8b57",
                seashell: "#fff5ee",
                sienna: "#a0522d",
                silver: "#c0c0c0",
                skyblue: "#87ceeb",
                slateblue: "#6a5acd",
                slategray: "#708090",
                snow: "#fffafa",
                springgreen: "#00ff7f",
                steelblue: "#4682b4",
                tan: "#d2b48c",
                teal: "#008080",
                thistle: "#d8bfd8",
                tomato: "#ff6347",
                turquoise: "#40e0d0",
                violet: "#ee82ee",
                wheat: "#f5deb3",
                white: "#ffffff",
                whitesmoke: "#f5f5f5",
                yellow: "#ffff00",
                yellowgreen: "#9acd32"
            },
    l = function (a, b, c, e) {
        if (this.r = 0, this.g = 0, this.b = 0, this.a = 1, void 0 !== e && (this.a = h(i(e), 1)), void 0 !== a && void 0 !== b && void 0 !== c)
            this.r = parseInt(h(i(a), 255)), this.g = parseInt(h(i(b), 255)), this.b = parseInt(h(i(c), 255));
        else if (void 0 !== a) {
            var g = typeof a;
            if ("string" == g)
                a = a.toLowerCase(), "transparent" === a ? this.a = 0 : this.rgb(k[a] ? d(k[a]) : d(a));
            else if ("number" == g && void 0 === b)
                this.r = parseInt(h(a, 255)), this.g = this.r, this.b = this.r;
            else if ("object" == g && a.hasOwnProperty("r"))
                this.r = parseInt(h(i(a.r), 255)), a.hasOwnProperty("g") && (this.g = parseInt(h(i(a.g), 255))), a.hasOwnProperty("b") && (this.b = parseInt(h(i(a.b), 255))), a.hasOwnProperty("a") && (this.a = h(i(a.a), 1));
            else if ("object" == g && a.hasOwnProperty("h")) {
                var j = {
                    h: h(i(a.h), 360),
                    s: 1,
                    l: 1,
                    a: 1
                };
                a.hasOwnProperty("s") && (j.s = h(i(a.s), 1)), a.hasOwnProperty("l") && (j.l = h(i(a.l), 1)), a.hasOwnProperty("a") && (j.a = h(i(a.a), 1)), this.rgb(f(j))
            }
        }
    };
    l.prototype.rgb = function (a) {
        if (void 0 !== a) {
            if ("object" == typeof a)
                a.hasOwnProperty("r") && (this.r = parseInt(h(i(a.r), 255))), a.hasOwnProperty("g") && (this.g = parseInt(h(i(a.g), 255))), a.hasOwnProperty("b") && (this.b = parseInt(h(i(a.b), 255))), a.hasOwnProperty("a") && (this.a = h(i(a.a), 1));
            else {
                var b = parseInt(i(a));
                this.r = b, this.g = b, this.b = b
            }
            return this
        }
        return {
            r: this.r,
            g: this.g,
            b: this.b,
            a: this.a
        }
    }, l.prototype.hue = function (a) {
        var b = this.toHsl();
        return void 0 === a ? b.h : (b.h = h(i(a), 360), this.rgb(f(b)), this)
    }, l.prototype.darken = function (a) {
        var b = this.toHsl();
        return b.l -= a / 100, b.l = h(b.l, 1), this.rgb(f(b)), this
    }, l.prototype.clone = function () {
        return new l(this.r, this.g, this.b, this.a)
    }, l.prototype.lighten = function (a) {
        return this.darken(-a)
    }, l.prototype.fade = function (a) {
        return this.a = h(a / 100, 1), this
    }, l.prototype.spin = function (a) {
        var b = this.toHsl(),
                c = (b.h + a) % 360;
        return b.h = 0 > c ? 360 + c : c, this.rgb(f(b)), this
    }, l.prototype.toHsl = function () {
        var a, c, d = this.r / 255,
                e = this.g / 255,
                f = this.b / 255,
                g = this.a,
                h = b.max(d, e, f),
                i = b.min(d, e, f),
                j = (h + i) / 2,
                k = h - i;
        if (h === i)
            a = c = 0;
        else {
            switch (c = j > .5 ? k / (2 - h - i) : k / (h + i), h) {
                case d:
                    a = (e - f) / k + (f > e ? 6 : 0);
                    break;
                case e:
                    a = (f - d) / k + 2;
                    break;
                case f:
                    a = (d - e) / k + 4
            }
            a /= 6
        }
        return {
            h: 360 * a,
            s: c,
            l: j,
            a: g
        }
    }, l.prototype.luma = function () {
        var a = this.r / 255,
                c = this.g / 255,
                d = this.b / 255;
        return a = .03928 >= a ? a / 12.92 : b.pow((a + .055) / 1.055, 2.4), c = .03928 >= c ? c / 12.92 : b.pow((c + .055) / 1.055, 2.4), d = .03928 >= d ? d / 12.92 : b.pow((d + .055) / 1.055, 2.4), .2126 * a + .7152 * c + .0722 * d
    }, l.prototype.saturate = function (a) {
        var b = this.toHsl();
        return b.s += a / 100, b.s = h(b.s), this.rgb(f(b)), this
    }, l.prototype.desaturate = function (a) {
        return this.saturate(-a)
    }, l.prototype.contrast = function (a, b, c) {
        if (b = "undefined" == typeof b ? new l(255, 255, 255, 1) : new l(b), a = "undefined" == typeof a ? new l(0, 0, 0, 1) : new l(a), this.a < .5)
            return a;
        if (c = void 0 === c ? .43 : i(c), a.luma() > b.luma()) {
            var d = b;
            b = a, a = d
        }
        return this.luma() < c ? b : a
    }, l.prototype.hexStr = function () {
        var a = this.r.toString(16),
                b = this.g.toString(16),
                c = this.b.toString(16);
        return 1 == a.length && (a = "0" + a), 1 == b.length && (b = "0" + b), 1 == c.length && (c = "0" + c), "#" + a + b + c
    }, l.prototype.toCssStr = function () {
        return this.a > 0 ? this.a < 1 ? "rgba(" + this.r + "," + this.g + "," + this.b + "," + this.a + ")" : this.hexStr() : "transparent"
    }, l.prototype.isColor = e, a.zui({
        Color: l
    })
}(jQuery, Math, window), function (a, b) {
    "use strict";
    var c = "zui.calendar",
            d = "number",
            e = "string",
            f = "undefined",
            g = {
                primary: 1,
                green: 2,
                red: 3,
                blue: 4,
                yellow: 5,
                brown: 6,
                purple: 7
            },
    h = function (a, b) {
        b = b || 1;
        for (var c = a.clone(); c.getDay() != b; )
            c.addDays(-1);
        return c.clearTime(), c
    },
            i = function (a) {
                var b = a.clone();
                return b.setDate(1), b
            },
            j = function (a, b) {
                var c = a.clone().clearTime(),
                        d = b.clone().clearTime();
                return Math.round((d.getTime() - c.getTime()) / Date.ONEDAY_TICKS) + 1
            },
            k = function (a, b, c) {
                for (var d = a.clone(), e = 0; b >= d; )
                    c(d.clone(), e++), d.addDays(1)
            },
            l = function (b, d) {
                if (this.name = c, this.$ = a(b), this.id = this.$.attr("id") || c + a.zui.uuid(), this.$.attr("id", this.id), this.storeName = c + "." + this.id, this.getOptions(d), this.getLang(), this.data = this.options.data, this.addCalendars(this.data.calendars), this.addEvents(this.data.events), this.sortEvents(), this.storeData = a.zui.store.pageGet(this.storeName, {
                    date: "today",
                    view: "month"
                }), this.date = this.options.startDate || "today", this.view = this.options.startView || "month", this.date = "today", this.$.toggleClass("limit-event-title", d.limitEventTitle), this.options.withHeader) {
                    var e = this.$.children(".calender-header");
                    e.length || (e = a('<header><div class="btn-toolbar"><div class="btn-group"><button type="button" class="btn btn-today">{today}</button></div><div class="btn-group"><button type="button" class="btn btn-prev"><i class="icon-chevron-left"></i></button><button type="button" class="btn btn-next"><i class="icon-chevron-right"></i></button></div><div class="btn-group"><span class="calendar-caption"></span></div></div></header>'.format(this.lang)), this.$.append(e)), this.$caption = e.find(".calendar-caption"), this.$todayBtn = e.find(".btn-today"), this.$header = e
                }
                var f = this.$.children(".calendar-views");
                f.length || (f = a('<div class="calendar-views"></div>'), this.$.append(f)), this.$views = f, this.$monthView = f.children(".calendar-view.month"), this.display(), this.bindEvents()
            };
    l.DEFAULTS = {
        langs: {
            zh_cn: {
                weekNames: ["鍛ㄤ竴", "鍛ㄤ簩", "鍛ㄤ笁", "鍛ㄥ洓", "鍛ㄤ簲", "鍛ㄥ叚", "鍛ㄦ棩"],
                monthNames: ["涓€鏈�", "浜屾湀", "涓夋湀", "鍥涙湀", "浜旀湀", "鍏湀", "涓冩湀", "鍏湀", "涔濇湀", "鍗佹湀", "鍗佷竴鏈�", "鍗佷簩鏈�"],
                today: "浠婂ぉ",
                year: "{0}骞�",
                month: "{0}鏈�",
                yearMonth: "{0}骞磠1}鏈�"
            },
            zh_tw: {
                weekNames: ["閫变竴", "閫变簩", "閫变笁", "閫卞洓", "閫变簲", "閫卞叚", "閫辨棩"],
                monthNames: ["涓€鏈�", "浜屾湀", "涓夋湀", "鍥涙湀", "浜旀湀", "鍏湀", "涓冩湀", "鍏湀", "涔濇湀", "鍗佹湀", "鍗佷竴鏈�", "鍗佷簩鏈�"],
                today: "浠婂ぉ",
                year: "{0}骞�",
                month: "{0}鏈�",
                yearMonth: "{0}骞磠1}鏈�"
            },
            en: {
                weekNames: ["Mon", "Tue", "Wed", "Thu", "Fri", "Sat", "Sun"],
                monthNames: ["Jan", "Feb", "Mar", "Apr", "May", "June", "July", "Aug", "Sep", "Oct", "Nov", "Dec"],
                today: "Today",
                year: "{0}",
                month: "{0}",
                yearMonth: "{2}, {0}"
            }
        },
        data: {
            calendars: {
                defaultCal: {
                    color: "#229F24"
                }
            },
            events: []
        },
        limitEventTitle: !0,
        storage: !0,
        withHeader: !0,
        dragThenDrop: !0
    }, l.prototype.sortEvents = function () {
        var b = this.events;
        a.isArray(b) || (b = []), b.sort(function (a, b) {
            return a.start > b.start ? 1 : a.start < b.start ? -1 : 0
        })
    }, l.prototype.bindEvents = function () {
        var b = this.$,
                c = this;
        b.on("click", ".btn-today", function () {
            c.date = new Date, c.display(), c.callEvent("clickTodayBtn")
        }).on("click", ".btn-next", function () {
            "month" === c.view && c.date.addMonths(1), c.display(), c.callEvent("clickNextBtn")
        }).on("click", ".btn-prev", function () {
            "month" === c.view && c.date.addMonths(-1), c.display(), c.callEvent("clickPrevBtn")
        }).on("click", ".event", function (b) {
            c.callEvent("clickEvent", {
                element: this,
                event: a(this).data("event"),
                events: c.events
            }), b.stopPropagation()
        }).on("click", ".cell-day", function () {
            c.callEvent("clickCell", {
                element: this,
                view: c.view,
                date: new Date(a(this).children(".day").attr("data-date")),
                events: c.events
            })
        })
    }, l.prototype.addCalendars = function (b, c) {
        var d = this;
        d.calendars || (d.calendars = {}), a.isPlainObject(b) && (b = [b]), a.each(b, function (b, e) {
            if (c || d.callEvent("beforeAddCalendars", {
                newCalendar: e,
                data: d.data
            })) {
                if (e.color || (e.color = "primary"), g[e.color.toLowerCase()])
                    e.presetColor = !0;
                else {
                    var f = new a.zui.Color(e.color);
                    e.textColor = f.contrast().hexStr()
                }
                d.calendars[e.name] = e
            }
        }), c || (d.display(), d.callEvent("addCalendars", {
            newCalendars: b,
            data: d.data
        }))
    }, l.prototype.addEvents = function (b, c) {
        var g = this;
        g.events || (g.events = []), a.isPlainObject(b) && (b = [b]), a.each(b, function (b, h) {
            if (c || g.callEvent("beforeAddEvent", {
                newEvent: h,
                data: g.data
            })) {
                var i = typeof h.start,
                        k = typeof h.end;
                (i === d || i === e) && (h.start = new Date(h.start)), (k === d || k === e) && (h.end = new Date(h.end)), typeof h.id === f && (h.id = a.zui.uuid()), h.allDay && (h.start.clearTime(), h.end.clearTime().addDays(1).addMilliseconds(-1)), h.days = j(h.start, h.end), g.events.push(h)
            }
        }), c || (g.sortEvents(), g.display(), g.callEvent("addEvents", {
            newEvents: b,
            data: g.data
        }))
    }, l.prototype.getEvent = function (a) {
        for (var b = this.events, c = 0; c < b.length; c++)
            if (b[c].id == a)
                return b[c];
        return null
    }, l.prototype.updateEvents = function (b) {
        var c = {
            data: this.data,
            changes: []
        },
        d = this;
        a.isPlainObject(b) && (b = [b]);
        var f, g, h;
        a.each(b, function (b, i) {
            f = i.event, g = i.changes, h = {
                event: f,
                changes: []
            }, typeof f === e && (f = d.getEvent(f)), f && (a.isPlainObject(g) && (g = [g]), a.each(function (b, c) {
                d.callEvent("beforeChange", {
                    event: f,
                    change: c.change,
                    to: c.to,
                    from: f[c.change]
                }) && (h.changes.push(a.entend(!0, {}, c, {
                    from: f[c.change]
                })), f[c.change] = c.to)
            })), c.changes.push(h)
        }), d.sortEvents(), d.display(), d.callEvent("change", c)
    }, l.prototype.removeEvents = function (b) {
        a.isArray(b) || (b = [b]);
        var c, d, e, f = this.events,
                g = this,
                h = [];
        a.each(b, function (b, i) {
            c = a.isPlainObject(i) ? i.id : i, e = -1;
            for (var j = 0; j < f.length; j++)
                if (f[j].id == c) {
                    e = j, d = f[j];
                    break
                }
            e >= 0 && g.callEvent("beforeRemoveEvent", {
                event: d,
                eventId: c,
                data: g.data
            }) && (f.splice(e, 1), h.push(d))
        }), g.sortEvents(), g.display(), g.callEvent("removeEvents", {
            removedEvents: h,
            data: g.data
        })
    }, l.prototype.getOptions = function (b) {
        this.options = a.extend({}, l.DEFAULTS, this.$.data(), b)
    }, l.prototype.getLang = function () {
        this.lang = this.options.langs[this.options.lang || a.zui.clientLang()]
    }, l.prototype.display = function (b, c) {
        var d = this,
                g = typeof b,
                h = typeof c;
        g === f ? b = d.view : d.view = b, h === f ? c = d.date : d.date = c, "today" === c && (c = new Date, d.date = c), typeof c === e && (c = new Date(c), d.date = c), d.options.storage && a.zui.store.pageSet(d.storeName, {
            date: c,
            view: b
        });
        var i = {
            view: b,
            date: c
        };
        if (d.callEvent("beforeDisplay", i)) {
            switch (b) {
                case "month":
                    d.displayMonth(c)
            }
            d.callEvent("display", i)
        }
    }, l.prototype.displayMonth = function (b) {
        var c = this;
        b = b || c.date;
        var d, e = c.options,
                f = c,
                g = c.lang,
                j = c.$views,
                k = c.$,
                l = f.$monthView;
        if (!l.length) {
            l = a('<div class="calendar-view month"><table class="table table-bordered"><thead><tr class="week-head"></tr></thead><tbody class="month-days"></tbody></table></div>');
            var m, n = l.find(".week-head"),
                    o = l.find(".month-days");
            for (d = 0; 7 > d; d++)
                n.append("<th>" + g.weekNames[d] + "</th>");
            for (d = 0; 6 > d; d++) {
                m = a('<tr class="week-days"></tr>');
                for (var p = 0; 7 > p; p++)
                    m.append('<td class="cell-day"><div class="day"><div class="heading"><span class="month"></span> <span class="number"></span></div><div class="content"><div class="events"></div></div></div></td>');
                o.append(m)
            }
            j.append(l), f.$monthView = l
        }
        var q, r, s, t, u, v, w, x, y, z, A, B = l.find(".week-days"),
                C = l.find(".day"),
                D = i(b),
                E = new Date,
                F = h(D),
                G = b.getFullYear(),
                H = b.getMonth(),
                I = E.getMonth(),
                J = E.getFullYear(),
                K = E.getDate(),
                L = F.clone().addDays(42).addMilliseconds(-1),
                M = F.clone().addDays(1).addMilliseconds(-1),
                N = c.getEvents(F, L),
                O = c.calendars;
        B.each(function (b) {
            q = a(this), q.find(".day").each(function (c) {
                x = 0 === c, r = a(this), s = r.closest(".cell-day"), t = M.getFullYear(), u = M.getDate(), v = M.getMonth(), w = M.toDateString(), r.attr("data-date", w), r.find(".heading > .number").text(u), r.find(".heading > .month").toggle(0 === b && 0 === c || 1 === u).text((0 === v && 1 === u ? g.year.format(t) + " " : "") + g.monthNames[v]), s.toggleClass("current-month", v === H), s.toggleClass("current", u === K && v === I && t === J), s.toggleClass("past", E > M), s.toggleClass("future", M > E), A = r.find(".events").empty();
                var e = N[w];
                if (e) {
                    var f, h = e.events,
                            i = 0;
                    for (d = 0; d <= e.maxPos; ++d)
                        f = h[d], !f || f.placeholder && !x ? i++ : (y = a('<div data-id="' + f.id + '" class="event" title="' + f.desc + '"><span class="time">' + f.start.format("hh:mm") + '</span> <span class="title">' + f.title + "</span></div>"), y.find(".time").toggle(!f.allDay), y.data("event", f), y.attr("data-days", f.days), f.calendar && (z = O[f.calendar], z && (z.presetColor ? y.addClass("color-" + z.color) : y.css({
                            "background-color": z.color,
                            color: z.textColor
                        }))), f.days && (f.placeholder ? x && y.css("width", Math.min(7, f.days - f.holderPos) + "00%") : y.css("width", Math.min(7 - c, f.days) + "00%")), i > 0 && (y.css("margin-top", 22 * i), i = 0), A.append(y))
                }
                M.addDays(1)
            })
        }), e.withHeader && (c.$caption.text(g.yearMonth.format(G, H + 1, g.monthNames[H])), c.$todayBtn.toggleClass("disabled", H === I)), e.dragThenDrop && l.find(".event").droppable({
            target: C,
            container: l,
            flex: !0,
            start: function () {
                k.addClass("event-dragging")
            },
            drop: function (a) {
                var b = a.element.data("event"),
                        d = a.target.attr("data-date"),
                        e = b.start.clone();
                if (e.toDateString() != d && (d = new Date(d), d.setHours(e.getHours()), d.setMinutes(e.getMinutes()), d.setSeconds(e.getSeconds()), f.callEvent("beforeChange", {
                    event: b,
                    change: "start",
                    to: d
                }))) {
                    var g = b.end.clone();
                    b.end.addMilliseconds(b.end.getTime() - e.getTime()), b.start = d, c.display(), f.callEvent("change", {
                        data: f.data,
                        changes: [{
                                event: b,
                                changes: [{
                                        change: "start",
                                        from: e,
                                        to: b.start
                                    }, {
                                        change: "end",
                                        from: g,
                                        to: b.end
                                    }]
                            }]
                    })
                }
            },
            finish: function () {
                k.removeClass("event-dragging")
            }
        })
    }, l.prototype.getEvents = function (b, c) {
        var d = {},
                e = (this.calendars, function (a, b, c) {
                    var e = a.toDateString(),
                            f = d[e];
                    if (f || (f = {
                        maxPos: -1,
                        events: {}
                    }), "undefined" == typeof c)
                        for (var g = 0; 100 > g; ++g)
                            if (!f.events[g]) {
                                c = g;
                                break
                            }
                    return f.maxPos = Math.max(c, f.maxPos), f.events[c] = b, d[e] = f, c
                });
        return a.each(this.events, function (d, f) {
            if (f.start >= b && f.start <= c) {
                var g = e(f.start, f);
                if (f.days > 1) {
                    var h = a.extend({
                        placeholder: !0
                    }, f);
                    k(f.start.clone().addDays(1), f.end, function (b, c) {
                        e(b.clone(), a.extend({
                            holderPos: c
                        }, h), g)
                    })
                }
            }
        }), d
    }, l.prototype.callEvent = function (a, b) {
        var c = this.$.callEvent(a + "." + this.name, b, this);
        return !(void 0 !== c.result && !c.result)
    }, a.fn.calendar = function (b) {
        return this.each(function () {
            var d = a(this),
                    f = d.data(c),
                    g = "object" == typeof b && b;
            f || d.data(c, f = new l(this, g)), typeof b == e && f[b]()
        })
    }, a.fn.calendar.Constructor = l
}(jQuery, window), function (a) {
    function b(b) {
        if ("string" == typeof b.data) {
            var c = b.handler,
                    d = b.data.toLowerCase().split(" ");
            b.handler = function (b) {
                if (this === b.target || !/textarea|select/i.test(b.target.nodeName) && "text" !== b.target.type) {
                    var e = "keypress" !== b.type && a.hotkeys.specialKeys[b.which],
                            f = String.fromCharCode(b.which).toLowerCase(),
                            g = "",
                            h = {};
                    b.altKey && "alt" !== e && (g += "alt+"), b.ctrlKey && "ctrl" !== e && (g += "ctrl+"), b.metaKey && !b.ctrlKey && "meta" !== e && (g += "meta+"), b.shiftKey && "shift" !== e && (g += "shift+"), e ? h[g + e] = !0 : (h[g + f] = !0, h[g + a.hotkeys.shiftNums[f]] = !0, "shift+" === g && (h[a.hotkeys.shiftNums[f]] = !0));
                    for (var i = 0, j = d.length; j > i; i++)
                        if (h[d[i]])
                            return c.apply(this, arguments)
                }
            }
        }
    }
    a.hotkeys = {
        version: "0.8",
        specialKeys: {
            8: "backspace",
            9: "tab",
            13: "return",
            16: "shift",
            17: "ctrl",
            18: "alt",
            19: "pause",
            20: "capslock",
            27: "esc",
            32: "space",
            33: "pageup",
            34: "pagedown",
            35: "end",
            36: "home",
            37: "left",
            38: "up",
            39: "right",
            40: "down",
            45: "insert",
            46: "del",
            96: "0",
            97: "1",
            98: "2",
            99: "3",
            100: "4",
            101: "5",
            102: "6",
            103: "7",
            104: "8",
            105: "9",
            106: "*",
            107: "+",
            109: "-",
            110: ".",
            111: "/",
            112: "f1",
            113: "f2",
            114: "f3",
            115: "f4",
            116: "f5",
            117: "f6",
            118: "f7",
            119: "f8",
            120: "f9",
            121: "f10",
            122: "f11",
            123: "f12",
            144: "numlock",
            145: "scroll",
            191: "/",
            224: "meta"
        },
        shiftNums: {
            "`": "~",
            1: "!",
            2: "@",
            3: "#",
            4: "$",
            5: "%",
            6: "^",
            7: "&",
            8: "*",
            9: "(",
            0: ")",
            "-": "_",
            "=": "+",
            ";": ": ",
            "'": '"',
            ",": "<",
            ".": ">",
            "/": "?",
            "\\": "|"
        }
    }, a.each(["keydown", "keyup", "keypress"], function () {
        a.event.special[this] = {
            add: b
        }
    })
}(jQuery), function (a) {
    "use strict";
    var b = function (b, c) {
        this.$ = a(b), this.options = this.getOptions(c), this.init()
    };
    b.DEFAULTS = {
        trigger: "toggle",
        animate: "slide",
        easing: "linear",
        animateSpeed: "fast",
        events: "click",
        preventDefault: !0,
        cancelBubble: !0
    }, b.prototype.getOptions = function (c) {
        return c = a.extend({}, b.DEFAULTS, this.$.data(), c)
    }, b.prototype.init = function () {
        this.bindEvents()
    }, b.prototype.bindEvents = function () {
        var b, c = this.options;
        if (this.bindTrigger(c), a.isArray(c.triggers))
            for (b in c.triggers)
                this.bindTrigger(a.extend({}, c, c.triggers[b]));
        else if ("string" == typeof c.triggers) {
            var d = c.triggers.split("|");
            for (b in d) {
                var e = d[b].split(",", 4);
                if (!(e.length < 2)) {
                    var f = {};
                    e[0] && (f.events = e[0]), e[1] && (f.trigger = e[1]), e[2] && (f.target = e[2]), e[3] && (f.data = e[3]), this.bindTrigger(a.extend({}, c, f))
                }
            }
        }
    }, b.prototype.bindTrigger = function (b) {
        var c = this;
        c.$.on(b.events, b.selector, function (d) {
            var e = b.target && "self" != b.target ? a(b.target) : c.$,
                    f = {
                        event: d,
                        element: this,
                        target: e,
                        options: b
                    };
            if (a.zui.callEvent(b.before, f, c)) {
                if (a.isFunction(b.trigger))
                    a.zui.callEvent(b.trigger, f, c);
                else {
                    var g = b.trigger;
                    "toggle" === g && (g = e.hasClass("hide") ? "show" : "hide");
                    var h;
                    switch (g) {
                        case "toggle":
                            e.toggle();
                            break;
                        case "show":
                            h = {
                                duration: b.animateSpeed,
                                easing: b.easing
                            }, e.removeClass("hide"), "slide" === b.animate ? e.slideDown(h) : "fade" === b.animate ? e.fadeIn(h) : e.show(h);
                            break;
                        case "hide":
                            h = {
                                duration: b.animateSpeed,
                                easing: b.easing,
                                complete: function () {
                                    e.addClass("hide")
                                }
                            }, "slide" === b.animate ? e.slideUp(h) : "fade" === b.animate ? e.fadeOut(h) : e.hide(h);
                            break;
                        case "addClass":
                        case "removeClass":
                        case "toggleClass":
                            e[g](b.data)
                    }
                }
                a.zui.callEvent(b.after, f, c), b.preventDefault && d.preventDefault(), b.cancelBubble && d.stopPropagation()
            }
        })
    }, a.fn.autoTrigger = function (c) {
        return this.each(function () {
            var d = a(this),
                    e = d.data("zui.autoTrigger"),
                    f = "object" == typeof c && c;
            e || d.data("zui.autoTrigger", e = new b(this, f)), "string" == typeof c && e[c]()
        })
    }, a.fn.autoTrigger.Constructor = b, a(function () {
        a('[data-toggle="autoTrigger"]').autoTrigger(), a('[data-toggle="toggle"]').autoTrigger(), a('[data-toggle="show"]').autoTrigger({
            trigger: "show"
        }), a('[data-toggle="hide"]').autoTrigger({
            trigger: "hide"
        }), a('[data-toggle="addClass"]').autoTrigger({
            trigger: "addClass"
        }), a('[data-toggle="removeClass"]').autoTrigger({
            trigger: "removeClass"
        }), a('[data-toggle="toggleClass"]').autoTrigger({
            trigger: "toggleClass"
        })
    })
}(jQuery), function () {
    var a, b, c, d, e, f = {}.hasOwnProperty,
            g = function (a, b) {
                function c() {
                    this.constructor = a
                }
                for (var d in b)
                    f.call(b, d) && (a[d] = b[d]);
                return c.prototype = b.prototype, a.prototype = new c, a.__super__ = b.prototype, a
            };
    d = function () {
        function b() {
            this.options_index = 0, this.parsed = []
        }
        return b.prototype.add_node = function (a) {
            return "OPTGROUP" === a.nodeName.toUpperCase() ? this.add_group(a) : this.add_option(a)
        }, b.prototype.add_group = function (b) {
            var c, d, e, f, g, h;
            for (c = this.parsed.length, this.parsed.push({
            array_index: c,
                    group: !0,
                    label: this.escapeExpression(b.label),
                    children: 0,
                    disabled: b.disabled,
                    title: b.title,
                    search_keys: a.trim(b.getAttribute("data-keys") || "").replace(/,/, " ")
            }), g = b.childNodes, h = [], e = 0, f = g.length; f > e; e++)
                d = g[e], h.push(this.add_option(d, c, b.disabled));
            return h
        }, b.prototype.add_option = function (b, c, d) {
            return "OPTION" === b.nodeName.toUpperCase() ? ("" !== b.text ? (null != c && (this.parsed[c].children += 1), this.parsed.push({
                array_index: this.parsed.length,
                options_index: this.options_index,
                value: b.value,
                text: b.text,
                title: b.title,
                html: b.innerHTML,
                selected: b.selected,
                disabled: d === !0 ? d : b.disabled,
                group_array_index: c,
                classes: b.className,
                style: b.style.cssText,
                search_keys: a.trim(b.getAttribute("data-keys") || "").replace(/,/, " ")
            })) : this.parsed.push({
                array_index: this.parsed.length,
                options_index: this.options_index,
                empty: !0
            }), this.options_index += 1) : void 0
        }, b.prototype.escapeExpression = function (a) {
            var b, c;
            return null == a || a === !1 ? "" : /[\&\<\>\"\'\`]/.test(a) ? (b = {
                "<": "&lt;",
                ">": "&gt;",
                '"': "&quot;",
                "'": "&#x27;",
                "`": "&#x60;"
            }, c = /&(?!\w+;)|[\<\>\"\'\`]/g, a.replace(c, function (a) {
                return b[a] || "&amp;"
            })) : a
        }, b
    }(), d.select_to_array = function (a) {
        var b, c, e, f, g;
        for (c = new d, g = a.childNodes, e = 0, f = g.length; f > e; e++)
            b = g[e], c.add_node(b);
        return c.parsed
    }, b = function () {
        function a(b, c) {
            this.form_field = b, this.options = null != c ? c : {}, a.browser_is_supported() && (this.is_multiple = this.form_field.multiple, this.set_default_text(), this.set_default_values(), this.setup(), this.set_up_html(), this.register_observers())
        }
        return a.prototype.set_default_values = function () {
            var a = this;
            return this.click_test_action = function (b) {
                return a.test_active_click(b)
            }, this.activate_action = function (b) {
                return a.activate_field(b)
            }, this.active_field = !1, this.mouse_on_container = !1, this.results_showing = !1, this.result_highlighted = null, this.allow_single_deselect = null != this.options.allow_single_deselect && null != this.form_field.options[0] && "" === this.form_field.options[0].text ? this.options.allow_single_deselect : !1, this.disable_search_threshold = this.options.disable_search_threshold || 0, this.disable_search = this.options.disable_search || !1, this.enable_split_word_search = null != this.options.enable_split_word_search ? this.options.enable_split_word_search : !0, this.group_search = null != this.options.group_search ? this.options.group_search : !0, this.search_contains = this.options.search_contains || !1, this.single_backstroke_delete = null != this.options.single_backstroke_delete ? this.options.single_backstroke_delete : !0, this.max_selected_options = this.options.max_selected_options || 1 / 0, this.inherit_select_classes = this.options.inherit_select_classes || !1, this.display_selected_options = null != this.options.display_selected_options ? this.options.display_selected_options : !0, this.display_disabled_options = null != this.options.display_disabled_options ? this.options.display_disabled_options : !0
        }, a.prototype.set_default_text = function () {
            return this.default_text = this.form_field.getAttribute("data-placeholder") ? this.form_field.getAttribute("data-placeholder") : this.is_multiple ? this.options.placeholder_text_multiple || this.options.placeholder_text || a.default_multiple_text : this.options.placeholder_text_single || this.options.placeholder_text || a.default_single_text, this.results_none_found = this.form_field.getAttribute("data-no_results_text") || this.options.no_results_text || a.default_no_result_text
        }, a.prototype.mouse_enter = function () {
            return this.mouse_on_container = !0
        }, a.prototype.mouse_leave = function () {
            return this.mouse_on_container = !1
        }, a.prototype.input_focus = function (a) {
            var b = this;
            if (this.is_multiple) {
                if (!this.active_field)
                    return setTimeout(function () {
                        return b.container_mousedown()
                    }, 50)
            } else if (!this.active_field)
                return this.activate_field()
        }, a.prototype.input_blur = function (a) {
            var b = this;
            return this.mouse_on_container ? void 0 : (this.active_field = !1, setTimeout(function () {
                return b.blur_test()
            }, 100))
        }, a.prototype.results_option_build = function (a) {
            var b, c, d, e, f;
            for (b = "", f = this.results_data, d = 0, e = f.length; e > d; d++)
                c = f[d], b += c.group ? this.result_add_group(c) : this.result_add_option(c), (null != a ? a.first : void 0) && (c.selected && this.is_multiple ? this.choice_build(c) : c.selected && !this.is_multiple && this.single_set_selected_text(c.text));
            return b
        }, a.prototype.result_add_option = function (a) {
            var b, c;
            return a.search_match && this.include_option_in_results(a) ? (b = [], a.disabled || a.selected && this.is_multiple || b.push("active-result"), !a.disabled || a.selected && this.is_multiple || b.push("disabled-result"), a.selected && b.push("result-selected"), null != a.group_array_index && b.push("group-option"), "" !== a.classes && b.push(a.classes), c = document.createElement("li"), c.className = b.join(" "), c.style.cssText = a.style, c.title = a.title, c.setAttribute("data-option-array-index", a.array_index), c.innerHTML = a.search_text, this.outerHTML(c)) : ""
        }, a.prototype.result_add_group = function (a) {
            var b;
            return (a.search_match || a.group_match) && a.active_options > 0 ? (b = document.createElement("li"), b.className = "group-result", b.title = a.title, b.innerHTML = a.search_text, this.outerHTML(b)) : ""
        }, a.prototype.results_update_field = function () {
            return this.set_default_text(), this.is_multiple || this.results_reset_cleanup(), this.result_clear_highlight(), this.results_build(), this.results_showing ? this.winnow_results() : void 0
        }, a.prototype.reset_single_select_options = function () {
            var a, b, c, d, e;
            for (d = this.results_data, e = [], b = 0, c = d.length; c > b; b++)
                a = d[b], e.push(a.selected ? a.selected = !1 : void 0);
            return e
        }, a.prototype.results_toggle = function () {
            return this.results_showing ? this.results_hide() : this.results_show()
        }, a.prototype.results_search = function (a) {
            return this.results_showing ? this.winnow_results() : this.results_show()
        }, a.prototype.winnow_results = function () {
            var a, b, c, d, e, f, g, h, i, j, k, l, m;
            for (this.no_results_clear(), e = 0, g = this.get_search_text(), a = g.replace(/[-[\]{}()*+?.,\\^$|#\s]/g, "\\$&"), d = this.search_contains ? "" : "^", c = new RegExp(d + a, "i"), j = new RegExp(a, "i"), m = this.results_data, k = 0, l = m.length; l > k; k++)
                b = m[k], b.search_match = !1, f = null, this.include_option_in_results(b) && (b.group && (b.group_match = !1, b.active_options = 0), null != b.group_array_index && this.results_data[b.group_array_index] && (f = this.results_data[b.group_array_index], 0 === f.active_options && f.search_match && (e += 1), f.active_options += 1), (!b.group || this.group_search) && (b.search_text = b.group ? b.label : b.html, b.search_keys_match = this.search_string_match(b.search_keys, c), b.search_text_match = this.search_string_match(b.search_text, c), b.search_match = b.search_text_match || b.search_keys_match, b.search_match && !b.group && (e += 1), b.search_match ? (b.search_text_match && b.search_text.length ? (h = b.search_text.search(j), i = b.search_text.substr(0, h + g.length) + "</em>" + b.search_text.substr(h + g.length), b.search_text = i.substr(0, h) + "<em>" + i.substr(h)) : b.search_keys_match && b.search_keys.length && (h = b.search_keys.search(j), i = b.search_keys.substr(0, h + g.length) + "</em>" + b.search_keys.substr(h + g.length), b.search_text += '&nbsp; <small style="opacity: 0.7">' + i.substr(0, h) + "<em>" + i.substr(h) + "</small>"), null != f && (f.group_match = !0)) : null != b.group_array_index && this.results_data[b.group_array_index].search_match && (b.search_match = !0)));
            return this.result_clear_highlight(), 1 > e && g.length ? (this.update_results_content(""), this.no_results(g)) : (this.update_results_content(this.results_option_build()), this.winnow_results_set_highlight())
        }, a.prototype.search_string_match = function (a, b) {
            var c, d, e, f;
            if (b.test(a))
                return !0;
            if (this.enable_split_word_search && (a.indexOf(" ") >= 0 || 0 === a.indexOf("[")) && (d = a.replace(/\[|\]/g, "").split(" "), d.length))
                for (e = 0, f = d.length; f > e; e++)
                    if (c = d[e], b.test(c))
                        return !0
        }, a.prototype.choices_count = function () {
            var a, b, c, d;
            if (null != this.selected_option_count)
                return this.selected_option_count;
            for (this.selected_option_count = 0, d = this.form_field.options, b = 0, c = d.length; c > b; b++)
                a = d[b], a.selected && "" != a.value && (this.selected_option_count += 1);
            return this.selected_option_count
        }, a.prototype.choices_click = function (a) {
            return a.preventDefault(), this.results_showing || this.is_disabled ? void 0 : this.results_show()
        }, a.prototype.keyup_checker = function (a) {
            var b, c;
            switch (b = null != (c = a.which) ? c : a.keyCode, this.search_field_scale(), b) {
                case 8:
                    if (this.is_multiple && this.backstroke_length < 1 && this.choices_count() > 0)
                        return this.keydown_backstroke();
                    if (!this.pending_backstroke)
                        return this.result_clear_highlight(), this.results_search();
                    break;
                case 13:
                    if (a.preventDefault(), this.results_showing)
                        return this.result_select(a);
                    break;
                case 27:
                    return this.results_showing && this.results_hide(), !0;
                case 9:
                case 38:
                case 40:
                case 16:
                case 91:
                case 17:
                    break;
                default:
                    return this.results_search()
            }
        }, a.prototype.clipboard_event_checker = function (a) {
            var b = this;
            return setTimeout(function () {
                return b.results_search()
            }, 50)
        }, a.prototype.container_width = function () {
            return null != this.options.width ? this.options.width : "" + this.form_field.offsetWidth + "px"
        }, a.prototype.include_option_in_results = function (a) {
            return this.is_multiple && !this.display_selected_options && a.selected ? !1 : !this.display_disabled_options && a.disabled ? !1 : a.empty ? !1 : !0
        }, a.prototype.search_results_touchstart = function (a) {
            return this.touch_started = !0, this.search_results_mouseover(a)
        }, a.prototype.search_results_touchmove = function (a) {
            return this.touch_started = !1, this.search_results_mouseout(a)
        }, a.prototype.search_results_touchend = function (a) {
            return this.touch_started ? this.search_results_mouseup(a) : void 0
        }, a.prototype.outerHTML = function (a) {
            var b;
            return a.outerHTML ? a.outerHTML : (b = document.createElement("div"), b.appendChild(a), b.innerHTML)
        }, a.browser_is_supported = function () {
            return "Microsoft Internet Explorer" === window.navigator.appName ? document.documentMode >= 8 : /iP(od|hone)/i.test(window.navigator.userAgent) ? !1 : /Android/i.test(window.navigator.userAgent) && /Mobile/i.test(window.navigator.userAgent) ? !1 : !0
        }, a.default_multiple_text = "", a.default_single_text = "", a.default_no_result_text = "No results match", a
    }(), a = jQuery, a.fn.extend({
        chosen: function (d) {
            return b.browser_is_supported() ? this.each(function (b) {
                var e, f;
                e = a(this), f = e.data("chosen"), "destroy" === d && f ? f.destroy() : f || e.data("chosen", new c(this, d))
            }) : this
        }
    }), c = function (b) {
        function c() {
            return e = c.__super__.constructor.apply(this, arguments)
        }
        return g(c, b), c.prototype.setup = function () {
            return this.form_field_jq = a(this.form_field), this.current_selectedIndex = this.form_field.selectedIndex, this.is_rtl = this.form_field_jq.hasClass("chosen-rtl")
        }, c.prototype.set_up_html = function () {
            var b, c;
            b = ["chosen-container"], b.push("chosen-container-" + (this.is_multiple ? "multi" : "single")), this.inherit_select_classes && this.form_field.className && b.push(this.form_field.className), this.is_rtl && b.push("chosen-rtl");
            var d = this.form_field.getAttribute("data-css-class");
            return d && b.push(d), c = {
                "class": b.join(" "),
                style: "width: " + this.container_width() + ";",
                title: this.form_field.title
            }, this.form_field.id.length && (c.id = this.form_field.id.replace(/[^\w]/g, "_") + "_chosen"), this.container = a("<div />", c), this.container.html(this.is_multiple ? '<ul class="chosen-choices"><li class="search-field"><input type="text" value="' + this.default_text + '" class="default" autocomplete="off" style="width:25px;" /></li></ul><div class="chosen-drop"><ul class="chosen-results"></ul></div>' : '<a class="chosen-single chosen-default" tabindex="-1"><span>' + this.default_text + '</span><div><b></b></div></a><div class="chosen-drop"><div class="chosen-search"><input type="text" autocomplete="off" /></div><ul class="chosen-results"></ul></div>'), this.form_field_jq.hide().after(this.container), this.dropdown = this.container.find("div.chosen-drop").first(), this.search_field = this.container.find("input").first(), this.search_results = this.container.find("ul.chosen-results").first(), this.search_field_scale(), this.search_no_results = this.container.find("li.no-results").first(), this.is_multiple ? (this.search_choices = this.container.find("ul.chosen-choices").first(), this.search_container = this.container.find("li.search-field").first()) : (this.search_container = this.container.find("div.chosen-search").first(), this.selected_item = this.container.find(".chosen-single").first()), this.options.drop_width && this.dropdown.css("width", this.options.drop_width).addClass("chosen-drop-size-limited"), this.results_build(), this.set_tab_index(), this.set_label_behavior(), this.form_field_jq.trigger("chosen:ready", {
                chosen: this
            })
        }, c.prototype.register_observers = function () {
            var a = this;
            return this.container.bind("mousedown.chosen", function (b) {
                a.container_mousedown(b)
            }), this.container.bind("mouseup.chosen", function (b) {
                a.container_mouseup(b)
            }), this.container.bind("mouseenter.chosen", function (b) {
                a.mouse_enter(b)
            }), this.container.bind("mouseleave.chosen", function (b) {
                a.mouse_leave(b)
            }), this.search_results.bind("mouseup.chosen", function (b) {
                a.search_results_mouseup(b)
            }), this.search_results.bind("mouseover.chosen", function (b) {
                a.search_results_mouseover(b)
            }), this.search_results.bind("mouseout.chosen", function (b) {
                a.search_results_mouseout(b)
            }), this.search_results.bind("mousewheel.chosen DOMMouseScroll.chosen", function (b) {
                a.search_results_mousewheel(b)
            }), this.search_results.bind("touchstart.chosen", function (b) {
                a.search_results_touchstart(b)
            }), this.search_results.bind("touchmove.chosen", function (b) {
                a.search_results_touchmove(b)
            }), this.search_results.bind("touchend.chosen", function (b) {
                a.search_results_touchend(b)
            }), this.form_field_jq.bind("chosen:updated.chosen", function (b) {
                a.results_update_field(b)
            }), this.form_field_jq.bind("chosen:activate.chosen", function (b) {
                a.activate_field(b)
            }), this.form_field_jq.bind("chosen:open.chosen", function (b) {
                a.container_mousedown(b)
            }), this.form_field_jq.bind("chosen:close.chosen", function (b) {
                a.input_blur(b)
            }), this.search_field.bind("blur.chosen", function (b) {
                a.input_blur(b)
            }), this.search_field.bind("keyup.chosen", function (b) {
                a.keyup_checker(b)
            }), this.search_field.bind("keydown.chosen", function (b) {
                a.keydown_checker(b)
            }), this.search_field.bind("focus.chosen", function (b) {
                a.input_focus(b)
            }), this.search_field.bind("cut.chosen", function (b) {
                a.clipboard_event_checker(b)
            }), this.search_field.bind("paste.chosen", function (b) {
                a.clipboard_event_checker(b)
            }), this.is_multiple ? this.search_choices.bind("click.chosen", function (b) {
                a.choices_click(b)
            }) : this.container.bind("click.chosen", function (a) {
                a.preventDefault()
            })
        }, c.prototype.destroy = function () {
            return a(this.container[0].ownerDocument).unbind("click.chosen", this.click_test_action), this.search_field[0].tabIndex && (this.form_field_jq[0].tabIndex = this.search_field[0].tabIndex), this.container.remove(), this.form_field_jq.removeData("chosen"), this.form_field_jq.show()
        }, c.prototype.search_field_disabled = function () {
            return this.is_disabled = this.form_field_jq[0].disabled, this.is_disabled ? (this.container.addClass("chosen-disabled"), this.search_field[0].disabled = !0, this.is_multiple || this.selected_item.unbind("focus.chosen", this.activate_action), this.close_field()) : (this.container.removeClass("chosen-disabled"), this.search_field[0].disabled = !1, this.is_multiple ? void 0 : this.selected_item.bind("focus.chosen", this.activate_action))
        }, c.prototype.container_mousedown = function (b) {
            return this.is_disabled || (b && "mousedown" === b.type && !this.results_showing && b.preventDefault(), null != b && a(b.target).hasClass("search-choice-close")) ? void 0 : (this.active_field ? this.is_multiple || !b || a(b.target)[0] !== this.selected_item[0] && !a(b.target).parents("a.chosen-single").length || (b.preventDefault(), this.results_toggle()) : (this.is_multiple && this.search_field.val(""), a(this.container[0].ownerDocument).bind("click.chosen", this.click_test_action), this.results_show()), this.activate_field())
        }, c.prototype.container_mouseup = function (a) {
            return "ABBR" !== a.target.nodeName || this.is_disabled ? void 0 : this.results_reset(a)
        }, c.prototype.search_results_mousewheel = function (a) {
            var b;
            return a.originalEvent && (b = -a.originalEvent.wheelDelta || a.originalEvent.detail), null != b ? (a.preventDefault(), "DOMMouseScroll" === a.type && (b = 40 * b), this.search_results.scrollTop(b + this.search_results.scrollTop())) : void 0
        }, c.prototype.blur_test = function (a) {
            return !this.active_field && this.container.hasClass("chosen-container-active") ? this.close_field() : void 0
        }, c.prototype.close_field = function () {
            return a(this.container[0].ownerDocument).unbind("click.chosen", this.click_test_action), this.active_field = !1, this.results_hide(), this.container.removeClass("chosen-container-active"), this.clear_backstroke(), this.show_search_field_default(), this.search_field_scale()
        }, c.prototype.activate_field = function () {
            return this.container.addClass("chosen-container-active"), this.active_field = !0, this.search_field.val(this.search_field.val()), this.search_field.focus()
        }, c.prototype.test_active_click = function (b) {
            var c;
            return c = a(b.target).closest(".chosen-container"), c.length && this.container[0] === c[0] ? this.active_field = !0 : this.close_field()
        }, c.prototype.results_build = function () {
            return this.parsing = !0, this.selected_option_count = null, this.results_data = d.select_to_array(this.form_field), this.is_multiple ? this.search_choices.find("li.search-choice").remove() : this.is_multiple || (this.single_set_selected_text(), this.disable_search || this.form_field.options.length <= this.disable_search_threshold ? (this.search_field[0].readOnly = !0, this.container.addClass("chosen-container-single-nosearch")) : (this.search_field[0].readOnly = !1, this.container.removeClass("chosen-container-single-nosearch"))), this.update_results_content(this.results_option_build({
                first: !0
            })), this.search_field_disabled(), this.show_search_field_default(), this.search_field_scale(), this.parsing = !1
        }, c.prototype.result_do_highlight = function (a) {
            var b, c, d, e, f;
            if (a.length) {
                if (this.result_clear_highlight(), this.result_highlight = a, this.result_highlight.addClass("highlighted"), d = parseInt(this.search_results.css("maxHeight"), 10), f = this.search_results.scrollTop(), e = d + f, c = this.result_highlight.position().top + this.search_results.scrollTop(), b = c + this.result_highlight.outerHeight(), b >= e)
                    return this.search_results.scrollTop(b - d > 0 ? b - d : 0);
                if (f > c)
                    return this.search_results.scrollTop(c)
            }
        }, c.prototype.result_clear_highlight = function () {
            return this.result_highlight && this.result_highlight.removeClass("highlighted"), this.result_highlight = null
        }, c.prototype.results_show = function () {
            return this.is_multiple && this.max_selected_options <= this.choices_count() ? (this.form_field_jq.trigger("chosen:maxselected", {
                chosen: this
            }), !1) : (this.container.addClass("chosen-with-drop"), this.results_showing = !0, this.search_field.focus(), this.search_field.val(this.search_field.val()), this.winnow_results(), this.form_field_jq.trigger("chosen:showing_dropdown", {
                chosen: this
            }))
        }, c.prototype.update_results_content = function (a) {
            return this.search_results.html(a)
        }, c.prototype.results_hide = function () {
            return this.results_showing && (this.result_clear_highlight(), this.container.removeClass("chosen-with-drop"), this.form_field_jq.trigger("chosen:hiding_dropdown", {
                chosen: this
            })), this.results_showing = !1
        }, c.prototype.set_tab_index = function (a) {
            var b;
            return this.form_field.tabIndex ? (b = this.form_field.tabIndex, this.form_field.tabIndex = -1, this.search_field[0].tabIndex = b) : void 0
        }, c.prototype.set_label_behavior = function () {
            var b = this;
            return this.form_field_label = this.form_field_jq.parents("label"), !this.form_field_label.length && this.form_field.id.length && (this.form_field_label = a("label[for='" + this.form_field.id + "']")), this.form_field_label.length > 0 ? this.form_field_label.bind("click.chosen", function (a) {
                return b.is_multiple ? b.container_mousedown(a) : b.activate_field()
            }) : void 0
        }, c.prototype.show_search_field_default = function () {
            return this.is_multiple && this.choices_count() < 1 && !this.active_field ? (this.search_field.val(this.default_text), this.search_field.addClass("default")) : (this.search_field.val(""), this.search_field.removeClass("default"))
        }, c.prototype.search_results_mouseup = function (b) {
            var c;
            return c = a(b.target).hasClass("active-result") ? a(b.target) : a(b.target).parents(".active-result").first(), c.length ? (this.result_highlight = c, this.result_select(b), this.search_field.focus()) : void 0
        }, c.prototype.search_results_mouseover = function (b) {
            var c;
            return c = a(b.target).hasClass("active-result") ? a(b.target) : a(b.target).parents(".active-result").first(), c ? this.result_do_highlight(c) : void 0
        }, c.prototype.search_results_mouseout = function (b) {
            return a(b.target).hasClass("active-result") ? this.result_clear_highlight() : void 0
        }, c.prototype.choice_build = function (b) {
            var c, d, e = this;
            return c = a("<li />", {
                "class": "search-choice"
            }).html("<span title='" + b.html + "'>" + b.html + "</span>"), b.disabled ? c.addClass("search-choice-disabled") : (d = a("<a />", {
                "class": "search-choice-close",
                "data-option-array-index": b.array_index
            }), d.bind("click.chosen", function (a) {
                return e.choice_destroy_link_click(a)
            }), c.append(d)), this.search_container.before(c)
        }, c.prototype.choice_destroy_link_click = function (b) {
            return b.preventDefault(), b.stopPropagation(), this.is_disabled ? void 0 : this.choice_destroy(a(b.target))
        }, c.prototype.choice_destroy = function (a) {
            return this.result_deselect(a[0].getAttribute("data-option-array-index")) ? (this.show_search_field_default(), this.is_multiple && this.choices_count() > 0 && this.search_field.val().length < 1 && this.results_hide(), a.parents("li").first().remove(), this.search_field_scale()) : void 0
        }, c.prototype.results_reset = function () {
            return this.reset_single_select_options(), this.form_field.options[0].selected = !0, this.single_set_selected_text(), this.show_search_field_default(), this.results_reset_cleanup(), this.form_field_jq.trigger("change"), this.active_field ? this.results_hide() : void 0
        }, c.prototype.results_reset_cleanup = function () {
            return this.current_selectedIndex = this.form_field.selectedIndex, this.selected_item.find("abbr").remove()
        }, c.prototype.result_select = function (a) {
            var b, c;
            return this.result_highlight ? (b = this.result_highlight, this.result_clear_highlight(), this.is_multiple && this.max_selected_options <= this.choices_count() ? (this.form_field_jq.trigger("chosen:maxselected", {
                chosen: this
            }), !1) : (this.is_multiple ? b.removeClass("active-result") : this.reset_single_select_options(), c = this.results_data[b[0].getAttribute("data-option-array-index")], c.selected = !0, this.form_field.options[c.options_index].selected = !0, this.selected_option_count = null, this.is_multiple ? this.choice_build(c) : this.single_set_selected_text(c.text), (a.metaKey || a.ctrlKey) && this.is_multiple || this.results_hide(), this.search_field.val(""), (this.is_multiple || this.form_field.selectedIndex !== this.current_selectedIndex) && this.form_field_jq.trigger("change", {
                selected: this.form_field.options[c.options_index].value
            }), this.current_selectedIndex = this.form_field.selectedIndex, this.search_field_scale())) : void 0
        }, c.prototype.single_set_selected_text = function (a) {
            return null == a && (a = this.default_text), a === this.default_text ? this.selected_item.addClass("chosen-default") : (this.single_deselect_control_build(), this.selected_item.removeClass("chosen-default")), this.selected_item.find("span").attr("title", a).text(a)
        }, c.prototype.result_deselect = function (a) {
            var b;
            return b = this.results_data[a], this.form_field.options[b.options_index].disabled ? !1 : (b.selected = !1, this.form_field.options[b.options_index].selected = !1, this.selected_option_count = null, this.result_clear_highlight(), this.results_showing && this.winnow_results(), this.form_field_jq.trigger("change", {
                deselected: this.form_field.options[b.options_index].value
            }), this.search_field_scale(), !0)
        }, c.prototype.single_deselect_control_build = function () {
            return this.allow_single_deselect ? (this.selected_item.find("abbr").length || this.selected_item.find("span").first().after('<abbr class="search-choice-close"></abbr>'), this.selected_item.addClass("chosen-single-with-deselect")) : void 0
        }, c.prototype.get_search_text = function () {
            return this.search_field.val() === this.default_text ? "" : a("<div/>").text(a.trim(this.search_field.val())).html()
        }, c.prototype.winnow_results_set_highlight = function () {
            var a, b;
            return b = this.is_multiple ? [] : this.search_results.find(".result-selected.active-result"), a = b.length ? b.first() : this.search_results.find(".active-result").first(), null != a ? this.result_do_highlight(a) : void 0
        }, c.prototype.no_results = function (b) {
            var c;
            return c = a('<li class="no-results">' + this.results_none_found + ' "<span></span>"</li>'), c.find("span").first().html(b), this.search_results.append(c), this.form_field_jq.trigger("chosen:no_results", {
                chosen: this
            })
        }, c.prototype.no_results_clear = function () {
            return this.search_results.find(".no-results").remove()
        }, c.prototype.keydown_arrow = function () {
            var a;
            return this.results_showing && this.result_highlight ? (a = this.result_highlight.nextAll("li.active-result").first()) ? this.result_do_highlight(a) : void 0 : this.results_show()
        }, c.prototype.keyup_arrow = function () {
            var a;
            return this.results_showing || this.is_multiple ? this.result_highlight ? (a = this.result_highlight.prevAll("li.active-result"), a.length ? this.result_do_highlight(a.first()) : (this.choices_count() > 0 && this.results_hide(), this.result_clear_highlight())) : void 0 : this.results_show()
        }, c.prototype.keydown_backstroke = function () {
            var a;
            return this.pending_backstroke ? (this.choice_destroy(this.pending_backstroke.find("a").first()), this.clear_backstroke()) : (a = this.search_container.siblings("li.search-choice").last(), a.length && !a.hasClass("search-choice-disabled") ? (this.pending_backstroke = a, this.single_backstroke_delete ? this.keydown_backstroke() : this.pending_backstroke.addClass("search-choice-focus")) : void 0)
        }, c.prototype.clear_backstroke = function () {
            return this.pending_backstroke && this.pending_backstroke.removeClass("search-choice-focus"), this.pending_backstroke = null
        }, c.prototype.keydown_checker = function (a) {
            var b, c;
            switch (b = null != (c = a.which) ? c : a.keyCode, this.search_field_scale(), 8 !== b && this.pending_backstroke && this.clear_backstroke(), b) {
                case 8:
                    this.backstroke_length = this.search_field.val().length;
                    break;
                case 9:
                    this.results_showing && !this.is_multiple && this.result_select(a), this.mouse_on_container = !1;
                    break;
                case 13:
                    a.preventDefault();
                    break;
                case 38:
                    a.preventDefault(), this.keyup_arrow();
                    break;
                case 40:
                    a.preventDefault(), this.keydown_arrow()
            }
        }, c.prototype.search_field_scale = function () {
            var b, c, d, e, f, g, h, i, j;
            if (this.is_multiple) {
                for (d = 0, h = 0, f = "position:absolute; left: -1000px; top: -1000px; display:none;", g = ["font-size", "font-style", "font-weight", "font-family", "line-height", "text-transform", "letter-spacing"], i = 0, j = g.length; j > i; i++)
                    e = g[i], f += e + ":" + this.search_field.css(e) + ";";
                return b = a("<div />", {
                    style: f
                }), b.text(this.search_field.val()), a("body").append(b), h = b.width() + 25, b.remove(), c = this.container.outerWidth(), h > c - 10 && (h = c - 10), this.search_field.css({
                    width: h + "px"
                })
            }
        }, c
    }(b)
}.call(this), +
        function (a) {
            "use strict";
            var b = function (c, d) {
                this.$ = a(c), this.options = this.getOptions(d), this.lang = b.LANGS[this.options.lang], this.id = "chosen-icons-" + parseInt(1e10 * Math.random() + 1), this.init()
            };
            b.DEFAULTS = {
                canEmpty: !0,
                lang: "zh-cn",
                commonIcons: ["heart", "user", "group", "list-ul", "th", "th-large", "star", "star-empty", "search", "envelope", "dashboard", "sitemap", "umbrella", "lightbulb", "envelope-alt", "cog", "ok", "remove", "home", "time", "flag", "flag-alt", "flag-checkered", "qrcode", "tag", "tags", "book", "bookmark", "bookmark-empty", "print", "camera", "picture", "globe", "map-marker", "edit", "edit-sign", "play", "stop", "plus-sign", "minus-sign", "remove-sign", "ok-sign", "check-sign", "question-sign", "info-sign", "exclamation-sign", "plus", "plus-sign", "minus", "minus-sign", "asterisk", "calendar", "calendar-empty", "comment", "comment-alt", "comments", "comments-alt", "folder-close", "folder-open", "folder-close-alt", "folder-open-alt", "thumbs-up", "thumbs-down", "pushpin", "building", "phone", "rss", "rss-sign", "bullhorn", "bell", "bell-alt", "certificate", "wrench", "tasks", "cloud", "beaker", "magic", "smile", "frown", "meh", "code", "location-arrow"],
                webIcons: ["share", "pencil", "trash", "file-alt", "file", "file-text", "download-alt", "upload-alt", "inbox", "repeat", "refresh", "lock", "check", "check-empty", "eye-open", "eye-close", "key", "signin", "signout", "external-link", "external-link-sign", "link", "reorder", "quote-left", "quote-right", "spinner", "reply", "question", "info", "archive", "collapse", "collapse-top"],
                editorIcons: ["table", "copy", "save", "list-ol", "paste", "keyboard", "paper-clip", "crop", "unlink", "sort-by-alphabet", "sort-by-alphabet-alt", "sort-by-attributes", "sort-by-attributes-alt", "sort-by-order", "sort-by-order-alt"],
                directionalIcons: ["chevron-left", "chevron-right", "chevron-down", "chevron-up", "arrow-left", "arrow-right", "arrow-down", "arrow-up", "hand-right", "hand-left", "hand-up", "hand-down", "circle-arrow-left", "circle-arrow-right", "circle-arrow-up", "circle-arrow-down", "double-angle-left", "double-angle-right", "double-angle-down", "double-angle-up", "angle-left", "angle-right", "angle-down", "angle-up", "long-arrow-left", "long-arrow-right", "long-arrow-down", "long-arrow-up", "caret-left", "caret-right", "caret-down", "caret-up"],
                otherIcons: ["desktop", "laptop", "tablet", "mobile", "building", "firefox", "ie", "opera", "qq", "lemon", "sign-blank", "circle", "circle-blank", "terminal", "html5", "android", "apple", "windows", "weibo", "renren", "bug", "moon", "sun"]
            }, b.LANGS = {}, b.LANGS["zh-cn"] = {
                emptyIcon: "[娌℃湁鍥炬爣]",
                commonIcons: "甯哥敤鍥炬爣",
                webIcons: "Web 鍥炬爣",
                editorIcons: "缂栬緫鍣ㄥ浘鏍�",
                directionalIcons: "绠ご鎬绘眹",
                otherIcons: "鍏朵粬鍥炬爣"
            }, b.LANGS.en = {
                emptyIcon: "[No Icon]",
                commonIcons: "Common Icons",
                webIcons: "Web Icons",
                editorIcons: "Editor Icons",
                directionalIcons: "Directional Icons",
                otherIcons: "Other Icons"
            }, b.LANGS["zh-tw"] = {
                emptyIcon: "[娌掓湁鍦栨]",
                commonIcons: "甯哥敤鍦栨",
                webIcons: "Web 鍦栨",
                editorIcons: "绶ㄨ集鍣ㄥ湒妯�",
                directionalIcons: "绠牠绺藉尟",
                otherIcons: "鍏朵粬鍦栨"
            }, b.prototype.getOptions = function (c) {
                return c = a.extend({}, b.DEFAULTS, this.$.data(), c)
            }, b.prototype.init = function () {
                var b = this.$.addClass("chosen-icons").addClass(this.id);
                b.empty(), this.options.canEmpty && b.append(this.getOptionHtml());
                var c = this.lang;
                b.append(this.getgroupHtml("commonIcons")), b.append(this.getgroupHtml("webIcons")), b.append(this.getgroupHtml("editorIcons")), b.append(this.getgroupHtml("directionalIcons")), b.append(this.getgroupHtml("otherIcons")), b.chosen({
                    placeholder_text: " ",
                    disable_search: !0,
                    width: "100%",
                    inherit_select_classes: !0
                });
                var d = ".chosen-container." + this.id;
                b.on("chosen:showing_dropdown", function () {
                    a(d + " .chosen-results .group-option").each(function () {
                        var b = a(this).addClass("icon"),
                                c = a(this).text();
                        b.html('<i class="icon-' + c + '" title="' + c + '"></i>')
                    })
                }).change(function () {
                    var b = a(d + " .chosen-single > span"),
                            e = a(this).val();
                    b.html(e && e.length > 0 ? '<i class="' + e + '"></i> &nbsp; <span class="text-muted">' + e.substr(5).replace(/-/g, " ") + "</span>" : '<span class="text-muted">' + c.emptyIcon + "</span>")
                });
                var e = b.data("value");
                e && b.val(e).change()
            }, b.prototype.getgroupHtml = function (a) {
                var b = this.options[a],
                        c = '<optgroup label="' + this.lang[a] + '">';
                for (var d in b)
                    c += this.getOptionHtml(b[d]);
                return c + "</optgroup>"
            }, b.prototype.getOptionHtml = function (a) {
                return name = a, a && a.length > 0 ? a = "icon-" + a : (a = "", name = this.lang.emptyIcon), '<option value="' + a + '">' + name + "</option>"
            }, a.fn.chosenIcons = function (c) {
                return this.each(function () {
                    var d = a(this),
                            e = d.data("zui.chosenIcons"),
                            f = "object" == typeof c && c;
                    e || d.data("zui.chosenIcons", e = new b(this, f)), "string" == typeof c && e[c]()
                })
            }, a.fn.chosenIcons.Constructor = b
        }(jQuery), function (a) {
    "use strict";
    var b = 0,
            c = ["primary", "red", "yellow", "green", "blue", "purple", "brown", "dark"],
            d = {
                theme: "light",
                primary: "#3280fc",
                secondary: "#145ccd",
                pale: "#ebf2f9",
                fore: "#353535",
                back: "#ffffff",
                grayDarker: "#222222",
                grayDark: "#333333",
                gray: "#808080",
                grayLight: "#dddddd",
                grayLighter: "#e5e5e5",
                grayPale: "#f1f1f1",
                white: "#ffffff",
                black: "#000000",
                red: "#ea644a",
                yellow: "#f1a325",
                green: "#38b03f",
                blue: "#03b8cf",
                purple: "#8666b8",
                brown: "#bd7b46",
                greenPale: "#ddf4df",
                yellowPale: "#fff0d5",
                redPale: "#ffe5e0",
                bluePale: "#ddf3f5",
                brownPale: "#f7ebe1",
                purplePale: "#f5eeff",
                light: "#ffffff",
                dark: "#353535",
                success: "#38b03f",
                warning: "#f1a325",
                danger: "#ea644a",
                info: "#03b8cf",
                important: "#bd7b46",
                special: "#8666b8",
                successPale: "#ddf4df",
                warningPale: "#fff0d5",
                dangerPale: "#ffe5e0",
                infoPale: "#ddf3f5",
                importantPale: "#f7ebe1",
                specialPale: "#f5eeff"
            };
    d.get = function (e) {
        return ("undefined" == typeof e || "random" === e) && (e = c[b++ % c.length]), new a.zui.Color(d[e] ? d[e] : e)
    }, a.zui({
        colorset: d
    }), a.zui.Color && a.extend(a.zui.Color, d)
}
(jQuery), function (a) {
    "use strict";
    var b = a && a.zui ? a.zui : this,
            c = (b.Chart, function (a) {
                this.canvas = a.canvas, this.ctx = a;
                var b = function (a, b) {
                    return a["offset" + b] ? a["offset" + b] : document.defaultView.getComputedStyle(a).getPropertyValue(b)
                },
                        c = this.width = b(a.canvas, "Width"),
                        e = this.height = b(a.canvas, "Height");
                a.canvas.width = c, a.canvas.height = e;
                var c = this.width = a.canvas.width,
                        e = this.height = a.canvas.height;
                return this.aspectRatio = this.width / this.height, d.retinaScale(this), this
            });
    c.defaults = {
        global: {
            animation: !0,
            animationSteps: 60,
            animationEasing: "easeOutQuart",
            showScale: !0,
            scaleOverride: !1,
            scaleSteps: null,
            scaleStepWidth: null,
            scaleStartValue: null,
            scaleLineColor: "rgba(0,0,0,.1)",
            scaleLineWidth: 1,
            scaleShowLabels: !0,
            scaleLabel: "<%=value%>",
            scaleIntegersOnly: !0,
            scaleBeginAtZero: !1,
            scaleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
            scaleFontSize: 12,
            scaleFontStyle: "normal",
            scaleFontColor: "#666",
            responsive: !1,
            maintainAspectRatio: !0,
            showTooltips: !0,
            customTooltips: !1,
            tooltipEvents: ["mousemove", "touchstart", "touchmove", "mouseout"],
            tooltipFillColor: "rgba(0,0,0,0.8)",
            tooltipFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
            tooltipFontSize: 14,
            tooltipFontStyle: "normal",
            tooltipFontColor: "#fff",
            tooltipTitleFontFamily: "'Helvetica Neue', 'Helvetica', 'Arial', sans-serif",
            tooltipTitleFontSize: 14,
            tooltipTitleFontStyle: "bold",
            tooltipTitleFontColor: "#fff",
            tooltipYPadding: 6,
            tooltipXPadding: 6,
            tooltipCaretSize: 8,
            tooltipCornerRadius: 6,
            tooltipXOffset: 10,
            tooltipTemplate: "<%if (label){%><%=label%>: <%}%><%= value %>",
            multiTooltipTemplate: "<%= value %>",
            multiTooltipKeyBackground: "#fff",
            onAnimationProgress: function () {
            },
            onAnimationComplete: function () {
            }
        }
    }, c.types = {};
    var d = c.helpers = {},
            e = d.each = function (a, b, c) {
                var d = Array.prototype.slice.call(arguments, 3);
                if (a)
                    if (a.length === +a.length) {
                        var e;
                        for (e = 0; e < a.length; e++)
                            b.apply(c, [a[e], e].concat(d))
                    } else
                        for (var f in a)
                            b.apply(c, [a[f], f].concat(d))
            },
            f = d.clone = function (a) {
                var b = {};
                return e(a, function (c, d) {
                    a.hasOwnProperty(d) && (b[d] = c)
                }), b
            },
            g = d.extend = function (a) {
                return e(Array.prototype.slice.call(arguments, 1), function (b) {
                    e(b, function (c, d) {
                        b.hasOwnProperty(d) && (a[d] = c)
                    })
                }), a
            },
            h = d.merge = function (a, b) {
                var c = Array.prototype.slice.call(arguments, 0);
                return c.unshift({}), g.apply(null, c)
            },
            i = d.indexOf = function (a, b) {
                if (Array.prototype.indexOf)
                    return a.indexOf(b);
                for (var c = 0; c < a.length; c++)
                    if (a[c] === b)
                        return c;
                return -1
            },
            j = (d.where = function (a, b) {
                var c = [];
                return d.each(a, function (a) {
                    b(a) && c.push(a)
                }), c
            }, d.findNextWhere = function (a, b, c) {
                c || (c = -1);
                for (var d = c + 1; d < a.length; d++) {
                    var e = a[d];
                    if (b(e))
                        return e
                }
            }, d.findPreviousWhere = function (a, b, c) {
                c || (c = a.length);
                for (var d = c - 1; d >= 0; d--) {
                    var e = a[d];
                    if (b(e))
                        return e
                }
            }, d.inherits = function (a) {
                var b = this,
                        c = a && a.hasOwnProperty("constructor") ? a.constructor : function () {
                    return b.apply(this, arguments)
                },
                        d = function () {
                            this.constructor = c
                        };
                return d.prototype = b.prototype, c.prototype = new d, c.extend = j, a && g(c.prototype, a), c.__super__ = b.prototype, c
            }),
            k = d.noop = function () {
            },
            l = d.uid = function () {
                var a = 0;
                return function () {
                    return "chart-" + a++
                }
            }(),
            m = d.warn = function (a) {
                window.console && "function" == typeof window.console.warn && console.warn(a)
            },
            n = d.amd = "function" == typeof define && define.amd,
            o = d.isNumber = function (a) {
                return !isNaN(parseFloat(a)) && isFinite(a)
            },
            p = d.max = function (a) {
                return Math.max.apply(Math, a)
            },
            q = d.min = function (a) {
                return Math.min.apply(Math, a)
            },
            r = (d.cap = function (a, b, c) {
                if (o(b)) {
                    if (a > b)
                        return b
                } else if (o(c) && c > a)
                    return c;
                return a
            }, d.getDecimalPlaces = function (a) {
                return a % 1 !== 0 && o(a) ? a.toString().split(".")[1].length : 0
            }),
            s = d.radians = function (a) {
                return a * (Math.PI / 180)
            },
            t = (d.getAngleFromPoint = function (a, b) {
                var c = b.x - a.x,
                        d = b.y - a.y,
                        e = Math.sqrt(c * c + d * d),
                        f = 2 * Math.PI + Math.atan2(d, c);
                return 0 > c && 0 > d && (f += 2 * Math.PI), {
                    angle: f,
                    distance: e
                }
            }, d.aliasPixel = function (a) {
                return a % 2 === 0 ? 0 : .5
            }),
            u = (d.splineCurve = function (a, b, c, d) {
                var e = Math.sqrt(Math.pow(b.x - a.x, 2) + Math.pow(b.y - a.y, 2)),
                        f = Math.sqrt(Math.pow(c.x - b.x, 2) + Math.pow(c.y - b.y, 2)),
                        g = d * e / (e + f),
                        h = d * f / (e + f);
                return {
                    inner: {
                        x: b.x - g * (c.x - a.x),
                        y: b.y - g * (c.y - a.y)
                    },
                    outer: {
                        x: b.x + h * (c.x - a.x),
                        y: b.y + h * (c.y - a.y)
                    }
                }
            }, d.calculateOrderOfMagnitude = function (a) {
                return Math.floor(Math.log(a) / Math.LN10)
            }),
            v = (d.calculateScaleRange = function (a, b, c, d, e) {
                var f = 2,
                        g = Math.floor(b / (1.5 * c)),
                        h = f >= g,
                        i = p(a),
                        j = q(a);
                i === j && (i += .5, j >= .5 && !d ? j -= .5 : i += .5);
                for (var k = Math.abs(i - j), l = u(k), m = Math.ceil(i / (1 * Math.pow(10, l))) * Math.pow(10, l), n = d ? 0 : Math.floor(j / (1 * Math.pow(10, l))) * Math.pow(10, l), o = m - n, r = Math.pow(10, l), s = Math.round(o / r);
                        (s > g || g > 2 * s) && !h; )
                    if (s > g)
                        r *= 2, s = Math.round(o / r), s % 1 !== 0 && (h = !0);
                    else if (e && l >= 0) {
                        if (r / 2 % 1 !== 0)
                            break;
                        r /= 2, s = Math.round(o / r)
                    } else
                        r /= 2, s = Math.round(o / r);
                return h && (s = f, r = o / s), {
                    steps: s,
                    stepValue: r,
                    min: n,
                    max: n + s * r
                }
            }, d.template = function (a, b) {
                function c(a, b) {
                    var c = /\W/.test(a) ? new Function("obj", "var p=[],print=function(){p.push.apply(p,arguments);};with(obj){p.push('" + a.replace(/[\r\t\n]/g, " ").split("<%").join("	").replace(/((^|%>)[^\t]*)'/g, "$1\r").replace(/\t=(.*?)%>/g, "',$1,'").split("	").join("');").split("%>").join("p.push('").split("\r").join("\\'") + "');}return p.join('');") : d[a] = d[a];
                    return b ? c(b) : c
                }
                if (a instanceof Function)
                    return a(b);
                var d = {};
                return c(a, b)
            }),
            w = (d.generateLabels = function (a, b, c, d) {
                var f = new Array(b);
                return labelTemplateString && e(f, function (b, e) {
                    f[e] = v(a, {
                        value: c + d * (e + 1)
                    })
                }), f
            }, d.easingEffects = {
                linear: function (a) {
                    return a
                },
                easeInQuad: function (a) {
                    return a * a
                },
                easeOutQuad: function (a) {
                    return -1 * a * (a - 2)
                },
                easeInOutQuad: function (a) {
                    return (a /= .5) < 1 ? .5 * a * a : -0.5 * (--a * (a - 2) - 1)
                },
                easeInCubic: function (a) {
                    return a * a * a
                },
                easeOutCubic: function (a) {
                    return 1 * ((a = a / 1 - 1) * a * a + 1)
                },
                easeInOutCubic: function (a) {
                    return (a /= .5) < 1 ? .5 * a * a * a : .5 * ((a -= 2) * a * a + 2)
                },
                easeInQuart: function (a) {
                    return a * a * a * a
                },
                easeOutQuart: function (a) {
                    return -1 * ((a = a / 1 - 1) * a * a * a - 1)
                },
                easeInOutQuart: function (a) {
                    return (a /= .5) < 1 ? .5 * a * a * a * a : -0.5 * ((a -= 2) * a * a * a - 2)
                },
                easeInQuint: function (a) {
                    return 1 * (a /= 1) * a * a * a * a
                },
                easeOutQuint: function (a) {
                    return 1 * ((a = a / 1 - 1) * a * a * a * a + 1)
                },
                easeInOutQuint: function (a) {
                    return (a /= .5) < 1 ? .5 * a * a * a * a * a : .5 * ((a -= 2) * a * a * a * a + 2)
                },
                easeInSine: function (a) {
                    return -1 * Math.cos(a / 1 * (Math.PI / 2)) + 1
                },
                easeOutSine: function (a) {
                    return 1 * Math.sin(a / 1 * (Math.PI / 2))
                },
                easeInOutSine: function (a) {
                    return -0.5 * (Math.cos(Math.PI * a / 1) - 1)
                },
                easeInExpo: function (a) {
                    return 0 === a ? 1 : 1 * Math.pow(2, 10 * (a / 1 - 1))
                },
                easeOutExpo: function (a) {
                    return 1 === a ? 1 : 1 * (-Math.pow(2, -10 * a / 1) + 1)
                },
                easeInOutExpo: function (a) {
                    return 0 === a ? 0 : 1 === a ? 1 : (a /= .5) < 1 ? .5 * Math.pow(2, 10 * (a - 1)) : .5 * (-Math.pow(2, -10 * --a) + 2)
                },
                easeInCirc: function (a) {
                    return a >= 1 ? a : -1 * (Math.sqrt(1 - (a /= 1) * a) - 1)
                },
                easeOutCirc: function (a) {
                    return 1 * Math.sqrt(1 - (a = a / 1 - 1) * a)
                },
                easeInOutCirc: function (a) {
                    return (a /= .5) < 1 ? -0.5 * (Math.sqrt(1 - a * a) - 1) : .5 * (Math.sqrt(1 - (a -= 2) * a) + 1)
                },
                easeInElastic: function (a) {
                    var b = 1.70158,
                            c = 0,
                            d = 1;
                    return 0 === a ? 0 : 1 == (a /= 1) ? 1 : (c || (c = .3), d < Math.abs(1) ? (d = 1, b = c / 4) : b = c / (2 * Math.PI) * Math.asin(1 / d), -(d * Math.pow(2, 10 * (a -= 1)) * Math.sin(2 * (1 * a - b) * Math.PI / c)))
                },
                easeOutElastic: function (a) {
                    var b = 1.70158,
                            c = 0,
                            d = 1;
                    return 0 === a ? 0 : 1 == (a /= 1) ? 1 : (c || (c = .3), d < Math.abs(1) ? (d = 1, b = c / 4) : b = c / (2 * Math.PI) * Math.asin(1 / d), d * Math.pow(2, -10 * a) * Math.sin(2 * (1 * a - b) * Math.PI / c) + 1)
                },
                easeInOutElastic: function (a) {
                    var b = 1.70158,
                            c = 0,
                            d = 1;
                    return 0 === a ? 0 : 2 == (a /= .5) ? 1 : (c || (c = .3 * 1.5), d < Math.abs(1) ? (d = 1, b = c / 4) : b = c / (2 * Math.PI) * Math.asin(1 / d), 1 > a ? -.5 * d * Math.pow(2, 10 * (a -= 1)) * Math.sin(2 * (1 * a - b) * Math.PI / c) : d * Math.pow(2, -10 * (a -= 1)) * Math.sin(2 * (1 * a - b) * Math.PI / c) * .5 + 1)
                },
                easeInBack: function (a) {
                    var b = 1.70158;
                    return 1 * (a /= 1) * a * ((b + 1) * a - b)
                },
                easeOutBack: function (a) {
                    var b = 1.70158;
                    return 1 * ((a = a / 1 - 1) * a * ((b + 1) * a + b) + 1)
                },
                easeInOutBack: function (a) {
                    var b = 1.70158;
                    return (a /= .5) < 1 ? .5 * a * a * (((b *= 1.525) + 1) * a - b) : .5 * ((a -= 2) * a * (((b *= 1.525) + 1) * a + b) + 2)
                },
                easeInBounce: function (a) {
                    return 1 - w.easeOutBounce(1 - a)
                },
                easeOutBounce: function (a) {
                    return (a /= 1) < 1 / 2.75 ? 7.5625 * a * a : 2 / 2.75 > a ? 1 * (7.5625 * (a -= 1.5 / 2.75) * a + .75) : 2.5 / 2.75 > a ? 1 * (7.5625 * (a -= 2.25 / 2.75) * a + .9375) : 1 * (7.5625 * (a -= 2.625 / 2.75) * a + .984375)
                },
                easeInOutBounce: function (a) {
                    return .5 > a ? .5 * w.easeInBounce(2 * a) : .5 * w.easeOutBounce(2 * a - 1) + .5
                }
            }),
            x = d.requestAnimFrame = function () {
                return window.requestAnimationFrame || window.webkitRequestAnimationFrame || window.mozRequestAnimationFrame || window.oRequestAnimationFrame || window.msRequestAnimationFrame ||
                        function (a) {
                            return window.setTimeout(a, 1e3 / 60)
                        }
            }(),
            y = d.cancelAnimFrame = function () {
                return window.cancelAnimationFrame || window.webkitCancelAnimationFrame || window.mozCancelAnimationFrame || window.oCancelAnimationFrame || window.msCancelAnimationFrame ||
                        function (a) {
                            return window.clearTimeout(a, 1e3 / 60)
                        }
            }(),
            z = (d.animationLoop = function (a, b, c, d, e, f) {
                var g = 0,
                        h = w[c] || w.linear,
                        i = function () {
                            g++;
                            var c = g / b,
                                    j = h(c);
                            a.call(f, j, c, g), d.call(f, j, c), b > g ? f.animationFrame = x(i) : e.apply(f)
                        };
                x(i)
            }, d.getRelativePosition = function (a) {
                var b, c, d = a.originalEvent || a,
                        e = a.currentTarget || a.srcElement,
                        f = e.getBoundingClientRect();
                return d.touches ? (b = d.touches[0].clientX - f.left, c = d.touches[0].clientY - f.top) : (b = d.clientX - f.left, c = d.clientY - f.top), {
                    x: b,
                    y: c
                }
            }, d.addEvent = function (a, b, c) {
                a.addEventListener ? a.addEventListener(b, c) : a.attachEvent ? a.attachEvent("on" + b, c) : a["on" + b] = c
            }),
            A = d.removeEvent = function (a, b, c) {
                a.removeEventListener ? a.removeEventListener(b, c, !1) : a.detachEvent ? a.detachEvent("on" + b, c) : a["on" + b] = k
            },
            B = (d.bindEvents = function (a, b, c) {
                a.events || (a.events = {}), e(b, function (b) {
                    a.events[b] = function () {
                        c.apply(a, arguments)
                    }, z(a.chart.canvas, b, a.events[b])
                })
            }, d.unbindEvents = function (a, b) {
                e(b, function (b, c) {
                    A(a.chart.canvas, c, b)
                })
            }),
            C = d.getMaximumWidth = function (a) {
                var b = a.parentNode;
                return b.clientWidth
            },
            D = d.getMaximumHeight = function (a) {
                var b = a.parentNode;
                return b.clientHeight
            },
            E = (d.getMaximumSize = d.getMaximumWidth, d.retinaScale = function (a) {
                var b = a.ctx,
                        c = a.canvas.width,
                        d = a.canvas.height;
                window.devicePixelRatio && (b.canvas.style.width = c + "px", b.canvas.style.height = d + "px", b.canvas.height = d * window.devicePixelRatio, b.canvas.width = c * window.devicePixelRatio, b.scale(window.devicePixelRatio, window.devicePixelRatio))
            }),
            F = d.clear = function (a) {
                a.ctx.clearRect(0, 0, a.width, a.height)
            },
            G = d.fontString = function (a, b, c) {
                return b + " " + a + "px " + c
            },
            H = d.longestText = function (a, b, c) {
                a.font = b;
                var d = 0;
                return e(c, function (b) {
                    var c = a.measureText(b).width;
                    d = c > d ? c : d
                }), d
            },
            I = d.drawRoundedRectangle = function (a, b, c, d, e, f) {
                a.beginPath(), a.moveTo(b + f, c), a.lineTo(b + d - f, c), a.quadraticCurveTo(b + d, c, b + d, c + f), a.lineTo(b + d, c + e - f), a.quadraticCurveTo(b + d, c + e, b + d - f, c + e), a.lineTo(b + f, c + e), a.quadraticCurveTo(b, c + e, b, c + e - f), a.lineTo(b, c + f), a.quadraticCurveTo(b, c, b + f, c), a.closePath()
            };
    c.instances = {}, c.Type = function (a, b, d) {
        this.options = b, this.chart = d, this.id = l(), c.instances[this.id] = this, b.responsive && this.resize(), this.initialize.call(this, a)
    }, g(c.Type.prototype, {
        initialize: function () {
            return this
        },
        clear: function () {
            return F(this.chart), this
        },
        stop: function () {
            return y(this.animationFrame), this
        },
        resize: function (a) {
            this.stop();
            var b = this.chart.canvas,
                    c = C(this.chart.canvas),
                    d = this.options.maintainAspectRatio ? c / this.chart.aspectRatio : D(this.chart.canvas);
            return b.width = this.chart.width = c, b.height = this.chart.height = d, E(this.chart), "function" == typeof a && a.apply(this, Array.prototype.slice.call(arguments, 1)), this
        },
        reflow: k,
        render: function (a) {
            return a && this.reflow(), this.options.animation && !a ? d.animationLoop(this.draw, this.options.animationSteps, this.options.animationEasing, this.options.onAnimationProgress, this.options.onAnimationComplete, this) : (this.draw(), this.options.onAnimationComplete.call(this)), this
        },
        generateLegend: function () {
            return v(this.options.legendTemplate, this)
        },
        destroy: function () {
            this.clear(), B(this, this.events);
            var a = this.chart.canvas;
            a.width = this.chart.width, a.height = this.chart.height, a.style.removeProperty ? (a.style.removeProperty("width"), a.style.removeProperty("height")) : (a.style.removeAttribute("width"), a.style.removeAttribute("height")), delete c.instances[this.id]
        },
        showTooltip: function (a, b) {
            "undefined" == typeof this.activeElements && (this.activeElements = []);
            var f = function (a) {
                var b = !1;
                return a.length !== this.activeElements.length ? b = !0 : (e(a, function (a, c) {
                    a !== this.activeElements[c] && (b = !0)
                }, this), b)
            }.call(this, a);
            if (f || b) {
                if (this.activeElements = a, this.draw(), this.options.customTooltips && this.options.customTooltips(!1), a.length > 0)
                    if (this.datasets && this.datasets.length > 1) {
                        for (var g, h, j = this.datasets.length - 1; j >= 0 && (g = this.datasets[j].points || this.datasets[j].bars || this.datasets[j].segments, h = i(g, a[0]), - 1 === h); j--)
                            ;
                        var k = [],
                                l = [],
                                m = function (a) {
                                    var b, c, e, f, g, i = [],
                                            j = [],
                                            m = [];
                                    return d.each(this.datasets, function (a) {
                                        a.showTooltips !== !1 && (b = a.points || a.bars || a.segments, b[h] && b[h].hasValue() && i.push(b[h]))
                                    }), d.each(i, function (a) {
                                        j.push(a.x), m.push(a.y), k.push(d.template(this.options.multiTooltipTemplate, a)), l.push({
                                            fill: a._saved.fillColor || a.fillColor,
                                            stroke: a._saved.strokeColor || a.strokeColor
                                        })
                                    }, this), g = q(m), e = p(m), f = q(j), c = p(j), {
                                        x: f > this.chart.width / 2 ? f : c,
                                        y: (g + e) / 2
                                    }
                                }.call(this, h);
                        new c.MultiTooltip({
                            x: m.x,
                            y: m.y,
                            xPadding: this.options.tooltipXPadding,
                            yPadding: this.options.tooltipYPadding,
                            xOffset: this.options.tooltipXOffset,
                            fillColor: this.options.tooltipFillColor,
                            textColor: this.options.tooltipFontColor,
                            fontFamily: this.options.tooltipFontFamily,
                            fontStyle: this.options.tooltipFontStyle,
                            fontSize: this.options.tooltipFontSize,
                            titleTextColor: this.options.tooltipTitleFontColor,
                            titleFontFamily: this.options.tooltipTitleFontFamily,
                            titleFontStyle: this.options.tooltipTitleFontStyle,
                            titleFontSize: this.options.tooltipTitleFontSize,
                            cornerRadius: this.options.tooltipCornerRadius,
                            labels: k,
                            legendColors: l,
                            legendColorBackground: this.options.multiTooltipKeyBackground,
                            title: a[0].label,
                            chart: this.chart,
                            ctx: this.chart.ctx,
                            custom: this.options.customTooltips
                        }).draw()
                    } else
                        e(a, function (a) {
                            var b = a.tooltipPosition();
                            new c.Tooltip({
                                x: Math.round(b.x),
                                y: Math.round(b.y),
                                xPadding: this.options.tooltipXPadding,
                                yPadding: this.options.tooltipYPadding,
                                fillColor: this.options.tooltipFillColor,
                                textColor: this.options.tooltipFontColor,
                                fontFamily: this.options.tooltipFontFamily,
                                fontStyle: this.options.tooltipFontStyle,
                                fontSize: this.options.tooltipFontSize,
                                caretHeight: this.options.tooltipCaretSize,
                                cornerRadius: this.options.tooltipCornerRadius,
                                text: v(this.options.tooltipTemplate, a),
                                chart: this.chart,
                                custom: this.options.customTooltips
                            }).draw()
                        }, this);
                return this
            }
        },
        toBase64Image: function () {
            return this.chart.canvas.toDataURL.apply(this.chart.canvas, arguments)
        }
    }), c.Type.extend = function (a) {
        var b = this,
                d = function () {
                    return b.apply(this, arguments)
                };
        if (d.prototype = f(b.prototype), g(d.prototype, a), d.extend = c.Type.extend, a.name || b.prototype.name) {
            var e = a.name || b.prototype.name,
                    i = c.defaults[b.prototype.name] ? f(c.defaults[b.prototype.name]) : {};
            c.defaults[e] = g(i, a.defaults), c.types[e] = d, c.prototype[e] = function (a, b) {
                var f = h(c.defaults.global, c.defaults[e], b || {});
                return new d(a, f, this)
            }
        } else
            m("Name not provided for this chart, so it hasn't been registered");
        return b
    }, c.Element = function (a) {
        g(this, a), this.initialize.apply(this, arguments), this.save()
    }, g(c.Element.prototype, {
        initialize: function () {
        },
        restore: function (a) {
            return a ? e(a, function (a) {
                this[a] = this._saved[a]
            }, this) : g(this, this._saved), this
        },
        save: function () {
            return this._saved = f(this), delete this._saved._saved, this
        },
        update: function (a) {
            return e(a, function (a, b) {
                this._saved[b] = this[b], this[b] = a
            }, this), this
        },
        transition: function (a, b) {
            return e(a, function (a, c) {
                this[c] = (a - this._saved[c]) * b + this._saved[c]
            }, this), this
        },
        tooltipPosition: function () {
            return {
                x: this.x,
                y: this.y
            }
        },
        hasValue: function () {
            return o(this.value)
        }
    }), c.Element.extend = j, c.Point = c.Element.extend({
        display: !0,
        inRange: function (a, b) {
            var c = this.hitDetectionRadius + this.radius;
            return Math.pow(a - this.x, 2) + Math.pow(b - this.y, 2) < Math.pow(c, 2)
        },
        draw: function () {
            if (this.display) {
                var a = this.ctx;
                a.beginPath(), a.arc(this.x, this.y, this.radius, 0, 2 * Math.PI), a.closePath(), a.strokeStyle = this.strokeColor, a.lineWidth = this.strokeWidth, a.fillStyle = this.fillColor, a.fill(), a.stroke()
            }
        }
    }), c.Arc = c.Element.extend({
        inRange: function (a, b) {
            var c = d.getAngleFromPoint(this, {
                x: a,
                y: b
            }),
                    e = c.angle >= this.startAngle && c.angle <= this.endAngle,
                    f = c.distance >= this.innerRadius && c.distance <= this.outerRadius;
            return e && f
        },
        tooltipPosition: function () {
            var a = this.startAngle + (this.endAngle - this.startAngle) / 2,
                    b = (this.outerRadius - this.innerRadius) / 2 + this.innerRadius;
            return {
                x: this.x + Math.cos(a) * b,
                y: this.y + Math.sin(a) * b
            }
        },
        draw: function (a) {
            var b = this.ctx;
            b.beginPath(), b.arc(this.x, this.y, this.outerRadius, this.startAngle, this.endAngle), b.arc(this.x, this.y, this.innerRadius, this.endAngle, this.startAngle, !0), b.closePath(), b.strokeStyle = this.strokeColor, b.lineWidth = this.strokeWidth, b.fillStyle = this.fillColor, b.fill(), b.lineJoin = "bevel", this.showStroke && b.stroke()
        }
    }), c.Rectangle = c.Element.extend({
        draw: function () {
            var a = this.ctx,
                    b = this.width / 2,
                    c = this.x - b,
                    d = this.x + b,
                    e = this.base - (this.base - this.y),
                    f = this.strokeWidth / 2;
            this.showStroke && (c += f, d -= f, e += f), a.beginPath(), a.fillStyle = this.fillColor, a.strokeStyle = this.strokeColor, a.lineWidth = this.strokeWidth, a.moveTo(c, this.base), a.lineTo(c, e), a.lineTo(d, e), a.lineTo(d, this.base), a.fill(), this.showStroke && a.stroke()
        },
        height: function () {
            return this.base - this.y
        },
        inRange: function (a, b) {
            return a >= this.x - this.width / 2 && a <= this.x + this.width / 2 && b >= this.y && b <= this.base
        }
    }), c.Tooltip = c.Element.extend({
        draw: function () {
            var a = this.chart.ctx;
            a.font = G(this.fontSize, this.fontStyle, this.fontFamily), this.xAlign = "center", this.yAlign = "above";
            var b = this.caretPadding = 2,
                    c = a.measureText(this.text).width + 2 * this.xPadding,
                    d = this.fontSize + 2 * this.yPadding,
                    e = d + this.caretHeight + b;
            this.x + c / 2 > this.chart.width ? this.xAlign = "left" : this.x - c / 2 < 0 && (this.xAlign = "right"), this.y - e < 0 && (this.yAlign = "below");
            var f = this.x - c / 2,
                    g = this.y - e;
            if (a.fillStyle = this.fillColor, this.custom)
                this.custom(this);
            else {
                switch (this.yAlign) {
                    case "above":
                        a.beginPath(), a.moveTo(this.x, this.y - b), a.lineTo(this.x + this.caretHeight, this.y - (b + this.caretHeight)), a.lineTo(this.x - this.caretHeight, this.y - (b + this.caretHeight)), a.closePath(), a.fill();
                        break;
                    case "below":
                        g = this.y + b + this.caretHeight, a.beginPath(), a.moveTo(this.x, this.y + b), a.lineTo(this.x + this.caretHeight, this.y + b + this.caretHeight), a.lineTo(this.x - this.caretHeight, this.y + b + this.caretHeight), a.closePath(), a.fill()
                }
                switch (this.xAlign) {
                    case "left":
                        f = this.x - c + (this.cornerRadius + this.caretHeight);
                        break;
                    case "right":
                        f = this.x - (this.cornerRadius + this.caretHeight)
                }
                I(a, f, g, c, d, this.cornerRadius), a.fill(), a.fillStyle = this.textColor, a.textAlign = "center", a.textBaseline = "middle", a.fillText(this.text, f + c / 2, g + d / 2)
            }
        }
    }), c.MultiTooltip = c.Element.extend({
        initialize: function () {
            this.font = G(this.fontSize, this.fontStyle, this.fontFamily), this.titleFont = G(this.titleFontSize, this.titleFontStyle, this.titleFontFamily), this.height = this.labels.length * this.fontSize + (this.labels.length - 1) * (this.fontSize / 2) + 2 * this.yPadding + 1.5 * this.titleFontSize, this.ctx.font = this.titleFont;
            var a = this.ctx.measureText(this.title).width,
                    b = H(this.ctx, this.font, this.labels) + this.fontSize + 3,
                    c = p([b, a]);
            this.width = c + 2 * this.xPadding;
            var d = this.height / 2;
            this.y - d < 0 ? this.y = d : this.y + d > this.chart.height && (this.y = this.chart.height - d), this.x > this.chart.width / 2 ? this.x -= this.xOffset + this.width : this.x += this.xOffset
        },
        getLineHeight: function (a) {
            var b = this.y - this.height / 2 + this.yPadding,
                    c = a - 1;
            return 0 === a ? b + this.titleFontSize / 2 : b + (1.5 * this.fontSize * c + this.fontSize / 2) + 1.5 * this.titleFontSize
        },
        draw: function () {
            if (this.custom)
                this.custom(this);
            else {
                I(this.ctx, this.x, this.y - this.height / 2, this.width, this.height, this.cornerRadius);
                var a = this.ctx;
                a.fillStyle = this.fillColor, a.fill(), a.closePath(), a.textAlign = "left", a.textBaseline = "middle", a.fillStyle = this.titleTextColor, a.font = this.titleFont, a.fillText(this.title, this.x + this.xPadding, this.getLineHeight(0)), a.font = this.font, d.each(this.labels, function (b, c) {
                    a.fillStyle = this.textColor, a.fillText(b, this.x + this.xPadding + this.fontSize + 3, this.getLineHeight(c + 1)), a.fillStyle = this.legendColorBackground, a.fillRect(this.x + this.xPadding, this.getLineHeight(c + 1) - this.fontSize / 2, this.fontSize, this.fontSize), a.fillStyle = this.legendColors[c].fill, a.fillRect(this.x + this.xPadding, this.getLineHeight(c + 1) - this.fontSize / 2, this.fontSize, this.fontSize)
                }, this)
            }
        }
    }), c.Scale = c.Element.extend({
        initialize: function () {
            this.fit()
        },
        buildYLabels: function () {
            this.yLabels = [];
            for (var a = r(this.stepValue), b = 0; b <= this.steps; b++)
                this.yLabels.push(v(this.templateString, {
                    value: (this.min + b * this.stepValue).toFixed(a)
                }));
            this.yLabelWidth = this.display && this.showLabels ? H(this.ctx, this.font, this.yLabels) : 0
        },
        addXLabel: function (a) {
            this.xLabels.push(a), this.valuesCount++, this.fit()
        },
        removeXLabel: function () {
            this.xLabels.shift(), this.valuesCount--, this.fit()
        },
        fit: function () {
            this.startPoint = this.display ? this.fontSize : 0, this.endPoint = this.display ? this.height - 1.5 * this.fontSize - 5 : this.height, this.startPoint += this.padding, this.endPoint -= this.padding;
            var a, b = this.endPoint - this.startPoint;
            for (this.calculateYRange(b), this.buildYLabels(), this.calculateXLabelRotation(); b > this.endPoint - this.startPoint; )
                b = this.endPoint - this.startPoint, a = this.yLabelWidth, this.calculateYRange(b), this.buildYLabels(), a < this.yLabelWidth && this.calculateXLabelRotation()
        },
        calculateXLabelRotation: function () {
            this.ctx.font = this.font;
            var a, b, c = this.ctx.measureText(this.xLabels[0]).width,
                    d = this.ctx.measureText(this.xLabels[this.xLabels.length - 1]).width;
            if (this.xScalePaddingRight = d / 2 + 3, this.xScalePaddingLeft = c / 2 > this.yLabelWidth + 10 ? c / 2 : this.yLabelWidth + 10, this.xLabelRotation = 0, this.display) {
                var e, f = H(this.ctx, this.font, this.xLabels);
                this.xLabelWidth = f;
                for (var g = Math.floor(this.calculateX(1) - this.calculateX(0)) - 6; this.xLabelWidth > g && 0 === this.xLabelRotation || this.xLabelWidth > g && this.xLabelRotation <= 90 && this.xLabelRotation > 0; )
                    e = Math.cos(s(this.xLabelRotation)), a = e * c, b = e * d, a + this.fontSize / 2 > this.yLabelWidth + 8 && (this.xScalePaddingLeft = a + this.fontSize / 2), this.xScalePaddingRight = this.fontSize / 2, this.xLabelRotation++, this.xLabelWidth = e * f;
                this.xLabelRotation > 0 && (this.endPoint -= Math.sin(s(this.xLabelRotation)) * f + 3)
            } else
                this.xLabelWidth = 0, this.xScalePaddingRight = this.padding, this.xScalePaddingLeft = this.padding
        },
        calculateYRange: k,
        drawingArea: function () {
            return this.startPoint - this.endPoint
        },
        calculateY: function (a) {
            var b = this.drawingArea() / (this.min - this.max);
            return this.endPoint - b * (a - this.min)
        },
        calculateX: function (a) {
            var b = (this.xLabelRotation > 0, this.width - (this.xScalePaddingLeft + this.xScalePaddingRight)),
                    c = b / Math.max(this.valuesCount - (this.offsetGridLines ? 0 : 1), 1),
                    d = c * a + this.xScalePaddingLeft;
            return this.offsetGridLines && (d += c / 2), Math.round(d)
        },
        update: function (a) {
            d.extend(this, a), this.fit()
        },
        draw: function () {
            var a = this.ctx,
                    b = (this.endPoint - this.startPoint) / this.steps,
                    c = Math.round(this.xScalePaddingLeft);
            this.display && (a.fillStyle = this.textColor, a.font = this.font, e(this.yLabels, function (e, f) {
                var g = this.endPoint - b * f,
                        h = Math.round(g),
                        i = this.showHorizontalLines;
                a.textAlign = "right", a.textBaseline = "middle", this.showLabels && a.fillText(e, c - 10, g), 0 !== f || i || (i = !0), i && a.beginPath(), f > 0 ? (a.lineWidth = this.gridLineWidth, a.strokeStyle = this.gridLineColor) : (a.lineWidth = this.lineWidth, a.strokeStyle = this.lineColor), h += d.aliasPixel(a.lineWidth), i && (a.moveTo(c, h), a.lineTo(this.width, h), a.stroke(), a.closePath()), a.lineWidth = this.lineWidth, a.strokeStyle = this.lineColor, a.beginPath(), a.moveTo(c - 5, h), a.lineTo(c, h), a.stroke(), a.closePath()
            }, this), e(this.xLabels, function (b, c) {
                var d = this.calculateX(c) + t(this.lineWidth),
                        e = this.calculateX(c - (this.offsetGridLines ? .5 : 0)) + t(this.lineWidth),
                        f = this.xLabelRotation > 0,
                        g = this.showVerticalLines;
                0 !== c || g || (g = !0), g && a.beginPath(), c > 0 ? (a.lineWidth = this.gridLineWidth, a.strokeStyle = this.gridLineColor) : (a.lineWidth = this.lineWidth, a.strokeStyle = this.lineColor), g && (a.moveTo(e, this.endPoint), a.lineTo(e, this.startPoint - 3), a.stroke(), a.closePath()), a.lineWidth = this.lineWidth, a.strokeStyle = this.lineColor, a.beginPath(), a.moveTo(e, this.endPoint), a.lineTo(e, this.endPoint + 5), a.stroke(), a.closePath(), a.save(), a.translate(d, f ? this.endPoint + 12 : this.endPoint + 8), a.rotate(-1 * s(this.xLabelRotation)), a.font = this.font, a.textAlign = f ? "right" : "center", a.textBaseline = f ? "middle" : "top", a.fillText(b, 0, 0), a.restore()
            }, this))
        }
    }), c.RadialScale = c.Element.extend({
        initialize: function () {
            this.size = q([this.height, this.width]), this.drawingArea = this.display ? this.size / 2 - (this.fontSize / 2 + this.backdropPaddingY) : this.size / 2
        },
        calculateCenterOffset: function (a) {
            var b = this.drawingArea / (this.max - this.min);
            return (a - this.min) * b
        },
        update: function () {
            this.lineArc ? this.drawingArea = this.display ? this.size / 2 - (this.fontSize / 2 + this.backdropPaddingY) : this.size / 2 : this.setScaleSize(), this.buildYLabels()
        },
        buildYLabels: function () {
            this.yLabels = [];
            for (var a = r(this.stepValue), b = 0; b <= this.steps; b++)
                this.yLabels.push(v(this.templateString, {
                    value: (this.min + b * this.stepValue).toFixed(a)
                }))
        },
        getCircumference: function () {
            return 2 * Math.PI / this.valuesCount
        },
        setScaleSize: function () {
            var a, b, c, d, e, f, g, h, i, j, k, l, m = q([this.height / 2 - this.pointLabelFontSize - 5, this.width / 2]),
                    n = this.width,
                    p = 0;
            for (this.ctx.font = G(this.pointLabelFontSize, this.pointLabelFontStyle, this.pointLabelFontFamily), b = 0; b < this.valuesCount; b++)
                a = this.getPointPosition(b, m), c = this.ctx.measureText(v(this.templateString, {
                    value: this.labels[b]
                })).width + 5, 0 === b || b === this.valuesCount / 2 ? (d = c / 2, a.x + d > n && (n = a.x + d, e = b), a.x - d < p && (p = a.x - d, g = b)) : b < this.valuesCount / 2 ? a.x + c > n && (n = a.x + c, e = b) : b > this.valuesCount / 2 && a.x - c < p && (p = a.x - c, g = b);
            i = p, j = Math.ceil(n - this.width), f = this.getIndexAngle(e), h = this.getIndexAngle(g), k = j / Math.sin(f + Math.PI / 2), l = i / Math.sin(h + Math.PI / 2), k = o(k) ? k : 0, l = o(l) ? l : 0, this.drawingArea = m - (l + k) / 2, this.setCenterPoint(l, k)
        },
        setCenterPoint: function (a, b) {
            var c = this.width - b - this.drawingArea,
                    d = a + this.drawingArea;
            this.xCenter = (d + c) / 2, this.yCenter = this.height / 2
        },
        getIndexAngle: function (a) {
            var b = 2 * Math.PI / this.valuesCount;
            return a * b - Math.PI / 2
        },
        getPointPosition: function (a, b) {
            var c = this.getIndexAngle(a);
            return {
                x: Math.cos(c) * b + this.xCenter,
                y: Math.sin(c) * b + this.yCenter
            }
        },
        draw: function () {
            if (this.display) {
                var a = this.ctx;
                if (e(this.yLabels, function (b, c) {
                    if (c > 0) {
                        var d, e = c * (this.drawingArea / this.steps),
                                f = this.yCenter - e;
                        if (this.lineWidth > 0)
                            if (a.strokeStyle = this.lineColor, a.lineWidth = this.lineWidth, this.lineArc)
                                a.beginPath(), a.arc(this.xCenter, this.yCenter, e, 0, 2 * Math.PI), a.closePath(), a.stroke();
                            else {
                                a.beginPath();
                                for (var g = 0; g < this.valuesCount; g++)
                                    d = this.getPointPosition(g, this.calculateCenterOffset(this.min + c * this.stepValue)), 0 === g ? a.moveTo(d.x, d.y) : a.lineTo(d.x, d.y);
                                a.closePath(), a.stroke()
                            }
                        if (this.showLabels) {
                            if (a.font = G(this.fontSize, this.fontStyle, this.fontFamily), this.showLabelBackdrop) {
                                var h = a.measureText(b).width;
                                a.fillStyle = this.backdropColor, a.fillRect(this.xCenter - h / 2 - this.backdropPaddingX, f - this.fontSize / 2 - this.backdropPaddingY, h + 2 * this.backdropPaddingX, this.fontSize + 2 * this.backdropPaddingY)
                            }
                            a.textAlign = "center", a.textBaseline = "middle", a.fillStyle = this.fontColor, a.fillText(b, this.xCenter, f)
                        }
                    }
                }, this), !this.lineArc) {
                    a.lineWidth = this.angleLineWidth, a.strokeStyle = this.angleLineColor;
                    for (var b = this.valuesCount - 1; b >= 0; b--) {
                        if (this.angleLineWidth > 0) {
                            var c = this.getPointPosition(b, this.calculateCenterOffset(this.max));
                            a.beginPath(), a.moveTo(this.xCenter, this.yCenter), a.lineTo(c.x, c.y), a.stroke(), a.closePath()
                        }
                        var d = this.getPointPosition(b, this.calculateCenterOffset(this.max) + 5);
                        a.font = G(this.pointLabelFontSize, this.pointLabelFontStyle, this.pointLabelFontFamily), a.fillStyle = this.pointLabelFontColor;
                        var f = this.labels.length,
                                g = this.labels.length / 2,
                                h = g / 2,
                                i = h > b || b > f - h,
                                j = b === h || b === f - h;
                        a.textAlign = 0 === b ? "center" : b === g ? "center" : g > b ? "left" : "right", a.textBaseline = j ? "middle" : i ? "bottom" : "top", a.fillText(this.labels[b], d.x, d.y)
                    }
                }
            }
        }
    }), d.addEvent(window, "resize", function () {
        var a;
        return function () {
            clearTimeout(a), a = setTimeout(function () {
                e(c.instances, function (a) {
                    a.options.responsive && a.resize(a.render, !0)
                })
            }, 50)
        }
    }()), n ? define(function () {
        return c
    }) : "object" == typeof module && module.exports && (module.exports = c), b.Chart = c, a.fn.chart = function () {
        var a = [];
        return this.each(function () {
            a.push(new c(this.getContext("2d")))
        }), 1 === a.length ? a[0] : a
    }
}.call(this, jQuery), function (a) {
    "use strict";
    var b = a && a.zui ? a.zui : this,
            c = b.Chart,
            d = c.helpers,
            e = {
                scaleShowGridLines: !0,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                scaleShowHorizontalLines: !0,
                scaleShowVerticalLines: !0,
                bezierCurve: !0,
                bezierCurveTension: .4,
                pointDot: !0,
                pointDotRadius: 4,
                pointDotStrokeWidth: 1,
                pointHitDetectionRadius: 20,
                datasetStroke: !0,
                datasetStrokeWidth: 2,
                datasetFill: !0,
                legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].strokeColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>'
            };
    c.Type.extend({
        name: "Line",
        defaults: e,
        initialize: function (b) {
            this.PointClass = c.Point.extend({
                strokeWidth: this.options.pointDotStrokeWidth,
                radius: this.options.pointDotRadius,
                display: this.options.pointDot,
                hitDetectionRadius: this.options.pointHitDetectionRadius,
                ctx: this.chart.ctx,
                inRange: function (a) {
                    return Math.pow(a - this.x, 2) < Math.pow(this.radius + this.hitDetectionRadius, 2)
                }
            }), this.datasets = [], this.options.showTooltips && d.bindEvents(this, this.options.tooltipEvents, function (a) {
                var b = "mouseout" !== a.type ? this.getPointsAtEvent(a) : [];
                this.eachPoints(function (a) {
                    a.restore(["fillColor", "strokeColor"])
                }), d.each(b, function (a) {
                    a.fillColor = a.highlightFill, a.strokeColor = a.highlightStroke
                }), this.showTooltip(b)
            }), d.each(b.datasets, function (c) {
                if (a.zui && a.zui.Color && a.zui.Color.get) {
                    var e = a.zui.Color.get(c.color),
                            f = e.toCssStr();
                    c.fillColor || (c.fillColor = e.clone().fade(20).toCssStr()), c.strokeColor || (c.strokeColor = f), c.pointColor || (c.pointColor = f), c.pointStrokeColor || (c.pointStrokeColor = "#fff"), c.pointHighlightFill || (c.pointHighlightFill = "#fff"), c.pointHighlightStroke || (c.pointHighlightStroke = f)
                }
                var g = {
                    label: c.label || null,
                    fillColor: c.fillColor,
                    strokeColor: c.strokeColor,
                    pointColor: c.pointColor,
                    pointStrokeColor: c.pointStrokeColor,
                    showTooltips: c.showTooltips !== !1,
                    points: []
                };
                this.datasets.push(g), d.each(c.data, function (a, d) {
                    g.points.push(new this.PointClass({
                        value: a,
                        label: b.labels[d],
                        datasetLabel: c.label,
                        strokeColor: c.pointStrokeColor,
                        fillColor: c.pointColor,
                        highlightFill: c.pointHighlightFill || c.pointColor,
                        highlightStroke: c.pointHighlightStroke || c.pointStrokeColor
                    }))
                }, this), this.buildScale(b.labels), this.eachPoints(function (a, b) {
                    d.extend(a, {
                        x: this.scale.calculateX(b),
                        y: this.scale.endPoint
                    }), a.save()
                }, this)
            }, this), this.render()
        },
        update: function () {
            this.scale.update(), d.each(this.activeElements, function (a) {
                a.restore(["fillColor", "strokeColor"])
            }), this.eachPoints(function (a) {
                a.save()
            }), this.render()
        },
        eachPoints: function (a) {
            d.each(this.datasets, function (b) {
                d.each(b.points, a, this)
            }, this)
        },
        getPointsAtEvent: function (a) {
            var b = [],
                    c = d.getRelativePosition(a);
            return d.each(this.datasets, function (a) {
                d.each(a.points, function (a) {
                    a.inRange(c.x, c.y) && b.push(a)
                })
            }, this), b
        },
        buildScale: function (a) {
            var b = this,
                    e = function () {
                        var a = [];
                        return b.eachPoints(function (b) {
                            a.push(b.value)
                        }), a
                    },
                    f = {
                        templateString: this.options.scaleLabel,
                        height: this.chart.height,
                        width: this.chart.width,
                        ctx: this.chart.ctx,
                        textColor: this.options.scaleFontColor,
                        fontSize: this.options.scaleFontSize,
                        fontStyle: this.options.scaleFontStyle,
                        fontFamily: this.options.scaleFontFamily,
                        valuesCount: a.length,
                        beginAtZero: this.options.scaleBeginAtZero,
                        integersOnly: this.options.scaleIntegersOnly,
                        calculateYRange: function (a) {
                            var b = d.calculateScaleRange(e(), a, this.fontSize, this.beginAtZero, this.integersOnly);
                            d.extend(this, b)
                        },
                        xLabels: a,
                        font: d.fontString(this.options.scaleFontSize, this.options.scaleFontStyle, this.options.scaleFontFamily),
                        lineWidth: this.options.scaleLineWidth,
                        lineColor: this.options.scaleLineColor,
                        showHorizontalLines: this.options.scaleShowHorizontalLines,
                        showVerticalLines: this.options.scaleShowVerticalLines,
                        gridLineWidth: this.options.scaleShowGridLines ? this.options.scaleGridLineWidth : 0,
                        gridLineColor: this.options.scaleShowGridLines ? this.options.scaleGridLineColor : "rgba(0,0,0,0)",
                        padding: this.options.showScale ? 0 : this.options.pointDotRadius + this.options.pointDotStrokeWidth,
                        showLabels: this.options.scaleShowLabels,
                        display: this.options.showScale
                    };
            this.options.scaleOverride && d.extend(f, {
                calculateYRange: d.noop,
                steps: this.options.scaleSteps,
                stepValue: this.options.scaleStepWidth,
                min: this.options.scaleStartValue,
                max: this.options.scaleStartValue + this.options.scaleSteps * this.options.scaleStepWidth
            }), this.scale = new c.Scale(f)
        },
        addData: function (a, b) {
            d.each(a, function (a, c) {
                this.datasets[c].points.push(new this.PointClass({
                    value: a,
                    label: b,
                    x: this.scale.calculateX(this.scale.valuesCount + 1),
                    y: this.scale.endPoint,
                    strokeColor: this.datasets[c].pointStrokeColor,
                    fillColor: this.datasets[c].pointColor
                }))
            }, this), this.scale.addXLabel(b), this.update()
        },
        removeData: function () {
            this.scale.removeXLabel(), d.each(this.datasets, function (a) {
                a.points.shift()
            }, this), this.update()
        },
        reflow: function () {
            var a = d.extend({
                height: this.chart.height,
                width: this.chart.width
            });
            this.scale.update(a)
        },
        draw: function (a) {
            var b = a || 1;
            this.clear();
            var c = this.chart.ctx,
                    e = function (a) {
                        return null !== a.value
                    },
                    f = function (a, b, c) {
                        return d.findNextWhere(b, e, c) || a
                    },
                    g = function (a, b, c) {
                        return d.findPreviousWhere(b, e, c) || a
                    };
            this.scale.draw(b), d.each(this.datasets, function (a) {
                var h = d.where(a.points, e);
                d.each(a.points, function (a, c) {
                    a.hasValue() && a.transition({
                        y: this.scale.calculateY(a.value),
                        x: this.scale.calculateX(c)
                    }, b)
                }, this), this.options.bezierCurve && d.each(h, function (a, b) {
                    var c = b > 0 && b < h.length - 1 ? this.options.bezierCurveTension : 0;
                    a.controlPoints = d.splineCurve(g(a, h, b), a, f(a, h, b), c), a.controlPoints.outer.y > this.scale.endPoint ? a.controlPoints.outer.y = this.scale.endPoint : a.controlPoints.outer.y < this.scale.startPoint && (a.controlPoints.outer.y = this.scale.startPoint), a.controlPoints.inner.y > this.scale.endPoint ? a.controlPoints.inner.y = this.scale.endPoint : a.controlPoints.inner.y < this.scale.startPoint && (a.controlPoints.inner.y = this.scale.startPoint)
                }, this), c.lineWidth = this.options.datasetStrokeWidth, c.strokeStyle = a.strokeColor, c.beginPath(), d.each(h, function (a, b) {
                    if (0 === b)
                        c.moveTo(a.x, a.y);
                    else if (this.options.bezierCurve) {
                        var d = g(a, h, b);
                        c.bezierCurveTo(d.controlPoints.outer.x, d.controlPoints.outer.y, a.controlPoints.inner.x, a.controlPoints.inner.y, a.x, a.y)
                    } else
                        c.lineTo(a.x, a.y)
                }, this), c.stroke(), this.options.datasetFill && h.length > 0 && (c.lineTo(h[h.length - 1].x, this.scale.endPoint), c.lineTo(h[0].x, this.scale.endPoint), c.fillStyle = a.fillColor, c.closePath(), c.fill()), d.each(h, function (a) {
                    a.draw()
                })
            }, this)
        }
    }), a.fn.lineChart = function (b, d) {
        var e = [];
        return this.each(function () {
            var f = a(this);
            e.push(new c(this.getContext("2d")).Line(b, a.extend(f.data(), d)))
        }), 1 === e.length ? e[0] : e
    }
}.call(this, jQuery), function (a) {
    "use strict";
    var b = a && a.zui ? a.zui : this,
            c = b.Chart,
            d = c.helpers,
            e = {
                segmentShowStroke: !0,
                segmentStrokeColor: "#fff",
                segmentStrokeWidth: 1,
                percentageInnerCutout: 50,
                scaleShowLabels: !1,
                scaleLabel: "<%=value%>",
                scaleLabelPlacement: "auto",
                animationSteps: 60,
                animationEasing: "easeOutBounce",
                animateRotate: !0,
                animateScale: !1,
                legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<segments.length; i++){%><li><span style="background-color:<%=segments[i].fillColor%>"></span><%if(segments[i].label){%><%=segments[i].label%><%}%></li><%}%></ul>'
            };
    c.Type.extend({
        name: "Doughnut",
        defaults: e,
        initialize: function (a) {
            this.segments = [], this.outerRadius = (d.min([this.chart.width, this.chart.height]) - this.options.segmentStrokeWidth / 2) / 2, this.SegmentArc = c.Arc.extend({
                ctx: this.chart.ctx,
                x: this.chart.width / 2,
                y: this.chart.height / 2
            }), this.options.showTooltips && d.bindEvents(this, this.options.tooltipEvents, function (a) {
                var b = "mouseout" !== a.type ? this.getSegmentsAtEvent(a) : [];
                d.each(this.segments, function (a) {
                    a.restore(["fillColor"])
                }), d.each(b, function (a) {
                    a.fillColor = a.highlightColor
                }), this.showTooltip(b)
            }), this.calculateTotal(a), d.each(a, function (a, b) {
                this.addData(a, b, !0)
            }, this), this.render()
        },
        getSegmentsAtEvent: function (a) {
            var b = [],
                    c = d.getRelativePosition(a);
            return d.each(this.segments, function (a) {
                a.inRange(c.x, c.y) && b.push(a)
            }, this), b
        },
        addData: function (b, c, d) {
            if (a.zui && a.zui.Color && a.zui.Color.get) {
                var e = new a.zui.Color.get(b.color);
                b.color = e.toCssStr(), b.highlight || (b.highlight = e.lighten(5).toCssStr())
            }
            var f = c || this.segments.length;
            this.segments.splice(f, 0, new this.SegmentArc({
                id: "undefined" == typeof b.id ? f : b.id,
                value: b.value,
                outerRadius: this.options.animateScale ? 0 : this.outerRadius,
                innerRadius: this.options.animateScale ? 0 : this.outerRadius / 100 * this.options.percentageInnerCutout,
                fillColor: b.color,
                highlightColor: b.highlight || b.color,
                showStroke: this.options.segmentShowStroke,
                strokeWidth: this.options.segmentStrokeWidth,
                strokeColor: this.options.segmentStrokeColor,
                startAngle: 1.5 * Math.PI,
                circumference: this.options.animateRotate ? 0 : this.calculateCircumference(b.value),
                label: b.label
            })), d || (this.reflow(), this.update())
        },
        calculateCircumference: function (a) {
            return 2 * Math.PI * (Math.abs(a) / this.total)
        },
        calculateTotal: function (a) {
            this.total = 0, d.each(a, function (a) {
                this.total += Math.abs(a.value)
            }, this)
        },
        update: function () {
            this.calculateTotal(this.segments), d.each(this.activeElements, function (a) {
                a.restore(["fillColor"])
            }), d.each(this.segments, function (a) {
                a.save()
            }), this.render()
        },
        removeData: function (a) {
            var b = d.isNumber(a) ? a : this.segments.length - 1;
            this.segments.splice(b, 1), this.reflow(), this.update()
        },
        reflow: function () {
            d.extend(this.SegmentArc.prototype, {
                x: this.chart.width / 2,
                y: this.chart.height / 2
            }), this.outerRadius = (d.min([this.chart.width, this.chart.height]) - this.options.segmentStrokeWidth / 2) / 2, d.each(this.segments, function (a) {
                a.update({
                    outerRadius: this.outerRadius,
                    innerRadius: this.outerRadius / 100 * this.options.percentageInnerCutout
                })
            }, this)
        },
        drawLabel: function (b, c, e) {
            var f = this.options,
                    g = (b.endAngle + b.startAngle) / 2,
                    h = f.scaleLabelPlacement;
            "inside" !== h && "outside" !== h && this.chart.width - this.chart.height > 50 && b.circumference < Math.PI / 36 && (h = "outside");
            var i = Math.cos(g) * b.outerRadius,
                    j = Math.sin(g) * b.outerRadius,
                    k = d.template(f.scaleLabel, {
                        value: "undefined" == typeof c ? b.value : Math.round(c * b.value),
                        label: b.label
                    }),
                    l = this.chart.ctx;
            l.font = d.fontString(f.scaleFontSize, f.scaleFontStyle, f.scaleFontFamily), l.textBaseline = "middle", l.textAlign = "center";
            var m = (l.measureText(k).width, this.chart.width / 2),
                    n = this.chart.height / 2;
            if ("outside" === h) {
                var o = i >= 0,
                        p = i + m,
                        q = j + n;
                l.textAlign = o ? "left" : "right", l.measureText(k).width, i = o ? Math.max(m + b.outerRadius + 10, i + 30 + m) : Math.min(m - b.outerRadius - 10, i - 30 + m);
                var r = f.scaleFontSize,
                        s = Math.round((.8 * j + n) / r) + 1,
                        t = Math.floor(this.chart.width / r) + 1;
                for (e[o ? s : - s] && (s > 1 ? s-- : s++); e[o ? s : - s] && t > s; )
                    s++;
                if (e[s])
                    return;
                j = (s - 1) * r + f.scaleFontSize / 2, e[s] = !0, l.beginPath(), l.moveTo(p, q), l.lineTo(i, j), i = o ? i + 5 : i - 5, l.lineTo(i, j), l.strokeStyle = a.zui && a.zui.Color ? new a.zui.Color(b.fillColor).fade(40).toCssStr() : b.fillColor, l.strokeWidth = f.scaleLineWidth, l.stroke(), l.fillStyle = b.fillColor
            } else
                i = .6 * i + m, j = .6 * j + n, l.fillStyle = a.zui && a.zui.Color ? new a.zui.Color(b.fillColor).contrast().toCssStr() : "#fff";
            l.fillText(k, i, j)
        },
        draw: function (a) {
            var b = a ? a : 1;
            this.clear();
            var c;
            d.each(this.segments, function (d, e) {
                d.transition({
                    circumference: this.calculateCircumference(d.value),
                    outerRadius: this.outerRadius,
                    innerRadius: this.outerRadius / 100 * this.options.percentageInnerCutout
                }, b), d.endAngle = d.startAngle + d.circumference, d.draw(), 0 === e && (d.startAngle = 1.5 * Math.PI), e < this.segments.length - 1 && (this.segments[e + 1].startAngle = d.endAngle), this.options.scaleShowLabels && (c || (c = {}), this.drawLabel(d, a, c))
            }, this)
        }
    }), c.types.Doughnut.extend({
        name: "Pie",
        defaults: d.merge(e, {
            percentageInnerCutout: 0
        })
    }), a.fn.pieChart = function (b, d) {
        var e = [];
        return this.each(function () {
            var f = a(this);
            e.push(new c(this.getContext("2d")).Pie(b, a.extend(f.data(), d)))
        }), 1 === e.length ? e[0] : e
    }, a.fn.doughnutChart = function (b, d) {
        var e = [];
        return this.each(function () {
            var f = a(this);
            e.push(new c(this.getContext("2d")).Doughnut(b, a.extend(f.data(), d)))
        }), 1 === e.length ? e[0] : e
    }
}.call(this, jQuery), function (a) {
    "use strict";
    var b = a && a.zui ? a.zui : this,
            c = b.Chart,
            d = c.helpers,
            e = {
                scaleBeginAtZero: !0,
                scaleShowGridLines: !0,
                scaleGridLineColor: "rgba(0,0,0,.05)",
                scaleGridLineWidth: 1,
                scaleShowHorizontalLines: !0,
                scaleShowVerticalLines: !0,
                barShowStroke: !0,
                barStrokeWidth: 1,
                barValueSpacing: 5,
                barDatasetSpacing: 1,
                legendTemplate: '<ul class="<%=name.toLowerCase()%>-legend"><% for (var i=0; i<datasets.length; i++){%><li><span style="background-color:<%=datasets[i].fillColor%>"></span><%if(datasets[i].label){%><%=datasets[i].label%><%}%></li><%}%></ul>'
            };
    c.Type.extend({
        name: "Bar",
        defaults: e,
        initialize: function (b) {
            var e = this.options;
            this.ScaleClass = c.Scale.extend({
                offsetGridLines: !0,
                calculateBarX: function (a, b, c) {
                    var d = this.calculateBaseWidth(),
                            f = this.calculateX(c) - d / 2,
                            g = this.calculateBarWidth(a);
                    return f + g * b + b * e.barDatasetSpacing + g / 2
                },
                calculateBaseWidth: function () {
                    return this.calculateX(1) - this.calculateX(0) - 2 * e.barValueSpacing
                },
                calculateBarWidth: function (a) {
                    var b = this.calculateBaseWidth() - (a - 1) * e.barDatasetSpacing;
                    return b / a
                }
            }), this.datasets = [], this.options.showTooltips && d.bindEvents(this, this.options.tooltipEvents, function (a) {
                var b = "mouseout" !== a.type ? this.getBarsAtEvent(a) : [];
                this.eachBars(function (a) {
                    a.restore(["fillColor", "strokeColor"])
                }), d.each(b, function (a) {
                    a.fillColor = a.highlightFill, a.strokeColor = a.highlightStroke
                }), this.showTooltip(b)
            }), this.BarClass = c.Rectangle.extend({
                strokeWidth: this.options.barStrokeWidth,
                showStroke: this.options.barShowStroke,
                ctx: this.chart.ctx
            }), d.each(b.datasets, function (c, e) {
                if (a.zui && a.zui.Color && a.zui.Color.get) {
                    var f = a.zui.Color.get(c.color),
                            g = f.toCssStr();
                    c.fillColor || (c.fillColor = f.clone().fade(50).toCssStr()), c.strokeColor || (c.strokeColor = g)
                }
                var h = {
                    label: c.label || null,
                    fillColor: c.fillColor,
                    strokeColor: c.strokeColor,
                    bars: []
                };
                this.datasets.push(h), d.each(c.data, function (a, d) {
                    h.bars.push(new this.BarClass({
                        value: a,
                        label: b.labels[d],
                        datasetLabel: c.label,
                        strokeColor: c.strokeColor,
                        fillColor: c.fillColor,
                        highlightFill: c.highlightFill || c.fillColor,
                        highlightStroke: c.highlightStroke || c.strokeColor
                    }))
                }, this)
            }, this), this.buildScale(b.labels), this.BarClass.prototype.base = this.scale.endPoint, this.eachBars(function (a, b, c) {
                d.extend(a, {
                    width: this.scale.calculateBarWidth(this.datasets.length),
                    x: this.scale.calculateBarX(this.datasets.length, c, b),
                    y: this.scale.endPoint
                }), a.save()
            }, this), this.render()
        },
        update: function () {
            this.scale.update(), d.each(this.activeElements, function (a) {
                a.restore(["fillColor", "strokeColor"])
            }), this.eachBars(function (a) {
                a.save()
            }), this.render()
        },
        eachBars: function (a) {
            d.each(this.datasets, function (b, c) {
                d.each(b.bars, a, this, c)
            }, this)
        },
        getBarsAtEvent: function (a) {
            for (var b, c = [], e = d.getRelativePosition(a), f = function (a) {
                c.push(a.bars[b])
            }, g = 0; g < this.datasets.length; g++)
                for (b = 0; b < this.datasets[g].bars.length; b++)
                    if (this.datasets[g].bars[b].inRange(e.x, e.y))
                        return d.each(this.datasets, f), c;
            return c
        },
        buildScale: function (a) {
            var b = this,
                    c = function () {
                        var a = [];
                        return b.eachBars(function (b) {
                            a.push(b.value)
                        }), a
                    },
                    e = {
                        templateString: this.options.scaleLabel,
                        height: this.chart.height,
                        width: this.chart.width,
                        ctx: this.chart.ctx,
                        textColor: this.options.scaleFontColor,
                        fontSize: this.options.scaleFontSize,
                        fontStyle: this.options.scaleFontStyle,
                        fontFamily: this.options.scaleFontFamily,
                        valuesCount: a.length,
                        beginAtZero: this.options.scaleBeginAtZero,
                        integersOnly: this.options.scaleIntegersOnly,
                        calculateYRange: function (a) {
                            var b = d.calculateScaleRange(c(), a, this.fontSize, this.beginAtZero, this.integersOnly);
                            d.extend(this, b)
                        },
                        xLabels: a,
                        font: d.fontString(this.options.scaleFontSize, this.options.scaleFontStyle, this.options.scaleFontFamily),
                        lineWidth: this.options.scaleLineWidth,
                        lineColor: this.options.scaleLineColor,
                        showHorizontalLines: this.options.scaleShowHorizontalLines,
                        showVerticalLines: this.options.scaleShowVerticalLines,
                        gridLineWidth: this.options.scaleShowGridLines ? this.options.scaleGridLineWidth : 0,
                        gridLineColor: this.options.scaleShowGridLines ? this.options.scaleGridLineColor : "rgba(0,0,0,0)",
                        padding: this.options.showScale ? 0 : this.options.barShowStroke ? this.options.barStrokeWidth : 0,
                        showLabels: this.options.scaleShowLabels,
                        display: this.options.showScale
                    };
            this.options.scaleOverride && d.extend(e, {
                calculateYRange: d.noop,
                steps: this.options.scaleSteps,
                stepValue: this.options.scaleStepWidth,
                min: this.options.scaleStartValue,
                max: this.options.scaleStartValue + this.options.scaleSteps * this.options.scaleStepWidth
            }), this.scale = new this.ScaleClass(e)
        },
        addData: function (a, b) {
            d.each(a, function (a, c) {
                this.datasets[c].bars.push(new this.BarClass({
                    value: a,
                    label: b,
                    x: this.scale.calculateBarX(this.datasets.length, c, this.scale.valuesCount + 1),
                    y: this.scale.endPoint,
                    width: this.scale.calculateBarWidth(this.datasets.length),
                    base: this.scale.endPoint,
                    strokeColor: this.datasets[c].strokeColor,
                    fillColor: this.datasets[c].fillColor
                }))
            }, this), this.scale.addXLabel(b), this.update()
        },
        removeData: function () {
            this.scale.removeXLabel(), d.each(this.datasets, function (a) {
                a.bars.shift()
            }, this), this.update()
        },
        reflow: function () {
            d.extend(this.BarClass.prototype, {
                y: this.scale.endPoint,
                base: this.scale.endPoint
            });
            var a = d.extend({
                height: this.chart.height,
                width: this.chart.width
            });
            this.scale.update(a)
        },
        draw: function (a) {
            var b = a || 1;
            this.clear();
            this.chart.ctx;
            this.scale.draw(b), d.each(this.datasets, function (a, c) {
                d.each(a.bars, function (a, d) {
                    a.hasValue() && (a.base = this.scale.endPoint, a.transition({
                        x: this.scale.calculateBarX(this.datasets.length, c, d),
                        y: this.scale.calculateY(a.value),
                        width: this.scale.calculateBarWidth(this.datasets.length)
                    }, b).draw())
                }, this)
            }, this)
        }
    }), a.fn.barChart = function (b, d) {
        var e = [];
        return this.each(function () {
            var f = a(this);
            e.push(new c(this.getContext("2d")).Bar(b, a.extend(f.data(), d)))
        }), 1 === e.length ? e[0] : e
    }
}.call(this, jQuery);