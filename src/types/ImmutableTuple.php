<?php declare(strict_types=1);

readonly class ImmutableTuple {
    public function __construct(
        public int $x,
        public int $y
    ) {}
}