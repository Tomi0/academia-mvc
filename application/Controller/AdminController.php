<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 18/03/18
 * Time: 0:16
 */

namespace Mini\Controller;


use Mini\Core\Controller;
use Mini\Libs\Sesion;

class AdminController extends Controller
{
    function __construct()
    {
        parent::__construct();
        if (!Sesion::userIsLoggedIn()) {
            header('location: /');
        }
    }

    public function index()
    {
        echo $this->view->render('admin/dashboard');
    }

    public function dashboard()
    {
        echo $this->view->render('admin/dashboard');
    }


}