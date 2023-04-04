<?php 

function debug($array) {
    echo "<pre>";
    print_r($array);
    echo "</pre>";
}

function fieldClear($data) {
    return htmlspecialchars(trim($data));
}

function isAjax() {
    return isset($_SERVER["HTTP_X_REQUESTED_WITH"]) && $_SERVER["HTTP_X_REQUESTED_WITH"] === "XMLHttpRequest";
}

function isLogin() {
    if (isset($_SESSION['user'])) return true;
    return false;
}

function location($location = false) {
    if ($location) {
        $redirect = $location;
    } else {
        if (isset($_SERVER["HTTP_REFERER"])) {
            $redirect = isset($_SERVER["HTTP_REFERER"]);
        } else {
            $redirect = PATH;
        }
    }

    header("Location: $redirect");
    exit;
}

?>