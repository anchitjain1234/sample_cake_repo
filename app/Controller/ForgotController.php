<?php
	App::uses('AppController', 'Controller');
    App::uses('CakeEmail', 'Network/Email');
	class ForgotController extends AppController
	{
		public function beforeFilter() 
	    {
	        parent::beforeFilter();
	        $this->Auth->allow('verify');
	    }

	    public function verify()
	    {
	    	if($this->request->is('Post'))
	    	{
	    		
	    		$usernameentered=$this->request->data['Forgot']['username'];
	    		$this->loadModel('User');
	    		$userinfo=$this->User->find('first',array('conditions'=>array('username'=>$usernameentered)));
	    		if(!$userinfo)
	    		{
	    			return $this->Session->setFlash(__('No user with entered username.'));
	    		}
	    		$ck=$this->Forgot->find('first',array('conditions'=>array('username'=>$userinfo['User']['username'])));
	    		if(!$ck)
	    		{
	    			$h=str_shuffle(hash("sha512",(hash("sha256",$userinfo['User']['email'].$userinfo['User']['username'])).strval(time()).md5(rand()).md5($userinfo['User']['password'])));
	    			$this->Forgot->create();
	                $data=array(
	                    'Forgot'=>array(
	                        'username'=>$userinfo['User']['username'],
	                        'token'=>$h
	                        )
	                    );
	                $this->Forgot->save($data);
	                $link="http://localhost/test-pr/users/token?token=".$h."&username=".$userinfo['User']['username'];
	                $message='You clicked on forgot password link.Please click  <a href="'.$link.'">here</a> to change your password.<br> If this link does not works please copy paste below link into your browser<br><br>'.$link;
	                
	                $this->sendemail($userinfo['User']['email'],'Forgot password',$message);
	                $this->Session->setFlash(__('Please check your mailbox.(Dont forget to check your SPAM.)'));
	                return $this->redirect(array('controller'=>'users','action' => 'login'));
	    		}
	    		else
	    		{
	    			$link="http://localhost/test-pr/users/token?token=".$ck['Forgot']['token']."&username=".$userinfo['User']['username'];
	                $message='You clicked on forgot password link.Please click  <a href="'.$link.'">here</a> to change your password.<br> If this link does not works please copy paste below link into your browser<br><br>'.$link;
	    			$this->sendemail($userinfo['User']['email'],'Forgot password',$message);
	    			$this->Session->setFlash(__('Please check your mailbox.(Dont forget to check your SPAM.)'));
	                return $this->redirect(array('controller'=>'users','action' => 'login'));
	    		}
	    	}
	    }

	    
	}
?>