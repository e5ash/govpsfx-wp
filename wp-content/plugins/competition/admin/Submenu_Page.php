<?php

class Submenu_Page 
{
    private $paths = array();
    public function __construct($paths)
    {
        $this->paths = $paths;
    }
     /**
     * This function renders the contents of the page associated with the Submenu
     * that invokes the render method. In the context of this plugin, this is the
     * Submenu class.
     */
    public function render() {
        global $wpdb;
        if ( current_user_can('manage_options') ) {
            //echo 'This is the basic submenu page.';
            $views = $this->paths["views"];
            require_once("{$this->paths["controllers"]}/saveHistoryController.php");
        }
    }
}
