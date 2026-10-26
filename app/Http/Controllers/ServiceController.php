<?php

namespace App\Http\Controllers;

use App\Models\Game;
use App\Models\Service;
use App\Validation\ServiceValidation;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class ServiceController extends Controller
{
    public function index()
    {
        $services = Service::with('game')->orderBy('sort_order')->orderBy('name')->get();
        $title = 'Data Service';

        return view('admin.service.index', compact('services', 'title'));
    }

    public function create()
    {
        $games = Game::orderBy('sort_order')->orderBy('name')->get();
        $title = 'Tambah Service';

        return view('admin.service.create', compact('title', 'games'));
    }

    public function store(Request $request)
    {
        $validated = $request->validate(
            ServiceValidation::rules(),
            ServiceValidation::messages()
        );

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        Service::create($validated);

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
        $games   = Game::orderBy('sort_order')->orderBy('name')->get();
        $title   = 'Edit Service';

        return view('admin.service.edit', compact('title', 'service', 'games'));
    }

    public function update(Request $request, $slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();

        $validated = $request->validate(
            ServiceValidation::rules($service->id),
            ServiceValidation::messages()
        );

        $validated['slug'] = $validated['slug'] ?: Str::slug($validated['name']);
        $validated['is_active'] = $request->has('is_active');
        $validated['sort_order'] = $validated['sort_order'] ?? 0;

        $service->update($validated);

        return redirect()->route('admin.service.index')->with('success', 'Service berhasil diupdate.');
    }

    public function destroy($slug)
    {
        $service = Service::where('slug', $slug)->firstOrFail();
        $service->delete();

        return redirect()->route('admin.service.index')->with('success', 'Service berhasil dihapus.');
    }
}