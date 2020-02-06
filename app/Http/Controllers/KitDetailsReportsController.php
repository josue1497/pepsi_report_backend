<?php

namespace App\Http\Controllers;

use Exception;
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
        $total_rows = $request->total_rows;

        $errors = [];

        $rows = 0;

        $document_exist = false;
        try {
            $document = DB::select('select * from documents where document_name=?', [$document_name]);

            if (count($document) > 0) {
                $document_exist = true;
                if ($document[0]->imported >= $total_rows) {
                    return response()->json([
                        'message' => 'Este archivo ya ha sido importado',
                        'document' => $document_name,
                        'rows' => $rows,
                    ]);
                }
            }

            if ($document_name) {
                for ($i = 0; $i < count($sheet_data); $i++) {
                    $thisData = $sheet_data[$i];

                    $excel_date = $thisData['Fecha bloqueo'];
                    $unix_date = ($excel_date - 25569) * 86400;
                    $excel_date = 25569 + ($unix_date / 86400);
                    $unix_date = ($excel_date - 25569) * 86400;
                    $lock_date = gmdate("Y-m-d", $unix_date);

                    try {
                        $exc = DB::insert(
                            'INSERT INTO kit_details_reports
                        ( stock_type, special_stock,
                        society, kit,
                        denomination, fixed_asset,
                        inventary_number, fabrication_serial_number,
                        `site`, serial_number,
                        material, cost_center,
                        client_was_id, center,
                        company_area, lock_date,
                        `status`, missing_report_date,
                        `month`, vp,
                        system_status, user_status,
                        created_at, updated_at)
                        VALUES(?, ?,
                        ?, ?,
                        ?, ?,
                        ?, ?,
                        ?, ?,
                        ?, ?,
                        ?, ?,
                        ?, ?,
                        ?, ?,
                        ?, ?,
                        ?, ?,
                        current_timestamp, current_timestamp)',
                            [
                                array_key_exists("Tipo stocks", $thisData) ? $thisData['Tipo stocks'] : '', array_key_exists("Stock especial", $thisData) ? $thisData['Stock especial'] : '',
                                array_key_exists("Sociedad", $thisData) ? $thisData['Sociedad'] : '', array_key_exists("Equipo", $thisData) ? $thisData['Equipo'] : '',
                                array_key_exists("Denominación", $thisData) ? $thisData['Denominación'] : '', array_key_exists("Activo fijo", $thisData) ? $thisData['Activo fijo'] : '',
                                array_key_exists("Nº inventario", $thisData) ? $thisData['Nº inventario'] : '', array_key_exists("Fabr. Nº-serie", $thisData) ? $thisData['Fabr. Nº-serie'] : '',
                                array_key_exists("Emplazamiento", $thisData) ? $thisData['Emplazamiento'] : '', array_key_exists("Número de serie", $thisData) ? $thisData['Número de serie'] : '',
                                array_key_exists("Material", $thisData) ? $thisData['Material'] : '', array_key_exists("Centro coste", $thisData) ? $thisData['Centro coste'] : '',
                                array_key_exists("Cliente en el que estaba instalado", $thisData) ? $thisData['Cliente en el que estaba instalado'] : '', array_key_exists("Centro", $thisData) ? $thisData['Centro'] : '',
                                array_key_exists("Área de empresa", $thisData) ? $thisData['Área de empresa'] : '', $lock_date,
                                array_key_exists("Status", $thisData) ? $thisData['Status'] : '', array_key_exists("Cliente en el que estaba instalado", $thisData) ? $thisData['Fecha Reporte equipo Extraviado'] : '',
                                array_key_exists("Mes", $thisData) ? $thisData['Mes'] : '', array_key_exists("VP", $thisData) ? $thisData['VP'] : '',
                                array_key_exists("Estatus Sistema", $thisData) ? $thisData['Estatus Sistema'] : '', array_key_exists("Estatus Usuario", $thisData) ? $thisData['Estatus Usuario'] : ''
                            ]
                        );
                    } catch (Exception $e) {
                        return response()->json([
                            'message' => 'Importado con errores',
                            'document' => $document_name,
                            'rows' => $rows,
                            'error_exp' => $e->getMessage(),
                        ]);
                    }


                    $rows++;
                }
            } else {
                return response()->json([
                    'message' => 'No ha seleccionado un archivo para importar',
                    'document' => $document_name,
                    'rows' => $rows,
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
        } catch (Exception $e) {
            array_push($errors, ['error'=>$e->getMessage()]);
        }

        return response()->json([
            'message' => 'Datos importados. ',
            'document' => $document_name,
            'rows' => $rows,
            'errors' => $errors
        ]);
    }
}
