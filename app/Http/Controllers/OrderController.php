<?php
// Controller 4: OrderController.php
namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\DB;

class OrderController extends Controller
{
    public function index(): JsonResponse
    {
        $orders = Order::with(['customer', 'orderItems.product'])->get();
        return response()->json($orders);
    }

    public function show($id): JsonResponse
    {
        $order = Order::with(['customer', 'orderItems.product'])->find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }
        return response()->json($order);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'customer_id' => 'required|exists:customers,customer_id',
            'order_date' => 'required|date',
            'status' => 'required|string',
            'items' => 'required|array|min:1',
            'items.*.product_id' => 'required|exists:products,product_id',
            'items.*.quantity' => 'required|integer|min:1',
            'items.*.price' => 'required|integer|min:0'
        ]);

        DB::beginTransaction();
        try {
            $totalAmount = array_sum(array_map(function($item) {
                return $item['quantity'] * $item['price'];
            }, $validated['items']));

            $order = Order::create([
                'customer_id' => $validated['customer_id'],
                'order_date' => $validated['order_date'],
                'total_amount' => $totalAmount,
                'status' => $validated['status']
            ]);

            foreach ($validated['items'] as $item) {
                OrderItem::create([
                    'order_id' => $order->order_id,
                    'product_id' => $item['product_id'],
                    'quantity' => $item['quantity'],
                    'price' => $item['price']
                ]);
            }

            DB::commit();
            return response()->json($order->load(['customer', 'orderItems.product']), 201);
        } catch (\Exception $e) {
            DB::rollback();
            return response()->json(['message' => 'Failed to create order'], 500);
        }
    }

    public function update(Request $request, $id): JsonResponse
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $validated = $request->validate([
            'status' => 'string',
            'order_date' => 'date'
        ]);

        $order->update($validated);
        return response()->json($order->load(['customer', 'orderItems.product']));
    }

    public function destroy($id): JsonResponse
    {
        $order = Order::find($id);
        if (!$order) {
            return response()->json(['message' => 'Order not found'], 404);
        }

        $order->delete();
        return response()->json(['message' => 'Order deleted successfully']);
    }
}