<?php

namespace Maksimkurb\SimpleForms;

class OptionsGroup {

    public $caption;
    public $name;
    public $options = array();

    public function __construct($caption, $name) {
        $this->caption = $caption;
        $this->name = $name;
    }

    public function add($value, $caption, $checked=null, $disabled=null) {
        $this->options[] = array($value, $caption, $checked, $disabled);

        return $this;
    }

    public function addMany($options) {
        foreach ($options as $option) {
            $this->options[] = $option;
        }

        return $this;
    }

    public function _get($variable) {
        return $this->$variable;
    }

}