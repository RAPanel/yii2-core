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
 * @property integer $rating
 * @property string $text
 * @property string $created_at
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
            [['page_id', 'user_id', 'parent_id', 'rating', 'text'], 'required'],
            [['page_id', 'user_id', 'parent_id', 'rating'], 'integer'],
            [['text'], 'string'],
            [['created_at'], 'safe']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rere.model', 'ID'),
            'page_id' => Yii::t('rere.model', 'Page ID'),
            'user_id' => Yii::t('rere.model', 'User ID'),
            'parent_id' => Yii::t('rere.model', 'Parent ID'),
            'rating' => Yii::t('rere.model', 'Rating'),
            'text' => Yii::t('rere.model', 'Text'),
            'created_at' => Yii::t('rere.model', 'Created At'),
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
