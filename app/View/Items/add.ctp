<h1> Add new Movie in our database.</h1>

<?php
echo $this->Form->create('Item');
echo $this->Form->input('title',array(
	'label'=>'Movie Title'
	));
//echo $this->Form->input('year',array('options'=>array()));
echo $this->Form->input('year', array(
	'label'=>'Release Year',
     'type'=>'date',
     'dateFormat'=>'Y',
     //'selected'=>2010,
     'minYear'=>'1950',
     'maxYear'=>date('Y'),

));
echo $this->Form->input('genre_id',array(
	'label'=>'Movie Genre'
	));
echo $this->Form->input('length',array(
	'label'=>'Length of movie(in minutes)'
	));
echo $this->Form->input('description',array('rows' => '5'));
echo $this->Form->end('Save Movie');
?>