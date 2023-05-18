<?php

/**
 * -----------------------
 *  Functions Goes Here
 * -----------------------
 */

/** view() function, to render the view from controller and to pass data to view via array */
if (!function_exists('view')) {
    function view($viewName, $data = [])
    {
        $viewFile = BASE_PATH . 'app/Views/' . $viewName . '.php';
        if (!file_exists($viewFile)) {
            echo 'View File Not Found!';
        }
        // Sanitize any user input to prevent XSS attacks.
        $data = array_map(function ($value) {
            return is_string($value) ? htmlspecialchars($value, ENT_QUOTES) : $value;
        }, $data);
        // Extract the data array into variables that can be used in the view file.
        extract($data);
        // Start output buffering so that any HTML/PHP code in the view file is captured.
        ob_start();
        // Include the view file.
        include $viewFile;
        // Get the captured output and return it.
        $output = ob_get_clean();
        echo $output;
    }
}

/** assets function will return the file path from public/assets dir */
if (!function_exists('assets')) {
    function assets(string $file)
    {
        return BASE_URL . "public/assets/" . $file;
    }
}

/** Returns IP address of client */
if (!function_exists('getIp')) {
    function getIp()
    {
        if (getenv('REMOTE_ADDR')) {
            $ipAddress = getenv('REMOTE_ADDR');
        } elseif (getenv('HTTP_CLIENT_IP')) {
            $ipAddress = getenv('HTTP_CLIENT_IP');
        } elseif (getenv('HTTP_X_FORWARDED_FOR')) {
            $ipAddress = getenv('HTTP_X_FORWARDED_FOR');
        } elseif (getenv('HTTP_X_FORWARDED')) {
            $ipAddress = getenv('HTTP_X_FORWARDED');
        } elseif (getenv('HTTP_FORWARDED_FOR')) {
            $ipAddress = getenv('HTTP_FORWARDED_FOR');
        } elseif (getenv('HTTP_FORWARDED')) {
            $ipAddress = getenv('HTTP_FORWARDED');
        } else {
            $ipAddress = '127.0.0.1';
        }

        $ipAddress = explode(',', $ipAddress)[0];

        return $ipAddress;
    }
}

/** Redirect Function */
if (!function_exists('redirect')) {
    function redirect($url)
    {
        if (!headers_sent()) {
            header('Location: ' . $url, true, 302);
        } else {
            echo '<script type="text/javascript">';
            echo 'window.location.href="' . $url . '";';
            echo '</script>';
            echo '<noscript>';
            echo '<meta http-equiv="refresh" content="0;url=' . $url . '" />';
            echo '</noscript>';
        }
        exit();
    }
}

/** Redirect to previous page */
if (!function_exists('back')) {
    function back()
    {
        header('Location: ' . $_SERVER['HTTP_REFERER']);
        exit();
    }
}

/** Prints human-readable information about a variable */
if (!function_exists('printR')) {
    function printR($value)
    {
        echo '<pre>';
        print_r($value);
        echo '</pre>';
    }
}

/** Dump & die */
if (!function_exists('dd')) {
    function dd($data)
    {
        echo '<pre>';
        die(var_dump($data));
        echo '</pre>';
    }
}

/** Set CSRF Field and value */
if (!function_exists('set_csrf')) {
    function set_csrf()
    {
        if (!isset($_SESSION["csrf"])) {
            $_SESSION["csrf"] = bin2hex(random_bytes(32));
        }
        return '<input type="hidden" name="csrf" value="' . $_SESSION["csrf"] . '">';
    }
}

/** Check CSRF on form submit */
if (!function_exists('is_csrf_valid')) {
    function is_csrf_valid()
    {
        if (!isset($_SESSION['csrf']) || !isset($_POST['csrf'])) {
            return false;
        }
        if ($_SESSION['csrf'] != $_POST['csrf']) {
            return false;
        }
        return true;
    }
}

/** Handle the logic to check for CSRF */
if (!function_exists('handle_csrf')) {
    function handle_csrf()
    {
        if (!is_csrf_valid()) {
            $_SESSION['error'] = 'CSRF Validation Failed!';
            return back();
        }
    }
}

/** Toastr Notifications */
function addtoastr($type, $message)
{
    // Initialize an empty array to hold toastr notifications
    if (!isset($_SESSION['toastr_notifications'])) {
        $_SESSION['toastr_notifications'] = array();
    }

    // Add the new toastr notification to the array
    array_push($_SESSION['toastr_notifications'], array(
        'type' => $type,
        'message' => $message
    ));
}

function display_toastr_notifications()
{
    // Check if there are any toastr notifications to display
    if (isset($_SESSION['toastr_notifications'])) {
        foreach ($_SESSION['toastr_notifications'] as $notification) {
            // Display the toastr notification using JavaScript
            echo "<script>toastr.options = {'progressBar': true,'newestOnTop': true,'closeButton': true,}            
            toastr." . $notification['type'] . "('" . $notification['message'] . "')</script>";
        }

        // Clear the toastr notifications array
        unset($_SESSION['toastr_notifications']);
    }
}
// addtoastr('success', 'Your profile has been updated.');
// addtoastr('error', 'Something is not right!!');
