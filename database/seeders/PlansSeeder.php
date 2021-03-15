<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class PlansSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(!config('settings.is_whatsapp_ordering_mode')){
            DB::table('plan')->insert([
                'name' => 'Free',
                'limit_items'=>30,
                'price'=>0,
                'paddle_id'=>'',
                'description'=>'If you run a small restaurant or bar, or just need the basics, this plan is great.',
                'features'=>'Full access to QR tool, Access to the menu creation tool, Unlimited views, 20 items in the menu, Community support',
                'created_at' => now(),
                'updated_at' => now(),
                'enable_ordering'=>2,
            ]);
    
            DB::table('plan')->insert([
                'name' => 'Starter',
                'limit_items'=>0,
                'price'=>9,
                'paddle_id'=>'',
                'description'=>'For bigger restaurants and bars. Offer a full menu. Limitless plan',
                'features'=>'Full access to QR tool, Access to the menu creation tool, Unlimited views, Unlimited items in the menu, Dedicated Support',
                'created_at' => now(),
                'updated_at' => now(),
                'enable_ordering'=>2,
            ]);
    
            DB::table('plan')->insert([
                'name' => 'Pro',
                'limit_items'=>0,
                'price'=>49,
                'paddle_id'=>'',
                'period'=>1,
                'description'=>'Accept orders direclty from your customer mobile phone',
                'features'=>'Accept Orders, Manage order, Full access to QR tool, Access to the menu creation tool, Unlimited views, Unlimited items in the menu, Dedicated Support',
                'created_at' => now(),
                'updated_at' => now(),
                'enable_ordering'=>1,
            ]);
        }else{
           
            
            DB::table('plan')->insert([
                'name' => 'Lite',
                'limit_items'=>0,
                'price'=>0,
                'paddle_id'=>'',
                'description'=>'Use it for free and upgrade as you grow',
                'features'=>'Full access to Menu Creation tool, Unlimited views, 30 items in the menu, Community support',
                'created_at' => now(),
                'updated_at' => now(),
                'enable_ordering'=>2,
            ]);
    
            DB::table('plan')->insert([
                'name' => 'Pro',
                'limit_items'=>0,
                'price'=>19,
                'paddle_id'=>'',
                'period'=>1,
                'description'=>'For growing business that needs more',
                'features'=>'Full access to Menu Creation tool, Unlimited views, Unlimited orders, Email support',
                'created_at' => now(),
                'updated_at' => now(),
                'enable_ordering'=>1,
            ]);
        }
    }
}
