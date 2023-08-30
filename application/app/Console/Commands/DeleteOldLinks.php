<?php

namespace App\Console\Commands;

use App\Models\Url;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class DeleteOldLinks extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:delete-old-links';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'The command is used for handle old not enough visited urls';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Log::debug('done');

        $deleted = Url::query()
            ->old()
            ->notVisited()
            ->delete();

        $this->info("Deleted {$deleted} old links.");
    }
}
