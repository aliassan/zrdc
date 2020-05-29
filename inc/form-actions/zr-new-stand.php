<?php
add_action( 'zr_new_stand', 'zr_new_stand' );

function zr_new_stand($data) {

    $postarr = [
        'post_status' => 'draft',
        'post_type' => 'stand'
    ];

    $post_id = wp_insert_post( $postarr );

    $post_title = 'ST-' . $post_id ;

    wp_insert_post( [ 
        'ID' => $post_id,
        'post_title' => $post_title,
        'post_status' => 'publish',
        'post_type' => 'stand'
    ] );

    //zr_set_taxonomy( $post_id );
    zr_insert_meta( $data, $post_id );

    echo 'post saved';
}

/*function zr_set_taxonomy($post_id) {
    wp_set_object_terms( $post_id, ['wl'], 'application_type' );
}*/

/*function zr_insert_st_meta($data, $post_id) {
    
        foreach ($data as $key => $value) {
            if(isset($data[$key]) && null !== $data[$key]) {
                update_post_meta( $post_id, $key, $value );
            }
        }
}*/
?>