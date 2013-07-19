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
class Group extends AppModel {

/**
 * Display field
 *
 * @var string
 */
	public $displayField = 'name';

    public $primaryKey = '_id';

/**
 * Mongodb schema
 *
 * @var array
 */

    var $mongoSchema = array(
            '_id' => array('type' => 'int', 'primary' => true, 'length' => 40),
            'name'  => array('type' => 'string'),
            'created'=>array('type'=>'datetime'),
            'modified'=>array('type'=>'datetime'),
            );


	//The Associations below have been created with all possible keys, those that are not needed can be removed

/**
 * hasMany associations
 *
 * @var array
 */
	public $hasMany = array(
		'User' => array(
			'className' => 'User',
			'foreignKey' => 'group_id',
		)
	);



    
    
}