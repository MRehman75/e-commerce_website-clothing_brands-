<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Requests\Api\StoreTransactionRequest;
use App\Http\Requests\Api\UpdateTransactionRequest;
use App\Http\Resources\TransactionResource;
use App\Models\Transaction;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class TransactionController extends Controller
{
    /**
     * GET /api/transactions
     */
    public function index(Request $request)
    {
        $query = Transaction::with('order', 'user');

        // Filter by status
        if ($request->filled('status')) {
            $query->where('status', $request->status);
        }

        // Filter by payment_method
        if ($request->filled('payment_method')) {
            $query->where('payment_method', $request->payment_method);
        }

        // Filter by user
        if ($request->filled('user_id')) {
            $query->where('user_id', $request->user_id);
        }

        // Filter by order
        if ($request->filled('order_id')) {
            $query->where('order_id', $request->order_id);
        }

        // Search by transaction_id
        if ($request->filled('search')) {
            $query->where('transaction_id', 'like', '%' . $request->search . '%');
        }

        $query->orderBy('created_at', 'desc');
        $perPage = min((int) $request->get('per_page', 15), 100);

        return TransactionResource::collection($query->paginate($perPage));
    }

    /**
     * POST /api/transactions
     */
    public function store(StoreTransactionRequest $request): JsonResponse
    {
        $data = $request->validated();

        // Auto transaction_id generate karo
        $data['transaction_id'] = $data['transaction_id']
            ?? 'TXN-' . strtoupper(Str::random(10));

        $transaction = Transaction::create($data);

        return response()->json([
            'message' => 'Transaction ban gayi!',
            'data'    => new TransactionResource($transaction->load('order', 'user')),
        ], 201);
    }

    /**
     * GET /api/transactions/{id}
     */
    public function show(Transaction $transaction): JsonResponse
    {
        return response()->json([
            'data' => new TransactionResource($transaction->load('order', 'user')),
        ]);
    }

    /**
     * PUT /api/transactions/{id}
     */
    public function update(UpdateTransactionRequest $request, Transaction $transaction): JsonResponse
    {
        $transaction->update($request->validated());

        return response()->json([
            'message' => 'Transaction update ho gayi!',
            'data'    => new TransactionResource($transaction->fresh('order', 'user')),
        ]);
    }

    /**
     * DELETE /api/transactions/{id}
     */
    public function destroy(Transaction $transaction): JsonResponse
    {
        $transaction->delete();

        return response()->json([
            'message' => 'Transaction delete ho gayi!',
        ]);
    }

    /**
     * PATCH /api/transactions/{id}/status
     * Sirf status update karo
     */
    public function updateStatus(Request $request, Transaction $transaction): JsonResponse
    {
        $request->validate([
            'status' => 'required|in:pending,completed,failed,refunded',
        ]);

        $transaction->update(['status' => $request->status]);

        return response()->json([
            'message' => "Transaction status '{$request->status}' ho gayi!",
            'data'    => new TransactionResource($transaction->fresh('order', 'user')),
        ]);
    }

    /**
     * GET /api/transactions/stats
     * Transaction statistics
     */
    public function stats(): JsonResponse
    {
        $stats = [
            'total'     => Transaction::count(),
            'completed' => Transaction::where('status', 'completed')->count(),
            'pending'   => Transaction::where('status', 'pending')->count(),
            'failed'    => Transaction::where('status', 'failed')->count(),
            'refunded'  => Transaction::where('status', 'refunded')->count(),
            'total_amount'     => (float) Transaction::where('status', 'completed')->sum('amount'),
            'refunded_amount'  => (float) Transaction::where('status', 'refunded')->sum('amount'),
        ];

        return response()->json(['data' => $stats]);
    }
}