<?php

// Controller 1: CustomerController.php
namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;
use Illuminate\Http\JsonResponse;

class CustomerController extends Controller
{
    public function index(): JsonResponse
    {
        $customers = Customer::all();
        return response()->json($customers);
    }

    public function show($id): JsonResponse
    {
        $customer = Customer::with('orders')->find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }
        return response()->json($customer);
    }

    public function store(Request $request): JsonResponse
    {
        $validated = $request->validate([
            'name' => 'required|string|max:50',
            'email' => 'required|email|max:50|unique:customers',
            'password' => 'required|string|max:50',
            'phone' => 'required|date',
            'address' => 'required|date'
        ]);

        $customer = Customer::create($validated);
        return response()->json($customer, 201);
    }

    public function update(Request $request, $id): JsonResponse
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $validated = $request->validate([
            'name' => 'string|max:50',
            'email' => 'email|max:50|unique:customers,email,' . $id . ',customer_id',
            'password' => 'string|max:50',
            'phone' => 'date',
            'address' => 'date'
        ]);

        $customer->update($validated);
        return response()->json($customer);
    }

    public function destroy($id): JsonResponse
    {
        $customer = Customer::find($id);
        if (!$customer) {
            return response()->json(['message' => 'Customer not found'], 404);
        }

        $customer->delete();
        return response()->json(['message' => 'Customer deleted successfully']);
    }
}