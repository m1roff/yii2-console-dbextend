# Yii2 DB extenstion

Extends console commands with DB.

## Install

Recommended by composer
```
composer require mirkhamidov/yii2-console-dbextend=*
```

## Usage

in a console 
```
./yii dbex/drop-all-tables
```

after that, in console config file
```
'modules' => [
    ...
    'dbex' => 'mirkhamidov\DbexBootstrapClass',
    ...
],
```

## Connections 

Packagist: https://packagist.org/packages/mirkhamidov/yii2-console-dbextend

## Changelog

`1.1.0`

* `interactive` parametr added;

`1.0.0`

* `drop-all-tables` action created;
* this extenstion created

