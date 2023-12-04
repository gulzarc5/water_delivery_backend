<?php

namespace App\Console\Commands;

use App\Services\SubscriptionOrderService;
use Illuminate\Console\Command;

class CheckOrder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Order:Check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Subscreiption Order Check And Place Order If User is Subscribed';

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
        $order = new SubscriptionOrderService();
        $order->Check();  
    }
}
