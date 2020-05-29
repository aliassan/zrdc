<?php
add_action( 'zr_update_user', 'zr_update_user' );

function zr_update_user($data) {

    $user_id = get_current_user_id();

    foreach ($data as $key => $value) {
            update_user_meta( $user_id, $key, $value );
    }
}
?>


