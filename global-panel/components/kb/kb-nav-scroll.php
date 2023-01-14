<!-- DISPLAY DE NAV DE CATEGORIAS/ARTIGOS -->
<!-- Lista de conteudos -->
<nav id="navbar-example3" class="h-100 flex-column align-items-stretch border-end">
    <nav class="nav nav-pills flex-column">
    <?php
    $lastCatId = null;
    $catNavCounter = 1;
    foreach ($categorias as $row_cat) { //processo de iteração para cada categoria
        $cat_id_import = $row_cat['id'];
        //inicia nova categoria
        echo '<a class="nav-link" href="#item-' . $row_cat['id'] . '">' . $catNavCounter . ' - ' . $row_cat['nome_categoria'] . '</a>';

        //LISTAR ARTIGOS POR CATEGORIA
        $artigos = [];
        $sql = "SELECT * FROM kb_artigos WHERE cat_id = '$cat_id_import'";
        $result = mysqli_query($dbconn, $sql) or trigger_error("Query Failed! SQL: $sql - Error: " . mysqli_error($dbconn), E_USER_ERROR);
        if ($result->num_rows > 0) {
            while ($row_art = $result->fetch_assoc()) {
                $artigos[] = $row_art;
            }
        } else {
            $error = "Esta categoria não tem artigos disponiveis";
        }

        echo '<nav class="nav nav-pills flex-column">';
        $artNavCounter = 1;
        foreach ($artigos as $row_art) { //processo de iteração para cada artigo associado à categoria da hierarquia
            echo '<a class="nav-link ms-3 my-1" href="#item-' . $cat_id_import . '-' . $row_art['id'] . '">' . $catNavCounter . '.' . $artNavCounter . ' - ' . $row_art['assunto'] . '</a>';
            $artNavCounter += 1;
        }
        echo '</nav>';
        $catNavCounter += 1;
    }
    ?>
    </nav>
</nav>