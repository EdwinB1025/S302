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
    public string $type;
    public Wallet $wallet;
    public Keys $keys;
    public Phone $phone;
    public TransportKeys $transportKeys;
    public function __construct(LeaveHome $dependencyInjector)
    {
        $this->type = $dependencyInjector->type;
        $this->wallet = $dependencyInjector->wallet;
        $this->keys = $dependencyInjector->keys;
        $this->phone = $dependencyInjector->phone;
        $this->transportKeys = $dependencyInjector->transportKeys;
    }
}

interface LeaveHome
{
    public function getWallet();
    public function getKeys();
    public function getPhone();
}

abstract class LeavingHomeDependencies implements LeaveHome
{
    public Wallet $wallet;
    public Keys $keys;
    public Phone $phone;

    public function __construct()
    {
        $this->getKeys();
        $this->getWallet();
        $this->getPhone();
    }

    public function getWallet()
    {
        $this->wallet = new Wallet();
    }
    public function getKeys()
    {
        $this->keys = new Keys();
    }
    public function getPhone()
    {
        $this->phone = new Phone();
    }
}

class StudentDependencies extends LeavingHomeDependencies
{
    public string $type = 'student';
    public PublicTransportCard $transportKeys;
    public function __construct()
    {
        parent::__construct();
        $this->getPublicTransportCard();
    }
    public function getPublicTransportCard()
    {
        $this->transportKeys = new PublicTransportCard();
    }
}

class WorkerDependencies extends LeavingHomeDependencies
{
    public string $type = 'worker';
    public TransportKeys $transportKeys;

    public function __construct(string $vehicleType)
    {
        parent::__construct();
        match (true) {
            (bool) preg_match('/car/i', $vehicleType) => $this->getCarKeys(),
            (bool) preg_match('/moto/i', $vehicleType) => $this->getMotoKeys(),
            default => $this->getCarKeys()
        };
    }

    public function getCarKeys()
    {
        $this->transportKeys = new CarKeys();
    }
    public function getMotoKeys()
    {
        $this->transportKeys = new MotoKeys();
    }
}
