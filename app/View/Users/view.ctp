<?php $name=$userinfo['User']['firstname']." ".$userinfo['User']['lastname']; ?>
<p> Information about user <u><em><strong><?php echo $userinfo['User']['username']; ?></strong></em></u>     	<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click <?php echo $this->Html->link('here',
				array('controller' => 'users','action'=>'index'));  ?> to view all profiles.</h2> </p>
<p> Full Name :- <?php echo $name; ?> </p>
<p> Email id :- <a href="mailto:<?php echo $userinfo['User']['email']; ?>"><?php echo $userinfo['User']['email']; ?></a></p>

<br><br>
<p> List of movies added by <?php echo $name; ?> </p>
<?php $i=0; foreach($movies as $movie):?>
<p> <?php echo $i+=1; ?> : <?php echo $this->Html->link($movie['Item']['title'],
				array('controller' => 'items','action'=>'view',$movie['Item']['id']));  ?> </p>
<?php endforeach;?>
