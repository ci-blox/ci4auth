<?php defined('BASEPATH') OR exit('No direct script access allowed');
/**
 * views/theme/footer.php
 *
 * Template page for the site - footer.
 *
 */
 ?>		<!-- bottom of the page -->
    <div class="footer">
        <div class="footer-menu">
            <div class="container">
                <div class="row bcit50">
                    <ul class="nav nav-pills">
                        <?=$footerbar?>
                    </ul>
                </div>
            </div>
        </div>
        <div class="footer-copyright">
            <div class="container">
                <div class="row">
                <div class="footer">
				Page rendered in {elapsed_time} seconds. Environment: <?= ENVIRONMENT ?>
			</div>
             </div>
        </div>
    </div>
    <script src="/assets/js/jquery.min.js" 
        integrity="sha256-BbhdlvQf/xTY9gja0Dq3HiwQF8LaCRTXxZKRutelT44="
        crossorigin="anonymous"></script>
    <script src="/assets/js/bootstrap.bundle.min.js"></script>
    </body>
</html>