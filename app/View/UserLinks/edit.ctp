<div class="userLinks form">
    <div style="float:right;">
        <?php echo $this->Html->link( "Back to User Links", array('controller'=>'userLinks', 'action'=>'index'),array('escape' => false) ); ?>
    </div>
    <h3 style="clear:none;margin-top:0px;"><?php echo __('Edit User Link'); ?></h3>
    <?php echo $this->Form->create('UserLink'); ?>
    <ul class="list-group">
        <?php echo $this->Session->flash('auth'); ?>
        <?php echo $this->Form->input('id'); ?>
        <li class="input-group list-group-item">
            <label style="display: block; float: left; width: 140px;">Name:</label>
            <?php echo $this->Form->input('name', array('label'=>'', 'style'=>'width:300px')); ?>
        </li>
        <li class="input-group list-group-item">
            <label style="display: block; float: left; width: 140px;">Link:</label>
            <?php echo $this->Form->input('link', array('label'=>'', 'style'=>'width:300px')); ?>
        </li>
        <li class="input-group list-group-item">
            <label style="display: block; float: left; width: 140px;">Icon:</label>
            <?php echo $this->Form->input('icon', array('label'=>'', 'style'=>'width:300px')); ?>
        </li>
        <li class="input-group list-group-item">
            <label style="display: block; float: left; width: 140px;">Order:</label>
            <?php echo $this->Form->input('order', array('label'=>'', 'style'=>'width:300px')); ?>
        </li>
        <li class="input-group list-group-item">
            <label style="display: block; float: left; width: 140px;">For Students:</label>
            <?php echo $this->Form->input('role_type_id', array('label'=>'')); ?>
        </li>
    </ul>
    <?php echo $this->Form->end(__('Submit')); ?>
</div>