<?php
/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 23.03.2015
 * Time: 18:40
 */

return [
    'components' => [
        'formGenerator' => [
            'name' => 'Страницы',
            'class' => '\rere\core\component\FormGenerator',
            'config' => [
                'Main' => [
                    'created' => [
                        'type' => 'date',
                        'size' => 'medium-4'
                    ],
                    'name' => [
                        'type' => 'text',
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
                        'widget' => '\rere\core\widget\Tags',
                    ],
                ],
                'Seo' => [
                    'url' => [
                        'type' => 'url',
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
                'Character' => [
                    'characters' => [
                        'type' => 'widget',
                        'widget' => '\rere\core\widget\Characters',
                    ],
                ],
            ],
        ],
    ],
];