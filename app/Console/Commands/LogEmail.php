<?php

namespace App\Console\Commands;

use App\Jobs\SendOrderEmail;
use App\Models\Order;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;

class LogEmail extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'log:email';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Send email from redis queue';

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
        Log::info("Cron is working fine!");
        $order = Order::findOrFail( rand(1,50) );
        SendOrderEmail::dispatch($order);

        Log::info('Dispatched order ' . $order->id);
        return 0;
    }
}
