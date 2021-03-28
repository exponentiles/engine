<?php


namespace Exponentiles\Engine;

class Game
{
    public Grid $grid;

    public Engine $engine;

    public function __construct(
        public int $size = 4,
    ) {
        $this->grid = new Grid($this->size);
        $this->engine = new Engine();
    }

    public function start(): self
    {
        $this->engine->start($this->grid);

        return $this;
    }

    public function move(string $direction): void
    {
    }
}
