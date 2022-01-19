<?php

namespace App\Http\Controllers;

use App\Employee;
use Illuminate\Http\Request;
use DataTables;

class EmployeeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)

    {

//    $request = request()->all();

//    dd($request);
$data = Employee::latest()->get();
        if ($request->ajax()) {

            

            // dd($data);

            return Datatables::of($data)

                    ->addIndexColumn()

                    ->addColumn('action', function($row){

   

                           $btn = '<a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Edit" class="edit btn btn-success btn-sm editProduct">Edit</a>';

   

                           $btn = $btn.' <a href="javascript:void(0)" data-toggle="tooltip"  data-id="'.$row->id.'" data-original-title="Delete" class="btn btn-danger btn-sm deleteProduct">Delete</a>';

    

                            return $btn;

                    })

                    ->rawColumns(['action'])

                    ->make(true);

        }

      

        return view('Employee.employee',compact('data'));

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)

    {

        Employee::updateOrCreate(['id' => $request->employee_id],

                ['name' => $request->name, 'address' => $request->address,'mobile' => $request->mobile,'position' => $request->position]);        

   

        return response()->json(['success'=>'Product saved successfully.']);

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function show(Employee $employee)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function edit($id)

    {

        $employee = Employee::find($id);

        return response()->json($employee);

    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    // public function update(Request $request, Employee $employee)
    // {
        
    // }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Employee  $employee
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)

    {

        Employee::find($id)->delete();

     

        return response()->json(['success'=>'Emloyee deleted successfully.']);

    }
}
