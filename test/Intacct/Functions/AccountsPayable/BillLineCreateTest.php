<?php

/**
 * Copyright 2020 Sage Intacct, Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"). You may not
 * use this file except in compliance with the License. You may obtain a copy
 * of the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * or in the "LICENSE" file accompanying this file. This file is distributed on
 * an "AS IS" BASIS, WITHOUT WARRANTIES OR CONDITIONS OF ANY KIND, either
 * express or implied. See the License for the specific language governing
 * permissions and limitations under the License.
 */

namespace Intacct\Functions\AccountsPayable;

use Intacct\Xml\XMLWriter;

/**
 * @coversDefaultClass \Intacct\Functions\AccountsPayable\BillLineCreate
 */
class BillLineCreateTest extends \PHPUnit\Framework\TestCase
{

    public function testDefaultParams()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<lineitem>
    <glaccountno></glaccountno>
    <amount>76343.43</amount>
</lineitem>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $line = new BillLineCreate();
        $line->setTransactionAmount(76343.43);

        $line->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }

    public function testParamOverrides()
    {
        $expected = <<<EOF
<?xml version="1.0" encoding="UTF-8"?>
<lineitem>
    <accountlabel>TestBill Account1</accountlabel>
    <offsetglaccountno>93590253</offsetglaccountno>
    <amount>76343.43</amount>
    <memo>Just another memo</memo>
    <locationid>Location1</locationid>
    <departmentid>Department1</departmentid>
    <item1099>true</item1099>
    <form1099type>1099-MISC</form1099type>
    <form1099box>3</form1099box>
    <key>Key1</key>
    <totalpaid>23484.93</totalpaid>
    <totaldue>0</totaldue>
    <customfields>
        <customfield>
            <customfieldname>customfield1</customfieldname>
            <customfieldvalue>customvalue1</customfieldvalue>
        </customfield>
    </customfields>
    <projectid>Project1</projectid>
    <customerid>Customer1</customerid>
    <vendorid>Vendor1</vendorid>
    <employeeid>Employee1</employeeid>
    <itemid>Item1</itemid>
    <classid>Class1</classid>
    <contractid>Contract1</contractid>
    <warehouseid>Warehouse1</warehouseid>
    <billable>true</billable>
</lineitem>
EOF;

        $xml = new XMLWriter();
        $xml->openMemory();
        $xml->setIndent(true);
        $xml->setIndentString('    ');
        $xml->startDocument();

        $line = new BillLineCreate();
        $line->setAccountLabel('TestBill Account1');
        $line->setOffsetGLAccountNumber('93590253');
        $line->setTransactionAmount(76343.43);
        $line->setMemo('Just another memo');
        $line->setForm1099(true);
        $line->setForm1099type('1099-MISC');
        $line->setForm1099box('3');
        $line->setKey('Key1');
        $line->setTotalPaid(23484.93);
        $line->setTotalDue(0.00);
        $line->setBillable(true);
        $line->setLocationId('Location1');
        $line->setDepartmentId('Department1');
        $line->setProjectId('Project1');
        $line->setCustomerId('Customer1');
        $line->setVendorId('Vendor1');
        $line->setEmployeeId('Employee1');
        $line->setItemId('Item1');
        $line->setClassId('Class1');
        $line->setContractId('Contract1');
        $line->setWarehouseId('Warehouse1');
        $line->setCustomFields([
            'customfield1' => 'customvalue1',
        ]);

        $line->writeXml($xml);

        $this->assertXmlStringEqualsXmlString($expected, $xml->flush());
    }
}
