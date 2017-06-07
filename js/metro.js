(function () {
    var a = {
        window_width: 0,
        window_height: 0,
        scroll_container_width: 0,
        app_preview: null,
        app_sidebar: null,
        apps: null,
        app_scroll_container: null,
        app_containers: null,
        app_open: !1,
        dragging_x: 0,
        left: 60,
        app_page_data: [],
        is_touch_device: !1,
        title_prefix: "MelonHTML5 - ",
        init: function () {
            a.is_touch_device = "ontouchstart" in document.documentElement ? !0 : !1;
            a.cacheElements();
            a.Events.onWindowResize();
            $(window).bind("resize", a.Events.onWindowResize);

            $(document.body).addClass("loaded");
            a.apps.each(function (a) {
                var b = $(this);
                setTimeout(function () {
                    b.removeClass("unloaded");
                    setTimeout(function () {
                        b.removeClass("animation")
                    }, 300)
                }, 100 * a)
            })
        },
        Events: {
            onWindowResize: function (b) {
                a.window_width = $(window).width();
                a.window_height = $(window).height()
            }
        },
        cacheElements: function () {
            a.apps = $("div.app");
            a.app_containers = $("div.app_container");
            a.app_scroll_container = $("#app_scroll_container");
            a.app_preview = $("#app_preview");
            a.app_sidebar = $("#app_sidebar");
            a.scroll_container_width = a.app_scroll_container.width()
        }
    };
    $(document).ready(a.init)
})();