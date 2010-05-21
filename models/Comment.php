<?php
namespace app\models;

use \lithium\util\Validator;

class Comment extends \lithium\data\Model {
    public $belongsTo = array('Post');

    public $validates = array(
                         'name' => array(
                                    array('notEmpty', 'message' => 'Name cannot be empty'),
                                    array('validName', 'message' => 'Please enter valid name'),
                                   ),
                         'email' => array(
                                     array('notEmpty', 'message' => 'Email cannot be empty'),
                                     array('email', 'message' => 'Please enter valid email'),
                                    ),
                         'url' => array('url', 'skipEmpty' => true, 'message' => 'Enter valid website link'),
                         'body' => array('notEmpty', 'message' => 'Comment cannot be empty'),
                        );

    public static function __init(array $options = array()) {
        parent::__init($options);
        $self = static::_instance();

        Comment::applyFilter('save', function($self, $params, $chain) {
            $comment = $params['record'];

            if (!$comment->id) {
                $comment->created = date('Y-m-d h:i:s');
            } else {
                $comment->modified = date('Y-m-d h:i:s');
            }

            $params['record'] = $comment;

            return $chain->next($self, $params, $chain);
        });

        Validator::add('validName', '/^[A-Za-z0-9\'\s]+$/');
    }
}