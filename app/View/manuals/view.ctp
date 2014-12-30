<div class="manuals view">
<h2><?php echo __('Manual'); ?></h2>
	<dl>
		<dt><?php echo __('Id'); ?></dt>
		<dd>
			<?php echo h($manual['Manual']['id']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Name'); ?></dt>
		<dd>
			<?php echo h($manual['Manual']['name']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Description'); ?></dt>
		<dd>
			<?php echo h($manual['Manual']['description']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Data'); ?></dt>
		<dd>
			<?php echo h($manual['Manual']['data']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Type'); ?></dt>
		<dd>
			<?php echo h($manual['Manual']['type']); ?>
			&nbsp;
		</dd>
		<dt><?php echo __('Role Type'); ?></dt>
		<dd>
			<?php echo $this->Html->link($manual['RoleType']['name'], array('controller' => 'role_types', 'action' => 'view', $manual['RoleType']['id'])); ?>
			&nbsp;
		</dd>
	</dl>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>
		<li><?php echo $this->Html->link(__('Edit Manual'), array('action' => 'edit', $manual['Manual']['id'])); ?> </li>
		<li><?php echo $this->Form->postLink(__('Delete Manual'), array('action' => 'delete', $manual['Manual']['id']), null, __('Are you sure you want to delete # %s?', $manual['Manual']['id'])); ?> </li>
		<li><?php echo $this->Html->link(__('List Manuals'), array('action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Manual'), array('action' => 'add')); ?> </li>
		<li><?php echo $this->Html->link(__('List Role Types'), array('controller' => 'role_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role Type'), array('controller' => 'role_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
