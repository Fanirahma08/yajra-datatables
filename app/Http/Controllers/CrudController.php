<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Models\Company;
use Illuminate\View\View;
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

     // Generate PDF by id
    public function exportId($id)
    {
        // Get data by id
        $companies = Company::find($id);
        // dd($companies->email);
        // share data to view
        $data = [
            'companies' => $companies
            ];
        $pdf = PDF::loadView('company.export_id', $data);
        
        // Download PDF
        // $namefile=$companies->name.'.pdf';
        // return $pdf->download($namafile);

        $namefile=$companies->name.'.pdf';
        // dd($namefile);
        return $pdf->stream($namefile);
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
    public function exportPDF()
    {
        // Get All data
        $companies = Company::get();
        // share data to view
        $data = [
                'companies' => $companies
                ];
        $pdf = PDF::loadView('company.employee_export', $data);
        // return $pdf->download('data-employee.pdf');
        $namefile='employee.pdf';
        return $pdf->stream($namefile);
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
