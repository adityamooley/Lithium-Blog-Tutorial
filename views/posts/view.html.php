<article>
    <h1><?= $post['title']; ?></h1>
    <p>
        <?=$this->html->link('Delete', array('controller' => 'posts', 'action' => 'delete', 'args' => array($post['id'])), array('onclick' => 'return confirm("Do you really want to delete this post?")')); ?>
    </p>
    <p><?php echo nl2br($post['body']); ?></p>
</article>