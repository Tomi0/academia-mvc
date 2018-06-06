<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 16/05/18
 * Time: 13:24
 */

namespace Mini\Controller;


use Mini\Core\Controller;
use Mini\Libs\Sesion;
use Mini\Model\Category;

class CategoryController extends Controller
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
        $cat = new Category();
        $categories = $cat->whereNull('category_id');

        echo $this->view->render('category/index', ['categories' => $categories]);
        return;
    }

    public function show($category = null)
    {
        if (!isset($category))
        {
            header('location: /error');
            return;
        }

        $cat = new Category();
        $cat->find($category);

        // si no encuentra la categoria redirecciona a un error
        if (!isset($cat->id)) {
            header('location: /error');
        }

        if (count($cat->categories) === 0) {
            echo $this->view->render('category/show-subjects', ['category' => $cat]);
        } else {
            echo $this->view->render('category/show', ['category' => $cat]);
        }
    }

}