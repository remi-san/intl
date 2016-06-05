<?php

namespace RemiSan\Intl\Test;

use RemiSan\Intl\ResourceTranslator;
use RemiSan\Intl\TranslatableResource;

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
        $r = new TranslatableResource('testprice', ['name'=>'Jean', 'amount'=>22.5]);
        $translated = $rt->translate('fr_FR', $r);

        $this->assertEquals('Hey Jean 22,50 € !', $translated);
    }

    /**
     * @test
     */
    public function itShouldTranslateToEnglish()
    {
        $rt = new ResourceTranslator(realpath(__DIR__.'/../i18n/compiled'));
        $r = new TranslatableResource('testprice', ['name'=>'John', 'amount'=>22.5]);
        $translated = $rt->translate('en_US', $r);

        $this->assertEquals('Hello John $22.50!', $translated);
    }

    /**
     * @test
     */
    public function itShouldNotBeAbleToTranslateToEnglishIfKeyOsNotPresent()
    {
        $rt = new ResourceTranslator(realpath(__DIR__.'/../i18n/compiled'));
        $r = new TranslatableResource('hello', ['name'=>'John', 'amount'=>22.5]);

        $this->setExpectedException(\IntlException::class);

        $rt->translate('en_US', $r);
    }

    /**
     * @test
     */
    public function itShouldNotBeAblToTranslateToGerman()
    {
        $rt = new ResourceTranslator(realpath(__DIR__.'/../i18n/src'));
        $r = new TranslatableResource('testprice', ['name'=>'Johannes', 'amount'=>22.5]);

        $this->setExpectedException(\IntlException::class);

        $rt->translate('de_DE', $r);
    }
}
