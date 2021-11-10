<?php

declare(strict_types=1);

class ClientFactory
{
    public function createClientFromClientData(array $clientData): ClientInterface
    {
        $client = new Client();
        $client->setEmail($clientData['email']);
        $client->setName($clientData['name']);
        $client->setOrdersData($clientData['orders']);
        return new LoggedClientDecorator(
            $client,
            $this->createLogger()
        );
    }

    public function createLogger(): LoggerInterface
    {
        return (new Logger())->setLogPath('/var/log/log.txt');
    }
}