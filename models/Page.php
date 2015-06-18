<?php

namespace rere\core\models;

use app\components\YandexTranslate;
use app\models\User;
use rere\core\defaultModels\PageCounts;
use rere\core\defaultModels\PageSessionData;
use rere\core\RA;
use rere\core\ReRe;
use Yii;
use yii\behaviors\TimestampBehavior;
use yii\db\Expression;
use yii\helpers\Url;

/**
 * @inheritdoc
 */
class Page extends \rere\core\defaultModels\Page
{
    public $pagesCount;

    public function getActive()
    {
        return $this->getHref() == \Yii::$app->request->pathInfo;
    }

    public function getHref($normalizeUrl = true, $scheme = false)
    {
        if (strpos($this->url, '/') !== false) return $this->url;
        $module = ReRe::module($this->module_id);
        $action = 'show';
        $additional = [];
        if ($module == 'category') {
            $action = 'index';
            $url = Page::find()->where(['id' => $this->parents])->andWhere('url!="/"')->orderBy('id')->select('url')->scalar();
            if ($url) $module = $url;
        } elseif ($this->parent && $this->parent->module_id = ReRe::module('category')) {
            if (strpos($this->parent->url, '/') !== false)
                return str_replace('//', '/', $this->parent->url . '/' . $this->url);
            if ($module != $this->parent->url) $additional['category'] = $this->parent->url;

            $action = 'show';
        }
        if (ReRe::module($this->url)) $url = ["/{$this->url}/index"];
        else $url = ["/{$module}/{$action}", 'url' => $this->url] + $additional;
        return $normalizeUrl ? Url::to($url, $scheme) : $url;
    }

    public function getLabel()
    {
        return $this->name;
    }

    public function getDate($name = 'create_at')
    {
        return Yii::$app->formatter->asDatetime($this->{$name}, isset(Yii::$app->params['dateFormat']) ? Yii::$app->params['dateFormat'] : null);
    }

    /**
     * @inheritdoc
     */
    public function init()
    {
        parent::init();
        $this->on(self::EVENT_BEFORE_INSERT, function ($event) {
            if (empty($event->sender->user_id))
                $event->sender->user_id = Yii::$app->user->id;

            if (empty($event->sender->url) && $event->sender->name)
                $event->sender->url = RA::purifyUrl(YandexTranslate::translate($event->sender->name, 'en'));
        });

        $this->on(self::EVENT_BEFORE_UPDATE, function ($event) {
            if (empty($event->sender->url) && $event->sender->name)
                $event->sender->url = RA::purifyUrl(YandexTranslate::translate($event->sender->name, 'en'));
            elseif (!empty($event->sender->oldAttributes['url']) && $event->sender->url != $event->sender->oldAttributes['url'])
                $event->sender->url = $event->sender->purify($event->sender->url);
        });

        $this->on(self::EVENT_AFTER_INSERT, function ($event) {
            if (empty($event->sender->sort_id) && $event->sender->id) {
                $event->sender->sort_id = $event->sender->id - $event->sender->parent_id;
                $event->sender->update(false, ['sort_id']);
            }
        });
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
        ];
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['sort_id', 'parent_id', 'module_id'], 'integer'],
            [['with_child', 'status_id', 'created_at'], 'safe'],
            [['url', 'name', 'about'], 'string', 'max' => 255],
        ];
    }

    /**
     * @inheritdoc
     */
    public function getParent()
    {
        return $this->hasOne(Page::className(), ['id' => 'parent_id']);
    }

    /**
     * @inheritdoc
     */
    public function getPhotos()
    {
        return $this->hasMany(Photo::className(), ['page_id' => 'id']);
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
        return $this->hasOne(Photo::className(), ['page_id' => 'id'])->where([Photo::tableName() . '.type' => 'main']);
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

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }
}
