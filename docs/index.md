SimpleForms
===========
Welcome to SimpleForms documentation.

SimpleForms is a package for Laravel4, allowing to create HTML forms by a very simple and readable code.

### Difference from Laravel4 forms

**Laravel4 Form class**:
```
Form::text('name',
           'maxim kurbatov',
           array(
               'class'=>'form-control auto-capitalize',
               'placeholder'=>'Enter your name',
               'data-popup'=>'Enter your real name, if you not wish to be banned.'
           )
);
```

**SimpleForms**:
```
Form::text('name')
            ->value('maxim kurbatov')
            ->addClasses('form-control', 'auto-capitalize')
            ->placeholder('Enter your name')
            ->setData('popup', 'Enter your real name, if you not wish to be banned.')
            ->make();
```

### Features

* Supports almost all HTML input types out from box:
    * Form control
        * [Form open/close](/components/#form)
        * [Button](/components/#button)
        * [Hidden](/components/#hidden)
        * [Label](/components/#label)
        * [Submit](/components/#submit)
        * [Reset](/components/#reset)
    * Alphanumeric information input
        * [Text](/components/#text)
        * [Email](/components/#email)
        * [Password](/components/#password)
        * [Date](/components/#date)
        * [DateTime](/components/#datetime)
        * [Number](/components/#number)
        * [Range](/components/#range)
        * [Search](/components/#search)
        * [Phone number](/components/#phone-number)
        * [Textarea](/components/#textarea)
        * [Time](/components/#time)
        * [Url](/components/#url)
        * [Month](/components/#month)
        * [Week](/components/#week)
    * Selectors
        * [Checkbox](/components/#checkbox)
        * [Radio](/components/#radio)
        * [Select](/components/#select)
        * [Multiple select](/components/#multiple-select)
* Has pleasant for perception code.
* Supports almost all [input attributes](/attributes/) and allows to use custom.
* It use old input values automatically (you should run ```Input::flash()``` in your controller)

<a href="/install/" class="btn btn-success btn-block btn-lg">Install to Laravel4!</a>