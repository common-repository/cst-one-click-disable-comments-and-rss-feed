<?php

/**
 * The admin-specific functionality of the plugin.
 *
 * @link       https://creativestorming.com
 * @since      1.0.0
 *
 * @package    Cst_Wp_Disablecomments
 * @subpackage Cst_Wp_Disablecomments/admin
 */

/**
 * The admin-specific functionality of the plugin.
 *
 * Defines the plugin name, version, and two examples hooks for how to
 * enqueue the admin-specific stylesheet and JavaScript.
 *
 * @package    Cst_Wp_Disablecomments
 * @subpackage Cst_Wp_Disablecomments/admin
 * @author     Creative Storming <support@creativestorming.com>
 */
class Cst_Wp_Disablecomments_Admin {

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
	 * @param      string    $plugin_name       The name of this plugin.
	 * @param      string    $version    The version of this plugin.
	 */
	public function __construct( $plugin_name, $version ) {

		$this->plugin_name = $plugin_name;
		$this->version = $version;

	}

	/**
	 * Register the stylesheets for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_styles() {
		/*wp_enqueue_style( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'css/cst-wp-disablecomments-admin.css', array(), $this->version, 'all' );*/

	}

	/**
	 * Register the JavaScript for the admin area.
	 *
	 * @since    1.0.0
	 */
	public function enqueue_scripts() {
		/*wp_enqueue_script( $this->plugin_name, plugin_dir_url( __FILE__ ) . 'js/cst-wp-disablecomments-admin.js', array( 'jquery' ), $this->version, false );*/

	}

    /**
     * Add an options page under the Settings submenu
     *
     * @since  1.0.0
     */
    public function add_options_page() {

        $this->plugin_screen_hook_suffix = add_options_page(
            __( 'Disable Comment & RSS Settings | Creative Storming', 'cst-wp-disablecomments' ),
            __( 'Disable Comment & RSS | CreativeStorming', 'cst-wp-disablecomments' ),
            'manage_options',
            $this->plugin_name,
            array( $this, 'display_options_page' )
        );

    }

    public function display_options_page() {
        include_once 'partials/cst-wp-disablecomments-admin-display.php';
    }

    /**
     * Register all related settings of this plugin
     *
     * @since  1.0.0
     */
    public function register_setting() {

        // Add a General section
        add_settings_section(
            $this->option_name . '_general',
            __( 'General Settings', 'cst-wp-disablecomments' ),
            array( $this, $this->option_name . '_general_cb' ),
            $this->plugin_name
        );

        add_settings_field(
            $this->option_name . '_disableall',
            __( 'Disable all comments', 'cst-wp-disablecomments' ),
            array( $this, $this->option_name . '_disableall_cb' ),
            $this->plugin_name,
            $this->option_name . '_general',
            array( 'label_for' => $this->option_name . '_disableall' )
        );

        add_settings_field(
            $this->option_name . '_comment_frontend',
            __( 'Hide all comments parts?', 'cst-wp-disablecomments' ),
            array( $this, $this->option_name . '_comment_frontend_cb' ),
            $this->plugin_name,
            $this->option_name . '_general',
            array( 'label_for' => $this->option_name . '_comment_frontend' )
        );




        add_settings_field(
            $this->option_name . '_disable_rss',
            __( 'Disable RSS feed?', 'cst-wp-disablecomments' ),
            array( $this, $this->option_name . '_disable_rss_cb' ),
            $this->plugin_name,
            $this->option_name . '_general',
            array( 'label_for' => $this->option_name . '_disable_rss' )
        );
        register_setting( $this->plugin_name, $this->option_name . '_disableall', array( $this, $this->option_name . '_sanitize_disableall' ) );
        register_setting( $this->plugin_name, $this->option_name . '_comment_frontend', array( $this, $this->option_name . '_sanitize_comment_frontend' ) );
        register_setting( $this->plugin_name, $this->option_name . '_disable_rss', array( $this, $this->option_name . '_sanitize_disable_rss' ) );



    }


    /**
     * Render the text for the general section
     *
     * @since  1.0.0
     */
    public function cst_wp_disablecomments_general_cb() {
        echo '<div style="float: left">';
        echo '<img src="https://creativestorming.com/img/brand/Logo-CreativeStorming.png" width="115" height="115">';
        echo '</div>';
        echo '<div style="float: left">';
        echo '<p>' . __( 'Please change the settings accordingly.', 'cst-wp-disablecomments' ) . '</p>';
		echo '<p>' . __( 'If you have any question or if you want to suggest new features for the upcoming versions, you can contact our Support Center at ', 'cst-wp-disablecomments' ) . '<a href="mailto:support@creativestorming.com">support@creativestorming.com</a></p>';
		echo '<p>' . __( 'if you want to report errors, incompatibilities or problems of this plugin, please open a support request at our ', 'cst-wp-disablecomments' ) . '<a href="https://creativestorming.com/support">Support Center</a></p>';
        echo '</div>';


    }

    /**
     * Render the radio input field for comment_frontend option
     *
     * @since  1.0.0
     */
    public function cst_wp_disablecomments_comment_frontend_cb() {
		$comment_frontend = get_option( $this->option_name . '_comment_frontend' );
        ?>
        <fieldset>
            <label>
                <input type="radio" name="<?php echo $this->option_name . '_comment_frontend' ?>" id="<?php echo $this->option_name . '_comment_frontend' ?>" value="yes" <?php checked( $comment_frontend, 'yes' ); ?>>
                <?php _e( 'Yes', 'cst-wp-disablecomments' ); ?>
            </label>
            <br>
            <label>
                <input type="radio" name="<?php echo $this->option_name . '_comment_frontend' ?>" value="no" <?php checked( $comment_frontend, 'no' ); ?>>
                <?php _e( 'No', 'cst-wp-disablecomments' ); ?>
            </label>
        </fieldset>

        <?php
        echo '<p>' . __( 'If you select "yes", all sections concerning the comments, such as "Comments are closed" in frontend, the comments page in menu etc. will be hidden', 'cst-wp-disablecomments' ) . '</p>';
    }

    /**
     * Render the radio input field for disableall option
     *
     * @since  1.0.0
     */
    public function cst_wp_disablecomments_disableall_cb() {

        $disableall = get_option( $this->option_name . '_disableall' );

        ?>
        <fieldset>
            <label>
                <input type="radio" name="<?php echo $this->option_name . '_disableall' ?>" id="<?php echo $this->option_name . '_disableall' ?>" value="enable" <?php checked( $disableall, 'enable' ); ?>>
                <?php _e( 'Yes', 'cst-wp-disablecomments' ); ?>
            </label>
            <br>
            <label>
                <input type="radio" name="<?php echo $this->option_name . '_disableall' ?>" value="disable" <?php checked( $disableall, 'disable' ); ?>>
                <?php _e( 'No', 'cst-wp-disablecomments' ); ?>
            </label>
        </fieldset>
        <?php
        echo '<p>' . __( 'If you select "yes", the comment system will be disabled', 'cst-wp-disablecomments' ) . '</p>';

    }

    /**
     * Render the radio input field for disable_rss option
     *
     * @since  1.0.0
     */
    public function cst_wp_disablecomments_disable_rss_cb() {
        $disable_rss = get_option( $this->option_name . '_disable_rss' );
		?>
		<fieldset>
			<label>
				<input type="radio" name="<?php echo $this->option_name . '_disable_rss' ?>" id="<?php echo $this->option_name . '_disable_rss' ?>" value="enable" <?php checked( $disable_rss, 'enable' ); ?>>
				<?php _e( 'Yes', 'cst-wp-disablecomments' ); ?>
			</label>
			<br>
			<label>
				<input type="radio" name="<?php echo $this->option_name . '_disable_rss' ?>" value="disable" <?php checked( $disable_rss, 'disable' ); ?>>
				<?php _e( 'No', 'cst-wp-disablecomments' ); ?>
			</label>
		</fieldset>
		<?php
        echo '<p>' . __( 'If you select "yes", the RSS feed and the relative meta tags will be disabled', 'cst-wp-disablecomments' ) . '</p>';

    }

    /**
     * Sanitize the $comment_frontend value before being saved to database
     *
     * @param  string $comment_frontend $_POST value
     * @since  1.0.0
     * @return string           Sanitized value
     */
    public function cst_wp_disablecomments_sanitize_comment_frontend( $comment_frontend ) {
        if ( in_array( $comment_frontend, array( 'yes', 'no' ), true ) ) {
            return $comment_frontend;
        }
    }

    /**
     * Sanitize the $disableall value before being saved to database
     *
     * @param  string $disableall $_POST value
     * @since  1.0.0
     * @return string           Sanitized value
     */
    public function cst_wp_disablecomments_sanitize_disableall( $disableall ) {
        if ( in_array( $disableall, array( 'enable', 'disable' ), true ) ) {
            return $disableall;
        }
    }

    /**
     * Disable support for comments and trackbacks in post types
     *
     *@since  1.0.0
     */

    function cst_wp_disablecomments_post_types_support() {
        $disableall = get_option( $this->option_name . '_disableall' );

        if($disableall == 'enable'){
            $post_types = get_post_types();
            foreach ($post_types as $post_type) {
                if(post_type_supports($post_type, 'comments')) {
                    remove_post_type_support($post_type, 'comments');
                    remove_post_type_support($post_type, 'trackbacks');
                }
            }
        }

    }


    /**
     * Remove comments page in menu
     *
     * @since  1.0.0
     */

    function cst_wp_disablecomments_admin_menu() {
        $disableall = get_option( $this->option_name . '_disableall' );

        if($disableall == 'enable'){
            remove_menu_page('edit-comments.php');
        }

    }

    /**
     * Redirect any user trying to access comments page
     *
     * @since  1.0.0
     */
    function cst_wp_disablecomments_admin_menu_redirect() {
        $disableall = get_option( $this->option_name . '_disableall' );

        if($disableall == 'enable'){
            global $pagenow;
            if ($pagenow === 'edit-comments.php') {
                wp_redirect(admin_url()); exit;
            }
        }

    }

    /**
     * Remove comments metabox
     *
     * @since  1.0.0
     */
    function cst_wp_disablecomments_dashboard() {
        $disableall = get_option( $this->option_name . '_disableall' );

        if($disableall == 'enable'){
            remove_meta_box('dashboard_recent_comments', 'dashboard', 'normal');
            remove_meta_box( 'commentstatusdiv' , 'page' , 'normal' ); //removes comments status
            remove_meta_box( 'commentsdiv' , 'page' , 'normal' ); //removes comments
            remove_meta_box( 'authordiv' , 'page' , 'normal' ); //removes author
        }

    }


	/**
	 * Remove comments icon from admin bar
	 *
	 *@since  1.0.0
	 */
	function cst_wp_disablecomments_admin_bar() {
		global $wp_admin_bar;
		$disableall = get_option( $this->option_name . '_disableall' );

		if($disableall == 'enable'){
				$wp_admin_bar->remove_node('comments');
		}
	}





}
