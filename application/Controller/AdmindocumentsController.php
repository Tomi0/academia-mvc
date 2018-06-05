<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 5/06/18
 * Time: 16:42
 */

namespace Mini\Controller;


use Mini\Core\Controller;
use Mini\Libs\Sesion;
use Mini\Libs\Validaciones;
use Mini\Model\Document;
use Mini\Model\Subject;

class AdmindocumentsController extends Controller
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
        $subj = new Subject();
        $allSubjects = $subj->all();

        echo $this->view->render('admin/document/index', ['subjects' => $allSubjects]);
    }

    public function store()
    {
        if (!isset($_POST['name']) || !isset($_POST['description']) || !isset($_FILES['document-file']) || !isset($_POST['subject_id'])) {
            header('location: /admindocuments');
            return;
        }
        $resultadoValidacion['name'] = Validaciones::validarNombreDocumento($_POST['name']);
        $resultadoValidacion['description'] = Validaciones::validarDescripcionDocumento($_POST['description']);
        $resultadoValidacion['file'] = Validaciones::validarArchivo($_FILES['document-file']);
        $resultadoValidacion['subject_id'] = Validaciones::validarAsignatura($_POST['subject_id']);

        foreach ($resultadoValidacion as $value) {
            if ($value !== true) {
                $subj = new Subject();
                $subjects = $subj->all();
                echo $this->view->render("/admin/document/index", ['subjects' => $subjects, 'errors' => $resultadoValidacion]);
                return;
            }
        }

        $subject = new Subject();
        $subject->findId($_POST['subject_id']);

        $slug = strtolower($_FILES['document-file']['name']);
        $slug = str_replace('\s', '-', $slug);
        $slug1 = time() . $slug;

        if (move_uploaded_file($_FILES['document-file']['tmp_name'], '/var/www/academia/storage/documents/' . $slug1)) {
            $document = new Document();
            $document->save($_POST['name'], $_POST['description'], $slug1, '/var/www/academia/storage/documents/' . $slug1, $subject->id);
            header('location: /admindocuments');
            return;
        } else {
            header('location: /error');
            return;
        }
    }

    public function delete($slug)
    {
        if (!isset($slug)) {
            header('location: /error');
            return;
        } else {
            $doc = new Document($slug);
        }

        if (isset($doc->url) && file_exists($doc->url)) {
            if (unlink($doc->url)) {
                $doc->delete();
                header('location: /admindocuments');
                return;
            }
        }

        header('location: /error');
        return;
    }
}