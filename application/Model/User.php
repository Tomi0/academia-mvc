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
    function __construct()
    {
        parent::__construct();
    }

    public function save($name, $email, $password)
    {

        if (isset($name) && isset($email) && isset($password)) {
            $sql = "INSERT INTO users(name,email,password) VALUES (:name,:email,:password)";
            $query = $this->db->prepare($sql);
            $params = array(':name' => $name, ':email' => $email, ':password' => md5($password));
            $query->execute($params);

            return true;
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

    public function getPassword($email)
    {
        $sql = "SELECT password FROM users WHERE email=:email";
        $query = $this->db->prepare($sql);
        $parameters = array(':email' => $email);
        $query->execute($parameters);

        $password = $query->fetch()->password;

        return $password;
    }
}