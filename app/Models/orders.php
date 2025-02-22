<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Gloudemans\Shoppingcart\Facades\Cart;

use App\Models\orders;
use App\Models\Menu;

use App\Notifications;

use illuminate\support\Facades\Auth;

class orders extends Model
{
    protected $fillable=['total', 'status'];
    public function orderFields(){
        return $this->belongsToMany(Menu::class)->withPivot('qty', 'total');
    }

    public static function createOrder(){

        $user = Auth::user();
        $order = $user->orders()->create(['total'=>\Cart::getTotal(),'status'=>'pending']);

        $cartItems = \Cart::getContent();
        foreach($cartItems as $cartItem)

            $order->orderFields()->attach($cartItem->id,['qty'=>$cartItem->qty, 'total'=>\Cart::getTotal()]);


       }


    }

