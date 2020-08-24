<?php

namespace App\Http\Middleware\Tenant;

use App\Tenant\ManagerTenant;
use App\Models\Company;
use Closure;

class TenantMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $company = $this->getCompany($request->getHost());
        
        if(!$company && $request->url() !=  route('404')){
            return redirect()->route('404');
        } else if($request->url() !=  route('404')){
            app(ManagerTenant::class)->getConnection($company);
        }


        return $next($request);
    }

    public function getCompany($host)
    {
        return Company::where('domain', $host)->first();
    }
}
