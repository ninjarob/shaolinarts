<?php
class UserRoleStudio extends AppModel {
    public $belongsTo = array(
        'User', 'Role', 'Studio'
    );
    }
?>