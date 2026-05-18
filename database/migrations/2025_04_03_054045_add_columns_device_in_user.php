<?php 

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('device_id')->nullable()->after('session_id'); 
            $table->string('user_agent')->nullable()->after('device_id');
            $table->string('ip_address')->nullable()->after('user_agent');
        });
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['device_id', 'user_agent', 'ip_address']);
        });
    }
};
