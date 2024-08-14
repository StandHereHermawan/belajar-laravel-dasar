<?php

namespace App\Data;

class Bar
{
    private Foo $foo;

    public function __construct(Foo $foo)
    {
        $this->foo = $foo;
    }

    public function bar()
    {
        return $this->foo->foo() . ' and Bar';
    }

    public function getFoo()
    {
        return $this->foo;
    }

    public function setFoo(Foo $foo)
    {
        $this->foo = $foo;
    }
}
