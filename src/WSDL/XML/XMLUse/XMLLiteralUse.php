<?php
/**
 * Copyright (C) 2013-2016
 * Piotr Olaszewski <piotroo89@gmail.com>
 *
 * Permission is hereby granted, free of charge, to any person obtaining a copy
 * of this software and associated documentation files (the "Software"), to deal
 * in the Software without restriction, including without limitation the rights
 * to use, copy, modify, merge, publish, distribute, sublicense, and/or sell
 * copies of the Software, and to permit persons to whom the Software is
 * furnished to do so, subject to the following conditions:
 *
 * The above copyright notice and this permission notice shall be included in
 * all copies or substantial portions of the Software.
 *
 * THE SOFTWARE IS PROVIDED "AS IS", WITHOUT WARRANTY OF ANY KIND, EXPRESS OR
 * IMPLIED, INCLUDING BUT NOT LIMITED TO THE WARRANTIES OF MERCHANTABILITY,
 * FITNESS FOR A PARTICULAR PURPOSE AND NONINFRINGEMENT. IN NO EVENT SHALL THE
 * AUTHORS OR COPYRIGHT HOLDERS BE LIABLE FOR ANY CLAIM, DAMAGES OR OTHER
 * LIABILITY, WHETHER IN AN ACTION OF CONTRACT, TORT OR OTHERWISE, ARISING FROM,
 * OUT OF OR IN CONNECTION WITH THE SOFTWARE OR THE USE OR OTHER DEALINGS IN THE
 * SOFTWARE.
 */
namespace WSDL\XML\XMLUse;

use DOMDocument;
use WSDL\Builder\Parameter;
use WSDL\XML\XMLAttributeHelper;

/**
 * XMLLiteralUse
 *
 * @author Piotr Olaszewski <piotroo89@gmail.com>
 */
class XMLLiteralUse implements XMLUse
{
    /**
     * @inheritdoc
     */
    public function generateSoapBody(DOMDocument $DOMDocument, $targetNamespace, $soapVersion)
    {
        return XMLAttributeHelper::forDOM($DOMDocument)
            ->createElementWithAttributes($soapVersion . ':body', array(
                'use' => 'literal',
                'namespace' => $targetNamespace
            ));
    }

    /**
     * @inheritdoc
     */
    public function generateSoapHeaderIfNeeded(DOMDocument $DOMDocument, $targetNamespace, $soapHeaderMessage = '', Parameter $header = null, $soapVersion)
    {
        if ($header) {
            return XMLAttributeHelper::forDOM($DOMDocument)
                ->createElementWithAttributes($soapVersion . ':header', array(
                    'use' => 'literal',
                    'namespace' => $targetNamespace,
                    'part' => $header->getNode()->getSanitizedName(),
                    'message' => $soapHeaderMessage
                ));
        }
        return null;
    }
}
