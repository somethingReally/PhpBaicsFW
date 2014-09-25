<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of InputController
 *
 * @author David
 */
class InputHandler extends InputObject {

    private $validateFunction;
    private $notSubmitString = false;
    private $extraParamters;
    private $otherReasonObject;

    public function __construct($inputComponet, $inputValue, $validateFunction, array $extraParamters = null) {
        parent::__construct($inputComponet, $inputValue);
        $this->validateFunction = $validateFunction;
        $this->extraParamters = $extraParamters;
    }

    public function getValidateFunction() {
        return $this->validateFunction;
    }

    public function getNotSubmitString() {
        return $this->notSubmitString;
    }

    public function setNotSubmitString($notSubmitString) {
        $this->notSubmitString = $notSubmitString;
        return $this;
    }

    public function getOtherReasonObject() {
        return $this->otherReasonObject;
    }

    public function setOtherReasonObject(OtherReasonObject $otherReasonObject) {
        $this->otherReasonObject = $otherReasonObject;
        return $this;
    }

    public function getExtraParamters() {
        return $this->extraParamters;
    }

    public function setExtraParamters($extraParamters) {
        $this->extraParamters = $extraParamters;
        return $this;
    }

    public function isValid() {
        if ($this->inputValue === Null) {
            return $this->notSubmitString;
        }
        $test = $this->validateFunction;
        if (!is_null($this->extraParamters)) {
            return call_user_func_array($test, array_merge([$this->inputValue], $this->extraParamters));
        }
        return $test($this->inputValue);
    }

    public function isNeeded() {
        if (isset($this->otherReasonObject) === false ||
                $this->otherReasonObject->isNeeded() === true) {
            return true;
        }
        return false;
    }

    public function isSubmit() {
        if ($this->inputValue !== Null) {
            return $this->inputValue;
        }
        return false;
    }

    public function __toString() {
        return parent::__toString() + " " + $this->validateFunction + " extraPara: " + $this->extraParamters + " otherReason: " + $this->otherReasonObject;
    }

    public static function createFromArray($inputComponet, $array, $validateFunction, array $extraParamters = null) {
        $obj = parent::createFromArray($inputComponet, $array);
        return new InputHandler($obj->inputComponet, $obj->inputValue, $validateFunction, $extraParamters);
    }

}
