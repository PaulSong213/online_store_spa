<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 * @var \App\View\AppView $this
 */

$cakeDescription = 'Paul Shop';
?>
<!DOCTYPE html>
<html>
<head>
    <?= $this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>
        <?= $cakeDescription ?>:
        <?= $this->fetch('title') ?>
    </title>
	
    <?= $this->Html->meta(
        'main-logo-min.png',    
        '/img/logos/main-logo-min.png',
        ['type' => 'icon']
    ); ?>
<!--    <script type="text/javascript" src="http://livejs.com/live.js"></script>-->
    <script src="/public/js/app.js" type="module"></script>
    <link href="/public/css/app.css" rel="stylesheet">
    
   
    <link href="https://fonts.googleapis.com/css2?family=Nunito&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@5.4.0/dist/ionicons/ionicons.esm.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.js"></script>
    
    <?= $this->fetch('meta') ?>
    <?= $this->fetch('css') ?>
    <?= $this->fetch('script') ?>
	
    
</head>
<body>
    <nav class="mb-10 px-5 max-w-screen-2xl mx-auto"
         id="top-nav">
        <!--vue top navigation component will be mounted here-->
    </nav>
       
        <div class="container">
            <?= $this->Flash->render() ?>
            <div id="app">
                <!--vue component will be mounted here depends on the current link--> 
            </div>
            <?= $this->fetch('content') ?>
        </div>
    
    <footer>
    </footer>
</body>
</html>

<script>
	
    function remove_duplicates_es6(arr) {
            let s = new Set(arr);
            let it = s.values();
            return Array.from(it);
    }
    
    function setCookie(cname, cvalue, exdays) {
        var d = new Date();
        d.setTime(d.getTime() + (exdays*24*60*60*1000));
        var expires = "expires="+ d.toUTCString();
        document.cookie = cname + "=" + cvalue + ";" + expires + ";path=/";
    }
    
    function getCookie(cname) {
        var name = cname + "=";
        var decodedCookie = decodeURIComponent(document.cookie);
        var ca = decodedCookie.split(';');
        for(var i = 0; i <ca.length; i++) {
          var c = ca[i];
          while (c.charAt(0) == ' ') {
            c = c.substring(1);
          }
          if (c.indexOf(name) == 0) {
            return c.substring(name.length, c.length);
          }
        }
        return "";
    }
    
</script>	