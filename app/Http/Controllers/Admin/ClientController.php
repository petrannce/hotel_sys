<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use App\Models\Client;
use App\Models\User;

class ClientController extends Controller
{
    public function index()
    {
        $clients = User::where('role', 'client')->get();
        return view('admin.client.index', compact('clients'));
    }

    public function create()
    {
        return view('admin.client.create');
    }

    public function store(Request $request)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'client_id' => 'required',
            'phone' => 'required|digits:10',
        ]);

        DB::beginTransaction();

        try {
            $client = new Client();
            $client->fname = $request->fname;
            $client->lname = $request->lname;
            $client->username = $request->username;
            $client->email = $request->email;
            $client->password = Hash::make($request->password);
            $client->client_id = $request->client_id;
            $client->phone = $request->phone;
            $client->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', $e->getMessage());
        }

        return redirect()->route('client.index')->with('success', 'Client created successfully.');
    }

    public function edit($id)
    {
        $client = Client::find($id);
        return view('admin.client.edit', compact('client'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'fname' => 'required',
            'lname' => 'required',
            'username' => 'required',
            'email' => 'required',
            'password' => 'required',
            'client_id' => 'required',
            'phone' => 'required',
        ]);

        DB::beginTransaction();

        try {
            $client = Client::find($id);
            $client->fname = $request->fname;
            $client->lname = $request->lname;
            $client->username = $request->username;
            $client->email = $request->email;
            $client->password = Hash::make($request->password);
            $client->client_id = $request->client_id;
            $client->phone = $request->phone;
            $client->save();

            DB::commit();
        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->route('client.index')->with('error', $e->getMessage());
        }

        return redirect()->route('client.index')->with('success', 'Client updated successfully.');
    }

    public function destroy($id)
    {
        $client = Client::find($id);
        $client->delete();
        return redirect()->route('client.index')->with('success', 'Client deleted successfully.');
    }

    public function latestId()
    {
        $lastClient = Client::orderBy('client_id', 'desc')->first();
        $lastClientId = $lastClient ? $lastClient->client_id : null;

        return response()->json([
            'client_id' => $lastClientId,
        ]);
    }

    public function report(Request $request)
    {
        $query = Client::query();

        if ($request->from_date) {
            $query->whereDate('created_at', '>=', $request->from_date);
        }
        if ($request->to_date) {
            $query->whereDate('created_at', '<=', $request->to_date);
        }

        $clients = $query->latest()->paginate(10);

        return view('admin.client.reports', [
            'clients' => $clients,
            'canExport' => true
        ]);
    }

}