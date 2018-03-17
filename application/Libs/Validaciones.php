<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 20/12/17
 * Time: 20:42
 */

namespace Mini\Libs;

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