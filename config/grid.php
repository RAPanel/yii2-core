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
        'created' => [
            'type' => 'date',
            'tagOptions' => ['class' => 'medium-4 columns'],
        ],
        'about' => [
            'type' => 'textArea',
            'options' => ['rows' => 6],
        ],
        'with_child' => [
            'type' => 'radioList',
            'items' => [1 => 'будут дети', 0 => 'без детей'],
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
    /*'Character' => [
        'characters' => [
            'type' => 'widget',
            'widget' => '\rere\core\widgets\Characters',
        ],
    ],*/
];