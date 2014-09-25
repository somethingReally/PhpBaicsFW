<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of CollectionInterface
 *
 * @author David
 */
interface ICollection {

    public function __construct($class, $keyFunction, $collection = []);

    public function getCollection();

    public function getClass();
    
    public function getKeyFunction();

    public function rekeyCollection();
    
    public function add($obj);

    public function addCollection($collection);

    public function removeByKey($key);

    public function getByKey($key);
    
    public function removeByObject($object);
    
    public function getByObject($object);

    public function size();

    public function clear();
}
