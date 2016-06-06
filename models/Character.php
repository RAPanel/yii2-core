<?php

namespace ra\models;

use ra\admin\helpers\Text;
use ra\admin\traits\SerializeAttribute;
use ra\traits\AutoSet;
use Yii;

/**
 * @inheritdoc
 *
 * @property Module $module
 * @property CharacterReference[] $characterReferences
 * @property Reference[] $references
 * @property PageCharacters[] $pageCharacters
 */
class Character extends \ra\models\db\Character
{
    use SerializeAttribute, AutoSet;
    public $serializeAttributes = ['module', 'filter', 'list'];

    public function save($runValidation = true, $attributeNames = null)
    {
        if (!$this->url && $this->name) $this->url = Text::translate($this->name);

        if (strlen($this->url) > 32) $this->url = substr($this->url, 0, 30);

        if ($this->isNewRecord && ($model = self::findOne(['url' => $this->url, 'module_id' => $this->module_id, 'is_category' => $this->is_category]))) {
            $this->setAttributes($model->attributes, false);
            $this->setIsNewRecord(false);
        }
        return parent::save($runValidation, $attributeNames);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getModule()
    {
        return $this->hasOne(Module::className(), ['id' => 'module_id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacterReferences()
    {
        return $this->hasMany(CharacterReference::className(), ['character_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getReferences()
    {
        return $this->hasMany(Reference::className(), ['id' => 'reference_id'])->viaTable('{{%character_reference}}', ['character_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getPageCharacters()
    {
        return $this->hasMany(PageCharacters::className(), ['character_id' => 'id']);
    }
}
