<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\View\Helper;

use Cake\View\Helper;

class FormatLinkHelper extends Helper
{
    public function rawUrl($unFormatedLink){
        
        $rawLink = null;
        $domNext = new \DOMDocument();
        $domNext->loadHTML($unFormatedLink);
        $tagsNext = $domNext->getElementsByTagName('a');
        foreach ($tagsNext as $tag){ $rawLink = $tag->getAttribute('href');}
        return $rawLink;
    }
}