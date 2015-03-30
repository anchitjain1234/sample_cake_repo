<?php
	App::uses('AppModel', 'Model');
	App::uses('AppModel', 'Model');
	App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');

	class User extends AppModel {

        public $validate=array(
            'firstname'=>array(
                'required'=>array(
                    'rule'=>'notEmpty',
                    'message'=>'Please enter your firstname'
                    )
                ),
                'email'=>array(
                    'isUnique'=>array(
                        'rule'=>array('checkemail'),
                        'message'=>'Entered email address is already registered.Please enter unique email'
                        ),
                    'email'=>array(
                        'rule'=>'email',
                        'message'=>'Please give a valid email address'
                        ),
                    'required'=>array(
                        'rule'=>'notEmpty',
                        'message'=>'Please enter your email addreess'
                        )
                ),
                'username'=>array(
                    'isUnique'=>array(
                        'rule'=>array('checkusername'),
                        'message'=>'Entered username is already registered.Please try new username'
                        ),
                    'required'=>array(
                        'rule'=>'notEmpty',
                        'message'=>'Please enter desired username',
                        
                        ),
                    'size'=>array(
                        'rule' => array('minLength', '8'),
                        'message' => 'Uesrname of minimum length of 8 characters is required'
                        )
                ),
                'password'=>array(
                    'required'=>array(
                        'rule'=>'notEmpty',
                        'message'=>'Please enter password',
                        
                        ),
                    'size'=>array(
                        'rule' => array('minLength', '8'),
                        'message' => 'Password of minimum length of 8 characters is required'
                        )
                    ),
                'password_repeat'=>array(
                    'required'=>array(
                        'rule'=>'notEmpty',
                        'message'=>'Please enter password',
                        
                        ),
                    'size'=>array(
                        'rule' => array('minLength', '8'),
                        'message' => 'Password of minimum length of 8 characters is required'
                        ),
                    'equal'=>array(
                        'rule'=>array('pwdequal'),
                        'message'=>"Passwords don't match"
                        )
                    )

            );
        
        /*
    public $validate = array(
        'firstname' => 'notEmpty',
        'email' => 'email',
        'username' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A username is required'
            )
        ),
        'password' => array(
            'required' => array(
                'rule' => array('minLength', '8'),
                'message' => 'Password of minimum length of 8 characters is required'
            )
        )
    );
*/
    public function pwdequal()
    {
        if($this->data[$this->alias]['password']===$this->data[$this->alias]['password_repeat'])
        {
            return true;
        }
        return false;
    }
    
    public function beforeSave($options = array()) 
    {

	    if (isset($this->data[$this->alias]['password']) && isset($this->data[$this->alias]['password_repeat'])) 
	    {
	        $passwordHasher = new BlowfishPasswordHasher();
	        $this->data[$this->alias]['password'] = $passwordHasher->hash
	        (
	            $this->data[$this->alias]['password']
	        );
            $this->data[$this->alias]['password_repeat'] = $passwordHasher->hash
            (
                $this->data[$this->alias]['password_repeat']
            );
	    }
        
	    return true;
	}
    
	public function checkemail()
	{
		return ($this->find('count', array('conditions' => array('email' => $this->data['User']['email']))) == 0);
	}

	public function checkusername()
	{
		return ($this->find('count', array('conditions' => array('username' => $this->data['User']['username']))) == 0);
	}

}

?>