<?php

class Person
{
    public bool $wallet = false;
    public bool $keys = false;
    public bool $phone = false;
}

class Worker extends Person
{
    public bool $carKeys = false;
    public bool $motoKeys = false;
    public function __construct(WorkerBuilder $builder)
    {
        $this->wallet = $builder->wallet;
        $this->keys = $builder->keys;
        $this->phone = $builder->phone;
        $this->carKeys = $builder->carKeys;
        $this->motoKeys = $builder->motoKeys;
    }
}

class Student extends Person
{
    public bool $metroCard = false;
    public function __construct(StudentBuilder $builder)
    {
        $this->wallet = $builder->wallet;
        $this->keys = $builder->keys;
        $this->phone = $builder->phone;
        $this->metroCard = $builder->metroCard;
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
    public bool $wallet = false;
    public bool $keys = false;
    public bool $phone = false;

    public function getWallet(): static
    {
        $this->wallet = true;
        return $this;
    }
    public function getKeys(): static
    {
        $this->keys = true;
        return $this;
    }
    public function getPhone(): static
    {
        $this->phone = true;
        return $this;
    }
    public abstract function build();
}

class StudentBuilder extends LeavingHomeBuilder
{
    public bool $publicTransportCard = false;
    public function getPublicTransportCard(): static
    {
        $this->publicTransportCard = true;
        return $this;
    }
    public function build(): Student
    {
        return new Student($this);
    }
}

class WorkerBuilder extends LeavingHomeBuilder
{
    public bool $carKeys = false;
    public bool $motoKeys = false;
    public function getCarKeys(): static
    {
        $this->carKeys = true;
        $this->motoKeys = false;
        return $this;
    }
    public function getMotoKeys(): static
    {
        $this->carKeys = false;
        $this->motoKeys = true;
        return $this;
    }
    public function build(): Worker
    {
        return new Worker($this);
    }
}
