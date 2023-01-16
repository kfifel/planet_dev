<?php

declare(strict_types=1);

class Category
{

    private ?int $id;
    private string $name;

    public function __construct( int|null $id, string $name)
    {
        $this->id = $id;
        $this->name = $name;
    }
}
