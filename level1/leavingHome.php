<?php
class Wallet {}
class Keys {}
class Phone {}
class TransportKeys {}
class CarKeys extends TransportKeys {}
class MotoKeys extends TransportKeys {}
class PublicTransportCard extends TransportKeys {}


class Person
{
    public Wallet $wallet;
    public Keys $keys;
    public Phone $phone;
}

class Worker extends Person
{
    public TransportKeys $vehicleKeys;
    public function __construct(WorkerBuilder $builder)
    {
        $this->wallet = $builder->wallet;
        $this->keys = $builder->keys;
        $this->phone = $builder->phone;
        $this->vehicleKeys = $builder->vehicleKeys;
    }
}

class Student extends Person
{
    public PublicTransportCard $publicTransportCard;
    public function __construct(StudentBuilder $builder)
    {
        $this->wallet = $builder->wallet;
        $this->keys = $builder->keys;
        $this->phone = $builder->phone;
        $this->publicTransportCard = $builder->publicTransportCard;
    }
}

interface leaveHome
{
    public function getWallet();
    public function getKeys();
    public function getPhone();
}

abstract class LeavingHomeBuilder implements leaveHome
{
    public Wallet $wallet;
    public Keys $keys;
    public Phone $phone;

    public function getWallet(): static
    {
        $this->wallet = new Wallet();
        return $this;
    }
    public function getKeys(): static
    {
        $this->keys = new Keys();
        return $this;
    }
    public function getPhone(): static
    {
        $this->phone = new Phone();
        return $this;
    }
    public abstract function build();
}

class StudentBuilder extends LeavingHomeBuilder
{
    public PublicTransportCard $publicTransportCard;
    public function getPublicTransportCard(): static
    {
        $this->publicTransportCard = new PublicTransportCard();
        return $this;
    }
    public function build(): Student
    {
        return new Student($this);
    }
}

class WorkerBuilder extends LeavingHomeBuilder
{
    public TransportKeys $vehicleKeys;
    public function getCarKeys(): static
    {
        $this->vehicleKeys = new CarKeys();
        return $this;
    }
    public function getMotoKeys(): static
    {
        $this->vehicleKeys = new MotoKeys();
        return $this;
    }
    public function build(): Worker
    {
        return new Worker($this);
    }
}
