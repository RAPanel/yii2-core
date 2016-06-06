<?php

namespace ra\models\db;

use Yii;

/**
 * This is the model class for table "{{%character_reference}}".
 *
 * @property integer $character_id
 * @property integer $reference_id
 * @property integer $sort
 *
 * @property Character $character
 * @property Reference $reference
 */
class CharacterReference extends \yii\db\ActiveRecord
{
    /**
     * @inheritdoc
     */
    public static function tableName()
    {
        return '{{%character_reference}}';
    }

    /**
     * @inheritdoc
     */
    public function rules()
    {
        return [
            [['character_id', 'reference_id'], 'required'],
            [['character_id', 'reference_id', 'sort'], 'integer']
        ];
    }

    /**
     * @inheritdoc
     */
    public function attributeLabels()
    {
        return [
            'character_id' => Yii::t('app', 'Character ID'),
            'reference_id' => Yii::t('app', 'Reference ID'),
            'sort' => Yii::t('app', 'Sort'),
        ];
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
        return $this->hasOne(Reference::className(), ['id' => 'reference_id']);
    }
}
