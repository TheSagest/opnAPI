<?php

namespace App\Module\Block;

interface BlockInterface
{
    public function setOptions(array $data);
    public function getOptions();
}