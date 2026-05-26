<?php
class Tigger
{
    private static $instance;
    private static int $counter = 0;

    private function __construct() {}

    private function __clone() {}

    private function __wakeup() {}

    public static function getInstance()
    {
        if (!isset(self::$instance)) {
            self::$instance = new self();
        }

        return self::$instance;
    }

    public static function getCounter(): string
    {

        return "Tiger has roar " . self::$counter . " tiemess." . PHP_EOL;
    }

    public static function roar()
    {
        echo "Grrr!" . PHP_EOL;
        self::$counter++;
    }
}
