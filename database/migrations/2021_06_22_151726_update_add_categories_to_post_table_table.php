<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class UpdateAddCategoriesToPostTableTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {

            //aggiungo la colonna foreign key
            //nullable = i post possono non avere una categoria
            //after = riposiziona la colonna dopo un' altra
            $table->unsignedBigInteger('category_id')->nullable()->after('slug');

            //aggiungo la relazione tra tabelle
            $table->foreign('category_id')
                  ->references('id')
                  ->on('categories');
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

            //per essere sicura che il down cancelli la colonna
            //argomenti (nome della tabella, nome della colonna, foreign )
            $table->dropForeign('posts_category_id_foreign');

            //in down devo eseguire il comando inverso, quindi cancellare la colonna foreign key 
            $table->dropColumn('category_id');
            
        });
    }
}
