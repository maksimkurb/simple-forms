<?php

namespace Maksimkurb\SimpleForms;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\Input;

class FormFactory {

    public static function open($method='POST', $action=null) {
        $formElement = new FormElement();

        $formElement->closable(false);  // We should close it by hands later ( FormFactory::close() )
        $formElement->tag('form');

        $formElement->formMethod($method);
        $formElement->formAction($action);

        return $formElement;
    }

    public static function close() {
        return '</form>';
    }

    public static function text($name) {
        $formElement = new FormElement();

        $formElement->closable(false);
        $formElement->tag('input');

        $formElement->type('text');
        $formElement->name($name);
        $formElement->id($name);

        $formElement->value(Input::old($name));

        return $formElement;
    }

    public static function password($name) {
        return FormFactory::text($name)->type('password');
    }

    public static function email($name) {
        return FormFactory::text($name)->type('email');
    }

    public static function textarea($name, $content=null) {
        $formElement = new FormElement();

        $formElement->closable(true);
        $formElement->tag('textarea');

        $formElement->name($name);
        $formElement->id($name);
        $formElement->content($content!=null?$content:Input::old($name));

        return $formElement;
    }

    public static function label($id, $caption) {
        $formElement = new FormElement();

        $formElement->closable(true);
        $formElement->tag('label');

        $formElement->forInput($id);
        $formElement->content($caption);

        return $formElement;
    }

    public static function token() {
        return Form::token();
    }

}