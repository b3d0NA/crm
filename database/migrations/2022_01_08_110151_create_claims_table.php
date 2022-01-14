<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use phpDocumentor\Reflection\PseudoTypes\False_;

class CreateClaimsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('claims', function (Blueprint $table) {
            $table->id();
            $table->string("claim_no");
            $table->foreignId("user_id");
            $table->date("date");
            $table->string("sales_channel");
            $table->string("registered_by");
            $table->string("customer_name");
            $table->integer("customer_nr");
            $table->string("customer_country");
            $table->integer("item_nr");
            $table->integer("quantity");
            $table->string("serial_nr");
            $table->date("purchased_date");
            $table->string("image");
            $table->integer("customer_invoice_number");
            $table->text("failure_type");
            $table->text("problem_description");
            $table->integer("customer_order_number");
            $table->date("customer_order_date");
            $table->text("notes")->nullable();
            $table->string("decision")->nullable();
            $table->string("product_group")->nullable();
            $table->string("priority")->nullable();
            $table->text("inspection_results")->nullable();
            $table->string("actions")->nullable();
            $table->string("supplier")->nullable();
            $table->string("assembled")->nullable();
            $table->boolean("is_returned")->nullable();
            $table->boolean("is_returned_to_sales")->nullable();
            $table->boolean("is_escalated")->default(false);
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
        Schema::dropIfExists('claims');
    }
}