<?php

namespace app\models;

use app\models\traits\SafeDeleteTrait;
use Yii;

/**
 * This is the model class for table "{{%wagon}}".
 *
 * @property string $id
 * @property string $number_wagon
 * @property string $type_id
 * @property string $created_at
 * @property string $img_path
 * @property integer $enabled
 * @property integer $deleted
 * @property string $deleted_at
 */
class Wagon extends \yii\db\ActiveRecord
{
    use SafeDeleteTrait {
        init as traitInit;
        beforeSafeDelete as traitBeforeSafeDelete;
        safeDelete as traitSafeDelete;
        afterSafeDelete as traitAfterSafeDelete;
    }

    public function init()
    {
        parent::init();
        $this->traitInit();
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%wagon}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['number_wagon', 'type_id'], 'required'],
            [['created_at', 'deleted_at'], 'safe'],
            [['enabled'], 'integer', 'message' => 'Необходимо заполнить поле «Доступен»'],
            [['deleted'], 'integer'],
            [['id', 'type_id'], 'integer'],
            [['number_wagon'], 'string', 'min' => 8, 'max' => 8],
            [['img_path'], 'string', 'max' => 255],
            [['id'], 'unique'],
            [['number_wagon'], 'unique'],
            [['number_wagon'], 'integer', 'integerOnly' => true, 'integerPattern' => '/^[1-9]\d*$/', 'message' => 'Значение должно быть числом и не может начинаться с нуля'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'number_wagon' => 'Номер вагона',
            'type_id' => 'Род вагона',
            'created_at' => 'Дата постановки на учет',
            'img_path' => 'Картинка',
            'enabled' => 'Доступен',
            'deleted' => 'Удален',
            'deleted_at' => 'Удален в',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getTypeWagon()
    {
        return $this->hasOne(TypeWagon::className(), ['id' => 'type_id']);
    }

    public function beforeSave($insert)
    {
        $date = new \DateTime();
        $this->created_at = $date->format('Y-m-d H:i:s');
        $this->deleted_at = '0000-00-00 00:00:00';

        return parent::beforeSave($insert);
    }
}
