<?php
	class Review extends AppModel
	{
		public $validate=array(
			'title'=>array(
				'notempty'=>array(
					'rule'=>'notEmpty',
					'message'=>'Title can not be empty'
					)
				),
			'review'=>array(
				'notempty'=>array(
					'rule'=>'notEmpty',
					'message'=>'Review can not be empty'
					)
				),
			);
	
	}
	
?>