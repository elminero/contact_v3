<?php

namespace app\models;

use Yii;

/**
 * This is the model class for table "{{%picture}}".
 *
 * @property string $id
 * @property string $person_id
 * @property integer $live
 * @property integer $avatar
 * @property string $file_name
 * @property string $caption
 * @property string $copyright
 * @property integer $user_id_created
 * @property string $date_entered
 * @property string $date_updated
 * @property string $ip_created
 * @property string $ip_updated
 *
 * @property Person $person
 */
class Picture extends \yii\db\ActiveRecord
{

    // WHERE TO PUT IMAGES
    const IMAGE_FOLDER = "pictures/";

    // WIDTH OF LARGE IMAGE
    const LARGE_IMAGE_WIDTH = 800;

    // WIDTH OF THUMB NAIL
    const THUMB_NAIL_IMAGE_WIDTH = 175;

    protected $imageLocation;

    public $pathToFile;


    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%picture}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['file_name'], 'required'],
            [['file_name'], 'safe'],
            [['file_name'], 'file', 'extensions' => 'jpg'],
            [['person_id', 'live', 'avatar', 'user_id_created'], 'integer'],
            [['caption', 'copyright'], 'string'],
            [['date_entered', 'date_updated'], 'safe'],
            [['file_name'], 'string', 'max' => 60],
            [['ip_created', 'ip_updated'], 'string', 'max' => 50]
        ];
    }


    public function createImageFolder()
    {
        // Create the folders YY/MM/DD/HH
        $date = explode( "|", date("y|m|d|H") );
        list($y, $m, $d, $h) = $date;
        if(!file_exists(self::IMAGE_FOLDER . $y))
        {
            mkdir(self::IMAGE_FOLDER . $y);
        }
        if(!file_exists(self::IMAGE_FOLDER . $y . "/" . $m))
        {
            mkdir(self::IMAGE_FOLDER . $y . "/" . $m);
        }
        if(!file_exists(self::IMAGE_FOLDER . $y . "/" .  $m . "/" . $d))
        {
            mkdir(self::IMAGE_FOLDER . $y . "/" .  $m . "/" . $d);
        }
        if(!file_exists(self::IMAGE_FOLDER . $y . "/" .  $m . "/" . $d . "/" . $h))
        {
            mkdir(self::IMAGE_FOLDER . $y . "/" .  $m . "/" . $d . "/" . $h);
        }

        $this->imageLocation = $y . "/" .  $m . "/" . $d . "/" . $h . "/";

        return $this->imageLocation;
    }

