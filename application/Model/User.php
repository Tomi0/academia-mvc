<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 14/03/18
 * Time: 18:20
 */

namespace Mini\Model;


use Mini\Core\Model;

class User extends Model
{
    public $id;
    public $name;
    public $email;
    public $rol_id;
    public $rol;
    public $subjects;
    public $password;

    function __construct($userFind = null)
    {
        parent::__construct();

        if (isset($userFind)) {
            self::find($userFind);
        }
    }

    public function save($name, $email, $rol_id, $password)
    {
        if (isset($name) && isset($email) && isset($password)) {
            $sql = "INSERT INTO users(name,email,rol_id,password) VALUES (:name,:email,:rol_id,:password)";
            $query = $this->db->prepare($sql);
            $params = array(':name' => $name, ':email' => $email, ':rol_id' => $rol_id, ':password' => md5($password));
            $query->execute($params);

            $this->find($email);
        }
    }

    public function update($email)
    {
        if (isset($email)) {
            $sql = "UPDATE users SET name=:name, email=:email1,  rol_id=:rol_id, password=:password WHERE email=:email2";
            $query = $this->db->prepare($sql);
            $params = array(':name' => $this->name, ':email1' => $this->email, ':rol_id' => $this->rol_id, ':password' => $this->password, ':email2' => $email);
            $query->execute($params);
        }
    }

    public function all()
    {
        $sql = "SELECT * FROM users";
        $query = $this->db->prepare($sql);
        $query->execute();

        $data = $query->fetchAll();
        $return = [];

        foreach ($data as $user) {
            $temp = new User();
            $temp->find($user->email);
            $return[] = $temp;
        }

        return $return;
    }

    public function find($email)
    {
        if (isset($email)) {
            $sql = "SELECT * FROM users WHERE email=:email";
            $query = $this->db->prepare($sql);
            $params = array(':email' => $email);
            $query->execute($params);

            $data = $query->fetchAll();

            if (isset($data[0])) {
                $this->id = $data[0]->id;
                $this->name = $data[0]->name;
                $this->email = $data[0]->email;
                $this->rol_id = $data[0]->rol_id;
                $temp = new Rol();
                $temp->find($this->rol_id);
                $this->rol = $temp;
                $this->password = $data[0]->password;
            }

            $this->getSubjectsArray();
        }
    }

    public function findId($id)
    {
        if (isset($id)) {
            $sql = "SELECT * FROM users WHERE id=:id";
            $query = $this->db->prepare($sql);
            $params = array(':id' => $id);
            $query->execute($params);

            $data = $query->fetchAll();

            if (isset($data[0])) {
                $this->id = $data[0]->id;
                $this->name = $data[0]->name;
                $this->email = $data[0]->email;
                $this->rol_id = $data[0]->rol_id;
                $temp = new Rol();
                $temp->find($this->rol_id);
                $this->rol = $temp;
                $this->password = $data[0]->password;
            }

            $this->getSubjectsArray();
        }
    }

    public function delete()
    {
        if (isset($this->id)) {
            $sql = "DELETE FROM users WHERE id=:id";
            $query = $this->db->prepare($sql);
            $params = array(':id' => $this->id);
            $query->execute($params);
        }
    }

    public function getSubjectsArray()
    {
        $sql = "SELECT * FROM matriculas WHERE user_id=:id";
        $query = $this->db->prepare($sql);
        $query->execute(['id' => $this->id]);

        $data = $query->fetchAll();

        if (isset($data)) {
            $arraySubjects = [];

            foreach ($data as $value) {
                $subject = new Subject();
                $subject->findId($value->subject_id);

                $arraySubjects[] = $subject;
            }

            $this->subjects = $arraySubjects;
        }
    }

    public function matricular($subject)
    {
        if (isset($subject)) {
            $sql = 'INSERT INTO matriculas(subject_id,user_id) VALUES (:subject_id,:user_id)';
            $query = $this->db->prepare($sql);
            $query->execute(['subject_id' => $subject->id, 'user_id' => $this->id]);
        }
    }

    public function desmatricular($id)
    {
        if (isset($id)) {
            $sql = "DELETE FROM matriculas WHERE user_id=:user_id AND subject_id=:subject_id";
            $query = $this->db->prepare($sql);
            $query->execute([':user_id' => $this->id, 'subject_id' => $id]);
        }
    }

    public function comprobarEmail($email)
    {
        if (isset($email)){
            $sql = "SELECT * FROM users WHERE email=:email";
            $query = $this->db->prepare($sql);
            $params = array(':email' => $email);
            $query->execute($params);

            if (!$query->fetch()) {
                return false;
            } else {
                return true;
            }
        }

        return true;
    }

    public function comprobarEmailUpdate($email, $id)
    {
        if (isset($email)){
            $sql = "SELECT * FROM users WHERE email=:email";
            $query = $this->db->prepare($sql);
            $params = array(':email' => $email);
            $query->execute($params);

            $data = $query->fetch();

            if (!$data) {
                return false;
            } else if (isset($data->id) && $data->id == $id) {
                return false;
            } else {
                return true;
            }
        }

        return true;
    }

    public function getPassword($email)
    {
        $sql = "SELECT password FROM users WHERE email=:email";
        $query = $this->db->prepare($sql);
        $parameters = array(':email' => $email);
        $query->execute($parameters);

        $password = $query->fetch()->password;

        return $password;
    }

    public function __sleep()
    {
        return array('id', 'name', 'email', 'rol_id', 'rol', 'subjects', 'password');
    }

    public function __wakeup()
    {
        parent::__construct();
    }
}