<?php
class ZR_CPT_Registrar extends ZR_Registrar
{
    public function register() {
        $this->register_application_cpt();
        $this->register_offer_cpt();
        $this->register_stand_cpt();
    }

    /**
     * Register Stand Cuctom Post Type
     */
    private function register_stand_cpt() {
        $args = [
            'labels' => [
                'name' => __('Stands'),
                'singular_name' => __('Stand')
            ],
            'public' => true,
            'has_archive' => true,
            'taxonomies' => ['stand_type'],
            'supports' => [
                'title',
                'editor',
                'custom-fields',
                'post-thumbnails',
                'post-formats'
            ]
        ];
        register_post_type('stand', $args);
    }

    /**
     * Register Offer Letter Cuctom Post Type
     */
    private function register_offer_cpt() {
        $args = [
            'labels' => [
                'name' => __('Offer Letters'),
                'singular_name' => __('Offer Letter')
            ],
            'public' => true,
            'has_archive' => true,
            'supports' => [
                'title',
                'editor',
                'custom-fields',
                'post-thumbnails',
                'post-formats'
            ]
        ];
        register_post_type('offer', $args);
    }

    /**
     * Register Applications Cuctom Post Type
     */
    private function register_application_cpt() {
        $args = [
            'labels' => [
                'name' => __('Applications'),
                'singular_name' => __('Application')
            ],
            'public' => true,
            'has_archive' => true,
            'taxonomies' => ['application_type'],
            'supports' => [
                'title',
                'editor',
                'custom-fields',
                'post-thumbnails',
                'post-formats'
            ]
        ];
        register_post_type('application', $args);
    }

    public static function instance() {
        return new self();
    }
}
?>