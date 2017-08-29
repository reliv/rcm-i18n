<?php
/**
 * MessagesControllerTest.php
 *
 * LongDescHere
 *
 * PHP version 5
 *
 * @category  Reliv
 * @package   RcmI18nTest\Controller
 * @author    James Jervis <jjervis@relivinc.com>
 * @copyright 2014 Reliv International
 * @license   License.txt New BSD License
 * @version   GIT: <git_id>
 * @link      https://github.com/reliv
 */

namespace RcmI18nTest\Controller;

require __DIR__ . '/../../autoload.php';

use RcmI18n\Api\Acl\IsAllowed;
use RcmI18n\Controller\MessagesController;
use RcmUser\Service\RcmUserService;
use Zend\Http\Response;
use Zend\ServiceManager\ServiceManager;

class MessagesControllerTest extends \PHPUnit_Framework_TestCase
{

    public function testUpdate()
    {
        $isAllowed = $this
            ->getMockBuilder(IsAllowed::class)
            ->disableOriginalConstructor()
            ->getMock();

        $isAllowed->expects($this->any())
            ->method('__invoke')
            ->will($this->returnValue(false));

        $serviceMgr = new ServiceManager();
        $serviceMgr->setService(IsAllowed::class, $isAllowed);

        $messagesController = new MessagesControllerWrapper();
        $messagesController->setServiceLocator($serviceMgr);
        $messagesController->testRcmIsAllowedResult = false;

        $result = $messagesController->update(
            'DEFAULT',
            []
        );

        $this->assertInstanceOf(
            '\Zend\Http\PhpEnvironment\Response',
            $result
        );

        $this->assertEquals(
            $result->getStatusCode(),
            Response::STATUS_CODE_401
        );

    }
}

class MessagesControllerWrapper extends MessagesController
{

    public $testRcmIsAllowedResult = false;

    public function rcmIsAllowed()
    {
        return $this->testRcmIsAllowedResult;
    }
}
