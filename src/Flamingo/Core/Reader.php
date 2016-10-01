<?php

namespace Flamingo\Core;

/**
 * Interface Reader
 * @package Flamingo\Core
 */
interface Reader
{
    /**
     * @param array $options
     * @return \Flamingo\Model\Table
     */
    public static function read($options);
}