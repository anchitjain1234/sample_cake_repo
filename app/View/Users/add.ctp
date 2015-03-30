<h3>Please Sign Up to view amazing content present on our website.</h3>
<p>To Sign Up please enter following data.</p>
<?php echo $this->Form->create('User'); ?>
<?php echo $this->Form->input('firstname',array(
	  	'label'=>'Your Firstname:'));
	  echo $this->Form->input('lastname',array(
	  	'label'=>'Your Lastname(Optional) :'
	  	));
	  echo $this->Form->input('username',array(
	  	'label'=>'Your desired username (minimum 8 characters long) :'
	  	));
	  echo $this->Form->input('email',array(
	  	'label'=>'Your Primary Email address :'
	  	));
      echo $this->Form->input('password',array(
	  	'label'=>'Enter password(minimum 8 characters long) :'
	  	));?>
<?php echo $this->Form->end(__('Sign Up')); ?>
