<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 13/03/18
 * Time: 17:49
 */

namespace Mini\Core;

use Mini\Libs\Sesion;

class TemplatesFactory
{
    private static $templates;

    public static function templates()
    {

        if ( ! TemplatesFactory::$templates) {
            TemplatesFactory::$templates = new \League\Plates\Engine(APP . 'view');
        }
        return TemplatesFactory::$templates;
    }

}