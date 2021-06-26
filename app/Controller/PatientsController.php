<?php

/**
 * Undocumented class
 */
class PatientsController extends AppController {
    public function isAuthorized($user = null) {
        $actions = [
            'add' => 1,
            'delete' => 1,
            'update' => 1
        ];

        if (isset($actions[$this->request->params['action']])) {
            return (bool)($this->Auth->User('role_id') == 3);
        }
        if ($this->request->params['action'] == 'ajax_get_record_by_national_id') {
            return true;
        }
        return false;
    }
    public function add() {
        $this->loadModel('User');
        if ($this->request->is('post')) {
            $this->Patient->create();
            if ($this->Patient->save($this->request->data)) {
                $this->Flash->success(__('The Patient was saved successfully'));
                return $this->redirect([]);
            }
        }
    }
    public function delete($id = null) {
        $this->Patient->id = $id;
        $this->Patient->delete();
    }
    public function ajax_get_record_by_national_id() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            if (isset($this->request->data['user_id'])) {
                $record = $this->Patient->getRecordByUserId($this->request->data['user_id']);
                echo json_encode($record);
            }
        }
    }
    public function update($id = null) {
        if (empty($id)) {
            throw new NotFoundException(__("Ivalid user"));
        } else if (empty($this->request->data)) {
            $user_info = $this->Patient->findById($id);
            // pr($user_info);
            // die;
            $this->request->data = $user_info;
        } else if ($this->Patient->save($this->request->data)) {
            $this->Flash->success(__("The user has been update"));
            return $this->redirect(['action' => 'delete']);
        } else return $this->Flash->error(__('Error'));
    }
    public function fullData() {
        $data['Patient'] = [];
        for ($i = 0; $i < 300; $i++) {
            $d = [null, date("Y-m-d", mt_rand(1, time()))];
            $t = [1, -1];
            $s = ['good', 'mid', 'bad'];
            $data['Patient']['user_id'] = 1126 + $i;
            $data['Patient']['hospital_id'] = $i % 2 + 1;
            $data['Patient']['test_date'] = $d[1];
            $data['Patient']['death_date'] = $d[rand(0, 1)];
            $data['Patient']['state'] = $s[rand(0, 2)];
            $data['Patient']['test_result'] = $t[rand(0, 1)];
            // pr($data);
            // die;
            $this->Patient->create();
            $this->Patient->save($data);
        }
    }
}
