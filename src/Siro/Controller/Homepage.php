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
        $users = $app['orm.em']->getRepository('Siro\Entity\User');
        $user = $users->find(1);
        die(var_dump($user));

        return $app['twig']->render('homepage/index.twig');
    }
}
