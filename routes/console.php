<?php

use App\Console\Commands\RemoveExpiredSecrets;

Schedule::command(RemoveExpiredSecrets::class)->hourly();
