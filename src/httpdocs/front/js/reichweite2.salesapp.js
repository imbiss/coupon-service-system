"use strict";
(function (c) {
    var b = document.getElementsByTagName("script");
    var a = b[b.length - 1];
    var d = new function () {
        this.init = function () {
            this.clientUid = this.uid();
            this.maxWait = 5;
            this.width = "100%";
            this.presentation = "iframe";
            var o = Math.random() <= 0.8;
            this.showVoucher = false;
            if (o) {
                this.url = "https://api.reichweite2.com/c/weltbild_v2/index.html"
            } else {
                this.url = "https://api.reichweite2.com/c/weltbild/index.html"
            }
            var i = "regioabocontainer";
            var q = window.prefill || {};
            if (a) {
                var h = a.getAttribute("data-container");
                if (h) {
                    i = h
                }
                var l = a.getAttribute("data-presentation");
                if (l) {
                    this.presentation = l
                }
                var p = a.getAttribute("data-prefill");
                if (p) {
                    q = window[p] || {}
                }
            }
            if (q.container) {
                i = q.container
            }
            q = this.fixPrefill(q);
            q.clientUid = this.clientUid;
            this.adjustModalWidth = function () {
                if (window.innerWidth < 600) {
                    document.getElementById("r2-modal").style.width = "90%";
                    document.getElementById("r2-modal").style.left = "5%"
                } else {
                    document.getElementById("r2-modal").style.width = "70%";
                    document.getElementById("r2-modal").style.left = "15%"
                }
            };
            if (this.presentation == "layer") {
                var f = function (v) {
                    v.preventDefault ? v.preventDefault() : v.returnValue = false;
                    r.style.display = "none";
                    u.style.display = "none"
                };
                var r = document.createElement("div");
                r.setAttribute("id", "r2-modal");
                r.setAttribute("style", "display:none; position:absolute; left:15%; top:5%; padding:0; border:none; background:none; width:70%; height:2000px; z-index:1000;");
                var j = document.createElement("a");
                j.setAttribute("class", "r2-modal-close");
                j.setAttribute("style", "display:block; position:absolute; right:-13px; top:-13px; padding:0; text-decoration:none;");
                j.setAttribute("href", "#");
                var e = document.createElement("img");
                e.setAttribute("style", "border:none;");
                e.setAttribute("src", "data:image/png;base64,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");
                j.appendChild(e);
                if (!j.addEventListener) {
                    j.attachEvent("onclick", f)
                } else {
                    j.addEventListener("click", f, true)
                }
                r.appendChild(j);
                document.body.appendChild(r);
                this.adjustModalWidth();
                r.style.display = "block";
                i = "r2-modal";
                var u = document.createElement("div");
                u.setAttribute("id", "r2-mask");
                u.setAttribute("style", "display:block; position:fixed; left:0%; top:0%; background-color:#000000; -moz-opacity:0.7; opacity:0.7; filter:alpha(opacity=70); width:100%; height:100%; z-index:999;");
                if (!u.addEventListener) {
                    u.attachEvent("onclick", f)
                } else {
                    u.addEventListener("click", f, true)
                }
                document.body.appendChild(u);
                if (!window.addEventListener) {
                    window.attachEvent("onresize", this.adjustModalWidth)
                } else {
                    window.addEventListener("resize", this.adjustModalWidth, true)
                }
            }
            this.startMessageListener(i);
            var g = document.getElementById(i);
            this.contentFrame = this.iframe(q);
            if (g) {
                if (window.navigator && (/Chrome/).test(window.navigator.userAgent)) {
                    var k = g.getAttribute("style");
                    var m = k + ";display:none;";
                    g.setAttribute("style", m);
                    window.setTimeout(function () {
                        g.setAttribute("style", k)
                    }, 1000)
                }
                g.appendChild(this.contentFrame)
            } else {
                var t = this;
                var s = this.maxWait * 10;
                var n = window.setInterval(function () {
                    s -= 1;
                    if (s <= 0) {
                        window.clearInterval(n);
                        throw"Unable to find container with ID " + i
                    }
                    g = document.getElementById(i);
                    if (g) {
                        window.clearInterval(n);
                        g.appendChild(t.contentFrame);
                        return
                    }
                }, 100)
            }
        };
        this.fixPrefill = function (h) {
            var f = {D: "DE", A: "AT", I: "IT", "": ""};
            if (typeof(h.country) == "undefined") {
                h.country = ""
            }
            if (typeof(h.postal_code) == "undefined") {
                h.postal_code = ""
            }
            h.country = f[h.country] || h.country;
            if (typeof(h.birthday) != "undefined" && h.birthday.length > 0) {
                var j = h.birthday;
                var e = new Array();
                var e = j.split("-");
                if (typeof(e[2]) != "undefined" && e[2].length == 4) {
                    var i = e[2];
                    var g = e[0];
                    e.splice(0, 1, i);
                    e.splice(2, 1, g);
                    j = e.join("-")
                }
                h.birthday = j
            }
            return h
        };
        this.startMessageListener = function (h) {
            var f = this;
            var i = 0;
            var g = -1;
            var e = function (p) {
                var j = ["http://localhost", "https://localhost", "https://0.0.0.0:4433", "https://192.168.17.27:4433", "https://v1.700000.b.d9tcloud.de", "https://api.regio-abo.com", "https://api.reichweite2.com"];
                var k = false;
                for (var o = 0; o < j.length; o++) {
                    var u = j[o];
                    if (p.origin.indexOf(u) >= 0) {
                        k = true;
                        break
                    }
                }
                if (!k) {
                    return
                }
                try {
                    var w = p.data.split(":")
                } catch (p) {
                    return
                }
                if (w.length != 2) {
                    return
                }
                var q = "height";
                if (f.clientUid) {
                    q = f.clientUid + "#" + q
                }
                if (w[0] == q) {
                    var v = w[1];
                    if (i != w[1]) {
                        f.contentFrame.height = v;
                        if (f.presentation == "layer") {
                            window.document.getElementById("r2-modal").style.height = v + "px"
                        }
                        i = v;
                        if (g != -1) {
                            var m = window.document.getElementById(h).offsetTop;
                            var n = window.document.getElementById(h).offsetLeft;
                            var l = m + g;
                            window.scrollTo(n, l)
                        }
                    }
                }
                var t = "scroll";
                if (f.clientUid) {
                    t = f.clientUid + "#" + t
                }
                if (w[0] == t) {
                    var m = window.document.getElementById(h).offsetTop;
                    var n = window.document.getElementById(h).offsetLeft;
                    var r = parseInt(w[1]);
                    var l = m + r;
                    g = r;
                    window.scrollTo(n, l)
                }
            };
            if (!window.addEventListener) {
                window.attachEvent("onmessage", e)
            } else {
                window.addEventListener("message", e, true)
            }
        };
        this.iframe = function (h) {
            var j = [];
            for (var g in h) {
                if (typeof(g) != "string") {
                    continue
                }
                var i = encodeURIComponent(g);
                var f = encodeURIComponent(h[g]);
                j.push(i + "=" + f)
            }
            var e = document.createElement("iframe");
            e.frameBorder = "0";
            e.width = this.width;
            if (window.postMessage) {
                e.height = 0;
                e.scrolling = "no"
            } else {
                e.height = 500;
                e.scrolling = "yes"
            }
            e.src = this.url + "#prefill?" + j.join("&");
            return e
        };
        this.banner = function (i) {
            var k = [];
            for (var h in i) {
                if (typeof(h) != "string") {
                    continue
                }
                var j = encodeURIComponent(h);
                var g = encodeURIComponent(i[h]);
                if (j == "title") {
                    k.push("salutation=" + g)
                } else {
                    if (j == "first_name") {
                        k.push("first_name=" + g)
                    } else {
                        if (j == "last_name") {
                            k.push("last_name=" + g)
                        } else {
                            if (j == "email") {
                                k.push("email=" + g)
                            } else {
                                if (j == "country") {
                                    k.push("country_code=" + g)
                                }
                            }
                        }
                    }
                }
            }
            k.push("campaign_id=" + this.campaign_id);
            var e = document.createElement("a");
            e.href = this.voucher_url + "?" + k.join("&");
            e.target = "_blank";
            var f = document.createElement("img");
            f.src = this.banner_url;
            f.style.border = "0";
            f.style.display = "block";
            f.style.margin = "0";
            f.style.width = "100%";
            f.style.maxWidth = "760px";
            f.style.height = "auto";
            e.appendChild(f);
            return e
        };
        this.addOnLoadEvent = function (e) {
            var f = window.onload;
            if (typeof window.onload != "function") {
                window.onload = e
            } else {
                window.onload = function () {
                    if (f) {
                        f()
                    }
                    e()
                }
            }
        };
        this.uid = function () {
            function e() {
                return Math.floor((1 + Math.random()) * 65536).toString(16).substring(1)
            }

            return e() + e() + e() + e() + e() + e() + e() + e()
        };
        this.isSafari = function () {
            return /^((?!chrome).)*safari/i.test(navigator.userAgent)
        }
    };
    d.init(c);
    if (d.isSafari()) {
        d.addOnLoadEvent(function () {
            window.scrollTo(0, 0)
        })
    }
})();