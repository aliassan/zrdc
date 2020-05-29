<?php
class ZR_Autoloader
{
    private $class_path = '';
    private $abstract_class_path = '';
    private $scripts_paths = [];

    public function __construct() {
        $this->scripts_paths[] = plugin_dir_path( ZR_PLUGIN_FILE ) . 'inc/form-actions/*.php';
        $this->scripts_paths[] = plugin_dir_path( ZR_PLUGIN_FILE ) . 'inc/templates/*.php';
        spl_autoload_register( array( $this, 'class_autoloader' ) );
        spl_autoload_register( array( $this, 'abstract_autoloader' ) );
        $this->scripts_autoloader();
        $this->class_path = plugin_dir_path( ZR_PLUGIN_FILE ) . 'inc/';
        $this->abstract_class_path = plugin_dir_path( ZR_PLUGIN_FILE ) . 'inc/abstracts/';
    }

    private function class_autoloader( $class ) {
        $file = $this->get_file_name( $class );
        $path = $this->class_path;
        if ( is_readable( $path . $file ) ) {
            require_once( $path . $file );
        }
    }

    private function abstract_autoloader( $class ) {
        $file = $this->get_file_name( $class );
        $path = $this->abstract_class_path;
        if ( is_readable( $path . $file ) ) {
            require_once( $path . $file );
        }
    }

    private function scripts_autoloader() {
        foreach ($this->scripts_paths as $scripts_path) {
            foreach (glob($scripts_path) as $filename) {
                require_once $filename;
                //echo $filename;
            }
        }
    }

    private function get_file_name( $class ) {
        $class = strtolower( $class );
        return str_replace('_', '-', $class) . '.php';
    }
}

new ZR_Autoloader();
?>