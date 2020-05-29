<?php
class ZR_User_Manager {
    public function __construct( $args ) {
        if ( $args['option'] === 'create' ) {
            $this->create_user( [
                    'user_name' => $args['user_name'], 
                    'user_email' => $args['user_email'],
                    'user_role' => $args['user_role'],
                    'default_role' => $args['default_role']
                ]
            );  
        }
    }

    private function create_user( $args ) {

        $user_id = username_exists( $args['user_name'] );

        if (!$user_id && email_exists( $args['user_email'] ) === false) {   
            $user_id = wp_create_user(
                $args['user_name'],
                $args['user_name'],
                $args['user_email']
            );
        }

        $this->set_role( $args['user_name'], $args['user_role'], $args['default_role'] );
    }

    private function set_role( $user_name, $user_role, $default_user_role ) {
        $user = null;
        $user_id = username_exists( $user_name );
        $user = new WP_User( $user_id );

        if ( $user !== null ) {
            $user_roles = $user->roles;

            if ( in_array( $default_user_role, $user_roles, true ) ) {
                $user->remove_role( $default_user_role );
                $user->add_role( $user_role );
            } else {
                $user->add_role( $user_role );
            }
        }
    }
}
?>