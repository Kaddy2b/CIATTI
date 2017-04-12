<main class="main-panel">
	<div class="container">
		<h1 class="page-header">Panel</h1>
		<div class="row">

            <nav class="navbar navbar-default">
                  <div class="container-fluid">
                        <div class="navbar-header">
                              <a class="navbar-brand" href="index.php">All</a>
                        </div>
                        <!-- All -->
                        <ul class="nav navbar-nav">
                              <li><a href="index.php?controller=fleche&action=readByTypePanel&categorie=acheteurs">Acheteurs</a></li>
                              <li><a href="index.php?controller=fleche&action=readByTypePanel&categorie=fournisseurs">Fournisseurs</a></li>
                        </ul>
                        <!-- Acheteurs & Fournisseurs -->
                        <ul class="nav navbar-nav navbar-right">
                              <?php
                              if ($page_title == "Panel - Matching !") {
                                    echo '<li><a class="navbar-brand" href="index.php?controller=fleche&action=matching"><strong>Matching !</strong></a></li>';
                              } else {
                                    echo '<li><a class="navbar-brand" href="index.php?controller=fleche&action=matching">Match !</a></li>';
                              }
                              ?>
                        </ul>
                        <!-- Match -->
                        <ul class="nav navbar-nav">
                              <li>
                                    <form method="POST" action="index.php?controller=fleche&action=search">
                                          <div class="input-group">
                                                <span class="input-group-addon">Rechercher</span>
                                                <input type="text" class="form-control" name="research" placeholder="ex: Sauvignon">
                                          </div>
                                    </form>
                              </li>
                        </ul>
                        <!-- Rechercher -->
                  </div>
            </nav>

		<?php
            foreach ($tab as $key => $value) {
            	$v_idFleche = htmlspecialchars($value->getIdFleche());
            	$v_typeFleche = htmlspecialchars($value->getTypeFleche());
            	$v_nomFleche = htmlspecialchars($value->getNomFleche());
                  $v_textFleche = htmlspecialchars($value->getTextFleche());
                  $v_dateFleche = htmlspecialchars($value->getDateFleche());

                  if ($v_typeFleche == "Acheteurs") {
                        $color = "list-group-item-success";
                  } else if ($v_typeFleche == "Fournisseurs") {
                        $color = "list-group-item-warning";
                  } else {
                        $color = "list-group-item-danger";
                  }

            	echo '
            	<div class="item-panel col-md-2">
            		<ul class="list-group">
      				<li class="' . $color . ' list-group-item typeFleche"><strong>' . $v_typeFleche . '</strong></li>
      				<li class="list-group-item nomFleche">' . $v_nomFleche . '<span class="badge">' . $v_idFleche . '</span></li>
                              <li class="list-group-item textFleche" title="' . $v_textFleche . '">' . $v_textFleche . '</li>
                    </ul>
            	</div>';
            }
		?>
		</div>
	</div>
</main>