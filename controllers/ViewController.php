<?php
//require_once 'C:\xampp\htdocs\PhpBaicsFW\controllers\IController.php';
/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of ViewController
 *
 * @author David
 */
abstract class ViewController implements IController {
    protected $view;
    protected $domView;
    private $hasBody;


    public function __construct($view) {
        $this->view = $view;
        $this->domView = new DOMDocument();
        $this->domView->loadHTML($this->view);
    }
    
    protected function getElementsByClassName($classname) {
        $finder = new DomXPath($this->domView);
        return $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
    }

    public function getView() {
        return $this->view;
    }
    
    public abstract function updateView();
}
