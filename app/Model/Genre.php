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
	public $actsAs = array(
    'Sitemap.Sitemap' => array(
        'primaryKey' => 'id', //Default primary key field
        'loc' => 'buildUrl', //Default function called that builds a url, passes parameters (Model $Model, $primaryKey)
        'lastmod' => 'modified', //Default last modified field, can be set to FALSE if no field for this
        'changefreq' => 'daily', //Default change frequency applied to all model items of this type, can be set to FALSE to pass no value
        'priority' => '0.9', //Default priority applied to all model items of this type, can be set to FALSE to pass no value
        'conditions' => array(), //Conditions to limit or control the returned results for the sitemap
    )
);
	}
	
?>