<?php
class Approve extends AppModel {
    public $validate = [
        'national_id' => [
            'required' => true,
            'isUnique' => [
                'rule' => 'isUnique',
                'message' => 'Provided National already exists.'
            ],
            'numeric' => [
                'rule' => 'numeric',
                'message' => 'The National ID must be numeric'
            ],
            'maxLength' => [
                'rule' => ['maxLength', 10],
                'message' => 'National cannot be more than 10 characters.'
            ],
            'minLength' => [
                'rule' => ['minLength', 10],
                'message' => 'National cannot be less than 10 characters.'
            ],
        ],
    ];

    public function getRecordByUserId($id) {
        $record = $this->find(
            'first',
            [
                'recursive' => -1,
                'fields' => [
                    'Approve.id',
                    'Approve.national_id'
                ], 'conditions' => ['Approve.id' => $id]
            ]
        );
        return $record;
    }
    public function isApprove($national_id) {
        $record = $this->find(
            'first',
            [
                'recursive' => -1,
                'fields' => 'national_id',
                'conditions' => [
                    'national_id' => $national_id
                ]
            ]
        );
        return !empty($record);
    }
}
