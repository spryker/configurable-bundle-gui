<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleGui\Communication\Form;

use Generated\Shared\Transfer\ConfigurableBundleTemplateTranslationTransfer;

/**
 * @method \Spryker\Zed\ConfigurableBundleGui\ConfigurableBundleGuiConfig getConfig()
 * @method \Spryker\Zed\ConfigurableBundleGui\Communication\ConfigurableBundleGuiCommunicationFactory getFactory()
 */
class ConfigurableBundleTemplateTranslationForm extends AbstractConfigurableBundleTranslationForm
{
    public function getBlockPrefix(): string
    {
        return 'configurable_bundle_template_translations';
    }

    protected function getDefaultOptions(): array
    {
        return [
            static::OPTION_DATA_CLASS => ConfigurableBundleTemplateTranslationTransfer::class,
        ];
    }
}
