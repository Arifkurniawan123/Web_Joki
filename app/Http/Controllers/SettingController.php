<?php

namespace App\Http\Controllers;

use App\Models\Setting;
use App\Validation\SettingValidation; // ← IMPORT VALIDASI
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function index()
    {
        $settings = Setting::all_as_array();
        $title = 'Pengaturan Web';

        return view('admin.setting.index', compact('settings', 'title'));
    }

    public function update(Request $request)
    {
        // PAKAI VALIDASI BARU
        $request->validate(
            SettingValidation::rules(),
            SettingValidation::messages()
        );

        $data = $request->except(['_token', '_method']);

        foreach ($data as $key => $value) {
            Setting::updateOrCreate(
                ['key' => $key],
                ['value' => $value]
            );
        }

        return redirect()->route('admin.setting.index')->with('success', 'Pengaturan berhasil disimpan.');
    }
}