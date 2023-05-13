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
        return $this->value;
    }

    public function set_value(string $value) {
        if(! preg_match('/^(\d+\.)?(\d+\.)?(\*|\d+)$/', $value)) {
            throw new InvalidValue('Invalid version');
        }
        $this->value = $value;
    }
    public function increase() {
        $parts = explode(".", $this->value);
        $part = array_pop($parts);
        $part ++;
        $parts []= $part;

        $this->value = implode( ".", $parts );
    }
}
