<script type="text/javascript">
    function fixPhotoIframe() {
        $('#photoFrame').contents().find('html').attr('style','overflow:hidden');
        if (!$('#photoFrame').contents().find('img').attr('height')) {
            $('#photoFrame').contents().find('img').attr('height','400');
        }
    }
</script>
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
        <div id="photo">
            <h4>User Photo</h4>


            <?php if ($photoId != null && !empty($photoId)) { ?>
                <iframe id="photoFrame" src='<?php echo $this->Html->url(array("controller" => "photos","action" => "photo", $photoId));?>' style="width:400px; height:400px; border:none; overflow:hidden;" onload="fixPhotoIframe()">
                    <?php if (isset($file['Photo'])) { ?>
                        <?php
                            print $file['Photo']['data'];
                        ?>
                    <?php } ?>
                </iframe>
                <?php echo $this->Form->postLink(__('Delete Photo'), array('controller'=>'photos', 'action' => 'delete', $photoId), array(), __('Are you sure you want to delete this photo?', $photoId)); ?>
            <?php } else { ?>
            <?php echo $this->Form->create('Photo', array('type' => 'file', 'url'=>'/photos/add')); ?>
            <?php echo $this->Form->hidden('User.id', array('value'=>$this->data['User']['id'])); ?>
            <ul class="list-group">
                <li class="input-group list-group-item">
                    <label style="display: block; float: left; width: 140px;"></label>
                    <?php echo $this->Form->input('data', array('type'=>'file', 'accept'=>'image/jpeg,image/gif,image/png', 'label'=>'')); ?>
                </li>
            </ul>
            <?php echo $this->Form->end(__('Add')); ?>
            <?php } ?>
        </div>
        <div id="roles">
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
        <div id="notes">
            <h4>Notes:</h4>
            <ul id="notesList" class="list-group" style="width:520px; height:312px; overflow:auto;">
                <li class="list-group-item" style="width:500px; height:115px;">
                    <div style="float:left; width:400px; height:100px; overflow:auto;">
                        <div style="font-size:10px">20 Jan 2015</div>
                        This is a very good note!  HA!  This student has worked so hard on this very fine time.  Some other text is also here to fill in the space.
                    </div>
                    <div style="float:right; margin-right:5px;vertical-align: text-top;">
                        <?php echo $this->Html->link($this->Html->image('remove_icon.png', array('style'=>'width:20px; border:none; margin:0px;')),
                        array('action'=>'ajax_delete_role',$j['UserRoleStudio']['id']),array('escape'=>false, 'class'=>'confirm_delete')) ?>
                    </div>
                </li>
                <li class="list-group-item" style="width:500px; height:115px;">
                    <div style="float:left; width:400px; height:100px; overflow:auto;">
                        <div style="font-size:10px">12 Jan 2015</div>
                        This is a second note.  But not one of much importance.
                    </div>
                    <div style="float:right; margin-right:5px;vertical-align: text-top;">
                        <?php echo $this->Html->link($this->Html->image('remove_icon.png', array('style'=>'width:20px; border:none; margin:0px;')),
                        array('action'=>'ajax_delete_role',$j['UserRoleStudio']['id']),array('escape'=>false, 'class'=>'confirm_delete')) ?>
                    </div>
                </li>
                <li class="list-group-item" style="width:500px; height:115px;">
                    <div style="float:left; width:400px; height:100px; overflow:auto;">
                        <div style="font-size:10px">11 Jan 2015</div>
                        This is a second note.  But not one of much importance.
                    </div>
                    <div style="float:right; margin-right:5px;vertical-align: text-top;">
                        <?php echo $this->Html->link($this->Html->image('remove_icon.png', array('style'=>'width:20px; border:none; margin:0px;')),
                        array('action'=>'ajax_delete_role',$j['UserRoleStudio']['id']),array('escape'=>false, 'class'=>'confirm_delete')) ?>
                    </div>
                </li>
                <li class="list-group-item" style="width:500px; height:115px;">
                    <div style="float:left; width:400px; height:100px; overflow:auto;">
                        <div style="font-size:10px">4 Dec 2014</div>
                        This is a second note.  But not one of much importance.
                    </div>
                    <div style="float:right; margin-right:5px;vertical-align: text-top;">
                        <?php echo $this->Html->link($this->Html->image('remove_icon.png', array('style'=>'width:20px; border:none; margin:0px;')),
                        array('action'=>'ajax_delete_role',$j['UserRoleStudio']['id']),array('escape'=>false, 'class'=>'confirm_delete')) ?>
                    </div>
                </li>
                <li class="list-group-item" style="width:500px; height:115px;">
                    <div style="float:left; width:400px; height:100px; overflow:auto;">
                        <div style="font-size:10px">4 Dec 2014</div>
                        This is a second note.  But not one of much importance.
                    </div>
                    <div style="float:right; margin-right:5px;vertical-align: text-top;">
                        <?php echo $this->Html->link($this->Html->image('remove_icon.png', array('style'=>'width:20px; border:none; margin:0px;')),
                        array('action'=>'ajax_delete_role',$j['UserRoleStudio']['id']),array('escape'=>false, 'class'=>'confirm_delete')) ?>
                    </div>
                </li>
            </ul>
            <div id="addNoteSection">
                <h4>Add Note</h4>
                <ul id="addNote" class="list-group" style="width:500px;">
                    <li id="newNote" class="list-group-item" style="width:500px; height:100px;">
                        <?php echo $this->Form->create('Comment', array('url'=>'ajax_add_role', 'default' => false));
                        echo $this->Form->input('User.id', array('type'=>'hidden', 'value' => $this->data['User']['id']));
                        echo $this->Form->textarea('Comment', array('type'=>'text', 'label'=>'', 'style'=>'width:420px;float:left;'));
                        echo $this->Form->submit('add_icon.png', array('style'=>'width:20px; float:right; margin-right:5px;'));
                        echo $this->Form->end();
                        ?>
                    </li>
                </ul>
            </div>
        </div>
    </div>
</fieldset>