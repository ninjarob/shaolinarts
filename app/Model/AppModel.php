<?php
/**
 * Application model for CakePHP.
 *
 * This file is application-wide model file. You can put all
 * application-wide model-related methods here.
 *
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @package       app.Model
 * @since         CakePHP(tm) v 0.2.9
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */

App::uses('Model', 'Model');

/**
 * Application model for Cake.
 *
 * Add your application-wide methods in the class below, your models
 * will inherit them.
 *
 * @package       app.Model
 */
class AppModel extends Model {

    /**
     * Checks to see if multiple values exist in the same row in the database,
     * this is used when we have multiple fields making up the unique
     * contraint in MySQL
     *
     *    @param array $params    Array consisting of "field" => "value"
     *    @param int $id            PK of record being editited (optional)
    */
    function isUnique($params, $id="")
    {
        if (!is_array($params)) {
            trigger_error(__METHOD__ . ' - $params must be an array', E_USER_ERROR);
        }

        // @var array $query    Array to $this->hasAny() against
        $query = array();

        // Set Recursive Seach mode.
        $this->recursive = -1;

        // Loop array of params building our our query array.
        foreach ($params as $field => $value)
        {
            $query[$this->name . '.' . $field] = $value;
        }

        // Check to see if we need to query against an id
        if (empty($id))
            $fields[$this->name.'.id'] = "!= NULL";
        else
            $fields[$this->name.'.id'] = "!= {$id}";

        // Run the query.
        if ($this->hasAny($query)) {
            // $this->invalidate('unique_'.$field);
            return false;
        }
        else
            return true;
    }

}
