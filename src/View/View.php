<?php declare(strict_types=1);
namespace Rist\View;

use Psr\Http\Message\ResponseInterface;
use Slim\Views\PhpRenderer;

/**
 * Extends slimphp/PHP-View to allow  RootViewProvider to correctly render 
 * the default view for IntertiaJS to work.
 * 
 * @license https://github.com/slimphp/PHP-View/blob/3.x/LICENSE.md (MIT License)
 */
class View extends PhpRenderer
{
    /**
     * Response
     *
     * @var ResponseInterface
     */
    private ResponseInterface $response;

    /**
     * @param ResponseInterface $response
     * @param string $templatePath
     * @param array  $attributes
     * @param string $layout
     */
    public function __construct(ResponseInterface $response, string $templatePath = '', array $attributes = [], string $layout = '')
    {
        parent::__construct($templatePath, $attributes, $layout);
        $this->response = $response;
    }

    /**
     * Render To String
     *
     * @param string $template
     * @param array $data
     * @return string
     */
    public function renderToString(string $template, array $data = []): string
    {
        /**
         * @var ResponseInterface $response
         */
        $response = $this->render($this->response, $template, $data);
        return (string) $response->getBody();
    }
}
