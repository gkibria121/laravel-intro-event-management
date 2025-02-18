<?php

namespace Database\Seeders;

use App\Models\Attendee;
use App\Models\Event;
use App\Models\User;
use Database\Factories\AttendeeFactory;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class AttendeeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        $events = Event::all();
        $users = User::all();

        for ($i = 0; $i < random_int(min($events->count(), $users->count()), max($events->count(), $users->count())); $i++) {
            $user = $users->random();
            $event = $events->random();
            Attendee::create([
                'user_id' => $user->id,
                'event_id' => $event->id
            ]);
        }
    }
}
