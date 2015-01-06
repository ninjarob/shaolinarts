<h1>Administration</h1>
<ul class="list-group">
    <li class="input-group list-group-item">
        <?php echo $this->Html->link('Manage Users', '/users/user_management') ?>
    </li>
    <?php if ($this->User->isAdmin(AuthComponent::user('id'))) {  ?>
    <li class="input-group list-group-item">
        <?php echo $this->Html->link('Manual Management', '/manuals/index') ?>
    </li>
    <li class="input-group list-group-item">
        <?php echo $this->Html->link('Role Management', '/roles') ?>
    </li>
    <li class="input-group list-group-item">
        <?php echo $this->Html->link('System Properties', '/systemProperties') ?>
    </li>
    <li class="input-group list-group-item">
        <?php echo $this->Html->link('Common Email Messages', '/commonEmailMessages') ?>
    </li>
    <?php }?>
</ul>