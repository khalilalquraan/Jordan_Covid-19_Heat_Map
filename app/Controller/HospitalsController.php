<?php
class HospitalsController extends AppController {

    public function isAuthorized($user = null) {
        return true;
    }
    public function ajax_get_hospitals_id() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $res = $this->Hospital->getNameAndId();
            echo json_encode($res);
        }
    }
}
