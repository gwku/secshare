<?php

namespace App\Console\Commands;

use App\Models\Secret;
use Illuminate\Console\Command;

class RemoveOverusedSecrets extends Command
{
    protected $signature = 'secrets:remove-overused';
    protected $description = 'Remove secrets from the database with max views reached';

    public function handle(): void
    {
        $count = Secret::whereColumn('views', '>=', 'max_views')->delete();

        if ($count === 0) {
            $this->info('No overused secrets found.');
        } else {
            $this->info("Deleted {$count} overused secrets successfully.");
        }
    }
}
