<?php
class ControllerModuleOcforum extends Controller {
	private $error = array(); 
	
	public function index() { 
		$this->load->language("module/ocforum");

		$this->document->setTitle($this->language->get("heading_title")); 
		
		$this->load->model("setting/setting");
				
		if (($this->request->server["REQUEST_METHOD"] == "POST") && $this->validate()) {
			$this->model_setting_setting->editSetting("ocforum", $this->request->post);		
					
			$this->session->data["success"] = $this->language->get("text_success");
						
			$this->redirect($this->url->link("extension/module", "token=" . $this->session->data["token"], "SSL"));
		}
		
		$this->data["heading_title"] = $this->language->get("heading_title");
		
		$this->data["text_enabled"] = $this->language->get("text_enabled");
		
		//tabs
		$this->data["tab_general"] = $this->language->get("tab_general");
		$this->data["tab_categories"] = $this->language->get("tab_categories");
		$this->data["tab_permissions"] = $this->language->get("tab_permissions");
		$this->data["tab_discussions"] = $this->language->get("tab_discussions");
		$this->data["tab_comments"] = $this->language->get("tab_comments");
		
		//buttons
		$this->data["button_cancel"] = $this->language->get("button_cancel");
		
		//errors
		if (isset($this->error["warning"])) {
			$this->data["error_warning"] = $this->error["warning"];
		} else {
			$this->data["error_warning"] = "";
		}
		
		//breadcrumbs
		$this->data["breadcrumbs"] = array();

   		$this->data["breadcrumbs"][] = array(
       		"text"      => $this->language->get("text_home"),
			"href"      => $this->url->link("common/home", "token=" . $this->session->data["token"], "SSL"),
      		"separator" => false
   		);

   		$this->data["breadcrumbs"][] = array(
       		"text"      => $this->language->get("text_module"),
			"href"      => $this->url->link("extension/module", "token=" . $this->session->data["token"], "SSL"),
      		"separator" => " :: "
   		);
		
   		$this->data["breadcrumbs"][] = array(
       		"text"      => $this->language->get("heading_title"),
			"href"      => $this->url->link("module/ocforum", "token=" . $this->session->data["token"], "SSL"),
      		"separator" => " :: "
   		);
		
		$this->data["action"] = $this->url->link("module/ocforum", "token=" . $this->session->data["token"], "SSL");
		
		$this->data["cancel"] = $this->url->link("extension/module", "token=" . $this->session->data["token"], "SSL");
		
		//------------------------------
		//insert you data
		//------------------------------
		
		$this->data["token"] =  $this->session->data["token"];
				
		$this->load->model("design/layout");
		
		$this->data["layouts"] = $this->model_design_layout->getLayouts();
		
		$this->template = "module/ocforum.tpl";
		$this->children = array(
			"common/header",
			"common/footer",
		);
		
		$this->data["token"] = $this->session->data["token"];
				
		$this->response->setOutput($this->render());
	}
	
