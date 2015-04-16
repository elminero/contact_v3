<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%subdivision}}".
 *
 * @property string $id
 * @property string $iso
 * @property string $subdivision
 *
 * @property Country $iso0
 */
class Subdivision extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%subdivision}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['iso', 'subdivision'], 'required'],
            [['iso'], 'string', 'max' => 2],
            [['subdivision'], 'string', 'max' => 50]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'iso' => 'Iso',
            'subdivision' => 'Subdivision',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getIso0()
    {
        return $this->hasOne(Country::className(), ['iso' => 'iso']);
    }
}
