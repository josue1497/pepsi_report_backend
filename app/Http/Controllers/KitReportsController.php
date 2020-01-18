<?php

namespace App\Http\Controllers;

use Exception;
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
        $total_rows = $request->total_rows;
        $sheet_data = $request->sheet_data;

        $current_user_id = null;
        $rows = 0;
        $updated = 0;


        $document_exist = false;

        $document = DB::select('select * from documents where document_name=?', [$document_name]);

        if (count($document) > 0) {
            $document_exist = true;
            if ($document[0]->imported >= $total_rows) {
                return response()->json([
                    'message' => 'Este archivo ya ha sido importado',
                    'document' => $document_name,
                    'rows' => $rows,
                    'updated' => $updated,
                ]);
            }
        }

        if ($document_name) {
            for ($i = 1; $i < count($sheet_data); $i++) {
                $thisData = $sheet_data[$i];

                try {

                    $user = DB::select('select id from users where upper(username) like upper("%' . $thisData['Autor'] . '%")');
                    $current_user_id = $user ? $user[0]->id : null;

                    $mod_user = DB::select('select id from users where upper(username) like upper("%' . $thisData['Modificado por'] . '%")');
                    $mod_user_id = $mod_user ? $mod_user[0]->id : null;

                    $order_type = DB::select('select id from report_type where value like "%' . $thisData['Clase de orden'] . '%"', [1]);
                    $order_type_id = $order_type ? $order_type[0]->id : null;

                    $order_exist = DB::select('select * from kit_reports where order_number = ?', [$thisData['Orden']]);
                    if (count($order_exist) < 1) {
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
                                    array_key_exists("Cliente", $thisData) ? $thisData['Cliente'] : '',
                                    array_key_exists("Pto.tbjo.resp.", $thisData) ? $thisData['Pto.tbjo.resp.'] : '',
                                    array_key_exists("Clave recargos", $thisData) ? $thisData['Clave recargos'] : '',
                                    array_key_exists("Status usuario", $thisData) ? $thisData['Status usuario'] : '',
                                    $order_type_id,  array_key_exists("Orden", $thisData) ? $thisData['Orden'] : '', $current_user_id,
                                    array_key_exists("Equipo", $thisData) ? $thisData['Equipo'] : '',
                                    array_key_exists("Activo fijo", $thisData) ? $thisData['Activo fijo'] : '',
                                    array_key_exists("Denominación", $thisData) ? $thisData['Denominación'] : '',
                                    array_key_exists("Ce.emplazam.", $thisData) ? $thisData['Ce.emplazam.'] : '',
                                    array_key_exists("Centro planif.", $thisData) ? $thisData['Centro planif.'] : '',
                                    array_key_exists("Emplazamiento", $thisData) ? $thisData['Emplazamiento'] : '',
                                    array_key_exists("Fe.inic.extrema", $thisData) ? self::cast_to_date($thisData['Fe.inic.extrema']) : null,
                                    array_key_exists("Fecha modific.", $thisData) ? self::cast_to_date($thisData['Fecha modific.']) : null,
                                    array_key_exists("Fe.fin extrema", $thisData) ? self::cast_to_date($thisData['Fe.fin extrema']) : null,
                                    array_key_exists("Fecha entrada", $thisData) ?  self::cast_to_date($thisData['Fecha entrada']) : null,
                                    array_key_exists("Ctro.pto.trab.", $thisData) ? $thisData['Ctro.pto.trab.'] : '',
                                    array_key_exists("Sociedad", $thisData) ? $thisData['Sociedad'] : '', $mod_user_id,
                                    array_key_exists("Centro", $thisData) ? $thisData['Centro'] : '',
                                    array_key_exists("Grupo planif.", $thisData) ? $thisData['Grupo planif.'] : '',
                                    array_key_exists("TotalGen.(real)", $thisData) ? $thisData['TotalGen.(real)'] : '',
                                    array_key_exists("Texto breve", $thisData) ? $thisData['Texto breve'] : '',
                                    array_key_exists("Cl.actividad PM", $thisData) ? $thisData['Cl.actividad PM'] : ''
                                ]
                            );

                            $rows++;
                        }
                    } else {
                        DB::update(
                            'update kit_reports set
                        client_id = ?, pto_tbjo_resp = ?, charge_key = ?, user_status = ?, report_type_id = ?,
                        order_number = ?, `user_id` = ?, kit_number = ?, asset_fix = ?, denomination = ?, site_center = ?,
                        planning_center = ?, `zone` = ?, init_date = ?, modification_date = ?, extreme_end_date = ?,
                        entry_date = ?, ctro_pto_trab = ?, society = ?, updated_id = ?, center = ?,
                        planning_group = ?, total_generated = ?, short_text = ?, pm_activity = ?
                         where id = ?',
                            [
                                array_key_exists("Cliente", $thisData) ? $thisData['Cliente'] : '',
                                array_key_exists("Pto.tbjo.resp.", $thisData) ? $thisData['Pto.tbjo.resp.'] : '',
                                array_key_exists("Clave recargos", $thisData) ? $thisData['Clave recargos'] : '',
                                array_key_exists("Status usuario", $thisData) ? $thisData['Status usuario'] : '',
                                $order_type_id,  array_key_exists("Orden", $thisData) ? $thisData['Orden'] : '', $current_user_id,
                                array_key_exists("Equipo", $thisData) ? $thisData['Equipo'] : '',
                                array_key_exists("Activo fijo", $thisData) ? $thisData['Activo fijo'] : '',
                                array_key_exists("Denominación", $thisData) ? $thisData['Denominación'] : '',
                                array_key_exists("Ce.emplazam.", $thisData) ? $thisData['Ce.emplazam.'] : '',
                                array_key_exists("Centro planif.", $thisData) ? $thisData['Centro planif.'] : '',
                                array_key_exists("Emplazamiento", $thisData) ? $thisData['Emplazamiento'] : '',
                                array_key_exists("Fe.inic.extrema", $thisData) ? self::cast_to_date($thisData['Fe.inic.extrema']) : null,
                                array_key_exists("Fecha modific.", $thisData) ? self::cast_to_date($thisData['Fecha modific.']) : null,
                                array_key_exists("Fe.fin extrema", $thisData) ? self::cast_to_date($thisData['Fe.fin extrema']) : null,
                                array_key_exists("Fecha entrada", $thisData) ?  self::cast_to_date($thisData['Fecha entrada']) : null,
                                array_key_exists("Ctro.pto.trab.", $thisData) ? $thisData['Ctro.pto.trab.'] : '',
                                array_key_exists("Sociedad", $thisData) ? $thisData['Sociedad'] : '', $mod_user_id,
                                array_key_exists("Centro", $thisData) ? $thisData['Centro'] : '',
                                array_key_exists("Grupo planif.", $thisData) ? $thisData['Grupo planif.'] : '',
                                array_key_exists("TotalGen.(real)", $thisData) ? $thisData['TotalGen.(real)'] : '',
                                array_key_exists("Texto breve", $thisData) ? $thisData['Texto breve'] : '',
                                array_key_exists("Cl.actividad PM", $thisData) ? $thisData['Cl.actividad PM'] : '',
                                $order_exist[0]->id
                            ]
                        );
                        $updated++;
                    }
                } catch (Exception $e) {
                    return response()->json([
                        'message' => 'Importado con errores',
                        'document' => $document_name,
                        'rows' => $rows,
                        'updated' => $updated,
                        'error_exp' => $e->getMessage(),
                    ]);
                }
            }
        } else {
            return response()->json([
                'message' => 'No ha seleccionado un archivo para importar',
                'document' => $document_name,
                'rows' => $rows,
                'updated' => $updated,
            ]);
        }

        if (!$document_exist) {
            DB::insert('INSERT INTO documents
            (document_name, imported, created_at, updated_at)
            VALUES(?, ?, current_timestamp, current_timestamp)', [$document_name, $rows]);
        } else {
            $sum = $document[0]->imported + $rows;
            DB::update('update documents set imported = ? where id = ?', [$sum, $document[0]->id]);
        }

        return response()->json([
            'message' => 'Datos importados. ',
            'document' => $document_name,
            'rows' => $rows,
            'updated' => $updated,
        ]);
    }

    function cast_to_date($date)
    {
        $excel_date = $date;
        $unix_date = ($excel_date - 25569) * 86400;
        $excel_date = 25569 + ($unix_date / 86400);
        $unix_date = ($excel_date - 25569) * 86400;
        $result_date = gmdate("Y-m-d", $unix_date);

        return $result_date;
    }
}
