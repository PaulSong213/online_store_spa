<?php

/* 
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
namespace App\View\Helper;

use Cake\View\Helper;

class GenderHelper extends Helper
{
    
    public $helpers = ['Form'];
    
    public function formatToText($genderIntValue)
    {
        $genderTextFormat = "";
        switch ($genderIntValue) {
            case 0:
                $genderTextFormat = 'Male';
                break;
            
            case 1:
                $genderTextFormat = 'Female';
                break;
            
            default:
                $genderTextFormat = 'Gender has Invalid Value. Please change '
                    . 'it in database. Valid Values are 0 and 1';
                break;
        }
        return $genderTextFormat;
    }
    
    public function genderSelect($inputName){
        $selector = $this->Form->control($inputName,[
                        'type' => 'select',
                        'options' => array("Male", "Female")
                    ]);
        return $selector;
    }
    
}
