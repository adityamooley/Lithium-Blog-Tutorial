<?php if (isset($success) && $success): ?>
    <p>Post Successfully Saved</p>
<?php else: ?>

<?=$this->form->create($post, array('method' => 'post')); ?>
    <?=$this->form->hidden('id'); ?>
    <?=$this->form->field('title');?>
    <?=$this->form->field('body', array('type' => 'textarea'));?>
    <?=$this->form->submit('Add Post'); ?>
<?=$this->form->end(); ?>
<?php endif; ?>