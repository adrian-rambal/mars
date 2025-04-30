<?php declare(strict_types=1);

interface Rover
{
    public function move(string $command): void; 
}