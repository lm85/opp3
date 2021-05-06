<?php
namespace OperaPlus;

class CPT {
    function initialize() {
        add_action( 'init', array($this,'register_post_type_op_rating'));
    }

    /**
     * Register post type Rating
     */
    function register_post_type_op_rating() {
        $args = array(
            'public' => true,
            'label'  => 'Hodnocení'
        );
        register_post_type( 'op-rating', $args );
    }


}

$cpt = new CPT();
$cpt->initialize();

