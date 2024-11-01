<?php
namespace JMS_THEMES;

defined( 'ABSPATH' ) || exit;

if (!class_exists('JmsThemesBlocksRegisterBlocks')) {
    class JmsThemesBlocksRegisterBlocks
    {

        public static function init()
        {
            add_action('init', array(__CLASS__, 'register_blocks'));
        }

        public static function register_blocks()
        {
            $blocks = [
                'Testimonial',
            ];
            foreach ($blocks as $class) {
                $class = __NAMESPACE__ . '\\Blocks\\' . $class;
                $instance = new $class();
                $instance->register_block_type();
            }
        }
    }
    JmsThemesBlocksRegisterBlocks::init();
}