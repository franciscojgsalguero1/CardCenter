<?php

	$page_title = "Cards List";
	include_once "resources/layout_header.php";

    if (count($data) >= 1) {
        echo "<table class='table table-hover table-responsive table-bordered'>";
            echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Expansion</th>";
                echo "<th>Rarity</th>";
                echo "<th>Game</th>";
                echo "<th>Src</th>";
            echo "</tr>";

            foreach ($data as $item) {
            	echo "<tr>";
            		echo "<td>{$item->name}</td>";
            		echo "<td>{$item->expansion}-{$item->number}</td>";
            		echo "<td>{$item->rarity}</td>";
                    echo "<td>{$item->game}</td>";
            		echo "<td><img src='{$item->src}' height=200 width=160</td>";
        		echo "</tr>";
            }
    }

	include_once "resources/layout_footer.php";

?>