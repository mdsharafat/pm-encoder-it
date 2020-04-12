<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Client;
use App\Platform;
use Illuminate\Http\Request;
use Carbon\Carbon;
use Illuminate\Http\File;
use Illuminate\Support\Str;

class ClientsController extends Controller
{
    public function index(Request $request)
    {
        $clients = Client::latest()->get();
        return view('admin.clients.index', compact('clients'));
    }

    public function create()
    {
        $platforms = Platform::all();
        $client    = new Client();
        return view('admin.clients.create', compact('client', 'platforms'));
    }

    public function store(Request $request)
    {    
        $client              = new Client();
        $client->name        = $request->name;
        $client->email       = $request->email;
        $client->skype       = $request->skype;
        $client->platform_id = $request->platform_id;
        $client->desc        = $request->desc;
        if ($request->hasfile('image')) {
            $image         = $request->file('image');
            $uploadPath    = 'storage/clients/';
            $client->image = $this->uploadImage($image, $uploadPath);
        }
        $client->save();
        return redirect('clients')->with('flashMessage', 'Client added!');
    }

    public function uploadImage($image, $uploadPath)
    {
        $now       = Carbon::now();
        $imageName = $now->year.$now->month.$now->day.$now->hour.$now->minute.$now->second.Str::random(10).'.'.$image->getClientOriginalExtension();
        $image->move($uploadPath, $imageName);
        return $imageName;
    }

    public function show($id)
    {
        $client = Client::findOrFail($id);
        return view('admin.clients.show', compact('client'));
    }

    public function edit($id)
    {
        $platforms = Platform::all();
        $client    = Client::findOrFail($id);
        return view('admin.clients.edit', compact('client', 'platforms'));
    }

    public function update(Request $request, $id)
    {   
        $client                     = Client::findOrFail($id);
        $requestData = array();
        $requestData['name']        = $request->name;
        $requestData['email']       = $request->email;
        $requestData['skype']       = $request->skype;
        $requestData['platform_id'] = $request->platform_id;
        $requestData['desc']        = $request->desc;
        if ($request->hasfile('image')) {
            if ($client->image) {
                $deleteImage = 'storage/clients/'.$client->image;
                unlink($deleteImage);
            }
            $image                = $request->file('image');
            $uploadPath           = 'storage/clients/';
            $requestData['image'] = $this->uploadImage($image, $uploadPath);
        }
        $client->update($requestData);
        return redirect('clients')->with('flashMessage', 'Client updated!');
    }

    public function destroy($id)
    {
        $client = Client::findOrFail($id);
        if ($client->image) {
            $deleteImage = 'storage/clients/'.$client->image;
            unlink($deleteImage);
        }
        Client::destroy($id);
        return redirect('clients')->with('flashMessage', 'Client deleted!');
    }
}
