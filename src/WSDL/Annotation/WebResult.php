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
namespace WSDL\Annotation;

use Doctrine\Common\Annotations\Annotation\Required;
use ReflectionMethod;
use WSDL\Builder\MethodBuilder;
use WSDL\Builder\Parameter;
use WSDL\Lexer\Tokenizer;

/**
 * WebResult
 *
 * @author Piotr Olaszewski <piotroo89@gmail.com>
 *
 * @Annotation
 * @Target("METHOD")
 */
class WebResult implements MethodAnnotationBuilder
{
    /**
     * @var string
     * @Required
     */
    public $param;

    /**
     * @inheritdoc
     */
    public function build(MethodBuilder $builder, ReflectionMethod $method)
    {
        $tokenizer = new Tokenizer();
        $builder->setReturn(Parameter::fromTokens($tokenizer->lex($this->param)));
    }
}
