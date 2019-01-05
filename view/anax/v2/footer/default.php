<?php

namespace Anax\View;

/**
 * Template file to render a view.
 */

// Show incoming variables and view helper functions
//echo showEnvironment(get_defined_vars(), get_defined_functions());

?>

<footer class="grid-container">
    <div class="social">
        <h5>Social Links</h5>
        <a style="text-decoration:none" href="https://www.facebook.com/"><i class="fab fa-facebook-square fa-2x"></i></a>
        <a style="text-decoration:none" href="https://www.instagram.com/"><i class="fab fa-instagram fa-2x"></i></a>
        <a style="text-decoration:none" href="https://www.instagram.com/"><i class="fab fa-linkedin fa-2x"></i></a>
    </div>
    <div class="copyright">
        Copyright © <?=date("Y"); ?> BrädspelsPalatset
    </div>
</footer>
