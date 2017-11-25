<?php
    crsf_defend();
    Auth::logout();
?>

<script type="text/javascript">
window.location.href = '/';
</script>
