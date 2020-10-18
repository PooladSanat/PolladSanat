<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateViewTable extends Migration
{
    public function up()
    {
        \DB::statement("
            CREATE VIEW ProductCommodities
            AS
            SELECT
                Product.name,
                Product.code,
                Product.commodity_id,
                Commodities.id AS Commodities_id,
                Commodities.name AS Commodities_name,
            FROM
                product_characteristics
                LEFT JOIN commodities ON Product.commodity_id = Commodities.id

        ");
    }

    public function down()
    {
    }
}
