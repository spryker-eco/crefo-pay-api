<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace SprykerEco\Zed\CrefoPayApi\Communication\Console;

use Spryker\Zed\Kernel\Communication\Console\Console;
use Symfony\Component\Console\Input\InputInterface;
use Symfony\Component\Console\Output\OutputInterface;

/**
 * @method \SprykerEco\Zed\CrefoPayApi\Business\CrefoPayApiFacadeInterface getFacade()
 * @method \SprykerEco\Zed\CrefoPayApi\Communication\CrefoPayApiCommunicationFactory getFactory()
 */
class RequestConsole extends Console
{
    public const COMMAND_NAME = 'crefo-pay-api:api-request:request';
    public const COMMAND_DESCRIPTION = 'Make Request to CrefoPay API.';

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
        $facade = $this->getFacade();
        $messenger = $this->getMessenger();

        //$response = $app->performAuthorizeApiCall($this->createRequestTransfer());
        //echo json_encode($response->toArray(true, true), JSON_PRETTY_PRINT);
    }
}
