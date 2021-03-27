const mix = require('laravel-mix');

mix.js('webroot/js/app.js', 'webroot/public/js')
	.setPublicPath('webroot/public')	
	.vue({ version: 3 })
;		
		
		
		