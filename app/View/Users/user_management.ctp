<div class="users form">
    <h1>Users</h1>
    <table id="pattern-style-b">
        <thead>
        <tr>
            <!--<th><?php echo $this->Form->checkbox('all', array('name' => 'CheckAll', 'id' => 'CheckAll')); ?></th>-->
            <th><?php echo $this->Paginator->sort('UserInfo.fname', 'First');?></th>
            <th><?php echo $this->Paginator->sort('UserInfo.lname', 'Last');?></th>
            <th><?php echo $this->Paginator->sort('Role.name','Role');?></th>
            <th style="white-space: nowrap;">Email/Phone</th>
            <th>Address</th>
            <th style="white-space: nowrap;">Spouse Guardian</th>
            <th>Birthday</th>
            <?php if ($this->User->isManager(AuthComponent::user('id'))) {  ?>
            <th>Actions</th>
            <?php } ?>
        </tr>
        </thead>
        <tbody>
        <?php $count=0; ?>
        <?php foreach($users as $user): ?>
        <?php $count ++;?>
        <?php if($count % 2): echo '<tr>'; else: echo '
        <tr class="zebra">' ?>
            <?php endif; ?>
            <!--<td><?php echo $this->Form->checkbox('User.id.'.$user['User']['id']); ?></td>-->
            <td style="text-align: center;"><?php echo $user['UserInfo']['fname']; ?></td>
            <td style="text-align: center;"><?php echo $user['UserInfo']['lname']; ?></td>
            <td style="text-align: center;">
                <?php foreach ($user['UserRoleStudio'] as $urs) { ?>
                    <div style="white-space: nowrap;">
                        <?php echo($roles[$urs['role_id']]); ?>
                        <?php if ($urs['studio_id'] != 0) {
                            echo(' - '.$studios[$urs['studio_id']].'<br>');
                        }
                        ?>
                    </div>
                <?php } ?>
            </td>
            <td style="text-align: center; font-size: 8px;">
                <div style="white-space: nowrap;"><?php echo $user['User']['email']; ?></div>
                <?php if (!empty($user['UserInfo']['homephone'])) { ?>
                    <div style="white-space: nowrap;">HP: <?php echo $user['UserInfo']['homephone']; ?></div>
                <?php } ?>
                <?php if (!empty($user['UserInfo']['cellphone'])) { ?>
                    <div style="white-space: nowrap;">CP: <?php echo $user['UserInfo']['cellphone']; ?></div>
                <?php } ?>
                <?php if (!empty($user['UserInfo']['workphone'])) { ?>
                    <div style="white-space: nowrap;">WP: <?php echo $user['UserInfo']['workphone']; ?></div>
                <?php } ?>
            </td>
            <td>
                <div style="white-space: nowrap"><?php echo $user['UserInfo']['address']; ?></div>
                <div style="white-space: nowrap">
                    <?php if (!empty($user['UserInfo']['spouseguardian'])) { ?><?php echo $user['UserInfo']['city']; ?>,<?php } ?>
                    <?php echo $user['UserInfo']['state']; ?> <?php echo $user['UserInfo']['zip']; ?>
                </div>
            </td>
            <td>
                <?php if (!empty($user['UserInfo']['spouseguardian'])) { ?>
                    <div style="white-space: nowrap;"><?php echo $user['UserInfo']['spouseguardian']; ?></div>
                <?php } ?>
                <?php if (!empty($user['UserInfo']['sgphone'])) { ?>
                    <div style="white-space: nowrap;">Phone: <?php echo $user['UserInfo']['sgphone']; ?></div>
                <?php } ?>
                <?php if (!empty($user['UserInfo']['sgcellphone'])) { ?>
                    <div style="white-space: nowrap;">CP: <?php echo $user['UserInfo']['sgcellphone']; ?></div>
                <?php } ?>
            </td>
            <td>
                <div style="white-space: nowrap;"><?php echo $user['UserInfo']['birthdate']; ?></div>
            </td>
            <?php if ($this->User->isManager(AuthComponent::user('id'))) {  ?>
            <td>
                <div style="width:130px"><?php echo $this->Html->link( "Edit", array('action'=>'edit', $user['User']['id']) ); ?> |
                <?php
                if( $user['User']['status'] != 0){
                    echo $this->Html->link( "Delete", array('action'=>'delete', $user['User']['id']));
                }else{
                    echo $this->Html->link( "Re-Activate", array('action'=>'activate', $user['User']['id']));
                }
                ?></div>
            </td>
            <?php } ?>
        </tr>
        <?php endforeach; ?>
        <?php unset($user); ?>
        </tbody>
    </table>
    <?php echo $this->Paginator->prev('<< ' . __('previous', true), array(), null,
    array('class'=>'disabled'));?>
    <?php echo $this->Paginator->numbers(array( 'class' => 'numbers' ));?>
    <?php echo $this->Paginator->next(__('next', true) . ' >>', array(), null, array('class' =>
    'disabled'));?>
</div>
<?php echo $this->Html->link( "Add A New User.", array('action'=>'add'),array('escape' => false) ); ?>
<br/>