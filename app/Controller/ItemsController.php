<?php
	class ItemsController extends AppController{
		public $components=array('Session');
		public function beforeFilter() 
	    {
	        parent::beforeFilter();
	        $this->Auth->allow('search');
	    }
		public function index()
		{
			//$data=$this->Item->find('all',array('fields'=>'title','ids'));
			$params = array(
			//'fields' => array('title', 'description', 'year'),
			//'fields' => array('Post.title', ),
			//'conditions' => array('title' => 'hehe'),
			//'conditions' => array('hoge' => array('$gt' => '10', '$lt' => '34')),
			//'order' => array('title' => 1, 'body' => 1),
			'order' => array('year' => -1),
			'limit' => 35,
			'page' => 1,
				);
			//$params=$array(
			//	'order'=>array('tite' => 1)
			//	);
			$data=$this->Item->find('all',$params);
			$count=count($data);
			$this->set('items',$data);
			$this->Set('count',$count);

			if ($this->request->is('post'))
			{
				return $this->redirect('search/'.$this->request->data['Item']['query']);
			}
		}

		public function view($id=NULL)
		{
			if(!$id)
			{
				echo "here1";
				throw new NotFoundException(__("Invalid Movie")); 
			}
			$data=$this->Item->findById($id);

			if(!$data)
			{
				echo "here2";
				throw new NotFoundException(__("Invalid Movie"));
			}
			$this->loadModel('User');
			$this->loadModel('Genre');
			$this->set('item',$data); 
			$params = array(
			'fields' => array('firstname', 'lastname', 'username','id'),
			'conditions' => array('id' => $data['Item']['owner_id']),
			);
			$dr=$this->User->find('first',$params);
			$gr=$this->Genre->find('first',array('fields'=>array('name','id'),'conditions'=>array('id'=>$data['Item']['genre_id'])));
			$this->set('userinfo',$dr);
			$this->set('genreinfo',$gr);
			$this->loadModel('Review');
			$rr=$this->Review->find('all',array('conditions'=>array('item_id'=>$data['Item']['id'])));
			$this->set('reviews',$rr);
		}

		public function add()
		{
			if ($this->request->is('post')) 
			{
				$this->Item->create();
				$this->request->data['Item']['owner_id']=AuthComponent::user('id');
				if($this->Item->save($this->request->data))
				{
					$this->loadModel('Genre');
					$this->Genre->id=$this->request->data['Item']['genre_id'];
					print_r($this->Genre->id);
					print_r($this->request->data['Item']['genre_id']);
					$params=array(
						'conditions' => array('id' => $this->request->data['Item']['genre_id']),
						'fields'=>array('total')
						);
					$total=$this->Genre->find('all',$params);
					//print_r($total);
					$total['0']['Genre']['total']+=1;
					$data=array(
                    'Genre'=>array(
                        'total'=>$total['0']['Genre']['total']
                        )
                    );
                    $this->Genre->save($data);
					$this->Session->setFlash(__('Movie has been saved successfully.'));
					$this->redirect('index');
				}
				else
				{
					$this->Session->setFlash(__('Error while saving data.Please try again.'));
				}
			}
			$this->set('genres',$this->Item->Genre->find('list',array('order'=>'name')));
			
		}

		public function edit($id=NULL)
		{
			if(!$id)
			{
				throw new NotFoundException(__("Invalid Movie requested to be updated.")); 
			}
			$data=$this->Item->findById($id);

			if(!$data)
			{
				throw new NotFoundException(__("Invalid Movie requested to be updated."));
			}
			$owner=$this->Item->findById($id,array('fields'=>array('owner_id')));
			$this->loadModel('User');
			
			if($owner['Item']['owner_id']!=AuthComponent::user('id') )
			{
				$usergroup=$this->User->find('first',array('conditions'=>array('id'=>AuthComponent::user('id')),'fields'=>array('usergroup')));
				if($usergroup['User']['usergroup']!='admin')
				{
					$this->Session->setFlash(__('You can not edit as you are not the owner of the post.'));
					return $this->redirect(array('action' => 'index'));
				}
			}
			if ($this->request->is(array('post', 'put'))) 
			{
				
			    $this->Item->id = $id;
			    if ($this->Item->save($this->request->data)) 
			    {
			    	
				    $this->Session->setFlash(__('Movie Details have been updated.'));
				    return $this->redirect(array('action' => 'index'));
			    }
			    	$this->Session->setFlash(__('Unable to update.Please try again later.'));
			}
			    if (!$this->request->data) 
			    {
			    	$this->request->data = $data;
			    }

				$this->set('genres',$this->Item->Genre->find('list',array('order'=>'name')));

		}

		public function delete($id=NULL)
		{
			if (!$id || !$this->Item->exists($id)) 
			{
				throw new NotFoundException("Invalid movie requested to be deleted.");
			}
			$owner=$this->Item->findById('all',array('conditions'=>array('id'=>$id),'fields'=>array('owner_id')));
			$this->loadModel('User');
			
			if($owner['Item']['owner_id']!=AuthComponent::user('id') )
			{
				$usergroup=$this->User->find('first',array('conditions'=>array('id'=>AuthComponent::user('id')),'fields'=>array('usergroup')));
				if($usergroup['User']['usergroup']!='admin')
				{
					$this->Session->setFlash(__('You can not delete as you are not the owner of the post.'));
					return $this->redirect(array('action' => 'index'));
				}
			}
			if($this->request->is('POST'))
			{
				$data=$this->Item->findById($id);
				if($this->Item->delete($id))
				{
					$t=$data['Item']['genre_id'];
					$t2=$data['Item']['title'];
					$this->loadModel('Genre');
					
					$params=array(
						'conditions' => array('id' => $t),
						'fields'=>array('total')
						);
					$total=$this->Genre->find('first',$params);
					
					$t3=$total['Genre']['total'];
					$t3=$t3-1;
					$data=array(
                    'Genre'=>array(
                        'total'=>$t3
                        )
                    );
                    $this->Genre->id=$t;
                    $this->Genre->save($data);
                    
					$this->Session->setFlash(__("%s has been deleted.",h($t2)));
				}
				else
				{
					$this->Session->setFlash(__("%s could not be deleted.Please try again later.",h($data['Item']['title'])));
				}
				$this->redirect('index');
			}
			
		}

		public function search($qu=null)
		{
			if(!$qu)
			{
				$params = array(
				//'fields' => array('title', 'description', 'year'),
				//'fields' => array('Post.title', ),
				//'conditions' => array('title' => 'hehe'),
				//'conditions' => array('hoge' => array('$gt' => '10', '$lt' => '34')),
				//'order' => array('title' => 1, 'body' => 1),
				'order' => array('year' => -1),
				'limit' => 35,
				'page' => 1,
				);
				//$params=$array(
				//	'order'=>array('tite' => 1)
				//	);
				$data=$this->Item->find('all',$params);
				$count=count($data);
				$this->set('items',$data);
				$this->Set('count',$count);

				$this->render('index');
			}
			else
			{

				$params = array(
				//'fields' => array('title', 'description', 'year'),
				//'fields' => array('Post.title', ),
				'conditions' => array('title' => new MongoRegex("/".$qu."/i")),
				//'conditions' => array('hoge' => array('$gt' => '10', '$lt' => '34')),
				//'order' => array('title' => 1, 'body' => 1),
				'order' => array('year' => -1),
				'limit' => 35,
				'page' => 1,
				);

				$data=$this->Item->find('all',$params);
				$count=count($data);
				$this->set('items',$data);
				$this->Set('count',$count);

				$this->render('index');
			}
		}
	}
?>