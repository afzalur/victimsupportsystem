<?php
App::uses('AppController', 'Controller');
App::import('Vendor', 'php-excel-reader/excel_reader2'); //import statement
/**
 * Users Controller
 *
 * @property User $User
 */
class EntitiesController extends AppController {
   
    public $components = array('Paginator');
    
    var $uses = array('Field','Entity');

	/*
	* DO NOT FORGET TO SPECIFY YOU DATABASE CREDENTIALS HERE. OTHERWOSE ENTITY WILL NOT WORK
	*/
    private $mongoDbURI = 'mongodb://202.51.191.27:27017';	
    

/**
 * index method
 *
 * @throws NotFoundException
 * @return void
 */
 
	public function index() {
/*	     
		 echo "<pre>";
	     print_r($this->Session->read('Auth.User'));		 
		 echo $this->Session->read('Auth.User.user_level');
*/		 
		
		$user_type = $this->Session->read('Auth.User.user_type');
		$this->set('user_type', $user_type);
		
		$user_level= $this->Session->read('Auth.User.user_level');
		$this->set('user_level', $user_level);
		
		
		$this->paginate = array(
			'limit' => 5, // this was the option which you forgot to mention
			'order' => array(
				'Entity.entity_name' => 'DESC')
		);		
				
		$this->set('entities', $this->paginate('Entity'));
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
			$mongo = new Mongo($this->mongoDbURI);
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
 * addData method
 *
 * @param string $id
 * @param string $entryId
 * @return void
 */
	public function addData($id = null) {
		$entity = null;
		$fields = $this->__checkExistance($id);

		$temp = $this->Entity->find('first',array('conditions'=>array($this->Entity->primaryKey => $id)));
		$entity = $temp['Entity']['entity_name'];

		if ($this->request->is('post')) {
			
			/*if (!$this->__checkValidity($this->request->data, $id)) {
				echo 'test';
			}*/

			foreach ($this->request->data['Entity'] as $field => $value) {
				if($fields[$field] == 'file' && !empty($this->request->data['Entity'][$field]) && $this->request->data['Entity'][$field]['error'] ==0){
					if(!move_uploaded_file($this->request->data['Entity'][$field]['tmp_name'], WWW_ROOT.'uploads/'.$this->request->data['Entity'][$field]['name'])){
						$this->redirect(array('action' => 'addData', $id));
					}
				}
				if($fields[$field] == 'date') {
					$temp = $this->request->data['Entity'][$field]['day'].'-'.$this->request->data['Entity'][$field]['month'].'-'.$this->request->data['Entity'][$field]['year'];
					$this->request->data['Entity'][$field] = $temp;
				}
			}
			
			$mongo = new Mongo($this->mongoDbURI);
			$db = $mongo->selectDB('victim');
			$collection = $db->selectCollection($entity);
			$data = $this->request->data['Entity'];
			
			
		
			
			if($collection->insert($data)) {
				$this->Session->setFlash(__(' The entry has been recorded to '. $entity),'notices/success');
				$this->redirect(array('action' => 'index'));
			}
			else {
				$this->Session->setFlash(__('The entry could not be saved. Please, try again.'),'notices/error');
			}
			
		}
		$this->set(compact('fields','entity'));
	}

/**
 * editData method
 *
 * @param string $id
 * @param string $entryId
 * @return void
 */
	public function editData($id = null, $entryId = null) {
		$entity = null;
		$fields = $this->__checkExistance($id);

		$temp = $this->Entity->find('first',array('conditions'=>array($this->Entity->primaryKey => $id)));
		$entity = $temp['Entity']['entity_name'];

		$mongo = new Mongo($this->mongoDbURI);
		$db = $mongo->selectDB('victim');
		$collection = $db->selectCollection($entity);

		if ($this->request->is('post')) {


			foreach ($this->request->data['Entity'] as $field => $value) {
				if($fields[$field] == 'file' && !empty($this->request->data['Entity'][$field]) && $this->request->data['Entity'][$field]['error'] ==0){
					if(!move_uploaded_file($this->request->data['Entity'][$field]['tmp_name'], WWW_ROOT.'uploads/'.$this->request->data['Entity'][$field]['name'])){
						$this->redirect(array('action' => 'addData', $id));
					}
				}
				if($fields[$field] == 'date') {
					$temp = $this->request->data['Entity'][$field]['day'].'-'.$this->request->data['Entity'][$field]['month'].'-'.$this->request->data['Entity'][$field]['year'];
					$this->request->data['Entity'][$field] = $temp;
				}
			}
			
			$data = array( '$set' => $this->request->data['Entity']);
			if($collection->update(array('_id'=> new MongoId($entryId)),$data)){
				$this->Session->setFlash(__(' The entry has been update'),'notices/success');
				$this->redirect(array('action' => 'viewData', $id));
			}
			else {
				$this->Session->setFlash(__('The entry could not be saved. Please, try again.'),'notices/error');
			}
		}
		$this->request->data['Entity'] = $collection->findOne(array('_id'=> new mongoId($entryId)));
		unset($this->request->data['Entity']['_id']);
		$this->set(compact('fields','entity','id','entryId'));
	}

/**
 * delete method
 *
 * @param string $id
 * @param string $entryId
 * @return void
 */
	public function deleteData($id = null, $entryId = null) {
		$fields = $this->__checkExistance($id);

		$temp = $this->Entity->find('first',array('conditions'=>array($this->Entity->primaryKey => $id)));
		$entity = $temp['Entity']['entity_name'];

		$mongo = new Mongo($this->mongoDbURI);
		$db = $mongo->selectDB('victim');
		$collection = $db->selectCollection($entity);

		$this->request->onlyAllow('post', 'delete');
		if ($collection->remove(array('_id'=> new mongoId($entryId) ))) {
			$this->Session->setFlash(__('Entry deleted'));
			$this->redirect(array('action' => 'index'));
		}
		$this->Session->setFlash(__('Entry was not deleted'));
		$this->redirect($this->referer());
	}


/**
 * viewData method
 *
 * @param string $id
 * @return void
 */
	public function viewData($id = null) {
		$entity = null;
		$fields = $this->__checkExistance($id);

		$temp = $this->Entity->find('first',array('conditions'=>array($this->Entity->primaryKey => $id)));
		$entity = $temp['Entity']['entity_name'];

		$mongo = new Mongo($this->mongoDbURI);
		$db = $mongo->selectDB('victim');
		$collection = $db->selectCollection($entity);
		$data = $collection->find();
		$cnt=$collection->count(); 
        
		$this->set(compact('fields','entity','id','data','cnt'));
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
 * __checkExistance method
 * 
 * @return array
 */
	
	private function __checkExistance($id){
		if (!$this->Entity->exists($id)) {
			$this->Session->setFlash(__('Select an Entity first to add field to it'),'notices/error');
			$this->redirect($this->referer());
		}
		$fields = $this->Field->find('list',array('fields'=>array('field_name','field_type'),'conditions'=>array('entity_id'=>$id)));
		if(empty($fields)){
			$this->Session->setFlash(__('There is no field(s) in this Entity. Please add some firlds first.'),'notices/error');
			$this->redirect(array('controller'=>'fields','action'=>'add',$id));
		}
		else{
			return $fields;
		}
	}


/**
 * __checkValidity method
 * 
 * @return array
 */
	
	private function __checkValidity($data, $id){
		$fields = $this->Field->find('list',array('fields'=>array('field_name','field_type'),'conditions'=>array('entity_id'=>$id)));
		foreach ($data['Entity'] as $field => $value) {
			foreach ($fields as $name => $type) {
				if ($name == $field) {
					switch ($type) {
						case 'text':
							if( !empty($value) && !preg_match('/[a-zA-Z]/', $value)) {
								return FALSE;
							}
							break;

						case 'numbers':
							if( !empty($value) && !preg_match('/[0-9]/', $value)) {
								return FALSE;
							}
							break;

						case 'date':
							/*if(!preg_match('^(19|20)\d\d[- /.](0[1-9]|1[012])[- /.](0[1-9]|[12][0-9]|3[01])$', $value)) {
								return FALSE;
							}*/
							break;
						
						default:
							# code...
							break;
					}
					break;
				}
			}
		}
	}



/** edit method
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

public function viewExcel($id = null) {

        $this->autoRender=false;
		
	
		 
		$entity = null;
		$fields = $this->__checkExistance($id);

		$temp = $this->Entity->find('first',array('conditions'=>array($this->Entity->primaryKey => $id)));
		$entity = $temp['Entity']['entity_name'];
		
		$filename =$entity;
		$contents ="";
		
		
		$mongo = new Mongo($this->mongoDbURI);
		$db = $mongo->selectDB('victim');
		$collection = $db->selectCollection($entity);
		$data = $collection->find();
		
		foreach ($fields as $key => $field) : 
					$contents.= $key."\t"; 
		endforeach; 
					$contents.= "\n"; 
		$i = 0;
				foreach ($data as $value): 
						foreach ($fields as $key => $field) : 
							if(isset($value[$key]) && !empty($value[$key]) && $field != 'file' ) {
								$contents.=$value[$key]."\t";
							}
							elseif (isset($value[$key]) && !empty($value[$key]) && $field == 'file' && $value[$key]['size'] ) {
								//echo $this->Html->link(__($value[$key]['name']), '/uploads/'.$value[$key]['name'], array('class'=>'btn btn-info'));
								$contents.=$value[$key]['name']."\t";
							}
							else {
								$contents.='--'."\t";
							} 
			endforeach; 
			$contents.= "\n"; 
			endforeach; 

			
			header('Content-Transfer-Encoding: UTF-16LE');
			//header("Content-type: application/vnd.ms-excel");
	  //header("Pragma: public");
      //header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
      header("Content-Type: application/force-download");
      header("Content-Type: application/download");
      header("Content-Disposition: attachment; filename=\"".$filename.".xls\"");
	 	echo chr(255).chr(254).iconv("UTF-8", "UTF-16LE//IGNORE",$contents);
      // Name the file to .xlsx to solve the excel/openoffice file opening problem
     // header("Content-Disposition: attachment; filename=\"".$filename);
			
			//header('Content-Disposition: attachment; filename='.$filename);
			//header("Pragma: no-cache");
			//header("Expires: 0");
			//echo chr(255).chr(254).iconv("UTF-8", "UTF-16LE//IGNORE",$contents); 
			/*
			header('Content-Transfer-Encoding: UTF-16LE');
			//header("Content-type: application/vnd.ms-excel");
	  header("Pragma: public");
      header("Expires: 0");
      header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
      header("Content-Type: application/vnd.ms-excel; charset=UTF-8");
      header("Content-Type: application/force-download");
      header("Content-Type: application/download");;
      header("Content-Disposition: inline; filename=\"".$filename.".xls\"");
      // Name the file to .xlsx to solve the excel/openoffice file opening problem
     // header("Content-Disposition: attachment; filename=\"".$filename);
			
			//header('Content-Disposition: attachment; filename='.$filename);
			//header("Pragma: no-cache");
			//header("Expires: 0");
			echo chr(255).chr(254).iconv("UTF-8", "UTF-16LE//IGNORE",$contents); */
			
			
	
		 }
	

	 
		 
		 
public function import_excel($id = null) {
		$entity = null;
		$fields = $this->__checkExistance($id);

		$temp = $this->Entity->find('first',array('conditions'=>array($this->Entity->primaryKey => $id)));
		$entity = $temp['Entity']['entity_name'];

		if ($this->request->is('post')) {

			$filename = WWW_ROOT.'uploads'.DS.'csv'.DS.$this->request->data['Entity']['csv']['name'];

			move_uploaded_file($this->request->data['Entity']['csv']['tmp_name'], $filename );

			$mongo = new Mongo($this->mongoDbURI);
			$db = $mongo->selectDB('victim');
			$collection = $db->selectCollection($entity);

			$xls = new Spreadsheet_Excel_Reader($filename);
			for ($i=2; $i <= $xls->rowcount(); $i++) { 
				$data = array();
				for ($j=1; $j <= $xls->colcount(); $j++) { 
					$data[$xls->val(1,$j)] = $xls->val($i,$j);
				}
				$collection->insert($data);
			}

			unlink($filename);
			
			}
		$this->set(compact('fields','entity'));
	}
	
	
		 
	}

	

