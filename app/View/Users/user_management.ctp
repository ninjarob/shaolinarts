<div class="users form">
    <h1>Users</h1>
    <table id="pattern-style-b">
        <thead>
        <tr>
            <!--<th><?php echo $this->Form->checkbox('all', array('name' => 'CheckAll', 'id' => 'CheckAll')); ?></th>-->
            <th><?php echo $this->Paginator->sort('UserInfo.fname', 'First');?></th>
            <th><?php echo $this->Paginator->sort('UserInfo.lname', 'Last');?></th>
            <th><?php echo $this->Paginator->sort('email', 'E-Mail');?></th>
            <th><?php echo $this->Paginator->sort('Role.name','Role');?></th>
            <th><?php echo $this->Paginator->sort('status','Status');?></th>
            <th>Actions</th>
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
            <td style="text-align: center;"><?php echo $user['User']['email']; ?></td>
            <td style="text-align: center;"><?php echo $user['Role']['name']; ?></td>
            <td style="text-align: center;"><?php if ($user['User']['status'] == 1) {
                                 echo("Active");
                              }
                              else {
                                 echo("Inactive");
                              }
             ?></td>
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