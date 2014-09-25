<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

/**
 * Description of Collection
 *
 * @author David
 */

class Collection implements ICollection {

    protected $collection;
    protected $class;
    protected $keyFunction;

    public function __construct($class, $keyFunction, $collection = []) {
        $tempArray = static::getArrayOrThrowEx($collection);
        static::getElemsOfArrayOfTypeClass($tempArray, $class);
        $this->keyFunction = $keyFunction;
        $this->class = $class;
        $this->collection = $tempArray;
    }

    public static function getArrayOrThrowEx($array) {
        $array = static::getArrayOutOfCollection($array);
        if ($array === false) {
            throw new InvalidArgumentException("Var is not a array or collection");
        }
        return $array;
    }

    public static function getArrayOutOfCollection($array) {
        if ($array instanceof ICollection) {
            return $array->getCollection();
        } else {
            return is_array($array) ? $array : false;
        }
    }

    protected static function getElemsOfArrayOfTypeClass($array, $class) {
        $newArray = [];
        foreach ($array as $key => $value) {
            if ($value instanceof $class) {
                $newArray[$key] = $value;
            }
        }
        return $newArray;
    }

    protected static function checkArrayIsOfTypeClass($array, $class) {
        foreach ($array as $key => $value) {
            if ($value instanceof $class === false) {
                throw new InvalidArgumentException("Elem class is " . get_class($value) . " should be " . $class . ". Key: " . $key);
            }
        }
    }

    private function checkAndGetFunction($param) {
        
    }

    public function getCollection() {
        return $this->collection;
    }

    public function getKeyFunction() {
        return $this->keyFunction;
    }

    public function getClass() {
        return $this->class;
    }

    public function rekeyCollection() {
        $function = $this->keyFunction;
        $keys = [];
        foreach ($this->collection as $value) {
            $keys[] = $value->$function();
        }
        $this->collection = array_combine($keys, $this->collection);
        return $this;
    }

    public function add($object) {
        if ($object instanceof $this->class) {
            $function = $this->keyFunction;
            $this->collection[$object->$function()] = $object;
            return true;
        }
        return false;
    }

    public function addCollection($collection) {
        $tempArray = static::getArrayOrThrowEx($collection);
        $tempArray = static::getElemsOfArrayOfTypeClass($tempArray, $this->class);
        $this->collection = array_merge($this->collection, $tempArray);
    }

    public function removeByKey($key) {
        $temp = isset($this->collection[$key]) ? $this->collection[$key] : false;
        if ($temp !== false) {
            unset($this->collection[$key]);
        }
        return $temp;
    }

    public function getByKey($key) {
        return isset($this->collection[$key]) ? $this->collection[$key] : false;
    }

    public function removeByObject($object) {
        $function = $this->keyFunction;
        return $this->removeByKey($object->$function());
    }

    public function getByObject($object) {
        $function = $this->keyFunction;
        return $this->getByKey($object->$function());
    }

    public function size() {
        return count($this->collection);
    }

    public function clear() {
        return array_slice($this->collection, 0);
    }

}
