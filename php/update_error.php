<?php

session_start();

include_once "config.php";




if( isset($_POST['titre']) && isset($_POST['adresse']) && isset($_POST['ville']) 
    && isset($_POST['cp']) && isset($_POST['surface']) && isset($_POST['prix']) 
    && isset($_FILES['photo']) && isset($_POST['type']) ){


    $uid = $_POST['uid'];
    $titre = htmlspecialchars($_POST['titre']);
    $adresse = htmlspecialchars($_POST['adresse']);
    $ville = htmlspecialchars($_POST['ville']);
    $cp= htmlspecialchars($_POST['cp']);
    $surface= htmlspecialchars($_POST['surface']);
    $prix = htmlspecialchars($_POST['prix']);
    $type= htmlspecialchars($_POST['type']);
    if(!empty($_POST['description'])){
        $description = htmlspecialchars($_POST['description']);
    }else{
        $description = "Any description available for this location.";
    }


        if(!empty($titre) && !empty($adresse) && !empty($ville) &&  !empty($cp) && !empty($prix) && !empty($type) && !empty($surface) ){
                            
                         $sql0 = $conn -> query("SELECT photo,id_logement FROM logement WHERE logement.id_logement = {$uid}");
                         $row = $sql0->fetch(PDO::FETCH_ASSOC);
                         $img = $row['photo'];

                          
                      

                          if(isset($_FILES['photo']) && $_FILES['photo']['name'] !== ""){
                               
                              
                           
                          
                            $img = !empty($_FILES['photo']) ? ($_FILES['photo']['name']) : $row['photo'];

                            if($img !== "No available img."){

                                if($img !== $row['photo']){

                                    $img_name = "logement_".$row['id_logement'].".jpg";

                                      if(move_uploaded_file($_FILES['photo']['tmp_name'], "./images/".$img_name)){
                                      
                                    }else{
                                        echo " <div class='error-txt'>Une erreur est survenue!</div>";
                                        die();
                                    }


                                }
                                    
                                  

                            }else{
                                $img_name = "logement_".$row['id_logement'].".jpg";

                                  if(move_uploaded_file($_FILES['photo']['tmp_name'], "./images/".$img_name)){
                                      
                                    }else{
                                        echo " <div class='error-txt'>Une erreur est survenue!</div>";
                                        die();
                                    }

                            }
                        }
    
                        if(strlen($cp) <= 5){     

                        $cp = filter_var($cp,FILTER_VALIDATE_INT, array("options"=>array("min_range"=>00001, "max_range"=>99999)));
                        strval($cp);

                        $prix = filter_var($prix,FILTER_VALIDATE_INT, array("options"=>array("min_range"=>0, "max_range"=>9999999)));
                        intval(round($prix));
                        $surface = filter_var($surface,FILTER_VALIDATE_INT, array("options"=>array("min_range"=>0, "max_range"=>9999999)));
                        intval(round($surface));                    
                       

                        
    
                        //let's insert data in users table
                        
                        $sql = $conn -> prepare( "UPDATE logement SET titre = :titre, adresse = :adresse, ville = :ville, cp= :cp, surface = :surface, prix= :prix, photo = :photo, `type` = :type, description= :description 
                                                WHERE logement.id_logement = {$uid}");
                        $sql->bindValue(':titre', $titre, PDO::PARAM_STR);
                        $sql->bindValue(':adresse', $adresse, PDO::PARAM_STR);
                        $sql->bindValue(':ville', $ville, PDO::PARAM_STR);
                        $sql->bindValue(':cp', $cp, PDO::PARAM_STR);
                        $sql->bindValue(':surface', $surface, PDO::PARAM_INT);
                        $sql->bindValue(':prix', $prix, PDO::PARAM_INT);
                        $sql->bindValue(':photo', $img, PDO::PARAM_STR);
                        $sql->bindValue(':type', strval($type), PDO::PARAM_STR);
                        $sql->bindValue(':description', $description, PDO::PARAM_STR);
                        $sql->execute();

                        if($sql){ //check if data inserted
                            $sql3 = $conn ->query( "SELECT * FROM logement WHERE logement.id_logement = {$uid}");
                            if($sql3->rowCount() > 0){
                              
                               
                                echo " <div class='success-txt'>Modification effectué avec succès!</div>";
                                

                            }

                        }else{
                            echo "<p class='error-txt'>Aucun bien ne correspond a votre recherche</p>";
                        } 
                    }
                    else{
                        echo "Le code postal est incorrect";
                    }
                       
                }else{  echo "<p class='error-txt'>Veuillez remplir tous les champs</p>"; }

}

                    

            
        
   


