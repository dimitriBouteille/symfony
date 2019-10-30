<?php

namespace Dbout\Symfony\ApiResponse;

use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

/**
 * Class ApiResponse
 *
 * @package Dbout\Symfony\ApiResponse
 *
 * @author      Dimitri BOUTEILLE <bonjour@dimitri-bouteille.fr>
 * @link        https://github.com/dimitriBouteille Github
 * @copyright   (c) 2019 Dimitri BOUTEILLE
 */
class ApiResponse extends JsonResponse
{

    /**
     * @var array
     */
    private $__status = [
        'code' =>           null,
        'error_message' =>  null,
        'type' =>           null,
    ];

    /**
     * @var array
     */
    private $__results = [];

    /**
     * AjaxResponse constructor.
     * @param null $data
     * @param int $statusCode
     * @param array $headers
     * @param bool $json
     */
    public function __construct($data = null, int $statusCode = 200, array $headers = array(), bool $json = false)
    {
        parent::__construct($data, $statusCode, $headers, $json);
        $this->setStatusCode($statusCode);

    }

    /**
     * Function getErrorMessage
     *
     * @return string|null
     */
    public function getErrorMessage(): ?string
    {
        return $this->__status['error_message'];
    }

    /**
     * Function setStatusCode
     *
     * @param int $code
     * @param null $message
     * @return ApiResponse
     */
    public function setStatusCode(int $code, $message = null): self
    {
        $this->__status['code'] = $code;
        parent::setStatusCode($code, $message);

        if(!is_null($message)) {
            $this->setErrorMessage($message);
        }

        return $this;
    }

    /**
     * Function setErrorMessage
     *
     * @param string $message
     * @return ApiResponse
     */
    public function setErrorMessage(string $message): self
    {
        $this->__status['error_message'] = $message;
        return $this;
    }

    /**
     * Function setType
     *
     * @param string $type
     * @return ApiResponse
     */
    public function setType(string $type): self
    {
        $this->__status['type'] = $type;
        return $this;
    }

    /**
     * Function setData
     *
     * @param array $data
     * @return ApiResponse
     */
    public function setData($data = []): self
    {
        if(!is_array($data)) {
            $data = [];
        }

        $this->__results = array_merge($this->__results, $data);
        return $this;
    }

    /**
     * Function prepare
     *
     * @param Request $request
     * @return JsonResponse|void
     */
    public function prepare(Request $request)
    {
        parent::setData($this->toArray());
        parent::prepare($request);
    }

    /**
     * Function toArray
     *
     * @return array
     */
    public function toArray(): array
    {
        return [
            'status' =>     $this->__status,
            'results' =>    $this->__results
        ];
    }

}
