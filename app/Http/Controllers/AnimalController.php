<?php

namespace App\Http\Controllers;

use App\Models\Animal;
use Illuminate\Http\Request;
use App\Http\Requests;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;
use Illuminate\Support\Facades\Gate;

class AnimalController extends Controller
{
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
        $animal = DB::table('animals')->orderBy('name')->paginate(10);

        return view('animals.index', ["animals"=>$animal]);
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
     * @param  \App\Http\Requests\StoreAnimalRequest  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
            $data = request()->validate([
                'name' => 'required',
                'scientific_name' => 'required',
                'status' => 'required',
                'image' => ['required','image'],
            ]);

            $imagePath = (request('image')->store('uploads', 'public'));

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200,1200);
            $image->save();

            Animal::create([
                'name' => $data['name'],
                'scientific_name' => $data['scientific_name'],
                'status' => $data['status'],
                'image' => $imagePath,

        ]);

            return redirect("/animals")->with('success','Uspješno ste dodali životinju.');

    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function show(Animal $animal)
    {
        return view('animals.animal',
            compact('animal')
        );
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function edit(Animal $animal)
    {
        if(auth()->user()->role !== "Admin"){
            return abort('403', "Niste admin!");
        }
        return view("animals.editanimal", compact('animal'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\UpdateAnimalRequest  $request
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {

        $animal = Animal::find($id);

        $request->validate([
            'name' => 'required',
            'scientific_name' => 'required',
            'status' => 'required',
        ]);

        $animal->name = $request->input('name');
        $animal->scientific_name = $request->input('scientific_name');
        $animal->status = $request->input('status');

        if (request()->hasFile('image')) {
            $imagePath = request('image')->store('uploads', 'public');

            $image = Image::make(public_path("storage/{$imagePath}"))->fit(1200, 1200);
            $image->save();

            $animal->image = $imagePath;

        }

        $animal->update();

        return redirect("/animal{$animal->id}")->with('success', 'Uspješno ste uredili informacije.');

    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Animal  $animal
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $animal = Animal::find($id);

        if (auth()->user()->role !== 'Admin' && !(Gate::allows('delete-posts'))) {
            abort('403', "Niste admin!");
        }

        DB::table('animals')->where("id", $id)->delete();
        return redirect('/animals')->with('success', 'Uspješno ste obrisali životinju');
    }
}
