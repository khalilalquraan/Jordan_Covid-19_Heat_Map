<?php
App::uses('BlowfishPasswordHasher', 'Controller/Component/Auth');
class User extends AppModel {
    public $validate = [
        'username' => [
            'required' => true,
            'message' => 'User name is used',
            'rule' => ['isUnique']
        ],
        'password' => [
            'required' => true,
            'message' => 'Password must be at least 8 characters long',
            'rule' => array('minLength', '8')
        ],
        'first_name' => [
            'required' => true,
            'rule' => 'notBlank'
        ],
        'family_name' => [
            'required' => true,
            'rule' => 'notBlank'
        ],
        'age' => [
            'required' => true,
            'numeric' => [
                'rule' => 'numeric',
                'message' => 'The age must be number'
            ],
            'range' => [
                'rule' => ['range', 10, 150],
                'message' => 'This user must be die'
            ]
        ],
        'national' => [
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
        'email' => [
            'required' => [
                'rule' => ['email'],
                'message' => 'Kindly provide your email for verification.'
            ],
            'maxLength' => [
                'rule' => ['maxLength', 255],
                'message' => 'Email cannot be more than 255 characters.'
            ],
            'unique' => [
                'rule' => 'isUnique',
                'message' => 'Provided Email already exists.'
            ]
        ]

    ];
    public function beforeSave($options = array()) {
        if (isset($this->data['User']['password'])) {
            $passwordHasher = new BlowfishPasswordHasher();
            $this->data['User']['password'] = $passwordHasher->hash(
                $this->data['User']['password']
            );
            return true;
        }

        return false;
    }
    public function getNationalsId() {
        $res = $this->find(
            'list',
            [
                'recursive' => -1,
                'fields' => [
                    'User.national',
                    'User.id'
                ]
            ]
        );
        return $res;
    }
    public function getIdByNationalId($natioal) {
        $res = $this->find('list', [
            'recursive' => -1,
            'fields' => [
                'User.national',
                'User.id'

            ],
            'conditions' => ['User.national' => $natioal]
        ]);
        return $res[$natioal];
    }
    public function getSafeQuestionByNationalId($natioal_id) {
        $res = $this->find(
            'first',
            [
                'recursive' => -1,
                'fields' => [
                    'User.answer_safe_question'
                ],
                'conditions' => ['User.national' => $natioal_id]
            ]
        );
        return $res['User']['answer_safe_question'];
    }
    public function getAllInfo($natioal_id) {
        $res = $this->find(
            'first',
            [
                'recursive' => -1,
                'conditions' => ['User.national' => $natioal_id]
            ]
        );
        return $res;
    }
}
