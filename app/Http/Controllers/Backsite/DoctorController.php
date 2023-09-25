<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;

// Library
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

// request
use App\Http\Requests\Doctor\StoreDoctorRequest;
use App\Http\Requests\Doctor\UpdateDoctorRequest;

// model
use App\Models\MasterData\Specialist;
use App\Models\Operational\Doctor;

use Auth;
use Gate;

class DoctorController extends Controller
{
    /**
     * Create a new controller instance
     * 
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        abort_if(Gate::denies('doctor_access'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // for table grid
        $doctor = Doctor::orderBy('created_at', 'desc')->get();

        // for select2 dropdown
        $specialist = Specialist::orderBy('name', 'asc')->get();

        return view('pages.backsite.operational.doctor.index', compact('specialist', 'doctor'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return abort(404);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(StoreDoctorRequest $request)
    {
        // get all request from frontsite
        $data = $request->all();

        // $data_name = $data['name'] dapata menyimpan dalam variabel dlu

        // store to database
        $doctor = Doctor::create($data);

        // response with alert
        alert()->success('Success Created', 'Successfully added new doctor with id '.$doctor->id);
        
        return redirect()->route('backsite.doctor.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_show'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        return view('pages.backsite.operational.doctor.show', compact('doctor'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_edit'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        // for select2 dropdown
        $specialist = Specialist::orderBy('name', 'asc')->get();

        return view('pages.backsite.operational.doctor.edit', compact('doctor', 'specialist'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateDoctorRequest $request, Doctor $doctor)
    {
        // get all request from frontsite
        $data = $request->all();

        // update to database
        $doctor->update($data);
        
        // response with alert
        alert()->success('Success Updated', 'Successfully update doctor with id '.$doctor->id);
        
        return redirect()->route('backsite.doctor.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Doctor $doctor)
    {
        abort_if(Gate::denies('doctor_delete'), Response::HTTP_FORBIDDEN, '403 Forbidden');

        $doctor->delete();

        // response with alert
        alert()->success('Success Deleted', 'Successfully Deleted doctor with id '.$doctor->id);
        
        return back();
    }
}
