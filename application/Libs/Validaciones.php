<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 20/12/17
 * Time: 20:42
 */

namespace Mini\Libs;

use Mini\Model\Category;
use Mini\Model\Rol;
use Mini\Model\User;

class Validaciones
{

    public static function validarDatosLogin($email, $password)
    {
        if (isset($email) && isset($password)) {
            if (filter_var($email, FILTER_VALIDATE_EMAIL) && self::validarPassword($password) === true) {
                return true;
            }
        }

        return false;
    }

    public static function validarRegistro($nombre, $email, $password1, $password2)
    {
        $msg['name'] = self::validarNombre($nombre);
        $msg['email'] = self::validarEmail($email);
        if ($password1 == $password2) {
            $msg['password'] = self::validarPassword($password1);
        } else {
            $msg['password'] = 'Las contraseñas no coinciden.';
        }


        foreach ($msg as $item) {
            if ($item !== true) {
                return $msg;
            }
        }

        return true;
    }

    public static function validarNombre($str)
    {
        $nombre = trim($str);
        if (isset($nombre) && $nombre != "") {
            if (self::comprobarLength(3,30,$nombre)) {
                if (preg_match("/^[A-ZÑÁÉÍÓÚ][a-zñáéíóú]+(\s[A-ZÑÁÉÍÓÚ][a-zñáéíóú]+)?$/", $nombre)) {
                    return true;
                } else {
                    return "El nombre no tiene un formato adecuado.";
                }
            } else {
                return "El nombre tiene que tener un minimo de 3 carácteres y un maximo de 30.";
            }
        } else {
            return "El campo nombre es obligatorio.";
        }
    }

    public static function validarEmail($str)
    {
        $email = trim($str);
        if (isset($email) && $email != "") {
            if (self::comprobarLength(5,50,$email)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $user = new User();

                    if ($user->comprobarEmail($email) === false) {
                        return true;
                    } else {
                        return "El email introducido ya se encuentra en uso.";
                    }
                } else {
                    return "El email no tiene un formato adecuado.";
                }
            } else {
                return "El email tienen que tener entre 5 y 50 carácteres.";
            }
        } else {
            return "El email es obligatorio.";
        }
    }

    public static function validarEmailUpdate($str, $id)
    {
        $email = trim($str);
        if (isset($email) && isset($id) && $email != "") {
            if (self::comprobarLength(5,50,$email)) {
                if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
                    $user = new User();

                    if ($user->comprobarEmailUpdate($email, $id) === false) {
                        return true;
                    } else {
                        return "El email introducido ya se encuentra en uso.";
                    }
                } else {
                    return "El email no tiene un formato adecuado.";
                }
            } else {
                return "El email tienen que tener entre 5 y 50 carácteres.";
            }
        } else {
            return "El email es obligatorio.";
        }
    }

    public static function validarPassword($str)
    {
        $password = trim($str);
        if (isset($password) && $password != "") {
            if (self::comprobarLength(6,16,$password)) {
                if (preg_match("/^[a-zA-Z0-9]+$/", $password)) {
                    return true;
                } else {
                    return "La contraseña tiene que tener minúsculas, mayúsculas y números.";
                }
            } else {
                return "La contraseña tiene que tener de 6 a 16 carácteres.";
            }
        } else {
            return "La contraseña es obligatoria.";
        }
    }

    public static function validarRol($str)
    {
        $rol = trim($str);

        if (isset($rol) && $rol != "") {
            if (self::comprobarLength(1,10,$rol)) {
                $temp = new Rol();
                $roles = $temp->all();

                foreach ($roles as $role) {
                    if ($role->id == $rol) return true;
                }

                // en el caso en el que el rol no esté en la base de datos
                return "Rol erroneo.";

            } else {
                return "Rol erroneo.";
            }
        } else {
            return "Es necesario introducir un rol.";
        }
    }

    public static function validarNombreDefecto($str)
    {
        $name = trim($str);

        if (isset($name) && $name != "") {
            if (self::comprobarLength(3,100,$name)) {
                if (preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+?$/", $name)) {
                    return true;
                } else {
                    return "El nombre no tiene un formato adecuado.";
                }
            } else {
                return "El nombre tiene que tener un minimo de 3 carácter y un maximo de 50.";
            }
        } else {
            return "El campo nombre es obligatorio.";
        }
    }

    public static function validarCategory_id($id) {
        if (isset($id)) {
            $cat = new Category();
            $cat->findId($id);
            if (isset($cat->id)) {
                return true;
            } else {
                return 'Error al introducir el campo.';
            }
        } else {
            return 'El campo es obligatorio.';
        }
    }

    public static function validarUser_id($id) {
        if (isset($id)) {
            $cat = new User();
            $cat->findId($id);
            if (isset($cat->id) && $cat->rol->name == 'profesor') {
                return true;
            } else {
                return 'Error al introducir el campo.';
            }
        } else {
            return 'El campo es obligatorio.';
        }
    }

    public static function validarNombreDocumento($str)
    {
        $name = trim($str);

        if (isset($name) && $name != "") {
            if (self::comprobarLength(1,30,$name)) {
                if (preg_match("/^[A-ZÑÁÉÍÓÚa-záéíóú0-9\s]+?$/", $name)) {
                    return true;
                } else {
                    return "El nombre no tiene un formato adecuado.";
                }
            } else {
                return "El nombre tiene que tener un minimo de 1 carácter y un maximo de 30.";
            }
        } else {
            return "El campo nombre es obligatorio.";
        }
    }

    public static function validarDescripcionDocumento($str)
    {
        $description = trim($str);

        if (isset($description) && $description != "") {
            if (self::comprobarLength(3,30,$description)) {
                if (preg_match("/^[a-zA-ZáéíóúÁÉÍÓÚäëïöüÄËÏÖÜàèìòùÀÈÌÒÙ\s]+?$/", $description)) {
                    return true;
                } else {
                    return "La descripción no tiene un formato adecuado.";
                }
            } else {
                return "La descripción tiene que tener un minimo de 3 carácteres y un maximo de 30.";
            }
        } else {
            return "El campo descripción es obligatorio.";
        }
    }

    public static function validarArchivo($archivo)
    {
        if (isset($archivo)) {
            if ($archivo['type'] == 'application/pdf') {
                if ($archivo['size'] < 199999 && $archivo > 0) {    // no se permite un archivo igual o superior a 2M
                    return true;
                } else {
                    return 'El archivo ocupa mucho espacio.';
                }
            } else {
                return 'El archivo no es un PDF.';
            }
        } else {
            return 'Es necesario subir un documento';
        }
    }

    public static function comprobarLength($min, $max, $str)
    {
        if (isset($min) && isset($max) && isset($str)) {
            if (strlen($str) >= $min && strlen($str) <= $max) {
                return true;
            }
        }
        return false;
    }
}