<?php
class UserInfo extends AppModel {

     public $validate = array(
        'fname' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'Please provide a valid first name.'
            )
        ),
        'lname' => array(
            'required' => array(
                'rule' => 'notEmpty',
                'message' => 'Please provide a valid last name.'
            )
        )
    );
    }
?>