<?php

/**
 * @link              http://cademi.com.br
 * @since             1.0
 * @package           CademiRedirect
 *
 * @wordpress-plugin
 * Plugin Name:       Cademí - Redirect
 * Plugin URI:        https://cademi.com.br
 * Description:       Garanta que determinadas páginas sejam exibidas apenas dentro da sua plataforma Cademí
 * Version:           1.0.0
 * Author:            Cademí
 * Author URI:        https://cademi.com.br
 * Text Domain:       cademi-redirect
 * Domain Path:       /languages
 */

// If this file is called directly, abort.
if ( ! defined( 'WPINC' ) ) {
	die;
}

// activator
register_activation_hook( __FILE__, 'activate_cademi_redirect' );
function activate_cademi_redirect() 
{
	require_once plugin_dir_path( __FILE__ ) . 'includes/class-cademi-redirect-activator.php';
	CademiRedirectActivator::activate();
}

// run
require plugin_dir_path( __FILE__ ) . 'includes/class-cademi-redirect.php';
function run_cademi_redirect() 
{
	$plugin = new CademiRedirect();
	$plugin->run();
}

run_cademi_redirect();