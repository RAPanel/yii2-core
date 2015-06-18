<?php

namespace rere\core\models;

use rere\core\defaultModels\Replaces;
use Yii;

/**
 * This is the model class for table "{{%page_data}}".
 *
 * @property string $page_id
 * @property string $title
 * @property string $description
 * @property string $keywords
 * @property string $content
 * @property string $tags
 *
 * @property Page $page
 */
class PageData extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_data}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id'], 'required'],
            [['page_id'], 'integer'],
            [['content', 'tags'], 'string'],
            [['title', 'description', 'keywords'], 'string', 'max' => 255],
            [['page_id', 'title', 'description', 'keywords', 'content', 'tags'], 'safe'],
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'page_id' => Yii::t('rere', 'Page ID'),
            'title' => Yii::t('rere', 'Title'),
            'description' => Yii::t('rere', 'Description'),
            'keywords' => Yii::t('rere', 'Keywords'),
            'content' => Yii::t('rere', 'Content'),
            'tags' => Yii::t('rere', 'Tags'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPage()
    {
        return $this->hasOne(Page::className(), ['id' => 'page_id']);
    }

    public function beforeSave($insert)
    {
        if (empty($this->title) && $this->page->name)
            $this->title = $this->page->name;

        return parent::beforeSave($insert);
    }

    public function afterFind()
    {
        if (strpos($this->content, '<iframe'))
            $this->content = preg_replace('%(<iframe.+)(<\\/iframe>|\\/>)%', '<div class="flex-video">$1$2</div>', $this->content);
    }

    public function getContent()
    {
        $content = $this->content;
        $list = Replaces::find()->select('name')->asArray()->column();
        if (!empty($list)) {
            preg_match_all('@{{(' . implode('|', $list) . ')[^}]*}}@', $this->content, $matches);
            if (!empty($matches[1])) {
                $search = $replace = [];
                $forReplace = Replaces::find()->select('name, value')->where(['name' => $matches[1]])->asArray()->all();
                foreach ($forReplace as $row) {
                    if (strpos($row['value'], '?>') !== false || strpos($row['value'], '<?') !== false) {
                        ob_start();
                        eval (' ?' . '>' . $row['value'] . '<' . '?php ');
                        $replace[$row['name']] = ob_get_clean();
                    } else $replace[$row['name']] = $row['value'];
                }
                foreach ($matches[0] as $key => $value)
                    $search[$matches[1][$key]] = $value;
                $content = str_replace($search, $replace, $content);
            }
        }
        return $content;
    }
}