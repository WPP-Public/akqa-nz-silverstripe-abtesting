# SilverStripe ABTesting

## Installation (with composer)

    $ composer require heyday/silverstripe-abtesting:~0.1

## Usage

```php
class Page_Controller extends ContentController
{
    public static $extensions = array(
        "ABTestingExtension('a','b')"
    );
}
```

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