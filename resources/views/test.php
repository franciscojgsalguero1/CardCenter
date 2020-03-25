<?php

	$page_title = "Cards List";
	include_once "resources/layout_header.php";

	echo "<form role='search' action='php/item/search_item.php'>";
        echo "<div class='input-group col-md-3 pull-left margin-right-1em'>";
            $search_value = isset($search_term) ? "value='{$search_term}'" : "";
            echo "<input type='text' class='form-control' autocomplete='off' placeholder='Type item or pack name...' name='s' id='srch-term' required {$search_value} />";
            echo "<div class='input-group-btn'>";
                echo "<button class='btn btn-primary' type='submit'><i class='glyphicon glyphicon-search'></i></button>";
            echo "</div>";
        echo "</div>";
    echo "</form>";

    echo "<div class='right-button-margin'>";
        echo "<a href='php/contact/create_contact.php' class='btn btn-primary pull-right'>";
            echo "<span class='glyphicon glyphicon-plus'></span> Add Contact";
        echo "</a>";
        echo "<a href='php/pack/create_pack.php' class='btn btn-primary pull-right left-margin'>";
            echo "<span class='glyphicon glyphicon-plus'></span> Add Pack";
        echo "</a>";
        echo "<a href='php/item/create_item.php' class='btn btn-primary pull-right left-margin'>";
            echo "<span class='glyphicon glyphicon-plus'></span> Add Item";
        echo "</a>";
        echo "<a href='index_contacts.php' class='btn btn-default pull-right left-margin'>";
            echo "<span class='glyphicon glyphicon-user'></span> View Contacts";
        echo "</a>";
        echo "<a href='index_packs.php' class='btn btn-default pull-right left-margin'>";
            echo "<span class='glyphicon glyphicon-th-list'></span> View Packs";
        echo "</a>";
    echo "</div>";

    if (count($data) >= 1) {
        echo "<table class='table table-hover table-responsive table-bordered'>";
            echo "<tr>";
                echo "<th>Name</th>";
                echo "<th>Expansion</th>";
                echo "<th>Rarity</th>";
                echo "<th>Src</th>";
            echo "</tr>";

        foreach ($data as $item) {
        	echo "<tr>";
        		echo "<td>{$item->name}</td>";
        		echo "<td>{$item->expansion}-{$item->number}</td>";
        		echo "<td>{$item->rarity}</td>";
        		echo "<td><img width='100' height='200' src='{$item->src}'</td>";
    		echo "</tr>";
        }
    }

	include_once "resources/layout_footer.php";

?>