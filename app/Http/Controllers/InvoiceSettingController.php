<?php

namespace App\Http\Controllers;

use App\Models\InvoiceSetting;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class InvoiceSettingController extends Controller
{
    public function edit()
    {
        $settings = InvoiceSetting::first();
        return view('invoices.settings', compact('settings'));
    }

    public function update(Request $request)
    {
        $settings = InvoiceSetting::first();

        $data = $request->validate([
            'company_name' => 'required|string',
            'company_phone' => 'nullable|string',
            'company_address' => 'nullable|string',
            'logo' => 'nullable|image',
            'footer_text' => 'nullable|string'
        ]);

        if ($request->hasFile('logo')) {
            $data['logo'] = $request->file('logo')->store('invoice_logo','public');
        }

        $settings->update($data);

        return redirect()->back()->with('success', 'Paramètres mis à jour !');
    }
}