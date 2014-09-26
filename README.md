ToucaNine
=========

A very simple, yet flexible, PHP5 HMVC-alike micro framework.

### Components
ToucaNine framework comes packed with Nette HTTP Component, Illuminate Database, and HTML Purifier.

### Requirements
PHP v5.4.0

### Installation
```
composer create-project longtimejones/toucanine --prefer-dist
```

### Basic usage instructions
```PHP
require __DIR__ . '/path/to/src/ToucaNine/Bootstrapper.php';

$app->route('GET /', function () use ($app) {
    echo 'Hello, world!';
});

$app->dispatch();
```

**Setup app controller routes**

```PHP
$app->route('GET /hello-world', array(
    'Welcome',    /* App controller */
    'helloWorld', /* Controller method */
));

$app->route('GET /hello-user/([^/]+)', array(
    'Welcome',   /* App controller */
    'helloUser', /* Controller method */
    '$1',        /* Argument passed to method */
));
```

**Configuration file**

Configuration for machines, Illuminate Database, and HTML Purifier.

```
app/Config.php
```

**Executing HTML Purifier app helper**

```PHP
$this->helper('Html')->purifier()->purify($value);
```

**Executing Illuminate Database app model**

```PHP
$this->model('User')->byUsername($user)->first()
```

**HMVC**

```PHP
$this->controller('NameOfYourAppController')->invoke('nameOfControllerMethod', array(
    $argument1,
    $argument2,
    ...
));
```

**RESTful**

```PHP
$app->route('POST /example/id/([^/]+)', function () use ($app) {
    ...
});
```

For further usage instructions, check out the [homepage for the ToucaNine framework](http://tim.olesen.be/toucanine-php5-framework/).