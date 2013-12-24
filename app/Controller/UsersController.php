<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    public $components = array('Paginator');	
	var $uses = array('User','Field','Entity');	
	private $mongoDbURI = 'mongodb://202.51.191.27:27017';	
    
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(array('login', 'oauth2', 'logout', 'fb_channel', 'oauthlogin', 'revoke','importExcel', 'result', 'search'));
    }
    
/**
 * index method
 *
 * @throws NotFoundException
 * @return void
 */

	public function index($type = null) {    
		/* echo "<pre>";
	    print_r($this->Session->read('Auth.User'));
		*/
		
		if($this->Session->read('Auth.User.user_type') == 'General'){
			 $this->redirect(array('controller'=>'users','action'=>'general'));
		}
		 
        $options = (!empty($type)) ? array('conditions' => array('user_type' => $type)) : null;
        $users = $this->User->find( 'all', $options );
        $this->set(compact('users','options'));
		
		$this->paginate = array(
			'limit' => 5, // this was the option which you forgot to mention
			'order' => array('User.user_type' => 'DESC')
		    );		
				
		$this->set('users', $this->paginate('User'));
	}	
	
	public function general($type = null) { 
        //$options = (!empty($type)) ? array('conditions' => array('user_type' => $type)) : null;
		$id=$this->Session->read('Auth.User._id');
		// $conditions=array('conditions' => array('_id'=>$id))
		$options=array('conditions' => array('_id'=>$id));
        $users = $this->User->find('all', $options);
        $this->set(compact('users','options'));
		
		$this->paginate = array(
			'limit' => 5, 
			'order' => array('User.user_type' => 'DESC'),
			'conditions'=> array('User._id'=>$id)
		    );		
				
		$this->set('users', $this->paginate('User'));
	} 	
	
	
	public function search()
	{
	
	}
	
	public function result() { 
		if (!empty($this->data)) {				
			$string = $this->data['User']['username'];		
			$search_result = $this->User->find('all', array(
				'conditions' => array( 
					'User.username' => new MongoRegex("/$string/")
				)
			));		
			
			$search_entity = $this->Entity->find('all', array(
				'conditions' => array( 
					'Entity.entity_name' => new MongoRegex("/$string/")
				)
			));		
			
			$this->set('search_result', $search_result);
			$this->set('search_entity', $search_entity);
		}
		
		else {
			$this->redirect(array('controller'=>'users','action' => 'index'));
		}
	} 
/* from Uvws 	
	public function result() { 
		if(!empty($this->data)) { 					   
				$data = $this->User->find('all',array('conditions'=>array('User.id'=> $this->data['User']['id']))); 
				$this->set('result', $data); 
		} 
		else { 
				$this->redirect(array('controller'=>'uvw','action'=>'search')); 
		} 
	} 	
*/	
     
/**
 * login method
 * 
 * check credentials posted using login form and log in user
 * 
 * @uses Authenticate Authenticate Plugin from https://github.com/ceeram/Authenticate
 * @return void
 */
public function login($vendor = null) {
    $this->layout = 'login';
    if($this->Auth->loggedIn()){
        $this->redirect($this->Auth->redirect());
    }
    if($this->Auth->login()) {
        $this->Session->setFlash(__('You have successfully logged in.'), 'notices/success');
        $this->redirect(array('controller'=>'users','action'=>'index'));
    }
}


