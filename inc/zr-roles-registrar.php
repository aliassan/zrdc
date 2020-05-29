<?php
class ZR_Roles_Registrar extends ZR_Registrar 
{
    public function register() {
        $this->register_admin_role();
        $this->register_ceo_role();
        $this->register_tech_role();
        $this->register_client_role();
        $this->register_finance_role();
        new ZR_User_Manager( [
            'user_name' => 'zr_admin',
            'user_email' => 'zr_admin@zrdc.co.zw',
            'user_role' => 'zr_admin',
            'default_role' => 'subscriber',
            'option' => 'create'
        ] );
    }

    private function register_admin_role() {
        add_role(
            'zr_admin',
            'ZRDC Administrator',
            [
                'activate_plugins' => true,
                'create_users' => true,
                'delete_users' => true,
                'edit_others_pages' => true,
                'edit_others_posts' => true,
                'edit_pages' => true,
                'edit_posts' => true,
                'edit_published_posts' => true,
                'edit_published_pages' => true,
                'edit_users' => true,
                'list_users' => true,
                'manage_categories' => true,
                'manage_options' => true,
                'promote_users' => true,
                'publish_pages' => true,
                'publish_posts' => true,
                'read' => true,
                'remove_users' => true,
                'upload_files' => true
            ]
        );
    }

    private function register_client_role() {
        add_role(
            'zr_client',
            'Client',
            [
                'edit_others_pages' => true,
                'edit_others_posts' => true,
                'edit_pages' => true,
                'edit_posts' => true,
                'edit_published_posts' => true,
                'edit_published_pages' => true,
                'manage_categories' => true,
                'manage_options' => true,
                'publish_pages' => true,
                'publish_posts' => true,
                'read' => true,
                'upload_files' => true
            ]
        );
    }

    private function register_tech_role() {
        add_role(
            'zr_tech',
            'Technical Services',
            [
                'edit_others_pages' => true,
                'edit_others_posts' => true,
                'edit_pages' => true,
                'edit_posts' => true,
                'edit_published_posts' => true,
                'edit_published_pages' => true,
                'manage_categories' => true,
                'manage_options' => true,
                'publish_pages' => true,
                'publish_posts' => true,
                'read' => true,
                'upload_files' => true
            ]
        );
    }

    private function register_ceo_role() {
        add_role(
            'zr_ceo',
            'CEO',
            [
                'edit_others_pages' => true,
                'edit_others_posts' => true,
                'edit_pages' => true,
                'edit_posts' => true,
                'edit_published_posts' => true,
                'edit_published_pages' => true,
                'edit_users' => true,
                'list_users' => true,
                'manage_categories' => true,
                'manage_options' => true,
                'publish_pages' => true,
                'publish_posts' => true,
                'read' => true,
                'upload_files' => true
            ]
        );
    }

    private function register_finance_role() {
        add_role(
            'zr_finance',
            'Finance',
            [
                'edit_others_pages' => true,
                'edit_others_posts' => true,
                'edit_pages' => true,
                'edit_posts' => true,
                'edit_published_posts' => true,
                'edit_published_pages' => true,
                'manage_categories' => true,
                'manage_options' => true,
                'publish_pages' => true,
                'publish_posts' => true,
                'read' => true,
                'upload_files' => true
            ]
        );
    }

    public static function instance() {
        return new self();
    }
}
?>