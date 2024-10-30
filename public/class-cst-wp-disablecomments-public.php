<?php

/**
 * The public-facing functionality of the plugin.
 *
 * @link       https://creativestorming.com
 * @since      1.0.0
 *
 * @package    Cst_Wp_Disablecomments
 * @subpackage Cst_Wp_Disablecomments/public
 */

/**
 * The public-facing functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cst_Wp_Disablecomments
 * @subpackage Cst_Wp_Disablecomments/public
 * @author     Creative Storming <support@creativestorming.com>
 */
class Cst_Wp_Disablecomments_Public {
    /**
     * The options name to be used in this plugin
     *
     * @since  	1.0.0
     * @access 	private
     * @var  	string 		$option_name 	Option name of this plugin
     */
    private $option_name = 'cst_wp_disablecomments';

	/**
	 * The ID of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $plugin_name    The ID of this plugin.
	 */
	private $plugin_name;

	/**
	 * The version of this plugin.
	 *
	 * @since    1.0.0
	 * @access   private
	 * @var      string    $version    The current version of this plugin.
	 */
	private $version;

	/**
	 * Initialize the class and set its properties.
	 *
	 * @since    1.0.0
	 * @param      string    $plugin_name       The name of the plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {

		/*wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cst-wp-disablecomments-public.css', array(), $this->version, 'all' );*/

	}

	/**
	 * Register the JavaScript for the public-facing side of the site.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {

		/*wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cst-wp-disablecomments-public.js', array( 'jquery' ), $this->version, false );*/

	}

    /**
     * Close comments on frontend
     *
     * @since    1.0.0
     */
    public function cst_wp_disablecomments_status() {
        $disableall = get_option( $this->option_name . '_disableall' );
        $comment_frontend = get_option( $this->option_name . '_comment_frontend' );

        if($disableall == 'enable'){
            if($comment_frontend == 'yes'){
                echo '<style>div#comments{display:none !important;}div.nocomments{display:none !important;}div.comments{display:none !important;}</style>';
            }

            return false;
        }else{
            return true;
        }
    }

    /**
     * Hide existing comments
     *
     * @since    1.0.0
     */

    function cst_wp_disablecomments_hide_existing_comments($comments) {

        $disableall = get_option( $this->option_name . '_disableall' );
        if($disableall == 'enable'){
            $comments = array();
            return $comments;
        }else{
            return '';
        }


    }

    /**
     * Hide default widget comments
     *
     * @since    1.0.0
     */

    function cst_wp_disablecomments_hide_default_widget_comments() {

        $disableall = get_option( $this->option_name . '_disableall' );
        if($disableall == 'enable'){
            unregister_widget('WP_Widget_Recent_Comments');
        }else{
            return '';
        }


    }

    /**
     * Hide default rss comments
     *
     * @since    1.0.0
     */

    function cst_wp_disablecomments_hide_default_rss_comments() {

        $disablerss = get_option( $this->option_name . '_disable_rss' );
        if($disablerss == 'enable'){
            wp_die( __( 'No feed available, please visit the <a href="'. esc_url( home_url( '/' ) ) .'">homepage</a>!' ) );
        }else{
            return '';
        }

    }

    /**
     * Hide default rss links
     *
     * @since    1.0.0
     */

    function cst_wp_disablecomments_hide_default_rss_links_comments() {
        $disablerss = get_option( $this->option_name . '_disable_rss' );
        if($disablerss == 'enable'){
            remove_action( 'wp_head', 'feed_links', 2 ); // Display the links to the general feeds: Post and Comment Feed
            remove_action( 'wp_head', 'feed_links_extra', 3 ); // Display the links to the extra feeds such as category feeds
        }else{
            return '';
        }
    }




}
