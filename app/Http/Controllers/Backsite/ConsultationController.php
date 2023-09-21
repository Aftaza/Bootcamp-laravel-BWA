<?php

namespace App\Http\Controllers\Backsite;

use App\Http\Controllers\Controller;

// Library
use Illuminate\Support\Facades\Storage;
use Symfony\Component\HttpFoundation\Response;

// request
use App\Http\Requests\Consultation\StoreConsultationRequest;
use App\Http\Requests\Consultation\UpdateConsultationRequest;

// model
use App\Models\MasterData\Consultation;

use Auth;

class ConsultationController extends Controller
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
        $consultation = Consultation::orderBy('created_at', 'desc')->get();
        
        return view('pages.backsite.master-data.consultation.index', compact('consultation'));
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
    public function store(StoreConsultationRequest $request)
    {
        // get data from frontsite
        $data = $request->all();

        // store record to database
        $consultation = Consultation::create($data);

        // response with alert
        alert()->success('Success Created', 'Successfully added new consultation with id '.$consultation->id);
        
        return redirect()->route('backsite.consultation.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Consultation $consultation)
    {
        return view('pages.backsite.master-data.consultation.index', compact('consultation'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Consultation $consultation)
    {
        return view('pages.backsite.master-data.consultation.index', compact('consultation'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateConsultationRequest $request, Consultation $consultation)
    {
        // get data from frontsite
        $data = $request->all();

        // store record to database
        $consultation->Consultation::update($data);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Consultation $consultation)
    {
        $consultation->forceDelete();

        // response with alert
        alert()->success('Success Deleted', 'Successfully Deleted consultation with id '.$consultation->id);
        
        return back();
    }
}
