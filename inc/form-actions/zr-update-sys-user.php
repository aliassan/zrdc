<?php
add_action( 'zr_update_sys_user', 'zr_update_sys_user' );

function zr_update_sys_user($data) {

    //$userdata = [];

    wp_insert_user($data);
}
?>