	public function install(){
		$this->db->query("DROP TABLE IF EXISTS `".DB_PREFIX."discussions`");

		$this->db->query("CREATE TABLE `".DB_PREFIX."discussions` (                                
                  `id` int(11) NOT NULL AUTO_INCREMENT,                        
                  `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,        
                  `body` text CHARACTER SET utf8,                              
                  `user_id` int(11) DEFAULT NULL,                              
                  `date` datetime DEFAULT NULL,                                
                  `category_id` int(11) DEFAULT NULL,                          
                  `status` tinyint(1) DEFAULT '1',                             
                  `views` int(11) DEFAULT '0',                                 
                  `comments` int(11) DEFAULT '0',                              
                  `user_type` varchar(255) CHARACTER SET utf8 DEFAULT 'user',  
                  PRIMARY KEY (`id`)                                           
                ) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 ");
        
        $this->db->query("INSERT INTO `".DB_PREFIX."discussions` SET id=1, title='Hello world!!', body='This is a test discussion', user_id=1, date='".date('Y-m-d H-i-s') ."', category_id=1, status=1, views=0, comments=2, user_type='admin'");

        $this->db->query("DROP TABLE IF EXISTS `".DB_PREFIX."admins_groups`");
        $this->db->query("CREATE TABLE `".DB_PREFIX."admins_groups` (                        
                    `id` int(11) NOT NULL AUTO_INCREMENT,                  
                    `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,  
                    `permissions` text CHARACTER SET utf8,                 
                    PRIMARY KEY (`id`)                                     
                  ) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8");
        
        $this->db->query("DROP TABLE IF EXISTS `".DB_PREFIX."users_groups`");
        $this->db->query("CREATE TABLE `".DB_PREFIX."users_groups` (                         
                   `id` int(11) NOT NULL AUTO_INCREMENT,                  
                   `title` varchar(255) CHARACTER SET utf8 DEFAULT NULL,  
                   `permissions` text CHARACTER SET utf8,                 
                   PRIMARY KEY (`id`)                                     
                 ) ENGINE=MyISAM DEFAULT CHARSET=utf8");

        $this->db->query("DROP TABLE IF EXISTS `".DB_PREFIX."comments`");
        $this->db->query("CREATE TABLE `".DB_PREFIX."comments` (                                   
               `id` int(11) NOT NULL AUTO_INCREMENT,                        
               `body` text CHARACTER SET utf8,                              
               `discussion_id` int(11) DEFAULT NULL,                        
               `user_id` int(11) DEFAULT NULL,                              
               `date` datetime DEFAULT NULL,                                
               `user_type` varchar(255) CHARACTER SET utf8 DEFAULT 'user',  
               PRIMARY KEY (`id`)                                           
             ) ENGINE=MyISAM AUTO_INCREMENT=32 DEFAULT CHARSET=utf8");
        
       	$this->db->query("INSERT INTO `".DB_PREFIX."comments` 
       					(id, body, discussion_id, user_id, date, user_type)
       					VALUES 
       					(1, 'This is a test comment', '1', '1', '".date('Y-m-d H-i-s')."' ,'admin'),
       					(2, 'This is a test comment [b]next[/b]', '1', '1', '".date('Y-m-d H-i-s')."' ,'admin')");
        
        $this->db->query("DROP TABLE IF EXISTS `".DB_PREFIX."settings`");
        $this->db->query("CREATE TABLE `".DB_PREFIX."settings` (                             
               `id` int(11) NOT NULL AUTO_INCREMENT,                  
               `name` varchar(255) CHARACTER SET utf8 DEFAULT NULL,   
               `value` text CHARACTER SET utf8,                       
               PRIMARY KEY (`id`)                                     
             ) ENGINE=MyISAM AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 ");

        
        $this->db->query('INSERT INTO `'.DB_PREFIX.'settings` 
       					(id, name, value)
       					VALUES 
       					(1, \'shop_url\', \'http://ocforum.my/\'),
       					(2, \'pagination_limit\', \'20\'),
       					(3, \'forum_name\', \'OC Forum\'),
       					(4, \'forum_slogan\', \'Developed by @horechek\'),
       					(5, \'admins_permissions\', \'a:1:{s:6:"routes";a:12:{s:11:"canviewmain";a:3:{s:6:"plugin";s:11:"discussions";s:10:"controller";s:11:"discussions";s:6:"action";s:5:"index";}s:7:"canview";a:3:{s:6:"plugin";s:11:"discussions";s:10:"controller";s:11:"discussions";s:6:"action";s:4:"view";}s:11:"createposts";a:3:{s:6:"plugin";s:11:"discussions";s:10:"controller";s:11:"discussions";s:6:"action";s:6:"create";}s:12:"commentposts";a:3:{s:6:"plugin";s:8:"comments";s:10:"controller";s:8:"comments";s:6:"action";s:3:"add";}s:10:"removepost";a:3:{s:6:"plugin";s:11:"discussions";s:10:"controller";s:11:"discussions";s:6:"action";s:6:"delete";}s:13:"removecomment";a:3:{s:6:"plugin";s:8:"comments";s:10:"controller";s:8:"comments";s:6:"action";s:6:"delete";}s:8:"editpost";a:3:{s:6:"plugin";s:11:"discussions";s:10:"controller";s:11:"discussions";s:6:"action";s:4:"edit";}s:11:"editcomment";a:3:{s:6:"plugin";s:8:"comments";s:10:"controller";s:8:"comments";s:6:"action";s:4:"edit";}s:15:"userdiscussions";a:3:{s:6:"plugin";s:5:"users";s:10:"controller";s:5:"users";s:6:"action";s:11:"discussions";}s:12:"usercomments";a:3:{s:6:"plugin";s:5:"users";s:10:"controller";s:5:"users";s:6:"action";s:8:"comments";}s:9:"userlogin";a:3:{s:6:"plugin";s:5:"users";s:10:"controller";s:5:"users";s:6:"action";s:5:"login";}s:10:"userlogout";a:3:{s:6:"plugin";s:5:"users";s:10:"controller";s:5:"users";s:6:"action";s:6:"logout";}}}\'),
       					(6, \'users_permissions\', \'a:1:{s:6:"routes";a:12:{s:11:"canviewmain";a:3:{s:6:"plugin";s:11:"discussions";s:10:"controller";s:11:"discussions";s:6:"action";s:5:"index";}s:7:"canview";a:3:{s:6:"plugin";s:11:"discussions";s:10:"controller";s:11:"discussions";s:6:"action";s:4:"view";}s:11:"createposts";a:3:{s:6:"plugin";s:11:"discussions";s:10:"controller";s:11:"discussions";s:6:"action";s:6:"create";}s:12:"commentposts";a:3:{s:6:"plugin";s:8:"comments";s:10:"controller";s:8:"comments";s:6:"action";s:3:"add";}s:10:"removepost";a:3:{s:6:"plugin";s:11:"discussions";s:10:"controller";s:11:"discussions";s:6:"action";s:6:"delete";}s:13:"removecomment";a:3:{s:6:"plugin";s:8:"comments";s:10:"controller";s:8:"comments";s:6:"action";s:6:"delete";}s:8:"editpost";a:3:{s:6:"plugin";s:11:"discussions";s:10:"controller";s:11:"discussions";s:6:"action";s:4:"edit";}s:11:"editcomment";a:3:{s:6:"plugin";s:8:"comments";s:10:"controller";s:8:"comments";s:6:"action";s:4:"edit";}s:15:"userdiscussions";a:3:{s:6:"plugin";s:5:"users";s:10:"controller";s:5:"users";s:6:"action";s:11:"discussions";}s:12:"usercomments";a:3:{s:6:"plugin";s:5:"users";s:10:"controller";s:5:"users";s:6:"action";s:8:"comments";}s:9:"userlogin";a:3:{s:6:"plugin";s:5:"users";s:10:"controller";s:5:"users";s:6:"action";s:5:"login";}s:10:"userlogout";a:3:{s:6:"plugin";s:5:"users";s:10:"controller";s:5:"users";s:6:"action";s:6:"logout";}}}\'),
       					(7, \'guests_permissions\', \'a:1:{s:6:"routes";a:3:{s:11:"canviewmain";a:3:{s:6:"plugin";s:11:"discussions";s:10:"controller";s:11:"discussions";s:6:"action";s:5:"index";}s:7:"canview";a:3:{s:6:"plugin";s:11:"discussions";s:10:"controller";s:11:"discussions";s:6:"action";s:4:"view";}s:9:"userlogin";a:3:{s:6:"plugin";s:5:"users";s:10:"controller";s:5:"users";s:6:"action";s:5:"login";}}}\'),
       					(8, \'sidebar_text\', \'We`re stoked you want to try Foundation! To get going, this file (index.html) includes some basic styles you can modify, play around with, or totally destroy to get going.\'),
       					(9, \'footer_text\', \'<div class="four columns">
<p>This is a twelve column section in a row. Each of these includes a div.panel element so you can see where the columns are - it`s not required at all for the grid.</p>
</div>
<div class="four columns">
<p>This is a twelve column section in a row. Each of these includes a div.panel element so you can see where the columns are - it`s not required at all for the grid.</p>
</div>
<div class="four columns">
<p>This is a twelve column section in a row. Each of these includes a div.panel element so you can see where the columns are - it`s not required at all for the grid.</p>
</div>\')');

		$this->db->query("DROP TABLE IF EXISTS `".DB_PREFIX."categories`");

		$this->db->query('CREATE TABLE `'.DB_PREFIX.'categories` (                           
             `id` int(11) NOT NULL AUTO_INCREMENT,                  
             `category_id` int(11) DEFAULT NULL,                    
             `name` varchar(255) CHARACTER SET utf8 NOT NULL,       
             `slug` varchar(255) CHARACTER SET utf8 DEFAULT NULL,   
             `count` int(11) DEFAULT "0",                           
             PRIMARY KEY (`id`),                                    
             UNIQUE KEY `UNIQUE_USER_CATEGORY` (`name`)             
           ) ENGINE=MyISAM AUTO_INCREMENT=3 DEFAULT CHARSET=utf8');

        $this->db->query("INSERT INTO `".DB_PREFIX."categories` 
			(id, name)
			VALUES 
			(1, 'Test'),
			(2, 'Help'),
			(3, 'FAQ')");
	}
	
	public function uninstall(){
	
	}
	
	private function validate() {
		if (!$this->user->hasPermission("modify", "module/ocforum")) {
			$this->error["warning"] = $this->language->get("error_permission");
		}

		
		if (!$this->error) {
			return true;
		} else {
			return false;
		}	
	}
}
?>