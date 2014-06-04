<?php

namespace Maksimkurb\SimpleForms;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Form;
use Illuminate\Support\Facades\Input;

class FormFactory {

    /*
     * Form element
     * <form>
     */

    public static function open($method='POST', $action=null) {
        $formElement = new FormElement();

        //$formElement->closable(false);  // We should close it by hands later ( FormFactory::close() )
        $formElement->tag('form');

        $formElement->formMethod($method);
        $formElement->formAction($action);

        return $formElement;
    }
    public static function close() {
        return '</form>';
    }

    /*
     * Button input
     * <input type="button">
     */
    public static function button($name) {
        $formElement = new FormElement();

        $formElement->tag('input');

        $formElement->type('button');
        $formElement->name($name);
        $formElement->id($name);

        return $formElement;
    }

    /*
     * Checkbox input
     * <input type="checkbox">
     */
    public static function checkbox($name) {
        $formElement = new FormElement();

        $formElement->tag('input');

        $formElement->type('checkbox');
        $formElement->name($name);
        $formElement->id($name);

        $formElement->checked(Input::old($name));

        return $formElement;
    }

    /*
     * File input
     * <input type="file">
     */
    public static function fileUpload($name) {
        $formElement = new FormElement();

        $formElement->tag('input');

        $formElement->type('file');
        $formElement->name($name);
        $formElement->id($name);

        return $formElement;
    }

    /*
     * Hidden input
     * <input type="hidden">
     */
    public static function hidden($name) {
        $formElement = new FormElement();

        $formElement->tag('input');

        $formElement->type('hidden');
        $formElement->name($name);
        $formElement->id($name);

        return $formElement;
    }

    /*
     * Image submit
     * <input type="image">
     */
    public static function imageSubmit($name) {
        $formElement = new FormElement();

        $formElement->tag('input');

        $formElement->type('image');
        $formElement->name($name);
        $formElement->id($name);

        return $formElement;
    }

    /*
     * Password input
     * <input type="password">
     */
    public static function password($name) {
        $formElement = new FormElement();

        $formElement->closable(false);
        $formElement->tag('input');

        $formElement->type('password');
        $formElement->name($name);
        $formElement->id($name);

        $formElement->value(Input::old($name));

        return $formElement;
    }


    /*
     * Radio input
     * <input type="radio">
     */
    public static function radio($groupName, $value) {
        $formElement = new FormElement();

        $formElement->tag('input');

        $formElement->type('checkbox');
        $formElement->name($groupName);
        $formElement->id($groupName);

        $formElement->checked(Input::old($groupName)==$value);

        return $formElement;
    }

    /*
     * Reset button
     * <input type="reset"> (if asButton=true, <button type="reset">)
     */
    public static function resetButton($value=null, $asButton=false) {
        $formElement = new FormElement();

        if ($asButton) {
            $formElement->tag('button');
            $formElement->closable(true);

            $formElement->content($value);
            $formElement->type('reset');

            return $formElement;
        }

        $formElement->tag('input');

        $formElement->type('reset');
        $formElement->value($value);

        return $formElement;
    }

    /*
     * Submit button as input
     * <input type="submit"> (if asButton=true, <button type="submit">)
     */
    public static function submit($value=null, $asButton=false) {
        $formElement = new FormElement();

        if ($asButton) {
            $formElement->tag('button');
            $formElement->closable(true);

            $formElement->content($value);

            return $formElement;
        }

        $formElement->tag('input');

        $formElement->type('submit');
        $formElement->value($value);

        return $formElement;
    }

    /*
     * Text input
     * <input type="text">
     */
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

    /*
     * Color input [HTML5]
     * <input type="color">
     */
    public static function color($name) {
        $formElement = new FormElement();

        $formElement->closable(false);
        $formElement->tag('input');

        $formElement->type('color');
        $formElement->name($name);
        $formElement->id($name);

        $formElement->value(Input::old($name));

        return $formElement;
    }

    /*
     * Date input [HTML5]
     * <input type="date">
     */
    public static function datePicker($name) {
        $formElement = new FormElement();

        $formElement->closable(false);
        $formElement->tag('input');

        $formElement->type('date');
        $formElement->name($name);
        $formElement->id($name);

        $formElement->value(Input::old($name));

        return $formElement;
    }

