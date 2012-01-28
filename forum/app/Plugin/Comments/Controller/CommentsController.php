<?php
App::uses('Comment', 'Comments.Model');
App::uses('CommentsAppController', 'Comments.Controller');

class CommentsController extends CommentsAppController {
	public function add($id){
		$this->layout= 'ajax';

		if (!empty($this->data)) {
            $this->Comment->create();
            $this->request->data['Comment']['date'] = date('Y-m-d H:i:s');
            $viewer = $this->Members->getViewer();
			$this->request->data['Comment']['user_id'] = $viewer['User']['id'];
			$this->request->data['Comment']['user_type'] = $viewer['User']['type'];
			$this->request->data['Comment']['discussion_id'] = $id;

            if ($this->Comment->save($this->data)) {
                //$this->Session->setFlash(__('The Comment has been saved', true));
                $this->Comment->Discussion->id = $id;
                $discussion = $this->Comment->Discussion->findById($id);
                $this->Comment->Discussion->save(array('comments' => $discussion['Discussion']['comments'] + 1));
            } else {
                $this->Session->setFlash(__('The Comment could not be saved. Please, try again.', true));
            }
        }

		$this->set('comments', $this->Comment->find('all', array(
				'conditions' => array('Comment.discussion_id' => $id), //array of conditions
				'order' => array('Comment.date ASC'),
			)
		));
	}

	public function edit($id){
		$this->layout= 'ajax';
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid Comment'));
		}

		$comment = $this->Comment->read(null, $id);

		if(!$this->Members->isOwner($comment['Comment']['user_id'], $comment['Comment']['user_type'])){
			$this->redirect(array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'index'));
			exit();
		}

		if ($this->request->is('ajax') || $this->request->is('put')) {
			if ($this->Comment->save($this->request->data)) {
				//$this->Session->setFlash(__('The Comment has been saved.'));
			} else {
				$this->Session->setFlash(__('Invalid Comment'));
			}
		} else {
			$this->request->data = $this->Comment->read(null, $id);
		}

		$comment = $this->Comment->read(null, $id);
		$this->set('comment', $comment);
	}

	public function delete($id){
		$this->layout= 'ajax';
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid Comment'));
		}
		$comments = $this->Comment->read(null, $id);

		$this->Comment->Discussion->id;

		if(!$this->Members->isOwner($comments['Comment']['user_id'], $comments['Comment']['user_type'])){
			//$this->redirect(array('plugin' => 'discussions', 'controller' => 'discussions', 'action' => 'index'));
			die();
		}
		$discussion = $this->Comment->Discussion->read(null, $comments ['Comment']['discussion_id']);
		$this->Comment->Discussion->save(array('comments' => $discussion['Discussion']['comments'] - 1));

		$this->Comment->delete($id, false);

		$this->set('comments', $this->Comment->find('all', array(
				'conditions' => array('Comment.discussion_id' => $comments['Comment']['discussion_id']), //array of conditions
				'order' => array('Comment.date ASC'),
			)
		));
	}

	public function admin_index(){
		$this->Comment->recursive = 0;
		
		$this->paginate = array(
			'Comment' => array(
								'order' => 'Comment.date DESC' ,
								'limit' =>Configure::read('pagination_limit')
							)
	    );
		
        $this->set('comments', $this->paginate('Comment'));
		
	}

	public function admin_edit($id){
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid Comment'));
		}

		$comment = $this->Comment->read(null, $id);

		if ($this->request->is('ajax') || $this->request->is('put')) {
			if ($this->Comment->save($this->request->data)) {
				//$this->Session->setFlash(__('The Comment has been saved.'));
			} else {
				$this->Session->setFlash(__('Invalid Comment'));
			}
		} else {
			$this->request->data = $this->Comment->read(null, $id);
		}

		$comment = $this->Comment->read(null, $id);
		$this->set('comment', $comment);
		
	}

	public function admin_delete($id){
		$this->Comment->id = $id;
		if (!$this->Comment->exists()) {
			throw new NotFoundException(__('Invalid Comment'));
		}
		$comments = $this->Comment->read(null, $id);

		$this->Comment->Discussion->id;


		$discussion = $this->Comment->Discussion->read(null, $comments ['Comment']['discussion_id']);
		$this->Comment->Discussion->save(array('comments' => $discussion['Discussion']['comments'] - 1));

		$this->Comment->delete($id, false);
		$this->redirect(array('action'=>'admin_index', 'token' => $this->Session->read('token')));
	}
}