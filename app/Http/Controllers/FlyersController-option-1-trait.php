<?php

namespace App\Http\Controllers;

use App\Flyer;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Requests\FlyerRequest;
use App\Http\Controllers\Traits\AuthorizesUsers;
use Illuminate\Http\UploadedFile;

class FlyersController extends Controller
{
    use AuthorizesUsers;

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['show']]);

        //parent::__construct();
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //flash()->overlay('Welcome Aboard', 'Thank you for signing up!');

        return view('flyers.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  FlyerRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store(FlyerRequest $request)
    {
        // persist the flyer
        Flyer::create($request->all());

        // flash message
        flash()->success('Success', 'Flyer successfully created!');

        // redirect to landing page
        return redirect()->back(); // temporary
    }

    /**
     * Display the specified resource.
     *
     * @param  string  $zip
     * @param  string $street
     * @return \Illuminate\Http\Response
     */
    public function show($zip, $street)
    {
        $flyer = Flyer::locatedAt($zip, $street);

        return view('flyers.show', compact('flyer'));
    }

    /**
     * Apply a photo to the referenced flyer
     * 
     * @param string  $zip
     * @param string  $street
     * @param Request $request
     */
    public function addPhoto($zip, $street, Request $request)
    {
        $this->validate($request, [
            'photo' => 'required|mimes:jpg,jpeg,png,bmp'
        ]);

        if (! $this->userCreatedFlyer($request)) {
            return $this->unauthorized($request);
        }

        $photo = $this->makePhoto($request->file('photo'));

        $flyer = Flyer::locatedAt($zip, $street)->addPhoto($photo);
    }

    protected function userCreatedFlyer(Request $request)
    {
        return Flyer::where([
            'zip' => $request->zip,
            'street' => $request->street,
            'user_id' => \Auth::id()
        ])->exists();
    }

    /**
     * User is not authorized
     * 
     * @return redirect
     */
    protected function unauthorized(Request $request)
    {
        if ($request->ajax()) {
            return response(['message' => 'No Way!'], 403);
        }

        flash('No Way!');

        return redirect('/');
    }

    /**
     * Move uploaded file to filesystem and make thumbnail
     * 
     * @param  UploadedFile $file
     * @return [type]             [description]
     */
    public function makePhoto(UploadedFile $file)
    {
        // use named constructor
        return Photo::named($file->getClientOriginalName())
            ->move($file);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
