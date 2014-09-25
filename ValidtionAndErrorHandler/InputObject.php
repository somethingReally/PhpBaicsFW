<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InputObject
 *
 * @author David
 */
class InputObject {

    protected $inputComponet;
    protected $inputValue;
    
    protected $inputType;
    
    const CHECKBOX_TYPE = "checkbox";

    public function __construct($inputComponet, $inputValue) {
        $this->inputComponet = $inputComponet;
        $this->inputValue = $inputValue;
    }

    public function getInputComponet() {
        return $this->inputComponet;
    }

    public function getInputValue() {
        return $this->inputValue;
    }

    public static function createFromArray($inputComponet, $array) {
        if (isset($array[$inputComponet]) === true) {
            $inputValue = $array[$inputComponet];
        } else {
            $inputValue = NULL;
        }
        return new InputObject($inputComponet, $inputValue);
    }

    public function __toString() {
        return $this->inputComponet . " : " . $this->inputValue;
    }

}

abstract class InputType{
    const CHECKBOX_TYPE = "checkbox";
}

