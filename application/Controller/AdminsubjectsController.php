<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 4/06/18
 * Time: 16:32
 */

namespace Mini\Controller;


use Mini\Core\Controller;
use Mini\Libs\Sesion;
use Mini\Libs\Validaciones;
use Mini\Model\Category;
use Mini\Model\Subject;
use Mini\Model\User;

class AdminsubjectsController extends Controller
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
        $subject = new Subject();
        $all = $subject->all();

        echo $this->view->render('admin/subject/index', ['subjects' => $all]);
        return;
    }

    public function create()
    {
        $user = new User();
        $allUsers = $user->all();

        $cat = new Category();
        $allCategoriesArray = $cat->all();

        echo $this->view->render('admin/subject/create', ['users' => $allUsers, 'categories' => $allCategoriesArray]);
        return;
    }

    public function edit($slug = null)
    {
        if (!isset($slug)) {
            header('location: /error');
            return;
        }

        $subject = new Subject($slug);

        if (isset($subject->id)) {
            $user = new User();
            $allUsers = $user->all();

            $cat = new Category();
            $allCategoriesArray = $cat->all();

            echo $this->view->render('admin/subject/edit', ['users' => $allUsers, 'categories' => $allCategoriesArray, 'subject' => $subject]);
            return;
        } else {
            header('location: /error');
            return;
        }
    }

    public function update($slug = null)
    {
        if (!isset($slug)) {
            header('location: /error');
            return;
        }

        $subject = new Subject($slug);

        if (!isset($subject->id)) {
            header('location: /error');
            return;
        }

        $resultadoValidacion['name'] = Validaciones::validarNombreDefecto($_POST['name']);
        $resultadoValidacion['category_id'] = Validaciones::validarCategory_id($_POST['category_id']);
        $resultadoValidacion['user_id'] = Validaciones::validarUser_id($_POST['user_id']);

        foreach ($resultadoValidacion as $value) {
            if ($value !== true) {
                $error = true;
                break;
            }
        }

        if (isset($error) && $error === true) {
            $user = new User();
            $allUsers = $user->all();

            $cat = new Category();
            $allCategoriesArray = $cat->all();

            echo $this->view->render('admin/subject/edit', ['users' => $allUsers, 'categories' => $allCategoriesArray, 'subject' => $subject, 'errors' => $resultadoValidacion]);
            return;
        } else {
            $subject->name = $_POST['name'];
            $subject->category_id = $_POST['category_id'];
            $subject->user_id = $_POST['user_id'];

            $subject->update();

            header('location: /adminsubjects');
            return;
        }
    }

    public function delete($slug = null)
    {
        if (!isset($slug)) {
            header('location: /error');
            return;
        } else {
            $subject = new Subject($slug);
        }

        if ($subject->delete()) {
            header('location: /adminsubjects');
            return;
        } else {
            header('location: /error');
            return;
        }


    }

    public function store()
    {
        if (!isset($_POST['name']) || !isset($_POST['category_id']) || !isset($_POST['user_id'])) {
            header('location: /adminsubjects/create');
            return;
        }

        $resultadoValidacion['name'] = Validaciones::validarNombreDefecto($_POST['name']);
        $resultadoValidacion['category_id'] = Validaciones::validarCategory_id($_POST['category_id']);
        $resultadoValidacion['user_id'] = Validaciones::validarUser_id($_POST['user_id']);

        foreach ($resultadoValidacion as $value) {
            if ($value !== true) {
                $error = true;
                break;
            }
        }

        if (isset($error) && $error === true) {
            $user = new User();
            $allUsers = $user->all();

            $cat = new Category();
            $allCategoriesArray = $cat->all();

            echo $this->view->render('admin/subject/create', ['errors' => $resultadoValidacion, 'users' => $allUsers, 'categories' => $allCategoriesArray]);
            return;
        } else {
            $subj = new Subject();

            $subj->name = $_POST['name'];
            $subj->category_id = $_POST['category_id'];
            $subj->user_id = $_POST['user_id'];
            $subj->matricula = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

            $subj->save();

            header('location: /adminsubjects');
            return;
        }
    }

    public function matricula($slug = null)
    {
        if (!isset($slug)) {
            header('location: /error');
            return;
        } else {
            $subj = new Subject($slug);
        }

        $subj->matricula = substr(str_shuffle("0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"), 0, 10);

        $subj->update();

        header('location: /adminsubjects');
        return;
    }
}