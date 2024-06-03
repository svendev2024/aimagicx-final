<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\URL;
use Illuminate\Http\Request;
use App\Models\Content;
use Yajra\DataTables\DataTables;


class SearchController extends Controller
{
    /**
     * Show search results
     */
    public function index(Request $request)
    {
        $results = Content::where('user_id', Auth::user()->id)->where( 'title', 'LIKE', '%' . $request->keyword . '%' )->orWhere( 'input_text', 'LIKE', '%' . $request->keyword . '%' )->orWhere( 'result_text', 'LIKE', '%' . $request->keyword . '%' )->latest()->get();

        $data = Datatables::of($results)
            ->addIndexColumn()
            ->addColumn('actions', function($row){
                $actionBtn = '<div>
                                    <a href="'. route("user.documents.show", $row["id"] ). '"><i class="fa-solid fa-file-lines table-action-buttons edit-action-button" title="View Document"></i></a>
                                    <a class="deleteResultButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Document"></i></a> 
                                </div>';
                return $actionBtn;
            })
            ->addColumn('created-on', function($row){
                $created_on = '<span class="font-weight-bold">'.date_format($row["created_at"], 'd M Y').'</span><br><span>'.date_format($row["created_at"], 'H:i A').'</span>';
                return $created_on;
            })
            ->addColumn('custom-title', function($row){
                $custom = '<a class="font-weight-bold" href="'. route("user.documents.show", $row["id"] ). '">'.ucfirst($row["title"]).'</a>'; 
                return $custom;
            })
            ->addColumn('custom-template', function($row){
                $custom = '<span class="font-weight-bold">'.ucfirst($row["template_name"]).'</span>';
                return $custom;
            })
            ->addColumn('custom-language', function($row) {
                $language = '<span class="vendor-image-sm overflow-hidden"><img class="mr-2" src="' . URL::asset($row['language_flag']) . '">'. $row['language_name'] .'</span> ';            
                return $language;
            })
            ->rawColumns(['actions', 'created-on', 'custom-language', 'custom-title', 'template_name'])
            ->make(true);
        

        $searchValue = $request->keyword;
        $data = json_encode($data);

        return view('user.search.index', compact('searchValue', 'data'));
    }

}
