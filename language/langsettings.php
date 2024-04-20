<?php
        $lang=@file_get_contents("lang.tmp");
        @include("langue/languages.php");
        @include("langue/en.php");
        @include("langue/$lang.php");
?>