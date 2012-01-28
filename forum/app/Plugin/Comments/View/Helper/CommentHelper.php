<?php
/* /app/View/Helper/LinkHelper.php */
App::uses('AppHelper', 'View/Helper');

class CommentHelper extends AppHelper {
	public function latesComments($Comments){
		$comments = $Comments->getLatest();

		$output = '
    	<h5>'. __("Comments").'</h5>
		<dl class="nice vertical tabs dl-categories">';

			foreach ($comments as $comment){
			    	$output .= '<dd>';
			    	$output .= '<a href="'.Router::url('/discussions/discussions/view/'.$comment['Comment']['discussion_id']).'">';// сделать через хелпер

			    	$text = str_replace('[b]', '', $comment['Comment']['body']);
			    	$text = str_replace('[/b]', '', $text );
			    	$text = str_replace('[i]', '', $text );
			    	$text = str_replace('[/i]', '', $text );
			    	$text = str_replace('[url]', '', $text );
			    	$text = str_replace('[/url]', '', $text );

			    	$output .= '<span class="menu-catname">'.substr($text, 0, 20).'</span>';
			    	$output .= '<span class="menu-catcount">'.$comment['Comment']['date'].'</span>';
			    	$output .= '...</a></dd>' ;
			}
		$output .= '</dl>';
		echo $output;
	}
}