<?php

return array(

    'prefixes' => array(

        /*
         * ------------
         * ID Prefix
         * ------------
         *
         * This prefix will be added to any form elements ID
         *
         * For example if id prefix is 'formEl_' and you run Form::text('username')->make() it will generate something like <input id="formEl_username" name="username" ...>
         *
         * ID Prefix is very recommended to keep site style in safety
         *
         */
        'id' => 'smplForm_',

    ),

    'symbols' => array(

        /*
         * ---------------
         * Quote symbol
         * ---------------
         *
         * This symbol is used to conclude in it attributes
         *
         * For example if:
         *    quote = "   then Form::text('username')->make() = <input name="username" id="smplForm_username">
         *    quote = '   then Form::text('username')->make() = <input name='username' id='smplForm_username'>
         */
        'quote' => '"'

    )





);