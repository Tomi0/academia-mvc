<?php

namespace Mini\Libs;

class Sesion
{
	public static function init()
	{
		if (session_id() == '') {
			session_start();
		}
	}

	public static function set($key, $value)
	{
		$_SESSION[$key] = $value;
	}

	public static function get($key)
	{
		if (isset($_SESSION[$key]) && $key != 'user') {
			return $_SESSION[$key];
		} else if (isset($_SESSION[$key]) && $key == 'user') {
		    return unserialize($_SESSION['user']);
        }
	}

	public static function actualizarDatosUsuario()
    {
        if (self::userIsLoggedIn()) {
            $user = self::get('user');
            $user->find($user->email);
            self::set('user', serialize($user));
        }
    }

	public static function add($key, $value)
	{
		$_SESSION[$key][] = $value;
	}

	public static function destroy()
	{
		session_destroy();
	}
	public static function userIsLoggedIn()
	{
		return (self::get('user_logged_in') ? true : false);
	}
}