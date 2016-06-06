
<html>
<?php

if ($c=OCILogon("ora_w9g0b", "a24198146", "ug")) {
  echo "Successfully connected to Oracle.\n";
  OCILogoff($c);
} else {
  $err = OCIError();
  echo "Oracle Connect Error " . $err['message'];
}

?>
</html>
