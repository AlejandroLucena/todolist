const mix = require("laravel-mix");

require("laravel-mix-tailwind");

/*
 |--------------------------------------------------------------------------
 | Mix Asset Management
 |--------------------------------------------------------------------------
 |
 | Mix provides a clean, fluent API for defining some Webpack build steps
 | for your Laravel application. By default, we are compiling the Sass
 | file for the application as well as bundling up all the JS files.
 |
 */

mix.copyDirectory("resources/libs", "public/libs");

mix
  .copy(
    "node_modules/@fortawesome/fontawesome-free/js/all.js",
    "public/js/fontawesome.js"
  )
  .copy(
    "node_modules/sweetalert2/dist/sweetalert2.all.min.js",
    "public/js/sweetalert2.all.min.js"
  )
  .copy(
    "node_modules/sweetalert2/dist/sweetalert2.min.css",
    "public/css/sweetalert2.min.css"
  );

mix
  .js("resources/js/app.js", "public/js/app.js")
  .js("resources/js/tools.js", "public/js/tools.js")
  .postCss("resources/css/app.css", "public/css", [
    require("postcss-import"),
    require("tailwindcss"),
    require("autoprefixer"),
  ])
  .tailwind("./tailwind.config.js")
  .sourceMaps();

if (mix.inProduction()) {
  mix.version();
}
