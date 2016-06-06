<?php

namespace ra\models;

use Yii;
use yii\helpers\ArrayHelper;

/**
 * This is the model class for table "{{%character_reference}}".
 *
 * @inheritdoc
 *
 * @property Character $character
 * @property Reference $reference
 */
class CharacterReference extends \ra\models\db\CharacterReference
{
    /**
     * @inheritdoc
     */
    public function rules()
    {
        return ArrayHelper::merge(parent::rules(), [
            [['character_id'], 'exist', 'skipOnError' => true, 'targetClass' => Character::className(), 'targetAttribute' => ['character_id' => 'id']],
            [['reference_id'], 'exist', 'skipOnError' => true, 'targetClass' => Reference::className(), 'targetAttribute' => ['reference_id' => 'id']],
        ]);
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
