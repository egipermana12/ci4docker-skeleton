<?php

namespace App\Filters;

use CodeIgniter\Filters\FilterInterface;
use CodeIgniter\HTTP\RequestInterface;
use CodeIgniter\HTTP\ResponseInterface;
use App\Models\Tenants;

class TenantsFilter implements FilterInterface
{
    /**
     * Do whatever processing this filter needs to do.
     * By default it should not return anything during
     * normal execution. However, when an abnormal state
     * is found, it should return an instance of
     * CodeIgniter\HTTP\Response. If it does, script
     * execution will end and that Response will be
     * sent back to the client, allowing for error pages,
     * redirects, etc.
     *
     * @param RequestInterface $request
     * @param array|null       $arguments
     *
     * @return RequestInterface|ResponseInterface|string|void
     */
    // SubdomainFilter.php
    public function before(RequestInterface $request, $arguments = null)
    {
        $host = $request->getServer('HTTP_HOST');
        $mainDomain = 'localhost'; // domain utama
        $subdomain = str_replace('.' . $mainDomain, '', $host);


        if ($host === $mainDomain || $host === "www.$mainDomain") {
            // Hapus session tenant jika bukan subdomain
            session()->remove('activeTenantSubDomain');
            return;
        }

        if ($subdomain && $subdomain !== 'www' && $subdomain !== 'localhost') {
            $tenant = (new Tenants())->where('subdomain', $subdomain)->first();
            if ($tenant) {
                session()->set('activeTenantSubDomain', $tenant);
                return;
            } else {
                throw \CodeIgniter\Exceptions\PageNotFoundException::forPageNotFound("Tenant tidak ditemukan.");
            }
        }
    }


    /**
     * Allows After filters to inspect and modify the response
     * object as needed. This method does not allow any way
     * to stop execution of other after filters, short of
     * throwing an Exception or Error.
     *
     * @param RequestInterface  $request
     * @param ResponseInterface $response
     * @param array|null        $arguments
     *
     * @return ResponseInterface|void
     */
    public function after(RequestInterface $request, ResponseInterface $response, $arguments = null)
    {
        //
    }
}
