<?php
function sanitize($input) {
    return htmlspecialchars(strip_tags(trim($input)));
}

function redirect($url) {
    header("Location: $url");
    exit;
}
