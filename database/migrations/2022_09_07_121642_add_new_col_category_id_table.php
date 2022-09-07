<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddNewColCategoryIdTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Creo la nuova colonna
            $table->unsignedBigInteger('category_id')->nullable()->after('slug');

            // Assegno la FK
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('set null');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            // Cancello prima la relazione
            $table->dropForeign('posts_category_id_foreign');

            // Cancello la colonna
            $table->dropColumn('category_id');
        });
    }
}

