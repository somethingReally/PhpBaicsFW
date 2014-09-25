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
interface IController {
    
    public function __construct($view);
    
    public function updateView();
    
    public function getView();
}
