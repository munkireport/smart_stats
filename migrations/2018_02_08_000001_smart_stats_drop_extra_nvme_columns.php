<?php
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Capsule\Manager as Capsule;

class SmartStatsDropExtraNvmeColumns extends Migration
{
    private $tableName = 'smart_stats';

    public function up()
    {
        $capsule = new Capsule();
    
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->dropColumn('temperature_nvme');
            $table->dropColumn('power_on_hours_nvme');
            $table->dropColumn('power_cycle_count_nvme');
            $table->dropColumn('Unused_Reserve_NAND_Blk');
            $table->integer('unused_reserve_nand_blk')->nullable();
        });
     }
    
    public function down()
    {
        $capsule = new Capsule();
        $capsule::schema()->table($this->tableName, function (Blueprint $table) {
            $table->integer('temperature_nvme')->nullable();
            $table->integer('power_on_hours_nvme')->nullable();
            $table->integer('power_cycle_count_nvme')->nullable();
            $table->dropColumn('unused_reserve_nand_blk');
            $table->integer('Unused_Reserve_NAND_Blk')->nullable();
        });
    }
}
