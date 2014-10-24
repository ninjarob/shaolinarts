<?php
class UserRoleStudio extends AppModel {
    public $belongsTo = array(
        'User', 'Role', 'Studio'
    );

    function beforeValidate($options = null)
    {
        // MySQL Unique Constraint Checks
        $unique_check = array(
                'user_id' => $this->data['User']["id"],
                'studio_id' => $this->data['Studio']["id"],
                'role_id' => $this->data['Role']["id"]
        );

        if (!$this->isUnique($unique_check))
            $this->invalidate('unique');
    }
}
?>