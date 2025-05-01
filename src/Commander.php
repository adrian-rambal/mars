<?php declare(strict_types=1);

// validates and executes received commands to rover
class Commander
{
    const string MOVE_REGEX = '/^(F|L|R)+$/';

    private Rover $rover;

    public function __construct(Rover $rover)
    {
        $this->rover = $rover;
    }

    public function execute(string $command): void
    {
        if (!preg_match(self::MOVE_REGEX, $command)) {
            throw new InvalidCommandException('Invalid move command');
        }

        $this->rover->move($command);
    }
}