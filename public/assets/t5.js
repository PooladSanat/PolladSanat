/*!
   Copyright 2015-2019 SpryMedia Ltd.

 This source file is free software, available under the following license:
   MIT license - http://datatables.net/license/mit

 This source file is distributed in the hope that it will be useful, but
 WITHOUT ANY WARRANTY; without even the implied warranty of MERCHANTABILITY
 or FITNESS FOR A PARTICULAR PURPOSE. See the license files for details.

 For details please refer to: http://www.datatables.net
 RowReorder 1.2.6
 2015-2019 SpryMedia Ltd - datatables.net/license
*/
var $jscomp = $jscomp || {};
$jscomp.scope = {};
$jscomp.findInternal = function (a, f, d) {
    a instanceof String && (a = String(a));
    for (var h = a.length, g = 0; g < h; g++) {
        var m = a[g];
        if (f.call(d, m, g, a)) return {i: g, v: m}
    }
    return {i: -1, v: void 0}
};
$jscomp.ASSUME_ES5 = !1;
$jscomp.ASSUME_NO_NATIVE_MAP = !1;
$jscomp.ASSUME_NO_NATIVE_SET = !1;
$jscomp.SIMPLE_FROUND_POLYFILL = !1;
$jscomp.defineProperty = $jscomp.ASSUME_ES5 || "function" == typeof Object.defineProperties ? Object.defineProperty : function (a, f, d) {
    a != Array.prototype && a != Object.prototype && (a[f] = d.value)
};
$jscomp.getGlobal = function (a) {
    return "undefined" != typeof window && window === a ? a : "undefined" != typeof global && null != global ? global : a
};
$jscomp.global = $jscomp.getGlobal(this);
$jscomp.polyfill = function (a, f, d, h) {
    if (f) {
        d = $jscomp.global;
        a = a.split(".");
        for (h = 0; h < a.length - 1; h++) {
            var g = a[h];
            g in d || (d[g] = {});
            d = d[g]
        }
        a = a[a.length - 1];
        h = d[a];
        f = f(h);
        f != h && null != f && $jscomp.defineProperty(d, a, {configurable: !0, writable: !0, value: f})
    }
};
$jscomp.polyfill("Array.prototype.find", function (a) {
    return a ? a : function (a, d) {
        return $jscomp.findInternal(this, a, d).v
    }
}, "es6", "es3");
(function (a) {
    "function" === typeof define && define.amd ? define(["jquery", "datatables.net"], function (f) {
        return a(f, window, document)
    }) : "object" === typeof exports ? module.exports = function (f, d) {
        f || (f = window);
        d && d.fn.dataTable || (d = require("datatables.net")(f, d).$);
        return a(d, f, f.document)
    } : a(jQuery, window, document)
})(function (a, f, d, h) {
    var g = a.fn.dataTable, m = function (c, e) {
        if (!g.versionCheck || !g.versionCheck("1.10.8")) throw"DataTables RowReorder requires DataTables 1.10.8 or newer";
        this.c = a.extend(!0, {}, g.defaults.rowReorder,
            m.defaults, e);
        this.s = {
            bodyTop: null,
            dt: new g.Api(c),
            getDataFn: g.ext.oApi._fnGetObjectDataFn(this.c.dataSrc),
            middles: null,
            scroll: {},
            scrollInterval: null,
            setDataFn: g.ext.oApi._fnSetObjectDataFn(this.c.dataSrc),
            start: {top: 0, left: 0, offsetTop: 0, offsetLeft: 0, nodes: []},
            windowHeight: 0,
            documentOuterHeight: 0,
            domCloneOuterHeight: 0
        };
        this.dom = {clone: null, dtScroll: a("div.dataTables_scrollBody", this.s.dt.table().container())};
        c = this.s.dt.settings()[0];
        if (e = c.rowreorder) return e;
        c.rowreorder = this;
        this._constructor()
    };
    a.extend(m.prototype, {
        _constructor: function () {
            var c = this, e = this.s.dt, b = a(e.table().node());
            "static" === b.css("position") && b.css("position", "relative");
            a(e.table().container()).on("mousedown.rowReorder touchstart.rowReorder", this.c.selector, function (b) {
                if (c.c.enable) {
                    if (a(b.target).is(c.c.excludedChildren)) return !0;
                    var d = a(this).closest("tr"), n = e.row(d);
                    if (n.any()) return c._emitEvent("pre-row-reorder", {
                        node: n.node(),
                        index: n.index()
                    }), c._mouseDown(b, d), !1
                }
            });
            e.on("destroy.rowReorder", function () {
                a(e.table().container()).off(".rowReorder");
                e.off(".rowReorder")
            })
        }, _cachePositions: function () {
            var c = this.s.dt, e = a(c.table().node()).find("thead").outerHeight(),
                b = a.unique(c.rows({page: "current"}).nodes().toArray()), n = a.map(b, function (c, b) {
                    return a(c).position().top - e
                });
            b = a.map(n, function (b, e) {
                return n.length < e - 1 ? (b + n[e + 1]) / 2 : (b + b + a(c.row(":last-child").node()).outerHeight()) / 2
            });
            this.s.middles = b;
            this.s.bodyTop = a(c.table().body()).offset().top;
            this.s.windowHeight = a(f).height();
            this.s.documentOuterHeight = a(d).outerHeight()
        }, _clone: function (c) {
            var e =
                    a(this.s.dt.table().node().cloneNode(!1)).addClass("dt-rowReorder-float").append("<tbody/>").append(c.clone(!1)),
                b = c.outerWidth(), n = c.outerHeight(), d = c.children().map(function () {
                    return a(this).width()
                });
            e.width(b).height(n).find("tr").children().each(function (a) {
                this.style.width = d[a] + "px"
            });
            e.appendTo("body");
            this.dom.clone = e;
            this.s.domCloneOuterHeight = e.outerHeight()
        }, _clonePosition: function (a) {
            var c = this.s.start, b = this._eventToPage(a, "Y") - c.top;
            a = this._eventToPage(a, "X") - c.left;
            var d = this.c.snapX;
            b += c.offsetTop;
            c = !0 === d ? c.offsetLeft : "number" === typeof d ? c.offsetLeft + d : a + c.offsetLeft;
            0 > b ? b = 0 : b + this.s.domCloneOuterHeight > this.s.documentOuterHeight && (b = this.s.documentOuterHeight - this.s.domCloneOuterHeight);
            this.dom.clone.css({top: b, left: c})
        }, _emitEvent: function (c, e) {
            this.s.dt.iterator("table", function (b, d) {
                a(b.nTable).triggerHandler(c + ".dt", e)
            })
        }, _eventToPage: function (a, e) {
            return -1 !== a.type.indexOf("touch") ? a.originalEvent.touches[0]["page" + e] : a["page" + e]
        }, _mouseDown: function (c, e) {
            var b = this,
                n = this.s.dt, g = this.s.start, t = e.offset();
            g.top = this._eventToPage(c, "Y");
            g.left = this._eventToPage(c, "X");
            g.offsetTop = t.top;
            g.offsetLeft = t.left;
            g.nodes = a.unique(n.rows({page: "current"}).nodes().toArray());
            this._cachePositions();
            this._clone(e);
            this._clonePosition(c);
            this.dom.target = e;
            e.addClass("dt-rowReorder-moving");
            a(d).on("mouseup.rowReorder touchend.rowReorder", function (a) {
                b._mouseUp(a)
            }).on("mousemove.rowReorder touchmove.rowReorder", function (a) {
                b._mouseMove(a)
            });
            a(f).width() === a(d).width() && a(d.body).addClass("dt-rowReorder-noOverflow");
            c = this.dom.dtScroll;
            this.s.scroll = {
                windowHeight: a(f).height(),
                windowWidth: a(f).width(),
                dtTop: c.length ? c.offset().top : null,
                dtLeft: c.length ? c.offset().left : null,
                dtHeight: c.length ? c.outerHeight() : null,
                dtWidth: c.length ? c.outerWidth() : null
            }
        }, _mouseMove: function (c) {
            this._clonePosition(c);
            for (var e = this._eventToPage(c, "Y") - this.s.bodyTop, b = this.s.middles, d = null, f = this.s.dt, g = f.table().body(), l = 0, h = b.length; l < h; l++) if (e < b[l]) {
                d = l;
                break
            }
            null === d && (d = b.length);
            if (null === this.s.lastInsert || this.s.lastInsert !==
                d) 0 === d ? this.dom.target.prependTo(g) : (e = a.unique(f.rows({page: "current"}).nodes().toArray()), d > this.s.lastInsert ? this.dom.target.insertAfter(e[d - 1]) : this.dom.target.insertBefore(e[d])), this._cachePositions(), this.s.lastInsert = d;
            this._shiftScroll(c)
        }, _mouseUp: function (c) {
            var e = this, b = this.s.dt, f, g = this.c.dataSrc;
            this.dom.clone.remove();
            this.dom.clone = null;
            this.dom.target.removeClass("dt-rowReorder-moving");
            a(d).off(".rowReorder");
            a(d.body).removeClass("dt-rowReorder-noOverflow");
            clearInterval(this.s.scrollInterval);
            this.s.scrollInterval = null;
            var h = this.s.start.nodes, l = a.unique(b.rows({page: "current"}).nodes().toArray()), m = {}, q = [],
                p = [], r = this.s.getDataFn, y = this.s.setDataFn;
            var k = 0;
            for (f = h.length; k < f; k++) if (h[k] !== l[k]) {
                var u = b.row(l[k]).id(), z = b.row(l[k]).data(), v = b.row(h[k]).data();
                u && (m[u] = r(v));
                q.push({node: l[k], oldData: r(z), newData: r(v), newPosition: k, oldPosition: a.inArray(l[k], h)});
                p.push(l[k])
            }
            var w = [q, {dataSrc: g, nodes: p, values: m, triggerRow: b.row(this.dom.target), originalEvent: c}];
            this._emitEvent("row-reorder",
                w);
            var x = function () {
                if (e.c.update) {
                    k = 0;
                    for (f = q.length; k < f; k++) {
                        var a = b.row(q[k].node).data();
                        y(a, q[k].newData);
                        b.columns().every(function () {
                            this.dataSrc() === g && b.cell(q[k].node, this.index()).invalidate("data")
                        })
                    }
                    e._emitEvent("row-reordered", w);
                    b.draw(!1)
                }
            };
            this.c.editor ? (this.c.enable = !1, this.c.editor.edit(p, !1, a.extend({submit: "changed"}, this.c.formOptions)).multiSet(g, m).one("preSubmitCancelled.rowReorder", function () {
                e.c.enable = !0;
                e.c.editor.off(".rowReorder");
                b.draw(!1)
            }).one("submitUnsuccessful.rowReorder",
                function () {
                    b.draw(!1)
                }).one("submitSuccess.rowReorder", function () {
                x()
            }).one("submitComplete", function () {
                e.c.enable = !0;
                e.c.editor.off(".rowReorder")
            }).submit()) : x()
        }, _shiftScroll: function (a) {
            var c = this, b = this.s.scroll, f = !1, g = a.pageY - d.body.scrollTop, h, l;
            65 > g ? h = -5 : g > b.windowHeight - 65 && (h = 5);
            null !== b.dtTop && a.pageY < b.dtTop + 65 ? l = -5 : null !== b.dtTop && a.pageY > b.dtTop + b.dtHeight - 65 && (l = 5);
            h || l ? (b.windowVert = h, b.dtVert = l, f = !0) : this.s.scrollInterval && (clearInterval(this.s.scrollInterval), this.s.scrollInterval =
                null);
            !this.s.scrollInterval && f && (this.s.scrollInterval = setInterval(function () {
                b.windowVert && (d.body.scrollTop += b.windowVert);
                if (b.dtVert) {
                    var a = c.dom.dtScroll[0];
                    b.dtVert && (a.scrollTop += b.dtVert)
                }
            }, 20))
        }
    });
    m.defaults = {
        dataSrc: 0,
        editor: null,
        enable: !0,
        formOptions: {},
        selector: "td:first-child",
        snapX: !1,
        update: !0,
        excludedChildren: "a"
    };
    var p = a.fn.dataTable.Api;
    p.register("rowReorder()", function () {
        return this
    });
    p.register("rowReorder.enable()", function (a) {
        a === h && (a = !0);
        return this.iterator("table", function (c) {
            c.rowreorder &&
            (c.rowreorder.c.enable = a)
        })
    });
    p.register("rowReorder.disable()", function () {
        return this.iterator("table", function (a) {
            a.rowreorder && (a.rowreorder.c.enable = !1)
        })
    });
    m.version = "1.2.6";
    a.fn.dataTable.RowReorder = m;
    a.fn.DataTable.RowReorder = m;
    a(d).on("init.dt.dtr", function (c, d, b) {
        "dt" === c.namespace && (c = d.oInit.rowReorder, b = g.defaults.rowReorder, c || b) && (b = a.extend({}, c, b), !1 !== c && new m(d, b))
    });
    return m
});
