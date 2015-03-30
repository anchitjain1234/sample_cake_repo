<h3>Enter your registered username here</h3>
<?php echo $this->Form->create('Forgot'); ?>
<?php echo $this->Form->input('username',array(
	  	'label'=>'Your registered username :'
	  	));
      echo $this->Form->end(__('Verify username')); ?>