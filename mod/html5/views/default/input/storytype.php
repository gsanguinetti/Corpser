<?php
echo elgg_view("input/dropdown", array("name" => "storytype", "value" => $storytype, "options_values" => array("normal" => elgg_echo("pages_tools:normal"), "gamebook" => elgg_echo("pages_tools:gamebook"), "exqcorpse" => elgg_echo("pages_tools:exquisitecorpse"))));