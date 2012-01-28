<?php
class ControllerModuleOcforum extends Controller {
	
	public function index() { 
		$this->load->language("module/ocforum");

		$this->data["heading_title"] = $this->language->get("heading_title");
		
		if (file_exists(DIR_TEMPLATE . $this->config->get("config_template") . "/template/module/ocforum.tpl")) {
			$this->template = $this->config->get("config_template") . "/template/module/ocforum.tpl";
		} else {
			$this->template = "default/template/module/ocforum.tpl";
		}
		
		
	$this->render();
	}
}
?>