<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use App\Models\Carts;

class LoginController extends Controller
{
    use AuthenticatesUsers;

    protected $redirectTo = '/';

    public function authenticated(Request $request, $user)
    {
        // Get session cart
        $sessionCart = session()->get('cart', []);

        if (!empty($sessionCart)) {

            foreach ($sessionCart as $item) {

                $existingItem = Carts::where('user_id', $user->id)
                    ->where('product_id', $item['id'])
                    ->where('size', $item['size'] ?? null)
                    ->where('color', $item['color'] ?? null)
                    ->first();

                if ($existingItem) {

                    $existingItem->quantity += $item['quantity'];
                    $existingItem->save();

                } else {

                    Carts::create([
                        'user_id' => $user->id,
                        'product_id' => $item['id'],
                        'quantity' => $item['quantity'],
                        'size' => $item['size'] ?? null,
                        'color' => $item['color'] ?? null,
                    ]);
                }
            }

            session()->forget('cart');
        }

        if ($user->is_admin) {
            return redirect()->intended(route('admin.dashboard'));
        }

        return redirect()->intended(route('customer.dashboard'));
    }


    public function __construct()
    {
        $this->middleware('guest')->except('logout');
        $this->middleware('auth')->only('logout');
    }
}