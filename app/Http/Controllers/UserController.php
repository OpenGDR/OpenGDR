<?php

namespace App\Http\Controllers;

use App\DataTables\UsersDataTable;
use App\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rule;

class UserController extends Controller
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
     * @param Request $request
     * @return \Illuminate\Contracts\Foundation\Application|\Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function settings(Request $request)
    {
        return view('user.settings', [
            'user' => $request->user()
        ]);
    }

    /**
     * Metodo POST per l'aggiornamento della password
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     * @throws \Illuminate\Validation\ValidationException
     */
    public function updatePassword(Request $request)
    {
        $user = $request->user();
        $this->authorize('update', $user);

        $this->validate($request, [
            'current-password' => ['required', function ($attribute, $value, $fail) use ($user) {
                if (!Hash::check($value, $user->password)) {
                    return $fail(__('La password attuale non è esatta'));
                }
            }],
            'password' => ['required', 'string', 'min:8', 'confirmed']
        ]);

        $user->password = Hash::make($request->password);
        $user->save();

        return redirect()->route('user.settings')->with('updatepassword', true);
    }


    /**
     * Funzione per la cancellazione dell'utente
     *
     * @param  mixed $request
     * @return void
     */
    public function deleteUser(Request $request)
    {
        $user = $request->user();

        $this->authorize('update', $user);

        $user->email = 'deleted' . Str::uuid();
        $user->deleted_at = Carbon::now();
        //todo: aggiunta eliminazione e sostituzione dati personaggi (ad esempio sostituire il nome aggiungendo [utente cancellato])


        $user->save();

        Auth::logout();

        return redirect()->route('login')->with('success', 'Utente cancellato correttamente!');
    }


    /**
     * Aggiornamento dei dati dell'utente
     *
     * @param  mixed $request
     * @return void
     */
    public function updateUser(Request $request)
    {
        $user  = $request->user();

        $this->authorize('update', $user);

        $validationRule = [
            'email' => [
                'required',
                'email',
                Rule::unique('users', 'email')->ignore($user->id),
            ],
            'name' => '',
            'surname' => '',
            'date_of_birth' => '',
            'motto' => '',
            'description' => ''
        ];
        if(!is_null($request->get('date_of_birth'))){
            $validationRule['date_of_birth'] = 'date_format:Y-m-d';
        }
        $validatedData = $this->validate($request, $validationRule);


        foreach ($validatedData as $key => $value) {
            $user->{$key} = $value;
        }
        $user->save();

        return redirect()->route('user.settings')->with('updateinfo', true);
    }


    /**
     * Rotta per la visualizzazione della lista delle razze nel backend
     *
     * @param  mixed $request
     * @return void
     */
    public function getAdminList(UsersDataTable $dataTable)
    {
        $this->authorize('viewAny', User::class);

        return $dataTable->render('admin.user.list');
    }


    /**
     * Restituisce la pagina di visualizzazione utente
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function getAdminEdit(Request $request, $id = null)
    {
        $user = User::find($id);
        if (is_null($user)) {
            return abort(404);
        }

        $this->authorize('update', $user);

        return view('admin.user.edit', [
            'user' => $user
        ]);
    }

    /**
     * Salvataggio dei dati utente
     *
     * @param  mixed $request
     * @param  mixed $id
     * @return void
     */
    public function postAdminEdit(Request $request, $id = null)
    {

        $user = User::find($id);
        if (is_null($user)) {
            return abort(404);
        }

        switch($request->get('action', null)){
            case 'ban':
                $this->authorize('banUser', $user);
                $user->banned = true;
                $user->banned_at = Carbon::now();
                $user->save();
                return redirect()->route('admin.user.edit', $user->id)->with('success', 'Utente bannato con successo');
            break;
            case 'unban':
                $this->authorize('unbanUser', $user);
                $user->banned = false;
                $user->banned_at = null;
                $user->save();
                return redirect()->route('admin.user.edit', $user->id)->with('success', 'Ban utente rimosso con successo');
                break;
        }

        return redirect()->route('admin.user.edit', $user->id);
    }


    public function getBannedPage(Request $request)
    {

        return view('user.banned');
    }
}
