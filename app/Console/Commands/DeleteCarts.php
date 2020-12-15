<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use DB;
use App\Jobs\DeleteCartItems;
use Treestoneit\ShoppingCart\Models\Cart;

class DeleteCarts extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'delete_carts';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'delete carts more than 90 days';

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
     * @return mixed
     */
    public function handle()
    {
        $carts = Cart::whereMonth('created_at', '<=',\Carbon\Carbon::now()->subMonths(3))
        ->orderBy('id', 'asc')->chunk(50, function ($cart) {
            dispatch(new DeleteCartItems($cart));
        });
    }
}
