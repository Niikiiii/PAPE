<div id="layoutSidenav_nav" style="display: flex;">
    <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
        <div class="sb-sidenav-menu">
            <div class="nav">
                <div class="sb-sidenav-menu-heading">Dashboard</div>
                <a class="nav-link" href="index.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                    Dashboard
                </a>
                <div class="sb-sidenav-menu-heading">Registros</div>
                                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapseHistorico" aria-expanded="false" aria-controls="collapseHistorico">
                    <div class="sb-nav-link-icon"><i class="fas fa-history"></i></div>
                    Histórico
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapseHistorico" aria-labelledby="headingHistorico" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="reparaçoes.php">Reparações</a>
                    </nav>
                </div>
                <div class="collapse" id="collapseHistorico" aria-labelledby="headingHistorico" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav">
                        <a class="nav-link" href="pagamento.php">Pagamentos</a>
                    </nav>
                </div>
                <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#collapsePages" aria-expanded="false" aria-controls="collapsePages">
                    <div class="sb-nav-link-icon"><i class="fas fa-book-open"></i></div>
                    Registro
                    <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                </a>
                <div class="collapse" id="collapsePages" aria-labelledby="headingTwo" data-bs-parent="#sidenavAccordion">
                    <nav class="sb-sidenav-menu-nested nav accordion" id="sidenavAccordionPages">
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseAuth" aria-expanded="false" aria-controls="pagesCollapseAuth">
                            Novo
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseAuth" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="novo_reparacao.php">Reparação</a>
                            </nav>
                        </div>
                        <a class="nav-link collapsed" href="#" data-bs-toggle="collapse" data-bs-target="#pagesCollapseError" aria-expanded="false" aria-controls="pagesCollapseError">
                            Orçamento
                            <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                        </a>
                        <div class="collapse" id="pagesCollapseError" aria-labelledby="headingOne" data-bs-parent="#sidenavAccordionPages">
                            <nav class="sb-sidenav-menu-nested nav">
                                <a class="nav-link" href="401.html">401 Page</a>
                                <a class="nav-link" href="404.html">404 Page</a>
                                <a class="nav-link" href="500.html">500 Page</a>
                            </nav>
                        </div>
                    </nav>
                </div>
                <div class="sb-sidenav-menu-heading">Tabelas</div>
                <a class="nav-link" href="charts.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-chart-area"></i></div>
                    Charts
                </a>
                <a class="nav-link" href="tables.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Equipamentos
                </a>
                <a class="nav-link" href="cliente.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Clientes
                </a>
                <a class="nav-link" href="imprimir.php">
                    <div class="sb-nav-link-icon"><i class="fas fa-table"></i></div>
                    Imprimir
                </a>
            </div>
        </div>
        <div class="sb-sidenav-footer">
            <div class="small">Logged in as:</div>
            <?php
                    if (isset($_SESSION['user_email'])) {
                     // Display "user: " if the user is logged in
                        // Display the user's email
                        echo htmlspecialchars($_SESSION['user_email']); // Display the user's email
                    } else {
                        echo "Guest"; // Display "Guest" if the user is not logged in
                    }
            ?>
        </div>
    </nav>
</div>