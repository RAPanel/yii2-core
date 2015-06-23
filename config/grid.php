<?php
/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 23.03.2015
 * Time: 18:40
 */

return [
    'Main' => [
        'name' => [
            'type' => 'text',
            'tagOptions' => ['class' => 'medium-8 columns'],
        ],
        'created_at' => [
            'type' => 'date',
            'tagOptions' => ['class' => 'medium-4 columns'],
        ],
        'about' => [
            'type' => 'textArea',
            'options' => ['rows' => 6],
        ],
    ],
    'Data' => [
        'data.content' => [
            'type' => 'widget',
            'widget' => '\rere\admin\widgets\TinyMce',
        ],
        'data.tags' => [
            'type' => 'widget',
            'widget' => '\rere\core\widgets\Tags',
        ],
    ],
    'Seo' => [
        'url' => [
            'type' => 'text',
        ],
        'data.title' => [
            'type' => 'text',
        ],
        'data.description' => [
            'type' => 'textArea',
            'options' => ['rows' => 2],
        ],
        'data.keywords' => [
            'type' => 'textArea',
            'options' => ['rows' => 2],
        ],
    ],
    'Position' => [
        'with_child' => [
            'type' => 'checkbox',
        ],
        'parent_id' => [
            'type' => 'select',
            'items' => [null => Yii::t('rere.help', 'Select parent')] + \yii\helpers\ArrayHelper::map(\rere\core\models\Page::findAll(['with_child' => 1]), 'id', 'name'),
        ],
        'sort_id' => [
            'type' => 'number',
        ],
    ]
    /*'Character' => [
        'characters' => [
            'type' => 'widget',
            'widget' => '\rere\core\widgets\Characters',
        ],
    ],*/
];