<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%country}}".
 *
 * @property string $id
 * @property string $country
 * @property string $iso
 *
 * @property Subdivision[] $subdivisions
 */
class Country extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%country}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['country', 'iso'], 'required'],
            [['country'], 'string', 'max' => 50],
            [['iso'], 'string', 'max' => 2]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'country' => 'Country',
            'iso' => 'Iso',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getSubdivisions()
    {
        return $this->hasMany(Subdivision::className(), ['iso' => 'iso']);
    }
}
