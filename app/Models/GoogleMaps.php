<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class GoogleMaps extends Model
{
    //
    private $apiUrl;
    private $apiKey;
    private $params;
    private $callback;
    private $latLng;
    private $address;

    public function __construct()
    {
        $this->apiKey = "AIzaSyBz8wq1MMQK-X0M5ApJkEq2KrinIRR_7Pg";
        $this->apiUrl = "https://maps.googleapis.com/maps/api/geocode/json?key={$this->apiKey}&sensor=false&language=pt-BR";
    }

    /**
    * setAddress: Define qual endereço buscar
    * @param string $params Endereço (Florianópolis | Florianópolis Campeche | Rua XPTO)
    */
    public function setAddress($params)
    {
        $this->params = str_replace(" ", "+", $params);
        $this->get();
        return $this;
    }

    /**
    * getAddress: Retorna o endereço escrito
    * @return string Florianópolis = Florianópolis, Santa Catarina, Brasil
    */
    public function getAddress()
    {
        $this->address = $this->callback->results[0]->formatted_address;
        return $this->address;
    }

    /**
    * getLatLng: Retorna latitude e longitude do endereço
    * @return object ->lat and ->lng
    */
    public function getLatLng()
    {
        $this->latLng = $this->callback->results[0]->geometry->location;
        return $this->latLng;
    }

    /**
    * getCallback: Retorna o objeto completo do endereço
    * @return object Todos os atributos.
    */
    public function getCallback()
    {
        return $this->callback;
    }

    /**
    * Efetua uma comunicação via HTTP GET
    */
    private function get()
    {
        $ch = curl_init();
        curl_setopt($ch, CURLOPT_URL, "{$this->apiUrl}&address={$this->params}");
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $this->callback = json_decode(curl_exec($ch));
        curl_close($ch);
    }
}
