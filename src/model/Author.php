<?php

declare(strict_types=1);

class Author extends Person
{

    public function __construct(int $id, string $first_name, string $last_name)
    {
        parent::__construct($id, $first_name, $last_name);
    }

}
