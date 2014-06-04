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

        $attributes[] = static::processClasses($formElement);

        $result = '<'.implode(' ', $attributes).'>';

        if ($formElement->_get('closable')) {
            $result .= $formElement->_get('content');
            $result .='</'.$formElement->_get('tag').'>';
        }

        return $result;
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

        $attributePar = static::$simpleAttributes[$variable];

        $formAttribute = $formElement->_get($variable);
        if ($formAttribute==null) {
            return null;
        }

        if (is_string($attributePar)) {
            $attributeName = $attributePar;
            $value = $formAttribute;
        } else { // Else it should be array
            $attributeName = null;
            $value = null;
            $acceptable = null;

            $tags = array_keys($attributePar);

            foreach ($tags as $tag) {
                $isAny = $tag == '*';

                if ($tag != $formElement->_get('tag') || !$isAny) continue;

                if (isset($attributePar[$tag]['key']) && (!$isAny||$attributeName==null)) {
                    $attributeName = $attributePar[$tag]['key'];
                }
                if (isset($attributePar[$tag]['values']) && isset($attributePar[$tag]['values'][$value]) && (!$isAny||$value==null)) {
                    $value = $attributePar[$tag]['values'][$value];
                }
                if (isset($attributePar[$tag]['unacceptableValues']) && isset($attributePar[$tag]['unacceptableValues'][$value]) && (!$isAny||$acceptable=null)) {
                    $acceptable = $attributePar[$tag]['unacceptableValues'][$value];
                }
            }

            if ($attributeName==null)
                $attributeName = $attributeKey;

            if ($value==null)
                $value = $formElement->_get($variable);

            if (!$acceptable)
                return null;
        }

        $attribute = $attributeName.'='.static::quote().$value.static::quote();

        return $attribute;
    }

}