/*
    public function moveToImageFolderRenameCopy()
    {

       move_uploaded_file($_FILES['Picture']['tmp_name']['file_name'],
                          self::IMAGE_FOLDER . $this->imageLocation . $_FILES["Picture"]["name"]["file_name"]);

        $this->randHex = substr(md5(rand()), 0, 8);

        $fullSize = $this->randHex . ".jpg";

        $thumbSize = $this->randHex . "_t.jpg";

        $this->imageFolderLocationFullSize = self::IMAGE_FOLDER . $this->imageLocation . $fullSize;

        $this->imageFolderLocationThumbSize = self::IMAGE_FOLDER . $this->imageLocation . $thumbSize;

        rename(self::IMAGE_FOLDER . $this->imageLocation . $_FILES["Picture"]["name"]["file_name"] ,  $this->imageFolderLocationFullSize) ;

        copy($this->imageFolderLocationFullSize, $this->imageFolderLocationThumbSize);

        $this->file_name = $this->imageLocation . $this->randHex;

        return $this->imageLocation . $this->randHex;

    }
*/

    public function reduceToFullSize($pathToImageFileFullSize) //     pictures/15/03/12/13/7909df6a.jpg
    {
        //Resize the full size image only if original is more than 800 width
        $imageOriginal = imagecreatefromjpeg($pathToImageFileFullSize);
        $imageOriginalWidth = imagesx($imageOriginal);
        if($imageOriginalWidth > self::LARGE_IMAGE_WIDTH)
        {
            $imageOriginalHeight = imagesy($imageOriginal);

            // Make the width 800px and find the new height
            $displayHeight = intval(self::LARGE_IMAGE_WIDTH * $imageOriginalHeight / $imageOriginalWidth);

            $displayImage = imagecreatetruecolor(self::LARGE_IMAGE_WIDTH, $displayHeight);

            imagecopyresampled($displayImage, $imageOriginal, 0, 0, 0, 0, self::LARGE_IMAGE_WIDTH, $displayHeight,
                $imageOriginalWidth, $imageOriginalHeight);

            imagejpeg($displayImage, $pathToImageFileFullSize);
        }
    }


    public function reduceToSmallSize($pathToImageFileSmallSize)
    {
        $imageOriginal = imagecreatefromjpeg($pathToImageFileSmallSize);
        $imageOriginalWidth = imagesx($imageOriginal);

        $imageOriginalHeight = imagesy($imageOriginal);

        // Make the width and find the new height
        $displayHeight = intval(self::THUMB_NAIL_IMAGE_WIDTH * $imageOriginalHeight / $imageOriginalWidth);

        $displayImage = imagecreatetruecolor(self::THUMB_NAIL_IMAGE_WIDTH, $displayHeight);

        imagecopyresampled($displayImage, $imageOriginal, 0, 0, 0, 0, self::THUMB_NAIL_IMAGE_WIDTH, $displayHeight,
            $imageOriginalWidth, $imageOriginalHeight);

        imagejpeg($displayImage, $pathToImageFileSmallSize);
    }


    public function setAvatarToZeroByPersonId($person_id)
    {

 //       Picture::model()->updateAll(array('avatar'=>0), 'person_id =' . $person_id    );


        \Yii::$app->db->createCommand("UPDATE picture SET avatar=0 WHERE person_id=:person_id")->bindValue(':person_id', $person_id)->execute();


    }


    public function beforeSave($insert)
    {
        if (parent::beforeSave($insert)) {

            if($this->isNewRecord) {
                $this->ip_created = $_SERVER['REMOTE_ADDR'];
                $this->live = 1;

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
            'person_id' => 'Person ID',
            'live' => 'Live',
            'avatar' => 'Avatar',
            'file_name' => 'File Name',
            'caption' => 'Caption',
            'copyright' => 'Copyright',
            'user_id_created' => 'User Id Created',
            'date_entered' => 'Date Entered',
            'date_updated' => 'Date Updated',
            'ip_created' => 'Ip Created',
            'ip_updated' => 'Ip Updated',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPerson()
    {
        return $this->hasOne(Person::className(), ['id' => 'person_id']);
    }


    public function getPersonIdByPictureId ($id)
    {
        $sql = "SELECT person_id FROM picture WHERE id = " . $id;
        $qResult = \Yii::$app->db->createCommand($sql)->queryOne();

        return $qResult['person_id'];
    }


    public function getNextPicture($id)
    {
        $personId = self::getPersonIdByPictureId($id);

        $sql = "SELECT id FROM picture WHERE person_id= " . $personId . " AND id > " . $id . " AND live=1";
        $qResult =\Yii::$app->db->createCommand($sql)->queryOne();

        if($qResult) {
            $next = $qResult['id'];
        } else {
            $sql = "SELECT MIN(id) AS id  FROM picture WHERE person_id =  " . $personId;
            $qResult =\Yii::$app->db->createCommand($sql)->queryOne();
            $next = $qResult['id'];
        }

        return $next;
    }


    public function getPreviousPicture($id)
    {
        $personId = self::getPersonIdByPictureId($id);

        $sql = "SELECT id FROM picture WHERE person_id= " . $personId . " AND id < " . $id . " AND live=1 ORDER BY id DESC";
        $qResult =\Yii::$app->db->createCommand($sql)->queryOne();

        if($qResult) {
            $previous = $qResult['id'];
        } else {
            $sql = "SELECT MAX(id) AS id  FROM picture WHERE person_id =  " . $personId;
            $qResult =\Yii::$app->db->createCommand($sql)->queryOne();
            $previous = $qResult['id'];
        }

        return $previous;
    }


}
