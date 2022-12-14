<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitda88f25ecef5fb77c293c56b6ca8a02a
{
    public static $files = array (
        '6e3fae29631ef280660b3cdad06f25a8' => __DIR__ . '/..' . '/symfony/deprecation-contracts/function.php',
        '09f6b20656683369174dd6fa83b7e5fb' => __DIR__ . '/..' . '/symfony/polyfill-uuid/bootstrap.php',
    );

    public static $prefixLengthsPsr4 = array (
        'S' => 
        array (
            'Symfony\\Polyfill\\Uuid\\' => 22,
        ),
        'P' => 
        array (
            'Psr\\Container\\' => 14,
        ),
        'F' => 
        array (
            'Faker\\' => 6,
        ),
        'A' => 
        array (
            'App\\' => 4,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Symfony\\Polyfill\\Uuid\\' => 
        array (
            0 => __DIR__ . '/..' . '/symfony/polyfill-uuid',
        ),
        'Psr\\Container\\' => 
        array (
            0 => __DIR__ . '/..' . '/psr/container/src',
        ),
        'Faker\\' => 
        array (
            0 => __DIR__ . '/..' . '/fakerphp/faker/src/Faker',
        ),
        'App\\' => 
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
            $loader->prefixLengthsPsr4 = ComposerStaticInitda88f25ecef5fb77c293c56b6ca8a02a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitda88f25ecef5fb77c293c56b6ca8a02a::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitda88f25ecef5fb77c293c56b6ca8a02a::$classMap;

        }, null, ClassLoader::class);
    }
}
