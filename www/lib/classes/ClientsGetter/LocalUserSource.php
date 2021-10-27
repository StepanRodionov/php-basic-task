<?php
declare(strict_types=1);

require_once 'UserSourceInterface.php';

abstract class LocalUserSource implements UserSourceInterface
{
    protected $connection;

    public function getUsersData(): array
    {
        $this->connect();
        return $this->getData();
    }

    public function getUserDataById(int $id): array
    {
        // TODO: Implement getUserDataById() method.
    }

    private function connect()
    {
        if ($this->connection === null) {
            $this->connection = $this->doConnect();
        }
    }

    abstract protected function doConnect();

    abstract protected function getData(): array;
}