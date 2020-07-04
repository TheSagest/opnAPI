<?php
namespace App\Module\Block;

abstract class AbstractBlock implements BlockInterface
{
    protected $_options = [];

    final public function getOptions()
    {
        return $this->_options;
    }

    final public function setOptions(array $options): void
    {
        $this->_options = $options;
    }

    public function getCriteriaKey()
    {
        $crc32 = sprintf('%u', crc32(json_encode($this)));
        return base_convert($crc32, 10, 36);
    }
}