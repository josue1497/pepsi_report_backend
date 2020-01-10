<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Alltables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('code')->unique();
            $table->string('rif')->unique();
            $table->string('legal_name');
            $table->string('email');
            $table->string('phone_number')->nullable();
            $table->timestamps();
        });

        Schema::create('report_type', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('value')->unique();
            $table->string('name')->unique();
            $table->string('help');
            $table->timestamps();
        });

        Schema::create('kit_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('client_id');
            $table->string('pto_tbjo_resp');
            $table->string('charge_key');
            $table->string('user_status');
            $table->unsignedInteger('report_type_id');
            $table->string('order_number');
            $table->unsignedInteger('user_id');
            $table->string('kit_number');
            $table->string('asset_fix');
            $table->string('denomination');
            $table->string('site_center');
            $table->string('planning_center');
            $table->string('zone');
            $table->date('init_date');
            $table->date('modification_date');
            $table->date('extreme_end_date');
            $table->date('entry_date');
            $table->string('ctro_pto_trab');
            $table->string('society');
            $table->unsignedInteger('updated_id');
            $table->string('center');
            $table->string('planning_group');
            $table->string('total_generated');
            $table->date('real_end_date');
            $table->string('pm_activity');
            $table->timestamps();
        });

        Schema::create('call_center_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group');
            $table->unsignedInteger('user_id');
            $table->date('date');
            #calls
            $table->integer('call_assigned');
            $table->integer('call_managed');
            $table->integer('call_reject');
            $table->integer('call_unattended');
            $table->time('call_average_response_time');
            $table->integer('call_outgoing');
            $table->integer('call_inquiry');
            #email
            $table->integer('email_assigned');
            $table->integer('email_managed');
            $table->integer('email_outgoing');
            $table->time('email_average_response_time');
            #chat
            $table->integer('chat_assigned');
            $table->integer('chat_managed');
            $table->time('chat_average_response_time');
            #returned call
            $table->integer('returned_call_assigned');
            $table->integer('returned_call_managed');
            $table->time('returned_call_average_response_time');
            #SMS
            $table->integer('sms');

            $table->timestamps();
        });

        Schema::create('kit_details_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stock_type');
            $table->string('special_stock');
            $table->string('society');
            $table->string('kit');
            $table->string('denomination');
            $table->string('fixed_asset');
            $table->string('inventary_number');
            $table->string('fabrication_serial_number');
            $table->string('site');
            $table->string('serial_number');
            $table->string('material');
            $table->string('cost_center');
            $table->string('client_was_id');
            $table->string('warehouse');
            $table->string('center');
            $table->string('company_area');
            $table->string('lot');
            $table->string('system_status');
            $table->string('user_status');
            $table->string('cam_clasif');
            $table->date('lock_date');
            $table->date('confirmation_date');
            $table->string('validation');
            $table->string('month');
            $table->string('vp');
            $table->string('revision');
            $table->timestamps();
        });

    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
