<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of autoLoader
 *
 * @author David
 */
function addToSetIncludePath() {
    set_include_path(realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "BaiscCollection" . PATH_SEPARATOR . get_include_path());
    set_include_path(realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "GUI Objects" . PATH_SEPARATOR . get_include_path());
    set_include_path(realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "controllers" . PATH_SEPARATOR . get_include_path());
    set_include_path(realpath(dirname(__FILE__)) . DIRECTORY_SEPARATOR . "ValidtionAndErrorHandler" . PATH_SEPARATOR . get_include_path());
}
