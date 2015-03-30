<?php
echo $this->Form->create('Item');
echo $this->Form->input('query',array('label'=>'Search by movie title'));
echo $this->Form->end('Search');
?>
<?php $i=0;?>
<p> List of <?php echo $count; ?> item(s). </p>
<h4> <?php echo $this->Html->link('Add new Movie',
				array('controller' => 'items','action'=>'add'));  ?>
</h4>
<table>
	<tr>
		<tr>
			<th>S. No.</th>
			<th>Title</th>
			<th>Release Year</th>
			<th>Movie Length</th>
			<!--<th>Movie Description</th>-->
			<th> Actions </th>
		</tr>
		<tr>
			<?php foreach($items as $item):?>
			<td>
			<?php 
			$i+=1;
			echo h($i) 
			?>
			</td>
			<td>
			<?php echo $this->Html->link($item['Item']['title'],
				array('controller' => 'items','action'=>'view',$item['Item']['id']));  ?>
			</td>
			<td>
			<?php echo h($item['Item']['year']['year']); ?>
			</td>
			<td>
			<?php echo h($item['Item']['length'])." minutes"; ?>
			</td>
			<td>
			<?php echo $this->Html->link('Edit Details',
				array('controller' => 'items','action'=>'edit',$item['Item']['id']));?>
			<?php echo $this->Form->postLink('Delete',
				array('action' => 'delete',$item['Item']['id']),
				array('confirm'=>'Are you sure to delete movie - '.$item['Item']['title']));?>
			</td>
		</tr>
	</tr>
<?php endforeach;?>
<?php unset($item); ?>
</table>
