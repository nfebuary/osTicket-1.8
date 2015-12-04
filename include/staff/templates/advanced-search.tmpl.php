<?php
$parent_id = $_REQUEST['parent_id'] ?: $search->parent_id;
if ($parent_id
    && (!($queue = CustomQueue::lookup($parent_id)))
) {
    $parent_id = null;
}
?>
<div id="advanced-search" class="advanced-search">
<h3 class="drag-handle"><?php echo __('Advanced Ticket Search');?></h3>
<a class="close" href=""><i class="icon-remove-circle"></i></a>
<hr/>
<form action="#tickets/search" method="post" name="search">
  <div class="flex row">
    <div class="span12">
      <input type="hidden" name="a" value="search">
      <?php include STAFFINC_DIR . 'templates/advanced-search-criteria.tmpl.php'; ?>
    </div>
  </div>
  <hr/>
  <div>
    <div class="buttons pull-left">
        <input type="button" value="<?php echo __('Cancel'); ?>" class="close">
    </div> 
    <div class="buttons pull-right">
      <button class="button" type="submit" name="submit" value="search"
        id="do_search"><i class="icon-search"></i>
        <?php echo __('Search'); ?>
        </button>
    </div>
  </div>
</form>
