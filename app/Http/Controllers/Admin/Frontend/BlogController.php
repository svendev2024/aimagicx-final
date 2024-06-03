<?php

namespace App\Http\Controllers\Admin\Frontend;

use App\Http\Controllers\Controller;
use Illuminate\Http\UploadedFile;
use Illuminate\Http\Request;
use Illuminate\Support\Str;
use App\Models\Blog;
use DataTables;

class BlogController extends Controller
{
    /**
     * Show appearance settings page
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        if ($request->ajax()) {
            $data = Blog::all()->sortByDesc("created_at");
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>                                            
                                            <a href="'. route("admin.settings.blog.edit", $row["id"] ). '"><i class="fa-solid fa-pencil-square table-action-buttons edit-action-button" title="Edit Blog"></i></a>
                                            <a class="deleteBlogButton" id="'. $row["id"] .'" href="#"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Blog"></i></a>
                                        </div>';
                        return $actionBtn;
                    })
                    ->addColumn('created-on', function($row){
                        $created_on = '<span>'.date_format($row["created_at"], 'd M Y H:i:s').'</span>';
                        return $created_on;
                    })
                    ->addColumn('custom-status', function($row){
                        $custom_status = '<span class="cell-box blog-'.strtolower($row["status"]).'">'.ucfirst($row["status"]).'</span>';
                        return $custom_status;
                    })
                    ->addColumn('custom-author', function($row){
                        $custom_author = '<span class="font-weight-bold">'.$row["created_by"].'</span>';
                        return $custom_author;
                    })
                    ->rawColumns(['actions', 'custom-status', 'created-on', 'custom-author'])
                    ->make(true);
                    
        }

        return view('admin.frontend.blog.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.frontend.blog.create');
    }


    /**
     * Store blog post properly in database
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        request()->validate([
            'title' => 'required',
            'status' => 'required',
            'image' => 'required',
            'content' => 'required',
        ]);

        if (request()->has('image')) {

            request()->validate([
                'image' => 'required|image|mimes:jpg,jpeg,png,bmp,tiff,gif,svg,webp|max:10048'
            ]);
            
            $image = request()->file('image');
            $name = Str::random(10);         
            $folder = 'img/blogs/';
            
            $this->uploadImage($image, $folder, 'public', $name);

            $path = $folder . $name . '.' . request()->file('image')->getClientOriginalExtension();
        }

        if (request('url')) {
            $slug = request('url');
        } else {
            $slug = $this->slug(request('title'));
        }        

        $blog = Blog::create([
            'created_by' => auth()->user()->name,
            'title' => $request->title,
            'url' => $slug,
            'status' => $request->status,
            'keywords' => $request->keywords,
            'image' => $path,
            'body' => $request->content,
        ]);

        toastr()->success(__('Blog successfully created'));
        return redirect()->route('admin.settings.blog');
    }


    /**
     * Edit blog.
     *
     * @return \Illuminate\Http\Response
     */
    public function edit(Blog $id)
    {
        return view('admin.frontend.blog.edit', compact('id'));
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
            'title' => 'required',
            'status' => 'required',
            'content' => 'required',
        ]);

        if (request()->has('image')) {

            request()->validate([
                'image' => 'nullable|image|mimes:jpg,jpeg,png,bmp,tiff,gif,svg,webp|max:10048'
            ]);
            
            $image = request()->file('image');
            $name = Str::random(10);         
            $folder = 'img/blogs/';
            
            $this->uploadImage($image, $folder, 'public', $name);

            $path = $folder . $name . '.' . request()->file('image')->getClientOriginalExtension();

        } else {
            $path = '';
        }

        if (request('url')) {
            $slug = request('url');
        } else {
            $slug = '';
        } 

        $blog = Blog::where('id', $id)->firstOrFail();
        $blog->title = request('title');
        $blog->url = ($slug != '') ? $slug : $blog->url;
        $blog->image = ($path != '') ? $path : $blog->image;
        $blog->status = request('status');
        $blog->keywords = request('keywords');
        $blog->body = request('content');
        $blog->save();    

        toastr()->success(__('Blog successfully updated'));
        return redirect()->route('admin.settings.blog');
    }


    /**
     * Upload logo images
     */
    public function uploadImage(UploadedFile $file, $folder = null, $disk = 'public', $filename = null)
    {
        $name = !is_null($filename) ? $filename : Str::random(5);

        $file->storeAs($folder, $name .'.'. $file->getClientOriginalExtension(), $disk);
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

            $blog = Blog::find(request('id'));

            if($blog) {

                $blog->delete();

                return response()->json('success');

            } else{
                return response()->json('error');
            } 
        }  
    }


    /**
     * Create clean blog slug
     *
     */
    public function slug($text){ 

        // replace non letter or digits by -
        $text = preg_replace('~[^\\pL\d]+~u', '-', $text);
      
        // trim
        $text = trim($text, '-');
      
        // transliterate
        $text = iconv('utf-8', 'us-ascii//TRANSLIT', $text);
      
        // lowercase
        $text = strtolower($text);
      
        // remove unwanted characters
        $text = preg_replace('~[^-\w]+~', '', $text);
      
        if (empty($text))
        {
          return 'n-a';
        }
      
        return $text;
    }

}
