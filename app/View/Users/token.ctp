<h3> Enter your new password here.</h3>
<?php echo $this->Form->create('User'); ?>
<?php echo $this->Form->input('password',array(
	  	'label'=>'Your new password :',
	  	'autocomplete'=>'off'
	  	));
		echo $this->Form->input('password_repeat',array(
	  	'label'=>'Confirm password :',
	  	'type'=>'password',
	  	'value'=>'', 'autocomplete'=>'off'
	  	));
      echo $this->Form->end(__('Save new password')); ?>