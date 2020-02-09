<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ConfigurationController extends Controller
{
    public function save_configuration(Request $request)
    {
        $goal_value = $request->goal_value;

        $param_name = $request->param_name;
        try {
            if (DB::select("select * from config where name=?", [$param_name])) {
                if (DB::update("update config set value=? where name=?", [$goal_value, $param_name])) {
                    return response()->json([
                        'status' => 200,
                        'message' => 'Configuracion Guardada',
                    ]);
                }
            } else {
                if (DB::insert('insert into config (name, value) values (?, ?)', [$param_name, $goal_value])) {
                    return response()->json([
                        'status' => 200,
                        'message' => 'Configuracion Guardada',
                    ]);
                }
            }
        } catch (Exception $e) {
            return response()->json([
                'status' => 500,
                'message' => $e->getMessage(),
            ]);
        }
    }

    public function get_all_configurations(Request $request)
    {
        $data = DB::select("select * from config ");
        return response()->json([
            'status' => 200,
            'message' => "Configuracion encontrada",
            'data' => $data
        ]);
    }
}
