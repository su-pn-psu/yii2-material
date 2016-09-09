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
 * @property string $bought_at
 * @property string $warrant_at
 * @property integer $created_at
 * @property integer $created_by
 * @property integer $updated_at
 * @property integer $updated_by
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

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['id', 'title'], 'required'],
            [['status', 'created_at', 'created_by', 'updated_at', 'updated_by'], 'integer'],
            [['bought_at', 'warrant_at'], 'safe'],
            [['id'], 'string', 'max' => 30],
            [['title'], 'string', 'max' => 255],
            [['brand'], 'string', 'max' => 100]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'รหัสครุภัณฑ์'),
            'title' => Yii::t('app', 'ครุภัณฑ์'),
            'brand' => Yii::t('app', 'ยี่ห้อ'),
            'status' => Yii::t('app', 'สถานะ'),
            'bought_at' => Yii::t('app', 'วันที่ซื้อ'),
            'warrant_at' => Yii::t('app', 'วันที่หมดประกัน'),
            'created_at' => Yii::t('app', 'สร้างเมื่อ'),
            'created_by' => Yii::t('app', 'สร้างโดย'),
            'updated_at' => Yii::t('app', 'ปรับปรุงเมื่อ'),
            'updated_by' => Yii::t('app', 'แก้ไขโดย'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getRepairs()
    {
        return $this->hasMany(Repair::className(), ['material_id' => 'id']);
    }
}
