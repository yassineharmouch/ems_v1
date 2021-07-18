<?php

namespace App\Http\Controllers;
use App\Offre;
use Illuminate\Http\Request;

use Illuminate\Http\UploadedFile;
use App\Http\Requests\offreRequest;
use Illuminate\Support\Facades\Auth;

class Offrecontroller extends Controller
{
    public function __construct(){
        $this->middleware('auth');   
     }
   
    public function index() {
        
       // if(Auth::user()->role_id===3) {
            $listeoffre = Offre::all();
       // }else{
         //   $listeoffre = Auth::user()->offres; 
        //}
        return view('offre/index', ['offres' => $listeoffre]);

    }
    public function create() {
        
        //$this->authorize('create', 'App\Offre');  

        return view('offre.create');
    }

    public function store(offreRequest $request) {
        $offre = new Offre();
        $offre->titre = $request->input('titre');
        $offre->description = $request->input('description');
       // $offre->user_id = Auth::user()->id;

        if( $request->hasFile('photo') ) {

            $file=$request->file('photo');
            $filename= time().'.'.$file->getClientOriginalExtension();
             $request->photo->move('storage/images/', $filename);
             $offre->photo= $filename;
        }
        
        $offre->save();
        session()->flash('success' , 'l\'offre à été bien enregistré !!');
        return redirect('offres');
     
    }

    public function edit ($id) {
        $offre = Offre::find ($id);
       // $this->authorize('update',$offre);
        return view('offre.edit', [ 'offre' => $offre ]);

     
        
    }
    public function update(Request $request , $offre) {
        $offre = Offre::find($offre);
       // dd($offre);
        $offre->titre = $request->input('titre');
        $offre->description = $request->input('description');

        if( $request->hasFile('photo') ) {
            $file=$request->file('photo');
            $filename= time().'.'.$file->getClientOriginalExtension();
             $request->photo->move('storage/images/', $filename);
             $offre->photo= $filename;
           
        }
        $offre->save();

        $request->session()->flash('success','l\'offre a été bien modifié' );
        return redirect('offres');
   
    }

    public function destroy(Request $request ,$id) {
        $offre = Offre::find($id);
        $offre->delete();
        //$this->authorize('delete',$offre);
        $request->session()->flash('success','l\'offre a été bien supprimé' );

        return redirect ('offres');
        
    }



    public function show($id) {
        $offre = Offre::find($id);
        return view('offre.show', ['offre' => $offre]);
    }


}