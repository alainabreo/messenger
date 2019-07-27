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

mix.js('resources/js/app.js', 'public/js')
	.version()
	.disableNotifications();

//mix.js('resources/js/app.js', 'public/js').disableNotifications();
//.disableNotifications() Desabilita las notificaciones en la barra de escritorio

// mix.webpackConfig({
// 	module: {
// 		rules: [
// 			{
// 				test: /\.css$/,
// 				use: [
// 					'style-loader',
// 					'css-loader'
// 				]
// 			}
// 		]
// 	}	
// });