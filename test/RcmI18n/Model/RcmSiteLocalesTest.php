<?php

namespace RcmI18nTest\Model;

use Rcm\Api\Repository\Site\FindActiveSites;
use Rcm\Entity\Country;
use Rcm\Entity\Language;
use Rcm\Entity\Site;
use RcmI18n\Model\RcmSiteLocales;

require __DIR__ . '/../../autoload.php';

/**
 * LocalesTest
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmI18nTest\Model
 * @author    Rod Mcnew <rmcnew@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   Release: <package_version>
 * @link      https://github.com/reliv
 * @covers    \RcmI18n\Model\RcmSiteLocales
 */
class RcmSiteLocalesTest extends \PHPUnit_Framework_TestCase
{
    /**
     * @var RcmSiteLocales
     */
    protected $unit;

    public function setup()
    {
        $country = new Country('user123');
        $country->setIso2('US');
        $lang = new Language('user123');
        $lang->setIso6391('en');
        $site = new Site('user123');
        $site->setCountry($country);
        $site->setLanguage($lang);
        $findActiveSites= $this->getMockBuilder(FindActiveSites::class)
            ->disableOriginalConstructor()->getMock();
        $findActiveSites->expects($this->any())
            ->method('__invoke')
            ->will($this->returnValue([$site]));


        $this->unit = new RcmSiteLocales($findActiveSites);
    }

    public function testConstructAndGetLocales()
    {
        $this->assertEquals(['en_US' => 'United States - English'], $this->unit->getLocales());
    }

    public function testLocalIsValidTrue()
    {
        $this->assertTrue($this->unit->localeIsValid('en_US'));
    }

    public function testLocalIsValidFalse()
    {
        $this->assertFalse($this->unit->localeIsValid('rodrardovania'));
    }
} 
