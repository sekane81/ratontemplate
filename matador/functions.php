<?php

/*----------------------------------------------------------------------------*/
/* Functions - You probably don't want to edit this top bit */
/*----------------------------------------------------------------------------*/
define('TS_PATH', get_template_directory_uri());
define('TS_SERVER_PATH', get_template_directory());

$includes_path = TS_SERVER_PATH . '/includes/';

// Theme specific functionality
require_once ($includes_path . 'theme-functions.php'); 		// Custom theme functions
require_once ($includes_path . 'theme-dyn-css.php'); 		// Dynamic CSS
require_once ($includes_path . 'theme-scripts.php');		// Load css & javascript
require_once ($includes_path . 'theme-sidebars.php');		// Initialize widgetized areas
require_once ($includes_path . 'theme-plugins.php');		// Initialize widgetized areas

/*-----------------------------------------------------------------------------------*/
/* End Functions - Feel free to add custom functions below */
/*-----------------------------------------------------------------------------------*/
