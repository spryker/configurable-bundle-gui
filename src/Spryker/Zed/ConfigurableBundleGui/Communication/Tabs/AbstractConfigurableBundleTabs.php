<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleGui\Communication\Tabs;

use Generated\Shared\Transfer\TabItemTransfer;
use Generated\Shared\Transfer\TabsViewTransfer;
use Spryker\Zed\Gui\Communication\Tabs\AbstractTabs;

class AbstractConfigurableBundleTabs extends AbstractTabs
{
    /**
     * @var string
     */
    protected const GENERAL_TAB_NAME = 'General';

    /**
     * @var string
     */
    protected const GENERAL_TAB_TEMPLATE = '@ConfigurableBundleGui/Template/tabs/general-tab.twig';

    /**
     * @var string
     */
    protected const FOOTER_TEMPLATE = '@ConfigurableBundleGui/Template/_partials/submit-button.twig';

    /**
     * @param \Generated\Shared\Transfer\TabsViewTransfer $tabsViewTransfer
     *
     * @return \Generated\Shared\Transfer\TabsViewTransfer
     */
    protected function build(TabsViewTransfer $tabsViewTransfer): TabsViewTransfer
    {
        $this->addGeneralTab($tabsViewTransfer)
            ->setFooterTemplate($tabsViewTransfer);

        $tabsViewTransfer->setIsNavigable(true);

        return $tabsViewTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\TabsViewTransfer $tabsViewTransfer
     *
     * @return $this
     */
    protected function addGeneralTab(TabsViewTransfer $tabsViewTransfer)
    {
        $tabItemTransfer = (new TabItemTransfer())
            ->setName(strtolower(static::GENERAL_TAB_NAME))
            ->setTitle(static::GENERAL_TAB_NAME)
            ->setTemplate(static::GENERAL_TAB_TEMPLATE);

        $tabsViewTransfer->addTab($tabItemTransfer);

        return $this;
    }

    /**
     * @param \Generated\Shared\Transfer\TabsViewTransfer $tabsViewTransfer
     *
     * @return $this
     */
    protected function setFooterTemplate(TabsViewTransfer $tabsViewTransfer)
    {
        $tabsViewTransfer->setFooterTemplate(static::FOOTER_TEMPLATE);

        return $this;
    }
}
