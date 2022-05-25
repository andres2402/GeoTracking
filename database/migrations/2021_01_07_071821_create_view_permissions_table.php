<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateViewPermissionsTable extends Migration
{
   public function up()
   {
      DB::statement("DROP VIEW IF EXISTS view_permissions");
      DB::statement("
      CREATE VIEW view_permissions AS
      (SELECT rls.id AS role_id, ats.name AS name, mdl.name AS module_name, mdl.reference AS module_reference, mdl.icon AS module_icon,mdl.visible AS module_visible, ats.reference AS action_reference, ats.route AS action_route
      FROM permissions pts
      JOIN roles rls ON rls.id = pts.role_id
      JOIN actions ats ON ats.id = pts.action_id
      JOIN modules mdl ON mdl.id = ats.module_id
      WHERE rls.state = 1
      ORDER BY mdl.id
      )");
   }

   public function down()
   {
      DB::statement("DROP VIEW IF EXISTS view_permissions");
   }
}
