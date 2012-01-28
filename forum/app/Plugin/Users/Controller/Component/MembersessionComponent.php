<?php
// Component defined in 'ContactManager' plugin
class MembersessionComponent extends Component {

	private $session;

	public function initialize(){

		if (!session_id()) {
			ini_set('session.use_cookies', 'On');
			ini_set('session.use_trans_sid', 'Off');
			
			session_set_cookie_params(0, '/');
			session_start();
		}
		$this->session = & $_SESSION;
	}

	public function get($key){
		if(isset($this->session[$key])){
			return $this->session[$key];
		}
		return NULL;
	}

	public function set($key, $value){
		return $this->session[$key] = $value;
	}

	public function destroy(){
		unset($this->session['user_id']);
		unset($this->session['customer_id']);
		unset($this->session['token']);
		
		session_destroy();
	}
}
