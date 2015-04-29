<?php
/**
 * @package Content character count live
 * @version 0.1.3
 */
/*
Plugin Name: Content character count
Plugin URI: http://wordpress.org/extend/
Description: Counts charaters live while you write your content. Works for any kind of "post type" out of the box.
Author: o----o
Version: 0.1.3
Author URI: http://2046.cz
*/

function CHAR_COUNT_INIT() {
  load_plugin_textdomain( 'CHAR_COUNT', false, dirname( plugin_basename( __FILE__ ) ) . '/languages/' ); 
}
add_action('plugins_loaded', 'CHAR_COUNT_INIT');

add_action( 'admin_print_footer_scripts', 'check_textarea_length' );

function check_textarea_length() {
	?>
	<script type="text/javascript">
		// inject the html
		jQuery("#wp-word-count").after("<td><small><?php _e ('Characters num.', 'CHAR_COUNT'); ?>: </small><input type=\"text\" value=\"0\" maxlength=\"3\" size=\"3\" id=\"ilc_excerpt_counter\" readonly=\"\"></td>");
		// count on load
		window.onload = function () {
			setTimeout(function() {
				cont = tinymce.get('content').getContent().replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/ig,'');
				jQuery("#ilc_excerpt_counter").val(cont.length);
			}, 300);
		}
	</script>
<?php 
}

// add function to the tinymce on init
add_filter( 'tiny_mce_before_init', 'my_tinymce_setup_function' );
  function my_tinymce_setup_function( $initArray ) {
    $initArray['setup'] = 'function(ed) {
    ed.on("keyup", function(e) {
        editor_content = ed.getContent().replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/ig,"");
        jQuery("#ilc_excerpt_counter").val(editor_content.length);
    });
}';
    return $initArray;
}
