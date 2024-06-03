<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Setting;

class InvoiceController extends Controller
{
    /**
     * Display invoice settings
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoice_rows = ['invoice_currency', 'invoice_language', 'invoice_vendor', 'invoice_vendor_website', 'invoice_address', 'invoice_city', 'invoice_state', 'invoice_postal_code', 'invoice_country', 'invoice_phone', 'invoice_vat_number'];
        $invoice = [];
        $settings = Setting::all();

        foreach ($settings as $row) {
            if (in_array($row['name'], $invoice_rows)) {
                $invoice[$row['name']] = $row['value'];
            }
        }

        return view('admin.finance.invoice.index', compact('invoice'));
    }


    /**
     * Store invoice details in database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'invoice_vendor' => 'required',
        ]);

        $rows = ['invoice_currency', 'invoice_language', 'invoice_vendor', 'invoice_vendor_website', 'invoice_address', 'invoice_city', 'invoice_state', 'invoice_postal_code', 'invoice_country', 'invoice_phone', 'invoice_vat_number'];
        
        foreach ($rows as $row) {
            Setting::where('name', $row)->update(['value' => $request->input($row)]);
        }

        toastr()->success(__('Invoice settings successfully updated'));
        return redirect()->back();
    }
}