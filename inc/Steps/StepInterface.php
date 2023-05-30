<?php

namespace LaunchpadBuild\Steps;

interface StepInterface
{
    public function __invoke($payload): array;
}