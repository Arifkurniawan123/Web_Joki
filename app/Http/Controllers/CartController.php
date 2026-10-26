<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Service;

class CartController extends Controller
{
    public function index (){
        $cart=session()->get('cart',[]);
        $title='keranjang';

        return view('public.cart',compact('cart','title'));
    }

    public function add($slug){
        $service=Service::where('slug',$slug)->
        where('is_active',true)->firstOrFail();

        $cart=session()->get('cart',[]);

        if(isset($cart[$service->id])){
             return redirect()->back()->with('info', 'Layanan ini sudah ada di keranjang.');
            
        }

        $cart[$service->id]=[
            'service_id'    => $service->id,
            'game_id'       => $service->game_id,
            'name'          => $service->name,
            'game_name'     => $service->game->name ?? '-',
            'price'         => $service->price,
            'estimated_days'=> $service->estimated_days,
            'image'         => $service->image,
        ];

        session()->put('cart', $cart);

        return redirect()->route('cart.index')->with('success', 'Service ditambahkan ke keranjang.');
    }
      public function remove($id)
    {
        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            unset($cart[$id]);
            session()->put('cart', $cart);
        }

        return redirect()->route('cart.index')->with('success', 'Item dihapus dari keranjang.');
    }

    public function clear()
    {
        session()->forget('cart');

        return redirect()->route('cart.index')->with('success', 'Keranjang dikosongkan.');
    }

    
}
