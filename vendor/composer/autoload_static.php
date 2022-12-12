<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitcc3a0eadc90b49c009fc9442a3d2405e
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'MessageBird\\' => 12,
        ),
        'F' => 
        array (
            'Firebase\\JWT\\' => 13,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'MessageBird\\' => 
        array (
            0 => __DIR__ . '/..' . '/messagebird/php-rest-api/src/MessageBird',
        ),
        'Firebase\\JWT\\' => 
        array (
            0 => __DIR__ . '/..' . '/firebase/php-jwt/src',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitcc3a0eadc90b49c009fc9442a3d2405e::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitcc3a0eadc90b49c009fc9442a3d2405e::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitcc3a0eadc90b49c009fc9442a3d2405e::$classMap;

        }, null, ClassLoader::class);
    }
}