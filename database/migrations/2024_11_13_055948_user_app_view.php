<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
     /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Menghapus view jika sudah ada
        DB::statement('DROP VIEW IF EXISTS user_apps_view');

        // Membuat view baru
        DB::statement("CREATE VIEW user_apps_view AS
                    SELECT users.user_id AS user_id,
                            users.user_code AS user_code,
                            users.user_fullname AS user_name,
                            apps.app_id AS app_id,
                            apps.app_code AS app_code,
                            apps.app_name AS app_name,
                            map_users_apps.created_at AS granted_at,
                            map_users_apps.data_status AS data_status
                    FROM map_users_apps
                    JOIN users ON map_users_apps.user_id = users.user_id
                    JOIN apps ON map_users_apps.app_id = apps.app_id;");
    }

    public function down()
    {
        // Menghapus view jika sudah ada
        DB::statement('DROP VIEW IF EXISTS user_apps_view');
    }

};
