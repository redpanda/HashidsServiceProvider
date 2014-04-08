# Hashids Silex ServiceProvider

[![Build Status](https://travis-ci.org/redpanda/HashidsSilexServiceProvider.png)](https://travis-ci.org/redpanda/HashidsSilexServiceProvider)

## Usage

```php
use Redpanda\Silex\Provider\HashidsServiceProvider;
use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

$app = new Application();

$app->register(new HashidsServiceProvider(), array(
    'post' => array(
        'salt' => 'mySalt',
        'min_hash_length' => 5,
        'alphabet' => ''
    )
));

// encrypt
$hash = $app['hashids']['post']->encrypt(1,2,3);

// decrypt
$numbers = $app['hashids']['post']->decrypt($hash);
```

##License

MIT License
