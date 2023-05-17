<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitd8a3b1409b085d02af4f809c6051a000
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Model\\' => 6,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/model',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitd8a3b1409b085d02af4f809c6051a000::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitd8a3b1409b085d02af4f809c6051a000::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitd8a3b1409b085d02af4f809c6051a000::$classMap;

        }, null, ClassLoader::class);
    }
}
