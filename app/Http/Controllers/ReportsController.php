<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    function getCallCenterData(Request $request)
    {

        $sqlCalls = "select `date`, sum(call_assigned) call_assigned, sum(call_managed) call_managed,
		sum(call_reject) call_reject, sum(call_inquiry) call_inquiry,
		sum(call_outgoing) call_outgoing, sum(call_unattended) call_unattended ,
		avg(call_average_response_time) call_average_response_time, sum(sms) sms ";

        $sqlChats = "select `date`, sum(chat_assigned) chat_assigned, sum(chat_managed) chat_managed,
		avg(chat_average_response_time)  chat_average_response_time ";

        $sqlEmails = "select `date`, sum(email_assigned) email_assigned, sum(email_managed) email_managed,
        sum(email_outgoing) email_outgoing,	avg(email_average_response_time)  email_average_response_time ";


        $where_clause = " where user_id=? and `date` between ? and ? ";

        $from_sentence = " from call_center_reports  ";

        $group_by = " group by `date` ";

        if (!$request->user_id) {
            return response()->json([
                'status' => "300",
                'message' => "Debe seleccionar un usuario del listado."
            ]);
        }

        if (!$request->from_date) {
            return response()->json([
                'status' => "300",
                'message' => 'Debe seleccionar una fecha "Desde" valida.'
            ]);
        }

        if (!$request->to_date) {
            return response()->json([
                'status' => "300",
                'message' => 'Debe seleccionar una fecha "Fin" valida.'
            ]);
        }

        if (strtotime($request->to_date) < strtotime($request->from_date)) {
            return response()->json([
                'status' => "300",
                'message' => 'La Fecha "Fin" debe ser mayor a la fecha "Desde".'
            ]);
        }

        if (self::calculateDateDiff($request->from_date, $request->to_date)) {
            return response()->json([
                'status' => "300",
                'message' => 'Entre las fechas seleccionadas debe haber menos de una semana de diferencia.'
            ]);
        }

        $dataCalls = DB::select($sqlCalls.$from_sentence.$where_clause.$group_by, [$request->user_id, $request->from_date, $request->to_date]);

        $dataChats = DB::select($sqlChats.$from_sentence.$where_clause.$group_by, [$request->user_id, $request->from_date, $request->to_date]);

        $dataEmails = DB::select($sqlEmails.$from_sentence.$where_clause.$group_by, [$request->user_id, $request->from_date, $request->to_date]);

        return response()->json([
            'status' => "200",
            'message' => 'Busqueda Exitosa',
            'call_data' => $dataCalls,
            'chat_data' => $dataChats,
            'email_data' => $dataEmails
        ]);

    }

    function getKitDetailsReportData(Request $request){

        $from_sentence = " from kit_details_reports  ";

        $sqlBySite = "select count(*) cant, company_area, site ".$from_sentence ;

        $sqlByMonth = "select count(*) cant, `month` ".$from_sentence;

        $sqlByStatusSite = "select count(*) cant, user_status, site ".$from_sentence." group by user_status, site ";

        $sqlByStatus = "select count(*) cant, user_status, site ".$from_sentence." group by user_status, site ";


        $dataByMonth = null;
        if($request->month){
            $sqlByMonth = $sqlByMonth.' where  `month` = ? group by `month`';
            $dataByMonth = DB::select($sqlByMonth, [$request->month]);
        }else{
            $sqlByMonth = $sqlByMonth.' group by `month`';
            $dataByMonth = DB::select($sqlByMonth);
        }

        $dataBySite = null ;
        if($request->company_area){
            $sqlBySite = $sqlBySite.' where  company_area = ? group by company_area , site ';
            $dataBySite = DB::select($sqlBySite, [$request->company_area]);
        }else{
            $sqlBySite = $sqlBySite.' group by company_area, site';
            $dataBySite = DB::select($sqlBySite);
        }

        $dataByStatusSite = DB::select($sqlByStatusSite);

        $dataByStatus = DB::select($sqlByStatus);

        return response()->json([
            'status' => "200",
            'message' => 'Busqueda Exitosa',
            'data_by_month' => $dataByMonth,
            'data_by_site' => $dataBySite,
            'data_by_status' => $dataByStatus,
            'data_by_status_site' => $dataByStatusSite

        ]);

    }



    function calculateDateDiff($from_date, $to_date)
    {

        //defino fecha 1
        $date1 = date_create($from_date);
        $date2 = date_create($to_date);


        $ano1 = date_format($date1, 'Y');
        $mes1 = date_format($date1, 'm');
        $dia1 = date_format($date1, 'd');

        //defino fecha 2
        $ano2 = date_format($date2, 'Y');
        $mes2 = date_format($date2, 'm');
        $dia2 = date_format($date2, 'd');

        //calculo timestam de las dos fechas
        $timestamp1 = mktime(0, 0, 0, $mes1, $dia1, $ano1);
        $timestamp2 = mktime(0, 0, 0, $mes2, $dia2, $ano2);

        //resto a una fecha la otra
        $segundos_diferencia = $timestamp1 - $timestamp2;
        //echo $segundos_diferencia;

        //convierto segundos en días
        $dias_diferencia = $segundos_diferencia / (60 * 60 * 24);

        $dias_diferencia = abs($dias_diferencia);

        //quito los decimales a los días de diferencia
        $dias_diferencia = floor($dias_diferencia);

        return $dias_diferencia >= 7;
    }
}
