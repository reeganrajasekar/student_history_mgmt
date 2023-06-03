<?php
session_start();
session_destroy();
header("Location:/staff");
die();
?>