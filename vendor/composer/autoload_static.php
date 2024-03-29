<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit169cd5210922204cbe819bd9dcdbde1e
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Masuresh124\\SimpleCrudBuilder\\' => 30,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Masuresh124\\SimpleCrudBuilder\\' => 
        array (
            0 => __DIR__ . '/../..' . '/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit169cd5210922204cbe819bd9dcdbde1e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit169cd5210922204cbe819bd9dcdbde1e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInit169cd5210922204cbe819bd9dcdbde1e::$classMap;

        }, null, ClassLoader::class);
    }
}