public function oauth2($vendor = null){

    switch ($vendor) {
        case 'google':

                $accessToken = $this->params['url']['token'];
                $userDetails = file_get_contents('https://www.googleapis.com/oauth2/v1/userinfo?access_token=' . $accessToken);
                $userData = json_decode($userDetails);

                if (!empty($userData)) {

                    $googleUserId = '';
                    $googleEmail = '';
                    $googleName = '';
                    $googleUserName = '';

                    if (isset($userData->id)) {
                        $googleUserId = $userData->id;
                    }
                    if (isset($userData->email)) {
                        $googleEmail = $userData->email;
                        $googleEmailParts = explode("@", $googleEmail);
                        $googleUserName = $googleEmailParts[0];
                    }
                    $this->set(compact('googleEmail','userData'));
                    $this->request->data['User']['username'] = $googleUserName;
                    $this->request->data['User']['email'] = $googleEmail;
                    $this->request->data['User']['vendor'] = 'google';
                    $this->request->data['User']['user_type'] = 'General';
                    $this->request->data['User']['token'] = $accessToken;
                    $this->request->data['User']['password'] = $accessToken;
                    $this->request->data['User']['verified'] = 1;
                    $result = $this->User->find('count',array('conditions'=> array('email'=>$googleEmail) ));

                    if( empty($result)){
                        $this->User->saveAll($this->request->data);
                    }
                    else{
                        $conditions = array('email'=>$googleEmail,'username'=>$googleUserName);
                        $field = array('token' => $accessToken, 'password' => AuthComponent::password($accessToken));
                        $this->User->updateAll($field,$conditions);
                    }
                    $this->redirect(array('controller'=>'users','action'=>'oauthlogin',$googleEmail,$accessToken));

                }
            break;
        
        case 'fb':
                $accessToken = $this->params['url']['token'];
                $userDetails = file_get_contents('https://graph.facebook.com/me?access_token=' . $accessToken);
                $userData = json_decode($userDetails);
                $this->set(compact('userData'));
                if (!empty($userData)) {
                        if(!isset($userData->email)) {
                            throw new NotFoundException(__('FATAL ERROR: Unable to detect email from facebook.'));
                        }
                        if(!isset($userData->username)){
                            $fbEmail = $userData->email;
                            $fbEmailParts = explode("@", $fbEmail);
                            $userData->username = $fbEmailParts[0];
                        }
                        $this->request->data['User']['username'] = $userData->username;
                        $this->request->data['User']['email'] = $userData->email;
                        $this->request->data['User']['user_type'] = 'General';
                        $this->request->data['User']['vendor'] = 'fb';
                        $this->request->data['User']['token'] = $accessToken;
                        $this->request->data['User']['password'] = $accessToken;
                        $this->request->data['User']['verified'] = 1;
                        $result = $this->User->find('count',array('conditions'=> array('email'=>$userData->email) ));

                        if( empty($result)){
                            $this->User->saveAll($this->request->data);
                        }
                        else{
                            $conditions = array('email'=>$userData->email,'username'=>$userData->username);
                            $field = array($this->request->data['User']['vendor'] = 'fb','token' => $accessToken, 'password' => AuthComponent::password($accessToken));
                            $this->User->updateAll($field,$conditions);
                        }
                        $this->redirect(array('controller'=>'users','action'=>'oauthlogin',$userData->email,$accessToken));
                
                }
            break;

        default:
            break;
    }


}

public function fb_channel(){
    $this->layout = 'ajax';
}

public function oauthlogin($email,$pass){
    $this->request->data['User']['email'] = $email;
    $this->request->data['User']['password'] = $pass;
    if(!$this->Auth->loggedIn()){
        if($this->Auth->login()){
            $this->Session->setFlash(__('Logged In.', true));                      
        }  
        else{
            $this->Session->setFlash(__('Error occured when loggin in.'));                        
        }
    }
    else{
        $this->redirect($this->Auth->redirect());
        $this->Session->setFlash(__('Already logged in', true));                        
    }
    $this->redirect($this->Auth->redirect());
}

/**
 * add method
 *
 * @return void
 */
        public function add() {
            if($this->Auth->user('user_type') == 'Super Admin' ){
                if ($this->request->is('post')) {
                        $this->User->create();
                        $this->request->data['User']['verified'] = 1;
                        $result = null;
                        $result = $this->User->find('first',array('conditions'=> array('email'=>$this->request->data['User']['email']) ));
                        if($this->request->data['User']['password'] !== $this->request->data['User']['retype_password']){
                            $this->User->validationErrors['retype_password'] = array('Password does not match');
                            //$this->User->validationErrors = array( 'retype_password' => array("Password does not match"));
                        }                                   
                        if(!isset($this->request->data['User']['email']) || empty($this->request->data['User']['email'])){
                            //$this->User->validationErrors = array( 'email' => array("email can not be empty"));
                            $this->User->validationErrors['email'] = array('email can not be empty');
                        }
                        elseif (!empty($result)) { 
                            $this->User->validationErrors['email'] = array('email already in use');
                            //$this->User->validationErrors = array( 'email' => array("email already in use"));
                        }
                        else{                            
                                $userEmailParts = explode("@", $this->request->data['User']['email']);
                                $this->request->data['User']['username'] = $userEmailParts[0];
                        }
                        if( $this->User->validates($this->request->data) && $this->User->saveAll($this->request->data)) {
                                $this->Session->setFlash(__('The user has been added.'),'notices/success');
                                $this->redirect($this->referer());
                        } else {
                                $this->Session->setFlash(__('The user could not be saved. Please, try again.'),'notices/error');
                        }
                }
            }
            else{
                $this->Session->setFlash(__('You are not authorized to complete this action'), 'notices/error');
                $this->redirect($this->referer());
            }
        }


        function change_password($id = NULL){            
            if($this->Auth->user('user_type') != 'Super Admin'){
                $id = $this->Auth->user('_id');
            }
            if (!$id && empty($this->request->data)) {
                    $this->Session->setFlash(__('Invalid user'), 'notices/error');
                    $this->redirect(array('action' => 'index'));
            }
            if (!empty($this->request->data)) {
                    if($this->request->data['User']['password'] != $this->request->data['User']['retype_password']){
                        $this->User->validationErrors['retype_password'] = array('Password does not match');
                        //$this->Session->setFlash(__('password changed.'),'notices/success');
                    }                           
                    if( $this->User->validates($this->request->data) && $this->User->saveAll($this->request->data) ) {
                        $this->Session->setFlash(__('password changed.'),'notices/success');
                        //$this->redirect($this->referer());
                    } else {
                            $this->Session->setFlash(__('Password does not changed. Please, try again.'),'notices/error');
                    }
            }
            if (empty($this->request->data)) {
                    $this->request->data = $this->User->read(NULL, $id);
            }
        }

