const Dotenv = require('dotenv-webpack');
const mix = require('laravel-mix');

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

if (mix.inProduction()) {
  mix.version();
  mix.disableNotifications();
  mix.webpackConfig({
    devtool: false,
  });
} else {
  mix.sourceMaps();
  mix.webpackConfig({
    devtool: 'cheap-source-map',
  });
}

mix.js('resources/js/app.js', 'public/js');

mix.copyDirectory('resources/js/assests/', 'public/');

mix.scripts([
  'resources/js/modules/global.js',
  'resources/js/modules/method.js'
], 'public/js/all.js');

mix.extract();

mix.webpackConfig({
  resolve: {
    alias: {
      '~': path.join(__dirname, './resources/js'),
      '@': path.join(__dirname, './resources/js/components')
    }
  },
  plugins: [
    new Dotenv({
      silent: true
    }),
    // new BundleAnalyzerPlugin({
    //   openAnalyzer: false,
    // }),
  ],
});