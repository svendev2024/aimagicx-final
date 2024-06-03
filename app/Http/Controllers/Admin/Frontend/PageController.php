<?php

namespace App\Http\Controllers\Admin\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Page;

class PageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $information_rows = ['privacy', 'terms'];
        $information = [];
        $pages = Page::all();

        foreach ($pages as $row) {
            if (in_array($row['name'], $information_rows)) {
                $information[$row['name']] = $row['value'];
            }
        }

        return view('admin.frontend.page.index', compact('information'));
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'privacy' => 'nullable',
            'terms' => 'nullable',
        ]);

        $rows = ['privacy', 'terms'];        
        foreach ($rows as $row) {
            Page::where('name', $row)->update(['value' => $request->input($row)]);
        }

        toastr()->success(__('Content successfully saved'));
        return redirect()->back();
    }

}
