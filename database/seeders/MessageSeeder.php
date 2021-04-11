<?php

namespace Database\Seeders;

use App\Models\Message;
use App\Models\User;
use Illuminate\Database\Seeder;

class MessageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $users = User::all('id');

        /**
         * Generate some root-level messages
         */

        $parentMessages = Message::factory()
            ->count(40)
            ->create();

        /**
         * Generate some replies
         */

        $parentMessages->each(function (Message $message) use ($users) {
            $message->replies()->saveMany(
                Message::factory()->count(1)->make([
                    'user_id' => $users->random()
                ])
            );
        });

        /**
         * Generate some replies to replies
         * I do not like this approach, but it fits perfectly
         */

        $parentMessages->each(function (Message $message) use ($users) {
            $message->replies->each(function (Message $message) use ($users) {
                $message->replies()->saveMany(
                    Message::factory()->count(1)->make([
                        'user_id' => $users->random()
                    ])
                );
            });
        });
    }
}
