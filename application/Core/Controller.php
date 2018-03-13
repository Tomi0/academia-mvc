<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 13/03/18
 * Time: 18:02
 */

namespace Mini\Core;

class Controller
{
    public $view = null;

    /**
     * Whenever controller is created, open a database connection too and load "the model".
     */
    function __construct()
    {
        $this->view = TemplatesFactory::templates();
        Session::init();
    }
}