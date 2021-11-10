<?php

interface ProductServiceInterface
{
    public function getPositions(?int $orderId = null);

    public function massAdd(array $productIds): void;

    public function massDelete(array $productIds): void;

    public function delete(int $productId);

    public function clear();

    public function moveToCart(int $productId): void;

    public function moveAllToCart(): int;

    public function count(?int $orderId = null);

    public function getByStore(int $storeId);

    public function confirmDelivery(array $productIds);
}
