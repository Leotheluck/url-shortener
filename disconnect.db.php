<?php
    session_start();
    session_destroy();
    header("Location: ./?popup=successfuly-disconnected")
?>