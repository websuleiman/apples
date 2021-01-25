<?php

namespace backend\models;

class Apple extends \yii\db\ActiveRecord
{
    public static function tableName()
    {
        return 'apple';
    }

    public function drop($id)
    {
        if($this->status === 0) {
            $this->status = 1;
        }
    }

}