<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 30/05/18
 * Time: 17:26
 */

namespace Mini\Model;


use Mini\Core\Model;

class Document extends Model
{
    public $id;
    public $name;
    public $description;
    public $slug;
    public $url;
    public $subject_id;
    public $subject;

    public function __construct($slug = null)
    {
        parent::__construct();

        if (isset($slug)) {
            $this->find($slug);
        }
    }

    public function save($name, $description, $slug, $url, $subject_id)
    {
        if (isset($name) && isset($description) && isset($slug) && isset($url) && isset($subject_id)) {
            $sql = 'INSERT INTO documents(name,description,slug,url,subject_id) VALUES (:name,:description,:slug,:url,:subject_id)';
            $query = $this->db->prepare($sql);
            $query->execute([':name' => $name, ':description' => $description, ':slug' => $slug, ':url' => $url, ':subject_id' => $subject_id]);
        }
    }

    public function all()
    {
        $sql = "SELECT * FROM documents;";
        $query = $this->db->prepare($sql);
        $query->execute();

        $data = $query->fetchAll();

        if (isset($data)) {
            $all = [];

            foreach ($data as $document) {
                $doc = new Document($document->slug);
                $all[] = $doc;
            }

            return $all;
        }
    }

    public function find($slug)
    {
        if (isset($slug)) {
            $sql = "SELECT * FROM documents WHERE slug = :slug;";
            $query = $this->db->prepare($sql);
            $query->execute([':slug' => $slug]);

            $data = $query->fetch();

            if (isset($data)) {
                $this->id = $data->id;
                $this->name = $data->name;
                $this->description = $data->description;
                $this->slug = $data->slug;
                $this->url = $data->url;
                $this->subject_id = $data->subject_id;
            }
        }
    }

    public function getSubject()
    {
        if (isset($this->subject_id)) {
            $sql = "SELECT * FROM subjects WHERE id = :subject_id;";
            $query = $this->db->prepare($sql);
            $query->execute([':subject_id' => $this->subject_id]);

            $subj = $query->fetch();

            if (isset($subj)) {
                return new Subject($subj->slug);
            }
        }

        return false;
    }

    public function delete()
    {
        if (isset($this->id)) {
            $sql = "DELETE FROM documents WHERE id=:id";
            $query = $this->db->prepare($sql);
            $params = array(':id' => $this->id);
            $query->execute($params);
        }
    }

    public function __sleep()
    {
        return array('id', 'name', 'description', 'slug', 'url', 'subject_id', 'subject');
    }

    public function __wakeup()
    {
        parent::__construct();
    }
}