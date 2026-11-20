<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function index()
    {
        $customers = Customer::orderBy('id')->get();

        return view('customers.index', [
            'title' => 'Customer Accounts',
            'customers' => $customers,
        ]);
    }

    public function create()
    {
        return view('customers.create', ['title' => 'Create Customer']);
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
        ]);

        Customer::create($data);

        return redirect()->route('customers');
    }

    public function edit(Customer $customer)
    {
        return view('customers.edit', [
            'title' => 'Edit Customer',
            'customer' => $customer,
        ]);
    }

    public function update(Request $request, Customer $customer)
    {
        $data = $request->validate([
            'full_name' => 'required|string|max:100',
            'email' => 'required|email|max:100',
            'phone' => 'nullable|string|max:20',
        ]);

        $customer->update($data);

        return redirect()->route('customers');
    }
}
