<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReportsController extends Controller
{
    function getCallCenterData(Request $request)
    {

        $sqlCalls = "select date_format(`date`, '%b %d') `date`, sum(call_assigned) call_assigned, sum(call_managed) call_managed,
		sum(call_reject) call_reject, sum(call_inquiry) call_inquiry,
		sum(call_outgoing) call_outgoing, sum(call_unattended) call_unattended ,
		avg(call_average_response_time) call_average_response_time, sum(sms) sms ";

        $sqlChats = "select date_format(`date`, '%b %d') `date`, sum(chat_assigned) chat_assigned, sum(chat_managed) chat_managed,
		avg(chat_average_response_time)  chat_average_response_time ";

        $sqlEmails = "select date_format(`date`, '%b %d') `date`, sum(email_assigned) email_assigned, sum(email_managed) email_managed,
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

        // if (self::calculateDateDiff($request->from_date, $request->to_date, 7)) {
        //     return response()->json([
        //         'status' => "300",
        //         'message' => 'Entre las fechas seleccionadas debe haber menos de una semana de diferencia.'
        //     ]);
        // }

        $dataCalls = DB::select($sqlCalls . $from_sentence . $where_clause . $group_by, [$request->user_id, $request->from_date, $request->to_date]);

        $dataChats = DB::select($sqlChats . $from_sentence . $where_clause . $group_by, [$request->user_id, $request->from_date, $request->to_date]);

        $dataEmails = DB::select($sqlEmails . $from_sentence . $where_clause . $group_by, [$request->user_id, $request->from_date, $request->to_date]);

        return response()->json([
            'status' => "200",
            'message' => 'Busqueda Exitosa',
            'call_data' => $dataCalls,
            'chat_data' => $dataChats,
            'email_data' => $dataEmails
        ]);
    }

    function getKitDetailsReportData(Request $request)
    {

        $month = $request->month;
        $site = $request->site;
        $status = $request->status;

        $group_by = "";

        $from_sentence = " from kit_details_reports  ";

        $sqlBySite = "select count(*) cant, company_area, site " . $from_sentence;

        $sqlByMonth = "select count(*) cant, `month` " . $from_sentence;

        $sqlByStatusSite = "select count(*) cant, user_status, site " . $from_sentence;

        $sqlByStatus = "select count(*) cant, user_status, site " . $from_sentence;


        $dataByMonth = null;
        $group_by = " group by `month` ";
        if ($month) {
            $sqlByMonth = $sqlByMonth . ' where  `month` = ? ';
            $dataByMonth = DB::select($sqlByMonth . $group_by, [$month]);
        } else {
            $sqlByMonth = $sqlByMonth . $group_by;
            $dataByMonth = DB::select($sqlByMonth);
        }

        $dataBySite = null;
        if ($site) {
            $sqlBySite = $sqlBySite . ' where  company_area = ? group by company_area , site ';
            $dataBySite = DB::select($sqlBySite, [$site]);
        } else {
            $sqlBySite = $sqlBySite . ' group by company_area, site';
            $dataBySite = DB::select($sqlBySite);
        }

        if ($status) {
            $sqlByStatus = $sqlByStatus . ' where  user_status = ?  group by user_status, site  ';
            $dataByStatus = DB::select($sqlByStatus, [$status]);
        } else {
            $sqlByStatus = $sqlByStatus . ' group by company_area, site';
            $dataByStatus = DB::select($sqlByStatus);
        }

        if ($site && $status) {
            $sqlByStatusSite = $sqlByStatusSite . ' where  company_area = ? and user_status = ? group by user_status, site';
            $dataByStatusSite = DB::select($sqlByStatusSite, [$site, $status]);
        } else {
            $sqlByStatusSite = $sqlByStatusSite . ' group by user_status, site';
            $dataByStatusSite = DB::select($sqlByStatusSite);
        }


        // $dataByStatus = DB::select($sqlByStatus);

        return response()->json([
            'status' => "200",
            'message' => 'Busqueda Exitosa',
            'data_by_month' => $dataByMonth,
            'data_by_site' => $dataBySite,
            'data_by_status' => $dataByStatus,
            'data_by_status_site' => $dataByStatusSite

        ]);
    }

    function getDataListKitOrdersEndDate(Request $request)
    {
        $query = "select * from kit_reports
        where user_status='C000'
        and DATE_ADD(init_date , INTERVAL 2 DAY) >= extreme_end_date
        and extreme_end_date <= current_date";

        $data = DB::select($query);

        return response()->json([
            'status' => "200",
            'message' => 'Busqueda Exitosa',
            'data' => $data,
        ]);
    }

    function getGeneralIndicators(Request $request)
    {

        $user_id = $request->user_id;
        $role_id = $request->role_id;

        $user_and = ($role_id != 1) ? (' and user_id=' . $user_id . ' ') : ' ';

        $from_sentence = " from kit_reports ";


        if (!$request->from_date) {
            return response()->json([
                'status' => "300",
                'message' => 'Debe seleccionar una fecha "desde"'
            ]);
        }

        if (!$request->to_date) {
            return response()->json([
                'status' => "300",
                'message' => 'Debe seleccionar una fecha "desde"'
            ]);
        }

        if (!$request->site) {
            return response()->json([
                'status' => "300",
                'message' => 'Debe seleccionar una fecha "desde"'
            ]);
        }

        if (strtotime($request->to_date) < strtotime($request->from_date)) {
            return response()->json([
                'status' => "300",
                'message' => 'La Fecha "Fin" debe ser mayor a la fecha "Desde".'
            ]);
        }

        if (self::calculateDateDiff($request->from_date, $request->to_date, 30)) {
            return response()->json([
                'status' => "300",
                'message' => 'Entre las fechas seleccionadas debe haber menos de un mes de diferencia.'
            ]);
        }

        $sqlOrderClass = " select count(k.report_type_id) cant, r.name, date_format(k.entry_date, '%b %d') entry_date " . $from_sentence . " as k
                           inner join report_type as r on (r.id=k.report_type_id) ";
        $where_clause = " where `zone`=? and entry_date between ? and ? " . $user_and;
        $extra_clouse = " group by r.value, entry_date , r.name order by entry_date ";

        //order class
        $data_order_class = DB::select($sqlOrderClass . $where_clause . $extra_clouse, [$request->site, $request->from_date, $request->to_date]);

        // clave de carga
        $sqlChargeKey = "select count(*) cant, (case when STRCMP(charge_key,'SAP1')=0 then 'SAP1 - Casos por llamadas.'
                                                when STRCMP(charge_key,'SAP2')=0 then 'SAP2 - Casos por Correo.'
                                                else 'No asignado' end) as charge_key " . $from_sentence;
        $extra_clouse = " group by charge_key ";

        $data_charge_key = DB::select($sqlChargeKey . $where_clause . $extra_clouse, [$request->site, $request->from_date, $request->to_date]);

        //Status
        $sqlStatus = "select count(*) cant, (case when STRCMP(user_status,'C000')=0 then 'C000 - Sin Atención'
                                when STRCMP(user_status,'C010')=0 then 'C010 - Caso Resuelto'
                                when STRCMP(user_status,'C012')=0 then 'C012 - Caso no Ejecutado'
                                when STRCMP(user_status,'C011')=0 then 'C011 - Orden pendiente por documento'
                                when STRCMP(user_status,'C004')=0 then 'C004 - Replanificar'
                                when STRCMP(user_status,'C005')=0 then 'C004 - Pendiente por Repuesto'
                                when STRCMP(user_status,'C003')=0 then 'C003 - Foul (No completado)'
                                when STRCMP(user_status,'C006')=0 then 'C006 - Cambio de tipo de pedido'
                                when STRCMP(user_status,'C001')=0 then 'C001 - Cambio Tecnico'
                                when STRCMP(user_status,'C002')=0 then 'C002 - Pendiente por Compresor'
                    else '-' end) user_status " . $from_sentence;
        $extra_clouse = " group by user_status";

        $data_status = DB::select($sqlStatus . $where_clause . $extra_clouse, [$request->site, $request->from_date, $request->to_date]);

        $sqlCancelledOrders = "select count(*) cant,  date_format(`entry_date`, '%b %d') entry_date " . $from_sentence;
        $where_clause = " where lower(short_text) like lower('%ANULADA%')
                                and `zone`=? and entry_date between ? and ? " . $user_and;
        $extra_clouse = " group by  entry_date order by entry_date desc";

        $data_cancelled = DB::select($sqlCancelledOrders . $where_clause . $extra_clouse, [$request->site, $request->from_date, $request->to_date]);

        return response()->json([
            'status' => "300",
            'message' => 'Busqueda exitosa.',
            'data_cancelled' => $data_cancelled,
            'data_status' => $data_status,
            'data_charge_key' => $data_charge_key,
            'data_order_class' => $data_order_class
        ]);
    }

    function calculateDateDiff($from_date, $to_date, $diff)
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

        return $dias_diferencia >= $diff;
    }

    function get_zones(Request $request)
    {
        $sql = "select distinct(`zone`) value, `zone`  from kit_reports where `zone` is not null order by pto_tbjo_resp";

        $data = DB::select($sql);

        return response()->json(
            [
                'data' => $data,
                'message' => 'Busqueda exitosa.'
            ]
        );
    }

    function get_expired_orders(Request $request)
    {

        $user_id = $request->user_id;
        $role_id = $request->role_id;

        $user_and = ($role_id != 1) ? (' and user_id=' . $user_id . ' ') : ' ';

        $sql = "select count(*) cant, date_format(entry_date, '%b %d') entry_date from kit_reports
        where user_status='C000'
        and DATE_ADD(entry_date , INTERVAL 2 DAY) >= extreme_end_date " . $user_and . "
        group by entry_date
        order by entry_date";

        $sqlOrdersDetails = "select k.id, k.client_id, k.`zone`,date_format(k.entry_date, '%b %d') entry_date,
        date_format(k.extreme_end_date, '%b %d') extreme_end_date, order_number, r.value, concat(u.name,' ',u.lastname) operator
        from kit_reports k
        inner join users u on (u.id=k.user_id)
        inner join report_type r on (k.report_type_id=r.id)
        where user_status='C000'
        and DATE_ADD(entry_date , INTERVAL 2 DAY) >= extreme_end_date " . $user_and . "
        order by entry_date";

        $count_data = DB::select($sql);
        $detail_data = DB::select($sqlOrdersDetails);

        return response()->json(
            [
                'count_data' => $count_data,
                'detail_data' => $detail_data,
                'message' => 'Busqueda exitosa.'
            ]
        );
    }

    function get_activity_orders(Request $request)
    {
        $user_id = $request->user_id;
        $role_id = $request->role_id;

        $user_and = ($role_id != 1) ? (' and user_id=' . $user_id . ' ') : ' ';

        $sql = "select count(k.report_type_id) cant,
        (case when STRCMP(pm_activity,'044')=0 then '044 - Administrativa.'
              when STRCMP(pm_activity,'069')=0 then '069 - CT.'
              when STRCMP(pm_activity,'040')=0 then '040 - Normal.'
              when STRCMP(pm_activity,'042')=0 then '042 - Normal.'
              else '-' end) as pm_activity from kit_reports as k
       inner join report_type as r on (r.id=k.report_type_id)
       where r.value='ZPMI' and `zone`= ? and entry_date between ? and ? " . $user_and . "
       group by k.pm_activity
       order by entry_date desc";


        if (!$request->from_date) {
            return response()->json([
                'status' => "300",
                'message' => 'Debe seleccionar una fecha "desde"'
            ]);
        }

        if (!$request->to_date) {
            return response()->json([
                'status' => "300",
                'message' => 'Debe seleccionar una fecha "desde"'
            ]);
        }

        if (!$request->site) {
            return response()->json([
                'status' => "300",
                'message' => 'Debe seleccionar una Zona del listado'
            ]);
        }

        if (strtotime($request->to_date) < strtotime($request->from_date)) {
            return response()->json([
                'status' => "300",
                'message' => 'La Fecha "Fin" debe ser mayor a la fecha "Desde".'
            ]);
        }

        // if (self::calculateDateDiff($request->from_date, $request->to_date, 30)) {
        //     return response()->json([
        //         'status' => "300",
        //         'message' => 'Entre las fechas seleccionadas debe haber menos de un mes de diferencia.'
        //     ]);
        // }

        $response = DB::select($sql, [$request->site, $request->from_date, $request->to_date]);

        return response()->json(
            [
                'status' => 200,
                'data' => $response,
                'message' => 'Busqueda exitosa.'
            ]
        );
    }

    function getDashboardData(Request $request)
    {

        $user_id = $request->user_id;
        $role_id = $request->role_id;

        $user_and = ($role_id != 1) ? (' and user_id=' . $user_id . ' ') : ' ';

        $sql_call_total_m = "select ifnull(sum(call_managed),0) cant, month(`date`) `date` from call_center_reports
        where month(`date`)=month(current_date) or
        month(`date`) = month((CURRENT_DATE() - INTERVAL 1 MONTH)) " . $user_and . "
        group by month(`date`)
        order by `date` desc limit 2";

        $sql_call_total_r = " select sum(call_reject) cant, month(`date`) `date`
        from call_center_reports
        where month(`date`)=month(current_date) or
        month(`date`) = month((CURRENT_DATE() - INTERVAL 1 MONTH)) " . $user_and . "
        group by month(`date`) order by `date` desc limit 2";

        $sql_order_anuladas = "select count(*) cant, month(`entry_date`) entry_date  from kit_reports
        where (month(entry_date)=month(current_date) or
        month(entry_date) = month((CURRENT_DATE() - INTERVAL 1 MONTH)))
        and short_text like '%anulada%' " . $user_and . "
        group by month(`entry_date`)
        order by entry_date desc limit 2";

        $sql_orders_total = "select count(*) cant,  month(`entry_date`) entry_date from kit_reports
        where (month(entry_date)=month(current_date) or
        month(entry_date) = month((CURRENT_DATE() - INTERVAL 1 MONTH)))
        and user_status='C010' " . $user_and . "
        group by month(`entry_date`)
        order by entry_date desc limit 2";

        $sql_order_by_date = "select count(*) cant,  date_format(`entry_date`, '%b %d') entry_date from kit_reports
        where user_status != 'C000' " . $user_and . "
        group by date_format(`entry_date`, '%b %d')
        order by entry_date
        limit 5";

        $user_and = ($role_id != 1) ? (' where user_id=' . $user_id . ' ') : ' ';

        $sql_call_by_date = "select sum(call_managed) cant, date_format(`date`, '%b %d') `date`
        from call_center_reports
        " . $user_and . "
        group by date_format(`date`, '%b %d')
        order by `date` desc
        limit 5";

        $sql_best_five_orders = "select count(order_number) cant, concat(u.name, ' ', u.lastname) names from kit_reports k
        inner join users u on (u.id=k.user_id)
        where user_status='C010' and month(entry_date)=month(current_date)
        group by concat(u.name, ' ', u.lastname)
        order by count(order_number) desc
        limit 5";

        $sql_best_five_call = "select sum(call_managed) cant, concat(u.name, ' ', u.lastname) names
        from call_center_reports c
        inner join users u on (u.id=c.user_id)
        where month(`date`)=month(current_date)
        group by concat(u.name, ' ', u.lastname)
        order by sum(call_managed) desc
        limit 5";

        $data_call_manage = DB::select($sql_call_total_m);
        $data_call_rejected = DB::select($sql_call_total_r);

        $data_orders_total = DB::select($sql_orders_total);
        $data_order_anuladas = DB::select($sql_order_anuladas);

        $data_order_by_date = DB::select($sql_order_by_date);
        $data_call_by_date = DB::select($sql_call_by_date);

        $data_order_best = DB::select($sql_best_five_orders);
        $data_call_best = DB::select($sql_best_five_call);

        return response()->json(
            [
                'data_call_manage' => $data_call_manage,
                'data_call_rejected' => $data_call_rejected,
                'data_orders_total' => $data_orders_total,
                'data_order_anuladas' => $data_order_anuladas,
                'data_order_by_date' => $data_order_by_date,
                'data_call_by_date' => $data_call_by_date,
                'data_order_best' => $data_order_best,
                'data_call_best' => $data_call_best,
                'message' => 'Busqueda exitosa.',
                'code' => '200'
            ]
        );
    }

    public function get_months(Request $request)
    {
        $sql = 'select distinct(site) from kit_details_reports where site is not null and site!=""';
        $data = DB::select($sql, [1]);

        return response()->json(
            [
                'data' => $data,
                'message' => 'Busqueda exitosa.',
                'code' => '200'
            ]
        );
    }

    public function get_sites(Request $request)
    {
        $sql = 'select distinct(`month`) from kit_details_reports';
        $data = DB::select($sql, [1]);

        return response()->json(
            [
                'data' => $data,
                'message' => 'Busqueda exitosa.',
                'code' => '200'
            ]
        );
    }
    public function get_status(Request $request)
    {
        $sql = 'select distinct(user_status) from kit_details_reports where user_status is not null and user_status!=""';
        $data = DB::select($sql, [1]);

        return response()->json(
            [
                'data' => $data,
                'message' => 'Busqueda exitosa.',
                'code' => '200'
            ]
        );
    }

    public function get_pto_job(Request $request)
    {
        $sql = "select count(pto_tbjo_resp) cant, pto_tbjo_resp
        from kit_reports
        where init_date between ? and ?
        group by pto_tbjo_resp";

        $date_from = $request->date_from;
        $date_to = $request->date_to;

        $data = DB::select($sql, [$date_from, $date_to]);

        return response()->json(
            [
                'data' => $data,
                'message' => 'Busqueda exitosa.',
                'code' => '200'
            ]
        );
    }

    public function report_by_user(Request $request)
    {


        $user_id = $request->user_id;
        $date_from = $request->date_from;
        $date_to = $request->date_to;

        $anulated_sql = "select * from kit_reports
        where user_status='C000'
        and DATE_ADD(init_date , INTERVAL 2 DAY) >= extreme_end_date
        and user_id=? and entry_date between ? and ?
        and extreme_end_date <= current_date";

        $anulated = DB::select($anulated_sql, [$user_id, $date_from, $date_to]);

        $sql_zone = "select count(`zone`) cant, `zone` from kit_reports
        where user_id= ? and init_date between ? and ?
        and `zone` is not null
        group by `zone`";

        $zone = DB::select($sql_zone, [$user_id, $date_from, $date_to]);

        $sql_status = "select count(user_status) cant, `user_status`
        from kit_reports
        where user_id= ? and init_date between ? and ?
        group by `user_status`";

        $status = DB::select($sql_status, [$user_id, $date_from, $date_to]);

        $sql_charge = "select count(charge_key) cant, charge_key
        from kit_reports
        where user_id= ? and init_date between ? and ?
        and charge_key is not null
        group by charge_key";

        $charge = DB::select($sql_charge, [$user_id, $date_from, $date_to]);

        $sql_olds = "select * from kit_reports
        where user_status='C000'
        and DATE_ADD(init_date , INTERVAL 2 DAY) >= extreme_end_date
        and user_id= ? and init_date between ? and ?
        and extreme_end_date <= current_date";

        $olds = DB::select($$sql_olds, [$user_id, $date_from, $date_to]);


        return response()->json(
            [
                'anulated' => $anulated,
                'zone' => $zone,
                'status' => $status,
                'olds' => $olds,
                'charge' => $charge,
                'message' => 'Busqueda exitosa.',
                'code' => '200'
            ]
        );
    }
}
