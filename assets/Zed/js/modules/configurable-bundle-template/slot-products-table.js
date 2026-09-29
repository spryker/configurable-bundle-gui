/**
 * Copyright (c) 2016-present Spryker Systems GmbH. All rights reserved.
 * Use of this software requires acceptance of the Evaluation License Agreement. See LICENSE file.
 */

'use strict';

var tableAccess = require('ZedGuiModules/libs/table/table-access');

var config = {
    slotTableColumnsMapping: {
        idSlot: 0,
        slotName: 1,
    },
};

var slotProductsTableLoadUrl =
    '/configurable-bundle-gui/template/slot-products-table?id-configurable-bundle-template-slot=';

var isInitialSelectionDone = false;
var selectedIdSlot = 0;
var slotHandle = null;
var slotProductsHandle = null;
var slotProductsUrl = null;
var $slotProductsTableWrapper = null;
var $slotProductsTableName = null;

/**
 * The server sends the slot ID column locale formatted, so a four digit ID arrives grouped - "1,234".
 * It is compared against the selected ID and sent to the server, so it is read back as a number rather
 * than used as the string the table shows.
 *
 * @param {string|number} value - Cell holding the slot ID.
 *
 * @returns {number} Slot ID the cell holds.
 */
function toIdSlot(value) {
    return parseInt(String(value).replace(/\D/g, ''), 10) || 0;
}

function init() {
    var slotTable = document.querySelector('#slot-table-wrapper table[id]');
    var slotProductsTable = document.querySelector('#slot-products-table-wrapper table[id]');

    $slotProductsTableWrapper = $('#slot-products-table-wrapper');
    $slotProductsTableName = $('#slot-products-table-name');

    if (!slotTable || !slotProductsTable) {
        return;
    }

    $(slotTable).on('click', 'tbody > tr:not(.child)', function () {
        selectSlot(slotHandle.raw().row(this));
    });

    tableAccess.requestTable(slotTable, function (handle) {
        slotHandle = handle;

        handle.on('draw', function () {
            slotTableDrawAction(handle.raw());
        });
    });

    tableAccess.requestTable(slotProductsTable, function (handle) {
        slotProductsHandle = handle;

        if (slotProductsUrl) {
            handle.reload(slotProductsUrl);
        }
    });
}

/**
 * @param {Object} api - Slot table API instance.
 */
function slotTableDrawAction(api) {
    $slotProductsTableWrapper.removeClass('hidden');

    if (!isInitialSelectionDone && api.rows().count() !== 0) {
        isInitialSelectionDone = true;
        selectInitialSlot(api);
    }

    markSelectedRows(api);
}

/**
 * @param {Object} api - Slot table API instance.
 */
function selectInitialSlot(api) {
    var initialSelectedIdSlot = getInitialSelectedIdSlot();

    if (!initialSelectedIdSlot) {
        selectSlot(api.row(0));

        return;
    }

    api.rows().every(function () {
        if (toIdSlot(this.data()[config.slotTableColumnsMapping.idSlot]) === initialSelectedIdSlot) {
            selectSlot(this);
        }
    });
}

/**
 * @param {Object} row - Row of the slot table the products are shown for.
 */
function selectSlot(row) {
    var rowData = row.data();

    if (!rowData) {
        return;
    }

    var idSlot = toIdSlot(rowData[config.slotTableColumnsMapping.idSlot]);

    if (idSlot === selectedIdSlot) {
        return;
    }

    selectedIdSlot = idSlot;
    loadSlotProductsTable();
    markSelectedRow($(row.node()));
    $slotProductsTableName.text(rowData[config.slotTableColumnsMapping.slotName]);
}

function loadSlotProductsTable() {
    slotProductsUrl = slotProductsTableLoadUrl + selectedIdSlot;

    if (slotProductsHandle) {
        slotProductsHandle.reload(slotProductsUrl);
    }
}

/**
 * @param {Object} api - Slot table API instance.
 */
function markSelectedRows(api) {
    api.rows().every(function () {
        if (toIdSlot(this.data()[config.slotTableColumnsMapping.idSlot]) === selectedIdSlot) {
            markSelectedRow($(this.node()));
        }
    });
}

function markSelectedRow($row) {
    $row.siblings().removeClass('selected');
    $row.addClass('selected');
}

function getInitialSelectedIdSlot() {
    return toIdSlot($('#selected-id-configurable-bundle-template-slot').val());
}

module.exports = {
    init: init,
};
