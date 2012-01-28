<?php
App::uses('Discussion', 'Discussions.Model');
App::uses('DiscussionsAppController', 'Discussions.Controller');

class DiscussionsController extends DiscussionsAppController {

	public $name = 'Discussions';
	
	public function index() {
		$category = $this->request->params['named'];
		$this->Discussion->recursive = 0;
		if(isset($this->request->params['named']['category'])){
			$this->paginate = array(
		        'conditions' => array('Discussion.category_id' => $category, 'Discussion.status' => 1),
				'order' => 'Discussion.date DESC', 
				'limit' =>Configure::read('pagination_limit')
		    );
		}else{
			$this->paginate = array(
				'conditions' => array('Discussion.status' => 1),
				'order' => 'Discussion.date DESC',
				'limit' => Configure::read('pagination_limit')
		    );
		}

        $this->set('discussions', $this->paginate());
	}

	public function create(){
		$viewer = $this->Members->getViewer();
		
		if (!empty($this->data)) {
            $this->Discussion->create();
            $this->request->data['Discussion']['date'] = date('Y-m-d H:i:s');
            $viewer = $this->Members->getViewer();
			$this->request->data['Discussion']['user_id'] = $viewer['User']['id'];
			$this->request->data['Discussion']['user_type'] = $viewer['User']['type'];

            if ($this->Discussion->save($this->data)) {
            	//$this->Discussion->Category->find('list');
            	$category = $this->Discussion->Category->findById($this->data['Discussion']['category_id']);
            	$this->Discussion->Category->id = $this->data['Discussion']['category_id'];
            	$this->Discussion->Category->save(array('count' => $category['Category']['count']+1));
                //$this->Session->setFlash(__('The Discussion has been saved', true));
                $this->redirect(array('action'=>'view', $this->Discussion->id));
            } else {
                $this->Session->setFlash(__('The Discussion could not be saved. Please, try again.', true));
            }
        }
        
        
        $categories = $this->Discussion->Category->find('list');
        $this->set(compact('categories'));
	}

	public function view($id){
		$this->Discussion->id = $id;
		if (!$this->Discussion->exists()) {
			throw new NotFoundException(__('Invalid Discussion'));
		}

		$discussion = $this->Discussion->read(null, $id);
        $this->Discussion->save(array('views' => $discussion['Discussion']['views'] + 1));
        
        if ($this->request->is('post') || $this->request->is('put')) {
			if ($this->Discussion->save($this->request->data)) {
				//$this->Session->setFlash(__('The Discussion has been saved.'));
			} else {
				$this->Session->setFlash(__('Invalid Discussion'));
			}
		} else {
			$this->request->data = $this->Discussion->read(null, $id);
		}
		$user = $this->Members->getUserById($discussion['Discussion']['user_id']);
		$discussion['User'] = $user['User'];
		$this->set('discussion', $discussion);
		// $this->paginate = array(
		// 	'Comment' => array(
		//         'conditions' => array('Comment.discussion_id' => $id),
		// 		'order' => 'Comment.date ASC' 
		// 	)
		// );

		// $this->set('comments', $this->paginate('Comment'));
		$this->set('comments', $this->Discussion->Comment->find('all', array(
				'conditions' => array('Comment.discussion_id' => $id), //array of conditions
				'order' => array('Comment.date ASC'),
			)
		));

		$categories = $this->Discussion->Category->find('list');
        $this->set(compact('categories'));
	}

	public function edit($id){
		$this->layout= 'ajax';
		$this->Discussion->id = $id;
		if (!$this->Discussion->exists()) {
			throw new NotFoundException(__('Invalid Discussion'));
		}
		$discussion = $this->Discussion->read(null, $id);
		if(!$this->Members->isOwner($discussion['Discussion']['user_id'], $discussion['Discussion']['user_type'])){
			//$this->redirect(array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'index'));
			die();
		}

		if ($this->request->is('ajax') || $this->request->is('put')) {
			
			//убираем счетчик по категориям с бывшей категории
			$category = $this->Discussion->Category->findById($discussion['Discussion']['category_id']);
            if($category){
				$this->Discussion->Category->id = $discussion['Discussion']['category_id'];
				$count = $category['Category']['count'] - 1;
				if($count < 0){
					$category['Category']['count'] = 0;
				}
				$this->Discussion->Category->save($category);
			}

			if ($this->Discussion->save($this->request->data)) {
				//$this->Session->setFlash(__('The Discussion has been saved.'));

				//увеличиваем счетчик по новой категории
				$category = $this->Discussion->Category->findById($this->data['Discussion']['category_id']);
            	if($category){
					$this->Discussion->Category->id = $discussion['Discussion']['category_id'];
					$count = $category['Category']['count'] - 1;
					if($count < 0){
						$category['Category']['count'] = 0;
					}
					$this->Discussion->Category->save($category);
				}
			} else {
				$this->Session->setFlash(__('Invalid Discussion'));
			}
		} else {
			//$this->request->data = $this->Discussion->read(null, $id);
		}
		$discussion = $this->Discussion->read(null, $id);
		$this->set('discussion', $discussion);
	}

