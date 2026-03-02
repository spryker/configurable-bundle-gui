<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleGui\Communication\Tabs;

use Generated\Shared\Transfer\TabsViewTransfer;

class ConfigurableBundleTemplateSlotEditTabs extends AbstractConfigurableBundleTabs
{
    /**
     * @var string
     */
    protected const GENERAL_TAB_TEMPLATE = '@ConfigurableBundleGui/Slot/tabs/general-tab.twig';

    /**
     * @var array<\Spryker\Zed\ConfigurableBundleGuiExtension\Dependency\Plugin\ConfigurableBundleTemplateSlotEditTabsExpanderPluginInterface>
     */
    protected $configurableBundleTemplateSlotEditTabsExpanderPlugins;

    /**
     * @param array<\Spryker\Zed\ConfigurableBundleGuiExtension\Dependency\Plugin\ConfigurableBundleTemplateSlotEditTabsExpanderPluginInterface> $configurableBundleTemplateSlotEditTabsExpanderPlugins
     */
    public function __construct(array $configurableBundleTemplateSlotEditTabsExpanderPlugins)
    {
        $this->configurableBundleTemplateSlotEditTabsExpanderPlugins = $configurableBundleTemplateSlotEditTabsExpanderPlugins;
    }

    protected function build(TabsViewTransfer $tabsViewTransfer): TabsViewTransfer
    {
        $tabsViewTransfer = parent::build($tabsViewTransfer);

        return $this->executeExpanderPlugins($tabsViewTransfer);
    }

    protected function executeExpanderPlugins(TabsViewTransfer $tabsViewTransfer): TabsViewTransfer
    {
        foreach ($this->configurableBundleTemplateSlotEditTabsExpanderPlugins as $configurableBundleTemplateSlotEditTabsExpanderPlugin) {
            $tabsViewTransfer = $configurableBundleTemplateSlotEditTabsExpanderPlugin->expand($tabsViewTransfer);
        }

        return $tabsViewTransfer;
    }
}
