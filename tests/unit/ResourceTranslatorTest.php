<?php

namespace RemiSan\Intl\Test;

use RemiSan\Intl\ResourceTranslator;

class ResourceTranslatorTest extends \PHPUnit_Framework_TestCase
{
    public function setUp()
    {
    }

    public function tearDown()
    {
        \Mockery::close();
    }

    /**
     * @test
     */
    public function itShouldTranslateToFrench()
    {
        $rt = new ResourceTranslator(realpath(__DIR__.'/../i18n/compiled'));
        $translated = $rt->translate('fr_FR', 'testprice', ['name'=>'Jean', 'amount'=>22.5]);

        $this->assertEquals('Hey Jean 22,50 € !', $translated);
    }

    /**
     * @test
     */
    public function itShouldTranslateToEnglish()
    {
        $rt = new ResourceTranslator(realpath(__DIR__.'/../i18n/compiled'));
        $translated = $rt->translate('en_US', 'testprice', ['name'=>'John', 'amount'=>22.5]);

        $this->assertEquals('Hello John $22.50!', $translated);
    }

    /**
     * @test
     */
    public function itShouldNotBeAbleToTranslateToEnglishIfKeyOsNotPresent()
    {
        $rt = new ResourceTranslator(realpath(__DIR__.'/../i18n/compiled'));

        $this->setExpectedException(\IntlException::class);

        $rt->translate('en_US', 'hello', ['name'=>'John', 'amount'=>22.5]);
    }

    /**
     * @test
     */
    public function itShouldNotBeAblToTranslateToGerman()
    {
        $rt = new ResourceTranslator(realpath(__DIR__.'/../i18n/src'));

        $this->setExpectedException(\IntlException::class);

        $rt->translate('de_DE', 'testprice', ['name'=>'Johannes', 'amount'=>22.5]);
    }
}
