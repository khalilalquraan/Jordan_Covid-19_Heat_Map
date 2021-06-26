<?php
class HomeController extends AppController {

    public function beforeFilter() {
        parent::beforeFilter();
        $this->Auth->allow(['aboutus']);
    }
    public function isAuthorized($user = null) {

        if ($this->request->params['action'] == 'aboutus' || $this->request->params['action'] == 'generate') {
            return true;
        }
        if ($this->request->params['action'] == 'index' || $this->request->params['action'] == 'profile') {
            return true;
        }
        if ($this->request->params['action'] == 'admin') {
            return (bool)($this->Auth->User('role_id') == 2);
        }
        if ($this->request->params['action'] == 'heathcare') {
            return (bool)($this->Auth->User('role_id') == 3);
        }
        return false;
    }
    public function index() {
        $data = [];
        $this->loadModel('Patient');
        $data['casesByRegion'] = $this->Patient->getCasesByRegion();
        $data['totalCases'] = array_sum($data['casesByRegion']);
        $data['deathsByRegion'] = $this->Patient->getDeathsByRegion();
        $data['totalDeath'] = array_sum($data['deathsByRegion']);
        $data['recoveredCases'] = $this->Patient->getRecoveredCases();
        $data['totalRecovered'] = array_sum($data['recoveredCases']);
        $data['totalActivitycases'] = $this->Patient->getActiveCases();
        $data['newPositiveCases'] = $this->Patient->getNewPositiveCases();
        $data['newDeaths'] = $this->Patient->getNewDeaths();
        $data['recoveredCasesToDay'] = $this->Patient->getRecoveredCasesToDay();
        $data['daliyPositiveCases'] = $data['newDeaths'] != 0 ? $data['newDeaths'] / $data['newPositiveCases'] : 0;
        $data['position'] = $this->Patient->getPositions();
        // foreach ($data['position'] as $key => $val) {
        //     pr($val['User']['latitude']);
        // }
        // pr($data);
        // die;
        $this->set(compact('data'));
    }
    public function Admin() {
    }
    public function logout() {
        return $this->redirect($this->Auth->logout());
    }
    public function profile() {
    }
    public function aboutus() {
    }
    public function generate() {
        $lat = "32.0752725";
        $lng = "36.1052004";
        $api_url = 'https://us1.locationiq.com/v1/reverse.php?key=pk.b32be3a84123bc3b222188c259454689&lat='
            . $lat . "&lon=" . $lng . "&format=json";
        $json_data = file_get_contents($api_url);
        $response_data = json_decode($json_data, true);
        pr($response_data['address']);
    }
}
