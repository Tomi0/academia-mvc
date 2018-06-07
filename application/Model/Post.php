<?php
/**
 * Created by PhpStorm.
 * User: tomi
 * Date: 7/06/18
 * Time: 17:50
 */

namespace Mini\Model;


use Mini\Core\Model;

class Post extends Model
{
    public $id;
    public $title;
    public $slug;
    public $contenido;
    public $document_id;
    public $document;
    public $subject_id;
    public $subject;
    public $post_id;
    public $post;
    public $user_id;
    public $user;

    public function __construct($slug = null)
    {
        parent::__construct();
        if (isset($slug)) {
            $this->find($slug);
        }
    }

    public function find($slug)
    {
        if (isset($slug)) {

        }
    }
}