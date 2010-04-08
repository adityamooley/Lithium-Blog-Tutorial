<?php
namespace app\controllers;
use app\models\Post;

class PostsController extends \lithium\action\Controller {

    public function index() {
        $page = 1;
        $limit = 5;
        $order = 'created desc';

        if (isset($this->request->params['page'])) {
            $page = $this->request->params['page'];

            if (!empty($this->request->params['limit'])) {
                $limit = $this->request->params['limit'];
            }
        }

        $offset = ($page - 1) * $limit;
        $total = Post::find('count');

        $posts = Post::find('all', compact('conditions', 'limit', 'offset', 'order'))->to('array');

        $title = 'Home';

        return compact('posts', 'limit', 'page', 'total', 'title');
    }

    public function view($id = null) {
        $post = Post::find($id);

        if (!$post) {
            throw new \Exception ('Invalid post if provided');
        }

        $post = $post->to('array');

        $title = $post['title'];

        return compact('post', 'id', 'title');
    }

    public function add() {
        if ($this->request->data) {
            // Create a post object and add the posted data to it
            $post = Post::create($this->request->data);
            if ($post->save()) {
                $this->redirect(array('action' => 'index'));
            }
        }

        if (empty($post)) {
            // Create an empty post object
            $post = Post::create();
        }

        $title = 'Add post';

        return compact('post', 'title');
    }

    public function edit($id = null) {
        $id = (int)$id;
        $post = Post::find($id);

        if (empty($post)) {
            $this->redirect(array('controller' => 'posts', 'action' => 'index'));
        }

        if ($this->request->data) {
            if ($post->save($this->request->data)) {
                $this->redirect(array('controller' => 'posts', 'action' => 'index'));
            }
        }

        $title = 'Edit post';

        return compact('post', 'title');
    }

    public function delete($id = null) {
        $id = (int)$id;

        $post = Post::find($id);

        if (empty($post)) {
            $this->redirect(array('controller' => 'posts', 'action' => 'index'));
        }

        if ($post->delete()) {
            //$this->redirect(array('controller' => 'posts', 'action' => 'index'));
        } else {
            //
        }
        $this->redirect(array('controller' => 'posts', 'action' => 'index'));

        return;
    }
}