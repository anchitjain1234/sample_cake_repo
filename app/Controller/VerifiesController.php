<?php
	class VerifiesController extends AppController
	{

		public function beforeFilter() 
	    {
	        parent::beforeFilter();
	        $this->Auth->allow('index', 'token');
	    }

		public function index()
		{
			$this->redirect(array('controller'=>'verifies','action'=>'token'));
		}
		public function token()
		{
			if (isset($this->params['url']['token']) && isset($this->params['url']['username'])) 
			{
				$token=$this->params['url']['token'];
				$username=$this->params['url']['username'];
			}
			else
			{
				$this->Session->setFlash(__('Invalid request.'));
				$this->redirect(array('controller'=>'users','action'=>'login'));
			}

			$p=array(
				'conditions'=>array(
					'username'=>$username,
					'token'=>$token
					),
				'fields'=>array('id')
				);
			$verid=$this->Verify->find('all',$p);
			if ($verid) 
			{
				$this->Verify->id=$verid['0']['Verify']['id'];
				$this->Verify->delete();
				$this->Session->setFlash(__('Your email id has been verified.Please login to proceed.'));
				$this->redirect(array('controller'=>'users','action'=>'login'));
			}
			else
			{
				$this->Session->setFlash(__('Invalid verification request or your email has been already verified.'));
				$this->redirect(array('controller'=>'users','action'=>'login'));
			}
		}
	}
?>