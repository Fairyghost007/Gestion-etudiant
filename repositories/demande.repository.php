<?php
function allData(string $key){
   return fromJsonToArray($key);
}
function alldemands(int|null $anneeId=null):array{
   $demandes= allData("demandes");
   if($anneeId==null) {
      return $demandes;
   }else{
      $demandesEtu=[];
      foreach($demandes as $demande){
         if($demande['annee_id']==$anneeId){
            $etudiant=getEtudiantById($demande['etudiant_id']);
            $demandesEtu[]=array_merge($etudiant,$demande) ;
         }
      }
      return $demandesEtu;
   }
   
};
function allprof2():array{
   $profs= allData("profs");
   $profsMod=[];
   foreach($profs as $prof){
      $moduleIds = $prof['moduleIds'];
      $classesIds = $prof['classesIds'];
      $modules =[];
      $classes=[];
      foreach($moduleIds as $moduleId){
         $modules[] = getModuleById($moduleId);
      }
      foreach($classesIds as $classesId){
         $classes[] = getClasseById($classesId);
      }
      $profsMod[] = array_merge($prof, ['modules' => $modules]) + array_merge($prof, ['classes' => $classes]);

     
   }
   return $profsMod;
};
function allUsers():array{
   return allData("users");
};
function allProfs():array{
   return allData("profs");
};
function allModules():array{
   return allData("modules");
};
function allModulesByProfId():array{
   return allData("modules");
};
function allclasse():array{
   return allData("classes");
};
function allAnne():array{
   return allData("annees");
};
function allUsersByRole(string $role):array{
   $users=allUsers();
   $etudiants=[];
   foreach($users as $user){
      if($user["role"]===$role){
         $etudiants[]=$user;
      }
   }
   return $etudiants;
};
function alletudiants():array{
   $etudiants= allUsersByRole("ROLE_ETUDIANT");
   $etudiantClasse=[];
   foreach($etudiants as $etudiant){
      $classe=getClasseById($etudiant["classe_id"]);
      $etudiantClasse[]=array_merge($classe,$etudiant);
   }
   return $etudiantClasse;
};
function addData(string $data,array $newData ){
   fromArrayToJson($data,$newData);
}
function addDemande($demande):void{
   addData("demandes",$demande);
};
function addClasse($classe):void{
   addData("classes",$classe);
};
function addProf($prof):void{
   addData("profs",$prof);
};

function presence($etudiants, $etu) {
   foreach ($etudiants as $etudiant) {
       if ($etudiant == $etu) {
           return true;
       }
   }
   return false;
}

function getAlletudiantsGivedemande(int $anneId){
   $etudiants=alletudiants();
   $demandes=alldemands($anneId);
   $etudiantsGivedemande=[];
   foreach($demandes as $demande){
      foreach($etudiants as $etu){
         if($etu["id"]==$demande["etudiant_id"] && !presence($etudiantsGivedemande, $etu)){
            $etudiantsGivedemande[]=$etu;
         }
      }
      
   }
   return $etudiantsGivedemande;
}
function getClasseRestant(int $id){
   $prof=getProfById($id);
   $classes=allclasse();
   $classesIds = $prof['classesIds'];
   $classNew=[];
   foreach($classes as $classe){
      if(!presence($classesIds,$classe['id'])){
         $classNew[]=$classe;
      }
   }
   return $classNew;
}
function getModuleRestant(int $id){
   $prof=getProfById($id);
   $modules=allModules();
   $moduleIds = $prof['moduleIds'];
   $moduleNew=[];
   foreach($modules as $module){
      if(!presence($moduleIds,$module['id'])){
         $moduleNew[]=$module;
      }
   }
   return $moduleNew;
}
function connexion(string $login,string $password):array|null{
   $users=allUsers();
   foreach($users as $user){
      if($user["login"]==$login && $user["password"]==$password){
         if($user['role']=="ROLE_ETUDIANT"){
            $classe=getClasseById($user["classe_id"]);
            $user=array_merge($classe,$user);
         }
         return $user;
      }
   }
   return null;
}

