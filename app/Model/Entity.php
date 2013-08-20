<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 */
class Entity extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'entity_name';

    public $primaryKey = '_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'Field' => array(
			'className' => 'Field',
			'foreignKey' => 'entity_id',
		)
	);



    
    
}