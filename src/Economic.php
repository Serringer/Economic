<?php

namespace Serringer\Economic;


use Exception;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\ClientException;
use GuzzleHttp\Exception\ConnectException;
use GuzzleHttp\Exception\ServerException;
use Serringer\Economic\models\customer;
use Serringer\Economic\Models\CustomerCollection;
use Serringer\Economic\Models\Product;
use function PHPUnit\Framework\throwException;

class Economic
{
    private $appSecretToken, $agreementGrantToken;
    private $baseUrl = 'https://restapi.e-conomic.com';
    private $contentType = 'application/json';
    private $headers;
    private $client;

    public function __construct($appSecretToken, $agreementGrantToken)
    {
        $this->appSecretToken = $appSecretToken;
        $this->agreementGrantToken = $agreementGrantToken;
        $this->client = new Client(['base_uri' => $this->baseUrl]);

        $this->headers = [
            'headers' => [
                'X-AppSecretToken' => $this->appSecretToken,
                'X-AgreementGrantToken' => $this->agreementGrantToken,
                'Content-Type' => $this->contentType,
            ],
        ];
    }

    public function collection($url, $model, $skipPages = 0, $pageSize = 20, $recursive = true)
    {
        $url = $url.'skippages='.$skipPages.'&pagesize='.$pageSize;

        $data = $this->get($url);

        if ($recursive && isset($data->pagination->nextPage)) {
            $collection = $this->collection($url, $model, $recursive, $skipPages + 1);
            $data->collection = array_merge($data->collection, $collection);
        }

        $data->collection = array_map(function ($item) use ($model) {
            return $model::transform($this, $item);
        }, $data->collection);

        return $data->collection;
    }

    public function get($url)
    {
        return json_decode($this->download($url));
    }

    public function download($url)
    {
        try {
            return $this->client->get($url, $this->headers)->getBody()->getContents();
        } catch (ClientException $exception) {
            throw new Exception($exception->getResponse()->getBody()->getContents());
        } catch (ServerException $exception) {
            throw new Exception();
        } catch (ConnectException $exception) {
            throw new Exception('Connection exception');
        }
    }

    public function create($url, $body)
    {
        try {
            $this->headers['body'] = json_encode($body);

            return json_decode($this->client->post($url, $this->headers)->getBody()->getContents());
        } catch (ClientException $exception) {
            throw new Exception($exception->getResponse()->getBody()->getContents());
        } catch (ServerException $exception) {
            throw new Exception();
        } catch (ConnectException $exception) {
            throw new Exception();
        }
    }

    public function update($url, $body)
    {
        try {
            $this->headers['body'] = \GuzzleHttp\json_encode($body);

            return \GuzzleHttp\json_decode($this->client->put($url, $this->headers)->getBody()->getContents());
        } catch (ClientException $exception) {
            throw new Exception($exception->getResponse()->getBody()->getContents());
        } catch (ServerException $exception) {
            throw new Exception();
        } catch (ConnectException $exception) {
            throw new Exception();
        }
    }

    public function delete($url)
    {
        try {
            return $this->client->delete($url, $this->headers);
        } catch (ClientException $exception) {
            throw new Exception($exception->getResponse()->getBody()->getContents());
        } catch (ServerException $exception) {
            throw new Exception();
        } catch (ConnectException $exception) {
            throw new Exception();
        }
    }

    public function setClass($name, $property, $object = null)
    {
        $class = __NAMESPACE__.'\Models\Components\\'.$name;

        $this->reflectionMethod = new \ReflectionMethod($class, '__construct');

        $class = new $class;

        foreach ($this->reflectionMethod->getParameters() as $key => $value) {
            if ($value->name != $property) {
                unset($class->{$value->name});
            }
        }

        if (is_object($class->{$property})) {
            unset($class->{$property}->self);
        }

        if (isset($object->{strtolower($name)})) {
            $array = (array) $class;

            $map = array_merge($array, (array) $object->{strtolower($name)});

            foreach ($map as $key => $value) {
                $class->{$key} = $value;
            }
        }

        return $class;
    }

    public function customer(): Customer
    {
        return new Customer($this);
    }

    public function customerCollection(): CustomerCollection
    {
        return new CustomerCollection($this);
    }

    public function units(): Unit
    {
        return new Unit($this);
    }

    public function products(): Product
    {
        return new Product($this);
    }

    /**
     * @return PaymentType
     */
    public function paymentTypes(): PaymentType
    {
        return new PaymentType($this);
    }

    public function currency(): Currency
    {
        return new Currency($this);
    }

    public function invoices(): Invoice
    {
        return new Invoice($this);
    }

    public function cleanObject($obj)
    {
        foreach ($obj as $key => $value) {
            if (is_object($value)) {
                $this->cleanObject($value);
            }

            if (is_array($value)) {
                $this->cleanArray($value);
            }

            $this->filterData($obj, $key, $value);
        }
    }

    protected function cleanArray(array $arr)
    {
        foreach ($arr as $key => $item) {
            if (is_object($item)) {
                $this->cleanObject($item);
            }

            if (is_array($item)) {
                $this->cleanArray($item);
            }
        }
    }

    protected function filterData($obj, $property, $value)
    {
        if ($property == 'self') {
            unset($obj->{$property});
        }

        if (is_null($value)) {
            unset($obj->{$property});
        }
    }
}
