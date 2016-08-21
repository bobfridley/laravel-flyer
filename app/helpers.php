<?php

/**
 * Flash message function
 *
 * @param  string|null $title
 * @param  string|null $message
 * @return session
 */
function flash($title = null, $message = null)
{
    $flash = app('App\Http\Flash');

    if (func_num_args() == 0) {
        return $flash;
    }

    return $flash->info($title, $message);
}

/**
 * A route to a given flyer
 * 
 * @param App\Flyer $flyer
 * @return route
 */
function add_photo_path(App\Flyer $flyer)
{
    return route('store_photo_path', [$flyer->zip, $flyer->street]);
}

/**
 * A path to a given flyer.
 * 
 * @param  App\Flyer  $flyer
 * @return string
 */
function flyer_path(App\Flyer $flyer)
{
    return $flyer->zip . '/'. str_replace(' ', '-', $flyer->street);
}

function link_to($body, $path, $type)
{
    $csrf = csrf_field();
    $method = method_field($type);

    if (is_object($path)) {
        // $photo, DELETE --> DELETE /photos/id
        $action = '/' . $path->getTable(); // photos

        if (in_array($type, ['PUT', 'PATCH', 'DELETE'])) {
            $action .= '/' . $path->getKey(); // photos/1
        }
    } else {
        $action = $path;
    }

    return <<<EOT
        <form method="POST" action="{$action}">
            $method
            $csrf
            <button type="submit">{$body}</button>
        </form>
EOT;
}