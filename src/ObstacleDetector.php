<?php declare(strict_types=1);
interface ObstacleDetector
{
    public function at(int $x, int $y): bool;
}