/**
 * edit method
 * 
 * Edit user
 * 
 * @return void
 */
        
        function edit($id = null){
            if($this->Auth->user('user_type') == 'Super Admin'){
                if (!$this->User->exists($id)) {
                        throw new NotFoundException(__('Invalid user'));
                }
                if ($this->request->is('post') || $this->request->is('put')) {
                        if ($this->User->save($this->request->data)) {
                                $this->Session->setFlash(__('The user has been saved'));
                                $this->redirect(array('action' => 'index'));
                        } else {
                                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                        }
                } else {
                        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
                        $this->request->data = $this->User->find('first', $options);
                }
                $groups = $this->User->Group->find('list',array('fields'=>array('Group.id','Group.group_name')));
                $this->set(compact('groups'));
            }
            else{
                $this->Session->setFlash(__('You are not authorized to view that page', true));
                $this->redirect($this->Auth->redirect());
            }
        }
		


        function level($id = null){
            if($this->Auth->user('user_type') == 'Super Admin'){
                if (!$this->User->exists($id)) {
                        throw new NotFoundException(__('Invalid user'));
                }
                if ($this->request->is('post') || $this->request->is('put')) {
                        if ($this->User->save($this->request->data)) {
                                $this->Session->setFlash(__('The user has been saved'));
                                $this->redirect(array('action' => 'index'));
                        } else {
                                $this->Session->setFlash(__('The user could not be saved. Please, try again.'));
                        }
                } else {
                        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
                        $this->request->data = $this->User->find('first', $options);
                }
                $groups = $this->User->Group->find('list',array('fields'=>array('Group.id','Group.group_name')));
                $this->set(compact('groups'));
            }
            else{
                $this->Session->setFlash(__('You are not authorized to view that page', true));
                $this->redirect($this->Auth->redirect());
            }
        }		
        

/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function view($id = null) {
        if (!$this->User->exists($id)) {
            throw new NotFoundException(__('Invalid user'));
        }
        $options = array('conditions' => array('User.' . $this->User->primaryKey => $id));
        $this->set('user', $this->User->find('first', $options));
    }

        
/**
 * logout method
 * 
 * Logout user
 * 
 * @return void
 */
        
        function logout(){
            if($this->Auth->loggedIn()){
                $this->Auth->logout();
            }
            $this->redirect($this->Auth->redirect());
        }
        

/**
 * revoke method
 * 
 * revoke user
 * 
 * @return void
 */
        
        function revoke(){
            $this->layout = 'ajax';
            //$this->redirect(array('controller'=>'users','action'=>'logout'));
        }

/**
 * delete method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
    public function delete($id = null) {
        $this->User->id = $id;
        if (!$this->User->exists()) {
            throw new NotFoundException(__('Invalid user'));
        }
        $this->request->onlyAllow('post', 'delete');
        if ($this->User->delete()) {
            $this->Session->setFlash(__('User deleted'));
            return $this->redirect(array('action' => 'index'));
        }
        $this->Session->setFlash(__('User was not deleted'));
        return $this->redirect(array('action' => 'index'));
    }


}
