<?php


session_start();

include_once "config.php";



if( isset($_POST['titre']) && isset($_POST['adresse']) && isset($_POST['ville']) 
    && isset($_POST['cp']) && isset($_POST['surface']) && isset($_POST['prix']) 
    && isset($_FILES['photo']) && isset($_POST['type']) ){



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


        if(!empty($titre) && !empty($adresse) && !empty($ville) &&  !empty($cp) && !empty($prix) && !empty($type) && !empty($surface) && !empty($_FILES['photo']['name'])){
        

                        
                        if(isset($_FILES['photo'])){
                         

                            $img = ($_FILES['photo']['name']) !== "" ? ($_FILES['photo']['name']) : "No available img.";

                            if($img !== "No available img."){
                                  
                                    $path = "../images";
                                    if (!file_exists($path)) {
                                        mkdir($path, 0777, true);
                                    }
                                   
                                    
                                    if(move_uploaded_file($_FILES['photo']['tmp_name'], "./images/".$_FILES['photo']['name'])){
                                      
                                    }else{
                                        echo " <div class='error-txt'>Une erreur est survenue!</div>";
                                        die();
                                    }

                            }
                        }else{
                            echo "<div class='error-txt'>Veuillez choisir une photo pour votre bien.</div>";
                        }
                        
                        if(strlen($cp) == 5){     

                        $cp = filter_var($cp,FILTER_VALIDATE_INT, array("options"=>array("min_range"=>00001, "max_range"=>99999)));
                        strval($cp);

                        $prix = filter_var($prix,FILTER_VALIDATE_INT, array("options"=>array("min_range"=>0, "max_range"=>9999999)));
                        intval(round($prix));
                        $surface = filter_var($surface,FILTER_VALIDATE_INT, array("options"=>array("min_range"=>0, "max_range"=>9999999)));
                        intval(round($surface));                    
                       

                        
    
                        //let's insert data in users table
                        
                        $sql = $conn -> prepare( "INSERT INTO logement (titre,adresse,ville,cp,surface,prix,photo,type,description)
                                                     VALUES (:titre,:adresse,:ville,:cp,:surface,:prix,:photo,:type,:description)");
                        $sql->bindValue(':titre', $titre, PDO::PARAM_STR);
                        $sql->bindValue(':adresse', $adresse, PDO::PARAM_STR);
                        $sql->bindValue(':ville', $ville, PDO::PARAM_STR);
                        $sql->bindValue(':cp', $cp, PDO::PARAM_STR);
                        $sql->bindValue(':surface', $surface, PDO::PARAM_INT);
                        $sql->bindValue(':prix', $prix, PDO::PARAM_INT);
                        $sql->bindValue(':photo', $img, PDO::PARAM_STR);
                        $sql->bindValue(':type', $type, PDO::PARAM_STR);
                        $sql->bindValue(':description', $description, PDO::PARAM_STR);
                        $sql->execute();
                       
                        if($sql->rowCount() > 0){

                            $sql2 = $conn->query("SELECT * FROM logement WHERE logement.photo = '{$img}' AND logement.adresse = '{$adresse}'");
                            $result = $sql2->fetch(PDO::FETCH_ASSOC);

                            if(file_exists("./images/".$result['photo'])){
                                rename("./images/".$result['photo'], "./images/logement_".$result['id_logement'].".jpg");
                            }
                                                       
                            echo " <div class='success-txt'>Enregistrement effectué avec succès!</div>";                                                          

                        }else{
                            echo "<p class='error-txt'>Quelque chose cloche!</p>";
                        } 
                    }
                    else{
                          echo "<p class='error-txt'>Le code postal est invalide!</p>";
                        
                    }

                      
                        
                }else{  echo "<p class='error-txt'>Veuillez remplir tous les champs</p>"; }

}

                    

            
        
   


