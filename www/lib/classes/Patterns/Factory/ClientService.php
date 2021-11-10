<?php

declare(strict_types=1);

class ClientService
{
    private ClientFactory $factory;

    public function __construct(ClientFactory $factory)
    {
        $this->factory = $factory;
    }

    public function promoteClient(array $clientData)
    {
        $client = $this->factory->createClientFromClientData($clientData);

        // Смотрим в историю заказов клиента
        // Идем в систему лояльности, что-то там ему накручиваем
        // Много сложного кода, код по созданию клиента только все дополнительно усложнит
    }
}