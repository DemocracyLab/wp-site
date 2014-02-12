<?php
/*
Plugin Name: Page Category
Plugin URI: 
Description: Adds category widget to page write in wp-admin 
Version: 0.1
Author: Claudiu Rogoveanu
Author 
*/

add_action('dbx_page_sidebar', 'addCategoryList');

function addCategoryList() {
   
?>
<fieldset id="categorydiv" class="dbx-box">
<h3 class="dbx-handle"><?php _e('Categories') ?></h3>
<div class="dbx-content">
<p id="jaxcat"></p>
<ul id="categorychecklist"><?php dropdown_categories(); ?></ul></div>
</fieldset>
<?    
}

?>