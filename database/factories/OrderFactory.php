<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class OrderFactory extends Factory
{
    public function definition(): array
    {
        return [
            'order_number' => 'ORD-' . $this->faker->unique()->numberBetween(1000, 9999),
            'user_id' => 1,
            'customer_name' => $this->faker->name(),
            'customer_email' => $this->faker->email(),
            'customer_phone' => $this->faker->phoneNumber(),
            'shipping_address' => $this->faker->address(),
            'billing_address' => $this->faker->address(),
            'subtotal' => $this->faker->randomFloat(2, 50, 500),
            'tax' => $this->faker->randomFloat(2, 5, 50),
            'shipping_cost' => $this->faker->randomFloat(2, 5, 30),
            'discount' => $this->faker->randomFloat(2, 0, 20),
            'total' => $this->faker->randomFloat(2, 100, 600),
            'payment_method' => $this->faker->randomElement(['credit_card', 'paypal', 'bank_transfer']),
            'payment_status' => $this->faker->randomElement(['paid', 'unpaid', 'refunded']),
            'status' => $this->faker->randomElement(['pending', 'processing', 'shipped', 'delivered', 'cancelled']),
            'notes' => $this->faker->sentence(),
        ];
    }
}