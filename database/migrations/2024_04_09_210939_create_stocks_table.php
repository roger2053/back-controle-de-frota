<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateStocksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('stocks', function (Blueprint $table) {
            $table->id();
            
            $table->decimal('unique_cost', 10, 2)->nullable(); //Custo Único

            $table->string('product_name')->nullable();
            $table->string('product_description')->nullable(); //Descrição do produto
            $table->string('barcode')->nullable(); //Código de barra
            $table->string('reference')->nullable(); //Referência
            $table->integer('stock_quantity')->nullable(); //Quantidade do estoque
            $table->string('ncm_code')->nullable(); //NCM
            $table->enum('status',['A','B'])->nullable();
            $table->enum('type',['M,U,F,TI'])->nullable()->comment("( medicamento, material permanente/utensílios, ferramentas, TI )");
            $table->string('cest_code')->nullable();//CEST
            $table->string('brand')->nullable(); // Marca
            $table->string('characteristic')->nullable();//  Característica ( caracterísca do produto )
            $table->date('expiration_date')->nullable(); //Data de Vencimento
            $table->string('unit_of_measure')->nullable();
            $table->decimal('measure_value', 10, 2)->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('stocks');
    }
}
