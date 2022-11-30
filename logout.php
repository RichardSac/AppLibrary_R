<?php
session_start();
// unset($_SESSION['nouser']);
unset($_SESSION['username']);
// unset($_SESSION['password']);
unset($_SESSION['namalengkap']);
// unset($_SESSION['role']);
session_destroy();
echo "<script>
document.location='index.php'</script>"
?>