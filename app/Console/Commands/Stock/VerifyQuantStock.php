<?php

namespace App\Console\Commands\Stock;

use App\Models\Notification;
use App\Models\Stock;
use App\Models\User;
use Illuminate\Console\Command;

class VerifyQuantStock extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:quantity-stock';

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
        // $stock = Stock::select('id','stock_quantity','min_quantity')->get()->toArray();
        $stock = Stock::select('id', 'product_name')
            ->whereColumn('stock_quantity', '<', 'min_quantity')
            ->get()
            ->toArray();
        $users = User::select('id')->where('profile_id', 1)->where('id_status', 1)->get();
        foreach ($stock as $item) {
            foreach ($users as $user) {
                Notification::create([
                    'user_id' => $user->id,
                    'title' => 'Produto em falta - '.$item['id'],
                    'body' => 'É necessário reabastecer o estoque de ' . $item['product_name'],
                    'is_alert' => 1,
                    'was_read' => 0,
                ]);
            }
        }
        $this->info('Sucesso');
    }
}
