<?php
App::uses('AppHelper', 'View/Helper');

class UserHelper extends AppHelper {
    public function isManager($id) {
        App::import("Model", "UserRoleStudio");
        $model = new UserRoleStudio();
        $userRoleStudios = $model->find("all", array('conditions'=>array('user_id'=>$id)));
        if (count($userRoleStudios) >= 1) {
            foreach ($userRoleStudios as $userRole) {
                if ($this->isManagerForStudioRole($userRole)) return true;
            }
        }
        else {
            return $this->isManagerForStudioRole($userRoleStudios);
        }
        return false;
    }

    private function isManagerForStudioRole($studioRole) {
        return ($studioRole['UserRoleStudio']['role_id'] <= 5);
    }
}