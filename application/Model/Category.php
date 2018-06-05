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
    public $categories = [];
    public $subjects = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $sql = 'SELECT * FROM categories;';
        $query = $this->db->prepare($sql);
        $query->execute();

        return $query->fetchAll();
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

                $this->getCategoriesArray();
                $this->getSubjectsArray();
            }
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
}