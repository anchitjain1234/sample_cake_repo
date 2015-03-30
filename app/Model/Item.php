<?php
	class Item extends AppModel{
		public $belongsTo='Genre';
	
		public $validate=array(
			'title'=>'notEmpty',
			
			'length'=>array(
				'rule'=>'numeric',
				'message'=>'Length should be a valid numeral representig movie length in minutes.'
				)
			);	


	}
?>
