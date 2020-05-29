<?php
function zr_get_user_role() {
    $user = null;
    $user = wp_get_current_user();
    if ( $user !== null ) {
        $user_roles = (array)$user->roles;
        return $user_roles[0];
    } else {
        return '';
    }
}

function zr_is_details_entered() {
    $user_meta = '';
    $user_meta = get_user_meta(get_current_user_id(), 'id_number', true);
    if ( !empty($user_meta) ) {
        return true;
    } else {
        return false;
    }
}
?>