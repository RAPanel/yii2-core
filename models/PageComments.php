<?php

namespace rere\core\models;

use app\models\User;
use rere\core\helpers\Text;
use Yii;

/**
 * This is the model class for table "{{%page_comments}}".
 *
 * @property string $id
 * @property string $page_id
 * @property integer $user_id
 * @property string $parent_id
 * @property string $text
 * @property string $created
 *
 * @property Page $page
 * @property User $user
 */
class PageComments extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_comments}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['user_id'], 'default', 'value' => Yii::$app->user->id],
            [['parent_id'], 'default', 'value' => 0],
            [['page_id', 'user_id', 'parent_id'], 'required'],
            [['page_id', 'user_id', 'parent_id'], 'integer'],
            [['text'], 'string'],
            [['created'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => 'ID',
            'page_id' => 'Page ID',
            'user_id' => 'User ID',
            'parent_id' => 'Parent ID',
            'text' => 'Text',
            'created' => 'Created',
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(self::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => 'yii\behaviors\TimestampBehavior',
                'value' => function () {
                    return date("Y-m-d H:i:s");
                },
                'createdAtAttribute' => 'created',
                'updatedAtAttribute' => false,
            ],
        ];
    }

    public function getDate()
    {
        $created = strtotime($this->created);
        $time = date('H:i', $created);
        $date = date('d.m.Y', $created);
        if (time() - $created < 60 * 60) return Text::numeric(ceil((time() - $created) / 60), [
            '%d минуту назад',
            '%d минуты назад',
            '%d минут назад',
        ]);
        else if ($date == date('d.m.Y')) return 'сегодня в ' . $time;
        elseif ($date == date('d.m.Y', strtotime('-1 day'))) return 'вчера в ' . $time;
        return Yii::$app->formatter->asDatetime($this->created, Yii::$app->params['dateFormat']);
    }

    public function getHref($scheme = false)
    {
        return $this->page->getHref(true, $scheme) . '?comments#comment' . $this->id;
    }
}
