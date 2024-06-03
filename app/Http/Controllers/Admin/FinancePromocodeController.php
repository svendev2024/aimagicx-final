<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Controllers\Admin\LicenseController;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Models\Promocode;
use DataTables;

class FinancePromocodeController extends Controller
{
    private $api;

    public function __construct()
    {
        $this->api = new LicenseController();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        
        if ($request->ajax()) {
            $data = Promocode::all();          
            return Datatables::of($data)
                    ->addIndexColumn()
                    ->addColumn('actions', function($row){
                        $actionBtn = '<div>                                            
                                        <a href="'. route("admin.finance.promocodes.show", $row["id"] ). '"><i class="fa-solid fa-file-invoice-dollar table-action-buttons edit-action-button" title="View Promocode"></i></a>
                                        <a href="'. route("admin.finance.promocodes.edit", $row["id"] ). '"><i class="fa-solid fa-file-pen table-action-buttons view-action-button" title="Update Promocode"></i></a>
                                        <a data-toggle="modal" id="deleteSubscriptionButton" data-target="#deleteModal" href="" data-attr="'. route("admin.finance.promocodes.delete", $row["id"] ). '"><i class="fa-solid fa-trash-xmark table-action-buttons delete-action-button" title="Delete Promocode"></i></a>
                                    </div>';
                        return $actionBtn;
                    })
                    ->addColumn('name', function($row){
                        $value = json_decode($row['details'], true);
                        $name = '<span class="font-weight-bold">'.$value['name'].'</span>';
                        return $name;
                    })
                    ->addColumn('custom-code', function($row){
                        $name = '<span class="font-weight-bold text-info">'.$row['code'].'</span>';
                        return $name;
                    })
                    ->addColumn('type', function($row){
                        $value = json_decode($row['details'], true);
                        $value_type = ($value['type'] == 'percentage') ? __('Percentage Discount') : __('Fixed Discount');
                        $type = '<span>'.$value_type.'</span>';
                        return $type;
                    })
                    ->addColumn('custom-status', function($row){
                        $value = json_decode($row['details'], true);
                        $custom_priority = '<span class="cell-box promocode-'.strtolower($value['status']).'">'.ucfirst($value['status']).'</span>';
                        return $custom_priority;
                    })
                    ->addColumn('discount', function($row){
                        $value = json_decode($row['details'], true);
                        $discount = '<span>'.$value['discount'].'</span>';
                        return $discount;
                    })
                    ->rawColumns(['actions', 'custom-status', 'custom-code', 'name', 'type', 'discount'])
                    ->make(true);
                    
        }

        return view('admin.finance.promocodes.index');
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        return view('admin.finance.promocodes.create');
    }


    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        request()->validate([
            'promo-name' => 'required',
            'status' => 'required',
            'promo-type' => 'required',
            'discount' => 'required',
            'valid-until' => 'required',
        ]);

        $date = date("Y-m-d H:i:s", strtotime(request('valid-until')));
        $valid_until = Carbon::createFromDate($date);
        $now = Carbon::now();
        $expires_in_days = $valid_until->diffInDays($now);

        $total_quantity = (request('usage') == 1) ? 1 : request('quantity');

        // Promocode::create(
        //     $amount = 1,
        //     $reward = request('discount'),
        //     $data = [
        //         "name" => request('promo-name'),
        //         "status" => request('status'),
        //         "type" => request('promo-type'),
        //     ],
        //     $expires_in = $expires_in_days,
        //     $quantity = $total_quantity,
        //     $is_disposable = request('usage'),            
        // ); 

        // Promocode::create(
        //     $multi_use = 0,
        //     $usages_left = 1,


        //     $reward = request('discount'),
        //     $details = [
        //         "name" => request('promo-name'),
        //         "status" => request('status'),
        //         "type" => request('promo-type'),
        //     ],
        //     $expires_in = $expires_in_days,
        //     $quantity = $total_quantity,
        //     $is_disposable = request('usage'),            
        // ); 

        createPromocodes(
            multiUse: request('multi_use'), 
            count: 1, 
            usages: $total_quantity, 
            expiration:  $valid_until, 
            details: [ 
                'name' => request('promo-name'),
                'discount' => request('discount'),
                'status' => request('status'),
                'type' => request('promo-type'),
            ] 
        );
                         
        toastr()->success(__('New promocode has been created successfully'));
        return redirect()->route('admin.finance.promocodes');
    }


    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Promocode $id)
    {   
        $data = json_decode($id->details);

        return view('admin.finance.promocodes.show', compact('id', 'data'));
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Promocode $id)
    {
        $data = json_decode($id->details);

        return view('admin.finance.promocodes.edit', compact('id', 'data'));
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Promocode $id)
    {
        request()->validate([
            'promo-name' => 'required',
            'status' => 'required',
            'promo-type' => 'required',
            'discount' => 'required',
            'quantity' => 'required|integer',
            'valid-until' => 'required',
        ]);

        $data = [
            'name' => request('promo-name'),
            'status' => request('status'),
            'discount' => request('discount'),
            'type' => request('promo-type'),            
        ];

        $quantity =  request('quantity');

        $id->update([
            'usages_left' => request('quantity'),
            'multi_use' => request('multi_use'),
            'expired_at' => request('valid-until'),
            'details' => $data
        ]);

        toastr()->success(__('Selected promocode has been updated successfully'));
        return redirect()->route('admin.finance.promocodes');
    }

    
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $promocode = Promocode::where('id', $id)->firstOrFail();

        if($promocode) {
            $promocode->delete();
        }
    
        toastr()->success(__('Selected promocode was deleted successfully'));
        return redirect()->route('admin.finance.promocodes');          
    }


    public function delete($id)
    {   
        $promocode = Promocode::where('id', $id)->firstOrFail();

        return view('admin.finance.promocodes.delete', compact('promocode'));  
    }
}
