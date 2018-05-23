<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 16/05/18
 * Time: 15:52
 */

namespace Mini\Controller;


use Mini\Core\Controller;
use Mini\Libs\Sesion;
use Mini\Model\Subject;

class SubjectsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!Sesion::userIsLoggedIn()) {
            header('location: /error');
        }
    }

    public function index()
    {
        header('location: /error');
    }

    public function show($subject = null)
    {
        if (!isset($subject)) {
            header('location: /error');
        }

        $subj = new Subject();
        $subj->find($subject);

        if ($this->authorize($subj)) {
            echo $this->view->render('subject/show', ['subject' => $subj]);
        } else {
            echo $this->view->render('subject/matricula', ['subject' => $subj]);
        }

    }

    public function matricula($subject = null)
    {
        if (!isset($subject)) {
            header('location: /error');
        }

        $subj = new Subject();
        $subj->find($subject);

        if ($subj->matricula === $_POST['matricula']) {
            Sesion::get('user')->matricular($subj);
            Sesion::actualizarDatosUsuario();
            header('location: /subjects/show/' . $subj->slug);
        } else {
            echo $this->view->render('subject/matricula', ['subject' => $subj, 'error' => 'Matricula incorrecta.']);
        }
    }

    private function authorize($subject)
    {
        Sesion::actualizarDatosUsuario();
        foreach (Sesion::get('user')->subjects as $sub) {
            if ($subject->id === $sub->subject_id) {
                return true;
            }
        }

        return false;
    }
}