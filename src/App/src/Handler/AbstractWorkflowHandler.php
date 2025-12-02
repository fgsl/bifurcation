<?php
/**
 * Bifurcation
 * @author Flávio Gomes da Silva Lisboa *
 * @copyright www.fgsl.eti.br 2025
 * @license LGPLv3
 */

declare(strict_types=1);

namespace App\Handler;

use App\Model\StorageInterface;
use App\Model\Tree;
use App\Model\Workflow;
use Laminas\Diactoros\Response\HtmlResponse;
use Mezzio\Router\RouterInterface;
use Mezzio\Template\TemplateRendererInterface;
use Psr\Http\Message\ResponseInterface;
use Psr\Http\Message\ServerRequestInterface;
use Psr\Http\Server\RequestHandlerInterface;

abstract class AbstractWorkflowHandler implements RequestHandlerInterface
{
    protected ?string $templateName = null;
    protected Workflow $workflow;
    protected array $params;

    public function __construct(
        private readonly RouterInterface $router,
        private readonly ?TemplateRendererInterface $template,
        private readonly StorageInterface $storage
    ) {
    }

    public function handle(ServerRequestInterface $request): ResponseInterface
    {
        $data = [];

        $params = $this->router->match($request)->getMatchedParams();
        $this->workflow = new Workflow($params['name'],$this->storage->getTree($params['name']));

        if (!isset($params['path'])){
            $data['path'] = '2';
        } else {
            $data['path'] = $params['path'];
        }

        $data['workflow'] = Tree::getLevel($this->workflow->getTree(),$data['path']);
        $data['title'] = $this->workflow->getTitle();
        $data['routeName'] = $this->workflow->getName();

        return new HtmlResponse($this->template->render(is_null($this->templateName) ? 'app::workflow' : $this->templateName, $data));
    }
}
