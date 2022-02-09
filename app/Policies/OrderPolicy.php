<?php

namespace App\Policies;

use App\Models\Orders;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class OrderPolicy
{
    use HandlesAuthorization;

    public function isAdmin(User $user)
    {
        return $user->email === 'admin@gmail.com' 
        ? Response::allow()
        : Response::deny('You doesn\'t authorize to cancel product.');
    }

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    // public function index(User $user , Orders $order) 
    // {
    //     return $user->id === $order->user_id
    //                          ? Response::allow()
    //                          : Response::deny('You do not own this post.');
    // }
    // public function index(Request $request)
    // {
    //     if ($request->user()->cannot('update')) {
    //         abort(403);
    //     }

    //     // Update the post...
    // }
    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Orders $orders)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Orders $orders)
    {
        //
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Orders $orders)
    {
        
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Orders $orders)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Orders  $orders
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Orders $orders)
    {
        //
    }
}
