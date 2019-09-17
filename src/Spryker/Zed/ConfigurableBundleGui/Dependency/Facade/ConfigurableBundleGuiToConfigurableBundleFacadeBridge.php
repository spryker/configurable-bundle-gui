<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleGui\Dependency\Facade;

use Generated\Shared\Transfer\ConfigurableBundleTemplateResponseTransfer;
use Generated\Shared\Transfer\ConfigurableBundleTemplateTransfer;

class ConfigurableBundleGuiToConfigurableBundleFacadeBridge implements ConfigurableBundleGuiToConfigurableBundleFacadeInterface
{
    /**
     * @var \Spryker\Zed\ConfigurableBundle\Business\ConfigurableBundleFacadeInterface
     */
    protected $configurableBundleFacade;

    /**
     * @param \Spryker\Zed\ConfigurableBundle\Business\ConfigurableBundleFacadeInterface $configurableBundleFacade
     */
    public function __construct($configurableBundleFacade)
    {
        $this->configurableBundleFacade = $configurableBundleFacade;
    }

    /**
     * @param int $idConfigurableBundleTemplate
     *
     * @return void
     */
    public function deactivateConfigurableBundleTemplateById(int $idConfigurableBundleTemplate): void
    {
        $this->configurableBundleFacade->deactivateConfigurableBundleTemplateById($idConfigurableBundleTemplate);
    }

    /**
     * @param int $idConfigurableBundleTemplate
     *
     * @return void
     */
    public function activateConfigurableBundleTemplateById(int $idConfigurableBundleTemplate): void
    {
        $this->configurableBundleFacade->activateConfigurableBundleTemplateById($idConfigurableBundleTemplate);
    }

    /**
     * @param int $idConfigurableBundleTemplate
     *
     * @return void
     */
    public function deleteConfigurableBundleTemplateById(int $idConfigurableBundleTemplate): void
    {
        $this->configurableBundleFacade->deleteConfigurableBundleTemplateById($idConfigurableBundleTemplate);
    }

    /**
     * @param \Generated\Shared\Transfer\ConfigurableBundleTemplateTransfer $configurableBundleTemplateTransfer
     *
     * @return \Generated\Shared\Transfer\ConfigurableBundleTemplateResponseTransfer
     */
    public function createConfigurableBundleTemplate(ConfigurableBundleTemplateTransfer $configurableBundleTemplateTransfer): ConfigurableBundleTemplateResponseTransfer
    {
        return $this->configurableBundleFacade->createConfigurableBundleTemplate($configurableBundleTemplateTransfer);
    }

    /**
     * @param \Generated\Shared\Transfer\ConfigurableBundleTemplateTransfer $configurableBundleTemplateTransfer
     *
     * @return \Generated\Shared\Transfer\ConfigurableBundleTemplateResponseTransfer
     */
    public function updateConfigurableBundleTemplate(ConfigurableBundleTemplateTransfer $configurableBundleTemplateTransfer): ConfigurableBundleTemplateResponseTransfer
    {
        return $this->configurableBundleFacade->updateConfigurableBundleTemplate($configurableBundleTemplateTransfer);
    }

    /**
     * @param int $idConfigurableBundleTemplate
     *
     * @return \Generated\Shared\Transfer\ConfigurableBundleTemplateTransfer|null
     */
    public function findConfigurableBundleTemplateById(int $idConfigurableBundleTemplate): ?ConfigurableBundleTemplateTransfer
    {
        return $this->configurableBundleFacade->findConfigurableBundleTemplateById($idConfigurableBundleTemplate);
    }
}
