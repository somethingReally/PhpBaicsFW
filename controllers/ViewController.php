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
    protected $model;
    private $hasBody;

    public function __construct($view) {
        $this->view = $view;
        $this->domView = new DOMDocument();
        $this->domView->loadHTML($this->view);
    }

    protected function convertCssClassIntoMethodCall($cssClass) {
        $classMethods = get_class_methods(get_class($this->model));
        $cssClass = str_ireplace("-", "", $cssClass);
        foreach ($classMethods as $methodName) {
            $checkedMethodName = preg_replace("%^get%", "", $methodName, 1);
            if (strtolower($checkedMethodName) === strtolower($cssClass)) {
                return $this->model->$methodName();
            }
        }
    }

    protected function getElementsByClassName($classname) {
        $finder = new DomXPath($this->domView);
        return $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
    }

    private function getAllElementsWithClassName() {
        $finder = new DomXPath($this->domView);
        return $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' * ')]");
    }

    protected function getClassNameFormDomNode(DomNode $element) {
        if ($element->attributes === null) {
            return;
        }
        $attributes = [];

        foreach ($element->attributes as $attribute_name => $attribute_node) {
            /** @var  DOMNode    $attribute_node */
            $attributes[$attribute_name] = $attribute_node->nodeValue;
        }
        return $attributes;
    }

    protected function transeversAllNodes() {
        $this->trasvereNode($this->domView);
    }

    private function trasvereNode(DomNode $domNode) {
        $nodes = $domNode->childNodes;
        for ($i = 0; $i < $nodes->length; $i++) {
            $currentNode = $nodes->item($i);
            $attributes = $this->getClassNameFormDomNode($currentNode);
            if (isset($attributes["class"])) {
                $currentNode->appendChild(new DomText($this->convertCssClassIntoMethodCall($attributes["class"])));
            }
            //var_dump($attributes);
            //var_dump($currentNode->hasChildNodes());
            if ($currentNode->hasChildNodes() ) {
                $this->trasvereNode($currentNode);
            }
        }
    }

    public function getView() {

        return $this->view;
    }

    public abstract function updateView();
}
