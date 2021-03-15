<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class LandingPageSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $features = [
            ['title'=>'{"en":"Create your menu"}', 'description'=>'{"en":"Create your menu directly on our platform. Update anytime. Easy And Simple."}', 'image'=>asset('social').'/img/SVG/512/menu.svg'],
            ['title'=>'{"en":"Ordering via chat"}', 'description'=>'{"en":"You will receive the order on your WhatsApp. Continue the chat and finalize order"}', 'image'=>asset('social').'/img/SVG/512/chat.svg'],
            ['title'=>'{"en":"Payment methods"}', 'description'=>'{"en":"Accept Cash on Deliver or get paid directly via payment link. 20+ payment methods available."}', 'image'=>asset('social').'/img/SVG/512/money.svg'],
            ['title'=>'{"en":"Jumpstart to ordering"}', 'description'=>'{"en":"Just create your menu, and next thing you know, is receiving orders on your phone via WhatsApp."}', 'image'=>asset('social').'/img/SVG/512/ordering.svg'],
            ['title'=>'{"en":"Views & orders analytics"}', 'description'=>'{"en":"Get detailed report about your orders and earning. Track your business as it grows with us.."}', 'image'=>asset('social').'/img/SVG/512/analytics.svg'],
            ['title'=>'{"en":"Know your customers"}', 'description'=>'{"en":"You are creating a direct bound with your customers. Loyal customer, will know where to find you next time. "}', 'image'=>asset('social').'/img/SVG/512/customers.svg'],
        ];

        $testimonials = [
            ['title'=>'{"en":"Gabriel Martin"}', 'subtitle'=>'{"en":"Bistrot Paul Bert, France"}', 'description'=>'{"en":"We knew that we need tool like this one. And we finally found it. Managing orders faster than ever."}', 'image'=>asset('social').'/img/faces/christian.jpg'],
            ['title'=>'{"en":"Emma Müller "}', 'subtitle'=>'{"en":"Amador, Germany"}', 'description'=>'{"en":"No more 30% fee on food delivery platforms. This is super cheap platforms thant saved us ton of money.  "}', 'image'=>asset('social').'/img/faces/team-4.jpg'], 
            ['title'=>'{"en":"John Smith"}', 'subtitle'=>'{"en":"Brooklyn Taco, USA"}', 'description'=>'{"en":"We where previously chatting with customers on whatsapp so they can order. This is next level."}', 'image'=>asset('social').'/img/faces/michael.jpg'],
            ['title'=>'{"en":"Maxim Ivanov"}', 'subtitle'=>'{"en":"Babushka, Russia"}', 'description'=>'{"en":"Being able to pay directly in WhatsApp, is so great. And the best of all, money goes directly to us."}', 'image'=>asset('social').'/img/faces/team-1.jpg'],
            ['title'=>'{"en":"Alexandra Papadopulos"}', 'subtitle'=>'{"en":"Odyssey, Greece"}', 'description'=>'{"en":"They have the best digital menu creator. Together with the QR code generator it is best on market"}', 'image'=>asset('social').'/img/faces/team-3.jpg'],
            ['title'=>'{"en":"Maria Santos"}', 'subtitle'=>'{"en":"Brasa, Brazil"}', 'description'=>'{"en":"Orders from customers on Facebook, Instagram and web on Whatsapp. Can I ask for more!"}', 'image'=>asset('social').'/img/faces/team-2.jpg'],
        ];

        $processes = [
            ['title'=>'{"en":"For Customers ordering"}', 'description'=>'{"en":"The customer can find the link to the menu of the restaurant on Social platforms, word of mouth via friend or if they scan the QR. After they make their order with the online menu, they are able to send the order directly to Restaurant\'s WhatsApp."}','link_name'=>'Start now', 'link'=>''],
            ['title'=>'{"en":"For Restaurant owners"}', 'description'=>'{"en":"The process starts when they hear a new message sound on their WhatsApp. They, or a trained bot can ask questions for details for order and delivery address. The restaurant can also inform how much time will take to deliver the order."}','link_name'=>'Start now', 'link'=>''],
        ];

        foreach ($features as $key => $feature) {
            DB::table('posts')->insert([
                'post_type' => 'feature',
                'title' => $feature['title'],
                'description' => $feature['description'],
                'image' => $feature['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        foreach ($testimonials as $key => $testimonial) {
            DB::table('posts')->insert([
                'post_type' => 'testimonial',
                'title' => $testimonial['title'],
                'subtitle' => $testimonial['subtitle'],
                'description' => $testimonial['description'],
                'image' => $testimonial['image'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }

        foreach ($processes as $key => $process) {
            DB::table('posts')->insert([
                'post_type' => 'process',
                'title' => $process['title'],
                'description' => $process['description'],
                'link_name' => $process['link_name'],
                'link' => $process['link'],
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
