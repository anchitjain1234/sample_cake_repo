<p>List of current registered users on our website </p>
<?php $i=0; foreach($users as $user):?>
<p> <?php echo $i+=1; ?> : <?php echo $this->Html->link($user['User']['username'],
				array('controller' => 'users','action'=>'view',$user['User']['id']));  ?> </p>
<?php endforeach;?>