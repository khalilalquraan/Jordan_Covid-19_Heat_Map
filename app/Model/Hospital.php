<?php
class Hospital extends AppModel
{
    public function getNameAndId()
    {
        $res = $this->find(
            'list',
            [
                'recursive' => -1,
                'fields' => [
                    'Hospital.hospital_id',
                    'Hospital.hospital_name'
                ]

            ]
        );
        return $res;
    }
}
