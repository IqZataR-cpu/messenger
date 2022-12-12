<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use App\Models\Chat;
use App\Models\Message;
use App\Models\MessageStatus;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $users = User::factory()
            ->hasAvatar()
            ->count(3)
            ->create();

        $chats = collect();

        for ($i = 0; $i < 100; $i++) {
            $chats->push(Chat::factory()
                ->hasAttached($users)
                ->hasAvatar()
                ->create());
        }

        $messages = collect();
        for ($i = 0; $i < 2500; $i++) {
            if ($i > 2000) {
                $message = Message::factory()
                    ->recycle([$users, $chats])
                    ->hasAttachment();
            } else {
                $message = Message::factory()
                    ->recycle([$users, $chats]);
            }

            $messages->push($message->create());
        }

        MessageStatus::insert([
                [
                    'status' => MessageStatus::SENT
                ],
                [
                    'status' => MessageStatus::RECEIVED
                ],
                [
                    'status' => MessageStatus::NOT_READ
                ],
                [
                    'status' => MessageStatus::READ
                ]
            ]
        );

        $messages->each(function (Message $message) {
            for ($i = 1; $i <= random_int(1, 4); $i++) {
                $message->statuses()->attach($i);
            }
        });
    }
}
