<h2>Edit Movie details</h2>

<?php
echo $this->Form->create('Item');
echo $this->Form->input('title');
echo $this->Form->input('year',array(
     'type'=>'date',
     'dateFormat'=>'Y',
     'minYear'=>'1950',
     'maxYear'=>date('Y'),
));
echo $this->Form->input('genre_id');
echo $this->Form->input('length',array(
	'label'=>'Length of movie(in minutes)'
	));
echo $this->Form->input('description',array('rows' => '5'));
echo $this->Form->input('id',array('type' => 'hidden'));
echo $this->Form->end('Update Movie Details');
?>