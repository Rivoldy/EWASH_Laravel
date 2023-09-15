<?php
require_once '../../../proses/conn.php';

if (isset($_POST['style'])) {
  $style = $_POST['style'];
  $nmsize = $_POST['nmsize'];
  $gram = $_POST['gram'];

  for ($i = 0; $i < count($nmsize); $i++) {
    $qins = mysqli_query($conn, "DELETE from m_gramasi where g_style='$style' and g_size='$nmsize[$i]';");
    $qins = mysqli_query($conn, "INSERT into m_gramasi values('$style','$nmsize[$i]','$gram[$i]',NOW(),'" . $_SESSION{
      'wnik'} . "')");
  }
  if ($qins) {
    echo 'scs';
  } else {
    echo mysqli_error($conn);
  }
}
