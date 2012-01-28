<?php 
App::uses('AppHelper', 'View/Helper');

class CategoryHelper extends AppHelper {
    public $helpers = array('Html');
    
	function categoryMenu($Categories, $Discussions){
		$categories = $Categories->getAllCategories();
		$all_categories_count = $Discussions->getTotal();

    	$output = '
    	<h5>'. __("Categories").'</h5>
		<dl class="nice vertical tabs dl-categories">';
		
			$output .= '<dd><a href="/">';// сделать через хелпер
	    	$output .= '<span class="menu-catname">All</span>';
	    	$output .= '<span class="menu-catcount">'.$all_categories_count.'</span>';
	    	$output .= '</a></dd>' ;

			foreach ($categories as $category){
			    	$output .= '<dd><a href="'.Router::url('/discussions/discussions/index/category:'.$category['Category']['id']).'">';// сделать через хелпер
			    	$output .= '<span class="menu-catname">'.$category['Category']['name'].'</span>';
			    	$output .= '<span class="menu-catcount">'.$category['Category']['count'].'</span>';
			    	$output .= '</a></dd>' ;
			}
		$output .= '</dl>';
		echo $output;
    }
    
}
