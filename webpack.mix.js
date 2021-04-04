const mix = require('laravel-mix');

mix.js('webroot/js/app.js', 'webroot/public/js')
	.setPublicPath('webroot/public')	
	.vue({ version: 3 })
        
        .css('webroot/css/normalize.min.css', 'webroot/public/css/app.css')   
        .css('webroot/css/milligram.min.css', 'webroot/public/css/app.css')   
        .css('webroot/css/cake.css', 'webroot/public/css/app.css')
        .postCss("webroot/css/app.css", "webroot/public/css", [
            require("tailwindcss"),
           ])
;

		
		
		