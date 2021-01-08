<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdff37afa64e6a524beacae9999dc645a
{
    public static $files = array (
        '3d9ba885ef722c7b1fdba3dde02a8c81' => __DIR__ . '/../..' . '/helper/cssLink.php',
        '71eb534f1b623fe21661e178cda34ccb' => __DIR__ . '/../..' . '/helper/jsLink.php',
    );

    public static $prefixLengthsPsr4 = array (
        'p' => 
        array (
            'project\\' => 8,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'project\\' => 
        array (
            0 => __DIR__ . '/../..' . '/classes',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdff37afa64e6a524beacae9999dc645a::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdff37afa64e6a524beacae9999dc645a::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}