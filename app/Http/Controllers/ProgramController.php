<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Client;
use App\Models\Program;
use RealRashid\SweetAlert\Facades\Alert;
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
        Alert::success('Client Created', 'Client created successfully.');
        return redirect()->back();  // Redirect back to show success
        //return response()->json(['message' => 'Client created successfully'], 201);
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

        Alert::success('Program Created', 'Program created successfully.');
        return redirect()->back();  // Redirect back to show success
        //return response()->json(['message' => 'Program created successfully'], 201);
    }
    //fetch all programs
    public function getPrograms()
    {
        $clients = Client::all();
        $programs = Program::all();
        return view('program', compact('clients','programs'));
    }

    // enroll a client in a program
    public function enrollClientInProgram(Request $request)
    {
        $validatedData = $request->validate([
            'client_id' => 'required|exists:clients,id',
            'program_id' => 'required|exists:programs,id',
        ]);

        $clientId = $validatedData['client_id'];
        $programId = $validatedData['program_id'];

        $client = Client::findOrFail($clientId);

        // Check if already enrolled
        if ($client->programs()->where('program_id', $programId)->exists()) {
            Alert::error('Enrollment Failed', 'Client is already enrolled.');
            return redirect()->back();  // Ensures the page reloads
        }

        // Attach (enroll)
        $client->programs()->attach($programId);

        Alert::success('Enrollment Successful', 'Client enrolled in program successfully.');
        return redirect()->back();  // Redirect back to show success
    }

    // unenroll a client from a program
    public function unenrollClientFromProgram($clientId, $programId)
    {
        // Find the client and program
        $client = Client::findOrFail($clientId);
        $program = Program::findOrFail($programId);

        // Check if enrolled
        if (!$client->programs()->where('program_id', $programId)->exists()) {
            return response()->json(['message' => 'Client is not enrolled in this program'], 409);
        }

        // Unenroll the client
        $client->programs()->detach($program->id);

        return response()->json(['message' => 'Client unenrolled from program successfully'], 200);
    }
    // get all clients in a program
    public function getClientsInProgram($programId)
    {
        // Find the program
        $program = Program::findOrFail($programId);

        // Get all clients in the program
        $clients = $program->clients;

        return response()->json($clients, 200);
    }
    //get client profile + with programs they are enrolled in
    public function getClientProfile($clientId)
    {
        // Find the client
        $client = Client::with('programs')->findOrFail($clientId);

        return response()->json($client, 200);
    }
    // get all programs a client is enrolled in

}
