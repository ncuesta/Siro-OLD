<?php

namespace Siro\Controller;

use Silex\Application;
use Symfony\Component\HttpFoundation\Request;

/**
 * Homepage
 *
 * @author José Nahuel Cuesta Luengo <nahuelcuestaluengo@gmail.com>
 */ 
class Homepage
{
    public function index(Request $request, Application $app)
    {
        return $app['twig']->render('homepage/index.twig');
    }
}
