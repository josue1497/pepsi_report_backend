<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class KitDetailsReportsController extends Controller
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

            $excel_date = $thisData['Fecha Reporte equipo Extraviado'];
            $unix_date = ($excel_date - 25569) * 86400;
            $excel_date = 25569 + ($unix_date / 86400);
            $unix_date = ($excel_date - 25569) * 86400;
            $date_confirm = gmdate("Y-m-d", $unix_date);

            $excel_date = $thisData['Fecha bloqueo'];
            $unix_date = ($excel_date - 25569) * 86400;
            $excel_date = 25569 + ($unix_date / 86400);
            $unix_date = ($excel_date - 25569) * 86400;
            $lock_date = gmdate("Y-m-d", $unix_date);


            $exc = DB::insert(
                'INSERT INTO kit_details_reports
                    ( stock_type, special_stock, society, kit, denomination,
                    fixed_asset, inventary_number, fabrication_serial_number,
                    `site`, serial_number, material, cost_center, client_was_id,
                    center, company_area, lock_date, system_status,
                    confirmation_date,  `month`, created_at, updated_at)
                    VALUES(?, ?, ?, ?, ?,
                    ?, ?, ?,
                    ?, ?, ?, ?, ?,
                    ?, ?, ?, ?,
                    ?, ?, current_timestamp, current_timestamp)',
                [
                    $thisData['Tipo stocks'], $thisData['Stock especial'], $thisData['Sociedad'], $thisData['Equipo'], $thisData['Denominación'],
                    $thisData['Activo fijo'], $thisData['Nº inventario'], $thisData['Fabr. Nº-serie'],
                    $thisData['Emplazamiento'], $thisData['Número de serie'], $thisData['Material'], $thisData['Centro coste'], $thisData['Cliente en el que estaba instalado'],
                    $thisData['Centro'], $thisData['Área de empresa'], $lock_date, $thisData['Status'],
                   $date_confirm, $thisData['Mes']
                ]
            );


            $rows++;
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
