<?php
/**
 * Created by PhpStorm.
 * User: semyonchick
 * Date: 07.10.2015
 * Time: 16:52
 */

namespace ra\traits;


trait SerialiseAttribute
{
    private $_data = [];

    public function __get($name)
    {
        if ($this->isIsset($name)) {
            return isset($this->_data[$name]) ? $this->_data[$name] : '';
        }
        return parent::__get($name);
    }

    public function __set($name, $value)
    {
        if ($this->isIsset($name)) {
            $this->_data[$name] = $value;
            $this->on($this->isNewRecord ? parent::EVENT_BEFORE_INSERT : parent::EVENT_BEFORE_UPDATE, function ($event) {
                if (count($event->sender->_data)) {
                    $event->sender->data = serialize($event->sender->_data);
                    $event->sender->_data = [];
                }
            });
            return;
        }
        parent::__set($name, $value);
    }

    public function isIsset($name)
    {
        if (empty($this->_data) && $name != 'data' && $this->data) $this->_data = unserialize($this->data);
        return in_array($name, $this->serializeAttributes) || isset($this->_data[$name]);
    }

}