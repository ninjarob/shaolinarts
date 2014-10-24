<?php echo $this->Form->create('User');?>
<fieldset>
    <legend><?php echo __('Registeration Form'); ?></legend>
    <?php if (AuthComponent::user()) { ?>
    <legend><?php echo $this->Html->link('Back To Manage Users', '/users/user_management') ?></legend>
    <?php } ?>
    <ul class="list-group">
        <li class="input-group list-group-item">
            <label class="login_label">First Name*:</label>
            <?php echo $this->Form->input('UserInfo.fname', array('label'=>'', 'maxLength' => 32, 'title' =>
            'First Name')); ?>
        </li>
        <li class="input-group list-group-item">
            <label class="login_label">Last Name*:</label>
            <?php echo $this->Form->input('UserInfo.lname', array('label'=>'', 'maxLength' => 32, 'title' =>
            'Last Name')); ?>
        </li>
        <li class="input-group list-group-item">
            <label class="login_label">Email*:</label>
            <?php echo $this->Form->input('email', array('label'=>'', 'maxLength' => 100, 'title' =>
            'Email')); ?>
        </li>
        <li class="input-group list-group-item">
            <label class="login_label">Email Confirm*:</label>
            <?php echo $this->Form->input('email_confirm', array('label'=>'', 'maxLength' => 100, 'title' =>
            'Email Confirmation')); ?>
        </li>
        <li class="input-group list-group-item">
            <label class="login_label">Password*:</label>
            <?php echo $this->Form->input('password', array('label'=>'')); ?>
        </li>
        <li class="input-group list-group-item">
            <label class="login_label">Confirm Password*:</label>
            <?php echo $this->Form->input('password_confirm', array('label' => '', 'maxLength' => 255,
            'title' => 'Confirm password', 'type'=>'password')); ?>
        </li>
    <?php if (AuthComponent::user()) { ?>
        <li class="input-group list-group-item">
            <label class="login_label">Main Website Role:</label>
            <?php echo $this->Form->input('Role.id', array('options' => $roles, 'label'=>'')); ?>
        </li>
        <li class="input-group list-group-item">
            <label class="login_label">Studio:</label>
            <?php echo $this->Form->input('Studio.id', array('options' => $studios, 'label'=>'')); ?>
        </li>
    <?php }
    echo $this->Form->submit('Register', array('class' => 'form-submit', 'title' => 'Click here to add the user'));
    ?>
    </ul>
</fieldset>
<?php echo $this->Form->end(); ?>
<script type="text/javascript">  $(document).ready(function() {    $('#Email').focus();  });</script>