<?php
return [

    |===============================================
    | smart_stats
    |===============================================
    |
    | By default, smart_stats can keeps historical
    | drives that have been logged in the past. To
    | disable, set `keep_smart_stats_historical` to
    | false.
    |
    */

    'keep_smart_stats_historical' = env('KEEP_SMART_STATS_HISTORICAL', true),
];
