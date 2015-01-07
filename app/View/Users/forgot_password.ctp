<?php echo $this->Form->create('User', array('action'=>'sendEmailForPasswordRenewal')); ?>
<h1>Forgot Password</h1>
<br/>
Enter the email address that you have on our files and we'll send you a link to reset your password.
<ul class="list-group">
    <li class="input-group list-group-item">
        <label style="display: block; float: left; width: 100px;">Email:</label>
        <?php echo $this->Form->input('email', array('label'=>'')); ?>
    </li>
    <li class="input-group list-group-item">
        <?php echo $this->Form->submit('Reset Password', array('div' => false,'class' => 'urclass', 'title' => 'Reset <Password></Password>')); ?>
    </li>
</ul>
<?php echo $this->Form->end(); ?>
<script type="text/javascript">  $(document).ready(function() {    $('#UserUsername').focus();  });</script>