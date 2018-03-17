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
            TemplatesFactory::$templates->registerFunction(
                'borrar_msg_feedback', function(){
                Sesion::set('feedback_positive', null);
                Sesion::set('feedback_negative', null);
            });
        }
        return TemplatesFactory::$templates;
    }

}