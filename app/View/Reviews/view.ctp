<h2><center>Movie Review </center></h2>
	
<p><center>For <?php echo $this->Html->link($movieinfo['Item']['title'],
					array('controller' => 'items','action'=>'view',$movieinfo['Item']['id']));?></center></p>
<br><hr>
<p> BY : <?php echo $userinfo['User']['firstname']." ".$userinfo['User']['lastname']." ";
					 echo $this->Html->link($userinfo['User']['username'],
					array('controller' => 'users','action'=>'view',$userinfo['User']['id']));?>
					at <?php echo date('Y-m-d H:i:s', $reviewinfo['Review']['created']->sec); ?></p>
<p><?php if($reviewinfo['Review']['modified']->sec!==$reviewinfo['Review']['created']->sec) echo "Modified at : ".date('Y-m-d H:i:s', $reviewinfo['Review']['modified']->sec);?></p>

<br><hr>
<h3><center><?php echo $reviewinfo['Review']['title']?></center></h3>
<h4><?php echo $reviewinfo['Review']['review']?></h4>
<p>Verdict - <?php echo $reviewinfo['Review']['stars'] ?> stars </p>