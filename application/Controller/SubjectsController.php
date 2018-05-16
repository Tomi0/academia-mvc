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

    public function show($subject = null)
    {
        if (!isset($subject)) {
            header('location: /error');
        }

        $subj = new Subject();
        $subj->find($subject);

        if ($this->authorize()) {

        }

    }

    private function authorize()
    {

    }
}