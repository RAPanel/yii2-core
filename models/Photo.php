<?php

namespace rere\core\models;

use rere\core\defaultModels\User;
use Yii;
use yii\base\Exception;
use yii\helpers\FileHelper;
use yii\helpers\Url;

/**
 * This is the model class for table "{{%photo}}".
 *
 * @property string $id
 * @property string $sort_id
 * @property string $page_id
 * @property integer $user_id
 * @property string $type
 * @property string $name
 * @property string $width
 * @property string $height
 * @property string $about
 * @property string $cropParams
 * @property string $hash
 * @property string $lastmod
 * @property string $created
 *
 * @property Page $page
 * @property User $user
 */
class Photo extends \yii\db\ActiveRecord
{
    public static $path = '/image/tmp';
    public $file;

    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%photo}}';
    }

    public static function add($name, $params)
    {
        $defaultParams = [
            'type' => 'main',
        ];
        $params['name'] = $name;
        $model = new self;
        $model->setAttributes(array_merge($defaultParams, $params));
        return $model->save();
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['name'], 'required'],
            [['sort_id', 'page_id', 'user_id', 'width', 'height'], 'integer'],
            [['lastmod', 'created'], 'safe'],
            [['type'], 'string', 'max' => 16],
            [['name'], 'string', 'max' => 64],
            [['about', 'cropParams'], 'string', 'max' => 255],
            [['hash'], 'string', 'max' => 32],
            [['about'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('rere', 'ID'),
            'sort_id' => Yii::t('rere', 'Sort ID'),
            'page_id' => Yii::t('rere', 'Page ID'),
            'user_id' => Yii::t('rere', 'User ID'),
            'type' => Yii::t('rere', 'Type'),
            'name' => Yii::t('rere', 'Name'),
            'width' => Yii::t('rere', 'Width'),
            'height' => Yii::t('rere', 'Height'),
            'about' => Yii::t('rere', 'About'),
            'cropParams' => Yii::t('rere', 'Crop Params'),
            'hash' => Yii::t('rere', 'Hash'),
            'lastmod' => Yii::t('rere', 'Lastmod'),
            'created' => Yii::t('rere', 'Created'),
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
    public function getUser()
    {
        return $this->hasOne(User::className(), ['id' => 'user_id']);
    }

    public function beforeSave($insert)
    {
        if ($insert && ($file = $this->getFile(true))) {
            if (file_exists($file)) {
                list($this->width, $this->height) = getimagesize($file);
                $this->hash = md5_file($file);
            } else throw new Exception('File not found in tmp dir ' . $file);
            if (isset(Yii::$app->user) && Yii::$app->user->id)
                $this->user_id = Yii::$app->user->id;
        }

        return parent::beforeSave($insert);
    }

    public function getFile($global = false)
    {
        return $this->name ? Yii::getAlias(($global ? '@webroot' : '') . self::$path . DIRECTORY_SEPARATOR . $this->name) : null;
    }

    public function getHref($type, $scheme = false)
    {
        return Url::to(['/image/index', 'type' => $type, 'name' => $this->name], $scheme);
    }

    public function beforeDelete()
    {
        if ($fileName = $this->name)
            FileHelper::findFiles(Yii::getAlias('@webroot/image'), ['filter' => function ($file) use ($fileName) {
                if (basename($file) == $fileName) unlink($file);
                return is_dir($file);
            }, 'recursive' => true]);

        return parent::beforeDelete();
    }
}
