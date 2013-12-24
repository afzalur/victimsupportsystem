<?php
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

	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * belongsTo associations
 *
 * @var array
 */
 /*
	public $actsAs = array(
        'MongoDB.SqlCompatible'
    );
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