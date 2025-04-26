<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Program;
class ProgramController extends Controller
{

    // create clients and post them to the database
    // create a new client
    public function createClient(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|max:255',
            'phone' => 'required|string|max:15',
        ]);

        // Create a new client
        $client = new Client();
        $client->name = $validatedData['name'];
        $client->email = $validatedData['email'];
        $client->phone = $validatedData['phone'];
        $client->save();

        return response()->json(['message' => 'Client created successfully'], 201);
    }

    //fetch all clients
    public function getClients()
    {
        $clients = Client::all();
        return view('dashboard', compact('clients'));
    }

    // create a new program
    public function createProgram(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string|max:1000',
        ]);

        // Create a new program
        $program = new Program();
        $program->name = $validatedData['name'];
        $program->description = $validatedData['description'];
        $program->save();

        return response()->json(['message' => 'Program created successfully'], 201);
    }
    //fetch all programs
    public function getPrograms()
    {
        $programs = Program::all();
        return view('program', compact('programs'));
    }

}
