<?php
abstract class ZR_Registrar
{
	abstract public function register();

	public function init() { 
		add_action( 'init', array( $this, 'register' ) );
	} 
}
?>
