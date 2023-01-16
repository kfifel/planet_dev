<?php

declare(strict_types=1);

class User extends Person
{
    private string $email;
    private string $password;

    public function __construct(int|null $id, string $first_name, string $last_name  , string $email ='', string $password = '')
    {
        $this->email = $email;
        $this->password = hash("sha256", $password);
        parent::__construct( $id,  $first_name,  $last_name);
    }

    /**
     * @return string
     */
    public function getEmail(): string
    {
        return $this->email;
    }

    /**
     * @param string $email
     */
    public function setEmail(string $email): void
    {
        $this->email = $email;
    }

    /**
     * @return string
     */
    public function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @param string $password
     */
    public function setPassword(string $password): void
    {
        $this->password = $password;
    }


}
