<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 30/05/18
 * Time: 18:27
 */

namespace Mini\Controller;


use Mini\Core\Controller;
use Mini\Libs\Sesion;
use Mini\Libs\Validaciones;
use Mini\Model\Document;
use Mini\Model\Subject;

class DocumentsController extends Controller
{
    public function __construct()
    {
        parent::__construct();

        if (!Sesion::userIsLoggedIn()) {
            header('location: /error');
            return;
        }
    }

    public function show($slug = null)
    {
        if (!isset($slug)) {
            header('location: /error');
            return;
        } else {
            $document = new Document($slug);
            $documentSubject = $document->getSubject();
        }

        foreach (Sesion::get('user')->subjects as $sub) {
            if ($documentSubject->id === $sub->subject_id) {
                $aux = true;
                break;
            }
        }

        if ($documentSubject->user_id === Sesion::get('user')->id) {
            $aux = true;
        }

        if (isset($aux) && $aux === true) {
            header('content-type: application/pdf');
            header('content-description:inline;filename="' . $document->slug . '""');
            header('Content-Transfer-Encoding:binary');
            header('Accept-Ranges:bytes');
            @readfile($document->url);
        } else {
            header('location: /error');
            return;
        }
    }

    public function store($subjectSlug = null)
    {
        if (!isset($subjectSlug)) {
            header('location: /error');
            return;
        } else {
            $subject = new Subject($subjectSlug);
        }

        if ($subject->user_id != Sesion::get('user')->id) {
            header('location: /error');
            return;
        }

        $resultadoValidacion['name'] = Validaciones::validarNombreDocumento($_POST['name']);
        $resultadoValidacion['description'] = Validaciones::validarDescripcionDocumento($_POST['description']);
        $resultadoValidacion['file'] = Validaciones::validarArchivo($_FILES['document-file']);

        foreach ($resultadoValidacion as $value) {
            if ($value !== true) {
                echo $this->view->render("subject/edit", ['subject' => $subject, 'errors' => $resultadoValidacion]);
                return;
            } else if (!isset($subject->id)) {
                header('location: /error');
                return;
            }
        }

        $slug = strtolower($_FILES['document-file']['name']);
        $slug = str_replace('\s', '-', $slug);
        $slug1 = time() . $slug;

        if (move_uploaded_file($_FILES['document-file']['tmp_name'], '/var/www/academia/storage/documents/' . $slug1)) {
            $document = new Document();
            $document->save($_POST['name'], $_POST['description'], $slug1, '/var/www/academia/storage/documents/' . $slug1, $subject->id);
            header('location: /subjects/edit/' . $subject->slug);
            return;
        } else {
            header('location: /error');
            return;
        }
    }

    public function delete($document)
    {
        if (!isset($document)) {
            header('location: /error');
            return;
        } else {
            $doc = new Document($document);
        }

        $asignaturaDelDocumento = $doc->getSubject();

        if (isset($asignaturaDelDocumento) && $asignaturaDelDocumento !== false) {
            if ($asignaturaDelDocumento->user_id == Sesion::get('user')->id) {
                if (file_exists($doc->url)) {
                    if (unlink($doc->url)) {
                        $doc->delete();
                        header('location: /subjects/edit/' . $asignaturaDelDocumento->slug);
                        return;
                    }
                }
            }
        }

        header('location: /error');
        return;
    }
}