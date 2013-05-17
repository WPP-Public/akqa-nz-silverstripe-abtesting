# SilverStripe ABTesting

## Installation (with composer)

    $ composer require heyday/silverstripe-abtesting:~0.1

## Usage

Add the following to your root level Page SilverStripe template

```html
<% if ABTestScript %>
	$ABTestScript
<% end_if %>
```

Decorate the object/page you wish to test with the ABTestingExtension

```php
class Page_Controller extends ContentController
{
    public static $extensions = array(
        "ABTestingExtension('a','b')"
    );
}
```

Set up the variations for the test

For SilverStripe 2.4

```html
<% if getABTesting(st_b) %>
// State for b
<% else %>
// State for default
<% end_if %>
```

For SilverStripe 3

```html
<% if getABTesting(st,b) %>
// State for b
<% else %>
// State for default
<% end_if %>
```

Where `st` is a GET variable like `/?st=b`

## Unit testing
    $ composer install --dev
    $ vendor/bin/phpunit