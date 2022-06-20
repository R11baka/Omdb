# Omdb PHP wrapper

## Introduction

Simple and lightweigth PHP library for using [OMDb](http://www.omdbapi.com/)

## How to install

```bash
composer require r11baka/omdb
```

## Quickstart

1. Simple search

```php
require 'vendor/autoload.php';
use Omdb\Omdb;

$omdb = new Omdb($API_KEY);
$response = $omdb->search("The Matrix");
var_dump($response);

var_dump($response[0]->getImdbId());
var_dump($response[0]->getTitle());
var_dump($response[0]->getType());
```

returns array with search result object

```php
array(1) {
  [0] =>
  class Omdb\Api\Response\SearchResult#8 (5) {
    private string $title =>
    string(10) "The Matrix"
    private int $year =>
    int(1999)
    private string $imdbId =>
    string(9) "tt0133093"
    private string $type =>
    string(5) "movie"
    private string $poster =>
    string(138) "https://m.media-amazon.com/images/M/MV5BNzQzOTk3OTAtNDQ0Zi00ZTVkLWI0MTEtMDllZjNkYzNjNTc4L2ltYWdlXkEyXkFqcGdeQXVyNjU0OTQ0OTY@._V1_SX300.jpg"
  }
}
```

2. Search with limit

```php
require 'vendor/autoload.php';
use Omdb\Omdb;

$omdb = new Omdb($API_KEY);
$response = $omdb->search(['title' => 'Matrix','take' => 20]);
var_dump($response);
```

Returns array with 20 items

3. Search by title

```injectablephp
require 'vendor/autoload.php';
use Omdb\Omdb;

$omdb = new Omdb($API_KEY);
$result = $omdb->title("The Matrix")->search();

// etc
echo $result->getTitle();
echo $result->getImdbID();
```

returns movie object or ApiException with message  `Movie not found`
or you can add year

```injectablephp
require 'vendor/autoload.php';
use Omdb\Omdb;

$omdb = new Omdb($API_KEY);
$result = $omdb->title("The Matrix")->year(1999)->search();
```

4. Also you can fetch info by imdbId

```injectablephp
require 'vendor/autoload.php';
use Omdb\Omdb;

$omdb = new Omdb($API_KEY);
$result = $omdb->imdb('tt0133093')->search();
```
