<div class="commonEmailMessages index">
    <h3 style="clear:none;margin-top:0px;"><?php echo __('Common Email Messages'); ?></h3>
    <div style="float:right;">
        <?php echo $this->Html->link("Back to Admin", array('controller'=>'admin_pages', 'action'=>'admin_home'),array('escape' => false) ); ?>
    </div>
    <?php echo $this->Html->link("Add A Common Email Message", array('action'=>'add'),array('escape' => false) ); ?>
	<table cellpadding="0" cellspacing="0" id="pattern-style-b">
	<tr>
        <th>Name</th>
        <th>Notes</th>
        <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($commonEmailMessages as $commonEmailMessage): ?>
	<tr>
		<td><?php echo h($commonEmailMessage['CommonEmailMessage']['name']); ?>&nbsp;</td>
        <td><div style="width:500px;"><?php echo h($commonEmailMessage['CommonEmailMessage']['notes']); ?>&nbsp;</div></td>
        <td class="actions" style="font-size:8px;">
            <div style="width:90px">
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $commonEmailMessage['CommonEmailMessage']['id'])); ?>
                <?php
                    if ($commonEmailMessage['CommonEmailMessage']['deletable']) {
                        echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $commonEmailMessage['CommonEmailMessage']['id']), null, __('Are you sure you want to delete # %s?', $commonEmailMessage['CommonEmailMessage']['id']));
                    }
                ?>
            </div>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>