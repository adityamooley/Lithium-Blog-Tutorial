<?php
namespace app\controllers;

use app\models\Comment;
use app\models\Post;

class CommentsController extends \lithium\action\Controller {
    public function add() {
        if ($this->request->data) {
            $comment = Comment::create($this->request->data);

            if ($comment->save()) {
                $this->redirect(array('controller' => 'posts', 'action' => 'view', 'args' => array($this->request->data['post_id'])));
            } else {
                $id = $this->request->data['post_id'];
                $post = Post::find($id)->to('array');
                $comments = Comment::find('all', array('conditions' => array('post_id' => $id, 'status' => 'live')));

                $comments = ($comments->count()) ? $comments->to('array') : $comments;

                $title = $post['title'];

                $this->render(array('template' => '../posts/view', 'data' => compact('post', 'comment', 'comments', 'id', 'title')));

                return;
            }
        } else {
            $this->redirect(array('controller' => 'posts', 'action' => 'index'));
        }
    }

}