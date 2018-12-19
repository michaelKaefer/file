# Group

Wrapper for retrieving information about local files with native PHP functions

## Installation

```
composer require operating-system/file
```

## Usage

Instantiate file:

```php
use OperatingSystem\File\File;

$file = new File('foo..txt');
```

Get file information:

```php
// Name
$file->getFilename();                  // 'foo.txt'
$file->getBasename();                  // 'foo'
$file->getExtension();                 // 'txt'
$file->getPath();                      // ''
$file->getPathWithFilename();          // 'foo.txt'
$file->getRealPath();                  // '/var/www/html/foo.txt'
// Type
$file->getType()                       // FileType::SOCKET | FileType::SYMBOLIC_LINK: |
                                       // FileType::REGULAR_FILE | FileType::BLOCK_DEVICE | 
                                       // FileType::DIRECTORY | FileType::CHARACTER_DEVICE |
                                       // FileType::FIFO:
$file->getMode();                      // 33188 
$file->isSocket();                     // FALSE
$file->isSymbolicLink();               // FALSE
$file->isFile();                       // TRUE
$file->isBlockDevice();                // FALSE
$file->isDirectory();                  // FALSE
$file->isCharacterDevice();            // FALSE
$file->isFifo();                       // FALSE
// User
$file->getUser()->getName();           // 'root'
$file->getUser()->getPassword();       // 'x'
$file->getUser()->getUid();            // 0
$file->getUser()->getGid();            // 0
$file->getUser()->getGecos();          // 'root'
$file->getUser()->getHomeDirectory();  // 'root'
$file->getUser()->getShell();          // '/bin/bash'
// Group
$file->getGroup()->getName();           // 'root'
$file->getGroup()->getPassword();       // 'x'
$file->getGroup()->getMembers();        // ['root']
$file->getGroup()->getGid();            // 0
// Permission
$file->getMode();                       // 33188
$file->canUserRead();                   // TRUE
$file->canUserWrite();                  // TRUE
$file->canUserExecute();                // FALSE
$file->canGroupRead();                  // TRUE
$file->canOwnerGroupWrite();            // FALSE
$file->canGroupExecute();               // FALSE
$file->canOthersRead();                 // TRUE
$file->canOthersWrite();                // FALSE
$file->canOthersExecute();              // FALSE
$file->hasSetUidBit();                  // FALSE
$file->hasSetUidBit();                  // FALSE
$file->hasStickyBit();                  // FALSE
$file->isReadable();                    // TRUE
$file->isWriteable();                   // TRUE
$file->isExecuteable();                 // TRUE
// Time
$file->getLastAccessed()->format('d.m.Y H:i:s');    // '16.12.2018 08:00:00'
$file->getLastModified()->format('d.m.Y H:i:s');    // '16.12.2018 08:00:00'
$file->getLastChanged()->format('d.m.Y H:i:s');     // '16.12.2018 08:00:00'
// Others
$file->getSize();                       // 1
$file->getInode();                      // 13245551
$file->getLinkTarget();
$file->getSplFileInfo();
```

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](https://github.com/operating-system/file/blob/master/LICENSE) for more information.
