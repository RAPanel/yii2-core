<?php

namespace ra\models;

use ra\admin\helpers\RA;
use Yii;

/**
 * This is the model class for table "{{%page_characters}}".
 *
 * @property string $id
 * @property string $page_id
 * @property string $character_id
 * @property string $value
 *
 * @property Page $page
 * @property Character $character
 */
class PageCharacters extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%page_characters}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['page_id', 'character_id'], 'required'],
            [['page_id', 'character_id'], 'integer'],
            [['value'], 'safe'],
            [['page_id', 'character_id'], 'unique', 'targetAttribute' => ['page_id', 'character_id'], 'message' => 'The combination of Page ID and Character ID has already been taken.']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('ra', 'ID'),
            'page_id' => Yii::t('ra', 'Page ID'),
            'character_id' => Yii::t('ra', 'Character ID'),
            'value' => Yii::t('ra', 'Value'),
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
    public function getCharacter()
    {
        return $this->hasOne(Character::className(), ['id' => 'character_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReference()
    {
        return $this->hasOne(Reference::className(), ['id' => 'value']);
    }

    public function save($runValidation = true, $attributeNames = null)
    {
        $multi = RA::character($this->character_id, 'multi');
        if (RA::character($this->character_id, 'type') == 'table' && is_array($this->value)) {
            $list = [];
            foreach ($this->value as $row) $list[] = implode('|-|', $row);
            if (!$multi) $this->value = current($list);
            else $this->value = $list;
        }

        if ($multi && is_array($this->value)) $this->value = '|' . implode('|+|', $this->value) . '|';
        
        return parent::save($runValidation, $attributeNames);
    }

    public function afterFind()
    {
        if (RA::character($this->character_id, 'multi'))
            if (preg_match('#^\|(.*)\|$#', $this->value, $match)) {
                $this->value = explode('|+|', $match[1]);
            } else {
                $this->value = $this->value ? explode(strpos($this->value, ';;') ? ';;' : ',', $this->value) : [];
            }
        if (RA::character($this->character_id, 'type') == 'table') {
            $list = [];
            foreach ((array)$this->value as $row) $list[] = explode(strpos($row, '|-|')!==false ? '|-|' : ';;', $row);
            $this->value = $list;
        }

        parent::afterFind();
    }
}
