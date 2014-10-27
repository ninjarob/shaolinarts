<h1>Welcome!</h1>
<ul class="list-group">
    <li class="input-group list-group-item">
        <?php echo $this->Html->link('Train', '/users/train') ?>
    </li>
    <li class="input-group list-group-item">
        <?php echo $this->Html->link('Learn', '/users/learn') ?>
    </li>
    <li class="input-group list-group-item">
        <?php echo $this->Html->link('Play', '/users/play') ?>
    </li>
    <li class="input-group list-group-item">
        <?php echo $this->Html->link('Extra', '/users/extra') ?>
    </li>
    <li class="input-group list-group-item">
        <?php echo $this->Html->link('Change Info', '/users/change_info') ?>
    </li>
    <?php if ($this->User->isInstructor(AuthComponent::user('id'))) {  ?>
    <li class="input-group list-group-item">
        <?php echo $this->Html->link('Admin', '/admin_pages/admin_home') ?>
    </li>
    <?php } ?>
</ul>