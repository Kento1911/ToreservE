<?php

namespace App\Policies;

use App\Models\Trainer;
use App\Models\TrainerProfile;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class TrainerProfilePolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        
    }

    public function edit_profile(Trainer $trainer, TrainerProfile $trainer_profile)
    {
        return $trainer->id === $trainer_profile->trainer_id;
    }

    public function update_profile(Trainer $trainer, TrainerProfile $trainer_profile)
    {
        return $trainer->id === $trainer_profile->trainer_id;
    }

    public function edit_plan(Trainer $trainer, TrainerProfile $trainer_profile)
    {
        return $trainer->id === $trainer_profile->trainer_id;
    }

    public function update_plan(Trainer $trainer, TrainerProfile $trainer_profile)
    {
        return $trainer->id === $trainer_profile->trainer_id;
    }

    public function delete_plan(Trainer $trainer, TrainerProfile $trainer_profile)
    {
        return $trainer->id === $trainer_profile->trainer_id;
    }

    public function destroy_plan(Trainer $trainer, TrainerProfile $trainer_profile)
    {
        return $trainer->id === $trainer_profile->trainer_id;
    }
}
