![Grafite HTML](GrafiteHtml-banner.png)

**HTML** - A handy set of HTML generators for Laravel.

[![Build Status](https://github.com/GrafiteInc/Html/actions/workflows/php-package-tests.yml/badge.svg?branch=main)](https://github.com/GrafiteInc/Html/actions/workflows/php-package-tests.yml)
[![Maintainability](https://qlty.sh/badges/319c1648-63aa-47e0-b9b7-1b03c8b93f6d/maintainability.svg)](https://qlty.sh/gh/GrafiteInc/projects/Html)
[![Packagist](https://img.shields.io/packagist/dt/grafite/html.svg)](https://packagist.org/packages/grafite/html)
[![license](https://img.shields.io/github/license/mashape/apistatus.svg)](https://packagist.org/packages/grafite/html)

The HTML package lets you generate forms as well as fields with standard make commands. Inside your forms for models you can specify the fields that need to be generated and then simply pass the form to the view. No more writing html forms, error handling etc. It can handle Eloquent relationships and easily work with ajax requests for more dynamic form submissions.

##### Author(s):
* [Matt Lantz](https://github.com/mlantz) ([@mattylantz](http://twitter.com/mattylantz), mattlantz at gmail dot com)

## Requirements

1. PHP 7.3+|8.1+
2. OpenSSL

## Compatibility and Support

| Laravel Version | Package Tag | Supported |
|-----------------|-------------|-----------|
| ^7.x - ^12.x | 1.x | yes |

### Installation

Start a new Laravel project:
```php
composer create-project laravel/laravel your-project-name
```

Then run the following to add HTML
```php
composer require "grafite/html"
```

Time to publish those assets!
```php
php artisan vendor:publish --provider="Grafite\Html\HtmlProvider"
```

## Documentation

[https://docs.grafite.ca/utilities/html](https://docs.grafite.ca/utilities/html)

## License
HTML is open-sourced software licensed under the [MIT license](http://opensource.org/licenses/MIT)

### Bug Reporting and Feature Requests
Please add as many details as possible regarding submission of issues and feature requests

### Disclaimer
THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY, FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM, OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE SOFTWARE.
