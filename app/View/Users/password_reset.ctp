<?php echo $this->Form->create('User', array('url'=>'/users/password_reset/'.$hash)); ?>
<?php echo $this->Form->input('id', array('type'=>'hidden', 'value' => $id)); ?>
<h1>Forgot Password</h1>
<br/>
Enter the email address that you have on our files and we'll send you a link to reset your password.
<ul class="list-group">
    <li class="input-group list-group-item">
        <label class="login_label">Password*:</label>
        <?php echo $this->Form->input('password', array('label'=>'')); ?>
    </li>
    <li class="input-group list-group-item">
        <label class="login_label">Confirm Password*:</label>
        <?php echo $this->Form->input('password_confirm', array('label' => '', 'maxLength' => 255,
        'title' => 'Confirm password', 'type'=>'password')); ?>
    </li>
    <li class="input-group list-group-item">
        <?php echo $this->Form->submit('Reset Password', array('div' => false,'class' => 'urclass', 'title' => 'Reset Password')); ?>
    </li>
</ul>
<?php echo $this->Form->end(); ?>
<script type="text/javascript">  $(document).ready(function() {    $('#UserPassword').focus();  });</script>