	public function delete($id){
		$this->Discussion->id = $id;
		if (!$this->Discussion->exists()) {
			throw new NotFoundException(__('Invalid Discussion'));
		}
		$discussion = $this->Discussion->read(null, $id);
		if(!$this->Members->isOwner($discussion['Discussion']['user_id'], $discussion['Discussion']['user_type'])){
			//$this->redirect(array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'index'));
			die();
		}
	
		$category = $this->Discussion->Category->read(null, $discussion['Discussion']['category_id']);
		if($category){
			$this->Discussion->Category->id = $discussion['Discussion']['category_id'];
			$count = $category['Category']['count'] - 1;
			if($count < 0){
				$category['Category']['count'] = 0;
			}
			$this->Discussion->Category->save($category);
		}

		$this->Discussion->delete($id, true);
		$this->Discussion->Comment->deleteAll(array('Comment.discussion_id' => $id), true);
		$this->redirect(array('action' => 'index'));
	}

	public function admin_index(){

        $this->Discussion->recursive = 0;
		
		$this->paginate = array(
			'order' => 'Discussion.date DESC',
			'limit' => Configure::read('pagination_limit')
		);

        $this->set('discussions', $this->paginate());
	}

	public function admin_delete($id){
		$this->Discussion->id = $id;
		if (!$this->Discussion->exists()) {
			throw new NotFoundException(__('Invalid Discussion'));
		}
		$discussion = $this->Discussion->read(null, $id);
		$category = $this->Discussion->Category->read(null, $discussion['Discussion']['category_id']);

		if($category){
			$this->Discussion->Category->id = $discussion['Discussion']['category_id'];
			$count = $category['Category']['count'] - 1;
			if($count < 0){
				$category['Category']['count'] = 0;
			}
			$this->Discussion->Category->save($category);
		}
		$this->Discussion->delete($id, true);
		$this->Discussion->Comment->deleteAll(array('Comment.discussion_id' => $id), true);
		$this->redirect(array('action'=>'admin_index', 'token' => $this->Session->read('token')));
	}

	public function admin_edit($id){

		$this->Discussion->id = $id;
		if (!$this->Discussion->exists()) {
			throw new NotFoundException(__('Invalid Discussion'));
		}
		$discussion = $this->Discussion->read(null, $id);
		if ($this->request->is('post') || $this->request->is('put')) {
			
			//убираем счетчик по категориям с бывшей категории
			$category = $this->Discussion->Category->findById($discussion['Discussion']['category_id']);
            if($category){
				$this->Discussion->Category->id = $discussion['Discussion']['category_id'];
				$count = $category['Category']['count'] - 1;
				if($count < 0){
					$category['Category']['count'] = 0;
				}
				$this->Discussion->Category->save($category);
			}

			if ($this->Discussion->save($this->request->data)) {

				//увеличиваем счетчик по новой категории
				$category = $this->Discussion->Category->findById($this->data['Discussion']['category_id']);
            	if($category){
					$this->Discussion->Category->id = $discussion['Discussion']['category_id'];
					$count = $category['Category']['count'] - 1;
					if($count < 0){
						$category['Category']['count'] = 0;
					}
					$this->Discussion->Category->save($category);
				}
				//$this->Session->setFlash(__('The Discussion has been saved.'));
			} else {
				$this->Session->setFlash(__('Invalid Discussion'));
			}
		} else {
			//$this->request->data = $this->Discussion->read(null, $id);
		}
		$this->data = $discussion = $this->Discussion->read(null, $id);
		$this->set('discussion', $discussion);
		$categories = $this->Discussion->Category->find('list');
        $this->set(compact('categories'));

	}
}
