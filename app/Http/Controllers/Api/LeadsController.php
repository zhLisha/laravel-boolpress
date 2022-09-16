<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Mail;
use App\Mail\LeadsContact;
use App\Lead;

class LeadsController extends Controller
{
    public function store(Request $request) {
        $data = $request->all();

        $message = [
            'name.required' => 'Attenzione, controlla il nome inserito.',
            'email.required' => 'Attenzione, controlla l\'email inserita.',
            'message.required' => 'Attenzione, controlla il messaggio inserito, non può superare i 50000 caratteri.'
        ];
        
        $validator = Validator::make($data, [
            'name' => 'required|max:255',
            'email' => 'required|max:255',
            'message' => 'required|max:50000',
        ], $message);

        if($validator->fails()) {
            return response()->json([
                'success' => false,
                'errors' => $validator->errors($message)
            ]);
        }

        $new_lead = new Lead();
        $new_lead->fill($data);
        $new_lead->save();

        Mail::to($data['email'])->send(new LeadsContact);

        return response()->json([
            'success' => true
        ]);
    }

}
