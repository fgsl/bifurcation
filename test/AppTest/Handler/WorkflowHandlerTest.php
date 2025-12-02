<?php
/**
 * Bifurcation
 * @author Flávio Gomes da Silva Lisboa *
 * @copyright www.fgsl.eti.br 2025
 * @license LGPLv3
 */

declare(strict_types=1);

namespace AppTest\Handler;

use App\Handler\WorkflowHandler;
use App\Model\FilesystemStorage;
use Laminas\Diactoros\Response\HtmlResponse;
use Laminas\Diactoros\ServerRequest;
use Laminas\Diactoros\Uri;
use Mezzio\Router\RouteResult;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use PHPUnit\Framework\MockObject\MockObject;
use PHPUnit\Framework\TestCase;
use Psr\Container\ContainerInterface;
use Psr\Http\Message\ServerRequestInterface;

final class WorkflowHandlerTest extends TestCase
{
    /** @var ContainerInterface&MockObject */
    protected $container;

    /** @var RouterInterface&MockObject */
    protected $router;

    protected function setUp(): void
    {
        $this->container = $this->createMock(ContainerInterface::class);
        $this->router    = $this->createMock(RouterInterface::class);
        $routeResult = $this->createMock(RouteResult::class);
        $routeResult
            ->expects($this->once())
            ->method('getMatchedParams')
            ->willReturn(['name' => 'sample', 'path'=>'2']);
        $this->router
            ->expects($this->once())
            ->method('match')
            ->willReturn($routeResult);
    }

    public function testReturnsHtmlResponseWhenTemplateRendererProvided(): void
    {
        $renderer = $this->createMock(TemplateRendererInterface::class);
        $renderer
            ->expects($this->once())
            ->method('render')
            ->with('app::workflow', $this->isType('array'))
            ->willReturn('');

        $page = new WorkflowHandler(
            $this->router,
            $renderer,
            new FilesystemStorage()
        );

        $request = (new ServerRequest())
            ->withMethod('GET')
            ->withUri(new Uri('https://localhost/workflow/sample/2'));
        
        $response = $page->handle($request);

        self::assertInstanceOf(HtmlResponse::class, $response);
    }
}
