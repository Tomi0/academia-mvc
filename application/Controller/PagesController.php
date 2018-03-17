<?php

/**
 * Class PagesController
 *
 * Please note:
 * Don't use the same name for class and method, as this might trigger an (unintended) __construct of the class.
 * This is really weird behaviour, but documented here: http://php.net/manual/en/language.oop5.decon.php
 *
 */

namespace Mini\Controller;

use Mini\Core\Controller;

class PagesController extends Controller
{
    /**
     * PAGE: index
     * This method handles what happens when you move to http://yourproject/home/index (which is the default page btw)
     */
    public function index()
    {
        echo $this->view->render('pages/home', ['titulo' => 'Academia x2']);
    }

    public function home()
    {
        echo $this->view->render('pages/home', ['titulo' => 'Academia x2']);
    }

    public function about()
    {
        echo $this->view->render('pages/about', ['titulo' => 'Academia x2']);
    }

    public function contact()
    {
        echo $this->view->render('pages/contact', ['titulo' => 'Academia x2']);
    }

    public function whyus()
    {
        echo $this->view->render('pages/whyus', ['titulo' => 'Academia x2']);
    }
}
