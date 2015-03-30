<?php $name=$genreinfo['Genre']['name']; ?>
<p> Information about <u><em><strong><?php echo $name; ?></strong></em></u> genre .</p>
<p> <?php echo $genreinfo['Genre']['description']; ?> </p>

<br><br>
<h2>&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Click <?php echo $this->Html->link('here',
				array('controller' => 'genres','action'=>'index'));  ?> to view all genres .</h2>
<p> List of movies in <?php echo $name; ?> genre :</p>
<?php $i=0; foreach($movies as $movie):?>
<p> <?php echo $i+=1; ?> : <?php echo $this->Html->link($movie['Item']['title'],
				array('controller' => 'items','action'=>'view',$movie['Item']['id']));  ?> </p>
<?php endforeach;?>