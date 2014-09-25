<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of OtherReasonObject
 *
 * @author David
 */
class OtherReasonObject extends InputObject {

    //put your code here
    private $checkValue;

    public function __construct($inputComponet, $inputValue, $checkValue) {
        parent::__construct($inputComponet, $inputValue);
        $this->checkValue = $checkValue;
    }

    public function isNeeded() {
        if ($this->inputValue === $this->checkValue) {
            return true;
        }
        return false;
    }

    public static function createFromArray($inputComponet, $array, $checkValue) {
        $obj = parent::createFromArray($inputComponet, $array);
        return new OtherReasonObject($obj->getInputComponet(), $obj->getInputValue(), $checkValue);
    }

    public static function createFromInputObject(InputObject $inputComponet, $checkValue) {
        return new OtherReasonObject($inputComponet->getInputComponet(), $inputComponet->getInputValue(), $checkValue);
    }
}
