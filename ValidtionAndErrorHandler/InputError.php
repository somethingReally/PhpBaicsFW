<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InputError
 *
 * @author David
 */
class InputError extends InputObject {

    private $errorCode;

    /**
     * 
     * @param type $inputComponet
     * @param type $inputValue
     * @param type $errorCode
     */
    public function __construct($inputComponet, $inputValue, $errorCode) {
        parent::__construct($inputComponet, $inputValue);
        $this->errorCode = $errorCode;
    }

    public function getErrorCode() {
        return $this->errorCode;
    }

    public static function convertToInputError(InputObject $obj, $errorCode) {
        return new InputError($obj->getInputComponet(), $obj->getInputValue(), $errorCode);
    }

    public static function createFromArray($inputComponet, $array, $errorCode) {
        $obj = parent::createFromArray($inputComponet, $array);
        return new InputError($obj->inputComponet, $obj->inputValue, $errorCode);
    }

    public static function createErrorString(array $inputErrorArray) {
        $errorStringArray = [];
        foreach ($inputErrorArray as $key => $value) {
            $errorStringArray[$key] = $value->getErrorCode();
        }
        return $errorStringArray;
    }

}
