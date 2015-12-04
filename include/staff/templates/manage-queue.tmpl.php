<?php
$parent_id = $_REQUEST['parent_id'] ?: $search->parent_id;
if ($parent_id
    && (!($queue = CustomQueue::lookup($parent_id)))
) {
    $parent_id = null;
}
?>
<div id="manage-personal-queue" class="manage-personal-queue">
    <form action="" method="post" name="addqueue">
        <h3 class="drag-handle"><?php echo __('Manage Queue');?> <small>— <span class="ltr">Queue Title goes here</span></small></h3>
        <a class="close" href=""><i class="icon-remove-circle"></i></a>
        <hr/>
        <ul class="tabs step">
            <li class="active"><a href="#criteria">
                <?php echo __('Criteria'); ?></a>
            </li>
            <li><a href="#information">
                <?php echo __('Information'); ?></a>
            </li>
            <li><a href="#columns">
                <?php echo __('Columns'); ?></a>
            </li>
        </ul>
        <!-- Criteria Step -->
        <div class="tab_content" id="criteria">
            <div class="tab-desc">
                <p><b>Manage the filter criteria</b><br>Add, and remove the filters in this queue using the options below.</p>
            </div>
            <div class="flex row">
                <div class="span12">
                  <input type="hidden" name="a" value="search">
                  <?php include STAFFINC_DIR . 'templates/advanced-search-criteria.tmpl.php'; ?>
                </div>
                <hr/>
                <div class="buttons pull-left">
                    <input type="button" value="<?php echo __('Cancel'); ?>" class="close">
                </div>   
                <div class="buttons pull-right">
                    <button class="button" type="submit" name="next">
                        <?php echo __('Next'); ?> <i class="icon-caret-right"></i>
                    </button> 
                </div>
            </div>
        </div>
        <!-- Information Step Title and Description -->
        <div class="hidden tab_content" id="information">
            <div class="tab-desc">
                <p><b>Manage basic information</b><br>Add a title description or change the destination queue.</p>
            </div>
            <div class="flex row">
                <div class="span12">
                  <input name="name" type="text" size="30" 
                    value="<?php echo Format::htmlchars($search->getName()); ?>"
                    placeholder="<?php
                     echo __('Enter a title for the search queue'); ?>"/>
                    <div class="error">
                        <?php echo Format::htmlchars($errors['name']); ?>
                    </div>
                </div>
                <hr/>
                <div class="span6">
                  <select name="parent_id">
                      <option value="0" <?php
                          if (!$parent_id) echo 'selected="selected"';
                          ?>><?php echo '—'.__("Change Parent Queue").'—'; ?></option>
                        <?php foreach (CustomQueue::queues()
                         ->filter(array('parent_id' => 0))
                         as $q) { ?>
                      <option value="<?php echo $q->id; ?>"
                          <?php if ($parent_id == $q->id) echo 'selected="selected"'; ?>
                          ><?php echo $q->getFullName(); ?></option>
                        <?php } ?>
                  </select>
                </div>
                <hr/>
                <div class="span12">
                    <textarea style="width:100%;" rows="5" name="description" placeholder="<?php echo __('Queue description:'); ?>"></textarea>
                </div>
                <hr/>
                <div class="buttons pull-left">
                    <input type="button" value="<?php echo __('Cancel'); ?>" class="close">
                </div> 
                <div class="buttons pull-right">
                    <button class="button" type="submit" name="submit" value="next">
                        <?php echo __('Next'); ?> <i class="icon-caret-right"></i>
                    </button>    
                </div>    
            </div>
        </div>
        <!-- Columns Step -->
        <div class="hidden tab_content" id="columns">
            <div class="tab-desc">
                <p><b>Manage columns in this queue</b><br>Add, and remove the columns in this queue using the options below.</p>
            </div>
            <div class="flex row">
                <table class="table two-column">
                    <tbody>
                        <tr class="header">
                            <td style="width:40%;"><small><b>Heading</b></small></td>
                            <td><small><b>Width</b></small></td>
                            <td><small><b>Column Details</b></small></td>
                            <td>&nbsp;</td>
                        </tr>
                    </tbody>
                    <tbody class="sortable-rows ui-sortable">
                        <tr class="" style="display: table-row;">
                            <td>
                                <i class="faded-more icon-sort"></i>
                                <span>Title of the column</span>
                            </td>
                            <td>
                                <input type="text" size="5" data-name="width" name="columns[1][width]">
                            </td>
                            <td>
                                <input type="hidden" data-name="queue_id" value="6" name="columns[1][queue_id]">
                                <input type="hidden" data-name="column_id" value="1" name="columns[1][column_id]">
                                <div>
                                    <span>Ticket #</span>
                                </div>
                            </td>
                            <td>
                                <a href="#" class="pull-right drop-column" title="Delete"><i class="icon-trash"></i></a>
                            </td>
                        </tr>
                    </tbody>
                    <tbody>
                        <tr class="header">
                            <td colspan="4"></td>
                        </tr>
                        <tr>
                            <td colspan="4" id="append-column">
                                <i class="icon-plus-sign"></i>
                                <select id="add-column" data-quick-add="queue-column">
                                    <option value="">— Add a column —</option>
                                    <option value="8">Assignee</option>
                                    <option value="7">Close Date</option>
                                    <option value="2">Date Created</option>
                                    <option value="11">Department</option>
                                    <option value="13">Last Response</option>
                                    <option value="10">Last Updated</option>
                                    <option value="6">Status Name</option>
                                    <option value="4">User Name</option>
                                </select>
                                <button type="button" class="green button">Add</button>
                            </td>
                        </tr>
                    </tbody>
                </table>
                <hr />
                <div class="buttons pull-left">
                    <input type="button" value="<?php echo __('Cancel'); ?>" class="close">
                </div> 
                <div class="buttons pull-right">
                    <button class="green button" type="submit" name="submit" value="save"
                        onclick="javascript:
                          var form = $(this).closest('form');
                          form.attr('action', form.attr('action') + '/' + <?php echo
                             $search->id ?: "'create'"; ?>);"
                        ><i class="icon-save"></i>
                        <?php  echo __('Save'); ?>
                    </button>
                </div> 
            </div>
        </div>
    </form>
</div>