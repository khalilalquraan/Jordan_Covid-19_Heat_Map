<?php
class UsersController extends AppController {
    public $helpers = ['Html', 'Form'];
    public function index() {
    }
    public function isAuthorized($user = null) {
        $actions = [
            'logout' => 1,
            'login' => 1,
            'registrar' => 1,
            'ajax_get_national_id' => 1,
            'reset_password' => 1,
            'ajax_get_info_reset_pass' => 1,
            'generate' => 1
        ];
        if (isset($actions[$this->request->params['action']])) {
            return true;
        }
        return false;
    }
    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(['registrar', 'login', 'reset_password', 'ajax_get_info_reset_pass']);
    }
    public function login() {

        $this->loadModel('Approve');
        if ($this->request->is('post')) {
            if ($this->Auth->login()) {
                $role_id = $_SESSION['Auth']['User']['role_id'];
                if (($role_id == 3 && ($this->Approve->isApprove($_SESSION['Auth']['User']['national']))) || $role_id != 3) {
                    return $this->redirect($this->Auth->redirectUrl());
                } else if ($role_id == 3) {
                    $this->Flash->error("Admin did not accept your request yet");
                    $this->logout();
                }
            }
            $this->Flash->error("Incorrect username or password");
        }
    }
    public function registrar() {
        if ($this->request->is('post')) {
            $this->User->create();
            pr($this->request->data);
            if ($this->User->save($this->request->data)) {
                if ($this->request->data['User']['role_id'] == 1) {
                    $this->Flash->error('You have registered successfully, you can login now');
                } else {
                    $this->Flash->error('You have registered successfully, wait until your request approved by the admin');
                }
                return $this->redirect(['action' => 'login']);
            }
        }
    }
    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
    public function ajax_get_national_id() {

        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $res = $this->User->getNationalsId();
            echo json_encode($res);
        }
    }
    public function fullData() {
        $cities = ["Amman", "Zarqa", "Irbid", "Ajloun", "Jerash", "Mafraq", "Balqa", "Madaba", "Karak", "Tafilah", "Maan", "Aqaba"];
        $data['User'] = [];
        $national = 1000000000;
        $latitude = 32.0701333;
        $longitude = 36.092329299999996;
        for ($i = 0; $i < 1000; $i++) {
            $data['User']['username'] = 'testUser' . $i;
            $data['User']['password'] = '123456789';
            $data['User']['first_name'] = 'firstName' . $i;
            $data['User']['family_name'] = 'familyName' . $i;
            $data['User']['age'] = rand(16, 75);
            $data['User']['national'] = $national++;
            $data['User']['email'] = 'khalilalquraansoso' . $i . '@gmail.com';
            $data['User']['latitude'] = $latitude += 0.0001 * rand(-10, 10);
            $data['User']['longitude'] = $longitude += 0.0001 * rand(-8, 8);
            $data['User']['city'] = $cities[rand(0, 11)];
            $data['User']['neighbourhood'] = 'al andalos';
            $data['User']['postcode'] = 13111;
            $data['User']['suburb'] = 'Hay Al-Nozha';
            $data['User']['role_id'] = rand(1, 2);
            $this->User->create();
            $this->User->save($data);
        }
    }
    public function reset_password() {
        if ($this->request->is('post')) {
            $AQ = $this->User->getSafeQuestionByNationalId($this->request->data['User']['national_id']);
            if ($this->request->data['User']['Question Answer'] == trim($AQ)) {
                $res = $this->User->getAllInfo($this->request->data['User']['national_id']);
                $res['User']['username'] = $this->request->data['User']['username'];
                $res['User']['password'] = $this->request->data['User']['password'];
                if ($this->User->save($res)) {
                    $this->Flash->success("update successflly");
                    $this->redirect(['action' => 'login']);
                } else {

                    $this->Flash->success("something wrong");
                }
            } else {
                $this->Flash->success("The Answer does not match");
            }
        }
    }
    public function ajax_get_info_reset_pass() {
        $this->autoRender = false;
        if ($this->request->is('ajax')) {
            $res =  $this->User->find(
                'first',
                [
                    'recursive' => -1,
                    'fields' => [
                        'safe_question'
                    ],
                    'conditions' => [
                        'national' => $this->request->data['national_id']
                    ]
                ]
            );
            if (empty($res)) {
                $res['User']['safe_question'] = -1;
            }
            echo json_encode($res);
        }
    }
    public function generate() {
        for ($latitude = 33.075375; $latitude <= 33.449777; $latitude += 1) {
            for ($longitude = 35.840163; $longitude <= 39.347565; $longitude += 1) {
                sleep(0.5);
                $api_url = 'https://us1.locationiq.com/v1/reverse.php?key=pk.b32be3a84123bc3b222188c259454689&lat='
                    . $latitude . "&lon=" . $longitude . "&format=json";
                $json_data = file_get_contents($api_url);
                $response_data = json_decode($json_data, true);
                pr($response_data);
                die;
                if (!isset($response_data['address']['country']) || $response_data['address']['country'] != 'Jordan') {
                    continue;
                }
                $i = 2;
                $national_id = 10000000000;
                $data['User'] = [
                    'username' => 'test' . $i,
                    'password' => '123456789',
                    'first_name' => 'first_test' . $i,
                    'family_name' => 'family_test' . $i,
                    'age' => rand(15, 45),
                    'national' => $national_id++,
                    'email' => 'test' . $i . '@gmail.com',
                    'latitude' => $latitude,
                    'longitude' => $longitude,
                    'city' => isset($response_data['address']['city']) ? $response_data['address']['city'] : $response_data['address']['state'],
                    'neighbourhood' => isset($response_data['address']['neighbourhood']) ? $response_data['address']['neighbourhood'] : "null",
                    'postcode' => isset($response_data['address']['postcode']) ? $response_data['address']['postcode'] : "0000",
                    'suburb' => isset($response_data['address']['suburb']) ? $response_data['address']['suburb'] : "null",
                    'role_id' => 1,
                    'safe_question' => 0,
                    'answer_safe_question' => 'answer'
                ];
                // pr($response_data);
                // die;
                $this->User->save($data);
                $i++;
            }
        }
    }
}
