<?php 

class CademiRedirect 
{
    protected $loader;
    public function __construct() {

        if (WP_DEBUG) {
            error_reporting(E_ALL | E_WARNING | E_NOTICE);
            ini_set("display_errors", TRUE);
        }

        // Loader & Settings
        require_once plugin_dir_path(dirname(__FILE__)) . "includes/class-cademi-redirect-loader.php";
        require_once plugin_dir_path(dirname(__FILE__)) . "includes/class-cademi-redirect-settings.php";
        $this->loader = new CademiRedirectLoader();
        
        // Admin
        require_once plugin_dir_path(dirname(__FILE__)) . "admin/class-cademi-redirect-admin.php";
        new CademiRedirectAdmin($this->loader);

        // Core
        require_once plugin_dir_path(dirname(__FILE__)) . "includes/class-cademi-redirect-core.php";
        new CademiRedirectCore($this->loader);
    }
    
    public function run() 
    {
        $this->loader->run();
    }

    public function get_plugin_name() 
    {
        return $this->plugin_name;
    }

    public function get_loader() 
    {
        return $this->loader;
    }

    public function get_version() 
    {
        return $this->version;
    }

}