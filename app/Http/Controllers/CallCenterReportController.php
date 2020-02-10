<?php

namespace App\Http\Controllers;

use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Rap2hpoutre\FastExcel\FastExcel;

class CallCenterReportController extends Controller
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
        $current_group = "";
        $current_username = '';
        $search = false;
        $rows = 0;

        $errors=[];

        try{
        if(DB::select('select * from documents where document_name=?', [$document_name])){
            return response()->json([
                'message' => 'Este archivo ya ha sido importado',
                'document' => $document_name,
                'rows' => $rows,
            ]);
        }

        for ($i = 3; $i < count($sheet_data); $i++) {
            $thisData = $sheet_data[$i];

            if($thisData['__EMPTY_1'] || !$current_group){
                $current_group = ($thisData['__EMPTY_1'] != $current_group && $thisData['__EMPTY_1']) ? $thisData['__EMPTY_1']: $current_group;
            }

            if ($thisData['__EMPTY_2']) {
                $search = ($thisData['__EMPTY_2'] != $current_username && $thisData['__EMPTY_2']) ? true : false;
                $current_username = ($thisData['__EMPTY_2'] != $current_username && $thisData['__EMPTY_2']) ? $thisData['__EMPTY_2'] : $current_username;
            }

            if ($search) {
                $names = explode(", ", $current_username);
                $user = DB::select('select id from users
               where upper(name) like upper("%' . $names[1] . '%")
               and upper(lastname) like upper("%' . $names[0] . '%")');

                $current_user_id = $user? $user[0]->id : null;
            }

            if($thisData['__EMPTY_3'] && $current_user_id){
                if(!DB::select("select * from call_center_reports where user_id=? and `date`=? ", [$current_user_id, $thisData['__EMPTY_3']])){
                    $exc = DB::insert('INSERT INTO `call_center_reports`
                    (`group`, `user_id`, `date`, call_assigned, call_managed, call_reject,
                    call_unattended, call_average_response_time, call_outgoing, call_inquiry,
                    email_assigned, email_managed, email_outgoing, email_average_response_time,
                    chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
                    returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
                    VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?, current_timestamp, current_timestamp)',
                    [$current_group, $current_user_id,self::cast_to_date($thisData['__EMPTY_3']),$thisData['__EMPTY_4'],$thisData['__EMPTY_6'],
                    $thisData['__EMPTY_8'],
                    $thisData['__EMPTY_9'], $thisData['__EMPTY_10'],$thisData['__EMPTY_11'],$thisData['__EMPTY_12'],
                    $thisData['__EMPTY_13'],$thisData['__EMPTY_15'],
                    $thisData['__EMPTY_18'],$thisData['__EMPTY_17'],$thisData['__EMPTY_19'],$thisData['__EMPTY_20'],
                   $thisData['__EMPTY_23'],$thisData['__EMPTY_24'],$thisData['__EMPTY_25'],
                    $thisData['__EMPTY_27'],$thisData['__EMPTY_28']]);

                    $rows++;
                }
            }
        }

        DB::insert('INSERT INTO documents
        (document_name, imported, created_at, updated_at)
        VALUES(?, ?, current_timestamp, current_timestamp)', [$document_name, $rows]);
        }catch(Exception $e){
            array_push($errors, ['error'=>$e->getMessage()]);
        }

        return response()->json([
            'message' => 'Datos importados. ',
            'document' => $document_name,
            'rows' => $rows,
            'errors' => $errors
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
