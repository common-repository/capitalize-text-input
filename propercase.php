<?php
/*
 * Plugin Name: Capitalize Text Input
 * Plugin URI: http://ldav.it/plugin/capitalize-text-input/
 * Description: Add a small button in admin form to convert post (or page) title in Proper case, when you edit post or page.
 * Version: 0.2
 * Author: laboratorio d'Avanguardia
 * Author URI: http://ldav.it/
 * License: GPLv2 or later
 * License URI: http://www.opensource.org/licenses/gpl-license.php
 * Text Domain: capitalize-text-input
 * Domain Path: /languages/
*/

function inputProperCase_custom_meta_box () {
?>
<div id="inputProperCaseDiv"><span class="pulsantino" title="<?php echo __('Change this content in Proper Case', 'inputProperCase') ?>">AaBb</span></div>
<script type="text/javascript">
function ldavToProperCase(s){
	return s.toLowerCase().replace(/^(.)|\.\s*(.)/g, function($1) { return $1.toUpperCase(); });
}
jQuery(document).ready(function($) {
	jQuery('#inputProperCaseDiv').insertBefore('#title');
	jQuery('#inputProperCaseDiv span.pulsantino').click(function() {
		c = jQuery(this).parent().next();
		c.val(ldavToProperCase(c.val()));
	});
	if(jQuery('#sottotitolo').length > 0){
		var c = jQuery('#inputProperCaseDiv').clone(true);
		c.insertBefore('#sottotitolo');
	}
});
</script>
<style>
#titlewrap span.pulsantino {display:block; position:absolute; right:0; margin:-1.4em 0 0; background:#666; color:#EEE; padding:0 4px; line-height:1.4em; cursor:pointer; border-radius:2px}
#titlewrap span.pulsantino:hover{color:#FFF; background-color:#000}
#inputProperCase{display:none}
</style>
<?php
}

function inputProperCase_add_box () {
  add_meta_box('inputProperCase', __('propercase', 'inputProperCase'), 'inputProperCase_custom_meta_box', 'post');
  add_meta_box('inputProperCase', __('propercase', 'inputProperCase'), 'inputProperCase_custom_meta_box', 'page');
}

add_action ('edit_form_advanced', 'inputProperCase_add_box');
add_action ('edit_page_form', 'inputProperCase_add_box');

?>