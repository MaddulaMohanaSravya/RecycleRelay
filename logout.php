<?php
session_start();
session_unset();
session_destroy();
header("Location: indexU.php");
exit();
