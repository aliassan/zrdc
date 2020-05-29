<?php

defined( 'ABSPATH' ) or die( 'Illegal Access!' );

class ZR_Login 
{
    public function __construct() {
    }

	public function init() {
        add_action( 'wp', array( $this, 'check_login') );
        add_action( 'init', array($this, 'restrict_access') );
        add_action( 'phpmailer_init', array($this, 'setupMailer') );
	}

	public function check_login() {
		if( !is_user_logged_in() ) {
			auth_redirect();
		}
    }

    public function restrict_access() {
        if(is_admin() && !current_user_can( 'administrator' ))
            wp_redirect( home_url() );
    }
        
    public function setupMailer($phpmailer) {
            $phpmailer->isSMTP();
            $phpmailer->Host = SMTP_HOST;
            $phpmailer->SMTPAuth = SMTP_AUTH;
            $phpmailer->Port = SMTP_PORT;
            $phpmailer->Username = SMTP_USER;
            $phpmailer->Password = SMTP_PASS;
            $phpmailer->From = SMTP_FROM;
            $phpmailer->FromName = SMTP_NAME;
            $phpmailer->SMTPSecure = SMTP_SECURE;
    }

    public static function instance() {
        return new self();
    }
}