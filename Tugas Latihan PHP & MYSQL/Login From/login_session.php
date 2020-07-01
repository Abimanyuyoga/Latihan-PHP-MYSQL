<?php

 session_start();

 if (!isset($_SESSION['isLogin']))
 header('location: login.php');

 ?>