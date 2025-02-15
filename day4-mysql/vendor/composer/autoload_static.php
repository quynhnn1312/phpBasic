<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitdea997fc14482ca6584e49870b1c994c
{
    public static $prefixLengthsPsr4 = array (
        'M' => 
        array (
            'Model\\' => 6,
        ),
        'D' => 
        array (
            'Database\\' => 9,
        ),
        'C' => 
        array (
            'Connection\\' => 11,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'Model\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Model',
        ),
        'Database\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Database',
        ),
        'Connection\\' => 
        array (
            0 => __DIR__ . '/../..' . '/Connection',
        ),
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitdea997fc14482ca6584e49870b1c994c::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitdea997fc14482ca6584e49870b1c994c::$prefixDirsPsr4;

        }, null, ClassLoader::class);
    }
}
