<?php

use App\Console\Commands\RemoveExpiredSecrets;
use App\Console\Commands\RemoveOverusedSecrets;

Schedule::command(RemoveExpiredSecrets::class)->everyFiveMinutes();
Schedule::command(RemoveOverusedSecrets::class)->everyFiveMinutes();
