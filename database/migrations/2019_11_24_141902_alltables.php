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
            $table->string('client_id')->default(null);
            $table->string('pto_tbjo_resp')->default(null);
            $table->string('charge_key')->default(null);
            $table->string('user_status')->default(null);
            $table->unsignedInteger('report_type_id')->default(null);
            $table->string('order_number')->default(null);
            $table->unsignedInteger('user_id')->default(null);
            $table->string('kit_number')->default(null);
            $table->string('asset_fix')->default(null);
            $table->string('denomination')->default(null);
            $table->string('site_center')->default(null);
            $table->string('planning_center')->default(null);
            $table->string('zone')->default(null);
            $table->date('init_date')->default(null);
            $table->date('modification_date')->default(null);
            $table->date('extreme_end_date')->default(null);
            $table->date('entry_date')->default(null);
            $table->string('ctro_pto_trab')->default(null);
            $table->string('society')->default(null);
            $table->unsignedInteger('updated_id')->default(null);
            $table->string('center')->default(null);
            $table->string('planning_group')->default(null);
            $table->string('total_generated')->default(null);
            $table->string('short_text')->default(null);
            $table->string('pm_activity')->default(null);
            $table->timestamps();
        });

        Schema::create('call_center_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('group')->default(null);
            $table->unsignedInteger('user_id')->default(null);
            $table->date('date')->default(null);
            #calls
            $table->integer('call_assigned')->default(null);
            $table->integer('call_managed')->default(null);
            $table->integer('call_reject')->default(null);
            $table->integer('call_unattended')->default(null);
            $table->string('call_average_response_time')->default(null);
            $table->integer('call_outgoing')->default(null);
            $table->integer('call_inquiry')->default(null);
            #email
            $table->integer('email_assigned')->default(null);
            $table->integer('email_managed')->default(null);
            $table->integer('email_outgoing')->default(null);
            $table->string('email_average_response_time')->default(null);
            #chat
            $table->integer('chat_assigned')->default(null)->default(null);
            $table->integer('chat_managed')->default(null)->default(null);
            $table->string('chat_average_response_time')->default(null);
            #returned call
            $table->integer('returned_call_assigned')->default(null);
            $table->integer('returned_call_managed')->default(null);
            $table->string('returned_call_average_response_time')->default(null);
            #SMS
            $table->integer('sms')->default(null);

            $table->timestamps();
        });

        Schema::create('kit_details_reports', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('stock_type')->default(null);
            $table->string('special_stock')->default(null);
            $table->string('society')->default(null);
            $table->string('kit')->default(null);
            $table->string('denomination')->default(null);
            $table->string('fixed_asset')->default(null);
            $table->string('inventary_number')->default(null);
            $table->string('fabrication_serial_number')->default(null);
            $table->string('site')->default(null);
            $table->string('serial_number')->default(null);
            $table->string('material')->default(null);
            $table->string('cost_center')->default(null);
            $table->string('client_was_id')->default(null);
            $table->string('warehouse')->default(null);
            $table->string('center')->default(null);
            $table->string('company_area')->default(null);
            $table->string('lot')->default(null);
            $table->string('system_status')->default(null);
            $table->string('user_status')->default(null);
            $table->string('cam_clasif')->default(null);
            $table->date('lock_date')->default(null);
            $table->date('confirmation_date')->default(null);
            $table->string('validation')->default(null);
            $table->string('month')->default(null);
            $table->string('vp')->default(null);
            $table->string('revision')->default(null);
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
