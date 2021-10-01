<?php

namespace Hellsythe\DomainNameApi;

/**
 *
 */
class Domain extends Bind
{
    private $domains = [];
    private $tlds;

    function __construct()
    {
        parent::__construct();
        $this->tlds = config('domainnameapi.tlds');
    }

    /**
     * Agrega un tld a los TLDs por defecto en caso de no existir
     * @param string $tld  TLD a agregar
     */
    private function addTld(string $tld)
    {
        if (!in_array($tld, $this->tlds)) {
            array_push($this->tlds, $tld);
        }
    }
    /**
     * Agrega un tld a los TLDs por defecto en caso de no existir
     * @param string $tld  TLD a agregar
     */
    private function addDomain(string $domain)
    {
        if (!in_array($domain, $this->domains)) {
            array_push($this->domains, $domain);
        }
    }

    /**
     * Separa el dominio del TLD y lo agrega a la lista para consultar.
     * @param  string $domain Dominio deseado
     * @return void
     */
    private function parseDomain(string $domain)
    {
        $parse_domain = explode('.', $domain, 2);

        if ($parse_domain[1] ?? false) {
            $this->addTld($parse_domain[1]);
        }

        $this->addDomain($parse_domain[0]);
    }

    /**
     * Comprueba la disponibilidad de uno o multiples dominios
     * @param mixed   $domain  dominio o multiples dominios dentro de un array
     * @param integer $years  periodo de tiempo solicitado en años
     * @param string  $action  accion a consultar puede ser create,renew,transfer,restore
     * @return array
     */
    public function checkAvailability(mixed $domain, int $years = 1, string $action = 'create') : array
    {
        if (is_array($domain)) {
            foreach ($domain as $value) {
                $this->parseDomain($value);
            }
        } else{
            $this->parseDomain($domain);
        }

        $result = $this->api->CheckAvailability(
            $this->domains,
            $this->tlds,
            $years,
            $action
        );

        return $this->processResponse($result);
    }

    public function register(string $domain, int $years = 1, $theft = true, $privacy = false)
    {
        $result = $this->api->RegisterWithContactInfo(
            $domain,
            $years,
            [
                "Administrative" => config('domainnameapi.contact_info'),
                "Billing" => config('domainnameapi.contact_info'),
                "Technical" => config('domainnameapi.contact_info'),
                "Registrant" => config('domainnameapi.contact_info'),
            ],
            config('domainnameapi.nameservers'),
            $theft,
            $privacy
        );

        return $this->processResponse($result);
    }

    public function renew(string $domain, int $years = 1)
    {
        $result = $this->api->Renew($domain, $years);

        return $this->processResponse($result);
    }

    public function transfer(string $domain, string $epp)
    {
        $result = $this->api->Transfer($domain, $epp);

        return $this->processResponse($result);

    }

    public function transferCheck(string $domain, string $c_name_server)
    {
        $result = $this->api->CheckTransfer($domain, $c_name_server);

        return $this->processResponse($result);
    }

    public function transferCancel(string $domain)
    {
        $result = $this->api->CancelTransfer($domain);

        return $this->processResponse($result);
    }
}
