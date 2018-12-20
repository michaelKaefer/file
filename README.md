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

$file = new File('foo.txt');
```

Get file information:

```php
// Name
$file->getFilename();                               // 'foo.txt'
$file->getBasename();                               // 'foo'
$file->getExtension();                              // 'txt'
$file->getPath();                                   // ''
$file->getPathWithFilename();                       // 'foo.txt'
$file->getRealPath();                               // '/var/www/html/foo.txt'

// Type
$file->getType()                                    // FileType::SOCKET | FileType::SYMBOLIC_LINK: | FileType::REGULAR_FILE | FileType::BLOCK_DEVICE | FileType::DIRECTORY | FileType::CHARACTER_DEVICE | FileType::FIFO:
$file->getMode();                                   // 33188 
$file->isSocket();                                  // FALSE
$file->isSymbolicLink();                            // FALSE
$file->isFile();                                    // TRUE
$file->isBlockDevice();                             // FALSE
$file->isDirectory();                               // FALSE
$file->isCharacterDevice();                         // FALSE
$file->isFifo();                                    // FALSE

// User
$file->getUser()->getName();                        // 'root'
$file->getUser()->getPassword();                    // 'x'
$file->getUser()->getUid();                         // 0
$file->getUser()->getGid();                         // 0
$file->getUser()->getGecos();                       // 'root'
$file->getUser()->getHomeDirectory();               // 'root'
$file->getUser()->getShell();                       // '/bin/bash'

// Group
$file->getGroup()->getName();                       // 'root'
$file->getGroup()->getPassword();                   // 'x'
$file->getGroup()->getMembers();                    // ['root']
$file->getGroup()->getGid();                        // 0

// Permission
$file->getMode();                                   // 33188
$file->canUserRead();                               // TRUE
$file->canUserWrite();                              // TRUE
$file->canUserExecute();                            // FALSE
$file->canGroupRead();                              // TRUE
$file->canOwnerGroupWrite();                        // FALSE
$file->canGroupExecute();                           // FALSE
$file->canOthersRead();                             // TRUE
$file->canOthersWrite();                            // FALSE
$file->canOthersExecute();                          // FALSE
$file->hasSetUidBit();                              // FALSE
$file->hasSetUidBit();                              // FALSE
$file->hasStickyBit();                              // FALSE
$file->isReadable();                                // TRUE
$file->isWriteable();                               // TRUE
$file->isExecuteable();                             // TRUE

// Time
$file->getLastAccessed()->format('d.m.Y H:i:s');    // '16.12.2018 08:00:00'
$file->getLastModified()->format('d.m.Y H:i:s');    // '16.12.2018 08:00:00'
$file->getLastChanged()->format('d.m.Y H:i:s');     // '16.12.2018 08:00:00'

// Size
$file->getSize()->format();                         // '1B'
$file->getSize()->format('b');                      // '8b'
$file->getSize()->format('kb');                     // '0.008kb'
$file->getSize()->format('kb', 1);                  // '0.0kb'
$file->getSize()->format('kb', 2);                  // '0.01kb'
$file->getSize()->format('Mb');                     // '0.000008Mb'
$file->getSize()->format('Gb');                     // '0.000000008Gb'
$file->getSize()->format('Tb');                     // '0.000000000008Tb'
$file->getSize()->format('Pb');                     // '0.000000000000008Pb'
$file->getSize()->format('B');                      // '1B'
$file->getSize()->format('kB');                     // '0.001kB'
$file->getSize()->format('MB');                     // '0.000001MB'
$file->getSize()->format('GB');                     // '0.000000001GB'
$file->getSize()->format('TB');                     // '0.000000000001TB'
$file->getSize()->format('PB');                     // '0.000000000000001PB'

$file->getSize()->get('b');                         // 8
$file->getSize()->get('kb');                        // 0.008
$file->getSize()->get('Mb');                        // 0.000008
$file->getSize()->get('Gb');                        // 0.000000008
$file->getSize()->get('Tb');                        // 0.000000000008
$file->getSize()->get('Pb');                        // 0.000000000000008
$file->getSize()->get('B');                         // 1
$file->getSize()->get('kB');                        // 0.001
$file->getSize()->get('MB');                        // 0.000001
$file->getSize()->get('GB');                        // 0.000000001
$file->getSize()->get('TB');                        // 0.000000000001
$file->getSize()->get('PB');                        // 0.000000000000001

$size = new Size('1MB');
$file->getSize()->add($size)->format();             // '1.000001MB'
$file->getSize()->add($size)->format();             // '2.000001MB'
$file->getSize()->add($size)->format(null, 1);      // '3.0MB'
$file->getSize()->subtract($size)->format();        // '2.000001MB'
$file->getSize()->multiply($size)->format(null, 1); // '16.0TB'
$file->getSize()->divide($size)->format(null, 1);   // '2.0MB'

// Others
$file->getInode();                                  // 13245551
$file->getLinkTarget();
$file->getSplFileInfo();
```

## Testing

``` bash
$ ./vendor/bin/phpunit
```

## License

The MIT License (MIT). Please see [License File](https://github.com/operating-system/file/blob/master/LICENSE) for more information.
