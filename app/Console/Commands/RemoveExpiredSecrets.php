<?php

namespace App\Console\Commands;

use App\Models\Secret;
use Carbon\Carbon;
use Illuminate\Console\Command;

class RemoveExpiredSecrets extends Command
{
    protected $signature = 'secrets:remove-expired';
    protected $description = 'Remove expired secrets from the database';

    public function handle(): void
    {
        $count = Secret::where('expires_at', '<', Carbon::now())->delete();

        if ($count === 0) {
            $this->info('No expired secrets found.');
        } else {
            $this->info("Deleted {$count} expired secrets successfully.");
        }
    }
}
