<div class="userLinks index">
    <h3 style="clear:none;margin-top:0px;"><?php echo __('Userlinks'); ?></h3>
    <div style="float:right;">
        <?php echo $this->Html->link("Back to Admin", array('controller'=>'admin_pages', 'action'=>'admin_home'),array('escape' => false) ); ?>
    </div>
    <?php echo $this->Html->link("Add A New User LInk", array('action'=>'add'),array('escape' => false) ); ?>

	<table cellpadding="0" cellspacing="0" id="pattern-style-b">
	<tr>
        <th>Name</th>
        <th>Link</th>
        <th>Icon</th>
        <th>Order</th>
        <th>Role Type</th>
        <th class="actions"><?php echo __('Actions'); ?></th>
	</tr>
	<?php foreach ($userLinks as $userLink): ?>
	<tr>
		<td><div style="width:180px"><?php echo h($userLink['UserLink']['name']); ?></div></td>
		<td><?php echo h($userLink['UserLink']['link']); ?></td>
        <td><?php echo h($userLink['UserLink']['icon']); ?></td>
        <td><?php echo h($userLink['UserLink']['order']); ?></td>
        <td><div style="width:180px"><?php echo $userLink['RoleType']['name'] ?></div></td>
        <td class="actions" style="font-size:8px;">
            <div style="width:90px">
                <?php echo $this->Html->link(__('Edit'), array('action' => 'edit', $userLink['UserLink']['id'])); ?>
                <?php echo $this->Form->postLink(__('Delete'), array('action' => '$userLink', $userLink['UserLink']['id']), null, __('Are you sure you want to delete # %s?', $userLink['UserLink']['id'])); ?>
            </div>
		</td>
	</tr>
<?php endforeach; ?>
	</table>
</div>
