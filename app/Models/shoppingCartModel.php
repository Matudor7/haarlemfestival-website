<?php
require __DIR__ . '/productModel.php';

class ShoppingCart{
    private int $user_id = 0;
    //NOTE: Might not need product id if I have a product array, will see.
    private int $product_id = 0;

    private Product $products = [];

    private int $amount = 0;

    #[ReturnTypeWillChange]

    public function getUserId(): int{
        return $this->user_id;
    }

    public function getProductId(): int{
        return $this->product_id;
    }

    public function getProducts(): Product{
        return $this->products;
    }

    public function getAmount(): int{
        return $this->amount;
    }

    public function setAmount(int $amount): self{
        $this->amount = $amount;
        return $this;
    }
}
?>