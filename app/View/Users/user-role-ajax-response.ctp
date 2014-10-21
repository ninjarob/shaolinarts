<?php foreach ($userRoleInfo as $j) { ?>
<li class="list-group-item" style="width:500px;">
    <?php echo($j['Role']['name']);?>
    <?php echo($j['Studio']['name']);?>
    <div style="float:right; margin-right:5px;vertical-align: text-top;"><?php echo $this->Html->image('remove_icon.png', array('style'=>'width:20px; border:none; margin:0px;')); ?></div>
</li>
<?php } ?>
<li id="newRole" class="list-group-item" style="width:500px; height:46px;">
    <?php
                    echo $this->Form->create('UserRoleStudio', array('url'=>'add_role', 'default' => false));
    echo $this->Form->input('Role.id', array('options' => $roles, 'label'=>''));
    echo $this->Form->input('Studio.id', array('options' => $studios, 'label'=>''));
    echo $this->Form->submit('add_icon.png', array('style'=>'width:20px; float:right; margin-right:5px;'));
    echo $this->Form->end();
    ?>
    <?php
                    // JsHelper should be loaded in $helpers in controller
                    // Form ID: #ContactsContactForm
                    // Div to use for AJAX response: #contactStatus
                    $data = $this->Js->get('#UserRoleStudioEditForm')->serializeForm(array('isForm' => true, 'inline' => true));
    $this->Js->get('#UserRoleStudioEditForm')->event('submit',
    $this->Js->request(array('action' => 'add_role', 'controller' => 'users'),
    array('update' => '#userRoleManagement','data'=>$data,'async' => true,'dataExpression'=>true,'method' => 'POST'))
    );
    echo $this->Js->writeBuffer();
    ?>
</li>