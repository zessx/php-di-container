# PHP DI Container

Dependency Injection Container PHP Implementation. 

## Requirements

PHP >= 7.4

## Usage

Explicit binding:

```php
$container = new ZCode\DI\Container();

$container->set(Foo::class, function () {
    return new Foo($container->get('bar');)
});
$container->set(Bar::class, function () {
    return new Bar();
});

$container->get(Foo::class);
```

Implicit binding relying on constructor injection:

```php
$container = new ZCode\DI\Container();

$container->get(Foo::class);
```


## Testing

```sh
composer run test
```
