## Installing to Laravel4

Open terminal, go to project folder and run:
```
$ composer require maksimkurb/simple-forms:dev-master
```

Then open your app.php and add this rows:
```
    'providers' => array(
        ...
        'Maksimkurb\SimpleForms\SimpleFormsServiceProvider',
    ),
    ...
    'aliases' => array(
        ...
        //'Form' => 'Illuminate\Support\Facades\Form',
        'Form' => 'Maksimkurb\SimpleForms\FormFactory',
    //   ^^^^ Don't comment original Form row and use
    //        another alias here to provide compatibility with Laravel4 Form class
        ...
    ),
```

Basic setup is done!

## Configuration

At this moment, you can only change quotation mark and id prefix. Other options can appear later.

If you want to change configuration of SimpleForms, run this command in terminal:
```
$ php artisan config:publish maksimkurb/simple-forms
```

Config file should appear in `{SITE_ROOT}/app/config/packages/maksimkurb/simple-forms/config.php`


<a href="/components/" class="btn btn-success btn-block btn-lg">Explore components</a>