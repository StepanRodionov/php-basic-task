<?php

declare(strict_types=1);

namespace Otus\Demoapp;

class GlobalSettings implements \ArrayAccess
{
    private array $settings;

    private static ?GlobalSettings $instance = null;

    public static function createFromArray(array $settings): GlobalSettings
    {
        if (!self::$instance) {
            self::$instance = new GlobalSettings($settings);
        }

        return self::$instance;
    }

    public static function getInitialisedSettings(): GlobalSettings
    {
        if (!self::$instance) {
            throw new \RuntimeException('Settings werent set up');
        }

        return self::$instance;
    }

    private function __construct(array $settings)
    {
        $this->settings = $settings;
    }

    public function getSettings(): array
    {
        return $this->settings;
    }

    public function offsetExists($offset)
    {
        return isset($this->settings[$offset]);
    }

    public function offsetGet($offset)
    {
        return $this->settings[$offset];
    }

    public function offsetSet($offset, $value)
    {
        $this->settings[$offset] = $value;
    }

    public function offsetUnset($offset)
    {
        unset($this->settings[$offset]);
    }
}