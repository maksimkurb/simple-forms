<?php

namespace Maksimkurb\SimpleForms;

use Illuminate\Support\Facades\Config;

class FormRealizer {

    protected static $QUOTE;

    protected static $simpleAttributes = array(
        'name' => 'name',
        'id' => 'id',
        'type' => 'type',
        'style' => 'style',
        'accept' => 'accept',
        'accessKey' => 'accesskey',
        'align' => 'align',
        'alt' => 'alt',
        'autoComplete' => 'autocomplete',
        'autoFocus' => 'autofocus',
        'border' => 'border',
        'checked' => array(
            '*' => array(
                'key' => 'checked',
                'values' => array(
                    true => 'checked',
                ),
                'acceptableValues' => array(
                    false => false,
                )
            )
        ),
        'disabled' => array(
            '*' => array(
                'key' => 'disabled',
                'values' => array(
                    true => 'disabled',
                ),
                'acceptableValues' => array(
                    false => false,
                )
            )
        ),
        'for' => 'for',
        'form' => 'form',
        'formAcceptCharset' => array(
            'form' => array(
                'key' => 'accept-charset'
            )
        ),
        'formAction' => array(
            'form' => array(
                'key' => 'action'
            ),
            'input' => array(
                'key' => 'formaction'
            )
        ),
        'formEncType' => array(
            'form' => array(
                'key' => 'enctype'
            ),
            'input' => array(
                'key' => 'formenctype'
            )
        ),
        'formMethod' => array(
            'form' => array(
                'key' => 'method'
            ),
            'input' => array(
                'key' => 'formmethod'
            )
        ),
        'formNoValidate' => array(
            'form' => array(
                'key' => 'novalidate'
            ),
            'input' => array(
                'key' => 'formnovalidate'
            ),
            '*' => array(
                'values' => array(
                    true => 'novalidate',
                ),
                'acceptableValues' => array(
                    false => false
                )
            )
        ),
        'formTarget' => array(
            'form' => array(
                'key' => 'target'
            ),
            'input' => array(
                'key' => 'formtarget'
            )
        ),
        'list' => 'list',
        'max' => 'max',
        'maxLength' => 'maxlength',
        'min' => 'alt',
        'multiple' => array(
            '*' => array(
                'key' => 'multiple',
                'values' => array(
                    true => 'multiple',
                ),
                'acceptableValues' => array(
                    false => false
                )
            )
        ),
        'placeholder' => 'placeholder',
        'readOnly' => array(
            '*' => array(
                'key' => 'readonly',
                'values' => array(
                    true => 'readonly',
                ),
                'acceptableValues' => array(
                    false => false
                )
            )
        ),
        'required' => array(
            '*' => array(
                'key' => 'required',
                'values' => array(
                    true => 'required',
                ),
                'acceptableValues' => array(
                    false => false
                )
            )
        ),
        'src' => 'src',
        'step' => 'step',
        'tabIndex' => 'tabindex',
        'value' => 'value'
    );

    protected static function quote() {

        if ( null === static::$QUOTE )
            static::$QUOTE = Config::get('simple-forms::symbols.quote');
        return static::$QUOTE;
    }

    public static function realize($formElement) {
        if (!$formElement instanceof FormElement) return null;

        $attributes = array($formElement->_get('tag'));

        foreach (static::$simpleAttributes as $variable => $attribute) {
            $attribute = static::processSimpleAttribute($formElement, $variable, $attribute);
            if (!empty($attribute))
                $attributes[] = $attribute;
        }

        $classes = static::processClasses($formElement);
        if (isset($classes))
            $attributes[] = $classes;

        $customAttributes = static::processCustomAttributes($formElement);
        if (isset($customAttributes)) {
            foreach ($customAttributes as $attr) {
                $attributes[] = $customAttributes;
            }
        }

        $result = '<'.implode(' ', $attributes).'>';

        if ($formElement->_get('closable')) {

            if ($formElement->_get('tag')=='select') {
                $formElement->content(static::processOptionGroups($formElement));
            }

            $result .= $formElement->_get('content');
            $result .='</'.$formElement->_get('tag').'>';
        }

        return $result;
    }

    protected static function processOptionGroups($formElement) {
        if (!$formElement instanceof FormElement) return null;

        $groups = '';

        foreach ($formElement->_get('groups') as $group) {
            if (!$group instanceof OptionsGroup) continue;
            //$classesAttributes[] = $key.'='.static::quote().$value.static::quote();
            $options = '';
            foreach ($group->_get('options') as $option) {
                if ($option[2]==null&&$formElement->_get('value')==$option[0]) {
                    $option[2] = true;
                }
                $options .= '<option value='.static::quote().$option[0].static::quote().($option[2]?' selected='.static::quote().'selected'.static::quote():'').($option[3]?' disabled='.static::quote().'disabled'.static::quote():'').'>'.$option[1].'</option>';
            }
            if ($group->_get('caption')!=null) {
                $options = '<optgroup label='.static::quote().$group->_get('caption').static::quote().'>'.$options.'</optgroup>';
            }
            $groups .= $options;
        }

        if (strlen($groups)==0)
            return null;

        return $groups;
    }

    protected static function processCustomAttributes($formElement) {
        if (!$formElement instanceof FormElement) return null;

        $classesAttributes = array();

        foreach ($formElement->_get('attributes') as $key => $value) {
            $classesAttributes[] = $key.'='.static::quote().$value.static::quote();
        }

        if (count($classesAttributes)==0)
            return null;

        return $classesAttributes;
    }

    protected static function processClasses($formElement) {
        if (!$formElement instanceof FormElement) return null;

        $classesAttribute = null;

        $classesValue = implode(' ', $formElement->_get('classes'));

        if (strlen($classesValue)>0)
            $classesAttribute = 'class='.static::quote().$classesValue.static::quote();

        return $classesAttribute;
    }

    protected static function processSimpleAttribute($formElement, $variable, $attributeKey) {
        if (!$formElement instanceof FormElement) return null;

        $formAttribute = $formElement->_get($variable);
        if ($formAttribute==null) {
            return null;
        }

        if (is_string($attributeKey)) {
            $attributeName = $attributeKey;
            $value = $formAttribute;
        } else { // Else it should be array
            $attributeName = null;
            $value = null;
            $acceptable = null;
            foreach ($attributeKey as $tag => $parameters) {
                $isAny = $tag == '*';
                if (!($tag == $formElement->_get('tag') || $isAny)) continue;

                if (isset($parameters['key']) && (!$isAny||$attributeName==null)) {
                    $attributeName = $parameters['key'];
                }
                if (isset($parameters['values']) && isset($parameters['values'][$value]) && (!$isAny||$value==null)) {
                    $value = $parameters['values'][$value];
                }
                if (isset($parameters['unacceptableValues']) && isset($parameters['unacceptableValues'][$value]) && (!$isAny||$acceptable=null)) {
                    $acceptable = $parameters['unacceptableValues'][$value];
                }
            }

            if ($attributeName==null)
                $attributeName = $variable;

            if ($value==null)
                $value = $formElement->_get($variable);

            if ($acceptable==null)
                $acceptable = true;

            if ($acceptable==false)
                return null;
        }

        return $attributeName.'='.static::quote().$value.static::quote();
    }

}