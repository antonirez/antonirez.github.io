<?php
require_once __DIR__.'/../vendor/autoload.php';

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing;
use Symfony\Component\HttpKernel;

$routes = new Routing\RouteCollection();
$routes->add('cart_get', new Routing\Route('/cart', [
    '_controller' => [App\Controller\CartController::class, 'get'],
]));
$routes->add('cart_add', new Routing\Route('/cart/add', [
    '_controller' => [App\Controller\CartController::class, 'add'],
]));
$routes->add('cart_checkout', new Routing\Route('/checkout', [
    '_controller' => [App\Controller\CartController::class, 'checkout'],
]));

$context = new Routing\RequestContext();
$context->fromRequest(Request::createFromGlobals());
$matcher = new Routing\Matcher\UrlMatcher($routes, $context);

$controllerResolver = new HttpKernel\Controller\ControllerResolver();
$argumentResolver = new HttpKernel\Controller\ArgumentResolver();

$request = Request::createFromGlobals();
try {
    $request->attributes->add($matcher->match($request->getPathInfo()));
    $controller = $controllerResolver->getController($request);
    $arguments = $argumentResolver->getArguments($request, $controller);
    $response = call_user_func_array($controller, $arguments);
} catch (Routing\Exception\ResourceNotFoundException $e) {
    $response = new Response('Not Found', 404);
} catch (Exception $e) {
    $response = new Response('An error occurred: '.$e->getMessage(), 500);
}
$response->send();
