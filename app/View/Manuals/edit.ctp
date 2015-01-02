<div class="manuals form">
<div style="float:right;">
    <?php echo $this->Html->link( "Back to Manuals", array('controller'=>'manuals', 'action'=>'index'),array('escape' => false) ); ?>
</div>
<?php echo __('Edit Manual'); ?>
<?php echo $this->Form->create('Manual'); ?>
    <ul class="list-group">
        <?php echo $this->Form->hidden('id'); ?>
        <li class="input-group list-group-item">
            <?php echo $this->Session->flash('auth'); ?>
            Please enter your username and password
        </li>
        <li class="input-group list-group-item">
            <label style="display: block; float: left; width: 140px;">Name:</label>
            <?php echo $this->Form->input('name', array('label'=>'', 'style'=>'width:300px')); ?>
        </li>
        <li class="input-group list-group-item">
            <label style="display: block; float: left; width: 140px;">Description:</label>
            <?php echo $this->Form->textarea('description', array('label'=>'', 'cols'=>'50', 'rows'=>5)); ?>
        </li>
        <li class="input-group list-group-item">
            <label style="display: block; float: left; width: 140px;">Access Role Type:</label>
            <?php echo $this->Form->input('role_type_id', array('label'=>'')); ?>
        </li>
    </ul>
<?php echo $this->Form->end(__('Submit')); ?>
</div>
