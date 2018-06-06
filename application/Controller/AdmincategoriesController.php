<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 6/06/18
 * Time: 19:40
 */

namespace Mini\Controller;


use Mini\Core\Controller;
use Mini\Libs\Sesion;
use Mini\Libs\Validaciones;
use Mini\Model\Category;

class AdmincategoriesController extends Controller
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
        $category = new Category();
        $allCategories = $category->all();

        echo $this->view->render('admin/category/index', ['categories' => $allCategories]);
        return;
    }

    public function create()
    {
        $category = new Category();
        $allCategories = $category->all();

        echo $this->view->render('admin/category/create', ['categories' => $allCategories]);
        return;
    }

    public function store()
    {
        if (!isset($_POST['name']) || !isset($_POST['category_id'])) {
            header('location: /admincategories/create');
            return;
        }

        $validaciones['name'] = Validaciones::validarNombreDefecto($_POST['name']);
        $validaciones['category_id'] = Validaciones::validarCategory_idCrearCategoria($_POST['category_id']);

        if ($_POST['category_id'] == "" || $validaciones['category_id'] === true) {
            if ($validaciones['name'] !== true) {
                $category = new Category();
                $allCategories = $category->all();

                unset($validaciones['category_id']);

                echo $this->view->render('admin/category/create', ['categories' => $allCategories, 'errors' => $validaciones]);
                return;
            } else {
                $category = new Category();
                $category->name = $_POST['name'];
                $category->category_id = $_POST['category_id'];

                $category->save();

                header('location: /admincategories');
            }
        } else {
            $category = new Category();
            $allCategories = $category->all();

            echo $this->view->render('admin/category/create', ['categories' => $allCategories, 'errors' => $validaciones]);
            return;
        }
    }

    public function delete($slug = null)
    {
        if (!isset($slug)) {
            header('location: /error');
            return;
        } else {
            $category = new Category();
            $category->find($slug);
        }

        if (isset($category->id)) {

            $category->delete();

            header('location: /admincategories');
            return;
        } else {
            header('location: /admincategories');
            return;
        }
    }

}