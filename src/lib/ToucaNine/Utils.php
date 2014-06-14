<?php
function profileApplication()
{
    return sprintf('Page rendered in %.4f seconds using %.3f MB of memory.', getExecutionTime(), getMemoryUsage());
}

function getExecutionTime()
{
    return (microtime(true) - TOUCANINE_SET_TIME);
}

function getMemoryUsage()
{
    return ((memory_get_peak_usage() - TOUCANINE_SET_MEMORY) / 1024 / 1024);
}

/**
 * END ToucaNine/Utils.php
 */