<?php
class Patient extends AppModel {
    public $validate = [
        'national_id' => [
            'required' => true
        ], 'hospital_id' => [
            'required' => true
        ], 'test_date' => [
            'required' => true
        ], 'test_result' => [
            'required' => true
        ], 'state' => [
            'required' => true
        ], 'user_id' => [
            'required' => true
        ]
    ];
    public function getRecordByUserId($user_id) {
        $record = $this->find(
            'all',
            [
                'recursive' => -1,
                'fields' => [
                    'Patient.id',
                    'Patient.user_id',
                    'Patient.test_date'
                ], 'conditions' => ['Patient.user_id' => $user_id]
            ]
        );
        return $record;
    }
    public function getCasesByRegion() {
        $this->virtualFields['count'] = 'COUNT(Patient.user_id)';
        $record = $this->find(
            'list',
            [
                'recursive' => -1,
                'fields' => [
                    'User.city',
                    'count'
                ],
                'joins' => [
                    [
                        'table' => 'users',
                        'alias' => 'User',
                        'type' => 'inner',
                        'conditions' => [
                            'User.id = Patient.user_id'
                        ]
                    ]
                ],
                'conditions' => [
                    'Patient.test_result' => 1
                ],
                'group' => ['User.city'],
                'order' => 'count DESC'
            ]
        );
        return $record;
    }
    public function getDeathsByRegion() {
        $this->virtualFields['count'] = 'COUNT(Patient.user_id)';
        $record = $this->find(
            'list',
            [
                'recursive' => -1,
                'fields' => [
                    'User.city',
                    'count'
                ],
                'joins' => [
                    [
                        'table' => 'users',
                        'alias' => 'User',
                        'type' => 'inner',
                        'conditions' => [
                            'User.id = Patient.user_id'
                        ]
                    ]
                ],
                'conditions' => [
                    'Patient.death_date != ' => null,
                    'Patient.test_result' => 1
                ],
                'group' => ['User.city'],
                'order' => 'count DESC'
            ]
        );
        return $record;
    }
    public function getRecoveredCases() {
        $this->virtualFields['count'] = 'COUNT(Patient.user_id)';
        $this->virtualFields['diff'] = 'DATEDIFF(NOW(), Patient.test_date)';
        $record = $this->find(
            'list',
            [
                'recursive' => -1,
                'fields' => [
                    'User.city',
                    'count'
                ],
                'joins' => [
                    [
                        'table' => 'users',
                        'alias' => 'User',
                        'type' => 'inner',
                        'conditions' => [
                            'User.id = Patient.user_id'
                        ]
                    ]
                ],
                'conditions' => [
                    'diff >=' => 14,
                    'Patient.test_result' => 1,
                    'Patient.death_date' => null
                ],
                'group' => [
                    'User.city'
                ],
                'order' => 'count DESC'
            ]
        );
        return $record;
    }
    public function getActiveCases() {
        $this->virtualFields['count'] = 'COUNT(Patient.user_id)';
        $this->virtualFields['diff'] = 'DATEDIFF(NOW(), Patient.test_date)';
        $record = $this->find(
            'all',
            [
                'recursive' => -1,
                'fields' => [
                    'count'
                ],
                'joins' => [
                    [
                        'table' => 'users',
                        'alias' => 'User',
                        'type' => 'inner',
                        'conditions' => [
                            'User.id = Patient.user_id'
                        ]
                    ]
                ],
                'conditions' => [
                    'diff <' => 14,
                    'Patient.test_result' => 1
                ],
                'order' => 'count DESC'
            ]
        );
        return $record[0]['Patient']['count'];
    }
    public function getNewPositiveCases() {
        $this->virtualFields['count'] = 'COUNT(Patient.user_id)';
        $record = $this->find(
            'all',
            [
                'recursive' => -1,
                'fields' => [
                    'count'
                ],
                'conditions' => [
                    'Patient.test_date' => date("Y-m-d"),
                    'Patient.test_result' => 1
                ],
                'order' => 'count DESC'
            ]
        );
        return $record[0]['Patient']['count'];
    }
    public function getNewDeaths() {
        $this->virtualFields['count'] = 'COUNT(Patient.user_id)';
        $this->virtualFields['diff'] = 'DATEDIFF(NOW(), Patient.test_date)';
        $record = $this->find(
            'all',
            [
                'recursive' => -1,
                'fields' => [
                    'count'
                ],
                'conditions' => [
                    'Patient.death_date' => date("Y-m-d"),
                    'Patient.test_result' => 1,
                    'diff <' => 14
                ],
                'order' => 'count DESC'
            ]
        );
        return $record[0]['Patient']['count'];
    }
    public function getRecoveredCasesToDay() {
        $this->virtualFields['count'] = 'COUNT(Patient.user_id)';
        $this->virtualFields['diff'] = 'DATEDIFF(NOW(), Patient.test_date)';
        $record = $this->find(
            'all',
            [
                'recursive' => -1,
                'fields' => [
                    'count'
                ],
                'conditions' => [
                    'Patient.death_date' => null,
                    'Patient.test_result' => 1,
                    'diff' => 14
                ],
                'order' => 'count DESC'
            ]
        );
        return $record[0]['Patient']['count'];
    }
    public function getPositions() {
        $this->virtualFields['diff'] = 'DATEDIFF(NOW(), Patient.test_date)';
        $record = $this->find(
            'all',
            [
                'recursive' => -1,
                'fields' => [
                    'User.latitude',
                    'User.longitude'
                ],
                'joins' => [
                    [
                        'table' => 'users',
                        'alias' => 'User',
                        'type' => 'inner',
                        'conditions' => [
                            'User.id = Patient.user_id'
                        ]
                    ]
                ],
                'conditions' => [
                    'Patient.death_date' => null,
                    'Patient.test_result' => 1,
                    'diff <=' => 14
                ]
            ]
        );
        return $record;
    }
}
