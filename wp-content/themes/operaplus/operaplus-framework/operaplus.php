<?php
namespace OperaPlus;
DEFINE('OPERAPLUS_URL',get_stylesheet_directory_uri().'/operaplus-framework');

final class Init
{
    /**
     * Call this method to get singleton
     *
     * @return Init
     */
    public static function Instance()
    {
        static $inst = null;
        if ($inst === null) {
            $inst = new Init();
        }
        return $inst;
    }

    /**
     * Private ctor so nobody else can instance it
     *
     */
    private function __construct()
    {
        $this->require_classes();
        $this->add_actions();
    }

    /**
     * Require classes
     */
    function require_classes() {
        require_once('includes/class.frontend.php');
        require_once('includes/class.cpt.php');
        require_once('includes/class.admin.php');
        require_once('includes/class.list_competition.php');

    }

    /**
     * Add actions
     */
    function add_actions() {
        add_action( 'wp_enqueue_scripts', array($this,'enqueue_frontend_scripts'));
        //add_action('',array($this,'some_function');
    }

    /**
     * Enqueue frontend scripts
     */
    function enqueue_frontend_scripts() {
        //wp_enqueue_script( 'script-name', AE_PLUGIN_URL . '/js/example.js', array(), '1.0.0', true );

    }
}

Init::Instance();