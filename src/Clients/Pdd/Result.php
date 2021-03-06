<?php

namespace Young\Union\Clients\Pdd;

use Pimple\Container;
use Young\Union\Result\Result as BaseResult;

class Result extends BaseResult
{
    protected function resolveData()
    {
        $content = $this->getBody()->getContents();

        $result_data = $this->jsonToArray($content);

        if (!$result_data) {
            $result_data = [];
        }

        $result_data = current($result_data) ?? [];

        $this->dot($result_data);
    }

    /**
     * @return bool
     */
    public function isSuccess()
    {
        return $this->isStatusSuccess() && !$this->isEmpty() && !isset($this['error_code']);
    }

    public function getErrorMessage()
    {
        return $this['error_msg'] ?? \Young\Union\SDK::SERVICE_UNKNOWN_ERROR;
    }

    public function getErrorCode()
    {
        return $this['error_code'] ?? $this['code'];
    }

    public function getRequestId()
    {
        return $this['request_id'];
    }
}