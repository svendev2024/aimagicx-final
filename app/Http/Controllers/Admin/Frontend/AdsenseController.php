<?php

namespace App\Http\Controllers\Admin\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Advertisement;
use DataTables;

class AdsenseController extends Controller
{
    /**
     * Show appearance settings page
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Advertisement::all();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>                                            
                                            <a href="'. route("admin.settings.adsense.edit", $row["id"] ). '"><i class="fa-solid fa-pencil-square table-action-buttons edit-action-button" title="Edit FAQ"></i></a>
                                        </div>';
                        return $actionBtn;
                    })
                    ->addColumn('updated-on', function($row){
                        $created_on = '<span>'.date_format($row["updated_at"], 'd M Y H:i A').'</span>';
                        return $created_on;
                    })
                    ->addColumn('custom-type', function($row){
                        $type = '<span class="font-weight-bold">'.$row["type"].'</span>';
                        return $type;
                    })
                    ->addColumn('custom-status', function($row){
                        $status = ($row['status']) ? 'Activated' : 'Deactivated';
                        $custom_status = '<span class="cell-box adsense-'.strtolower($status).'">'. $status .'</span>';
                        return $custom_status;
                    })
                    ->rawColumns(['actions', 'custom-status', 'updated-on', 'custom-type'])
                    ->make(true);
                    
        }

        return view('admin.frontend.adsense.index');
    }


    /**
     * Edit blog.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Advertisement $id)
    {
        return view('admin.frontend.adsense.edit', compact('id'));
    }


    /**
     * Update blog post properly in database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        request()->validate([
            'code' => 'required',
            'status' => 'required',
        ]);

        $blog = Advertisement::where('id', $id)->firstOrFail();
        $blog->code = request('code');
        $blog->status = request('status');
        $blog->save();    

        toastr()->success(__('Google Adsense successfully updated'));
        return redirect()->route('admin.settings.adsense');
    }

}
