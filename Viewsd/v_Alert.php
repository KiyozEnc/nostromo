<!-- Alerte valid -->
<div class="row row-centered">
    <div class="col-sm-6 col-xs-12 col-centered">
        <?php
        if (array_key_exists('valid', $_SESSION)) {
            ?>
            <div class="alert alert-success" role="alert">
                <span class="glyphicon glyphicon-ok" aria-hidden="true"></span>
                <?php echo $_SESSION['valid'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php

        }
        if (array_key_exists('error', $_SESSION)) {
            ?>
            <div class="alert alert-danger" role="alert">
                <span class="glyphicon glyphicon-exclamation-sign" aria-hidden="true"></span>
                <span class="sr-only">Error:</span>
                <?php echo $_SESSION['error'] ?>
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
        <?php

        }
        if (array_key_exists('valid', $_SESSION)) {
            unset($_SESSION['valid']);
        }
        if (array_key_exists('error', $_SESSION)) {
            unset($_SESSION['error']);
        } ?>
    </div>
</div>
