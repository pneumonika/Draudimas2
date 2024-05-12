<?php

namespace App\Policies;

use App\Models\Car;
use App\Models\User;
use Illuminate\Auth\Access\Response;

class CarPolicy
{
    //0 - tik peržiūra, 1 - paprastas vartotojas, 2 - skaitantis vartotojas, 3 - administratorius.
    /**
     * Determine whether the user can view any models.
     */
    public function viewAny(User $user): bool
    {
        return ($user->permission == 0) || ($user->permission == 1) || ($user->permission == 2) || ($user->permission == 3);
    }

    /**
     * Determine whether the user can view the model.
     */
    public function view(User $user, Car $car): bool
    {
        return ($user->permission == 0) || ($user->permission == 2) || ($user->permission == 3) || ($user->permission == 1 && $user->id == $car->owner->user_id);
    }

    /**
     * Determine whether the user can create models.
     */
    public function create(User $user): bool
    {
        return ($user->permission == 2) || ($user->permission == 3);
    }

    /**
     * Determine whether the user can update the model.
     */
    public function update(User $user, Car $car): bool
    {
        return ($user->permission == 3) || ($user->id == $car->owner->user_id);
    }

    /**
     * Determine whether the user can delete the model.
     */
    public function delete(User $user, Car $car): bool
    {
        return ($user->permission == 3);
    }

    /**
     * Determine whether the user can restore the model.
     */
    public function restore(User $user, Car $car): bool
    {
        return ($user->permission == 3);
    }

    /**
     * Determine whether the user can permanently delete the model.
     */
    public function forceDelete(User $user, Car $car): bool
    {
        return ($user->permission == 3);
    }
}
