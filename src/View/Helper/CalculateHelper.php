<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace App\View\Helper;

use Cake\View\Helper;

class CalculateHelper extends Helper
{
    public function discountedPrice($basePrice,$percentage){
        
        
        $percentageInDecimal = $percentage / 100;
        
        $discountPriceToSubstract = $basePrice * $percentageInDecimal;
        
        $discountedBasePrice = $basePrice - $discountPriceToSubstract;
        
        return $discountedBasePrice;
    }
}