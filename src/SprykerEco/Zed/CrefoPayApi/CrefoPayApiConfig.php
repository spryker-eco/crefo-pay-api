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
    /**
     * @api
     *
     * @return string
     */
    public function getCreateTransactionApiEndpoint(): string
    {
        return $this->get(CrefoPayApiConstants::CREATE_TRANSACTION_API_ENDPOINT);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getReserveApiEndpoint(): string
    {
        return $this->get(CrefoPayApiConstants::RESERVE_API_ENDPOINT);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getCaptureApiEndpoint(): string
    {
        return $this->get(CrefoPayApiConstants::CAPTURE_API_ENDPOINT);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getCancelApiEndpoint(): string
    {
        return $this->get(CrefoPayApiConstants::CANCEL_API_ENDPOINT);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getRefundApiEndpoint(): string
    {
        return $this->get(CrefoPayApiConstants::REFUND_API_ENDPOINT);
    }

    /**
     * @api
     *
     * @return string
     */
    public function getFinishApiEndpoint(): string
    {
        return $this->get(CrefoPayApiConstants::FINISH_API_ENDPOINT);
    }
}
