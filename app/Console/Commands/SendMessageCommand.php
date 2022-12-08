<?php

namespace App\Console\Commands;

use App\Enums;
use App\Models\Message;
use Illuminate\Console\Command;

class SendMessageCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'message:notify {--m|message=} {--category= : Category to notify users of}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Notifies Users of message via selected channel';

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $message = $this->option('message') ?? $this->ask('Write a message to notify');

        $category = $this->option('category') ?? $this->choice(
            'What category to notify users of?',
            Enums\CategoryEnum::values()
        );

        $message = Message::create(['content' => $message, 'category' => Enums\CategoryEnum::tryFrom($category)]);

        $this->info("Category: {$category}");
        $this->info("Message: {$message->content}");
    }
}
