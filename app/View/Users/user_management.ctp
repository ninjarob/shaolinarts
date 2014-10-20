<div class="users form">
    <h3>User Management</h3>
    <table id="hor-minimalist-b" style="margin:0px;">
        <tr>
            <td style="white-space: nowrap;">First Name</td>
            <td style="white-space: nowrap;">Last Name</td>
            <td>Manager</td>
            <td>Kung Fu</td>
            <td>Tai Chi</td>
            <td>Studio</td>
            <td></td>
        </tr>
        <tr>
            <?php echo $this->Form->create('User', array('action'=>'user_management')); ?>
            <td><?php echo $this->Form->input('fnfilter', array('label'=>'', 'style'=>'font-size:8px; width:50px; height:20px;')); ?></td>
            <td><?php echo $this->Form->input('lnfilter', array('label'=>'', 'style'=>'font-size:8px; width:50px; height:20px;')); ?></td>
            <td><?php echo $this->Form->input('mrfilter', array('label'=>'', 'style'=>'font-size:8px; width:180px; height:20px; white-space: nowrap;')); ?></td>
            <td><?php echo $this->Form->input('kfrfilter', array('label'=>'', 'style'=>'font-size:8px; width:180px; height:20px;')); ?></td>
            <td><?php echo $this->Form->input('tcrfilter', array('label'=>'', 'style'=>'font-size:8px; width:180px; height:20px;')); ?></td>
            <td><?php echo $this->Form->input('sfilter', array('label'=>'', 'style'=>'font-size:8px; width:180px; height:20px;')); ?></td>
            <td><?php echo $this->Form->button('Clear', array('type'=>'reset')); ?></td>
            <td><?php echo $this->Form->submit('Go!', array('div' => false,'class' => 'urclass', 'title' => 'Filter Results')); ?></td>
            <?php echo $this->Form->end(); ?>
        </tr>
    </table>
    <br/>
    <table id="pattern-style-b">
        <thead>
        <tr>
            <th><?php echo $this->Paginator->sort('UserInfo.fname', 'First');?></th>
            <th><?php echo $this->Paginator->sort('UserInfo.lname', 'Last');?></th>
            <th>Rank Role studio</th>
            <th style="white-space: nowrap;">Email/Phone</th>
            <th>Address</th>
            <th style="white-space: nowrap;">Spouse Guardian</th>
            <th>Birthday</th>

            <th><?php if ($this->User->isManager(AuthComponent::user('id'))) {  ?>Actions<?php } ?></th>
        </tr>
        </thead>
        <tbody>
        <?php $count=0; ?>
        <?php foreach($users as $user): ?>
        <?php $count ++;?>
        <?php if($count % 2): echo '<tr>'; else: echo '
        <tr class="zebra">' ?>
            <?php endif; ?>
            <td><?php echo $user['UserInfo']['fname']; ?></td>
            <td><?php echo $user['UserInfo']['lname']; ?></td>
            <td>
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
            <td style="font-size: 8px;">
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
            <td style="font-size: 8px;">
                <?php if ($this->User->isManager(AuthComponent::user('id'))) {  ?>
                <div style="width:130px"><?php echo $this->Html->link("Edit", array('action'=>'edit', $user['User']['id']), array('style'=>'font-size:8px;')); ?> |
                    <?php echo $this->Html->link( "Delete", array('action'=>'delete', $user['User']['id']), array('style'=>'font-size:8px;'));
                ?></div>
                <?php } ?>
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