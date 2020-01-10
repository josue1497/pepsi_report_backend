<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ImportCallCenter extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);

       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
       DB::insert('INSERT INTO pepsidb.call_center_reports
       (`group`, user_id, `date`, call_assigned, call_managed, call_reject,
       call_unattended, call_average_response_time, call_outgoing, call_inquiry,
       email_assigned, email_managed, email_outgoing, email_average_response_time,
       chat_assigned, chat_managed, chat_average_response_time, returned_call_assigned,
       returned_call_managed, returned_call_average_response_time, sms, created_at, updated_at)
       VALUES(?, ?, ?, ?, ?, ?, ?, ?, ?, ?, ?,?,?,?,?, ?, ?, ?, ?, ?, ?, ?, ?)
       ', ['Grupo 1', 2, '2020-01-09', 10, 9, 1, 0, '00:00:10',
       2, 1, 20, 20, 0, '10:00:00', 10, 6, '10:00:00', 0, 29, '00:00:10', 20,
       '2020-01-09 00:00:00.000', '2020-01-09 00:00:00.000']);
    }
}
