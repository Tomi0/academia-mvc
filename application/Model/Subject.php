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
    public $category;
    public $user_id;
    public $user;
    public $matricula;
    public $documents = [];

    public function __construct($slug = null)
    {
        parent::__construct();
        if (isset($slug)) {
            $this->find($slug);
        }
    }

    public function save()
    {
        if (isset($this->name) && isset($this->category_id) && isset($this->user_id) && isset($this->matricula)) {
            $sql = "INSERT INTO subjects(name,category_id,user_id, matricula) VALUES (:name, :category_id, :user_id, :matricula)";
            $query = $this->db->prepare($sql);
            $query->execute([':name' => $this->name, ':category_id' => $this->category_id, ':user_id' => $this->user_id, ':matricula' => $this->matricula]);

            $this->generateSlug();
        }
    }

    public function update()
    {
        if (isset($this->id) && isset($this->name) && isset($this->slug) && isset($this->category_id) && isset($this->user_id) && isset($this->matricula)) {
            $sql = "UPDATE subjects SET name = :name, slug=:slug, category_id=:category_id, user_id=:user_id, matricula=:matricula WHERE id=:id";
            $query = $this->db->prepare($sql);
            $params = [':name' => $this->name, ':slug' => $this->slug, ':category_id' => $this->category_id, ':user_id' => $this->user_id, ':matricula' => $this->matricula, ':id' => $this->id];
            $query->execute($params);
        }
    }

    public function delete()
    {
        if (isset($this->id)) {
            $sql = "DELETE FROM subjects WHERE id=:id";
            $query = $this->db->prepare($sql);
            $query->execute([':id' => $this->id]);

            return true;
        } else {
            return false;
        }
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
                $category = new Category();
                $category->findId($this->category_id);
                $this->category = $category;
                $this->user_id = $data[0]->user_id;
                $user = new User();
                $user->findId($this->user_id);
                $this->user = $user;
                $this->matricula = $data[0]->matricula;

                $this->getDocumentsArray();
            }
        }
    }

    public function findId($id)
    {
        if (isset($id)) {
            $sql = "SELECT * FROM subjects WHERE id=:id;";
            $query = $this->db->prepare($sql);
            $query->execute([':id' => $id]);

            $data = $query->fetchAll();

            if (isset($data[0])) {
                $this->id = $data[0]->id;
                $this->name = $data[0]->name;
                $this->slug = $data[0]->slug;
                $this->category_id = $data[0]->category_id;
                $category = new Category();
                $category->findId($this->category_id);
                $this->category = $category;
                $this->user_id = $data[0]->user_id;
                $user = new User();
                $user->findId($this->user_id);
                $this->user = $user;
                $this->matricula = $data[0]->matricula;

                $this->getDocumentsArray();
            }
        }
    }

    public function all()
    {
        $sql = "SELECT * FROM subjects;";
        $query = $this->db->prepare($sql);
        $query->execute();

        $data = $query->fetchAll();
        $all = [];

        if (isset($data)) {
            foreach ($data as $value) {
                $subj = new Subject($value->slug);
                $all[] = $subj;
            }

            return $all;
        } else {
            return null;
        }
    }

    public function getDocumentsArray()
    {
        if (isset($this->id)) {
            $sql = "SELECT * FROM documents WHERE subject_id=:subject_id;";
            $query = $this->db->prepare($sql);
            $query->execute([':subject_id' => $this->id]);

            $data = $query->fetchAll();

            $array = [];

            foreach ($data as $document) {
                $tmp = new Document($document->slug);
                $array[] = $tmp;
            }

            $this->documents = $array;
        }
    }

    public function generateSlug()
    {
        $sql = "SELECT id FROM subjects WHERE name=:name AND category_id=:category_id";
        $query = $this->db->prepare($sql);
        $query->execute([':name' => $this->name, ':category_id' => $this->category_id]);

        $data = $query->fetch();

        if (isset($data->id)) {
            $this->id = $data->id;
            $this->slug = strtolower($this->name) . '-' . $this->id;

            $sql = "UPDATE subjects SET slug=:slug WHERE id=:id";
            $query = $this->db->prepare($sql);
            $query->execute([':slug' => $this->slug, ':id' => $this->id]);
        }
    }
}