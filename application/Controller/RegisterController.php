<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 17/03/18
 * Time: 23:09
 */

namespace Mini\Controller;


use Mini\Core\Controller;
use Mini\Libs\Sesion;
use Mini\Libs\Validaciones;
use Mini\Model\User;

class RegisterController extends Controller
{
    public function __construct()
    {
        parent::__construct();
        if (Sesion::userIsLoggedIn()) {
            header('location: /');
        }
    }

    public function index()
    {

        echo $this->view->render('auth/register');
    }

    public function check()
    {
        if (isset($_POST['name']) && isset($_POST['email']) && isset($_POST['password']) && isset($_POST['password_confirmation'])) {

            $resultadoValidaciones = Validaciones::validarRegistro($_POST['name'], $_POST['email'], $_POST['password'], $_POST['password_confirmation']);

            if ($resultadoValidaciones === true) {

                $user = new User();
                if ($user->save($_POST['name'], $_POST['email'], $_POST['password'])) {
                    header('location: /login');
                }

            } else {
                echo $this->view->render('auth/register', ['error' => $resultadoValidaciones]);
            }

        } else {
            $this->index();
        }


    }


}