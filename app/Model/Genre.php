<?php
	class Genre extends AppModel{
		//public $hasMany='Item';

		public $hasMany=array(
			'Item'=>array(
				'className' => 'Item',
				'foreignKey' => 'genre_id'
				)
			);
		public $displayField='name';

		public $validate=array(
			'name' => 'notEmpty'
			);
	}
?>