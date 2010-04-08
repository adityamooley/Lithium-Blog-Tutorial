<?php
/**
 * Lithium: the most rad php framework
 *
 * @copyright     Copyright 2010, Union of RAD (http://union-of-rad.org)
 * @license       http://opensource.org/licenses/bsd-license.php The BSD License
 */
?>
<!doctype html>
<html>
<head>
	<?php echo $this->html->charset();?>
	<title>Blog > <?php echo $title; ?></title>
	<?php echo $this->html->style(array('lithium', 'debug')); ?>
	<?php echo $this->scripts(); ?>
	<?php echo $this->html->link('Icon', null, array('type' => 'icon')); ?>
</head>
<body class="app">
	<div id="container">
		<div id="header">
			<h1>My Blog</h1>
            <ul id="menu">
                <li><?=$this->html->link('Home', array('controller' => 'posts', 'action' => 'index')); ?></li>
                <li><?=$this->html->link('Add new post', array('controller' => 'posts', 'action' => 'add')); ?></li>
            </ul>
		</div>
		<div id="content">
			<?php echo $this->content(); ?>
		</div>
        <div id="footer">
            <p>
                Powered by <?php echo $this->html->link('Lithium', 'http://li3.rad-dev.org'); ?>.
            </p>
        </div>
	</div>
</body>
</html>