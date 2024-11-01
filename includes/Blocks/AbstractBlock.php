<?php
namespace JMS_THEMES\Blocks;

defined( 'ABSPATH' ) || exit;

abstract class AbstractBlock {

    protected $namespace = 'jmsthemes-blocks';

    protected $block_name = '';

    public function register_block_type() {
        register_block_type(
            $this->namespace . '/' . $this->block_name,
            array(
                'editor_script'   => 'jms-' . $this->block_name,
                'editor_style'    => 'jms-testimonialblock-editor',
                'style'           => 'jms-testimonialblock-style',
            )
        );
    }
}
