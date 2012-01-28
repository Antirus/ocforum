<?php
/* /app/View/Helper/LinkHelper.php */
App::uses('AppHelper', 'View/Helper');

class DiscussionHelper extends AppHelper {
	public function latesDiscussions($Discussions){
		$discussions = $Discussions->getLatest();

		$output = '
    	<h5>'. __("Discussions").'</h5>
		<dl class="nice vertical tabs dl-categories">';

			foreach ($discussions as $discussion){
			    	$output .= '<dd>';
			    	$output .= '<a href="'.Router::url('/discussions/discussions/view/'.$discussion['Discussion']['id']).'">';// сделать через хелпер
			    	$output .= '<span class="menu-catname">'.mb_substr($discussion['Discussion']['title'], 0, 20, 'UTF-8').'</span>';
			    	$output .= '<span class="menu-catcount">'.$discussion['Discussion']['comments'].' comments</span>';
			    	$output .= '</a></dd>' ;
			}
		$output .= '</dl>';
		echo $output;
	}
}