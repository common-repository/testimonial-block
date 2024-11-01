<?php
namespace JMS_THEMES;

defined( 'ABSPATH' ) || exit;

if (!class_exists('JmsThemesBlocks')) {
    class JmsThemesBlocks{
        public function __construct()
        {
            //Site Init
            add_action('init', array($this, 'init_func'));
            add_action( 'enqueue_block_assets', array( $this,'jms_frontend_scripts') );

            /*Filter hook*/
            add_filter( 'block_categories', array( $this,'gutenberg_jms_themes_blocks_category'), 10, 2);
        }

        /**
         * -------------------------------------------------------------------------------------------------------------
         * Public function
         * -----------------------------------------------------------------------  --------------------------------------
         */

        //Site init
        public function init_func()
        {
            $this->register_style( 'jms-testimonialblock-editor', JMS_TESTIMONIALBLOCK_CSS_URL.'editor.css', array( 'wp-edit-blocks' ) );
            $this->register_style( 'jms-testimonialblock-style', JMS_TESTIMONIALBLOCK_CSS_URL.'style.css', array() );

            // Shared libraries and components across all blocks.
            $this->register_script( 'jms-testimonialblock-vendors', JMS_TESTIMONIALBLOCK_JS_URL.'vendors.js', array(), false );

            // Individual blocks.
            $this->register_script( 'jms-testimonial', JMS_TESTIMONIALBLOCK_JS_URL.'main.js', array( 'jms-testimonialblock-vendors') );

            $this->register_script('jms-testimonial-frontend', JMS_TESTIMONIALBLOCK_JS_URL.'frontend.js');
        }


        public function gutenberg_jms_themes_blocks_category( $categories, $post ) {
            $check =  array_search('jmsthemes-blocks', array_column($categories, 'slug'));
            if(!$check){
                return array_merge(
                    $categories,
                    array(
                        array(
                            'slug' => 'jmsthemes-blocks',
                            'title' => __( 'Jmsthemes Blocks', 'jms-testimonialblock' ),
                        ),
                    )
                );
            }
            return $categories;
        }

        public function jms_frontend_scripts(){
            if ( has_block( 'jmsthemes-blocks/testimonial' ) ) {
                wp_enqueue_script('jms-testimonial-frontend');
            }
        }

        /**
         * -------------------------------------------------------------------------------------------------------------
         * Protected function
         * -------------------------------------------------------------------------------------------------------------
         */
        protected function register_script( $handle, $src, $deps = array(), $has_i18n = true ) {
            $filename     = str_replace( plugins_url( '/', __DIR__ ), '', $src );
            $deps_path  = dirname( __DIR__ ) . '/' . str_replace( '.js', '.deps.json', $filename );
            $dependencies = file_exists( $deps_path ) ? json_decode( file_get_contents( $deps_path ) ) : array();
            $dependencies = array_merge( $dependencies, $deps );

            wp_register_script( $handle, $src, $dependencies, JMS_TESTIMONIALBLOCK_VERSION, true );
            if ( $has_i18n && function_exists( 'wp_set_script_translations' ) ) {
                wp_set_script_translations( $handle, 'jms-wooblocks', dirname( __DIR__ ) . '/languages' );
            }
        }
        protected function register_style( $handle, $src, $deps = array(), $media = 'all' ) {
            wp_register_style( $handle, $src, $deps, JMS_TESTIMONIALBLOCK_VERSION, $media );
        }

        /**
         * -------------------------------------------------------------------------------------------------------------
         * Private function
         * -------------------------------------------------------------------------------------------------------------
        */


    }
    $run = new JmsThemesBlocks();
}