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
