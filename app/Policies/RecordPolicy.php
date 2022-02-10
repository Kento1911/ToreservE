<?php

namespace App\Policies;

use App\Models\Schedule;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class RecordPolicy
{
    use HandlesAuthorization;

    /**
     * Create a new policy instance.
     *
     * @return void
     */
    public function __construct()
    {
        //
    }

    //trainer
    public function trainer_detail(Trainer $trainer, Schedule $schedule)
    {
        return $trainer->id === $schedule->trainer_id;
    }

    public function record_form(Trainer $trainer, Schedule $schedule)
    {
        return $trainer->id === $schedule->trainer_id;
    }

    public function post_record(Trainer $trainer, Schedule $schedule)
    {
        return $trainer->id === $schedule->trainer_id;
    }

    public function edit_form(Trainer $trainer, Schedule $schedule)
    {
        return $trainer->id === $schedule->trainer_id;
    }

    public function edit(Trainer $trainer, Schedule $schedule)
    {
        return $trainer->id === $schedule->trainer_id;
    }

    //user
    public function user_detail(User $user, Schedule $schedule)
    {
        return $user->id === $schedule->user_id;
    }
}
