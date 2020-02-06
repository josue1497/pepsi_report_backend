<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;

class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $response = DB::select('select * from users where role_id not in (select id from roles where value  = "AD") and remember_token = "Y"');

        return response()->json([
            'data' => $response,
            'status' => '200'
        ]);
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
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        if (DB::select('select * from users where email = ? or username = ?
                        or identification_document = ?', [$request->email, $request->username,  $request->identification_document])) {
            return response()->json([
                'message' => 'Ya existe un usuario',
                'status' => '500',
                'email' =>   $request->email,
                'username' =>   $request->username

            ]);
        } else {
            if (DB::insert(
                'INSERT INTO users
            (identification_document, name, lastname, username, email,
            password, phone_number, remember_token, created_at, updated_at, role_id)
            VALUES(?, ?, ?, ?, ?, ?, ?, "N", current_timestamp ,current_timestamp, 2)',
                [
                    $request->identification_document, $request->name, $request->lastname,
                    $request->username, $request->email, Hash::make($request->password),
                    $request->phone_number
                ]
            )) {
                return response()->json([
                    'message' => 'Usuario registrado',
                    'status' => 200,
                    'data' =>   $request->email
                ]);
            } else {
                return response()->json([
                    'message' => 'Error registrando el Usuario',
                    'status' => 500,
                    'email' =>   $request->email,
                    'username' =>   $request->username
                ]);
            }
        }
        return response()->json([
            'message' => 'Store',
            'status' => 200,
            'data' =>   $request->email
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $user = DB::select('select * from users where id = ?', [$id]);
        if ($user) {

            $pass = ($request->password) ? ', password = ' . Hash::make($request->password) : '';

            if (DB::update(
                'update users set username = ?,
                name = ?, lastname = ?, email = ?,
                phone_number = ?, identification_document = ?' .
                    $pass . ' where id = ?',
                [
                    $request->username, $request->name, $request->lastname,
                    $request->email, $request->phone_number,
                    $request->identification_document, $id
                ]
            )) {
                return response()->json([
                    'message' => 'Usuario Actualizado',
                    'status' => 200
                ]);
            }
        } else {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 500
            ]);
        }
    }

    public function change_password(Request $request)
    {
        $new_pass = Hash::make($request->new_pass);
        $old_pass = $request->old_pass;

        $user_id = $request->user_id;

        $user = DB::select('select * from users where id = ?', [$user_id]);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 500
            ]);
        }

        if (!Hash::check($old_pass, $user[0]->password)) {
            return response()->json([
                'message' => 'Contraseña actual no coincide',
                'status' => 500
            ]);
        }

        if (DB::update(
            'update users set password = ? where id = ?',
            [
                $new_pass, $user_id
            ]
        )) {
            return response()->json([
                'message' => 'Usuario Actualizado',
                'status' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 500
            ]);
        }
    }

    public function reset_pass(Request $request)
    {
        $new_pass = Hash::make($request->new_pass);
        $user_id = $request->user_id;

        $user = DB::select('select * from users where id = ?', [$user_id]);

        if (!$user) {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 500
            ]);
        }

        if (DB::update(
            'update users set password = ? where id = ?',
            [
                $new_pass, $user_id
            ]
        )) {
            return response()->json([
                'message' => 'Usuario Actualizado',
                'status' => 200
            ]);
        } else {
            return response()->json([
                'message' => 'Usuario no encontrado',
                'status' => 500
            ]);
        }
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

    public function disable_or_enable_user(Request $request)
    {
        $user_id = $request->user_id;
        $value = $request->value;
        if (DB::update('update users set remember_token = ? where id = ?', [$value, $user_id])) {
            return response()->json([
                'message' => 'Activado',
                'status' => '200'
            ]);
        } else {
            return response()->json([
                'message' => 'Falla Actualizando Estatus del Usuario',
                'status' => '500',
                'user_id' => $user_id,
                'value' => $value,
            ]);
        }
    }
}
