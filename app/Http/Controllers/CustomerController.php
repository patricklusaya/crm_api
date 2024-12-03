<?php

namespace App\Http\Controllers;

use App\Models\Customer;
use Illuminate\Http\Request;

class CustomerController extends Controller
{
    public function store(Request $request)
    {
        // Validate the incoming request data
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:customers,email',
            'phone_number' => 'required|string|max:15',
            'address' => 'required|string|max:255'
        ]);
    
        // Create a new customer in the database
        $customer = Customer::create($validated);
    
        // Return a success response with customer data
        return response()->json([
            'message' => 'Customer created successfully.',
            'customer' => $customer
        ], 201);
    }
    

    

    public function index()
    {
        try {
            // Retrieve all customers
            $customers = Customer::all();

            // Return a successful JSON response with the data
            return response()->json([
                'message' => 'Customers retrieved successfully.',
                'customers' => $customers,
            ], 200);
        } catch (\Exception $e) {
            // Handle errors and return a failure response
            return response()->json([
                'message' => 'Failed to retrieve customers.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }

       // Update customer method
       public function update(Request $request, $id)
       {
           // Find customer by ID
           $customer = Customer::find($id);
   
           if (!$customer) {
               return response()->json([
                   'message' => 'Customer not found',
               ], 404);
           }
   
           // Validate the incoming request data
           $validated = $request->validate([
               'name' => 'required|string|max:255',
               'email' => 'required|email|unique:customers,email,' . $id,
               'phone_number' => 'required|string|max:15',
               'address' => 'required',
           ]);
   
           // Update the customer with validated data
           $customer->update($validated);
   
           // Return success response
           return response()->json([
               'message' => 'Customer updated successfully.',
               'customer' => $customer,
           ]);
       }
   
       // Destroy (delete) customer method
       public function destroy($id)
       {
           // Find the customer by ID
           $customer = Customer::find($id);
   
           if (!$customer) {
               return response()->json([
                   'message' => 'Customer not found',
               ], 404);
           }
   
           // Delete the customer
           $customer->delete();
   
           // Return success response
           return response()->json([
               'message' => 'Customer deleted successfully.',
           ]);
       }
}
