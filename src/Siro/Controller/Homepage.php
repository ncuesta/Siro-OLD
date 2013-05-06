<?php

namespace Siro\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Homepage.php
 *
 * @author José Nahuel Cuesta Luengo <nahuelcuestaluengo@gmail.com>
 */ 
class Homepage
{
    public function index(Request $request, Application $app)
    {
        return '<html><head></head><body><img src="' . $app['gravatar']->get('nahuelcuestaluengo@gmail.com') . '"></body></html>';
    }
}
