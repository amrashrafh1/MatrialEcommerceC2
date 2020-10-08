<?php

namespace App\Jobs;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use App\Coupon;
use App\User;
class CouponJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     *
     * @return void
     */
    public $data;
    public function __construct($data)
    {
        $this->data = $data;
    }

    /**
     * Execute the job.
     *
     * @return void
     */
    public function handle()
    {
        $data      = $this->data;
        $expire_at = (!empty($data['expire_at']))?$data['expire_at']:NULL;
        $quantity  = (!empty($data['quantity']))?$data['quantity']:NULL;
        $codeS     = \Promocodes::create($data['amount'], $data['reward'], [],$expire_at, $quantity);
        if(is_array($codeS->toArray())) {
            foreach($codeS as $code) {
                Coupon::where('code', $code['code'])->where('reward', $code['reward'])->first()->update([
                    'rules'   => (!empty($data['rules']))?$data['rules']:'all_users',
                    'is_usd'  => ($data['is_usd'] === 'is_usd')?1:0,
                    'user_id' => (!empty($data['user_id']) && !empty($data['rules']) && $data['rules'] == 'specific_user')?User::where('email', $data['user_id'])->first()->id:NULL
                ]);
            }
        } else {
            Coupon::where('code', $codeS['code'])->where('reward', $codeS['reward'])->first()->update([
                'rules'   => (!empty($data['rules']))?$data['rules']:'all_users',
                'is_usd'  => ($data['is_usd'] === 'is_usd') ? 1 : 0,
                'user_id' => (!empty($data['user_id']) && !empty($data['rules']) && $data['rules'] == 'specific_user')?User::where('email', $data['user_id'])->first()->id:NULL
            ]);
        }
    }
}
