<?php

namespace LaraKit\EnvBar\Middleware;

use Closure;
use LaraKit\EnvBar\Renderer;

class InjectBar
{
    public function handle($request, Closure $next)
    {
        if (!config('envbar.enabled')) {
            return $next($request);
        }

        $response = $next($request);
        $content  = $response->getContent();

        $renderer = new Renderer();

        $headPos = strripos($content, '</head>');
        if ($headPos !== false) {
            $content = substr($content, 0, $headPos) . $renderer->renderHead() . substr($content, $headPos);
        }

        $bodyPos = strripos($content, '<body');
        if ($bodyPos !== false) {
            $bodyPos = strpos($content, '>', $bodyPos);
            $content = substr($content, 0, $bodyPos + 1) . $renderer->renderBar() . substr($content, $bodyPos + 1);
        }

        $response->setContent($content);

        return $response;
    }
}
