<?php

/**
 * MIT License
 * For full license information, please view the LICENSE file that was distributed with this source code.
 */

namespace SprykerEco\Zed\CrefoPayApi\Business\Client;

use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiResponseTransfer;
use GuzzleHttp\Exception\RequestException;
use Spryker\Shared\Kernel\Transfer\Exception\RequiredTransferPropertyException;

class CrefoPayApiClient implements CrefoPayApiClientInterface
{
    /**
     * @var \GuzzleHttp\ClientInterface
     */
    protected $client;

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Business\Request\CrefoPayApiRequestInterface
     */
    protected $request;

    /**
     * @var \SprykerEco\Zed\CrefoPayApi\Business\Converter\CrefoPayApiConverterInterface
     */
    protected $converter;

    public function performRequest(CrefoPayApiRequestTransfer $requestTransfer): CrefoPayApiResponseTransfer
    {
        $method = $this->getMethod();

        try {
            /** @var \Psr\Http\Message\ResponseInterface $response */
            $response = $this->client->$method(
                $this->request->getUrl(),
                $this->request->getRequestOptions($requestTransfer)
            );

            return $this->converter->convertToResponseTransfer($response);

        } catch (RequestException $requestException) {
            $response = $requestException->getResponse();
            return;
        } catch (RequiredTransferPropertyException $requiredTransferPropertyException) {
            return;
        }
    }

    /**
     * @return string
     */
    protected function getMethod(): string
    {
        return strtolower($this->request->getHttpMethod());
    }
}