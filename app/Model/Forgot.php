<?php
	App::uses('AppModel', 'Model');
	App::uses('AppModel', 'Model');
	App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
	class Forgot extends AppModel
	{
		public $validate=array(
			'username'=>array(
				'required'=>array(
                    'rule'=>'notEmpty',
                    'message'=>'Please enter your registered username'
                    )
				),
			'password' => array(
    			'length' => array(
        			'rule'      => array('between', 8, 40),
        			'message'   => 'Your password must be between 8 and 40 characters.',
   					),
				)
			);
	

	public function validate_passwords() 
	{
    	return $this->data[$this->alias]['password'] === $this->data[$this->alias]['password_repeat'];
	}
	
	public function beforeSave($options = array()) 
    {

	    if (isset($this->data[$this->alias]['password'])) 
	    {
	        $passwordHasher = new BlowfishPasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash
	        (
	            $this->data[$this->alias]['password']
	        );
	    }
	    return true;
	}
	
	
}

	
	
?>