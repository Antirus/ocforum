<?php
/* /app/View/Helper/LinkHelper.php */
App::uses('AppHelper', 'View/Helper');

class PermissionHelper extends AppHelper {
	public $helpers = array('Html', 'Form');

	private $permissions = array(
		'canviewmain' => 'Can view main page',
		'canview' => 'Can view posts',
		'createposts' => 'Can create posts',
		'commentposts' => 'Can comment posts',
		'removepost' => 'Can remove posts',
		'removecomment' => 'Can remove comments',
		'editpost' => 'Can edit posts',
		'editcomment' => 'Can edit comments',
		'userdiscussions' => 'Can view user discussions',
		'usercomments' => 'Can view user comments',
		'userlogin' => 'Can user login',
		'userlogout' => 'Can user logout',
		);
	
	private $permissions_guest = array(
		'canviewmain' => 'Can view main page',
		'canview' => 'Can view posts',
		'userlogin' => 'Can login',
	);

	public function renderAdminPermissions($permissions){

		$output = "";
		foreach ($this->permissions as $key => $value) {
			$checked = ""; 
			if(isset($permissions['routes'][$key])){
				$checked = "checked";
			}
			$output .= "<label for='PermissionsAdmin".$key."'>";
			$output .= $this->Form->input('title', array('type' => 'checkbox', 'label' => false, 'name' => 'data[Permissions][admin]['.$key.']', 'id' => 'PermissionsAdmin'.$key, 'checked' => $checked));
			$output .= __($value);
			$output .= "</label>";
		}
		echo $output;
	}

	public function renderUserPermissions($permissions){

		$output = "";
		foreach ($this->permissions as $key => $value) {
			$checked = "";
			if(isset($permissions['routes'][$key])){
				$checked = "checked";
			}
			$output .= "<label for='PermissionsUser".$key."'>";
			$output .= $this->Form->input('title', array('type' => 'checkbox', 'label' => false, 'name' => 'data[Permissions][user]['.$key.']', 'id' => 'PermissionsUser'.$key, 'checked' => $checked));
			$output .= __($value);
			$output .= "</label>";
		}
		echo $output;
	}

	public function renderGuestPermissions($permissions){

		$output = "";
		foreach ($this->permissions_guest as $key => $value) {
			$checked = "";
			if(isset($permissions['routes'][$key])){
				$checked = "checked";
			}
			$output .= "<label for='PermissionsGuest".$key."'>";
			$output .= $this->Form->input('title', array('type' => 'checkbox', 'label' => false, 'name' => 'data[Permissions][guest]['.$key.']', 'id' => 'PermissionsGuest'.$key, 'checked' => $checked));
			$output .= __($value);
			$output .= "</label>";
		}
		echo $output;
	}
}