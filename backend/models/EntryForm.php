<?php


namespace backend\models;


use yii\base\Model;

class EntryForm extends Model
{

    public $eat;

    public function rules()
    {
        return [
            ['eat', 'required'],
        ];
    }


}