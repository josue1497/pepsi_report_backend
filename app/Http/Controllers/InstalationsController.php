<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class InstalationsController extends Controller
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
        $select = "select * from instalation where zone = ?";
        $data = DB::select($select, [$request->zone]);

        if (!$data) {
            try {
                if (DB::insert("INSERT INTO instalation
                (vc_1p, vc_2p, enfriador_1t, enfriador_2t,
                enfriador_3t, passthrough, `zone`,
                created_at, updated_at)
                VALUES(?, ?, ?, ?,
                ?, ?, ?,
                current_timestamp, current_timestamp)", [
                    $request->vc_1p, $request->vc_2p,
                    $request->enfriador_1t, $request->enfriador_2t, $request->enfriador_3t,
                    $request->passthrough, $request->zone
                ])) {
                    return response()->json([
                        'status' => 200,
                        'message' => 'success'
                    ]);
                }
            } catch (Exception $e) {
                return response()->json([
                    'status' => 500,
                    'message' => $e->getMessage(),
                ]);
            }
        }else{
            return response()->json([
                'status' => 500,
                'message' => "Esta Zona ya fue registrada",
            ]);
        }
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
        $select = "select * from instalation where id = ?";
        $data = DB::select($select, [$id]);

        if ($data) {
            try {
                if (DB::update('update instalation set vc_1p=?,vc_2p=?, enfriador_1t=?,
            enfriador_2t=?, enfriador_3t=?, passthrough=?
            where id=?', [
                    $request->vc_1p, $request->vc_2p,
                    $request->enfriador_1t, $request->enfriador_2t, $request->enfriador_3t,
                    $request->passthrough, $id
                ])) {
                    return response()->json([
                        'status' => 200,
                        'message' => 'success'
                    ]);
                }
            } catch (Exception $e) {
                return response()->json([
                    'status' => 500,
                    'message' => $e->getMessage(),
                ]);
            }
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

    public function get_all_instalations(Request $request)
    {
        $sql = "select * from instalation";

        $data = DB::select($sql);

        return response()->json([
            'status' => 200,
            'message' => 'success',
            'data' => $data
        ]);
    }
}
