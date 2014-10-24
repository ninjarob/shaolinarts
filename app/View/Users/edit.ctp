<fieldset>
    <?php echo $this->Form->create('User');?>
    <?php echo $this->Form->input('id', array('type'=>'hidden', 'value' => $this->data['User']['id'])); ?>
    <?php echo $this->Form->input('UserInfo.id', array('type'=>'hidden', 'value' => $this->data['UserInfo']['id'])); ?>
    <?php echo $this->Form->input('UserInfo.user_id', array('type'=>'hidden', 'value' => $this->data['User']['id'])); ?>
    <legend><?php echo $this->Html->link('Back To Manage Users', '/users/user_management') ?></legend>
    <?php echo $this->Form->submit('Save', array('class' => 'form-submit', 'title' => 'Click here to edit the user')); ?>
    <div  style="float:left; width:400px;">
        <ul class="list-group">
            <li class="input-group list-group-item">
                <label class="login_label">First Name*:</label>
                <?php echo $this->Form->input('UserInfo.fname', array('label'=>'', 'maxLength' => 32, 'title' => 'First Name')); ?>
            </li>
            <li class="input-group list-group-item">
                <label class="login_label">Last Name*:</label>
                <?php echo $this->Form->input('UserInfo.lname', array('label'=>'', 'maxLength' => 32, 'title' => 'Last Name')); ?>
            </li>
            <li class="input-group list-group-item">
                <label class="login_label">Email*:</label>
                <?php echo $this->Form->input('email', array('label'=>'', 'maxLength' => 100, 'title' => 'Email')); ?>
            </li>
            <li class="input-group list-group-item">
                <label class="login_label">Home Phone:</label>
                <?php echo $this->Form->input('UserInfo.homephone', array('label'=>'', 'maxLength' => 32, 'title' => 'Home Phone')); ?>
            </li>
            <li class="input-group list-group-item">
                <label class="login_label">Cell Phone:</label>
                <?php echo $this->Form->input('UserInfo.cellphone', array('label'=>'', 'maxLength' => 32, 'title' => 'Cell Phone')); ?>
            </li>
            <li class="input-group list-group-item">
                <label class="login_label">Work Phone:</label>
                <?php echo $this->Form->input('UserInfo.workphone', array('label'=>'', 'maxLength' => 32, 'title' => 'Work Phone')); ?>
            </li>
            <li class="input-group list-group-item">
                <label class="login_label">Address:</label>
                <?php echo $this->Form->input('UserInfo.address', array('label'=>'', 'maxLength' => 32, 'title' => 'Address')); ?>
            </li>
            <li class="input-group list-group-item">
                <label class="login_label">City:</label>
                <?php echo $this->Form->input('UserInfo.city', array('label'=>'', 'maxLength' => 32, 'title' => 'City')); ?>
            </li>
            <li class="input-group list-group-item">
                <label class="login_label">State:</label>
                <?php echo $this->Form->input('UserInfo.state', array('label'=>'', 'maxLength' => 32, 'title' => 'State')); ?>
            </li>
            <li class="input-group list-group-item">
                <label class="login_label">Zip:</label>
                <?php echo $this->Form->input('UserInfo.zip', array('label'=>'', 'maxLength' => 32, 'title' => 'Zip')); ?>
            </li>


            <li class="input-group list-group-item">
                <label class="login_label">Birth Date:</label>
                <?php echo $this->Form->input('UserInfo.birthdate', array('dateFormat'=>'DMY', 'minYear'=>date('Y')-110, 'maxYear'=>date('Y')-3+1, 'empty'=>array('- -'), 'maxLength' => 32, 'title' => 'Birth Date', 'label'=>'')); ?>
            </li>
            <li class="input-group list-group-item">
                <label class="login_label">Spouse or Guardian:</label>
                <?php echo $this->Form->input('UserInfo.spouseguardian', array('label'=>'', 'maxLength' => 32, 'title' => 'Spouse/Guardian')); ?>
            </li>
            <li class="input-group list-group-item">
                <label class="login_label">SG Phone:</label>
                <?php echo $this->Form->input('UserInfo.sgphone', array('label'=>'', 'maxLength' => 32, 'title' => 'Spouse or Guardian Home Phone')); ?>
            </li>
            <li class="input-group list-group-item">
                <label class="login_label">SG Cell Phone:</label>
                <?php echo $this->Form->input('UserInfo.sgcellphone', array('label'=>'', 'maxLength' => 32, 'title' => 'Spouse or Guardian Cell Phone')); ?>
            </li>
        </ul>
        <?php echo $this->Form->submit('Save', array('class' => 'form-submit', 'title' => 'Click here to edit the user')); ?>
    </div>
    <?php echo $this->Form->end(); ?>
    <div  style="margin-left: 20px; float:left; width:400px;">
        <h4>This user has the following roles:</h4>

        <ul class="list-group" id="userRoleManagement">


            <script type="text/javascript">
                // on dom ready
                $(document).ready(function(){
                // class exists
                if($('.confirm_delete').length) {
                        // add click handler
                    $('.confirm_delete').click(function(){
                        // ask for confirmation
                        var result = confirm('Please confirm you wish to DELETE this role for this user.');

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
                <div style="float:right; margin-right:5px;vertical-align: text-top;">
                    <?php echo $this->Html->link($this->Html->image('remove_icon.png', array('style'=>'width:20px; border:none; margin:0px;')),
                                                   array('action'=>'ajax_delete_role',$j['UserRoleStudio']['id']),array('escape'=>false, 'class'=>'confirm_delete')) ?>
                </div>
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
            </li>
            <?php
            // JsHelper should be loaded in $helpers in controller
            // Form ID: #ContactsContactForm
            // Div to use for AJAX response: #contactStatus
            $data = $this->Js->get('#UserRoleStudioEditForm')->serializeForm(array('isForm' => true, 'inline' => true));
            $this->Js->get('#UserRoleStudioEditForm')->event('submit',
            $this->Js->request(array('action' => 'ajax_add_role', 'controller' => 'users'),
            array('update' => '#userRoleManagement','data'=>$data,'async' => true,'dataExpression'=>true,'method' => 'POST'))
            );
            echo $this->Js->writeBuffer();
            ?>
        </ul>
    </div>
</fieldset>