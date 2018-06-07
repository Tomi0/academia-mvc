<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 16/05/18
 * Time: 13:30
 */

namespace Mini\Model;


use Mini\Core\Model;

class Category extends Model
{

    public $id;
    public $name;
    public $slug;
    public $category_id;
    public $category;
    public $categories = [];
    public $subjects = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function save()
    {
        if (isset($this->name) && isset($this->category_id)) {
            $sql = "INSERT INTO categories(name,category_id) VALUES (:name,:category_id)";
            $query = $this->db->prepare($sql);
            $query->execute([':name' => $this->name, ':category_id' => $this->category_id == "" ? null : $this->category_id]);

            if ($this->category_id == "") {
                 $this->generateSlugSinCategory();
            } else {
                $this->generateSlug();
            }
        }
    }

    private function generateSlug()
    {
        if (isset($this->name) && isset($this->category_id)) {
            $sql = "SELECT id FROM categories WHERE name=:name AND category_id=:category_id";
            $query = $this->db->prepare($sql);
            $query->execute([':name' => $this->name, ':category_id' => $this->category_id]);

            $data = $query->fetch();

            if (isset($data)) {
                $this->id = $data->id;
                $this->slug = strtolower(str_replace(' ','-', $this->name)) . '-' . $this->id;

                $sql = "UPDATE categories SET slug=:slug WHERE id=:id";
                $query = $this->db->prepare($sql);
                $query->execute([':slug' => $this->slug, ':id' => $this->id]);
            }
        }
    }

    private function generateSlugSinCategory()
    {
        if (isset($this->name) && isset($this->category_id)) {
            $sql = "SELECT id FROM categories WHERE name=:name AND category_id IS NULL";
            $query = $this->db->prepare($sql);
            $query->execute([':name' => $this->name]);

            $data = $query->fetch();

            if (isset($data)) {
                $this->id = $data->id;
                $this->slug = strtolower(str_replace(' ','-', $this->name)) . '-' . $this->id;

                $sql = "UPDATE categories SET slug=:slug WHERE id=:id";
                $query = $this->db->prepare($sql);
                $query->execute([':slug' => $this->slug, ':id' => $this->id]);
            }
        }
    }

    public function all()
    {
        $sql = 'SELECT * FROM categories;';
        $query = $this->db->prepare($sql);
        $query->execute();

        $data = $query->fetchAll();

        if (isset($data)) {
            $all = [];
            foreach ($data as $value) {

                $aux = new Category();
                $aux->findId($value->id);

                $all[] = $aux;
            }

            return $all;
        }
    }

    public function whereNull($column)
    {
        $sql = "SELECT * FROM categories WHERE $column IS NULL;";
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
    }

    public function find($slug)
    {
        if (isset($slug)) {
            $sql = 'SELECT * FROM categories WHERE slug=:slug;';
            $query = $this->db->prepare($sql);
            $params = array(':slug' => $slug);
            $query->execute($params);

            $data = $query->fetchAll();

            if (isset($data[0])) {
                $this->id = $data[0]->id;
                $this->name = $data[0]->name;
                $this->slug = $data[0]->slug;
                $this->category_id = $data[0]->category_id;
                $cate = new Category();
                $cate->findId($this->category_id);
                $this->category = $cate;

                $this->getCategoriesArray();
                $this->getSubjectsArray();
            }
        }
    }

    public function findId($id)
    {
        if (isset($id)) {
            $sql = 'SELECT * FROM categories WHERE id=:id;';
            $query = $this->db->prepare($sql);
            $params = array(':id' => $id);
            $query->execute($params);

            $data = $query->fetchAll();

            if (isset($data[0])) {
                $this->id = $data[0]->id;
                $this->name = $data[0]->name;
                $this->slug = $data[0]->slug;
                $this->category_id = $data[0]->category_id;
                $cate = new Category();
                $cate->findId($this->category_id);
                $this->category = $cate;

                $this->getCategoriesArray();
                $this->getSubjectsArray();
            }
        }
    }

    public function delete()
    {
        if (isset($this->id)) {
            $sql = "DELETE FROM categories WHERE id=:id OR category_id=:category_id";
            $query = $this->db->prepare($sql);
            $query->execute([':id' => $this->id, ':category_id' => $this->id]);
        }
    }

    private function getCategoriesArray()
    {
        $sql = 'SELECT * FROM categories WHERE category_id=:id;';
        $query = $this->db->prepare($sql);
        $params = array(':id' => $this->id);
        $query->execute($params);

        $data = $query->fetchAll();

        if (isset($data)) {
            $this->categories = $data;
        }
    }

    private function getSubjectsArray()
    {
        $sql = 'SELECT * FROM subjects WHERE category_id=:id;';
        $query = $this->db->prepare($sql);
        $params = array(':id' => $this->id);
        $query->execute($params);

        $data = $query->fetchAll();

        if (isset($data)) {
            $this->subjects = $data;
        }
    }

    public function __sleep()
    {
        return array('id', 'name', 'slug', 'category_id', 'category', 'categories', 'subjects');
    }

    public function __wakeup()
    {
        parent::__construct();
    }
}