<?php
	class GenresController extends AppController{

		
		public function index()
		{
			$data=$this->Genre->find('all');
			$this->set('genres',$data);
		}
		
		public function view($id=null)
		{
			if (!$id) 
	        {
	           throw new NotFoundException(__("Invalid Genre ID entered."));
	        }
	        $data=$this->Genre->findById($id);
	        if (!$data) 
	        {
	            throw new NotFoundException(__("Invalid Genre ID entered."));
	        }
	        $this->loadModel('Item');
	        $this->set('genreinfo',$data); 
	        $params = array(
	            'conditions' => array('genre_id' => $data['Genre']['id']),
	            );
	        $dr=$this->Item->find('all',$params);
	        $this->set('movies',$dr);
			}
	}
?>