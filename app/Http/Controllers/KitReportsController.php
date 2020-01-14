<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KitReportsController extends Controller
{
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
        //
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

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function import(Request $request)
    {
        $document_name = $request->document_name;
        $sheet_data = $request->sheet_data;

        $current_user_id = null;
        $rows = 0;

        if (DB::select('select * from documents where document_name=?', [$document_name])) {
            return response()->json([
                'message' => 'Este archivo ya ha sido importado',
                'document' => $document_name,
                'rows' => $rows,
            ]);
        }

        for ($i = 1; $i < count($sheet_data); $i++) {
            $thisData = $sheet_data[$i];



            $user = DB::select('select id from users where upper(username) like upper("%' . $thisData['Autor'] . '%")');
            $current_user_id = $user ? $user[0]->id : null;

            $mod_user = DB::select('select id from users where upper(username) like upper("%' . $thisData['Modificado por'] . '%")');
            $mod_user_id = $mod_user ? $mod_user[0]->id : null;


            $order_type = DB::select('select id from report_type where value like "%' . $thisData['Clase de orden'] . '%"', [1]);
            $order_type_id = $order_type ? $order_type[0]->id : null;

            if ($current_user_id && $order_type) {
                $exc = DB::insert(
                    'INSERT INTO kit_reports
                ( client_id, pto_tbjo_resp, charge_key, user_status, report_type_id,
                order_number, `user_id`, kit_number, asset_fix, denomination, site_center,
                planning_center, `zone`, init_date, modification_date, extreme_end_date,
                entry_date, ctro_pto_trab, society, updated_id, center,
                planning_group, total_generated, short_text, pm_activity, created_at, updated_at)
                VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?, ?,?,?,?,?,?, ?,?,?,?, current_timestamp, current_timestamp)',
                    [
                        $thisData['Cliente'], $thisData['Pto.tbjo.resp.'], $thisData['Clave recargos'],
                        $thisData['Status usuario'], $order_type_id,  $thisData['Orden'], $current_user_id,
                        $thisData['Equipo'], $thisData['Activo fijo'], $thisData['Denominación'], $thisData['Ce.emplazam.'],
                        $thisData['Centro planif.'], $thisData['Emplazamiento'], $thisData['Fe.inic.extrema'],
                        $thisData['Fecha modific.'], $thisData['Fe.fin extrema'], $thisData['Fecha entrada'],
                        $thisData['Ctro.pto.trab.'], $thisData['Sociedad'], $mod_user_id, $thisData['Centro'],
                        $thisData['Grupo planif.'], $thisData['TotalGen.(real)'], $thisData['Texto breve'],
                        $thisData['Cl.actividad PM']
                    ]
                );

                $rows++;
            }
        }

        DB::insert('INSERT INTO documents
        (document_name, imported, created_at, updated_at)
        VALUES(?, ?, current_timestamp, current_timestamp)', [$document_name, $rows]);

        return response()->json([
            'message' => 'Datos importados. ',
            'document' => $document_name,
            'rows' => $rows,
        ]);
    }
}
