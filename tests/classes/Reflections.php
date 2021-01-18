<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace vaniacarta74\Crud\tests\classes;

/**
 * Description of Reflections
 *
 * @author Vania
 */
class Reflections
{
    /**
     * @group reflections
     * @coversNothing
     */
    public static function invokeConstructor(&$object, $args = [])
    {
        $class = new \ReflectionClass($object);
        
        $constructor = $class->getConstructor();
        
        $constructor->invokeArgs($object, $args);
    }
    
    /**
     * @group reflections
     * @coversNothing
     */
    public static function invokeMethod(&$object, $methodName, $args = [])
    {
        $class = new \ReflectionClass($object);
        
        $method = $class->getMethod($methodName);
        $method->setAccessible(true);
        
        return $method->invokeArgs($object, $args);
    }
    
    /**
     * @group reflections
     * @coversNothing
     */
    public static function getProperty(&$object, $propertyName)
    {
        $class = new \ReflectionClass($object);
        
        $property = $class->getProperty($propertyName);
        $property->setAccessible(true);
        
        return $property->getValue($object);
    }
    
    /**
     * @group reflections
     * @coversNothing
     */
    public static function setProperty(&$object, $propertyName, $value)
    {
        $class = new \ReflectionClass($object);
        
        $property = $class->getProperty($propertyName);
        $property->setAccessible(true);
        
        return $property->setValue($object, $value);
    }
    
    /**
     * @group reflections
     * @coversNothing
     */
    public static function getStaticProperty($className, $propertyName)
    {
        $property = new \ReflectionProperty($className, $propertyName);
        $property->setAccessible(true);
        
        return $property->getValue(null);
    }
    
    /**
     * @group reflections
     * @coversNothing
     */
    public static function setStaticProperty($className, $propertyName, $value)
    {
        $property = new \ReflectionProperty($className, $propertyName);
        $property->setAccessible(true);
        
        return $property->setValue(null, $value);
    }
}
