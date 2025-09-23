<?php

namespace App\Console\Commands\Notifications;

use App\Models\Notification;
use App\Models\Stock;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Console\Command;

class ClearNotification extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'command:clear-notification';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Limpar tabela de notificações';

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
        // Obtém a data de 7 dias atrás
        $dataLimite = Carbon::now()->subDays(7);

        // Busca as notificações que foram lidas
        $notificacoes = Notification::where('was_read', 1)
            ->where('created_at', '<', $dataLimite)
            ->get();

        foreach ($notificacoes as $notificacao) {
            $notificacao->delete();
        }
        $this->info('Sucesso');
    }
}
