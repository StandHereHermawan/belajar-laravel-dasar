<?php

namespace Tests\Feature;

use App\Data\Bar;
use App\Data\Foo;
use App\Data\Person;
use App\Services\HelloService;
use App\Services\HelloServiceIndonesia;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ServiceContainerTest extends TestCase
{
    /**
     * @test
     */
    public function dependencyInjectionUsingServiceContainer()
    {
        // $foo = new Foo();
        $fooOne = $this->app->make(Foo::class); // new Foo()
        $fooTwo = $this->app->make(Foo::class); // new Foo()

        self::assertNotNull($fooOne);
        self::assertNotNull($fooTwo);
        self::assertEquals("Foo", $fooOne->foo());
        self::assertEquals("Foo", $fooTwo->foo());
        self::assertNotSame($fooOne, $fooTwo);
    }

    /**
     * @test
     */
    public function bindPersonNewObject()
    {
        // $person = $this->app->make(Person::class); // new Person(), error.
        // self::assertNotNull($person); cara yang salah.

        $this->app->bind(Person::class, function ($app) {
            return new Person("Terry", "Davis");
        });

        $personOne = $this->app->make(Person::class); // closure() // new Person("Terry", "Davis");
        $personTwo = $this->app->make(Person::class); // closure() // new Person("Terry", "Davis");

        self::assertNotNull($personOne->getFirstName());
        self::assertNotNull($personOne->getLastName());

        self::assertNotNull($personTwo->getFirstName());
        self::assertNotNull($personTwo->getLastName());

        self::assertEquals('Terry', $personOne->getFirstName());
        self::assertEquals('Terry', $personTwo->getFirstName());

        self::assertNotSame($personOne, $personTwo);
    }

    /**
     * @test
     */
    public function bindPersonSingleton()
    {
        // $person = $this->app->make(Person::class); // new Person(), error.
        // self::assertNotNull($person); cara yang salah.

        $this->app->singleton(Person::class, function ($app) {
            return new Person("Terry", "Davis");
        });

        $personOne = $this->app->make(Person::class); // $person = new Person("Terry", "Davis"); if not exists
        $personTwo = $this->app->make(Person::class); // return $person;
        $personThree = $this->app->make(Person::class); // return $person;
        $personFour = $this->app->make(Person::class); // return $person;

        self::assertNotNull($personOne->getFirstName());
        self::assertNotNull($personOne->getLastName());

        self::assertNotNull($personTwo->getFirstName());
        self::assertNotNull($personTwo->getLastName());

        self::assertEquals('Terry', $personOne->getFirstName());
        self::assertEquals('Terry', $personTwo->getFirstName());

        self::assertSame($personOne, $personTwo);
        self::assertSame($personOne, $personThree);
        self::assertSame($personOne, $personFour);
    }

    /**
     * @test
     */
    public function instanceSingleton()
    {
        $person = new Person("Andrew", "Davis");

        $this->app->instance(Person::class, $person);

        $person1 = $this->app->make(Person::class); // $person
        $person2 = $this->app->make(Person::class); // $person
        $person3 = $this->app->make(Person::class); // $person
        $person4 = $this->app->make(Person::class); // $person

        self::assertNotNull($person1->getFirstName());
        self::assertNotNull($person1->getLastName());

        self::assertNotNull($person2->getFirstName());
        self::assertNotNull($person2->getLastName());

        self::assertEquals("Andrew", $person1->getFirstName());
        self::assertEquals("Andrew", $person2->getFirstName());
        self::assertEquals("Andrew", $person3->getFirstName());
        self::assertEquals("Andrew", $person4->getFirstName());

        self::assertEquals("Andrew", $person1->getFirstName());
        self::assertEquals("Andrew", $person2->getFirstName());
        self::assertEquals("Andrew", $person3->getFirstName());
        self::assertEquals("Andrew", $person4->getFirstName());

        self::assertSame($person1, $person2);
        self::assertSame($person1, $person3);
        self::assertSame($person1, $person4);
    }

    /**
     * @test
     */
    public function dependencyInjectionObjectDependent()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);

        self::assertNotNull($foo);
        self::assertNotNull($bar);

        self::assertSame($foo, $bar->getFoo());
    }

    /**
     * @test
     */
    public function dependencyInjectionInClosure()
    {
        $this->app->singleton(Foo::class, function ($app) {
            return new Foo();
        });
        $this->app->singleton(Bar::class, function ($app) {
            return new Bar($app->make(Foo::class));
        });

        $foo = $this->app->make(Foo::class);
        $bar = $this->app->make(Bar::class);
        $bar2 = $this->app->make(Bar::class);

        self::assertNotNull($foo);
        self::assertNotNull($bar);

        self::assertSame($foo, $bar->getFoo());
        self::assertSame($bar2, $bar);
    }

    /**
     * @test
     */
    public function interfaceToClassSimple()
    {
        $this->app->singleton(HelloService::class, HelloServiceIndonesia::class);

        $helloService = $this->app->make(HelloService::class);

        self::assertNotNull($helloService);

        self::assertEquals('Halo Davis!', $helloService->hello('Davis'));
    }

    /**
     * @test
     */
    public function interfaceToClassClosure()
    {
        $this->app->singleton(HelloService::class, function ($app) {
            return new HelloServiceIndonesia();
        });

        $helloService = $this->app->make(HelloService::class);

        self::assertNotNull($helloService);

        self::assertEquals('Halo Davis!', $helloService->hello('Davis'));
    }
}
