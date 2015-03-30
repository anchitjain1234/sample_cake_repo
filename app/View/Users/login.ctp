<h3>Please Login.</h3>
<h2><?php echo $this->Html->link('Sign Up',
				array('controller' => 'users','action'=>'add'));  ?></h2>
<?php echo $this->Form->create('User'); ?>
<?php echo $this->Form->input('username',array(
	  	'label'=>'Your username :'
	  	));
      echo $this->Form->input('password',array(
	  	'label'=>'Your password :'
	  	));?>
<?php echo $this->Form->end(__('Login')); ?>

<?php echo $this->Html->link('Forgot password',array('controller'=>'forgot','action'=>'verify')); ?>