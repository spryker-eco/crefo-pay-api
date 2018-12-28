<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Builder\Request;

use ArrayObject;
use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\CrefoPayApiRequestValidatorInterface;

abstract class AbstractRequestBuilder implements CrefoPayApiRequestBuilderInterface
{
    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\CrefoPayApiRequestValidatorInterface
     */
    protected $validator;

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    abstract protected function convertRequestTransferToArray(CrefoPayApiRequestTransfer $requestTransfer): array;

    /**
     * @param \SprykerEco\Zed\CrefoPayApi\Business\Validator\Request\CrefoPayApiRequestValidatorInterface $validator
     */
    public function __construct(CrefoPayApiRequestValidatorInterface $validator)
    {
        $this->validator = $validator;
    }

    /**
     * @param \Generated\Shared\Transfer\CrefoPayApiRequestTransfer $requestTransfer
     *
     * @return array
     */
    public function buildRequestPayload(CrefoPayApiRequestTransfer $requestTransfer): array
    {
        $this->validator->validate($requestTransfer);
        $requestPayload = $this->convertRequestTransferToArray($requestTransfer);

        return $this->removeRedundantParams($requestPayload);
    }

    /**
     * @param array $data
     *
     * @return array
     */
    protected function removeRedundantParams(array $data): array
    {
        $data = array_filter($data, function ($item) {
            if ($item instanceof ArrayObject) {
                return $item->count() !== 0;
            }
            return !empty($item);
        });

        foreach ($data as $key => $value) {
            if (is_array($value) || $value instanceof ArrayObject) {
                $data[$key] = $this->removeRedundantParams($value);
            }
        }

        return $data;
    }
}
