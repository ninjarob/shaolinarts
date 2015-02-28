<?php
App::uses('AppModel', 'Model');
class UserLink extends AppModel {

	public $displayField = 'name';

	public $validate = array(
		'name' => array(
			'notEmpty' => array(
				'rule' => array('notEmpty'),
			),
		),
		'link' => array(
            'notEmpty' => array(
                'rule' => array('notEmpty'),
            ),
        ),
	);

	public $belongsTo = array(
        'RoleType' => array(
            'className' => 'RoleType',
            'foreignKey' => 'role_type_id',
            'conditions' => '',
            'fields' => '',
            'order' => ''
        )
    );
}
