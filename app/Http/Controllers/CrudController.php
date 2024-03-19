<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Company;
use Datatables;
use PDF;

class CrudController extends Controller
{
    /**
    * Display a listing of the resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function index()
    {
        
        if(request()->ajax()) {
            return datatables()->of(Company::select('*'))
            ->addColumn('action', 'company.action')
            ->rawColumns(['action'])
            ->addIndexColumn()
            ->make(true);
        }

        return view('company.index');
    }


    /**
    * Show the form for creating a new resource.
    *
    * @return \Illuminate\Http\Response
    */
    public function create()
    {
        return view('company.create');
    }


    /**
    * Store a newly created resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @return \Illuminate\Http\Response
    */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'addres' => 'required',
            'department' => 'required',
        ]);

        $company = new Company;
        $company->name = $request->name;
        $company->email = $request->email;
        $company->addres = $request->addres;
        $company->department = $request->department;
        $company->save();
        
        return redirect()->route('company.index')
        ->with('success','Data has been saved');
    }



    /**
    * Display the specified resource.
    *
    * @param  \App\company  $company
    * @return \Illuminate\Http\Response
    */
    public function show(Company $company)
    {
        return view('company.show',compact('company'));
    } 



    /**
    * Show the form for editing the specified resource.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function edit(Company $company)
    {
        return view('company.edit',compact('company'));
    }



    /**
    * Update the specified resource in storage.
    *
    * @param  \Illuminate\Http\Request  $request
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function update(Request $request, $id)
    {
        
        $request->validate([
            'name' => 'required',
            'email' => 'required',
            'addres' => 'required',
            'department' => 'required'
        ]);

        $company = Company::find($id);
        $company->name = $request->name;
        $company->email = $request->email;
        $company->addres = $request->addres;
        $company->department = $request->department;
        $company->save();

        return redirect()->route('company.index')
        ->with('success','Data has been updated');
    }

// Generate PDF
    public function exportPDF() {

    $companies = Company::get();
      // retreive all records from db
    //   $company = Company::all();
      // share data to view
      $data = [
        'title' => 'domPDF in Laravel 10',
        'companies' => $companies
    ];
        $pdf = PDF::loadView('company.employee_export', $data);
        // return $pdf->download('data-employee.pdf');
        $namafile='employee.pdf';
        return $pdf->stream($namafile);

    }
    /**
    * Remove the specified resource from storage.
    *
    * @param  \App\Company  $company
    * @return \Illuminate\Http\Response
    */
    public function destroy(Request $request)
    {
        $com = Company::where('id',$request->id)->delete();
        return Response()->json($com);
    }
}
