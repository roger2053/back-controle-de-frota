<?php

namespace App\Console\Commands\Stock;

use App\Models\Notification;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;

class VerifyValidStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:validate-stock';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Valida se o produto está pra vencer';

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
        $stock = Stock::select('id', 'product_name', DB::raw("DATE_FORMAT(expiration_date, '%d/%m/%Y') as formatted_expiration_date"))
            ->where('type', 'M')
            ->whereNotNull('expiration_date')
            ->whereDate('expiration_date', '<=', date('Y-m-d', strtotime('+15 DAYS')))
            ->get()
            ->toArray();
        $users = User::select('id')->where('profile_id', 1)->where('id_status', 1)->get();
        foreach ($stock as $item) {
            foreach ($users as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Produto para Vencer - '.$item['id'],
                    'body' => $item['product_name'] . " vence em " . $item['formatted_expiration_date'],
                    'is_alert' => 1,
                    'was_read' => 0,
                ]);
            }
        }
        $this->info('Sucesso');
    }
}
