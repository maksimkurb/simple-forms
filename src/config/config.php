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
         * For example if id prefix is 'formEl_' and you will run Form::text('username')->make() SimpleForms will generate something like <input id="formEl_username" name="username" ...>
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

    /*
     * Please, sorry me for my bad English,
     * if you have questions, you can ask them to my email: maksimkurb@gmail.com or research package source code ;)
     *
     * Maxim Kurbatov
     */
);