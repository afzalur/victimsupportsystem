<?php
App::uses('AppController', 'Controller');
/**
 * Users Controller
 *
 * @property User $User
 */
class FieldsController extends AppController {

	    var $uses = array('Field','Entity');
    
    
/**
 * index method
 *
 * @throws NotFoundException
 * @return void
 */
	public function index() {
	    $fields = $this->Field->find('all');
		$this->set(compact('fields'));
	}

	
/**
 * view method
 *
 * @throws NotFoundException
 * @param string $id
 * @return void
 */
	public function view($id = null) {
		if (!$this->Field->exists($id)) {
			throw new NotFoundException(__('Invalid Field'));
		}
		$options = array('conditions' => array('Field.' . $this->Field->primaryKey => $id));
		$this->set('Field', $this->Field->find('first', $options));
	}

/**
 * add method
 *
 * @return void
 */
	public function add($entityId = null) {
		if (!$this->Entity->exists($entityId)) {
			$this->Session->setFlash(__('Select an Entity first to add field to it'),'notices/error');
			$this->redirect(array('controller'=>'fields','action'=>'selectEntity'));
		}
		if ($this->request->is('post')) {
			$this->Field->create();
			if ($this->Field->saveAll($this->request->data)) {
				$this->Session->setFlash(__('The Field has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Field could not be saved. Please, try again.'));
			}
		}
		$entity = $this->Entity->find('first',array('conditions'=>array($this->Entity->primaryKey => $entityId)));
		$fields = $this->Field->find('list',array('conditions'=>array('entity_id' => $entityId)));
		$this->set(compact('entity','fields'));
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
		if (!$this->Field->exists($id)) {
			throw new NotFoundException(__('Invalid Field'));
		}
		if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Field->save($this->request->data)) {
				$this->Session->setFlash(__('The Field has been saved'));
				$this->redirect(array('action' => 'index'));
			} else {
				$this->Session->setFlash(__('The Field could not be saved. Please, try again.'));
			}
		} else {
			$options = array('conditions' => array('Field.' . $this->Field->primaryKey => $id));
			$this->request->data = $this->Field->find('first', $options);
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
		$this->Field->id = $id;
		if (!$this->Field->exists()) {
			throw new NotFoundException(__('Invalid Field'));
		}
		$this->request->onlyAllow('post', 'delete');
		if ($this->Field->delete()) {
			$this->Session->setFlash(__('Field deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Field was not deleted'));
		$this->redirect(array('action' => 'index'));
	}


}