    /*
     * DateTime input [HTML5]
     * <input type="datetime"> / <input type="datetime-local">
     */
    public static function dateTimePicker($name, $local=false) {
        $formElement = new FormElement();

        $formElement->closable(false);
        $formElement->tag('input');

        if ($local)
            $formElement->type('datetime-local');
        else
            $formElement->type('datetime');

        $formElement->name($name);
        $formElement->id($name);

        $formElement->value(Input::old($name));

        return $formElement;
    }

    /*
     * Email input [HTML5]
     * <input type="email">
     */
    public static function email($name) {
        $formElement = new FormElement();

        $formElement->closable(false);
        $formElement->tag('input');

        $formElement->type('email');
        $formElement->name($name);
        $formElement->id($name);

        $formElement->value(Input::old($name));

        return $formElement;
    }

    /*
     * Number input [HTML5]
     * <input type="number">
     */
    public static function number($name) {
        $formElement = new FormElement();

        $formElement->closable(false);
        $formElement->tag('input');

        $formElement->type('number');
        $formElement->name($name);
        $formElement->id($name);

        $formElement->value(Input::old($name));

        return $formElement;
    }

    /*
     * Range input [HTML5]
     * <input type="range">
     */
    public static function rangePicker($name) {
        $formElement = new FormElement();

        $formElement->closable(false);
        $formElement->tag('input');

        $formElement->type('range');
        $formElement->name($name);
        $formElement->id($name);

        $formElement->value(Input::old($name));

        return $formElement;
    }

    /*
     * Search input [HTML5]
     * <input type="search">
     */
    public static function search($name) {
        $formElement = new FormElement();

        $formElement->closable(false);
        $formElement->tag('input');

        $formElement->type('search');
        $formElement->name($name);
        $formElement->id($name);

        $formElement->value(Input::old($name));

        return $formElement;
    }

    /*
     * Telephone input [HTML5]
     * <input type="tel">
     */
    public static function tel($name) {
        $formElement = new FormElement();

        $formElement->closable(false);
        $formElement->tag('input');

        $formElement->type('tel');
        $formElement->name($name);
        $formElement->id($name);

        $formElement->value(Input::old($name));

        return $formElement;
    }

    /*
     * Time picker [HTML5]
     * <input type="time">
     */
    public static function timePicker($name) {
        $formElement = new FormElement();

        $formElement->closable(false);
        $formElement->tag('input');

        $formElement->type('time');
        $formElement->name($name);
        $formElement->id($name);

        $formElement->value(Input::old($name));

        return $formElement;
    }

    /*
     * Url input [HTML5]
     * <input type="url">
     */
    public static function url($name) {
        $formElement = new FormElement();

        $formElement->closable(false);
        $formElement->tag('input');

        $formElement->type('url');
        $formElement->name($name);
        $formElement->id($name);

        $formElement->value(Input::old($name));

        return $formElement;
    }

    /*
     * Month picker [HTML5]
     * <input type="month">
     */
    public static function month($name) {
        $formElement = new FormElement();

        $formElement->closable(false);
        $formElement->tag('input');

        $formElement->type('month');
        $formElement->name($name);
        $formElement->id($name);

        $formElement->value(Input::old($name));

        return $formElement;
    }

    /*
     * Week picker [HTML5]
     * <input type="week">
     */
    public static function week($name) {
        $formElement = new FormElement();

        $formElement->closable(false);
        $formElement->tag('input');

        $formElement->type('week');
        $formElement->name($name);
        $formElement->id($name);

        $formElement->value(Input::old($name));

        return $formElement;
    }

    /*
     * Textarea
     * <textarea></textarea>
     */
    public static function textarea($name) {
        $formElement = new FormElement();

        $formElement->closable(true);
        $formElement->tag('textarea');

        $formElement->name($name);
        $formElement->id($name);
        $formElement->content(Input::old($name));

        return $formElement;
    }

    /*
     * Label
     * <label for="...">...</label>
     */
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