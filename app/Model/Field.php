<?php
App::uses('AppModel', 'Model');
/**
 * User Model
 */
class Field extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'field_name';

    public $primaryKey = '_id';


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $belongsTo = array(
		'Entity' => array(
			'className' => 'Entity',
			'foreignKey' => 'entity_id',
		)
	);



    
    
}