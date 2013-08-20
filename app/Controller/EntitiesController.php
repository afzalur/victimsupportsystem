<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class EntitiesController extends AppController {
    
	    var $uses = array('Field','Entity');
    

/**
 * index method
 *
 * @throws NotFoundException
 * @return void
 */
	public function index() {
	    $entities = $this->Entity->find('all');
		$this->set(compact('entities'));
	}

	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Entity->exists($id)) {
			throw new NotFoundException(__('Invalid Entity'));
		}
		$options = array('conditions' => array('Entity.' . $this->Entity->primaryKey => $id));
		$this->set('entity', $this->Entity->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add() {
		if ($this->request->is('post')) {			
			$this->Entity->create();
			/*
			* DO NOT FORGET TO SPECIFY YOU DATABASE CREDENTIALS HERE. OTHERWOSE ENTITY WILL NOT WORK
			*/
			$mongo = new Mongo("mongodb://localhost");
			$db = $mongo->selectDB('victim');
			$collections = $db->listCollections();			
			if(!array_search($this->request->data['Entity']['entity_name'], $collections)){
				$db->createCollection($this->request->data['Entity']['entity_name'],FALSE);				
				if ($this->Entity->save($this->request->data)) {
					$this->Session->setFlash(__('The Entity has been saved'),'notices/success');
					$this->redirect(array('action' => 'index'));
				} else {
					$this->Session->setFlash(__('The Entity could not be saved. Please, try again.'),'notices/error');
				}
			}
		}
	}

/**
 * add method
 *
 * @return void
 */
	public function addData($entitieId = null) {
		if (!$this->Entity->exists($entityId)) {
			$this->Session->setFlash(__('Select an Entity first to add field to it'),'notices/error');
			$this->redirect($this->referer());
		}
		/*if ($this->request->is('post')) {
			$this->Entity->create();
			if ($this->Entity->save($this->request->data)) {
				$this->Session->setFlash(__('The Entity has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Entity could not be saved. Please, try again.'));
			}
		}*/
	}


/**
 * selectEntity method
 *
 * @return void
 */
	public function selectEntity() {
		if($this->request->is('post')){
			$this->redirect(array('controller'=>'fields','action'=>'add',$this->request->data['Field']['entity_id']));
		}
		$entities = $this->Entity->find('list');
		$this->set(compact('entities'));
	}


	

/**
 * edit method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function edit($id = null) {
		if (!$this->Entity->exists($id)) {
			throw new NotFoundException(__('Invalid Entity'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Entity->save($this->request->data)) {
				$this->Session->setFlash(__('The Entity has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Entity could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Entity.' . $this->Entity->primaryKey => $id));
			$this->request->data = $this->Entity->find('first', $options);
		}
	}

/**
 * delete method
 *
 * @throws NotFoundException
 * @throws MethodNotAllowedException
 * @param string $id
 * @return void
 */
	public function delete($id = null) {
		$this->Entity->id = $id;
		if (!$this->Entity->exists()) {
			throw new NotFoundException(__('Invalid Entity'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Entity->delete()) {
			$this->Session->setFlash(__('Entity deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Entity was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


}