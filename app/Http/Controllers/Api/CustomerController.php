<?php
namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\CustomerRequest;
use App\Http\Resources\CustomerResource;
use App\Http\Resources\CustomerCollection;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class CustomerController extends Controller
{
    // ✅ GET /api/customers
    public function index(Request $request)
    {
        $query = User::query();

        // Search
        if ($request->search) {
            $query->where(function ($q) use ($request) {
                $q->where('name', 'like', '%'.$request->search.'%')
                  ->orWhere('email', 'like', '%'.$request->search.'%')
                  ->orWhere('phone', 'like', '%'.$request->search.'%');
            });
        }

        // Sort
        $sortBy    = $request->sort_by    ?? 'created_at';
        $sortOrder = $request->sort_order ?? 'desc';
        $query->orderBy($sortBy, $sortOrder);

        $customers = $query->paginate($request->per_page ?? 15);

        return new CustomerCollection($customers);
    }

    // ✅ GET /api/customers/{id}
    public function show($id)
    {
        $customer = User::with('orders')->find($id);

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found.',
            ], 404);
        }

        return response()->json([
            'success' => true,
            'data'    => new CustomerResource($customer),
        ], 200);
    }

    // ✅ POST /api/customers
    public function store(CustomerRequest $request)
    {
        $customer = User::create([
            'name'     => $request->name,
            'email'    => $request->email,
            'password' => Hash::make($request->password),
            'phone'    => $request->phone,
            'address'  => $request->address,
        ]);

        return response()->json([
            'success' => true,
            'message' => 'Customer created successfully.',
            'data'    => new CustomerResource($customer),
        ], 201);
    }

    // ✅ PUT /api/customers/{id}
    public function update(CustomerRequest $request, $id)
    {
        $customer = User::find($id);

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found.',
            ], 404);
        }

        $data = $request->only(['name', 'email', 'phone', 'address']);

        if ($request->password) {
            $data['password'] = Hash::make($request->password);
        }

        $customer->update($data);

        return response()->json([
            'success' => true,
            'message' => 'Customer updated successfully.',
            'data'    => new CustomerResource($customer->fresh()),
        ], 200);
    }

    // ✅ DELETE /api/customers/{id}
    public function destroy($id)
    {
        $customer = User::find($id);

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found.',
            ], 404);
        }

        $customer->delete();

        return response()->json([
            'success' => true,
            'message' => 'Customer deleted successfully.',
        ], 200);
    }

    // ✅ GET /api/customers/{id}/orders
    public function orders($id)
    {
        $customer = User::find($id);

        if (!$customer) {
            return response()->json([
                'success' => false,
                'message' => 'Customer not found.',
            ], 404);
        }

        $orders = $customer->orders()->latest()->get();

        return response()->json([
            'success' => true,
            'data'    => [
                'customer'     => new CustomerResource($customer),
                'total_orders' => $orders->count(),
                'orders'       => $orders,
            ],
        ], 200);
    }

    // ✅ GET /api/customers/stats
    public function stats()
    {
        return response()->json([
            'success' => true,
            'data'    => [
                'total_customers'    => User::count(),
                'new_this_month'     => User::whereMonth('created_at', now()->month)->count(),
                'new_this_week'      => User::whereBetween('created_at', [now()->startOfWeek(), now()->endOfWeek()])->count(),
                'new_today'          => User::whereDate('created_at', today())->count(),
                'verified_customers' => User::whereNotNull('email_verified_at')->count(),
            ],
        ], 200);
    }
}