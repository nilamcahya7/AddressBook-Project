<?php

namespace App\Http\Controllers;

use App\Models\Contact;
use App\miniProject;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;

class AddressController extends Controller
{
    public function index(){
        $contacts = Contact::all();
        return response([
            'success' => true,
            'message' => 'List Contact',
            'data' => $contacts
        ], 200);
    }
    public function store(Request $request){
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ],[
            'name.required' => 'please enter name!',
            'address.required' => 'please enter address!',
            'phone.required' => 'please enter phone number!'
        ]);

        if($validator->fails()) {

            return response()->json([
                'success' => false,
                'message' => 'please fill in all forms',
                'data'    => $validator->errors()
            ], 400);

        }   else {
                $contacts = Contact::create([
                    'name' => $request->input('name'),
                    'address' => $request->input('address'),
                    'phone' => $request->input('phone')
                ]);
                
                if ($contacts) {
                    return response()->json([
                        'success'=> true,
                        'message' => 'Contact data entered successfully'
                    ]);
                }   else{
                    return response()->json([
                        'success' => false,
                        'message' => 'data failed to save'
                    ], 400);
                }
            }
            
    }
    public function show($id){
        $contacts = Contact::whereId($id)->first();

        if($contacts) {
            return response()->json([
                'success' => true,
                'message' => 'Data Contact',
                'data' => ($contacts)
            ], 200);
        }   else{
            return response()->json([
                'success' => false,
                'message' => 'data contact not found',
                'data' => ''
            ], 404);
        }
    }
    public function update(Request $request, $id){
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'address' => 'required',
            'phone' => 'required'
        ],[
            'name.required' => 'please enter name!',
            'address.required' => 'please enter address!',
            'phone.requires' => 'please enter phone number!'
        ]);

        if($validator->fails()){
            return response()->json([
                'success' => false,
                'message' => 'please fill in all forms',
                'data'    => $validator->errors()
            ], 400);
            
        }   else{
            $contacts =Contact::where('id', $id)->update([
                'name' => $request->input('name'),
                'address' => $request->input('address'),
                'phone' => $request->input('phone')
            ]);

            if($contacts) {
                return response()->json([
                    'success' => true,
                    'message' => 'Contact data updated successfully'
                ], 200);
            }   else{
                return response()->json([
                    'success' => false,
                    'message' => 'data failed to update'
                ], 500);
            }
        }
    }
    public function destroy($id){
        $contact = Contact::findOrFail($id);
        $contact->delete();

        if($contact){
            return response()->json([
                'success' => true,
                'message' => 'data contact deleted successfully'
            ], 200);
        }   else{
            return response()->json([
                'success' => false,
                'message' => 'data failed to delete'
            ], 500);
        }
    }
}

