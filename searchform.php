<?php
/**
 * @description: A template for search forms
 * @name       : searchform.php
 * @package    : waht
 * @author     : Amélie Husson (http://ameliehusson.com)
 * @uri        : https://github.com/Othella/waht
 */
?>
<form id="searchform" class="form-search" method="get" role="search" action="<?php echo home_url('/'); ?>">
    <label for="s" class="hide-text"><?php _e('Search for:', 'waht'); ?></label>
    <input type="text" value="" name="s" id="s" class="search-query" placeholder="<?php _e('Type what you\'re looking for here...', 'waht'); ?>">
    <input type="submit" class="btn" value="<?php _e('Search' ,'waht'); ?>">
</form>