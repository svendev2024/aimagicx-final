<?php

namespace App\Http\Controllers\Admin\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use DataTables;

class FAQController extends Controller
{
    /**
     * Show appearance settings page
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Faq::all()->sortByDesc("created_at");
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>                                            
                                            <a href="'. route("admin.settings.faq.edit", $row["id"] ). '"><i class="fa-solid fa-pencil-square table-action-buttons edit-action-button" title="Edit FAQ"></i></a>
                                            <a class="deleteFAQButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete FAQ"></i></a>
                                        </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span>'.date_format($row["created_at"], 'd M Y H:i:s').'</span>';
                        return $created_on;
                    })
                    ->addColumn('custom-status', function($row){
                        $custom_status = '<span class="cell-box faq-'.strtolower($row["status"]).'">'.ucfirst($row["status"]).'</span>';
                        return $custom_status;
                    })
                    ->rawColumns(['actions', 'custom-status', 'created-on'])
                    ->make(true);
                    
        }

        return view('admin.frontend.faq.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.frontend.faq.create');
    }


    /**
     * Store new faq in database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'question' => 'required',
            'status' => 'required',
            'answer' => 'required',
        ]);      

        $faq = Faq::create([
            'question' => $request->question,
            'status' => $request->status,
            'answer' => $request->answer,
        ]);

        toastr()->success(__('FAQ answer successfully created'));
        return redirect()->route('admin.settings.faq');
    }


    /**
     * Edit blog.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Faq $id)
    {
        return view('admin.frontend.faq.edit', compact('id'));
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
            'question' => 'required',
            'status' => 'required',
            'answer' => 'required',
        ]);

        $blog = Faq::where('id', $id)->firstOrFail();
        $blog->question = request('question');
        $blog->status = request('status');
        $blog->answer = request('answer');
        $blog->save();    

        toastr()->success(__('FAQ answer successfully updated'));
        return redirect()->route('admin.settings.faq');
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function delete(Request $request)
    {  
        if ($request->ajax()) {

            $faq = Faq::find(request('id'));

            if($faq) {

                $faq->delete();

                return response()->json('success');

            } else{
                return response()->json('error');
            } 
        }      
    }

}
