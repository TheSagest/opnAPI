<?php

namespace App\Event;

class ModifyTextEvent
{
    private $text;

    /**
     * @return mixed
     */
    public function getText()
    {
        return $this->text;
    }

    /**
     * @param mixed $text
     * @return ModifyTextEvent
     */
    public function setText($text)
    {
        $this->text = $text;
        return $this;
    }
}