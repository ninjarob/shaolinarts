<script type="text/javascript">
    // on dom ready
    $(document).ready(function(){
    // class exists
    if($('.confirm_delete').length) {
            // add click handler
        $('.confirm_delete').click(function(){
            // ask for confirmation
            var result = confirm('Are you sure you want to delete this?');

            // show loading image
            $('.ajax_loader').show();
            $('#flashMessage').fadeOut();

            // get parent row
            var row = $(this).parents('li');

            // do ajax request
            if(result) {
                $.ajax({
                    type:"POST",
                    url:$(this).attr('href'),
                    data:"ajax=1",
                    dataType: "json",
                    success:function(response){
                        // hide loading image
                        $('.ajax_loader').hide();

                        // hide table row on success
                        if(response.success == true) {
                            row.fadeOut();
                        }

                        // show respsonse message
                        if( response.msg ) {
                            $('#ajax_msg').html( response.msg ).show();
                        } else {
                            $('#ajax_msg').html( "<p id='flashMessage' class='flash_bad'>An unexpected error has occured, please refresh and try again</p>" ).show();
                        }
                    }
                });
            }
        return false;
        });
    }
    });
</script>

<?php foreach ($userRoleInfo as $j) { ?>
<li class="list-group-item" style="width:500px;">
    <?php echo($j['Role']['name']);?>
    <?php echo($j['Studio']['name']);?>
    <div style="float:right; margin-right:5px;vertical-align: text-top;"><?php echo $this->Html->link($this->Html->image('remove_icon.png', array('style'=>'width:20px; border:none; margin:0px;')),
        array('action'=>'ajax_delete_role',$j['UserRoleStudio']['id']),array('escape'=>false, 'class'=>'confirm_delete')) ?></div>
</li>
<?php } ?>
<li id="newRole" class="list-group-item" style="width:500px; height:46px;">
    <?php
        echo $this->Form->create('UserRoleStudio', array('url'=>'ajax_add_role', 'default' => false));
        echo $this->Form->input('User.id', array('type'=>'hidden', 'value' => $this->data['User']['id']));
        echo $this->Form->input('Role.id', array('options' => $roles, 'label'=>''));
        echo $this->Form->input('Studio.id', array('options' => $studios, 'label'=>''));
        echo $this->Form->submit('add_icon.png', array('style'=>'width:20px; float:right; margin-right:5px;'));
        echo $this->Form->end();
    ?>
    <?php
        // JsHelper should be loaded in $helpers in controller
        // Form ID: #ContactsContactForm
        // Div to use for AJAX response: #contactStatus
        $data = $this->Js->get('#UserRoleStudioAjaxAddRoleForm')->serializeForm(array('isForm' => true, 'inline' => true));
        $this->Js->get('#UserRoleStudioAjaxAddRoleForm')->event('submit',
        $this->Js->request(array('action' => 'ajax_add_role', 'controller' => 'users'),
        array('update' => '#userRoleManagement','data'=>$data,'async' => true,'dataExpression'=>true,'method' => 'POST'))
    );
    echo $this->Js->writeBuffer();
    ?>
</li>