<?php
	class ReviewsController extends AppController
	{
		public function view($id=null)
		{
			if(!$id || !$this->Review->exists($id))
			{
				return $this->Session->setFlash(__('Invalid movie review requested.'));
			}
			$rev=$this->Review->findById($id);
			$this->loadModel('Item');
			$this->loadModel('User');
			$is=$this->Item->find('first',array('conditions'=>array('id'=>$rev['Review']['item_id'])));
			$us=$this->User->find('first',array('conditions'=>array('id'=>$rev['Review']['owner_id'])));
			$this->set('movieinfo',$is);
			$this->set('userinfo',$us);
			$this->set('reviewinfo',$rev);
		}

		public function add($id=null)
		{
			$this->loadModel('Item');
			if(!$id || !$this->Item->exists($id))
			{
				return $this->Session->setFlash(__('Invalid movie requested to be reviewed.'));
			}
			if ($this->request->is('post')) 
			{
				$this->Review->create();
				$this->request->data['Review']['item_id']=$id;
				$this->request->data['Review']['owner_id']=AuthComponent::user('id');
				if($this->Review->save($this->request->data))
				{
					$this->Session->setFlash(__('Movie Review has been saved successfully.'));
					$this->redirect(array('controller'=>'items','action'=>'view',$id));
				}
				else
				{
					$this->Session->setFlash(__('Error while saving review.Please try again.'));
				}
			}
		}
	}
?>