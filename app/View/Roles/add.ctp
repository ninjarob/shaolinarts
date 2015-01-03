<div class="roles form">
<div style="float:right;">
    <?php echo $this->Html->link( "Back to Roles", array('controller'=>'roles', 'action'=>'index'),array('escape' => false) ); ?>
</div>
<h3 style="clear:none;margin-top:0px;"><?php echo __('Add Role'); ?></h3>
<?php echo $this->Form->create('Role'); ?>
	<fieldset>
        <ul class="list-group">
            <li class="input-group list-group-item">
                <label style="display: block; float: left; width: 140px;">Name:</label>
                <?php echo $this->Form->input('name', array('label'=>'', 'style'=>'width:300px')); ?>
            </li>
            <li class="input-group list-group-item">
                <label style="display: block; float: left; width: 140px;">Access Role Type:</label>
                <?php echo $this->Form->input('role_type_id', array('label'=>'')); ?>
            </li>
        </ul>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
