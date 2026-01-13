<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\CompanySetting;
use Illuminate\Http\Request;

class SettingController extends Controller
{
    public function edit()
    {
        // Get the first setting or create default if doesn't exist (though seeder should have handled it)
        $settings = CompanySetting::first();
        if (!$settings) {
            $settings = CompanySetting::create([
                'email' => 'admin@example.com',
                'phone' => '',
                'address' => '',
            ]);
        }
        return view('admin.settings.edit', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = CompanySetting::firstOrFail();

        $data = $request->validate([
            'email' => 'required|email|max:255',
            'phone' => 'nullable|string|max:255',
            'address' => 'nullable|string|max:500',
            'opening_hours' => 'nullable|string|max:500',
            'tiktok_url' => 'nullable|url|max:255',
            'instagram_url' => 'nullable|url|max:255',
            'facebook_url' => 'nullable|url|max:255',
        ]);

        $settings->update($data);

        return redirect()->route('admin.settings.edit')->with('success', 'Paramètres mis à jour avec succès.');
    }
}
