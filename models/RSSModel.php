<?php
namespace php_rss\models;

class RSSModel{
    public function __construct(array $variables=[]){
        foreach($variables as $name => $value){
            if(property_exists($this,$name))
                $this->{$name} = $value;
        }
    }
}