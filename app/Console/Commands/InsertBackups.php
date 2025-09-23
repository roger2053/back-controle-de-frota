<?php

namespace App\Console\Commands;

use App\Models\Sheet;
use App\Models\SheetsBackup;
use App\Models\Victim;
use App\Models\VictimsBackup;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Log;

class InsertBackups extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'insert:backup';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $backups = SheetsBackup::all();
        foreach ($backups as $backup) {
            Sheet::create((array)$backup);
            Log::danger('ID Protocolo: '.$backup->protocol);
        }

        $backups = VictimsBackup::all();
        foreach ($backups as $backup) {
            Victim::create((array)$backup);
            Log::warning('ID Vitima: '. $backup->id);
        }
        
    }
}
