<?php
App::uses('AppHelper', 'View/Helper');

class UserHelper extends AppHelper {
    public function isStudent($id) {
        App::import("Model", "UserRoleStudio");
        $model = new UserRoleStudio();
        $userRolesCount = $model->find("count", array('conditions'=>array('user_id'=>$id)));
        if ($userRolesCount >= 1) {
            return true;
        }
        return false;
    }

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
        if (!isset($studioRole['UserRoleStudio'])) return false;
        return ($studioRole['UserRoleStudio']['role_id'] <= 5 && $studioRole['UserRoleStudio']['role_id'] >= 3);
    }

    public function isInstructor($id) {
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

    private function isInstructorForStudioRole($studioRole) {
        return ($studioRole['UserRoleStudio']['role_id'] <= 5 && $studioRole['UserRoleStudio']['role_id'] != 2);
    }

    public function isAdmin($id) {
        App::import("Model", "UserRoleStudio");
        $model = new UserRoleStudio();
        $userRoleStudios = $model->find("all", array('conditions'=>array('user_id'=>$id)));
        if (count($userRoleStudios) > 1) {
            foreach ($userRoleStudios as $userRole) {
                if ($this->isAdminForStudioRole($userRole)) return true;
            }
        }
        else if (count($userRoleStudios) > 0) {
            return $this->isAdminForStudioRole($userRoleStudios);
        }
        return false;
    }

    private function isAdminForStudioRole($studioRole) {
        return ($studioRole['UserRoleStudio']['role_id'] == 5);
    }
}