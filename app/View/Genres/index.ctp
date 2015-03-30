<p>List of Genres with number of movies present. </p>
<?php $i=0; foreach($genres as $genre):?>
<table>
<tr>
	<tr>
		<th> S. No.</th>
		<th>Name</th>
		<th>Number of movies</th>
	</tr>
	<tr>
		<td> <?php echo $i+=1; ?></td>
		<td> <?php echo $this->Html->link($genre['Genre']['name'],
				array('controller' => 'genres','action'=>'view',$genre['Genre']['id']));
				?></td>
		<td><?php echo $genre['Genre']['total']; ?></td>
	</tr>
</tr>
</table>
<?php endforeach;?>