<?php
/**
 * Copyright 2010, Cake Development Corporation (http://cakedc.com)
 *
 * Licensed under The MIT License
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright 2010, Cake Development Corporation (http://cakedc.com)
 * @license MIT License (http://www.opensource.org/licenses/mit-license.php)
 */

App::uses('Category', 'Categories.Model');
App::uses('CategoriesAppController', 'Categories.Controller');

/**
 * Categories controller
 *
 * @package categories
 * @subpackage categories.controllers
 */
class CategoriesController extends CategoriesAppController {

/**
 * Name
 *
 * @var string
 */
public $name = 'Categories';

    // public function index(){
    // 	$this->Category->recursive = 0;
    //     $this->set('categories', $this->paginate());
    // }

    public function admin_index(){
        

        $this->Category->recursive = 0;
        $this->set('categories', $this->paginate());
    }

    public function admin_add(){

        if (!empty($this->data) && $this->request->data['Category']['token'] == $this->Session->read('token')) {
            
            $this->Category->create();//создаем новую запись
            
            if ($this->Category->save($this->data)) {
                $this->Session->setFlash(__('The Category has been saved', true));
                $this->redirect(array('action'=>'admin_index', 'token' => $this->Session->read('token')));
            } else {
                $this->Session->setFlash(__('The Category could not be saved. Please, try again.', true));
            }
        }
        $categories = $this->Category->find('list');
        $this->set(compact('categories'));
    }

    public function admin_delete($id = null) {

        if (!$id) {
            $this->Session->setFlash(__('Invalid id for Category', true));
            $this->redirect(array('action'=>'admin_index', 'token' => $this->Session->read('token')));
        }
        if ($this->Category->delete($id)) {
            $this->Session->setFlash(__('Category deleted', true));
            $this->redirect(array('action'=>'admin_index', 'token' => $this->Session->read('token')));
        }
    }


    public function admin_edit($id = null){
        
        if (!$id && empty($this->data)) {
            $this->Session->setFlash(__('Invalid Category', true));
            $this->redirect(array('action'=>'admin_index', 'token' => $this->Session->read('token')));
        }
        if (!empty($this->data)) {
            if ($this->Category->save($this->data)) {//  а тут уже не нужно создавать новую запись, можно прост сохранить
                $this->Session->setFlash(__('The User has been saved', true));
                $this->redirect(array('action'=>'admin_index', 'token' => $this->Session->read('token')));
            } else {
                $this->Session->setFlash(__('The Category could not be saved. Please, try again.', true));
            }
        }
        if (empty($this->data)) {
            $this->data = $this->Category->read(null, $id);
        }
        $categories = $this->Category->find('list');
        $this->set(compact('categories'));
    }
}
