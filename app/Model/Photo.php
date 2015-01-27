<?php
App::uses('AppModel', 'Model');
class Photo extends AppModel {

    public $belongsTo = array(
        'User'
    );
}
