<?php

class Person
{

    private $_name;

    private $_age;
    
    private $writer;
    
    function __construct(PersonWriter $writer)
    {
        $this->writer = $writer;
    }
    
    function __call($methodname,$args) {
        if(method_exists($this->writer, $methodname)) {
            return $this->writer->$methodname($this);
        }
    }

    function __get ($property)
    {
        $method = "get{$property}";
        
        if (method_exists($this, $method)) {
            return $this->$method();
        }
    }

    function __isset ($property)
    {
        $method = "get{$property}";
        
        return (method_exists($this, $method));
    }

    function __set ($property, $value)
    {
        $method = "set{$property}";
        
        if (method_exists($this, $method)) {
            return $this->$method($value);
        }
    }
    
    function __unset($property)
    {
        $method = "set{$property}";
        
        if(method_exists($this, $method)) {
            $this->$method(null);
        }
    }

    function setName ($name)
    {
        $this->_name = $name;
        
        if (! is_null($name)) {
            $this->_name = strtoupper($this->_name);
        }
    }

    function setAge ($age)
    {
        $this->_age = strtoupper($age);
    }

    function getName ()
    {
        return $this->_name;
    }

    function getAge ()
    {
        return 28;
    }
    
    function __toString() {
        $desc = $this->getName();
        $desc .= "(age".$this->getAge().")";
        return $desc;
    }
}

?>