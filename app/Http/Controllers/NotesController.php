<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App;
use Auth;
use Validator;

class NotesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $notes = App\Note::selfAsOwner()->get();
        return view('home')
                ->with('notes', $notes);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('note.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request, App\Note $note)
    {
        $title = $request->get('title');
        $details = $request->get('details');

        $validator = Validator::make([
            'title' => $title,
            'details' => $details
        ], $note->rules());

        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }

        $note->title = $title;
        $note->details = $details;
        $note->user_id = Auth::user()->id;
        $note->save();

        $request->session()->flash('alert', [
            'success' => 'Note Created'
        ]);

        return redirect('note');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $note = App\Note::find($id);
        return view('note.show')
                ->with('note', $note);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $note = App\Note::find($id);
        return view('note.edit')
                ->with('note', $note);
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
        $title = $request->get('title');
        $details = $request->get('details');
        $note =  new App\Note;

        $validator = Validator::make([
            'title' => $title,
            'details' => $details,
            'note' => $id
        ], $note->updateRules());

        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }

        $note = App\Note::find($id);
        $note->title = $title;
        $note->details = $details;
        $note->user_id = Auth::user()->id;
        $note->save();

        $request->session()->flash('alert', [
            'success' => 'Note Updated'
        ]);

        return redirect('note');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Request $request, $id)
    {
        $note = new App\Note;
        
        $validator = Validator::make([
            'note' => $id
        ], $note->existRules());

        if($validator->fails())
        {
            return back()->withInput()->withErrors($validator);
        }

        $note = App\Note::find($id);
        $note->delete();

        $request->session()->flash('alert', [
            'success' => 'Note Removed'
        ]);

        return redirect('note');
    }
}
