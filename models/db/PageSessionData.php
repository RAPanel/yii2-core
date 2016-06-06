<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%page_session_data}}".
 *
 * @property integer $page_id
 * @property string $session_id
 * @property string $type
 * @property string $value
 * @property string $last_visit
 *
 * @property Page $page
 */
class PageSessionData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_session_data}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'session_id', 'type'], 'required'],
            [['page_id'], 'integer'],
            [['last_visit'], 'safe'],
            [['session_id'], 'string', 'max' => 40],
            [['type', 'value'], 'string', 'max' => 16]
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => Yii::t('app', 'Page ID'),
            'session_id' => Yii::t('app', 'Session ID'),
            'type' => Yii::t('app', 'Type'),
            'value' => Yii::t('app', 'Value'),
            'last_visit' => Yii::t('app', 'Last Visit'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }
}
