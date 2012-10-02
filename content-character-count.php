<?php
/**
 * @package Content character count live
 * @version 0.1
 */
/*
Plugin Name: Content character count
Plugin URI: http://wordpress.org/extend/
Description: Counts charaters live while you write your content. Works for any kind of "post type" out of the box.
Author: 2046
Version: 0.1
Author URI: http://2046.cz
*/

add_action( 'admin_print_footer_scripts', 'check_textarea_length' );

function check_textarea_length() {
	?>
	<script type="text/javascript">
		jQuery("#wp-word-count").after("<td><small>Characters num.: </small><input type=\"text\" value=\"0\" maxlength=\"3\" size=\"3\" id=\"ilc_excerpt_counter\" readonly=\"\"></td>");
		//~ var editor_char_limit = 50;

		// jQuery ready fires too early, use window.onload instead
		window.onload = function () {
			
			//~ jQuery('.mceStatusbar').append('<span class="word-count-message">Reduce word count!</span>');
			//~ count characters onload
			var ed = tinyMCE.activeEditor;
			editor_content = ed.getContent().replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/ig,''); 
			jQuery("#ilc_excerpt_counter").val(editor_content.length);

			tinyMCE.activeEditor.onKeyUp.add( function() {
				// Strip HTML tags, WordPress shortcodes and white space
				editor_content = this.getContent().replace(/(<[a-zA-Z\/][^<>]*>|\[([^\]]+)\])|(\s+)/ig,''); 

				/*if ( editor_content.length > editor_char_limit ) {
					jQuery('#content_tbl').addClass('toomanychars');
				} else {
					jQuery('#content_tbl').removeClass('toomanychars');
				}*/
				jQuery("#ilc_excerpt_counter").val(editor_content.length);
			});
		}
		
		
	</script>
<?php
	/*echo '<style type="text/css">
		.wp_themeSkin .word-count-message { font-size:1.1em; display:none; float:right; color:#fff; font-weight:bold; margin-top:2px; }
		.wp_themeSkin .toomanychars .mceStatusbar { background:red; }
		.wp_themeSkin .toomanychars .word-count-message { display:block; }
	</style>';
	*/
}

//~ the code is modified version of the code of people from links bellow plus some of mine inventions :) as well
//~ I'm keeping the original code commented here, so that otehr can you it if they want


//~ http://konstruktors.com/blog/wordpress/3685-limit-number-words-characters-in-wordpress-editor/
//~ credit http://www.ilovecolors.com.ar/character-counter-excerpt-wordpress/
