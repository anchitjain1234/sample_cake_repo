<h3><center>Add your movie review here.</center></h3>
<br><br>
<?php 
	echo $this->Form->create('Review');
	echo $this->Form->input('title',array(
	'label'=>'Review Title'
	));
	echo $this->Form->Input('review',array(
		'label'=>'Yoir moview review'));
	echo $this->Form->input('stars', array(
            'options' => array('1' => '1', '2' => '2','3'=>'3','4'=>'4','5'=>'5')
        ));
	echo $this->Form->end(__('Submit Review')); ?>