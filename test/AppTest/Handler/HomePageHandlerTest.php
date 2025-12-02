<?php
/**
 * Bifurcation
 * @author Flávio Gomes da Silva Lisboa *
 * @copyright www.fgsl.eti.br 2025
 * @license LGPLv3
 */

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\HomePageHandler;
use App\Model\WorkflowsInterface;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\Response\JsonResponse;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

final class HomePageHandlerTest extends TestCase
{
    /** @var ContainerInterface&MockObject */
    protected $container;

    /** @var RouterInterface&MockObject */
    protected $router;

    protected function setUp(): void
    {
        $this->container = require __DIR__ . '/../../../config/container.php';
    }

    public function testReturnsHtmlResponseWhenTemplateRendererProvided(): void
    {
        $workflows = $this->createMock(WorkflowsInterface::class);
        $renderer = $this->createMock(TemplateRendererInterface::class);
        $renderer
            ->expects($this->once())
            ->method('render')
            ->with('app::home-page', $this->isType('array'))
            ->willReturn('');

        $homePage = new HomePageHandler(
            $workflows,
            $renderer
        );

        $response = $homePage->handle(
            $this->createMock(ServerRequestInterface::class)
        );

        self::assertInstanceOf(HtmlResponse::class, $response);
    }
}
