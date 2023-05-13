<?php

namespace LaunchpadBuild\Entities;

class Version
{
    /**
     * @var string
     */
    protected $value = '1.0.0';

    /**
     * @param string $value
     */
    public function __construct(string $value)
    {
        $this->set_value($value);
    }

    public function get_value(): string {

    }

    public function set_value(string $value) {
        $this->value = $value;
    }
    public function increase() {

    }
}