function getAnneEnCours():array|null{
   $annee1=allAnne();
   foreach ($annee1 as $value){
      if($value["etat"]=="Encours"){
         return $value;
      } 
   } 
   return null;
};
function getFiveDemande(int $etudiantId, int $anneId, int $start = 0, int $nbrOfElementByPage = 5, $etat = "Select Etat"): array {
   $demandes = alldemands();
   $demandesSubset = [];

   foreach ($demandes as $value) {
      if($etat=="Select Etat"){
         if($value['etudiant_id']===$etudiantId && $value['annee_id']===$anneId){
            $demandesSubset[]=$value;
         }
      }else{
         if($value['etudiant_id']===$etudiantId && $value['annee_id']===$anneId && $value['etat']===$etat){
            $demandesSubset[]=$value;
         }
      }
   }
   $demandesSubset = array_slice($demandesSubset, $start, $nbrOfElementByPage);

   return $demandesSubset;
}
function getFiveDemandeac(int $anneId, int $start = 0, int $nbrOfElementByPage = 5, string $matricule="allmatricule"):array|null{
   $demandes = alldemands($anneId);
   $demandesSubset = [];
   foreach ($demandes as $value) {
      if($matricule=="allmatricule"){
         if($value['annee_id']===$anneId){
            $demandesSubset[]=$value;
         }
      }else{
         if($value['annee_id']===$anneId && $value['matricule']===$matricule){
            $demandesSubset[]=$value;
         }
      }
   }
   $demandesSubset = array_slice($demandesSubset, $start, $nbrOfElementByPage);

   return $demandesSubset;
}
function getFiveProfs(int $start = 0, int $nbrOfElementByPage = 5, string $module="0"):array|null{
   $profs = allprof2();
   $demandesSubset = [];
   foreach ($profs as $prof) {
      if($module=="0"){
         $demandesSubset[]=$prof;
      }else{
         if(presence($prof['moduleIds'],$module)){
            $demandesSubset[]=$prof;
         }
      }
   }
   $demandesSubset = array_slice($demandesSubset, $start, $nbrOfElementByPage);

   return $demandesSubset;
}
function getFiveClasses2(int $start = 0, int $nbrOfElementByPage = 5, string $nom_prenom = "0"): array|null {
   $profs = allprof2();
   $classes = allclasse();
   $demandesSubset = [];
   $classeIDs = [];
   if ($nom_prenom === "0") {
       $demandesSubset = $classes;
   }else{
      foreach ($profs as $prof) {
         if ($prof['id'] == $nom_prenom) {
            $classeIDs = $prof['classesIds'];
         }
      }
      foreach ($classes as $classe) {
         if (in_array($classe["id"], $classeIDs)) { 
            $demandesSubset[] = $classe;
         }
      }
   }

   $demandesSubset = array_slice($demandesSubset, $start, $nbrOfElementByPage);
   return $demandesSubset;
}

function getDataById(array $data, int $id, string $key="id"){
   foreach($data as $value){
      if($value[$key]==$id){
         return $value;
      }
   }
   return null;
}
function getClasseById(int $id):array|null{
   $classes=allclasse();
   return getDataById($classes,$id);
}
function getEtudiantById(int $id):array|null{
   $etudiants=alletudiants();
   return  getDataById($etudiants ,$id);
};
function getDemandById(int $id, int $anneId=1):array|null{
   $demandes = alldemands($anneId);
   return  getDataById($demandes,$id);
};
function getProfById(int $id):array|null{
   $profs = allprof2();
   return  getDataById($profs,$id);
};
function getModuleById(int $id):array|null{
   $modules = allModules();
   return  getDataById($modules,$id);
};

function getLastId(array $data){
   $i=1;
   foreach($data as $dat){
      if($dat["id"]==$i){
         $i++;
      }
   }
   return $i;

}
function getLastDemandeId():int{
   $demandes=alldemands();
   return getLastId($demandes);
}
function getLastClasseId():int{
   $classes=allclasse();
   return getLastId($classes);
}
function getLastProfId():int{
   $profs=allProfs();
   return getLastId($profs);
}
function nbrOfDemandeByEtat($etudiantId,$anneId,$etat="Select Etat"):int{
   $demandes=alldemands();
   $cpt=0;
   foreach($demandes as $value){
      if($etat=="Select Etat"){
         if($value['etudiant_id']===$etudiantId && $value['annee_id']===$anneId){
            $cpt++;
         }
      }else{
         if($value['etudiant_id']===$etudiantId && $value['annee_id']===$anneId && $value['etat']===$etat){
            $cpt++;
         }
      }
   }
   return $cpt;
};
function nbrOfALLDemandeByMatricule(int $anneId, string $matricule="allmatricule"):int{
   $demandes=alldemands($anneId);
   $cpt=0;
   foreach($demandes as $value){
      if($matricule=="allmatricule"){
         if($value['annee_id']===$anneId){
            $cpt++;         }
      }else{
         if($value['annee_id']===$anneId && $value['matricule']===$matricule){
            $cpt++;    
         }
      }
   }
   return $cpt;
};
function nbrOfModulesByProf(int $id):int{
   $profs=allprof2();
   $cpt=0;
   foreach($profs as $prof){
      if($prof['id']===$id){
         $moduleIds=$prof['moduleIds'];  
      }
   }
   foreach($moduleIds as $moduleId){
      $cpt++;
   }
   return $cpt;
};
function nbrOfProfsByModule(string $module="0"):int{
   $profs=allprof2();
   $cpt=0;
   foreach($profs as $prof){
      if($module=="0"){
         $cpt++;
      }else{
         if(presence($prof['moduleIds'],$module)){
            $cpt++;
         }
      }
   }
   return $cpt;
};
function nbrOfClassesByProf(int $id):int{
   $profs=allprof2();
   $cpt=0;
   foreach($profs as $prof){
      if($prof['id']==$id){
         $classeIds=$prof['classesIds'];  
      }
   }
   foreach($classeIds as $classeId){
      $cpt++;
   }
   return $cpt;
};
function nbrOfClassesByProf2(string $nom_prrenom="0"):int{
   $profs=allprof2();
   $classes=allclasse();
   $cpt=0;
   foreach($classes as $classe){
      if($nom_prrenom==="0"){
         $cpt++;
      }else{
        return nbrOfClassesByProf($nom_prrenom);
      }
   }
   return $cpt;
};
function convertArrayElementsToInt($array) {
   foreach ($array as $value) {
       $value = intval($value);
   }
   return $array;
}

function affecternewdata(int $id, string $key2, array $new){
   fromArrayToJsonUpdate("profs" , $key2, $id,$new);
}

?>