<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi;

use Spryker\Zed\Kernel\AbstractBundleConfig;
use SprykerEco\Shared\CrefoPayApi\CrefoPayApiConstants;

class CrefoPayApiConfig extends AbstractBundleConfig
{
    protected const API_FIELD_MAC = 'mac';
    protected const API_RESPONSE_FIELD_RESULT_CODE = 'resultCode';
    protected const API_ERROR_TYPE_EXTERNAL = 'EXTERNAL';

    /**
     * @return string
     */
    public function getCreateTransactionActionUrl(): string
    {
        return $this->get(CrefoPayApiConstants::CREATE_TRANSACTION_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getReserveActionUrl(): string
    {
        return $this->get(CrefoPayApiConstants::RESERVE_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getCaptureActionUrl(): string
    {
        return $this->get(CrefoPayApiConstants::CAPTURE_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getCancelActionUrl(): string
    {
        return $this->get(CrefoPayApiConstants::CANCEL_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getRefundActionUrl(): string
    {
        return $this->get(CrefoPayApiConstants::REFUND_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getFinishActionUrl(): string
    {
        return $this->get(CrefoPayApiConstants::FINISH_ACTION_URL);
    }

    /**
     * @return string
     */
    public function getApiFieldMac(): string
    {
        return static::API_FIELD_MAC;
    }

    /**
     * @return string
     */
    public function getApiResponseFieldResultCode(): string
    {
        return static::API_RESPONSE_FIELD_RESULT_CODE;
    }

    /**
     * @return string
     */
    public function getApiErrorTypeExternal(): string
    {
        return static::API_ERROR_TYPE_EXTERNAL;
    }
}
