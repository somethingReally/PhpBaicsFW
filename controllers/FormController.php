<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once 'GUI Objects\HTMLFormPanel.php';
require_once 'FormControllerInterface.php';
require_once 'ViewController.php';
require_once 'controllers\ErrorHandler.php';
require_once 'controllers\InputError.php';

/**
 * Description of Controller
 *
 * @author David
 */
abstract class FormController extends ViewController implements IFormController {

    private $validatorArray = [];
    private $errorHandler;
    protected $reportData;
    
    

    public function __construct($view) {
        parent::__construct($view);
        $this->errorHandler = new ErrorHandler();
    }

    public static function submitArray() {
        return $this->view;
    }

    public static function getErrorStrings($inputErrorArray) {
        $errorString = "";
        foreach ($inputErrorArray as $value) {
            $errorString .= $value->getErrorCode() . "<br />";
        }
        return $errorString;
    }

    /**
     * Checks the submit time agasint the pervious submit time.
     * Updates to pervious submit time.
     * 
     * 
     * @return type if valid true else false
     */
    public static function isNewSumbitTime() {
        $sumbitTime = isset(self::submitArray()[self::SUBMIT_TIME_NAME]) ?
                (self::submitArray()[self::SUBMIT_TIME_NAME]) : 0;
        $checkTime = isset($_SESSION[self::CHECK_TIME_NAME]) ?
                $_SESSION[self::CHECK_TIME_NAME] : 0;

        //reset the $checkTime var if something has gone worng
        if ($checkTime > $sumbitTime) {
            $checkTime = 0;
        }
        $isOkay = $sumbitTime > $checkTime;
        $_SESSION[self::CHECK_TIME_NAME] = $sumbitTime;
        return $isOkay;
    }

    public static function isValidSubmit($submitArray, $action) {
        return (isset($submitArray[self::ACTION_NAME]) &&
                $submitArray[self::ACTION_NAME] == $action &&
                static::isNewSumbitTime());
    }

    public function isSubmited(array $sumbittedArray, $action) {
        $isValidSubmit = self::isValidSubmit($sumbittedArray, $action);
        if ($isValidSubmit === false) {
            return false;
        }
        $errorHandler = new ErrorHandler($this->getValidatorArray());
        $isValid = $errorHandler->validateInputs();
        return ($isValid === false) ? true : $isValid;
    }

    public abstract function submitAction(array $submitArray);

    public function getValidatorArray() {
        return $this->validatorArray;
    }

    public function setValidatorArray($validatorArray) {
        $this->validatorArray = $validatorArray;
        return $this;
    }

    public function appenedValidatorArray($validatorArray) {
        $this->validatorArray = array_merge_recursive($this->validatorArray, $validatorArray);
        return $this->validatorArray;
    }

//put your code here
}
