
<h3><b><center><u><?php echo $item['Item']['title']; ?></u></center></b> </h3>
<p> Length : <?php echo $item['Item']['length']; ?> minutes </p>
<p> Genre : <?php echo $this->Html->link($genreinfo['Genre']['name'],
					array('controller' => 'genres','action'=>'view',$genreinfo['Genre']['id'])); ?>
<p> Added by : <?php echo $userinfo['User']['firstname']." ".$userinfo['User']['lastname']." ";
					 echo $this->Html->link($userinfo['User']['username'],
					array('controller' => 'users','action'=>'view',$userinfo['User']['id']));?>
					at <?php echo date('Y-m-d H:i:s', $item['Item']['created']->sec); ?></p>

<?php if($item['Item']['modified']!=$item['Item']['created']) echo "Modified at : ".date('Y-m-d H:i:s', $item['Item']['modified']->sec);?>
	<br><br>
<p> <?php echo $item['Item']['description']; ?> </p>
<br><br>
<?php echo $this->Html->link('Add your movie review here',
					array('controller' => 'reviews','action'=>'add',$item['Item']['id'])); ?>
<br><br>
<?php if($reviews): ?>
<p>Movie reviews added for the movie</p>
<table>
	<tr>
		<th> Title</th>
		<th>Review </th>
	</tr>
	<?php endif; ?>
	<tr>
		<?php foreach($reviews as $review):?>
		<td> <?php echo $this->Html->link(h($review['Review']['title']),
					array('controller' => 'reviews','action'=>'view',$review['Review']['id']));?></td>
		<td> <?php echo h($review['Review']['review']); ?></td>
	</tr>
</table>

<?php endforeach;?>
<?php unset($review); ?>