<?php

namespace Maksimkurb\SimpleForms;

use Illuminate\Support\Facades\Config;

class FormElement {

    protected $tag = null;              // Tag name
    protected $closable = false;        // Is tag closable? For example <select></select> - yes, but <input ...> - not
    protected $classes = array();       // Tag classes
    protected $name = null;             // Input name
    protected $id = null;               // Tag ID
    protected $type = null;             // Input type
    protected $data = array();          // data-* attributes
    protected $groups = array();       // For <select> (combobox) tag (or similar)

    protected $style = null;

    protected $accept = null;           // File accept attribute
    protected $accessKey = null;        // Hotkey to select input
    protected $align = null;            // Image align
    protected $alt = null;              // Alternative text for image
    protected $autoComplete = null;     // Auto completion
    protected $autoFocus = null;        // Auto focusing to input
    protected $border = null;           // Set borders for image
    protected $checked = null;          // Is checkbox checked? / option tag checked number
    protected $content = null;          // Content of tag (only if $closable = true)
    protected $disabled = null;         // Is disabled
    protected $for = null;              // Id of input (for labels)
    protected $form = null;             // Form id attr (if tag not in form)
    protected $formAcceptCharset = null;// Charset of form values
    protected $formAction = null;       // Action of form
    protected $formEncType = null;      // Form encoding type
    protected $formMethod = null;       // Form method
    protected $formNoValidate = null;   // No validate form?
    protected $formTarget = null;       // Form target
    protected $list = null;             // List id
    protected $max = null;              // Max value
    protected $maxLength = null;        // Max length of string
    protected $min = null;              // Min length
    protected $multiple = null;         // Allow to upload multiple files?
    protected $placeholder = null;      // Input placeholder
    protected $readOnly = null;         // Is input read-only?
    protected $required = null;         // Is input required?
    protected $size = null;             // Input width in letters
    protected $src = null;              // Source url
    protected $step = null;             // Step by ..
    protected $tabIndex = null;         // Tab index
    protected $value = null;            // Value

    protected $attributes = array();


    public function tag($tag) {
        $this->tag = $tag;
        return $this;
    }

    public function closable($closable) {
        $this->closable = $closable;
        return $this;
    }

    public function addClass($className) {
        if (in_array($className, $this->classes)) return $this;
        $this->classes[] = $className;
        return $this;
    }

    public function addClasses() {
        foreach (func_get_args() as $className) {
            $this->addClass($className);
        }
        return $this;
    }

    public function removeClass($classNameToRemove) {
        foreach ($this->classes as $id=>$className) {
            if ($className == $classNameToRemove) {
                unset($this->classes[$id]);
                break;
            }
        }
        return $this;
    }

    public function removeClasses($classes) {
        foreach ($classes as $className) {
            $this->removeClass($className);
        }
        return $this;
    }

    public function id($id) {
        if (is_null($id))
            return $this;
        $this->id = Config::get('simple-forms::prefixes.id').$id;
        return $this;
    }

    public function name($name) {
        $this->name = $name;
        return $this;
    }

    public function type($type) {
        $this->type = $type;
        return $this;
    }

    public function setData($key, $value) {
        $this->data[$key] = $value;
        return $this;
    }

    public function removeData($key) {
        foreach ($this->data as $id => $value) {
            if ($id == $key) {
                unset($this->data[$key]);
                break;
            }
        }
        return $this;
    }

    public function addGroup($group) {
        $this->groups[] = $group;
        return $this;
    }

    public function removeGroup($name) {
        foreach ($this->groups as $id => $group) {
            if ($group->_get('name') == $name) {
                unset($this->groups[$id]);
                break;
            }
        }
        return $this;
    }

    public function style($style) {
        $this->style = $style;
        return $this;
    }

    public function accept($accept) {
        $this->accept = $accept;
        return $this;
    }

    public function accessKey($accessKey) {
        $this->accessKey = $accessKey;
        return $this;
    }

    public function align($align) {
        $this->align = $align;
        return $this;
    }

    public function alt($alt) {
        $this->alt = $alt;
        return $this;
    }

    public function autoComplete($autoComplete) {
        $this->autoComplete = $autoComplete;
        return $this;
    }

    public function autoFocus($autoFocus) {
        $this->autoFocus = $autoFocus;
        return $this;
    }

    public function border($border) {
        $this->border = $border;
        return $this;
    }

    public function checked($checked) {
        $this->checked = $checked;
        return $this;
    }

    public function content($content) {
        $this->content = $content;
        return $this;
    }

    public function disabled($disabled) {
        $this->disabled = $disabled;
        return $this;
    }

    public function forInput($inputId) {
        if (is_null($inputId))
            return $this;
        $this->for = Config::get('simple-forms::prefixes.id').$inputId;
        return $this;
    }

    public function form($form) {
        $this->form = $form;
        return $this;
    }

    public function formAcceptCharset($formAcceptCharset) {
        $this->formAcceptCharset = $formAcceptCharset;
        return $this;
    }

    public function formAction($formAction) {
        $this->formAction = $formAction;
        return $this;
    }

    public function formEncType($formEncType) {
        $this->formEncType = $formEncType;
        return $this;
    }

    public function formMethod($formMethod) {
        $this->formMethod = $formMethod;
        return $this;
    }

    public function formNoValidate($formNoValidate) {
        $this->formNoValidate = $formNoValidate;
        return $this;
    }

    public function formTarget($formTarget) {
        $this->formTarget = $formTarget;
        return $this;
    }

    public function listId($list) {
        $this->list = $list;
        return $this;
    }

    public function maxValue($max) {
        $this->max = $max;
        return $this;
    }

    public function maxLength($maxLength) {
        $this->maxLength = $maxLength;
        return $this;
    }

    public function minValue($min) {
        $this->min = $min;
        return $this;
    }

    public function multiple($multiple) {
        $this->multiple = $multiple;
        return $this;
    }

    public function placeholder($placeholder) {
        $this->placeholder = $placeholder;
        return $this;
    }

    public function readOnly($readOnly) {
        $this->readOnly = $readOnly;
        return $this;
    }

    public function required($required) {
        $this->required = $required;
        return $this;
    }

    public function size($size) {
        $this->size = $size;
        return $this;
    }

    public function src($src) {
        $this->src = $src;
        return $this;
    }

    public function step($step) {
        $this->step = $step;
        return $this;
    }

    public function tabIndex($tabIndex) {
        $this->tabIndex = $tabIndex;
        return $this;
    }

    public function value($value) {
        $this->value = $value;
        return $this;
    }

    public function setAttribute($key, $value) {
        $this->attributes[$key] = $value;
        return $this;
    }

    public function removeAttribute($key) {
        foreach ($this->attributes as $id => $value) {
            if ($id == $key) {
                unset($this->attributes[$key]);
                break;
            }
        }
        return $this;
    }

    /*********/

    public function make() {
        return FormRealizer::realize($this);
    }

    public function _get($variable) {
        return $this->$variable;
    }

}