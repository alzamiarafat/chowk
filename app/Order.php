<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    protected $table = 'orders';

    protected $fillable = ['fee', 'fee_value', 'static_fee', 'vatvalue','payment_info','mollie_payment_key','whatsapp_phone','name','email','phone','amount','transaction_id','currency', 'coupon_price', 'total_price'];

    public function restorant()
    {
        return $this->belongsTo(\App\Restorant::class);
    }

    public function driver()
    {
        return $this->hasOne(\App\User::class, 'id', 'driver_id');
    }

    public function table()
    {
        return $this->hasOne(\App\Tables::class, 'id', 'table_id');
    }

    public function address()
    {
        return $this->hasOne(\App\Address::class, 'id', 'address_id');
    }

    public function client()
    {
        return $this->hasOne(\App\User::class, 'id', 'client_id');
    }

    public function status()
    {
        return $this->belongsToMany(\App\Status::class, 'order_has_status', 'order_id', 'status_id')->withPivot('user_id', 'created_at', 'comment')->orderBy('order_has_status.id', 'ASC');
    }

    public function laststatus()
    {
        return $this->belongsToMany(\App\Status::class, 'order_has_status', 'order_id', 'status_id')->withPivot('user_id', 'created_at', 'comment')->orderBy('order_has_status.id', 'DESC')->limit(1);
    }

    public function stakeholders()
    {
        return $this->belongsToMany(\App\User::class, 'order_has_status', 'order_id', 'user_id')->withPivot('status_id', 'created_at', 'comment')->orderBy('order_has_status.id', 'ASC');
    }

    public function items()
    {
        return $this->belongsToMany(\App\Items::class, 'order_has_items', 'order_id', 'item_id')->withPivot(['qty', 'extras', 'vat', 'vatvalue', 'variant_price', 'variant_name']);
    }

    public function ratings()
    {
        return $this->belongsToMany(\App\Ratings::class, 'ratings', 'order_id', 'id');
    }

    public function getActionsAttribute()
    {
    }

    public function getSocialMessageAttribute($encode=false){
        $message = view('messages.social', ['order' => $this])->render();
        $message=str_replace('&#039;',"'",$message);
        if($encode){
            $message= urlencode($message);
            return $message;
        }
        return $message;
    }

    public function getTimeFormatedAttribute()
    {
        $parts = explode('_', $this->delivery_pickup_interval);
        if (count($parts) < 2) {
            return '';
        }

        $hoursFrom = (int) (($parts[0] / 60).'');
        $minutesFrom = $parts[0] - ($hoursFrom * 60);

        $hoursTo = (int) (($parts[1] / 60).'');
        $minutesTo = $parts[1] - ($hoursTo * 60);

        $format = 'G:i';
        if (config('settings.time_format') == 'AM/PM') {
            $format = 'g:i A';
        }
        $from = date($format, strtotime($hoursFrom.':'.$minutesFrom));
        $to = date($format, strtotime($hoursTo.':'.$minutesTo));

        return $from.' - '.$to;
    }

    public static function boot()
    {
        parent::boot();
        self::deleting(function (self $order) {
            //Delete Order items
            $order->items()->detach();
            
            //Delete Oders statuses
            $order->status()->detach();

            //Delete Oders ratings
            $order->ratings()->detach();

            return true;
        });
    }
}
