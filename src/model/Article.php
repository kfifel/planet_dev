<?php

declare(strict_types=1);

class Article
{
    public ?int $id;
    public string $title;
    public string $content;
    public string $date_created;


    public function __construct(int|null $id, string $title, string $content, string $date_created)
    {
        $this->id = $id;
        $this->title = $title;
        $this->content = $content;
        $this->date_created = $date_created;
    }

}
