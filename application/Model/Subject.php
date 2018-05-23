<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 16/05/18
 * Time: 15:52
 */

namespace Mini\Model;


use Mini\Core\Model;

class Subject extends Model
{
    public $id;
    public $name;
    public $slug;
    public $category_id;
    public $user_id;
    public $matricula;
    public $documents = [];

    public function __construct()
    {
        parent::__construct();
    }

    public function find($slug)
    {
        if (isset($slug)) {
            $sql = "SELECT * FROM subjects WHERE slug=:slug;";
            $query = $this->db->prepare($sql);
            $query->execute([':slug' => $slug]);

            $data = $query->fetchAll();

            if (isset($data[0])) {
                $this->id = $data[0]->id;
                $this->name = $data[0]->name;
                $this->slug = $data[0]->slug;
                $this->category_id = $data[0]->category_id;
                $this->user_id = $data[0]->user_id;
                $this->matricula = $data[0]->matricula;
            }
        }
    }

}