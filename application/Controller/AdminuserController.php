<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 28/05/18
 * Time: 19:07
 */

namespace Mini\Controller;


use Mini\Core\Controller;
use Mini\Libs\Sesion;
use Mini\Libs\Validaciones;
use Mini\Model\Rol;
use Mini\Model\User;

class AdminuserController extends Controller
{

    public function __construct()
    {
        parent::__construct();
        if (!Sesion::userIsLoggedIn() || Sesion::get('user')->rol_id != 1) {
            header('location: /');
            return;
        }
    }

    public function index()
    {
        $users = new User();
        $allUsers = $users->all();

        echo $this->view->render('admin/user/index', ['users' => $allUsers]);
    }

    public function create()
    {
        $rol = new Rol();
        $roles = $rol->all();

        echo $this->view->render('admin/user/create', ['roles' => $roles]);
    }

    public function store()
    {
        if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['password']) || !isset($_POST['role'])) {
            header('location: /adminuser/create');
        }

        $resultadoValidacion['name'] = Validaciones::validarNombre($_POST['name']);
        $resultadoValidacion['email'] = Validaciones::validarEmail($_POST['email']);
        $resultadoValidacion['password'] = Validaciones::validarPassword($_POST['password']);
        $resultadoValidacion['role'] = Validaciones::validarRol($_POST['role']);

        foreach ($resultadoValidacion as $value) {
            if ($value !== true) {
                $rol = new Rol();
                $roles = $rol->all();
                echo $this->view->render('admin/user/create', ['roles' => $roles, 'errors' => $resultadoValidacion]);
                $aux = true;
                break;
            }
        }

        if (!isset($aux)) {
            $user = new User();
            $user->save($_POST['name'], $_POST['email'], $_POST['role'], $_POST['password']);
            header('location: /adminuser');
        }
    }

    public function edit($userEmail = null)
    {
        if (isset($userEmail)) {
            $user = new User($userEmail);

            if (isset($user->name)) {
                $rol = new Rol();
                $allRoles = $rol->all();

                echo $this->view->render('admin/user/edit', ['user' => $user, 'roles' => $allRoles]);
            } else {
                header('location: /error');
            }
        } else {
            header('location: /error');
        }
    }

    public function update($email = null)
    {
        if (!isset($_POST['name']) || !isset($_POST['email']) || !isset($_POST['role'])) {
            header('location: /adminuser');
        } else if (isset($email)) {
            $user = new User($email);
        } else {
            header('location: /adminuser');
        }

        if (isset($_POST['password']) && $_POST['password'] != "") {
            $resultadoValidacion['password'] = Validaciones::validarPassword($_POST['password']);
            $password = true;
        } else if ($_POST['email'] != $email) {
            $resultadoValidacion['email'] = Validaciones::validarEmailUpdate($_POST['email'], $user->id);
        }

        $resultadoValidacion['name'] = Validaciones::validarNombre($_POST['name']);
        $resultadoValidacion['role'] = Validaciones::validarRol($_POST['role']);

        foreach ($resultadoValidacion as $value) {
            if ($value !== true) {
                $rol = new Rol();
                $roles = $rol->all();
                $user = new User($email);
                echo $this->view->render('admin/user/edit', ['roles' => $roles, 'user' => $user, 'errors' => $resultadoValidacion]);
                $aux = true;
                break;
            }
        }

        if (!isset($aux)) {
            $user->name = $_POST['name'];
            $user->rol_id = $_POST['role'];
            $user->email = $_POST['email'];

            if (isset($password) && $password) {
                $user->password = md5($_POST['password']);
            }

            $user->update($email);
            header('location: /adminuser');
        }
    }

    public function delete($email)
    {
        if (isset($email)) {
            $user = new User();
            $user->find($email);
            if (isset($user->id)){
                $user->delete();
            }
        }

        header('location: /adminuser');
    }

}