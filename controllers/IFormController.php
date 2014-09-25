<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 *
 * @author David
 */
interface IFormController {

    const ACTION_NAME = "action";
    const CHECK_TIME_NAME = "checkTime";
    const SUBMIT_TIME_NAME = "submitTime";

    public function getAction();
    
    public function panelsToUpdate();

    public function isSubmited(array $submitArray, $action);

    public function submitAction(array $submitArray);

    public static function isNewSumbitTime();

    public static function isValidSubmit($submitArray, $action);
}
