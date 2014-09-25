<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ErrorHandler
 *
 * @author David
 */

class ErrorHandler {

    private $inputHandelerArray;
    private $validatedCollection;
    private $errorCollection;

    public function __construct($inputHandelerArray) {
        $this->inputHandelerArray = Collection::getArrayOrThrowEx($inputHandelerArray);
        $this->validatedCollection = new Collection(InputHandler::class,'getInputComponet');
        $this->errorCollection = new Collection(InputError::class,'getInputComponet');
    }

    public function validateInputs() {
        $this->validatedCollection->clear();
        $this->errorCollection->clear();
        foreach ($this->inputHandelerArray as $value) {
            if ($value->isNeeded() === false) {
                continue;
            }
            $isValid = $value->isValid();

            if ($isValid != "" && $isValid != NULL && $isValid !== true) {
                $this->errorCollection->add(new InputError($value->getInputComponet(), $value->getInputValue(), $isValid));
            } else if ($isValid === false) {
                $this->errorCollection->add(new InputError($value->getInputComponet(), $value->getInputValue(), $isValid));
            } else {
                $this->validatedCollection->add($value);
            }
        }
        return $this->getResults();
    }

    private function createInputError() {
        
    }

    private function createInputValid() {
        
    }

    private function getRidOfOther($key) {
        unset($this->submitArray[$key]);
        unset($this->inputHandelerArray[$key]);
    }

    public function getInputHandlerArray() {
        return $this->inputHandelerArray;
    }

    public function getResults() {
        if ($this->errorCollection->size() === 0) {
            return $this->validatedCollection;
        }
        return $this->errorCollection;
    }

    public function getValidatedCollection() {
        return $this->validatedCollection;
    }

    public function getErrorCollection() {
        return $this->errorCollection;
    }

}
