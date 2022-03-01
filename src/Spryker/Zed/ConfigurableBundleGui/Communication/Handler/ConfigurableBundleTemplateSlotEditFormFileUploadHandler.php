<?php

/**
 * Copyright © 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

namespace Spryker\Zed\ConfigurableBundleGui\Communication\Handler;

use Generated\Shared\Transfer\ConfigurableBundleTemplateSlotEditFormTransfer;
use Spryker\Zed\ConfigurableBundleGuiExtension\Dependency\Plugin\ConfigurableBundleTemplateSlotEditFormFileUploadHandlerPluginInterface;
use Symfony\Component\Form\FormInterface;
use Symfony\Component\HttpFoundation\File\UploadedFile;

class ConfigurableBundleTemplateSlotEditFormFileUploadHandler implements ConfigurableBundleTemplateSlotEditFormFileUploadHandlerInterface
{
    /**
     * @phpstan-var non-empty-string
     *
     * @var string
     */
    protected const FIELD_PATH_SEPARATOR = '.';

    /**
     * @var array<\Spryker\Zed\ConfigurableBundleGuiExtension\Dependency\Plugin\ConfigurableBundleTemplateSlotEditFormFileUploadHandlerPluginInterface>
     */
    protected $configurableBundleTemplateSlotEditFormFileUploadHandlerPlugins;

    /**
     * @param array<\Spryker\Zed\ConfigurableBundleGuiExtension\Dependency\Plugin\ConfigurableBundleTemplateSlotEditFormFileUploadHandlerPluginInterface> $configurableBundleTemplateSlotEditFormFileUploadHandlerPlugins
     */
    public function __construct(array $configurableBundleTemplateSlotEditFormFileUploadHandlerPlugins)
    {
        $this->configurableBundleTemplateSlotEditFormFileUploadHandlerPlugins = $configurableBundleTemplateSlotEditFormFileUploadHandlerPlugins;
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $configurableBundleTemplateSlotEditForm
     * @param \Generated\Shared\Transfer\ConfigurableBundleTemplateSlotEditFormTransfer $configurableBundleTemplateSlotEditFormTransfer
     *
     * @return \Generated\Shared\Transfer\ConfigurableBundleTemplateSlotEditFormTransfer
     */
    public function handleFileUploads(
        FormInterface $configurableBundleTemplateSlotEditForm,
        ConfigurableBundleTemplateSlotEditFormTransfer $configurableBundleTemplateSlotEditFormTransfer
    ): ConfigurableBundleTemplateSlotEditFormTransfer {
        foreach ($this->configurableBundleTemplateSlotEditFormFileUploadHandlerPlugins as $configurableBundleTemplateSlotEditFormFileUploadHandlerPlugin) {
            $configurableBundleTemplateSlotEditFormTransfer = $this->executeConfigurableBundleTemplateSlotEditFormFileUploadHandlerPlugin(
                $configurableBundleTemplateSlotEditFormFileUploadHandlerPlugin,
                $configurableBundleTemplateSlotEditForm,
                $configurableBundleTemplateSlotEditFormTransfer,
            );
        }

        return $configurableBundleTemplateSlotEditFormTransfer;
    }

    /**
     * @param \Spryker\Zed\ConfigurableBundleGuiExtension\Dependency\Plugin\ConfigurableBundleTemplateSlotEditFormFileUploadHandlerPluginInterface $configurableBundleTemplateSlotEditFormFileUploadHandlerPlugin
     * @param \Symfony\Component\Form\FormInterface $configurableBundleTemplateSlotEditForm
     * @param \Generated\Shared\Transfer\ConfigurableBundleTemplateSlotEditFormTransfer $configurableBundleTemplateSlotEditFormTransfer
     *
     * @return \Generated\Shared\Transfer\ConfigurableBundleTemplateSlotEditFormTransfer
     */
    protected function executeConfigurableBundleTemplateSlotEditFormFileUploadHandlerPlugin(
        ConfigurableBundleTemplateSlotEditFormFileUploadHandlerPluginInterface $configurableBundleTemplateSlotEditFormFileUploadHandlerPlugin,
        FormInterface $configurableBundleTemplateSlotEditForm,
        ConfigurableBundleTemplateSlotEditFormTransfer $configurableBundleTemplateSlotEditFormTransfer
    ): ConfigurableBundleTemplateSlotEditFormTransfer {
        $uploadedFile = $this->getFormFieldByPath(
            $configurableBundleTemplateSlotEditForm,
            $configurableBundleTemplateSlotEditFormFileUploadHandlerPlugin->getFieldPath(),
        )->getData();

        if (!$uploadedFile instanceof UploadedFile) {
            return $configurableBundleTemplateSlotEditFormTransfer;
        }

        return $configurableBundleTemplateSlotEditFormFileUploadHandlerPlugin->handleFileUpload(
            $uploadedFile,
            $configurableBundleTemplateSlotEditFormTransfer,
        );
    }

    /**
     * @param \Symfony\Component\Form\FormInterface $form
     * @param string $fieldPath
     *
     * @return \Symfony\Component\Form\FormInterface
     */
    protected function getFormFieldByPath(FormInterface $form, string $fieldPath): FormInterface
    {
        $formField = clone $form;

        foreach (explode(static::FIELD_PATH_SEPARATOR, $fieldPath) as $fieldName) {
            $formField = $formField->get($fieldName);
        }

        return $formField;
    }
}
