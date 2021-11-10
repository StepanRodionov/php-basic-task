<?php

declare(strict_types=1);

class LoggedClientDecorator implements ClientInterface
{
    private ClientInterface $client;
    private LoggerInterface $logger;

    public function __construct(ClientInterface $client, LoggerInterface $logger)
    {
        $this->client = $client;
        $this->logger = $logger;
    }

    public function getOrdersData(): array
    {
        return $this->client->getOrdersData();
    }

    public function setOrdersData(array $ordersData): void
    {
        $this->client->setOrdersData($ordersData);
        $this->logger->log("new orders data - $ordersData");
    }

    public function getName(): string
    {
        return $this->client->getName();
    }

    public function setName(string $name): void
    {
        $this->client->setName($name);
        $this->logger->log("new name - $name");
    }

    public function getEmail(): string
    {
        return $this->client->getEmail();
    }

    public function setEmail(string $email): void
    {
        $this->client->setEmail($email);
        $this->logger->log("new email - $email");
    }
}