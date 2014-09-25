<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ControllerController
 *
 * @author David
 */
class ControllerController {
    /*
     * Key view array on action elem
     * call controler methods
     * update other views
     */

    const NO_ACTION_REQUESTED = 0;
    const NO_RELEVALNT_ACTION_FOUND = 1;
    
    const CHECK_TIME_NAME = "checkTime";
    const SUBMIT_TIME_NAME = "submitTime";

    private $controllerArray;
    private $submitTime;

    public function __construct($controllerArray = []) {
        $this->controllerArray = Collection::getArrayOutOfCollection($controllerArray);
        $this->submitTime = new DateTime(NULL, new DateTimeZone("Europe/London"));
    }

    public function callRelevantFormController() {
        $requestArray = array_merge($_GET, $_POST);
        $returnValue = self::NO_ACTION_REQUESTED;
        if (isset($requestArray[IFormController::ACTION_NAME])) {
            $returnValue = self::NO_RELEVALNT_ACTION_FOUND;
            $action = $requestArray[IFormController::ACTION_NAME];
            if (isset($this->controllerArray[$action])) {
                $returnValue = true;
                static::callFormControllerFunctions($this->controllerArray[$action]);
            }
        }
        return $returnValue;
    }

    public function callRelevantViewControllers() {
        
    }

    private static function callFormControllerFunctions(IFormController $controller) {
        $controller->submitAction([]);
    }

}
