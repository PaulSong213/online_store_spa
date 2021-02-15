<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\View\Helper;

use Cake\View\Helper;

class BooleanHelper extends Helper
{
    public function isAvailable($intBoolean){
        $textBoolean = "Not Available";
        
        if($intBoolean == 1){
            $textBoolean = "Available";
        }
        return $textBoolean;
    }
}