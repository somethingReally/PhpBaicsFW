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
    protected $modelArray = [];
    private $hasBody;

    public function __construct($view) {
        $this->view = $view;
        $this->domView = new DOMDocument();
        $this->domView->loadHTML($this->view);
    }

    protected function convertCssClassIntoMethodCall($cssClasses) {
        $cssClasses = str_ireplace("-", "", $cssClasses);
        $cssClassArray = split(" ", $cssClasses);

        $returnArray = [];
        for ($i = count($this->modelArray) - 1; $i >= 0; $i--) {       
            $model = $this->modelArray[$i];
            $classMethods = get_class_methods(get_class($model));
            $classMethodsFilped = array_change_key_case(array_flip($classMethods));
            foreach ($cssClassArray as $cssKey => $cssClass) {
                $this->callMethod($model, $classMethods, $classMethodsFilped
                        , ["get" . $cssClass, $cssClass]
                        , $returnArray, $cssClassArray, $cssKey, $i);
            }
        }
        ksort($returnArray);
        return $returnArray;
    }

    private function callMethod(&$model, $classMethodsArray, $classMethodsFilpedArray
    , $keyArray, &$returnArray, &$cssClassArray, $cssKey, &$i) {
        foreach ($keyArray as $key) {
            if (isset($classMethodsFilpedArray[$key]) === false) {
                continue;
            }
            $returnedResult = $model->$classMethodsArray[$classMethodsFilpedArray[$key]]();
            if (is_object($returnedResult)) {
                $this->addModel($returnedResult);
                $i = count($this->modelArray) - 1;
            } else {
                $returnArray[$cssKey] = $returnedResult;
            }
            unset($cssClassArray[$cssKey]);
            break;
        }
    }

    private function convertCssClassIntoMethodCallUsingModelArray($cssClasses) {
        $returnArray = [];
        $cssClasses = str_ireplace("-", "", $cssClasses);
        $cssClasses = split(" ", $cssClasses);
        foreach ($this->modelArray as $model) {
            $returnArray[] = static::convertCssClassIntoMethodCall($cssClasses, $model);
        }
        return $returnArray;
    }

    protected function getElementsByClassName($classname) {
        $finder = new DomXPath($this->domView);
        return $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' $classname ')]");
    }

    private function getAllElementsWithClassName() {
        $finder = new DomXPath($this->domView);
        return $finder->query("//*[contains(concat(' ', normalize-space(@class), ' '), ' * ')]");
    }

    protected function getAttributesFromDomNode(DomNode $element) {
        if ($element->hasAttributes() === false) {
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
            $attributes = $this->getAttributesFromDomNode($currentNode);
            if (isset($attributes["class"])) {
                $methodReturn = $this->convertCssClassIntoMethodCall($attributes["class"]);
                $currentNode->appendChild(new DomText(implode(" ", $methodReturn)));
            }
            if ($currentNode->hasChildNodes()) {
                $this->trasvereNode($currentNode);
            }
        }
    }

    protected function addModel($model) {
        //array_unshift($this->modelArray, $model);
        $this->modelArray[] = $model;
    }

    public function getView() {

        return $this->view;
    }

    public abstract function updateView();
}
