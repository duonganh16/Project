<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Order;

class OrderPolicy
{
    /**
     * Determine whether the user can view the order.
     */
    public function view(User $user, Order $order)
    {
        return $user->id === $order->user_id || $user->is_admin;
    }

    /**
     * Determine whether the user can view any orders.
     */
    public function viewAny(User $user)
    {
        return true; // Users can view their own orders
    }

    /**
     * Determine whether the user can update the order.
     */
    public function update(User $user, Order $order)
    {
        return $user->is_admin; // Only admin can update orders
    }

    /**
     * Determine whether the user can delete the order.
     */
    public function delete(User $user, Order $order)
    {
        return $user->is_admin; // Only admin can delete orders
    }
}
