<?php

namespace App\Policies;

use App\Models\Schedule;
use App\Models\Trainer;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;

class SchedulePolicy
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

    //trainer schedule
    public function unapproved_detail(Trainer $trainer, Schedule $schedule)
    {
        return $trainer->id === $schedule->trainer_id;
    }

    public function trainer_approve_form(Trainer $trainer, Schedule $schedule)
    {
        return $trainer->id === $schedule->trainer_id;
    }

    public function trainer_approve(Trainer $trainer, Schedule $schedule)
    {
        return $trainer->id === $schedule->trainer_id;
    }

    public function trainer_contact_form(Trainer $trainer, Schedule $schedule)
    {
        return $trainer->id === $schedule->trainer_id;
    }

    public function trainer_contact(Trainer $trainer, Schedule $schedule)
    {
        return $trainer->id === $schedule->trainer_id;
    }

    public function trainer_cancel(Trainer $trainer, Schedule $schedule)
    {
        return $trainer->id === $schedule->trainer_id;
    }

    public function trainer_confirm(Trainer $trainer, Schedule $schedule)
    {
        return $trainer->id === $schedule->trainer_id;
    }

    public function trainer_detail(Trainer $trainer, Schedule $schedule)
    {
        return $trainer->id === $schedule->trainer_id;
    }

    //trainer record
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

    //user schedule
    public function user_detail(User $user, Schedule $schedule)
    {
        return $user->id === $schedule->user_id;
    }

    public function user_approve_form(User $user, Schedule $schedule)
    {
        return $user->id === $schedule->user_id;
    }

    public function user_approve(User $user, Schedule $schedule)
    {
        return $user->id === $schedule->user_id;
    }

    public function user_contact_form(User $user, Schedule $schedule)
    {
        return $user->id === $schedule->user_id;
    }

    public function user_contact(User $user, Schedule $schedule)
    {
        return $user->id === $schedule->user_id;
    }

    public function user_cancel(User $user, Schedule $schedule)
    {
        return $user->id === $schedule->user_id;
    }

    public function user_confirm(User $user, Schedule $schedule)
    {
        return $user->id === $schedule->user_id;
    }
}
