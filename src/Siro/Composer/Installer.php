<?php

namespace Siro\Composer;

/**
 * Installer
 *
 * @author José Nahuel Cuesta Luengo <nahuelcuestaluengo@gmail.com>
 */
class Installer
{
    /**
     * Perform post-install actions.
     */
    public static function install()
    {
        chmod('resources/cache', 0777);
        chmod('resources/log', 0777);
        //chmod('web/assets', 0777);
        //chmod('console', 0500);
    }
}