<?php
session_start();

if (isset($_SESSION['loggedin'])) {
  echo 1;
} else {
  echo 0;
}
?>