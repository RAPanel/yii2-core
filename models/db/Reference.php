<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%reference}}".
 *
 * @property integer $id
 * @property string $value
 *
 * @property CharacterReference[] $characterReferences
 * @property Character[] $characters
 */
class Reference extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%reference}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['value'], 'required'],
            [['value'], 'string', 'max' => 255],
            [['value'], 'unique']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'id' => Yii::t('app', 'ID'),
            'value' => Yii::t('app', 'Value'),
        ];
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacterReferences()
    {
        return $this->hasMany(CharacterReference::className(), ['reference_id' => 'id']);
    }

    /**
     * @return \yii\db\ActiveQuery
     */
    public function getCharacters()
    {
        return $this->hasMany(Character::className(), ['id' => 'character_id'])->viaTable('{{%character_reference}}', ['reference_id' => 'id']);
    }
}
