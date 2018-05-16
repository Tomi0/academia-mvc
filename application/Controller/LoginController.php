<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 14/03/18
 * Time: 18:15
 */

namespace Mini\Controller;

use Mini\Libs\Validaciones;
use Mini\Core\Controller;
use Mini\Libs\Sesion;
use Mini\Model\User;

class LoginController extends Controller
{
    function __construct()
    {
        parent::__construct();
        if (Sesion::userIsLoggedIn()) {
            header('location: /');
        }
    }

    public function index()
    {
        echo $this->view->render('auth/login');
    }

    public function logout()
    {
        Sesion::destroy();

        header('location: /');
    }

    public function check()
    {
        if (isset($_POST['email']) && isset($_POST['password']) && Validaciones::validarDatosLogin($_POST['email'], $_POST['password'])) {

            $user = new User();
            $passOrig = $user->getPassword($_POST['email']);

            if (md5($_POST['password']) === $passOrig) {
                $user = new User();
                $user->find($_POST['email']);
                Sesion::set('user', serialize($user));
                Sesion::set('user_logged_in', true);
                Sesion::set('email', $_POST['email']);

                header('location: /');

            } else {
                echo $this->view->render('auth/login', ['error' => "Datos incorrectos"]);
            }

        } else {
            echo $this->view->render('auth/login', ['error' => "Datos incorrectos"]);
        }
    }

}