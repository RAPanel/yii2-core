<?php

namespace rere\core\models;

use rere\core\RA;
use Yii;
use yii\behaviors\AttributeBehavior;
use yii\behaviors\BlameableBehavior;
use yii\behaviors\SluggableBehavior;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\Inflector;
use yii\helpers\Url;

Inflector::$transliterator = 'Russian-Latin/BGN; NFKD';

/**
 * This is the model class for table "{{%page}}".
 *
 * @property string $id
 * @property integer $status_id
 * @property integer $with_child
 * @property string $sort_id
 * @property string $parent_id
 * @property string $module_id
 * @property integer $user_id
 * @property string $url
 * @property string $name
 * @property string $about
 * @property string $updated_at
 * @property string $created_at
 *
 * @property Page $parent
 * @property Page[] $pages
 * @property User $user
 * @property PageCharacters[] $characters
 * @property PageComments[] $comments
 * @property PageData $data
 * @property Photo[] $photos
 */
class Page extends \yii\db\ActiveRecord
{
    public $pagesCount;

    public function getHref($normalizeUrl = true, $scheme = false)
    {
        if (strpos($this->url, '/') !== false) return $this->url;
        $module = RA::module($this->module_id);
        $action = 'show';
        $additional = [];
        if ($module == 'category') {
            $action = 'index';
            $url = Page::find()->where(['id' => $this->parents])->andWhere('url!="/"')->orderBy('id')->select('url')->scalar();
            if ($url) $module = $url;
        } elseif ($this->parent && $this->parent->module_id = RA::module('category')) {
            if (strpos($this->parent->url, '/') !== false)
                return str_replace('//', '/', $this->parent->url . '/' . $this->url);
            if ($module != $this->parent->url) $additional['category'] = $this->parent->url;

            $action = 'show';
        }
        if (RA::module($this->url)) $url = ["/{$this->url}/index"];
        else $url = ["/{$module}/{$action}", 'url' => $this->url] + $additional;
        return $normalizeUrl ? Url::to($url, $scheme) : $url;
    }

    public function getDate($name = 'create_at')
    {
        return Yii::$app->formatter->asDatetime($this->{$name}, isset(Yii::$app->params['dateFormat']) ? Yii::$app->params['dateFormat'] : null);
    }

    public function getContent()
    {
        return $this->data->content;
    }

    /**
     * @inheritdoc
     */
    public function behaviors()
    {
        return [
            'timestamp' => [
                'class' => TimestampBehavior::className(),
                'value' => new Expression('NOW()'),
            ],
            'sluggable' => [
                'class' => SluggableBehavior::className(),
                'attribute' => 'name',
                'slugAttribute' => 'url',
                'immutable' => true,
                'ensureUnique' => true,
            ],
            'blameable' => [
                'class' => BlameableBehavior::className(),
                'createdByAttribute' => 'user_id',
                'updatedByAttribute' => false,
            ],
            'sortable' => [
                'class' => AttributeBehavior::className(),
                'attributes' => [self::EVENT_AFTER_INSERT => 'sort_id'],
                'value' => function ($event) {
                    $event->sender->sort_id = $event->sender->id - $event->sender->parent_id;
                    $event->sender->update(false, ['sort_id']);
                },
            ],
        ];
    }

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            ['url', 'match', 'pattern' => '/^[a-zA-Z0-9-.\/]+$/'],
            [['status_id', 'with_child', 'sort_id', 'parent_id', 'module_id'], 'integer'],
            [['url', 'name', 'about'], 'string', 'max' => 255],
            [['created_at'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rere.model', 'ID'),
            'status_id' => Yii::t('rere.model', 'Status ID'),
            'with_child' => Yii::t('rere.model', 'With Child'),
            'sort_id' => Yii::t('rere.model', 'Sort ID'),
            'parent_id' => Yii::t('rere.model', 'Parent ID'),
            'module_id' => Yii::t('rere.model', 'Module ID'),
            'user_id' => Yii::t('rere.model', 'User ID'),
            'url' => Yii::t('rere.model', 'Url'),
            'name' => Yii::t('rere.model', 'Name'),
            'about' => Yii::t('rere.model', 'About'),
            'updated_at' => Yii::t('rere.model', 'Updated At'),
            'created_at' => Yii::t('rere.model', 'Created At'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getParent()
    {
        return $this->hasOne(Page::className(), ['id' => 'parent_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPages()
    {
        return $this->hasMany(Page::className(), ['parent_id' => 'id']);
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
    public function getPhotos()
    {
        // @todo Доделать подключение через бехавиор
        return $this->hasMany(Photo::className(), ['owner_id' => 'id'])/*->andOnCondition(['model'=>0])*/
            ;
    }

    /**
     * @inheritdoc
     */
    public function getCharacters()
    {
        return $this->hasMany(PageCharacters::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getComments()
    {
        return $this->hasMany(PageComments::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getData()
    {
        return $this->hasOne(PageData::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPhoto()
    {
        return $this->hasOne(Photo::className(), ['owner_id' => 'id'])->andOnCondition([Photo::tableName() . '.type' => 'main']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCounts()
    {
        return $this->hasOne(PageCounts::className(), ['page_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getViewsCount()
    {
        return $this->hasMany(PageSessionData::className(), ['page_id' => 'id'])->where(['type' => 'view'])->count();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getLikesCount()
    {
        return $this->hasMany(PageSessionData::className(), ['page_id' => 'id'])->where(['type' => 'like'])->count();
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCommentsCount()
    {
        return $this->hasMany(PageComments::className(), ['page_id' => 'id'])->count();
    }
}
