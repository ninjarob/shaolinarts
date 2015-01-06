<div class="commonEmailMessages form">
<div style="float:right;">
    <?php echo $this->Html->link( "Back to Common Email Messages", array('controller'=>'commonEmailMessages', 'action'=>'index'),array('escape' => false) ); ?>
</div>
<h3 style="clear:none;margin-top:0px;"><?php echo __('Add Common Email Message'); ?></h3>
<?php echo $this->Form->create('CommonEmailMessage'); ?>
	<fieldset>
        <ul class="list-group">
            <li class="input-group list-group-item">
                <label style="display: block; float: left; width: 140px;">Name:</label>
                <?php echo $this->Form->input('name', array('label'=>'', 'style'=>'width:300px')); ?>
            </li>
            <li class="input-group list-group-item">
                <label style="display: block; float: left; width: 140px;">Subject:</label>
                <?php echo $this->Form->input('subject', array('label'=>'', 'style'=>'width:300px')); ?>
            </li>
            <li class="input-group list-group-item">
                <label style="display: block; float: left; width: 140px;">Email Body:</label>
                <?php echo $this->Form->textArea('body', array('label'=>'', 'style'=>'width:300px')); ?>
            </li>
            <li class="input-group list-group-item">
                <label style="display: block; float: left; width: 140px;">Notes:</label>
                <?php echo $this->Form->input('notes', array('label'=>'', 'style'=>'width:300px')); ?>
            </li>
        </ul>
	</fieldset>
<?php echo $this->Form->end(__('Submit')); ?>
</div>