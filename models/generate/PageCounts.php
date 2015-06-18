<?php

namespace app\rere\core\models\generate;

use Yii;

/**
 * This is the model class for table "ra_page_counts".
 *
 * @property string $page_id
 * @property string $views
 * @property string $likes
 * @property string $comments
 */
class PageCounts extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return 'ra_page_counts';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'views', 'likes', 'comments'], 'required'],
            [['page_id', 'views', 'likes', 'comments'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => Yii::t('rere', 'Page ID'),
            'views' => Yii::t('rere', 'Views'),
            'likes' => Yii::t('rere', 'Likes'),
            'comments' => Yii::t('rere', 'Comments'),
        ];
    }
}
