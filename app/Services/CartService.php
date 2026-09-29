<?php

namespace App\Services;

class CartService
{
    protected $sessionKey = 'cart';

    public function add($product, $quantity = 1)
    {
        $cart = session()->get($this->sessionKey, []);

        if (isset($cart[$product['id']])) {
            $cart[$product['id']]['quantity'] += $quantity;
        } else {
            $cart[$product['id']] = [
                'id' => $product['id'],
                'name' => $product['name'],
                'price' => $product['price'],
                'image' => $product['images'][0],
                'quantity' => $quantity
            ];
        }

        session()->put($this->sessionKey, $cart);
        return $this->getCount();
    }

    public function getCount()
    {
        $cart = session()->get($this->sessionKey, []);
        return array_sum(array_column($cart, 'quantity'));
    }

    public function getItems()
    {
        return session()->get($this->sessionKey, []);
    }
}
