<?php

namespace App\Http\Controllers;
use App\Models\Game;
use App\Models\Service;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller{
    public function index()
    {
        $services = Service::orderBy('sort_order')->orderBy('name')->get();
        $title = 'Data Service';

        return view('admin.service.index', compact('services', 'title'));
    }

    public function create()
    {
        
        $games = Game::orderBy('sort_order')->orderBy('name')->get();
        $title = 'Tambah Service';

        return view('admin.service.create', compact('title','games'));
    }

    public function store(Request $request)
    {
        Service::create([
            'game_id'        => $request->game_id,
            'name'           => $request->name,
            'slug'           => $request->slug ?: Str::slug($request->name),
            'description'    => $request->description,
            'price'          => $request->price,
            'estimated_days' => $request->estimated_days,
            'image'          => $request->image,
            'is_active'      => $request->has('is_active'),
            'sort_order'     => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.service.index')->with('success', 'Service berhasil ditambahkan.');
    }

    public function show($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $title = 'Detail Service';

        return view('admin.service.show', compact('title', 'service'));
    }

    public function edit($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $games = Game::orderBy('sort_order')->orderBy('name')->get();
        $title = 'Edit Service ';

        return view('admin.service.edit', compact('title', 'games','service'));
    }

    public function update(Request $request, $slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        $service->update([
            'game_id'        => $request->game_id,
            'name'           => $request->name,
            'slug'           => $request->slug ?: Str::slug($request->name),
            'description'    => $request->description,
            'price'          => $request->price,
            'estimated_days' => $request->estimated_days,
            'image'          => $request->image,
            'is_active'      => $request->has('is_active'),
            'sort_order'     => $request->sort_order ?? 0,
        ]);

        return redirect()->route('admin.service.index')->with('success', 'Service berhasil diupdate.');
    }

    public function destroy($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $service->delete();

        return redirect()->route('admin.service.index')->with('success', 'Service berhasil dihapus.');
    }

    //
}




  