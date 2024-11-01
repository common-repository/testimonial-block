<?php
/*
* Plugin Name: Testimonial Gutenberg Block
* Plugin URI: https://jmsthemes.com/product/testimonial-gutenberg-block/
* Description: JMS Testimonial Block for the Gutenberg editor.
* Version: 1.0.0
* Author: Jmsthemes
* Author URI: http://jmsthemes.com
* License:     GPL2
* License URI: https://www.gnu.org/licenses/gpl-2.0.html
* Text Domain: jms-testimonialblock
*/

if ( ! defined( 'ABSPATH' ) ) exit; // Exit if accessed directly
if ( version_compare( PHP_VERSION, '5.6.0', '<' ) ) {
    return;
}
require __DIR__ . '/vendor/autoload.php';

define('JMS_TESTIMONIALBLOCK_PLUGIN_PATH' , plugin_dir_path(__FILE__));
define('JMS_TESTIMONIALBLOCK_URL', plugin_dir_url(__FILE__));
define('JMS_TESTIMONIALBLOCK_CSS_URL', JMS_TESTIMONIALBLOCK_URL . 'assets/css/');
define('JMS_TESTIMONIALBLOCK_JS_URL', JMS_TESTIMONIALBLOCK_URL . 'assets/js/');
define('JMS_TESTIMONIALBLOCK_IMAGES_URL', JMS_TESTIMONIALBLOCK_URL . 'assets/images/');
define('JMS_TESTIMONIALBLOCK_ADMIN_PATH' , JMS_TESTIMONIALBLOCK_PLUGIN_PATH . 'admin/');
define('JMS_TESTIMONIALBLOCK_VERSION', '1.0.0' );


register_activation_hook( __FILE__, 'jms_testimonialblock_activate' );
function jms_testimonialblock_activate() {
    global $wp_version;
    if ( version_compare( $wp_version, "5.0", "<" ) ) {
        deactivate_plugins( basename( __FILE__ ) ); // Deactivate our plugin
        wp_die( "This plugin requires WordPress version 5.0 or higher." );
    }
}

register_deactivation_hook(__FILE__, 'jms_testimonialblock_deactivation');
function jms_testimonialblock_deactivation() {
    return true;
}

require_once 'includes/class-hook.php';
require_once 'includes/class-register-blocks.php';

add_action( 'plugins_loaded', function(){
    load_plugin_textdomain( 'jms-testimonialblock', false, plugin_dir_path( __DIR__ ) . '/languages' );
} );
