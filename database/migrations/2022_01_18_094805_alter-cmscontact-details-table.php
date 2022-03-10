<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class AlterCmscontactDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('cms_contact_details_tbls', function (Blueprint $table) {
            $table->longText('cms_footer_heading')->nullable()->after('cms_copyright');
            $table->longText('cms_footer_content')->nullable()->after('cms_footer_heading');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('cms_contact_details_tbls', function (Blueprint $table) {
            //
        });
    }
}
