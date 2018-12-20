<?php

declare(strict_types=1);

namespace OperatingSystem\File;

use OperatingSystem\FileType\FileType;
use OperatingSystem\Group\Factory\GroupFactory;
use OperatingSystem\Group\Group;
use OperatingSystem\Permission\Permission;
use OperatingSystem\FileTime\FileTime;
use OperatingSystem\User\Factory\UserFactory;
use OperatingSystem\User\User;
use Unit\Information\Size;

class File
{
    /**
     * Absolute file path plus file name, for example "/var/www/html/foo.txt".
     *
     * @var string
     */
    private $name;

    /**
     * @var \SplFileInfo
     */
    private $splFileInfo;

    public function __construct(string $name)
    {
        $this->name = $name;
    }

    /**
     * System call stat().
     * Clears PHP's stat cache before every time for getting the up to date information.
     *
     * @param bool      $clearCache
     *
     * @return array
     */
    private function getStat($clearCache = false)
    {
        if ($clearCache) {
            \clearstatcache();
        }
        return \stat($this->name);
    }

    /**
     * Automatic aliases for file attribute classes.
     *
     * @param string $method
     * @param array $arguments
     *
     * @return mixed
     *
     * @throws \ReflectionException
     * @throws \OperatingSystem\User\Exception\PosixNotAvailableException
     * @throws \OperatingSystem\Group\Exception\PosixNotAvailableException
     */
    public function __call(string $method, array $arguments)
    {
        $attributeClasses = [
            FileType::class,
            Permission::class,
            FileTime::class,
        ];
        foreach ($attributeClasses as $attributeClass) {
            $rc = new \ReflectionClass($attributeClass);
            if ($rc->hasMethod($method)) {
                switch ($attributeClass) {
                    case FileType::class:
                        $object = $this->getType();
                        break;
                    case Permission::class:
                        $object = $this->getPermissions();
                        break;
                    case FileTime::class:
                        $object = $this->getTimes();
                        break;
                    default:
                        throw new \RuntimeException('Method ' . $method . '() could not be found.');
                }
                return $rc->getMethod($method)->invoke(
                    $object,
                    $arguments
                );
            }
        }
        throw new \RuntimeException('Method ' . $method . '() could not be found.');
    }

    /**
     * @return \SplFileInfo
     */
    public function getSplFileInfo(): \SplFileInfo
    {
        if (null === $this->splFileInfo) {
            $this->splFileInfo = new \SplFileInfo($this->name);
        }
        return $this->splFileInfo;
    }

    /**
     * @return FileType
     */
    public function getType(): FileType
    {
        return new FileType($this->getStat()['mode']);
    }

    /**
     * @return Permission
     */
    public function getPermissions(): Permission
    {
        return new Permission($this->getStat(true)['mode']);
    }

    public function getLinkCount()
    {
        echo '[getLinkCount() IS NOT IMPLEMENTED]';
    }

    /**
     * @return User
     *
     * @throws \OperatingSystem\User\Exception\PosixNotAvailableException
     */
    public function getUser(): User
    {
        return UserFactory::createFromFileOwner($this->name);
    }

    /**
     * @return Group
     *
     * @throws \OperatingSystem\Group\Exception\PosixNotAvailableException
     */
    public function getGroup(): Group
    {
        return GroupFactory::createFromFileGroup($this->name);
    }

    /**
     * @return Size
     *
     * @throws \RuntimeException
     */
    public function getSize(): Size
    {
        if (null === $this->splFileInfo) {
            $this->splFileInfo = new \SplFileInfo($this->name);
        }

        $sizeInByte = $this->splFileInfo->getSize();

        return new Size($sizeInByte);
    }

    /**
     * @return FileTime
     */
    public function getTimes(): FileTime
    {
        return new FileTime($this->name);
    }

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return \basename($this->name);
    }

    /**
     * @return string
     */
    public function getBasename(): string
    {
        if (null === $this->splFileInfo) {
            $this->splFileInfo = new \SplFileInfo($this->name);
        }
        return $this->splFileInfo->getBasename();
    }

    /**
     * @return string
     */
    public function getExtension(): string
    {
        if (null === $this->splFileInfo) {
            $this->splFileInfo = new \SplFileInfo($this->name);
        }
        return $this->splFileInfo->getExtension();
    }

    /**
     * @return string
     */
    public function getPath(): string
    {
        if (null === $this->splFileInfo) {
            $this->splFileInfo = new \SplFileInfo($this->name);
        }
        return $this->splFileInfo->getPath();
    }

    /**
     * @return string
     */
    public function getPathWithFilename(): string
    {
        if (null === $this->splFileInfo) {
            $this->splFileInfo = new \SplFileInfo($this->name);
        }
        return $this->splFileInfo->getPathname();
    }

    /**
     * @return string
     */
    public function getRealPath(): string
    {
        if (null === $this->splFileInfo) {
            $this->splFileInfo = new \SplFileInfo($this->name);
        }
        return $this->splFileInfo->getRealPath();
    }

    /**
     * @return bool
     */
    public function isReadable(): bool
    {
        return \is_readable($this->name);
    }

    /**
     * @return bool
     */
    public function isWriteable(): bool
    {
        return \is_writeable($this->name);
    }

    /**
     * @return bool
     */
    public function isExecuteable(): bool
    {
        return \is_executable($this->name);
    }

    /**
     * @return int
     */
    public function getInode(): int
    {
        if (null === $this->splFileInfo) {
            $this->splFileInfo = new \SplFileInfo($this->name);
        }
        return $this->splFileInfo->getInode();
    }

    /**
     * @return string
     */
    public function getLinkTarget(): string
    {
        if (null === $this->splFileInfo) {
            $this->splFileInfo = new \SplFileInfo($this->name);
        }
        return $this->splFileInfo->getLinkTarget();
    }
}
