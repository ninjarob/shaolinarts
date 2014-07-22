<?php echo $this->Form->create('User'); ?>
<h1>Log In</h1>
<ul class="list-group">
    <li class="input-group list-group-item">
        <?php echo $this->Session->flash('auth'); ?>
        Please enter your username and password
    </li>
    <li class="input-group list-group-item">
        <label style="display: block; float: left; width: 100px;">Email:</label>
        <?php echo $this->Form->input('email', array('label'=>'')); ?>
    </li>
    <li class="input-group list-group-item">
        <label style="display: block; float: left; width: 100px;">Password:</label>
        <?php echo $this->Form->input('password', array('label'=>'')); ?>
    </li>
    <li class="input-group list-group-item">
        <?php echo $this->Form->submit('Login', array('div' => false,'class' => 'urclass', 'title' => 'Title')); ?>
    </li>
    <li class="input-group list-group-item">
        <?php echo $this->Html->link('Did you forget your user name or password?', '/pages/passwordManagement') ?>
    </li>
    <li class="input-group list-group-item">
        <a href="add" ajax="false">Is this the first time at the website?</a>
    </li>
</ul>
<?php echo $this->Form->end(); ?>
<script type="text/javascript">  $(document).ready(function() {    $('#UserUsername').focus();  });</script>