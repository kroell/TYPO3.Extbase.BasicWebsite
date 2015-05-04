<?php
/**
 * This script must be open with http:// !
 */

echo 'Lösche Cache: ';
apc_clear_cache();
apc_clear_cache('user');
echo 'OK';

