<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 13/03/18
 * Time: 17:49
 */

namespace Mini\Core;


class TemplatesFactory
{
    private static $templates;

    public static function templates()
    {

        if ( ! TemplatesFactory::$templates) {
            TemplatesFactory::$templates = new \League\Plates\Engine(APP . 'view');
            TemplatesFactory::$templates->addData(['titulo' => 'Mini3']);
        }
        return TemplatesFactory::$templates;
    }

}