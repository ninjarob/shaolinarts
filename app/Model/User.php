<?php
App::uses('AuthComponent', 'Controller/Component');

class User extends AppModel {

    var $hasMany = array('UserRoleStudio' => array('foreignKey' => 'user_id', 'dependent'=>true));
    var $hasOne = array('UserInfo' => array('dependent'=>true));
    var $belongsTo = 'Status';

    public $validate = array(
        'email' => array(
            'required' => array(
                'rule' => array('email', true),
                'message' => 'Please provide a valid email address.'
            ),
             'unique' => array(
                'rule'    => array('isUniqueEmail'),
                'message' => 'This email is already in use',
            ),
            'between' => array(
                'rule' => array('between', 6, 60),
                'message' => 'Email Addresses must be between 6 to 100 characters'
            )
        ),
        'email_confirm' => array(
                    'required' => array(
                        'rule' => array('notEmpty'),
                        'message' => 'Please confirm your email'
                    ),
                     'equaltofield' => array(
                        'rule' => array('equaltofield','email'),
                        'message' => 'Both emails must match.'
                    )
                ),
        'password' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'A password is required'
            ),
            'min_length' => array(
                'rule' => array('minLength', '6'),
                'message' => 'Password must have a mimimum of 6 characters'
            )
        ),
        'password_confirm' => array(
            'required' => array(
                'rule' => array('notEmpty'),
                'message' => 'Please confirm your password'
            ),
             'equaltofield' => array(
                'rule' => array('equaltofield','password'),
                'message' => 'Both passwords must match.'
            )
        ),
        'role' => array(
            'valid' => array(
                'message' => 'Please enter a valid role',
                'allowEmpty' => false
            )
        ),
        'password_update' => array(
            'min_length' => array(
                'rule' => array('minLength', '6'),
                'message' => 'Password must have a mimimum of 6 characters',
                'allowEmpty' => true,
                'required' => false
            )
        ),
        'password_confirm_update' => array(
             'equaltofield' => array(
                'rule' => array('equaltofield','password_update'),
                'message' => 'Both passwords must match.',
                'required' => false,
            )
        )


    );

        /**
     * Before isUniqueUsername
     * @param array $options
     * @return boolean
     */
    function isUniqueUsername($check) {

        $username = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.id',
                    'User.username'
                ),
                'conditions' => array(
                    'User.username' => $check['username']
                )
            )
        );

        if(!empty($username)){
            if($this->data[$this->alias]['id'] == $username['User']['id']){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

    /**
     * Before isUniqueEmail
     * @param array $options
     * @return boolean
     */
    function isUniqueEmail($check) {

        $email = $this->find(
            'first',
            array(
                'fields' => array(
                    'User.id'
                ),
                'conditions' => array(
                    'User.email' => $check['email']
                )
            )
        );

        if(!empty($email)){
            if(in_array('id', $this->data['User']) && $this->data['User']['id'] == $email['User']['id']){
                return true;
            }else{
                return false;
            }
        }else{
            return true;
        }
    }

    public function alphaNumericDashUnderscore($check) {
        // $data array is passed using the form field name as the key
        // have to extract the value to make the function generic
        $value = array_values($check);
        $value = $value[0];

        return preg_match('/^[a-zA-Z0-9_ \-]*$/', $value);
    }

    public function equaltofield($check,$otherfield)
    {
        //get name of field
        $fname = '';
        foreach ($check as $key => $value){
            $fname = $key;
            break;
        }
        return $this->data[$this->name][$otherfield] === $this->data[$this->name][$fname];
    }

    /**
     * Before Save
     * @param array $options
     * @return boolean
     */
     public function beforeSave($options = array()) {
        // hash our password
        if (isset($this->data[$this->alias]['password'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password']);
        }

        // if we get a new password, hash it
        if (isset($this->data[$this->alias]['password_update']) && !empty($this->data[$this->alias]['password_update'])) {
            $this->data[$this->alias]['password'] = AuthComponent::password($this->data[$this->alias]['password_update']);
        }

        // fallback to our parent
        return parent::beforeSave($options);
    }

//    public function paginate($conditions, $fields, $order, $limit, $page = 1,
//        $recursive = null, $extra = array()) {
//
//        $sql = 'select distinct(u.*, ui.*) from users u join user_infos ui on u.id = ui.user_id join user_role_studios urs on u.id = urs.user_id where '.
//                    'urs.studio_id in ('.
//                    $order;
//
//        $list = $this->find(
//            'all', array('conditions'=>array(), 'limit'=>$limit, 'page'=>$page, 'order'=>$order)
//        );
//
//        $this->log($list);
//
//        return $list;
//    }


}
?>