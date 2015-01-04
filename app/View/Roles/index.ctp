<div class="roles index">
    <h3 style="clear:none;margin-top:0px;"><?php echo __('Roles'); ?></h3>
    <div style="float:right;">
        <?php echo $this->Html->link("Back to Admin", array('controller'=>'admin_pages', 'action'=>'admin_home'),array('escape' => false) ); ?>
    </div>
    <?php echo $this->Html->link("Add A New Role", array('action'=>'add'),array('escape' => false) ); ?>

	<table cellpadding="0" cellspacing="0" id="pattern-style-b">
	<tr>
			<th>Name</th>
			<th>Role Type</th>
			<th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($roles as $role): ?>
	<tr>
		<td><?php echo h($role['Role']['name']); ?>&nbsp;</td>
		<td><?php echo h($role['RoleType']['name']); ?>&nbsp;</td>
        <td class="actions" style="font-size:8px;">
            <div style="width:90px">
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $role['Role']['id'])); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('action' => 'delete', $role['Role']['id']), null, __('Are you sure you want to delete # %s?', $role['Role']['id'])); ?>
            </div>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
