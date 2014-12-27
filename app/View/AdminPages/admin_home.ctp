<h1>Administration</h1>
<ul class="list-group">
    <li class="input-group list-group-item">
        <?php echo $this->Html->link('Manage Users', '/users/user_management') ?>
    </li>
    <?php if ($this->User->isAdmin(AuthComponent::user('id'))) {  ?>
    <li class="input-group list-group-item">
        <?php echo $this->Html->link('Manual Management', '/admin_pages/manual_management') ?>
    </li>
    <li class="input-group list-group-item">
        <?php echo $this->Html->link('Role Management', '/admin_pages/role_management') ?>
    </li>
    <?php }?>
</ul>