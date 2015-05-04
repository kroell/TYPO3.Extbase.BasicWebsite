<?php
if(opcache_reset()) {
echo 'OpCache Reset: OK';
} else {
echo 'OpCache Reset: Failed.';
}
//var_dump(opcache_get_status());
