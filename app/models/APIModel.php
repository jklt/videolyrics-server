<?php
/**
 * Created by PhpStorm.
 * User: kevin
 * Date: 11/21/14
 * Time: 7:33 AM
 */

class APIModel {

    private $endPoint;
    private $addParams;
    private $addHeaders;

    public function __construct($endPoint, $addParams = array(), $addHeaders = array()) {
        $this->endPoint = $endPoint;
        $this->addParams = $addParams;
        $this->addHeaders = $addHeaders;
    }

    public function getCacheLabel($data)
    {
        return base64_encode(serialize($data));
    }

    public function call($method, $path, $data) {
        $client = new GuzzleHttp\Client();
        $cacheLabel = $this->getCacheLabel([
            $this->endPoint,
            serialize($this->addParams),
            serialize($this->addHeaders),
            serialize($data),
            $method,
            $path
        ]);
        $result = Cache::get($cacheLabel);
        if ($result === null) {
            $req = $client->createRequest($method, $this->endPoint . $path, [
                'query' => array_merge($this->addParams, $data),
                'headers' => $this->addHeaders
            ]);
            $res = $client->send($req);
            try {
                $results = $res->json();
            } catch (Exception $e) {
                $results = $res->getBody() . '';
            }
            Cache::put($cacheLabel, $results, 0);
        }
        $results = Cache::get($cacheLabel);
        return $results;
    }

}