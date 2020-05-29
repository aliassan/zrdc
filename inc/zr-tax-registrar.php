<?php
class ZR_Tax_Registrar extends ZR_Registrar
{
    private $terms = [  
        'hierarchical' => [ 
            'residential' => [
                'name' => 'Residential',
                'description' => 'Stands for residential purposes',
                'taxonomy' => 'stand_type',
                'children' => [
                    'high' => [
                        'name' => 'High Density',
                        'description' => 'High density residential areas'
                    ],
                    'medium' => [
                        'name' => 'Medium Density',
                        'description' => 'Medium density residential areas'
                    ],
                    'low' => [
                        'name' => 'Low Density',
                        'description' => 'Low density residential areas'
                    ]
                ]
            ],
            'non_residential' => [
                'name' => 'Non-Residential',
                'description' => 'Stands for non-residential purposes',
                'taxonomy' => 'stand_type',
                'children' => [
                    'commercial' => [
                        'name' => 'Commercial',
                        'description' => 'Stands for commercial purposes'
                    ],
                    'industrial' => [
                        'name' => 'Industrial',
                        'description' => 'Stands for industrial purposes'
                    ],
                    'institutional' => [
                        'name' => 'Institutional',
                        'description' => 'Stands for institutional purposes'
                    ]
                ]
            ]
         ],
         'non-hierarchical' => [
             'wl' => [
                'name' => 'Waiting List',
                'description' => 'Application to join waiting list',
                'taxonomy' => 'application_type'
             ],
             'ul' => [
                'name' => 'Urban Lease',
                'description' => 'Application for lease in urban areas',
                'taxonomy' => 'application_type'
             ],
             'cl' => [
                'name' => 'Communal Lease',
                'description' => 'Application to join communal lands',
                'taxonomy' => 'application_type'
             ]
         ]
    ];

    public function __construct() {
    }
    
    public function register() {
        /** 
         * Initialize the Stand Type Taxonomy
         */
        $this->register_stand_types();
        $this->register_application_types();
        $this->initialize_tax();
    }

    /** 
    * Register the Stand Type Taxonomy
    */
    private function register_stand_types() {
        $labels = [
            'name'              => _x('Stand Types', 'taxonomy general name'),
            'singular_name'     => _x('Stand Type', 'taxonomy singular name'),
            'search_items'      => __('Search Stand Types'),
            'all_items'         => __('All Stand Types'),
            'parent_item'       => __('Parent Stand Type'),
            'parent_item_colon' => __('Parent Stand Type:'),
            'edit_item'         => __('Edit Stand Type'),
            'update_item'       => __('Update Stand Type'),
            'add_new_item'      => __('Add New Stand Type'),
            'new_item_name'     => __('New Stand Type Name'),
            'menu_name'         => __('Stand Type'),
        ];
        
        $tax_args = [
            'hierarchical'      => true, // make it hierarchical (like categories)
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'stand-type'],
        ];

        $args = [ 'taxonomy' => 'stand_type', 'args' => $tax_args ];

        $this->register_tax( $args );

    }

    /** 
    * Register the Application Type Taxonomy
    */
    private function register_application_types() {
        $labels = [
            'name'              => _x('Application Types', 'taxonomy general name'),
            'singular_name'     => _x('Application Type', 'taxonomy singular name'),
            'search_items'      => __('Search Application Types'),
            'all_items'         => __('All Application Types'),
            'edit_item'         => __('Edit Application Type'),
            'update_item'       => __('Update Application Type'),
            'add_new_item'      => __('Add New Application Type'),
            'new_item_name'     => __('New Application Type Name'),
            'menu_name'         => __('Application Type'),
        ];
        
        $tax_args = [
            'hierarchical'      => false, // make it hierarchical (like categories)
            'labels'            => $labels,
            'show_ui'           => true,
            'show_admin_column' => true,
            'query_var'         => true,
            'rewrite'           => ['slug' => 'application-type'],
        ];

        $args = [ 'taxonomy' => 'application_type', 'args' => $tax_args ];

        $this->register_tax( $args );
    }

    /**
     * Initialize the Stand Type Taxonomy
     */
    private function initialize_tax() {
        $args = [];
        foreach( $this->terms as $key => $value ) {
            if( $key == 'hierarchical' ) {
                foreach( $value as $p_key => $p_value ) {
                    $args['slug'] = $p_key;
                    $args['term'] = $p_value['name'];
                    $args['description'] = $p_value['description'];
                    $args['taxonomy'] = $p_value['taxonomy'];
                    $args['child'] = false;
                    $this->insert_term($args);
                    foreach( $p_value['children'] as $c_key => $c_value) {
                    $args['slug'] = $c_key;
                    $args['term'] = $c_value['name'];
                    $args['description'] = $c_value['description'];
                    $args['child'] = true;
                    $args['parent'] = $p_key;
                    $this->insert_term($args);
                    } 
                } 
            } else {
                foreach( $value as $s_key => $s_value ) {
                    $args['slug'] = $s_key;
                    $args['term'] = $s_value['name'];
                    $args['description'] = $s_value['description'];
                    $args['taxonomy'] = $s_value['taxonomy'];
                    $args['child'] = false;
                    $this->insert_term($args);
                } 
            }
        }
    }

    private function register_tax( $args ) {
        register_taxonomy( $args['taxonomy'], null, $args['args'] );
    }

    private function insert_term( $args ) {
        $term = term_exists( $args['term'], $args['taxonomy'] );

        if( 0 !== $term || null !== $term ) {
            if( $args['child'] ) {
                $parent_term = term_exists( $args['parent'], $args['taxonomy'] ); // array is returned if taxonomy is given
    
                wp_insert_term(
                    $args['term'], // the term
                    $args['taxonomy'], // the taxonomy
                    array(
                        'description' => $args['description'],
                        'slug' => $args['slug'],
                        'parent' => $parent_term['term_id']
                    )
                );		
            } else {
                wp_insert_term(
                    $args['term'], // the term
                    $args['taxonomy'], // the taxonomy
                    array(
                        'description' => $args['description'],
                        'slug' => $args['slug'],
                    )
                );
            }
        }
    }

    public static function instance() {
        return new self();
    }
}
?>