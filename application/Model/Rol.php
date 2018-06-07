<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 28/05/18
 * Time: 19:24
 */

namespace Mini\Model;


use Mini\Core\Model;

class Rol extends Model
{
    public $id;
    public $name;

    public function __construct()
    {
        parent::__construct();
    }

    public function all()
    {
        $sql = "SELECT * FROM roles";
        $query = $this->db->prepare($sql);
        $query->execute();

        $data = $query->fetchAll();
        $return = [];

        foreach ($data as $rol) {
            $temp = new Rol();
            $temp->find($rol->id);
            $return[] = $temp;
        }

        return $return;
    }

    public function find($id)
    {
        if (isset($id)) {
            $sql = "SELECT * FROM roles WHERE id=:id";
            $query = $this->db->prepare($sql);
            $query->execute([':id' => $id]);

            $data = $query->fetch();

            if (isset($data) && count($data) > 0) {
                $this->id = $data->id;
                $this->name = $data->name;
            }
        }
    }

    public function __sleep()
    {
        return array('id', 'name');
    }

    public function __wakeup()
    {
        parent::__construct();
    }
}