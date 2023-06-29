<div class="row row-cols-1 row-cols-md-1 row-cols-sm-1 gy-3">
        <!-- DISPLAY DE ACCORDION CATEGORIAS COM ARTIGOS -->
        <?php
        $lastCatId = null;
        $catCounter = 1;
        foreach ($categorias as $row_cat) { //processo de iteração para cada categoria
            $cat_id_import = $row_cat['id'];
            if ($cat_id_import !== $lastCatId) {
                //fecha a categoria anterior caso ainda alguma esteja aberta
                if ($lastCatId != null) :    echo '</div></div>';
                endif;
                //inicia nova categoria
                echo '
        <div class="col">
            <div data-bs-spy="scroll" data-bs-target="#navbar-example3" data-bs-smooth-scroll="true" class="scrollspy-example-2" tabindex="0">
            <div id="item-' . $row_cat['id'] . '">
                <h4>' . $catCounter . ' - ' . $row_cat['nome_categoria'] . '</h4>
                <p class="text-muted">' . $row_cat['descricao_categoria'] . '</p>
            </div>';
            }

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

            $artCounter = 1;
            $lastArtId = null;
            if (count($artigos) > 0) {
                foreach ($artigos as $row_art) { //processo de iteração para cada artigo associado à categoria da hierarquia
                    if ($row_art['id'] !== $lastArtId) {
                        if ($lastArtId != null) :    echo '';
                        endif;
                        echo '
                        <div id="item-' . $cat_id_import . '-' . $row_art['id'] . '" class="mx-3 my-3">
                            <h5>' . $catCounter . '.' . $artCounter . ' - ' . $row_art['assunto'] . '</h5>
                            <p>' . $row_art['descricao'] . '</p>
                        </div>';

                    }
                    $artCounter+=1;
                    $lastArtId = $row_art['id'];
                }
            } else if (count($artigos) == 0) {
                if (isset($error) && $error != false) {
                    echo '<div class="alert alert-secondary mb-0">' . $error . '</div>';
                }
            }
            $lastCatId = $row_cat['id'];
            echo '<div class="mt-5"></div><hr>';
            $catCounter += 1;
        }
        ?>


</div>