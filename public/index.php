<?php
   define("webRoot","http://localhost:8000");
   define("DB","../db/ges_inscription.json");
   require_once("../db/convert.php");
   require_once ("../repositories/demande.repository.php");
   session_start();
   if(isset($_REQUEST["page"])){
      require_once("../views/partials/header.html.php");
      require_once("../views/partials/left.sidebar.html.php");
      $selectedFilter = isset($_REQUEST['etat']) ? $_REQUEST['etat'] : 'Select Etat';
      $selectedFilterac = isset($_REQUEST['matricule']) ? $_REQUEST['matricule'] : 'allmatricule';
      $selectedFiltermod = isset($_REQUEST['module']) ? $_REQUEST['module'] : 'Select module';
      $selectedFilternp = isset($_REQUEST['nom_prenom']) ? $_REQUEST['nom_prenom'] : 'Select np';
      $nbrOfElementByPage=5;
      if($_REQUEST["page"]=="add_demande") {
         require_once("../views/add.demande.html.php");
      }elseif($_REQUEST["page"]=="add_classe") {
         require_once("../views/add.classe.html.php");
      }elseif($_REQUEST["page"]=="add_prof") {
         $modules=allModules();
         $classes=allclasse();
         require_once("../views/add.professeur.html.php");
      }elseif($_REQUEST["page"]=="add_class_prof") {
         $profId = isset($_REQUEST['prof_id']) ? $_REQUEST['prof_id'] : null;
         $prof = getProfById($profId);
         $classes=getClasseRestant($profId);
         require_once("../views/add.classe.for.prof.html.php");
      }elseif($_REQUEST["page"]=="add_module_prof") {
         $profId = isset($_REQUEST['prof_id']) ? $_REQUEST['prof_id'] : null;
         $prof = getProfById($profId);
         $modules=getModuleRestant($profId);
         require_once("../views/add.module.for.prof.html.php");
      }elseif ($_REQUEST["page"] == "liste") {
         $nbrOfDemandes=nbrOfDemandeByEtat($_SESSION["userConnect"]["id"],$_SESSION["anneEncours"]["id"]);
         $nbrOfPage= ceil($nbrOfDemandes/5);
         $pageNumber = 1;
         if(isset($_REQUEST["liste"]) && preg_match("/^liste(\d+)$/", $_REQUEST["liste"], $matches)) {
               $pageNumber = max(1, (int)$matches[1]);
         }
         $start = ($pageNumber - 1) * $nbrOfElementByPage;
         $demandes = getFiveDemande( $_SESSION["userConnect"]["id"], $_SESSION["anneEncours"]["id"], $start, $nbrOfElementByPage);
         require_once("../views/liste.demande.html.php");
      }elseif ($_REQUEST["page"] == "liste_ac") {
         $nbrOfDemandesac=nbrOfALLDemandeByMatricule($_SESSION["anneEncours"]["id"]);
         $nbrOfPageac= ceil($nbrOfDemandesac/5);
         $pageNumber = 1;
         if(isset($_REQUEST["liste"]) && preg_match("/^liste(\d+)$/", $_REQUEST["liste"], $matches)) {
               $pageNumber = max(1, (int)$matches[1]);
         }
         $start = ($pageNumber - 1) * $nbrOfElementByPage;
         $demandes = getFiveDemandeac( $_SESSION["anneEncours"]["id"], $start, $nbrOfElementByPage);
         $etudiants=getAlletudiantsGivedemande($_SESSION["anneEncours"]["id"]);
         require_once("../views/liste.ac.html.php");
      }elseif ($_REQUEST["page"] == "liste_classe") {
         $profs=allprof2();
         $nbrOfclass=nbrOfClassesByProf2();
         $nbrOfPageclass= ceil($nbrOfclass/5);
         $pageNumber = 1;
         if(isset($_REQUEST["liste"]) && preg_match("/^liste(\d+)$/", $_REQUEST["liste"], $matches)) {
            $pageNumber = max(1, (int)$matches[1]);
         }
         $start = ($pageNumber - 1) * $nbrOfElementByPage;
         $classes = getFiveClasses2( $start, $nbrOfElementByPage);
         require_once("../views/liste.classe.html.php");
      }elseif ($_REQUEST["page"] == "liste_prof") {
         $modules=allModules();
         $nbrOfProf=nbrOfProfsByModule();
         $nbrOfPagemod= ceil($nbrOfProf/5);
         $pageNumber = 1;
         if(isset($_REQUEST["liste"]) && preg_match("/^liste(\d+)$/", $_REQUEST["liste"])) {
            $pageNumber = max(1, (int)$matches[1]);
         }
         $start = ($pageNumber - 1) * $nbrOfElementByPage;
         $profs = getFiveProfs( $start, $nbrOfElementByPage);
         require_once("../views/liste.prof.html.php");
      }elseif($_REQUEST["page"]=="logout") {
         unset($_SESSION["userConnect"]);
         unset($_SESSION["anneEncours"]);
         session_destroy();
         header("location:".webRoot );
      }elseif($_REQUEST["page"]=="detail") {
         $demandeId = isset($_REQUEST['demande_id']) ? $_REQUEST['demande_id'] : null;
         if($_SESSION['userConnect']['role'] == "ROLE_AC"){
            $classeId = isset($_REQUEST['classe_id']) ? $_REQUEST['classe_id'] : null;
            $classe=getClasseById( $classeId);
         }
         $demande = getDemandById($demandeId,$_SESSION["anneEncours"]["id"]);
         
         require_once("../views/detail.demande.html.php");
      }elseif($_REQUEST["page"]=="detail_prof") {
         $profId = isset($_REQUEST['prof_id']) ? $_REQUEST['prof_id'] : null;
         $prof = getProfById($profId);
         $nbrOfModules=nbrOfModulesByProf($profId);
         $nbrOfClasses=nbrOfClassesByProf($profId);
         require_once("../views/detail.prof.html.php");
      }elseif($_REQUEST["page"]=="form-login") {
         $login=$_REQUEST['email'];
         $password=$_REQUEST['password'];
         $etudiantConnecter=connexion( $login, $password);
         if($etudiantConnecter==null){
            header("location:".webRoot);
         }else{
            $_SESSION["userConnect"]=$etudiantConnecter;
            $_SESSION["anneEncours"]=getAnneEnCours();
            if($_SESSION["userConnect"]["role"]=="ROLE_ETUDIANT"){
               header("location:".webRoot."?page=liste");
            }
            if($_SESSION["userConnect"]["role"]=="ROLE_AC"){
               header("location:".webRoot."?page=liste_ac");
            }
            if($_SESSION["userConnect"]["role"]=="ROLE_RP"){
               $classes=allclasse();
               header("location:".webRoot."?page=liste_classe");
            }
         }
      }elseif($_REQUEST["page"]=="form-filtre-demande"){
         $etat=$_REQUEST['etat'];
         $nbrOfDemandes=nbrOfDemandeByEtat($_SESSION["userConnect"]["id"],$_SESSION["anneEncours"]["id"],$etat);
         $nbrOfPage= ceil($nbrOfDemandes/5);
         $pageNumber = 1;
         if(isset($_REQUEST["liste"]) && preg_match("/^liste(\d+)$/", $_REQUEST["liste"], $matches)) {
               $pageNumber = max(1, (int)$matches[1]);
         }
         $start = ($pageNumber - 1) * $nbrOfElementByPage;
         $demandes = getFiveDemande($_SESSION["userConnect"]["id"],$_SESSION["anneEncours"]["id"], $start, $nbrOfElementByPage, $etat);
         require_once("../views/liste.demande.html.php");
      }elseif($_REQUEST["page"]=="form-filtre-demandeac"){
         $matricule=$_REQUEST['matricule'];
         $nbrOfDemandesac=nbrOfALLDemandeByMatricule($_SESSION["anneEncours"]["id"],$matricule);
         $nbrOfPageac= ceil($nbrOfDemandesac/5);
         $pageNumber = 1;
         if(isset($_REQUEST["liste"]) && preg_match("/^liste(\d+)$/", $_REQUEST["liste"], $matches)) {
            $pageNumber = max(1, (int)$matches[1]);
         }
         $start = ($pageNumber - 1) * $nbrOfElementByPage;
         $demandes = getFiveDemandeac($_SESSION["anneEncours"]["id"], $start, $nbrOfElementByPage, $matricule);
         require_once("../views/liste.ac.html.php");
      }elseif($_REQUEST["page"]=="form-filtre-module"){
         $modules=allModules();
         $module=$_REQUEST['module'];
         $nbrOfProf=nbrOfProfsByModule($module);
         $nbrOfPagemod= ceil($nbrOfProf/5);
         $pageNumber = 1;
         if(isset($_REQUEST["liste"]) && preg_match("/^liste(\d+)$/", $_REQUEST["liste"], $matches)) {
            $pageNumber = max(1, (int)$matches[1]);
         }
         $start = ($pageNumber - 1) * $nbrOfElementByPage;
         $profs = getFiveProfs( $start, $nbrOfElementByPage, $module);
         require_once("../views/liste.prof.html.php");
      }elseif($_REQUEST["page"]=="form-filtre-nom-prenom"){
         $classes=allclasse();
         $nom_prrenom=$_REQUEST['nom_prenom'];
         $nbrOfclass=nbrOfClassesByProf2($nom_prrenom);
         $nbrOfPageclass= ceil($nbrOfclass/5);
         $pageNumber = 1;
         if(isset($_REQUEST["liste"]) && preg_match("/^liste(\d+)$/", $_REQUEST["liste"], $matches)) {
            $pageNumber = max(1, (int)$matches[1]);
         }
         $start = ($pageNumber - 1) * $nbrOfElementByPage;
         $classes = getFiveClasses2( $start, $nbrOfElementByPage, $nom_prrenom);
         require_once("../views/liste.classe.html.php");
      }elseif($_REQUEST["page"]=="form-add-demande"){
         $newDemande=[
            "id" => getLastDemandeId(),
            "date" => date("d/m/y",strtotime("now")),
            "etat" => "En cours",
            "type" => $_REQUEST['type'],
            "motif" => $_REQUEST['motif'],
            "etudiant_id"=>$_SESSION["userConnect"]["id"],
            "annee_id"=>$_SESSION["anneEncours"]["id"],
         ];
         addDemande($newDemande);
         $demandes = getFiveDemande($_SESSION["userConnect"]["id"], $_SESSION["anneEncours"]["id"], $start, $nbrOfElementByPage);
         header("location:".webRoot."?page=liste");
      }elseif($_REQUEST["page"]=="form-add-demande2"){
         header("location:".webRoot."?page=liste");
      }elseif($_REQUEST["page"]=="form-add-classe"){
         $newClasse=[
            "id" => getLastClasseId(),
            "libelle" => $_REQUEST['libelle'],
            "filliere" => $_REQUEST['filliere'],
            "niveau" => $_REQUEST['niveau'],
         ];
         addClasse($newClasse);
         $classes=allclasse();
         header("location:".webRoot."?page=liste_classe");
      }elseif($_REQUEST["page"]=="form-add-classe2"){
         header("location:".webRoot."?page=liste_classe");
      }elseif ($_REQUEST["page"] == "form-add-prof") {
         $checkedModules = isset($_POST['moduleIds']) ? $_POST['moduleIds'] : [];
         $modulesIds=convertArrayElementsToInt($checkedModules);
         var_dump($modulesIds);
         $checkedClasses = isset($_POST['classesIds']) ? $_POST['classesIds'] : [];
         $classesIds=convertArrayElementsToInt($checkedClasses);
         $newProf = [
            "id" => getLastProfId(),
            "nom" => $_REQUEST['nom'],
            "prenom" => $_REQUEST['prenom'],
            "grade" => $_REQUEST['grade'],
            "moduleIds"=>$modulesIds,
            'classesIds'=>$classesIds,
         ];
         addProf($newProf);
         header("location:" . webRoot . "?page=liste_prof");
      }elseif($_REQUEST["page"] == "form-add-prof2") {
         header("location:" . webRoot . "?page=liste_prof");
      }elseif ($_REQUEST["page"] == "form-add-classe-for-prof") {
         $profId = isset($_REQUEST['prof_id']) ? $_REQUEST['prof_id'] : null;
         $prof = getProfById($profId);
         $checkedClasses = [
            'classesIds'=>isset($_REQUEST['classesIds']) ? $_REQUEST['classesIds'] : []
         ];
         affecternewdata($profId ,'classesIds',$checkedClasses );
         header("location:" . webRoot ."?page=liste_prof");
      }elseif($_REQUEST["page"] == "form-add-classe-for-prof2") {
         header("location:" . webRoot ."?page=liste_prof");
      }elseif ($_REQUEST["page"] == "form-add-module-for-prof") {
         $profId = isset($_REQUEST['prof_id']) ? $_REQUEST['prof_id'] : null;
         $prof = getProfById($profId);
         $checkedModules = [
            'moduleIds'=>isset($_REQUEST['modulesIds']) ? $_REQUEST['modulesIds'] : []
         ];
         affecternewdata($profId ,'moduleIds',$checkedModules );
         header("location:" . webRoot ."?page=liste_prof");
      }elseif($_REQUEST["page"] == "form-add-module-for-prof2") {
         header("location:" . webRoot ."?page=liste_prof");
      }
   }else{
      require_once("../views/security/login.html.php");
   }
?>

