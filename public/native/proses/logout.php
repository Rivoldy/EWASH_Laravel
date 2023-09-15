<?php
session_start();

$_SESSION['wnik'] = '';
$_SESSION['wnama'] = '';
$_SESSION['wlevel'] = '';
unset($_SESSION['wnik']);
unset($_SESSION['wnama']);
unset($_SESSION['wlevel']);
session_unset();
session_destroy();
?>
<script>alert('Anda Telah logout');
document.location='../'</script>
