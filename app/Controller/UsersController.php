<?php

/*********************************************************************
 * Copyright (C) 2013 TerraTech Limited (www.terratech.com.bd)
 *
 * This file is part of victimDb project.
 *
 * victimDb can not be copied and/or distributed without the express
 * permission of TerraTech Limited
**********************************************************************/

App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class UsersController extends AppController {

    var $uses = array('User','Group');
    
    public function beforeFilter() {
        parent::beforeFilter();

        $this->Auth->allow();
        //$this->Security->unlockedActions = array('oauthlogin');
    }
    
/**
 * index method
 *
 * @throws NotFoundException
 * @return void
 */
	public function index($type = null) {    
        $userGroupID = $this->Group->findByName($type);
        $conditions['conditions'] = (isset($userGroupID['Group']['_id'])) ? array( 'group_id' => $userGroupID['Group']['_id']) : false;
        $users = $this->User->find( 'all', array($conditions));
        $this->set(compact('users'));
	}    

        
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
                    $adminID = $this->Group->findByName('Admin');
                    $this->request->data['User']['group_id'] = $adminID['Group']['_id'];
                    $this->request->data['User']['vendor'] = 'google';
                    $this->request->data['User']['token'] = $accessToken;
                    $this->request->data['User']['password'] = $accessToken;
                    $this->request->data['User']['verified'] = 1;
                    $result = $this->User->find('count',array('conditions'=> array('email'=>$googleEmail) ));

                    if( empty($result)){
                        $this->User->saveAll($this->request->data);
                    }
                    else{
                        $conditions = array('email'=>$googleEmail,'username'=>$googleUserName);
                        $field = array('token' => $accessToken, 'password' => AuthComponent::password($googleUserName));
                        $this->User->updateAll($field,$conditions);
                    }
                    $this->redirect(array('controller'=>'users','action'=>'oauthlogin',$googleEmail,$googleUserName));

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
                        $adminID = $this->Group->findByName('Admin');
                        $this->request->data['User']['group_id'] = $adminID['Group']['_id'];
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
                            $field = array('token' => $accessToken, 'password' => AuthComponent::password($userData->username));
                            $this->User->updateAll($field,$conditions);
                        }
                        $this->redirect(array('controller'=>'users','action'=>'oauthlogin',$userData->email,$userData->username));
                
                }
            break;

        default:
            $superAdminID = $this->Group->findByName('Super Admin');
            if($this->request->is('post') && $this->Auth->user('group_id') == $superAdminID['Group']['_id'] ){
                $userEmailParts = explode("@", $this->request->data['User']['email']);
                $this->request->data['User']['username'] = $userEmailParts[0];

                $this->request->data['User']['verified'] = 1;

                $result = $this->User->find('count',array('conditions'=> array('email'=>$this->request->data['User']['email']) ));

                if( empty($result)){                    
                    if($this->User->saveAll($this->request->data)){
                        $this->Session->setFlash(__('user has been saved', true));
                    }
                    else{
                        $this->Session->setFlash(__('Error occured while saving', true));
                    }
                }
                else{
                    $this->User->invalidate('User.email','user already exist with this email');
                    $this->Session->setFlash(__('user already exist with this email', true));
                }
            }
            elseif ($this->Auth->user('group_id') != $superAdminID ) {
                $this->Session->setFlash(__('You are not authorized to complete this action', true));
            }
            $groups = $this->Group->find('list');
            $this->set(compact('groups'));
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
            $this->Session->setFlash(__('Error occured when loggin in', true));                        
        }
    }
    else{
        $this->redirect($this->Auth->redirect());
        $this->Session->setFlash(__('Already logged in', true));                        
    }
    $this->redirect($this->Auth->redirect());
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

        }


}
