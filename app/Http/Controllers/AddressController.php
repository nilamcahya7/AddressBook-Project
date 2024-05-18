<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index(Request $request) {
        $perPage = 10;
        $contacts = Contact::paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'List Contact',
            'data' => $contacts->items(),
            'current_page' => $contacts->currentPage(),
            'last_page' => $contacts->lastPage(),
            'total' => $contacts->total()
        ], 200);
    }

    public function store(Request $request) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'relationship' => 'required|in:Family,Friend,Colleague,Other',
            'gender' => 'required|in:Male,Female,Other',
            'status' => 'required|in:Active,Inactive',
        ], [
            'name.required' => 'please enter name!',
            'address.required' => 'please enter address!',
            'phone.required' => 'please enter phone number!',
            'relationship.required' => 'Please select relationship!',
            'gender.required' => 'Please select gender!',
            'status.required' => 'Please select status!',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'please fill in all forms',
                'data' => $validator->errors()
            ], 400);
        } else {
            $contacts = Contact::create([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'relationship' => $request->input('relationship'),
                'gender' => $request->input('gender'),
                'status' => $request->input('status')
            ]);

            if ($contacts) {
                return response()->json([
                    'success' => true,
                    'message' => 'Contact data entered successfully'
                ]);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'data failed to save'
                ], 400);
            }
        }
    }

    public function show($id) {
        $contacts = Contact::whereId($id)->first();

        if ($contacts) {
            return response()->json([
                'success' => true,
                'message' => 'Data Contact',
                'data' => $contacts
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data contact not found',
                'data' => ''
            ], 404);
        }
    }

    public function update(Request $request, $id) {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required',
            'relationship' => 'required|in:Family,Friend,Colleague,Other',
            'gender' => 'required|in:Male,Female,Other',
            'status' => 'required|in:Active,Inactive',
        ], [
            'name.required' => 'please enter name!',
            'address.required' => 'please enter address!',
            'phone.required' => 'please enter phone number!',
            'relationship.required' => 'Please select relationship!',
            'gender.required' => 'Please select gender!',
            'status.required' => 'Please select status!',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'please fill in all forms',
                'data' => $validator->errors()
            ], 400);
        } else {
            $contacts = Contact::where('id', $id)->update([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone'),
                'relationship' => $request->input('relationship'),
                'gender' => $request->input('gender'),
                'status' => $request->input('status')
            ]);

            if ($contacts) {
                return response()->json([
                    'success' => true,
                    'message' => 'Contact data updated successfully'
                ], 200);
            } else {
                return response()->json([
                    'success' => false,
                    'message' => 'data failed to update'
                ], 500);
            }
        }
    }

    public function destroy($id) {
        $contact = Contact::findOrFail($id);
        $contact->delete();

        if ($contact) {
            return response()->json([
                'success' => true,
                'message' => 'data contact deleted successfully'
            ], 200);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'data failed to delete'
            ], 500);
        }
    }

    public function search(Request $request) {
        $query = $request->input('query');
        $perPage = 10;
        $contacts = Contact::where('name', 'LIKE', "%{$query}%")
                            ->orWhere('address', 'LIKE', "%{$query}%")
                            ->orWhere('phone', 'LIKE', "%{$query}%")
                            ->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'data found in the database',
            'data' => $contacts->items(),
            'current_page' => $contacts->currentPage(),
            'last_page' => $contacts->lastPage(),
            'total' => $contacts->total()
        ], 200);
    }

    public function filter(Request $request) {
        $validator = Validator::make($request->all(), [
            'relationship' => 'in:Family,Friend,Colleague,Other',
            'gender' => 'in:Male,Female,Other',
            'status' => 'in:Active,Inactive',
        ]);

        if ($validator->fails()) {
            return response()->json([
                'success' => false,
                'message' => 'Validation error',
                'data' => $validator->errors()
            ], 400);
        }

        $query = Contact::query();
        if ($request->has('relationship')) {
            $query->where('relationship', $request->relationship);
        }
        if ($request->has('gender')) {
            $query->where('gender', $request->gender);
        }
        if ($request->has('status')) {
            $query->where('status', $request->status);
        }

        $perPage = 10;
        $contacts = $query->paginate($perPage);

        return response()->json([
            'success' => true,
            'message' => 'Data based on filters found',
            'data' => $contacts->items(),
            'current_page' => $contacts->currentPage(),
            'last_page' => $contacts->lastPage(),
            'total' => $contacts->total()
        ], 200);
    }
}
