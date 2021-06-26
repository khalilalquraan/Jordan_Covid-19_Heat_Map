<?php
class ApprovesController extends AppController {
    public function isAuthorized($user = null) {
        if ($this->request->params['action'] == 'add' || $this->request->params['action'] == 'delete') {
            return (bool)($this->Auth->User('role_id') == 2);
        }
        if ($this->request->params['action'] == 'ajax_get_national_id' || $this->request->params['action'] == 'ajax_get_record_by_national_id') {
            return true;
        }
        return false;
    }
    public function add() {

        if ($this->request->is('post')) {
            $this->Approve->create();
            if ($this->Approve->save($this->request->data)) {
                $_SESSION['Auth']['admin'] = 1;
            }
        }
    }
    public function ajax_get_national_id() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $national_ids = $this->Approve->find(
                'list',
                [
                    'fields' => [
                        'Approve.id',
                        'Approve.national_id'
                    ]
                ]
            );

            echo json_encode($national_ids);
        }
    }
    public function ajax_get_record_by_national_id() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            if (isset($this->request->data['user_id'])) {
                $record = $this->Approve->getRecordByUserId($this->request->data['user_id']);
                echo json_encode($record);
            }
        }
    }
    public function delete($id = null) {
        $this->Approve->id = $id;
        $this->Approve->delete();
        $this->redirect(['action' => 'add']);
    }
}
