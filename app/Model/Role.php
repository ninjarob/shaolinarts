<?php
class Role extends AppModel {
    var $hasMany = array('UserRoleStudio');
    var $belongsTo = array('RoleType');
}
?>