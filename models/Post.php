<?php

namespace app\models;

use \lithium\util\Validator;
use \lithium\data\Connections;

class Post extends \lithium\data\Model {
    public $validates = array(
                             'title' => array(
                                         array('notEmpty', 'message' => 'Title cannot be empty'),
                                         array('isUniqueTitle', 'message' => 'Title must be unique'),
                                        ),
                             'body' => 'Please enter some content for this post',
                            );

    public static function __init(array $options = array()) {
        parent::__init($options);
        $self = static::_instance();

        $self->_finders['count'] = function($self, $params, $chain) use (&$query, &$classes) {
            $db = Connections::get($self::meta('connection'));
            $records = $db->read('SELECT count(*) as count FROM posts', array('return' => 'array'));

            return $records[0]['count'];
        };

        Post::applyFilter('save', function($self, $params, $chain) {
            $post = $params['record'];

            if (!$post->id) {
                $post->created = date('Y-m-d H:i:s');
            } else {
                $post->modified = date('Y-m-d H:i:s');
            }

            $params['record'] = $post;

            return $chain->next($self, $params, $chain);
        });

        Validator::add('isUniqueTitle', function ($value, $format, $options) {
            $conditions = array('title' => $value);

            // If editing the post, skip the current psot
            if (isset($options['values']['id'])) {
                $conditions[] = 'id != ' . $options['values']['id'];
            }

            // Lookup for posts with same title
            return !Post::find('first', array('conditions' => $conditions));
        });
    }
}