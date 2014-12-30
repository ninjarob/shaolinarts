<div class="manuals form">
<?php echo $this->Form->create('Manual'); ?>
	<fieldset>
		<legend><?php echo __('Add Manual'); ?></legend>
	<?php
		echo $this->Form->input('name');
		echo $this->Form->input('description');
		echo $this->Form->input('data');
		echo $this->Form->input('type');
		echo $this->Form->input('role_type_id');
	?>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
<div class="actions">
	<h3><?php echo __('Actions'); ?></h3>
	<ul>

		<li><?php echo $this->Html->link(__('List Manuals'), array('action' => 'index')); ?></li>
		<li><?php echo $this->Html->link(__('List Role Types'), array('controller' => 'role_types', 'action' => 'index')); ?> </li>
		<li><?php echo $this->Html->link(__('New Role Type'), array('controller' => 'role_types', 'action' => 'add')); ?> </li>
	</ul>
</div>
