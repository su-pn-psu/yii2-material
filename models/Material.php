<?php

namespace suPnPsu\material\models;

use Yii;

/**
 * This is the model class for table "material".
 *
 * @property string $id
 * @property string $title
 * @property string $brand
 * @property integer $status
 * @property integer $available
 * @property string $bought_at
 * @property string $warrant_at
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
 * @property string $image
 * @property string $material_type_id
 *
 * @property Repair[] $repairs
 */
class Material extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'material';
    }

    public $file;
    public $filepath;
    public $availlist = ['0'=>'no','1'=>'yes'];
    public $statlist = ['0'=>'damaged','1'=>'ready'];
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title'], 'required'],
            [['status', 'available', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['bought_at', 'warrant_at'], 'safe'],
            [['id'], 'string', 'max' => 30],
            [['title', 'image', 'brand'], 'string', 'max' => 255],
            [['file'], 'file', 'skipOnEmpty' => true, 'extensions' => 'png, jpg'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'รหัสครุภัณฑ์'),
            'title' => Yii::t('app', 'ชื่อครุภัณฑ์'),
            'brand' => Yii::t('app', 'รายละเอียด'),
            'status' => Yii::t('app', 'สถานะ'),
            'bought_at' => Yii::t('app', 'วันที่ซื้อ'),
            'warrant_at' => Yii::t('app', 'วันที่หมดประกัน'),
            'created_at' => Yii::t('app', 'สร้างเมื่อ'),
            'created_by' => Yii::t('app', 'สร้างโดย'),
            'updated_at' => Yii::t('app', 'ปรับปรุงเมื่อ'),
            'updated_by' => Yii::t('app', 'แก้ไขโดย'),
            'image' => 'รูปภาพ',
            'available' => 'พร้อมยืม',
        ];
    }

    public function upload()
    {
        $defaultImageWidth = 1024;

        if ($this->validate(['file'])) {
            $targetPath = Yii::getAlias('@uploads/material_files/');
            $this->filepath = $targetPath .time().'_'. $this->file->baseName . '.' . $this->file->extension;
            //echo $this->filepath;exit;
            $this->file->saveAs($this->filepath);
            return true;
        } else {
            return false;
        }
    }
    /**
     * @return \yii\db\ActiveQuery
     */

    public function getBookingmaterials()
    {
        return $this->hasMany(Bookingmaterial::className(), ['material_id' => 'id']);
    }

    public function getRepairs()
    {
        return $this->hasMany(Repair::className(), ['material_id' => 'id']);
    }
}
