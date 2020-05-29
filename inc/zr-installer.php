<?php
class ZR_Installer 
{
    public function __construct() {
        register_activation_hook( ZR_PLUGIN_FILE, array( $this, 'activate' ) );
        $this->init();
    }

    private function activate() {
        ZR_Tax_Registrar::instance()->register();
        ZR_CPT_registrar::instance()->register();
        ZR_Options_Registrar::instance()->register();
        ZR_Roles_Registrar::instance()->register();
        flush_rewrite_rules();
    }

    private function init() {
        ZR_Tax_Registrar::instance()->init();
        ZR_CPT_registrar::instance()->init();
        ZR_Options_Registrar::instance()->init();
        ZR_Roles_Registrar::instance()->init();
        ZR_Login::instance()->init();
    }

    public static function instance() {
        return new self();
    }
}
?>