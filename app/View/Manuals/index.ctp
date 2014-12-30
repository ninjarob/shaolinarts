<div class="manuals index">
    <h3 style="clear:none;margin-top:0px;">User Management</h3>
    <div style="float:right;">
        <?php echo $this->Html->link( "Back to Admin", array('controller'=>'admin_pages', 'action'=>'admin_home'),array('escape' => false) ); ?>
    </div>
    <?php echo $this->Html->link( "Add A New Manual", array('action'=>'add'),array('escape' => false) ); ?>

    <table cellpadding="0" cellspacing="0" id="pattern-style-b">
	<tr>
			<th><?php echo $this->Paginator->sort('name'); ?></th>
			<th><?php echo $this->Paginator->sort('description'); ?></th>
			<th><?php echo $this->Paginator->sort('role_type_id'); ?></th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($manuals as $manual): ?>
	<tr>
		<td><div style="width:180px"><?php echo h($manual['Manual']['name']); ?>&nbsp;</div></td>
		<td><div style="width:250px"><?php echo h($manual['Manual']['description']); ?>&nbsp;</div></td>
		<td>
            <div style="width:180px"><?php echo $manual['RoleType']['name'] ?></div>
		</td>
		<td class="actions" style="font-size:8px;">
            <div style="width:90px">
                <?php echo $this->Html->link(__('View'), array('action' => 'show', $manual['Manual']['id']), array('style'=>'font-size:8px;', 'target'=>'_blank')); ?>
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $manual['Manual']['id']), array('style'=>'font-size:8px;')); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $manual['Manual']['id']), array('style'=>'font-size:8px;'), __('Are you sure you want to delete # %s?', $manual['Manual']['id'])); ?>
            </div>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
	<p>
	<?php
	echo $this->Paginator->counter(array(
	'format' => __('Page {:page} of {:pages}, showing {:current} records out of {:count} total, starting on record {:start}, ending on {:end}')
	));
	?>	</p>
	<div class="paging">
	<?php
		echo $this->Paginator->prev('< ' . __('previous'), array(), null, array('class' => 'prev disabled'));
		echo $this->Paginator->numbers(array('separator' => ''));
		echo $this->Paginator->next(__('next') . ' >', array(), null, array('class' => 'next disabled'));
	?>
	</div>
</div>
<br>
<?php echo $this->Html->link( "Add A New Manual", array('action'=>'add'),array('escape' => false) ); ?>
