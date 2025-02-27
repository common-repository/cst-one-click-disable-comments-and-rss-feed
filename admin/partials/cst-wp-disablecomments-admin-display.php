<?php

/**
 * Provide a admin area view for the plugin
 *
 * This file is used to markup the admin-facing aspects of the plugin.
 *
 * @link       https://creativestorming.com/
 * @since      1.0.0
 *
 * @package    Cst_Wp_Disablecomments
 * @subpackage Cst_Wp_Disablecomments/admin/partials
 */

/**
 * Render the options page for plugin
 *
 * @since  1.0.0
 */

?>

<!-- This file should primarily consist of HTML with a little bit of PHP. -->
<div class="wrap">
    <h2><?php echo esc_html( get_admin_page_title() ); ?></h2>
    <form action="options.php" method="post">
        <?php
        settings_fields( $this->plugin_name );
        do_settings_sections( $this->plugin_name );
        submit_button();
        ?>
    </form>
</div>