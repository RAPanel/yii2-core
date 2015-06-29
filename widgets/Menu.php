<?php
/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 10.04.2015
 * Time: 10:14
 */

namespace rere\core\widgets;


class Menu extends \yii\widgets\Menu
{
    public $data = [];
    public $levels = false;

    public function run()
    {
        /** @var \rere\core\models\PageMenu $row */
        if (count($this->data)) {
            foreach ($this->data as $row)
                $this->items[$row->parent_id][] = [
                    'label' => $row->getLabel(),
                    'url' => $row->getHref(),
                    'active' => $row->getActive(),
                    'items' => $this->levels && $row->with_child && isset($this->items[$row->id]) ? $this->items[$row->id] : null,
                ];

            if ($this->items[min(array_keys($this->items))])
                $this->items = $this->items[min(array_keys($this->items))];
        }

        parent::run();
    }

}