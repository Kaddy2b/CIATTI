<main>
    <table class="table table-striped">
        <tbody>
            <tr>
              <th class="left-part">OPP</th>
              <th>Events</th>
            </tr>
            <?php 
            foreach ($tab_fleche as $key => $value) { //On affiche une ligne pour chaque fleche dans la BDD.
                $v_idFleche = htmlspecialchars($value->getIdFleche());
                $v_typeFleche = htmlspecialchars($value->getTypeFleche());
                $v_nomFleche = htmlspecialchars($value->getNomFleche());
                $v_mailFleche = htmlspecialchars($value->getMailFleche());
                $v_dateFleche = htmlspecialchars($value->getDateFleche());
                $v_newDateFleche = date("j F Y", strtotime($v_dateFleche)); //On change le format de la date.
                $v_textFleche = htmlspecialchars($value->getTextFleche());

                //Selection de la couleur d'en tete du type de fleche.
                if ($v_typeFleche == "Acheteurs") {
                  $color = "list-group-item-success";
                } else if ($v_typeFleche == "Fournisseurs") {
                  $color = "list-group-item-warning";
                } else {
                  $color = "list-group-item-danger";
                }

                echo '<tr>
                        <td class="left-part">
                            <ul id="fleche' . $v_idFleche . '" class="list-group fleche">
                              <li class="list-group-item ' . $color . '"><strong>' . $v_typeFleche . '</strong></li>
                              <li class="list-group-item">' . $v_nomFleche . '<span class="badge">' . $v_idFleche . '</span></li>
                              <li class="list-group-item">' . $v_mailFleche .  '</li>
                            </ul>
                            <!-- ul .fleche -->
                            <form id="form-fleche' . $v_idFleche . '" class="form-fleche" method="post" action="index.php?controller=fleche&action=updated&idFleche=' . $v_idFleche . '&categorie=' . $page_title . '">
                              <div class="input-group">
                                <span class="input-group-addon"></span>';
                                if ($page_title == "Fournisseurs") {
                                  echo '<select class="form-control select-typeFleche" name="typeFleche">
                                    <option value="Acheteurs">Acheteurs</option>
                                    <option value="Fournisseurs" selected>Fournisseurs</option>
                                  </select>';
                                } else {
                                  echo '<select class="form-control select-typeFleche" name="typeFleche">
                                    <option value="Acheteurs" selected>Acheteurs</option>
                                    <option value="Fournisseurs">Fournisseurs</option>
                                  </select>';
                                }
                              echo '</div>
                              <!-- type -->
                              <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" class="form-control" name="nomFleche" value="' . $v_nomFleche . '" placeholder="ex: Demande VSI">
                              </div>
                              <!-- nom -->
                              <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="text" class="form-control" name="textFleche" value="' . $v_textFleche . '" placeholder="ex: Sauvignon">
                              </div>
                              <!-- text -->
                              <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="date" class="form-control" name="dateFleche" value="' . $v_dateFleche . '">
                              </div>
                              <!-- date -->
                              <div class="input-group">
                                <span class="input-group-addon"></span>
                                <input type="mail" class="form-control" name="mailFleche" value="' . $v_mailFleche . '" placeholder="contact@mail.com">
                              </div>
                              <!-- mail -->
                              <button class="btn btn-success" type="submit">Envoyer</button>
                              <button id="btn-canc-fleche' . $v_idFleche . '" class="btn btn-warning" type="button" onclick="cancelEditerFleche(this);">Cancel</button>
                            </form>
                            <!-- form -->
                            <button id="btn-edit-fleche' . $v_idFleche . '" class="btn btn-warning" type="button" onclick="editerFleche(this);">Edit</button>
                            <!-- btn-edit-fleche -->
                            <button id="btn-dele-fleche' . $v_idFleche . '" class="btn btn-danger" onclick="effacerFleche(\'' . $v_idFleche . '\', \'' . $page_title . '\');">Delete</button>
                            <!-- btn-dele-fleche -->
                        </td>
                        <!-- .left-part -->
                        <td class="right-part">
                        <div class="debut item"><a href="#ancre' . $v_idFleche . '"><button class="btn btn-primary">-></button></a>
                        <h3 class="text-uppercase">' . $v_textFleche . '</h3>
                          <p class="label label-info date-item">' . $v_newDateFleche . '</p>
                        </div>';
                        foreach ($tab_etape as $key => $value) { //On affiche chaque etape de chaque fleche dans la BDD.
                            $v_idEtape = htmlspecialchars($value->getIdEtape());
                            $v_idFlecheEtape = htmlspecialchars($value->getIdFlecheEtape());
                            $v_dateEtape = htmlspecialchars($value->getDateEtape());
                            $v_newDateEtape = date("j F Y", strtotime($v_dateEtape)); //On change le format de la date.
                            $v_titreEtape = htmlspecialchars($value->getTitreEtape());
                            $v_textEtape = htmlspecialchars($value->getTextEtape());
                            if ($v_idFleche == $v_idFlecheEtape) {
                                echo '<div class="millieu item">
                                <button id="btn-edit-item' . $v_idEtape . '" class="btn btn-warning" onclick="editerEtape(this);">Edit</button>
                                <!-- btn-edit-item -->
                                <button id="btn-dele-item' . $v_idEtape . '" class="btn btn-danger" onclick="effacerEtape(\'' . $v_idEtape . '\', \'' . $page_title . '\');">Delete</button>
                                <!-- btn-dele-item -->
                                <a href="index.php?controller=etape&action=mailEtape&idEtape=' . $v_idEtape . '"><button id="btn-mail-item' . $v_idEtape . '" class="btn btn-primary">Mail</button></a>
                                <!-- MailEtape -->
                                <form id="form-item' . $v_idEtape . '" class="form-hide" method="post" action="index.php?controller=etape&action=updated&idEtape=' . $v_idEtape . '&idFleche=' . $v_idFlecheEtape . '&categorie=' . $page_title . '">
                                  <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input type="date" class="form-control" name="dateEtape" value="' . $v_dateEtape . '">
                                  </div>
                                  <!-- dateEtape -->
                                  <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <input type="text" class="form-control" name="titreEtape" placeholder="Titre" value="' . $v_titreEtape . '">
                                  </div>
                                  <!-- titreEtape -->
                                  <div class="input-group">
                                    <span class="input-group-addon"></span>
                                    <textarea type="text" class="form-control" name="textEtape" placeholder="Texte">' . $v_textEtape . '</textarea>
                                  </div>
                                  <!-- textEtape -->
                                  <button id="btn-save-item' . $v_idEtape . '" class="btn-submit-item btn btn-success" type="submit">Submit</button>
                                  <!-- btn-save-item -->
                                  <button id="btn-canc-item' . $v_idEtape . '" class="btn-cancel-item btn btn-warning" type="button" onclick="cancelEditerEtape(this);">Cancel</button>
                                  <!-- btn-canc-item -->
                                </form>
                                <h3 class="text-uppercase">' . $v_titreEtape . '</h3>
                                <p class="text-justify text-item">' . nl2br($v_textEtape) . '</p><p class="label label-info date-item">' . $v_newDateEtape . '</p></div>';
                            }
                        }
            echo '<div id="ancre' . $v_idFleche . '" class="fin item">
            <div>
              <a href="#fleche' . $v_idFleche . '"><button class="btn-fin btn btn-primary"><-</button></a>
            </div>
            <!-- (retour au début) -->
            <div>
              <a href="index.php?controller=etape&action=created&idFleche=' . $v_idFleche . '&categorie=' . $page_title . '"><img class="img-ajout" src="lib/images/plus.png" alt="ajout etape"></a>
            </div>
            <!-- (ajout Etape) -->
            </div>
            </td></tr>';
            }
            ?>
            <tr>
                <td class="left-part">
                    <form method="post" action="index.php?controller=fleche&action=created&categorie=<?php echo $page_title; ?>">
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <?php
                        if ($page_title == "Fournisseurs") {
                          echo '<select class="form-control select-typeFleche" name="typeFleche">
                            <option value="Acheteurs">Acheteurs</option>
                            <option value="Fournisseurs" selected>Fournisseurs</option>
                          </select>';
                        } else {
                          echo '<select class="form-control select-typeFleche" name="typeFleche">
                            <option value="Acheteurs" selected>Acheteurs</option>
                            <option value="Fournisseurs">Fournisseurs</option>
                          </select>';
                        }
                        ?>
                      </div>
                      <!-- type -->
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="nomFleche" placeholder="ex: Demande VSI" required>
                      </div>
                      <!-- nom -->
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="text" class="form-control" name="textFleche" placeholder="ex: Sauvignon" required>
                      </div>
                      <!-- text -->
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="date" class="form-control" name="dateFleche" value="<?php $today = date("Y-m-d"); echo $today;?>" required>
                      </div>
                      <!-- date -->
                      <div class="input-group">
                        <span class="input-group-addon"></span>
                        <input type="mail" class="form-control" name="mailFleche" placeholder="ex: contact@mail.com">
                      </div>
                      <!-- mail -->
                      <button class="btn btn-success" type="submit">Envoyer</button>
                    </form>
                </td>
                <td class="right-part">
                    <div class="debut item"></div>
                    <div class="fin-mur item"></div>
                </td>
            </tr>
        </tbody>
    </table>
    <div class="space">
      <!-- vide -->
    </div>
</main>