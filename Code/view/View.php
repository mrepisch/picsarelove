<?php
class View {
	
	private $viewFile;
	
	function __construct( $p_viewFile) {
		$this->viewFile = $p_viewFile;
	}
	
    public function __set($p_key, $p_value)
    {
        if (!isset($this->$p_key)) {
            $this->properties[$p_key] = $p_value;
        }
    }

    public function __get($p_key)
    {
        if (isset($this->properties[$p_key])) {
            return $this->properties[$p_key];
        }
    }
	
	function display() {
		if( !empty($this->properties)) {
			extract($this->properties);
		}
		require 'view/login.php';
        require 'view/navi.php';
        require $this->viewFile;
        
		
	}
}