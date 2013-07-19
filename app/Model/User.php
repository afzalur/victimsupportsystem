<?php

/*********************************************************************
 * Copyright (C) 2013 TerraTech Limited (www.terratech.com.bd)
 *
 * This file is part of victimDb project.
 *
 * victimDb can not be copied and/or distributed without the express
 * permission of TerraTech Limited
**********************************************************************/

App::uses('AppModel', 'Model');
/**
 * User Model
 */
class User extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'username';

    public $primaryKey = '_id';

/*
    var $mongoSchema = array(
            '_id' => array('type' => 'int', 'primary' => true, 'length' => 40),
            'username' => array('type'=>'string'),
            'group_id'  => array('type' => 'string'),
            'email'=>array('type'=>'string'),
            'vendor'=>array('type'=>'string'),
            'token'=>array('type'=>'string'),
            'password'=>array('type'=>'string'),
            'verified'=>array('type'=>'int'),
            'created'=>array('type'=>'datetime'),
            'modified'=>array('type'=>'datetime'),
            );
*/
/*
	public $validate = array(
                'vendor' => array(
                        'notempty' => array(
                                'rule' => array('notempty'),
                                'message' => 'Choose a username',
                                //'allowEmpty' => false,
                                //'required' => false,
                                //'last' => false, // Stop validation after this rule
                                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                        ),
                        'isUnique' => array(
                                'rule' => array('isUnique'),
                                'message' => 'Username already taken',
                                //'allowEmpty' => false,
                                //'required' => false,
                                //'last' => false, // Stop validation after this rule
                                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                        ),
                ),
                'email' => array(
                        'email' => array(
                                'rule' => array('email'),
                                'message' => 'Enter a valid email address',
                                //'allowEmpty' => false,
                                //'required' => false,
                                //'last' => false, // Stop validation after this rule
                                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                        ),
                        'isUnique' => array(
                                'rule' => array('isUnique'),
                                'message' => 'An account is already registered with this email address',
                                //'allowEmpty' => false,
                                //'required' => false,
                                //'last' => false, // Stop validation after this rule
                                //'on' => 'create', // Limit validation to 'create' or 'update' operations
                        ),
                ),
                'password' => array(
                        'notempty' => array(
                                'rule' => array('notempty'),
                                'message' => 'Choose a strong password for your account',
                                //'allowEmpty' => false,
                                //'required' => false,
                                //'last' => false, // Stop validation after this rule
                                'on' => 'create', // Limit validation to 'create' or 'update' operations
                        ),
                ),
	);*/

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Group' => array(
			'className' => 'Group',
			'foreignKey' => 'group_id',
			'counterCache' => true,
		)
	);

/**
 * hasOne associations
 *
 * @var array
 */
    public $hasOne = array(
        'Profile' => array(
            'className' => 'Profile',
            'foreignKey' => 'user_id',
        )
    );



    public function beforeSave($options = array()) {
        parent::beforeSave($options);
        if(isset($this->data['User']['password'])){
            $this->data['User']['password'] = AuthComponent::password($this->data['User']['password']);
        }
    }

    
    
}