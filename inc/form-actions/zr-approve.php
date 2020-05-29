<?php 
//add_filter('wp_mail_content_type', 'set_content_type');

function set_content_type( $content_type ) {
	return 'text/html';
}

add_action('admin_post_approve', 'approve_application');

function approve_application() {
    update_post_meta($_GET['post_id'], 'application_status', 'approved');

    $user_info = get_userdata( $_GET['author_id'] );
    $email = $user_info->user_email;

    $subject = 'Your application ' . $_GET['application_no'] . ' has been approved';

    $message = 'Hie There,';
    $message .= "\n";
    $message .= "\n";
    $message .= 'Your application has been approved. Your application details are as follows:';
    $message .= "\n";
    $message .= "\n";
    $message .= 'Application No.: ' . "\t" . $_GET['application_no'] . "\r";
	$message .= 'Land Use: ' . "\t\t" . $_GET['land_use'] . "\r";
    $message .= 'Stand Type: ' . "\t\t" . $_GET['stand_type'] . "\r";
    $message .= 'Center: ' . "\t\t" . $_GET['pref_center'] . "\r";
	$message .= "\r";
    $message .= "\r";
    $message .= 'You can login to the application ' . home_url() . ' here' . "\r";
    $message .= "\r";

    wp_mail($email, $subject, $message);
}
?>