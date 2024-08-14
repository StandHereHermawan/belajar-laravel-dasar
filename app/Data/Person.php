<?php

namespace App\Data;

class Person
{
    public function __construct(
        private string $firstName,
        private string $lastName,
    ) {}

    public function getFirstName(): string
    {
        return $this->firstName;
    }

    public function getLastName(): string
    {
        return $this->lastName;
    }

    public function setFirstName(string $value)
    {
        $this->firstName = $value;
    }

    public function setLastName(string $value)
    {
        $this->lastName = $value;
    }
}
