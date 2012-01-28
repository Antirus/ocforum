<?php
App::uses('Category', 'Categories.Model');

class CategoriesComponent extends Component {
	private $controller;

	public function initialize($controller){
		$controller->loadModel('Categories.Category');
		$this->controller = $controller;
	}

	public function beforeRender($controller){
		$controller->set('Categories', $this);
	}

	public function categoryName($id, $link = true, $blank = false){
		$category = $this->controller->Category->findById($id);
		if (!$category) {
			return '...';
		}

		$output = "";
		if($link){
			$output .= '<a href="'.Router::url('/discussions/discussions/index/category:'.$id).'"';
			if($blank){
				$output .= ' target="_blank" ';
			}
			$output .= '">'.$category['Category']['name'].'</a>';
		}else{
			$output = $category['Category']['name'];
		}

		return $output;
	}

	public function getAllCategories(){
		return $this->controller->Category->find('all');
	}
}