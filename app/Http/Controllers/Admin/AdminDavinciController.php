<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Services\Statistics\DavinciUsageService;
use App\Models\CustomTemplate;
use App\Models\Template;
use DataTables;

class AdminDavinciController extends Controller
{
    /**
     * Display Transfer Dashboard
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $year = $request->input('year', date('Y'));
        $month = $request->input('month', date('m'));

        $davinci = new DavinciUsageService($month, $year);

        $usage_data = [
            'free_current_month' => $davinci->getTotalFreeWordsCurrentMonth(),
            'paid_current_month' => $davinci->getTotalPaidWordsCurrentMonth(),
            'images_current_month' => $davinci-> getTotalImagesCurrentMonth(),
            'contents_current_month' => $davinci->getTotalContentsCurrentMonth(),
            'free_current_year' => $davinci->getTotalFreeWordsCurrentYear(),
            'paid_current_year' => $davinci->getTotalPaidWordsCurrentYear(),
            'images_current_year' => $davinci->getTotalImagesCurrentYear(),
            'contents_current_year' => $davinci->getTotalContentsCurrentYear(),
        ];
        
        $total_words_monthly = $davinci->getTotalWordsCurrentMonth(); 
        $total_words_yearly = $davinci->getTotalWordsCurrentYear();

        $chart_data['words_yearly'] = json_encode($davinci->getMonthlyWordsChart());
        $chart_data['words_monthly'] = json_encode($davinci->getDailyWordsChart());

        return view('admin.davinci.dashboard.index', compact('chart_data', 'usage_data', 'total_words_monthly', 'total_words_yearly'));
    }


    /**
     * Display Transfer Results
     *
     * @return \Illuminate\Http\Response
     */
    public function templates(Request $request)
    {
        if ($request->ajax()) {
            $data = Template::orderBy('group', 'asc')->get();
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>      
                                        <a class="editButton" id="' . $row["id"] . '" href="#"><i class="fa fa-edit table-action-buttons view-action-button" title="Edit Description"></i></a>      
                                        <a class="changeButton" id="' . $row["id"] . '"  type="' . $row['type'] . '" href="#"><i class="fa-solid fa-square-parking table-action-buttons request-action-button" title="Set Template Package"></i></a>
                                        <a class="newButton" id="' . $row["id"] . '" href="#"><i class="fa-solid fa-sparkles table-action-buttons edit-action-button" title="Set as New Template"></i></a>
                                        <a class="activateButton" id="' . $row["id"] . '" href="#"><i class="fa fa-check table-action-buttons request-action-button" title="Activate Template"></i></a>
                                        <a class="deactivateButton" id="' . $row["id"] . '" href="#"><i class="fa fa-close table-action-buttons delete-action-button" title="Deactivate Template"></i></a>  
                                    </div>';
                        
                        return $actionBtn;
                    })
                    ->addColumn('updated-on', function($row){
                        $created_on = '<span class="font-weight-bold">'.date_format($row["updated_at"], 'd M Y').'</span><br><span>'.date_format($row["updated_at"], 'H:i A').'</span>';
                        return $created_on;
                    })
                    ->addColumn('custom-name', function($row){
                        $user = '<div class="d-flex">
                                    <div class="template-edit mr-2">'. $row['icon'] .'</div>
                                    <div class="widget-user-name pt-1"><span class="font-weight-bold">'. $row['name'] .'</span></div>
                                </div>';
                        return $user;
                    }) 
                    ->addColumn('custom-package', function($row){
                        switch ($row['package']) {
                            case 'all':
                                $package = '<span class="cell-box plan-regular">' . __('Standard') .'</span>';
                                break;
                            case 'free':
                                $package = '<span class="cell-box plan-free">' . __('Free') .'</span>';
                                break;
                            case 'professional':
                                $package = '<span class="cell-box plan-professional">' . __('Professional') .'</span>';
                                break;
                            case 'premium':
                                $package = '<span class="cell-box plan-premium">' . __('Premium') .'</span>';
                                break;
                            default:
                                $package = '<span class="cell-box plan-regular">' . __('Standard') .'</span>';
                                break;
                        }                      
                        return $package;
                    })
                    ->addColumn('custom-new', function($row){
                        $icon = ($row['new']) ? '<i class="fa-solid fa-circle-check text-success fs-16"></i>' : '<i class="fa-solid fa-circle-xmark fs-16"></i>';
                        $custom_new = '<span class="font-weight-bold">'.$icon.'</span>';
                        return $custom_new;
                    })
                    ->addColumn('custom-status', function($row){
                        $status = ($row['status']) ? 'Active' : 'Deactive';
                        $custom_voice = '<span class="cell-box status-'.strtolower($status).'">'. $status.'</span>';
                        return $custom_voice;
                    })
                    ->rawColumns(['actions', 'updated-on', 'custom-name', 'custom-package', 'custom-status', 'custom-new'])
                    ->make(true);
                    
        }

        return view('admin.davinci.templates.index');
    }


    /**
     * Update the description.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function descriptionUpdate(Request $request)
    {   
        if ($request->ajax()) {

            if (request('type') == 'custom') {
                $template = CustomTemplate::where('id', request('id'))->firstOrFail();
            } else {
                $template = Template::where('id', request('id'))->firstOrFail();
            } 
            
            $template->update(['description' => request('name')]);
            return  response()->json('success');
        } 
    }


    /**
     * Activate template
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function templateActivate(Request $request)
    {
        if ($request->ajax()) {

            if (request('type') == 'custom') {
                $template = CustomTemplate::where('id', request('id'))->firstOrFail();
            } else {
                $template = Template::where('id', request('id'))->firstOrFail();
            }

            if ($template->status == true) {
                return  response()->json(true);
            }

            $template->update(['status' => true]);

            return  response()->json('success');
        }
    }


    /**
     * Activate all templates.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function templateActivateAll(Request $request)
    {
        if ($request->ajax()) {

            Template::query()->update(['status' => true]);

            return  response()->json('success');
        } 
    }


    /**
     * Deactivate template.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function templateDeactivate(Request $request)
    {
        if ($request->ajax()) {

            if (request('type') == 'custom') {
                $template = CustomTemplate::where('id', request('id'))->firstOrFail();
            } else {
                $template = Template::where('id', request('id'))->firstOrFail();
                
            } 

            if ($template->status == false) {
                return  response()->json(false);
            }

            $template->update(['status' => false]);

            return  response()->json('success');
        }
    }


     /**
     * Deactivate all templates.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function templateDeactivateAll(Request $request)
    {
        if ($request->ajax()) {

            Template::query()->update(['status' => false]);

            return  response()->json('success');
        }         
    }


    /**
     * Set new status
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function setNew(Request $request)
    {
        if ($request->ajax()) {

            if (request('type') == 'custom') {
                $template = CustomTemplate::where('id', request('id'))->firstOrFail();
            } else {
                $template = Template::where('id', request('id'))->firstOrFail();
            }

            if ($template->new) {
                $template->update(['new' => false]);
                return  response()->json(true);
            } else {
                $template->update(['new' => true]);
                return  response()->json('success');
            }

            
        }
    }


    /**
     * Assign pro package
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function assignPackage(Request $request)
    {
        if ($request->ajax()) {

            if (request('type') == 'custom') {
                $template = CustomTemplate::where('id', request('id'))->firstOrFail();
            } else {
                $template = Template::where('id', request('id'))->firstOrFail();
                
            } 

            $template->update(['package' => request('name')]);

            return  response()->json('success');
        }
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteTemplate(Request $request)
    {
        if ($request->ajax()) {

            $result = CustomTemplate::where('id', request('id'))->firstOrFail();  

            if ($result->user_id == auth()->user()->id){

                $result->delete();

                return response()->json('success');    
    
            } else{
                return response()->json('error');
            } 
        }              
    }

}
