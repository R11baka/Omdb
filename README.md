# omdb
PHP library for retrieving film and TV information from omdb

## Quick Start

###
```php
$obdb = new Omdb($apiKey)->title("wdwqd")->search();
$obdb = new Omdb($apiKey)->title("wdwqd")->year(1223)->search();
$obdb = new Omdb($apiKey)->search(["title"=>'wedewd']);
$obdb = new Omdb($apiKey)->search('wedewd');
$obdb = new Omdb($apiKey)->imdb("wdwqd")->search();
```

