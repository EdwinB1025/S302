<?php
class Tigger
{
    private static $instance;
    private static int $counter = 0;

    private function __construct() {}

    private function __clone() {}

    public function __wakeup()
    {
        throw new Exception("Singleton properties of Tigger cannot be reinstantiated!");
    }

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function getCounter()
    {

        echo "Tiger has roar " . self::$counter . " tiemess." . PHP_EOL;
    }

    public static function roar()
    {
        echo "Grrr!" . PHP_EOL;
        self::$counter++;
    }
}
