<?php
/**
 * Application level View Helper
 *
 * This file is application-wide helper file. You can put all
 * application-wide helper-related methods here.
 *
 * PHP 5
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright 2005-2012, Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.View.Helper
 * @since         CakePHP(tm) v 0.2.9
 * @license       MIT License (http://www.opensource.org/licenses/mit-license.php)
 * @author        Tahsin Hassan Rahit <tahsin.rahit@gmail.com>
 */

App::uses('FormHelper', 'View/Helper');

/**
 * AmusifierForm helper
 *
 * Overriding/Adding functionality with Form Helper provided by CakepHP
 *
 * @package       app.View.Helper.FormHelper
 */
class ExtendedFormHelper extends FormHelper{
    
/**
 * Set inputDefaults for form elements
 * 
 * 
 * @return void
 */
	public function victimDefaults() {
            $defaults = array(
                            'between'   =>  '<div class="controls">',
                            'after' =>  '</div>',
                            'class' =>  'input-xlarge',
                            'div'   => array('class'    => 'control-group'),
                            'label' => array('class'    =>  'control-label'),
                            'format'    =>  array('before', 'label', 'between', 'input', 'error' ,'after'),
                            'error' => array(
                                'attributes'    =>  array(
                                    'wrap'  =>  'span',
                                    'class' =>  'system negative help-inline'
                                )
                            )
                        );
            $this->inputDefaults($defaults, TRUE);
	}
}