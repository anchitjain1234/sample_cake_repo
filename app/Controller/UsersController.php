<?php
    App::uses('AppController', 'Controller');
    App::uses('CakeEmail', 'Network/Email');
    class UsersController extends AppController {

    
    public function beforeFilter() 
    {
        parent::beforeFilter();
        $this->Auth->allow('add', 'logout','token');
    }

    public function index() 
    {
        $params = array
        (
            'fields' => array('firstname', 'lastname', 'username','id'),
        );
        $data=$this->User->find('all',$params);
        $this->set('users',$data);
    }

    public function add() 
    {
        if ($this->request->is('post')) 
        {
            $this->User->create();
            $this->request->data['User']['usergroup']='nonadmin';
            $this->request->data['User']['password_repeat']=$this->request->data['User']['password'];
            if ($this->User->save($this->request->data)) 
            {
                $this->loadModel('Verify');
                $h=str_shuffle(hash("sha512",(hash("sha256",$this->request->data['User']['email'].$this->request->data['User']['username'])).strval(time()).md5(rand()).md5($this->request->data['User']['password'])));
                //debug( isset( $this->Verify ) );
                $this->Verify->create();
                $data=array(
                    'Verify'=>array(
                        'username'=>$this->request->data['User']['username'],
                        'token'=>$h
                        )
                    );
                $this->Verify->save($data);
                $Email=new CakeEmail('mandrill');
                $Email->to($this->request->data['User']['email']);
                $Email->subject('Verification email');
                $link="http://localhost/test-pr/verifies/token?token=".$h."&username=".$this->request->data['User']['username'];
                $message='Please verify your email id by clicking <a href="'.$link.'">here</a>.<br> If this link does not works please copy paste below link into your browser<br><br>'.$link;
                //$Email->message($message);
                $Email->send($message);
                $this->Session->setFlash(__('Please check your mailbox to verify your email id.(Dont forget to check your SPAM.)'));
                return $this->redirect(array('action' => 'login'));
            }
            $this->Session->setFlash(__('Error while saving data. Please, try again.'));
        }
    }

    public function view($id=null)
    {
        if (!$id) 
        {
           throw new NotFoundException(__("Invalid User ID entered."));
        }
        $data=$this->User->findById($id);
        if (!$data) 
        {
            throw new NotFoundException(__("Invalid User ID entered."));
        }
        $this->loadModel('Item');
        $this->set('userinfo',$data); 
        $params = array(
            'conditions' => array('owner_id' => $data['User']['id']),
            );
        $dr=$this->Item->find('all',$params);
        $this->set('movies',$dr);
    }

/*
    public function edit($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->request->is('post') || $this->request->is('put')) {
            if ($this->User->save($this->request->data)) {
                $this->Session->setFlash(__('The user has been saved'));
                return $this->redirect(array('action' => 'index'));
            }
            $this->Session->setFlash(
                __('The user could not be saved. Please, try again.')
            );
        } else {
            $this->request->data = $this->User->read(null, $id);
            unset($this->request->data['User']['password']);
        }
    }

    public function delete($id = null) {
        // Prior to 2.5 use
        // $this->request->onlyAllow('post');

        $this->request->allowMethod('post');

        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }
*/
    public function login() 
    {
        if ($this->request->is('post')) 
        {
            if ($this->Auth->login()) 
            {
                $this->Session->write('user__id', $this->request->data['User']['username']);
                return $this->redirect(array('controller'=>'items','action' => 'index',$var));
            }
            $this->Session->setFlash(__('Invalid username or password, try again'));
        }
    }

    public function logout() 
    {
        return $this->redirect($this->Auth->logout());
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
            $this->loadModel('Forgot');
            $forgotid=$this->Forgot->find('all',$p);
            if ($forgotid) 
            {
                if($this->request->is('post', 'put'))
                {   $userinfo=$this->User->find('first',array('conditions'=>array('username'=>$username)));
                    if($userinfo)
                    {
                        $this->User->id=$userinfo['User']['id'];
                        if($this->User->save($this->request->data))
                        {
                            $this->Forgot->id=$forgotid['0']['Forgot']['id'];
                            $this->Forgot->delete();
                            $Email=new CakeEmail('mandrill');
                            $Email->to($userinfo['User']['email']);
                            $Email->subject('Password Changed');
                            $Email->send("Your login password has been changed successfully.Please reply to this email if you didn't rquested to change your password.");
                            $this->Session->setFlash(__('Your password has been successfully changed.PLease login with your new password'));
                            $this->redirect(array('controller'=>'users','action'=>'login'));
                        }
                        else
                        {
                            $this->Session->setFlash(__('Error while changing your password.Please try again.'));
                        }
                    }
                }
            }
            else
            {
                $this->Session->setFlash(__('Invalid request or your token has expired.'));
                $this->redirect(array('controller'=>'users','action'=>'login'));
            }
        }

}
?>