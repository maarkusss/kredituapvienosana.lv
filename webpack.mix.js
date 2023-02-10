const mix = require("laravel-mix");

mix.js("resources/js/app.js", "public/js")
    .js("resources/js/cookiesNotification.js", "public/js")
    .js("resources/js/header.js", "public/js")
    .js("resources/js/checkAllPermissions.js", "public/js")
    .js("resources/js/scrollToTopButton.js", "public/js")
    .postCss("resources/css/app.css", "public/css", [require("tailwindcss")]);

if (!mix.inProduction()) {
    mix.browserSync({
        proxy: "localhost:8000",
        notify: false,
    });
}

mix.disableNotifications();
mix.version();
