<?php
class View {
	
	private $viewFile;
	
	private $properties = array();
	
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
	
	function display($p_showAll = true,$p_showContent = true) {
		if( !empty($this->properties)) {
			extract($this->properties);
		}
		if( $p_showAll ) {
			require_once 'view/login.php';
        	require_once 'view/navi.php';
		}
		if( $p_showContent ){
        	require_once $this->viewFile;
		}
        
		
	}
}