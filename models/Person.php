<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%person}}".
 *
 * @property string $id
 * @property integer $live
 * @property string $last_name
 * @property string $first_name
 * @property string $middle_name
 * @property string $alias_name
 * @property integer $birth_month
 * @property integer $birth_day
 * @property integer $birth_year
 * @property string $note
 * @property integer $user_id_created
 * @property string $date_created
 * @property string $date_updated
 * @property string $ip_created
 * @property string $ip_updated
 *
 * @property Address[] $addresses
 * @property EmailAddress[] $emailAddresses
 * @property PhoneNumber[] $phoneNumbers
 * @property Picture[] $pictures
 */
class Person extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%person}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['live', 'birth_month', 'birth_day', 'birth_year', 'user_id_created'], 'integer'],
            [['note'], 'string'],
            [['date_created', 'date_updated'], 'safe'],
 //           [['ip_created'], 'required'],
            [['last_name', 'first_name', 'middle_name', 'alias_name'], 'string', 'max' => 30],
            [['ip_created', 'ip_updated'], 'string', 'max' => 50]
        ];
    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if($this->isNewRecord) {
                $this->ip_created = $_SERVER['REMOTE_ADDR'];
                return true;
            } elseif(!$this->isNewRecord) {
                $this->ip_updated = $_SERVER['REMOTE_ADDR'];
                $this->date_updated = date('Y-m-d H:i:s');
                return true;
            }

        }

        return false;
    }



    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'live' => 'Live',
            'last_name' => 'Last Name',
            'first_name' => 'First Name',
            'middle_name' => 'Middle Name',
            'alias_name' => 'Alias Name',
            'birth_month' => 'Birth Month',
            'birth_day' => 'Birth Day',
            'birth_year' => 'Birth Year',
            'note' => 'Note',
            'user_id_created' => 'User Id Created',
            'date_created' => 'Date Created',
            'date_updated' => 'Date Updated',
            'ip_created' => 'Ip Created',
            'ip_updated' => 'Ip Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     *
     *  Example
    return $this->hasMany(Order::className(), ['customer_id' => 'id'])
    ->where('subtotal > :threshold', [':threshold' => $threshold])
    ->orderBy('id');
     *
     */
   public function getAddresses()
    {
        return $this->hasMany(Address::className(), ['person_id' => 'id'])->andHaving('live = 1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getEmailAddresses()
    {
        return $this->hasMany(EmailAddress::className(), ['person_id' => 'id'])->andHaving('live = 1');
    }

/*
return $this->hasMany(Order::className(), ['customer_id' => 'id'])
->where('subtotal > :threshold', [':threshold' => $threshold])
->orderBy('id');
*/


    public function setPictureLiveToZero($id) {
        $sql = "UPDATE picture SET live = 0 WHERE id = " . $id;
        \Yii::$app->db->createCommand($sql)->execute();
    }


    public function getNamesWithAddress() {
        $sql = "SELECT person.last_name, person.first_name, person.middle_name, person.alias_name,
                address.street, address.city, address.state, address.iso, address.postal_code
                FROM person LEFT OUTER JOIN address
                ON person.id = address.person_id";

      return  \Yii::$app->db->createCommand($sql)->queryAll();
    }



    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoneNumbers()
    {
        return $this->hasMany(PhoneNumber::className(), ['person_id' => 'id'])->andHaving('live = 1');
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPictures()
    {
        return $this->hasMany(Picture::className(), ['person_id' => 'id'])->andHaving('live = 1');
    }


    public function getAvatar()
    {
        return $this->hasOne(Picture::className(), ['person_id' => 'id'])->andHaving('live = 1')->andHaving('avatar = 1');
    }





    /**
     * @return array relational rules.
     */
    public function relations()
    {
        // NOTE: you may need to adjust the relation name and the related
        // class name for the relations automatically generated below.
        return array(
            'addresses' => array(self::HAS_MANY, 'Address', 'person_id', ),
            'emailAddresses' => array(self::HAS_MANY, 'EmailAddress', 'person_id', ),
            'phoneNumbers' => array(self::HAS_MANY, 'PhoneNumber', 'person_id', ),
            'pictures' => array(self::HAS_MANY, 'Picture', 'person_id'),
            'avatar' => array(self::HAS_ONE, 'Picture', 'person_id'),
//            'pictureCount' => array(self::STAT, 'Picture', 'person_id')
        );
    }



    /**
     * return $age in years
     */
    public function getAge($birth_year, $birth_month, $birth_day)
    {
        $birthday = $birth_year . "-" . $birth_month . "-" . $birth_day;
        $age = date_create($birthday)->diff(date_create('today'))->y;
        return $age;
    }



    /**
     * return $yearOptions for DOB on form
     */
    public function getYearOptions()
    {
        $yearMin=(int)date("Y")-120;
        $yearOptions=array();
        $yearOptions[0]='Unknown';

        for($year=(int)date("Y"); $year>$yearMin; $year--)
        {
            $yearOptions[$year]=(string)$year;
        }

        return $yearOptions;
    }


    /**
     * return $dayOptions for DOB on form
     */
    public function getDayOptions()
    {
        $dayOptions=array();
        $dayOptions[0]='Unknown';

        for($day=1; $day<=31; $day++)
        {
            $dayOptions[$day]=(string)$day;
        }

        return $dayOptions;
    }


    /**
     * return $month for DOB on form
     */
    public function getMonthOptions()
    {
        return $month = array(
            0=>'Unknown',
            1=>'January',
            2=>'February',
            3=>'March',
            4=>'April',
            5=>'May',
            6=>'June',
            7=>'July',
            8=>'August',
            9=>'September',
            10=>'October',
            11=>'November',
            12=>'December'
        );
    }



    function getMonthNameByNumber($monthNumber)
    {
        switch($monthNumber)
        {
            case 0:
                $month = " ";
                break;
            case 1:
                $month = "January";
                break;
            case 2:
                $month = "February";
                break;
            case 3:
                $month = "March";
                break;
            case 4:
                $month = "April";
                break;
            case 5:
                $month = "May";
                break;
            case 6:
                $month = "June";
                break;
            case 7:
                $month = "July";
                break;
            case 8:
                $month = "August";
                break;
            case 9:
                $month = "September";
                break;
            case 10:
                $month = "October";
                break;
            case 11:
                $month = "November";
                break;
            case 12:
                $month = "December";
                break;
            default:
                $month = null;
        }
        return $month;
    }

    public function getAddressTypeByNumber($addressTypeNumber)
    {
        switch($addressTypeNumber)
        {
            case 0:
                $addressType = " ";
                break;
            case 1:
                $addressType = "Current Street";
                break;
            case 2:
                $addressType = "Current Mailing";
                break;
            case 3:
                $addressType = "Previous Street";
                break;
            case 4:
                $addressType = "Previous Mailing";
                break;
            case 5:
                $addressType = "Current Crash Pad";
                break;
            case 6:
                $addressType = "Previous Crash Pad";
                break;
            case 7:
                $addressType = "Other";
                break;
            default:
                $month = null;
        }
        return $addressType;
    }







}
