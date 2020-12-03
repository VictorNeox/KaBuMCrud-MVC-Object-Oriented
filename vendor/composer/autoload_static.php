<?php

// autoload_static.php @generated by Composer

namespace Composer\Autoload;

class ComposerStaticInit8baff1aa71876e48ab89ee3d5e707ae3
{
    public static $classMap = array (
        'App' => __DIR__ . '/../..' . '/core/App.php',
        'App\\Controllers\\PagesController' => __DIR__ . '/../..' . '/app/controllers/PagesController.php',
        'App\\Controllers\\UsersController' => __DIR__ . '/../..' . '/app/controllers/UsersController.php',
        'App\\Core\\Request' => __DIR__ . '/../..' . '/core/Request.php',
        'App\\Core\\Router' => __DIR__ . '/../..' . '/core/Router.php',
        'App\\Models\\User' => __DIR__ . '/../..' . '/app/models/User.php',
        'App\\Models\\Validator' => __DIR__ . '/../..' . '/app/models/Validator.php',
        'ComposerAutoloaderInit8baff1aa71876e48ab89ee3d5e707ae3' => __DIR__ . '/..' . '/composer/autoload_real.php',
        'Composer\\Autoload\\ClassLoader' => __DIR__ . '/..' . '/composer/ClassLoader.php',
        'Composer\\Autoload\\ComposerStaticInit8baff1aa71876e48ab89ee3d5e707ae3' => __DIR__ . '/..' . '/composer/autoload_static.php',
        'Composer\\InstalledVersions' => __DIR__ . '/..' . '/composer/InstalledVersions.php',
        'Db' => __DIR__ . '/../..' . '/core/database/Db.php',
    );

    public static function getInitializer(ClassLoader $loader)
    {
        return \Closure::bind(function () use ($loader) {
            $loader->classMap = ComposerStaticInit8baff1aa71876e48ab89ee3d5e707ae3::$classMap;

        }, null, ClassLoader::class);
    }
}
