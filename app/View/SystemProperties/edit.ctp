<div class="systemProperties form">
<div style="float:right;">
    <?php echo $this->Html->link( "Back to Properties", array('controller'=>'systemProperties', 'action'=>'index'),array('escape' => false) ); ?>
</div>
<h3 style="clear:none;margin-top:0px;"><?php echo __('Edit SystemProperty'); ?></h3>
<?php echo $this->Form->create('SystemProperty'); ?>
<ul class="list-group">
    <?php echo $this->Session->flash('auth'); ?>
    <?php echo $this->Form->input('id'); ?>
    <li class="input-group list-group-item">
        <label style="display: block; float: left; width: 140px;">Name:</label>
        <?php echo $this->Form->input('name', array('label'=>'', 'style'=>'width:300px')); ?>
    </li>
    <li class="input-group list-group-item">
        <label style="display: block; float: left; width: 140px;">Value:</label>
        <?php echo $this->Form->input('value', array('label'=>'')); ?>
    </li>
</ul>
<?php echo $this->Form->end(__('Submit')); ?>
</div>