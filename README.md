# Group

Wrapper for retrieving information about operating system permissions with native PHP functions

## Installation

```
composer require operating-system/permission
```

## Usage

Instantiate permission:

```php
use OperatingSystem\Permission\Permission;

$permission = new Permission(stat(__FILE__)['mode']);
```

Get permission information:

```php
// Mode
$permission->getMode();             // 33188
// Permissions
$permission->canUserRead();         // TRUE
$permission->canUserWrite();        // TRUE
$permission->canUserExecute();      // FALSE
$permission->canGroupRead();        // TRUE
$permission->canOwnerGroupWrite();  // FALSE
$permission->canGroupExecute();     // FALSE
$permission->canOthersRead();       // TRUE
$permission->canOthersWrite();      // FALSE
$permission->canOthersExecute();    // FALSE
// Additonal permissions
$permission->hasSetUidBit();        // FALSE
$permission->hasSetUidBit();        // FALSE
$permission->hasStickyBit();        // FALSE
```

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](https://github.com/operating-system/permission/blob/master/LICENSE) for more information.
