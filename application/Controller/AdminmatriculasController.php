<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 6/06/18
 * Time: 17:47
 */

namespace Mini\Controller;


use Mini\Core\Controller;
use Mini\Libs\Sesion;
use Mini\Libs\Validaciones;
use Mini\Model\Subject;
use Mini\Model\User;

class AdminmatriculasController extends Controller
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
        $user = new User();
        $allUsers = $user->all();

        echo $this->view->render('admin/matricula/index', ['users' => $allUsers]);
        return;
    }

    public function edit($email = null)
    {
        if (!isset($email)) {
            header('location: /error');
            return;
        } else {
            $user = new User($email);

            if ($user->rol->name == 'alumno') {
                $subj = new Subject();
                $allSubjects = $subj->all();

                echo $this->view->render('admin/matricula/edit', ['user' => $user, 'subjects' => $allSubjects]);
                return;
            } else {
                header('location: /error');
                return;
            }
        }
    }

    public function store($email = null)
    {
        if (!isset($email)) {
            header('location: /error');
            return;
        } else {
            $user = new User($email);
        }

        if (!isset($_POST['subject'])) {
            header('location: /adminmatriculas/edit/' . $user->email);
            return;
        }

        $validacionAsignatura['subject'] = Validaciones::validarAsignatura($_POST['subject']);

        if (isset($user->id) && $validacionAsignatura['subject'] === true) {

            $subj = new Subject();
            $subj->findId($_POST['subject']);

            foreach ($user->subjects as $subject) {

                if ($subj->id == $subject->id) {
                    $yaMatriculado = true;
                }

            }

            if (!isset($yaMatriculado)) {
                $user->matricular($subj);

                header('location: /adminmatriculas/edit/' . $user->email);
            } else {
                $subj = new Subject();
                $allSubjects = $subj->all();

                echo $this->view->render('admin/matricula/edit', ['user' => $user, 'subjects' => $allSubjects, 'errors' => ['subject' => 'El usuario ya está matriculado en la asignatura.']]);
                return;
            }

        } else if (isset($user->id) && $validacionAsignatura['subject'] !== true) {

            $subj = new Subject();
            $allSubjects = $subj->all();

            echo $this->view->render('admin/matricula/edit', ['user' => $user, 'subjects' => $allSubjects, 'errors' => $validacionAsignatura]);
            return;

        } else {
            header('location: /error');
            return;
        }
    }

    public function desmatricular($email = null, $subjectSlug = null)
    {
        if (!isset($email) || !isset($subjectSlug)){
            header('location: /error');
            return;
        } else {
            $user = new User($email);
            $subject = new Subject($subjectSlug);
        }

        if (isset($user->id) && isset($subject->id)) {

            $user->desmatricular($subject->id);

            header('location: /adminmatriculas/edit/' . $user->email);

        } else {
            header('location: /error');
            return;
        }
    }
}