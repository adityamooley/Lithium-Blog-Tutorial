<?php foreach($posts as $post): ?>

<article>
    <h1><?= $this->html->link($post['title'], 'posts/view/'.$post['id']); ?></h1>
    <p><?=$this->html->link('Edit', array('controller' => 'posts', 'action' => 'edit', 'args' => array($post['id']))); ?></p>
    <p><?=$post['body'] ?></p>
</article>
<?php endforeach; ?>
<div id="pagination">
    <p class="next floated"><?php
        if ($total <= $limit || $page == 1) {
            //echo '<li>Next Entries &rarr;';
        } else {
            echo $this->html->link('Next Entries &rarr;', array(
                'controller' => 'posts', 'action' => 'index',
                 'page' => $page - 1, 'limit' => $limit
            ), array('escape' => false));

        } ?>
    </p>
    <p class="prev"><?php
        if ($total <= $limit || $page == ceil($total/$limit)) {
            //echo '&larr; Previous Entries</li>';
        } else {
            echo $this->html->link('&larr; Previous Entries', array(
                'controller' => 'posts', 'action' => 'index',
                'page' => $page + 1, 'limit' => $limit
            ), array('escape' => false));
        }?>
    </p>
</div>