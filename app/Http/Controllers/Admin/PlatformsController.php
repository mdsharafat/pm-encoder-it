<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Platform;
use Illuminate\Http\Request;

class PlatformsController extends Controller
{
    public function index(Request $request)
    {
        $keyword = $request->get('search');
        $perPage = 25;

        if (!empty($keyword)) {
            $platforms = Platform::where('name', 'LIKE', "%$keyword%")
                ->orWhere('ratings', 'LIKE', "%$keyword%")
                ->latest()->paginate($perPage);
        } else {
            $platforms = Platform::latest()->paginate($perPage);
        }

        return view('admin.platforms.index', compact('platforms'));
    }

    public function create()
    {
        return view('admin.platforms.create');
    }

    public function store(Request $request)
    {
        
        $requestData = $request->all();
        
        Platform::create($requestData);

        return redirect('platforms')->with('flash_message', 'Platform added!');
    }

    public function show($id)
    {
        $platform = Platform::findOrFail($id);

        return view('admin.platforms.show', compact('platform'));
    }

    public function edit($id)
    {
        $platform = Platform::findOrFail($id);

        return view('admin.platforms.edit', compact('platform'));
    }

    public function update(Request $request, $id)
    {
        
        $requestData = $request->all();
        
        $platform = Platform::findOrFail($id);
        $platform->update($requestData);

        return redirect('platforms')->with('flash_message', 'Platform updated!');
    }

    public function destroy($id)
    {
        Platform::destroy($id);

        return redirect('platforms')->with('flash_message', 'Platform deleted!');
    }
}
