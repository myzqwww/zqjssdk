<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit139e0fd73c81600ad0bb32b69c03c296
{
    public static $files = array (
        '45d10d0a0ffbf5c642f26bac5d5bd427' => __DIR__ . '/../..' . '/system/helper.php',
        '77c906493932e6b0d12fe5f3dd294a84' => __DIR__ . '/../..' . '/houdunwang/core/functions.php',
    );

    public static $prefixLengthsPsr4 = array (
        'h' => 
        array (
            'houdunwang\\' => 11,
        ),
        'a' => 
        array (
            'app\\' => 4,
        ),
        'G' => 
        array (
            'Gregwar\\Captcha\\' => 16,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'houdunwang\\' => 
        array (
            0 => __DIR__ . '/../..' . '/houdunwang',
        ),
        'app\\' => 
        array (
            0 => __DIR__ . '/../..' . '/app',
        ),
        'Gregwar\\Captcha\\' => 
        array (
            0 => __DIR__ . '/..' . '/gregwar/captcha',
        ),
    );

    public static $prefixesPsr0 = array (
        'C' => 
        array (
            'Curl' => 
            array (
                0 => __DIR__ . '/..' . '/curl/curl/src',
            ),
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInit139e0fd73c81600ad0bb32b69c03c296::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInit139e0fd73c81600ad0bb32b69c03c296::$prefixDirsPsr4;
            $loader->prefixesPsr0 = ComposerStaticInit139e0fd73c81600ad0bb32b69c03c296::$prefixesPsr0;

        }, null, ClassLoader::class);
    }
}