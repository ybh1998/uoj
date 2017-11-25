<?php

Session_Start();

require $_SERVER['DOCUMENT_ROOT'] . '/app/libs/uoj-lib.php';

require UOJContext::documentRoot().'/app/route.php';
require UOJContext::documentRoot().'/app/controllers/subdomain/blog/route.php';

$path = call_user_func(function() {
    $route = Route::dispatch();
    $q_pos = strpos($route['action'], '?');

    if ($q_pos === false) {
        $path = $route['action'];
    } else {
        parse_str(substr($route['action'], $q_pos + 1), $vars);
        $_GET += $vars;
        $path = substr($route['action'], 0, $q_pos);
    }

    if (isset($route['onload'])) {
        call_user_func($route['onload']);
    }

    return $path;
});

if(Auth::check() ||
	$path == "/login.php" ||
	$path == "/register.php") {
		include UOJContext::documentRoot().'/app/controllers'.$path;
} else {
	redirectTo('/login');
}
