<?php

namespace App\Http\Controllers;

use App\Models\Race;
use Illuminate\Http\Request;

use App\DataTables\RacesDataTable;

class RaceController extends Controller
{

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware(['auth', 'verified']);
    }

    /**
     * Rotta per la visualizzazione della lista delle razze nel backend
     *
     * @param  mixed $request
     * @return void
     */
    public function getAdminList(RacesDataTable $dataTable)
    {
        $this->authorize('viewAny', Race::class);

        return $dataTable->render('admin.race.list');
    }


    /**
     * Restituisce la pagina di creazione / modifica della razza
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function getAdminEdit(Request $request, $id = null)
    {
        $race = Race::find($id);
        if(is_null($race)){
            $race = new Race();
            $newRace = true;
            $this->authorize('create', $race);
        }else{
            $newRace = false;
            $this->authorize('update', $race);
        }

        return view('admin.race.edit', [
            'race' => $race,
            'isNew' => $newRace
        ]);
    }



    /**
     * Salvataggio dei dati della razza
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function postAdminEdit(Request $request, $id = null)
    {

        $race = Race::find($id);
        if (is_null($race)) {
            $race = new Race();
            $newRace = true;
            $this->authorize('create', $race);
        } else {
            $newRace = false;
            $this->authorize('update', $race);
        }

        $validatedData = $this->validate($request, [
            'name' => 'required',
            'name_plural' => 'required',
            'name_male' => 'required',
            'name_female' => 'required'
        ]);

        $race->name = $validatedData['name'];
        $race->name_plural = $validatedData['name_plural'];
        $race->name_male = $validatedData['name_male'];
        $race->name_female = $validatedData['name_female'];

        $race->active = $request->has('active');
        $race->avaible_registration = $request->has('avaible_registration');

        $race->url = $request->get('url');
        $race->description = $request->get('description');

        if ($request->hasFile('icon')) {
            $pathFileImage = $request->file('icon')->store('race/icons');
            $race->icon= $pathFileImage;
        }

        if ($request->hasFile('image')) {
            $pathFileImage = $request->file('image')->store('race/images');
            $race->image = $pathFileImage;
        }


        $race->save();
        return redirect()->route('admin.race.edit', $race->id)->with('success', 'Razza salvata con successo');
    }
}
