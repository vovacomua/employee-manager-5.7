<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateEmployeesTable extends Migration
{
    /**
     * Schema table name to migrate
     * @var string
     */
    public $set_schema_table = 'employees';

    /**
     * Run the migrations.
     * @table employees
     *
     * @return void
     */
    public function up()
    {
        if (Schema::hasTable($this->set_schema_table)) return;
        Schema::create($this->set_schema_table, function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->integer('parent_id')->nullable()->default(null);
            $table->integer('lft')->nullable()->default(null);
            $table->integer('rgt')->nullable()->default(null);
            $table->integer('depth')->nullable()->default(null);
            $table->string('full_name');
            $table->string('position');
            $table->date('start_date');
            $table->decimal('salary', 7, 2);
            $table->tinyInteger('has_photo')->default('0');

            $table->index(["lft"], 'employees_lft_index');

            $table->index(["rgt"], 'employees_rgt_index');

            $table->index(["parent_id"], 'employees_parent_id_index');
            $table->nullableTimestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
     public function down()
     {
       Schema::dropIfExists($this->set_schema_table);
     }
}
