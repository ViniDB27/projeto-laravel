<?php

namespace App\Tenant;

use Illuminate\Suporte\Facades\Schema;
use App\Models\Company;
use Illuminate\Support\Facades\DB;

class ManagerTenant
{

    public function setConnection(Company $company)
    {
        DB::purge('tenant');

        config()->set('database.connections.tenant.host', $company->db_hotname);
        config()->set('database.connections.tenant.database', $company->db_database);
        config()->set('database.connections.tenant.username', $company->db_username);
        config()->set('database.connections.tenant.password', $company->db_password);

        DB::reconnect('tenant');

        Schema::connection('tenant')->getConnection()->reconnect();
    }

}