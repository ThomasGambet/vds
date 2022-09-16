<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInitf2ce9de86d2fc25d8c85c98911596ba6
{
    public static $prefixLengthsPsr4 = array (
        'P' => 
        array (
            'PHPMailer\\PHPMailer\\' => 20,
        ),
        'G' => 
        array (
            'Gumlet\\' => 7,
        ),
    );

    public static $prefixDirsPsr4 = array (
        'PHPMailer\\PHPMailer\\' => 
        array (
            0 => __DIR__ . '/..' . '/phpmailer/phpmailer/src',
        ),
        'Gumlet\\' => 
        array (
            0 => __DIR__ . '/..' . '/gumlet/php-image-resize/lib',
        ),
    );

    public static $classMap = array (
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->prefixLengthsPsr4 = ComposerStaticInitf2ce9de86d2fc25d8c85c98911596ba6::$prefixLengthsPsr4;
            $loader->prefixDirsPsr4 = ComposerStaticInitf2ce9de86d2fc25d8c85c98911596ba6::$prefixDirsPsr4;
            $loader->classMap = ComposerStaticInitf2ce9de86d2fc25d8c85c98911596ba6::$classMap;

        }, null, ClassLoader::class);
    }
}