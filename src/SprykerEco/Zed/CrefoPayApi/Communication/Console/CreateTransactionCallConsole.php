<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\CrefoPayApi\Communication\Console;

use ArrayObject;
use Generated\Shared\Transfer\CrefoPayApiAddressTransfer;
use Generated\Shared\Transfer\CrefoPayApiAmountTransfer;
use Generated\Shared\Transfer\CrefoPayApiBasketItemTransfer;
use Generated\Shared\Transfer\CrefoPayApiCreateTransactionRequestTransfer;
use Generated\Shared\Transfer\CrefoPayApiPersonTransfer;
use Generated\Shared\Transfer\CrefoPayApiRequestTransfer;
use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \SprykerEco\Zed\CrefoPayApi\Business\CrefoPayApiFacadeInterface getFacade()
 * @method \SprykerEco\Zed\CrefoPayApi\Communication\CrefoPayApiCommunicationFactory getFactory()
 */
class CreateTransactionCallConsole extends Console
{
    public const COMMAND_NAME = 'crefo-pay-api:create-transaction';
    public const COMMAND_DESCRIPTION = 'Perform CreateTransaction API call to CrefoPay';

    /**
     * @return void
     */
    protected function configure()
    {
        parent::configure();
        $this
            ->setName(static::COMMAND_NAME)
            ->setDescription(static::COMMAND_DESCRIPTION)
            ->setHelp('<info>' . static::COMMAND_NAME . ' -h</info>');
    }

    /**
     * @param \Symfony\Component\Console\Input\InputInterface $input
     * @param \Symfony\Component\Console\Output\OutputInterface $output
     *
     * @return void
     */
    public function execute(InputInterface $input, OutputInterface $output)
    {
        $response = $this->getFacade()->performCreateTransactionApiCall($this->createRequestTransfer());
        echo json_encode($response->toArray(true, true), JSON_PRETTY_PRINT);
    }

    /**
     * @return \Generated\Shared\Transfer\CrefoPayApiRequestTransfer
     */
    protected function createRequestTransfer(): CrefoPayApiRequestTransfer
    {
        $request = new CrefoPayApiRequestTransfer();
        $request->setCreateTransactionRequest($this->createRequestCallTransfer());

        return $request;
    }

    protected function createRequestCallTransfer()
    {
        return (new CrefoPayApiCreateTransactionRequestTransfer())
            ->setMerchantID(265)
            ->setStoreID('sprykerdevelEUR')
            ->setOrderID('test-order-id1')
            ->setUserID('user-id')
            ->setIntegrationType('API')
            ->setAutoCapture('false')
            ->setMerchantReference('reference')
            ->setContext('ONLINE')
            ->setUserType('PRIVATE')
            ->setUserRiskClass(0)
            ->setUserIpAddress('127.0.0.1')
            ->setUserData(
                (new CrefoPayApiPersonTransfer())
                    ->setSalutation('M')
                    ->setName('Aleksey')
                    ->setSurname('Kotsuba')
                    ->setDateOfBirth('1988-10-22')
                    ->setEmail('aleksey.kotsuba@spryker.com')
                    ->setPhoneNumber('0380937880368')
            )
            ->setBillingAddress(
                (new CrefoPayApiAddressTransfer())
                    ->setZip('123456')
                    ->setCountry('DE')
                    ->setCity('Berlin')
                    ->setStreet('Test street')
                    ->setNo('12')
            )
            ->setAmount(
                (new CrefoPayApiAmountTransfer())
                    ->setAmount(1922)
                    ->setVatAmount(19)
                    ->setVatRate(10.00)
            )
            ->setBasketItems($this->createBasket())
            ->setLocale('EN');
    }

    protected function createBasket()
    {
        $basket = new ArrayObject();
        $basket->append(
                (new CrefoPayApiBasketItemTransfer())
                    ->setBasketItemAmount(
                        (new CrefoPayApiAmountTransfer())
                            ->setAmount(1922)
                            ->setVatAmount(19)
                            ->setVatRate(10.00)
                    )
                    ->setBasketItemCount(1)
                    ->setBasketItemID('sku')
                    ->setBasketItemText('Description')
                    ->setBasketItemRiskClass(0)
                    ->setBasketItemType('DEFAULT')
            );

        return $basket;
    }
}
