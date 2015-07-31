<?php

namespace rere\core\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%module}}".
 *
 * @property string $id
 * @property string $url
 * @property string $name
 * @property string $created_at
 */
class Module extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%module}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['url', 'name'], 'required'],
            [['created_at', 'settings'], 'safe'],
            [['url'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 64]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rere.model', 'ID'),
            'url' => Yii::t('rere.model', 'Url'),
            'name' => Yii::t('rere.model', 'Name'),
            'created_at' => Yii::t('rere.model', 'Created At'),
        ];
    }

    /**
     * @inheritdoc
     */
    public function getModuleSettings()
    {
        return $this->hasMany(ModuleSettings::className(), ['module_id' => 'id']);
    }

    public function getSettings()
    {
        return ArrayHelper::map($this->moduleSettings, 'url', 'value');
    }

    public function setSettings($data)
    {
        if (!empty($data))
            $this->on(self::EVENT_AFTER_INSERT, function ($event) {
                $module_id = $event->sender->id;
                foreach ($event->data as $url => $value) {
                    $model = new ModuleSettings();
                    $model->setAttributes(compact('module_id', 'url', 'value'), false);
                    $model->save(false);
                }
            }, $data);

        $this->on(self::EVENT_AFTER_UPDATE, function ($event) {
            $module_id = $event->sender->id;
            $transaction = Yii::$app->db->beginTransaction();
            foreach ($event->sender->moduleSettings as $row) {
                if (isset($event->data[$row['url']])) {
                    $row->value = $event->data[$row['url']];
                    $row->save(false, ['value']);
                    unset($event->data[$row['url']]);
                } else
                    $row->delete();
            }

            if (!empty($event->data))
                foreach ($event->data as $url => $value) {
                    $model = new ModuleSettings();
                    $model->setAttributes(compact('module_id', 'url', 'value'), false);
                    $model->save(false);
                }
            $transaction->commit();
        }, $data);
    }

    public static function all()
    {
        return ArrayHelper::map(self::find()->all(), 'id', 'url');
    }
}
