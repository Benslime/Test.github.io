<?php
//Connexion à la base de données 
$server="localhost";
$user="root";
$pass="";
$base="entrepot_vintage";

$conn=mysqli_connect($server,$user,$pass,$base);

if(mysqli_error($conn)){
    echo "Echec de la connexion";
}
else{
    echo "Connexion réussie";
}


// Define variables and initialize with empty values
$pseudo = $mot_de_passe = $email = "";
$pseudo_err = $mot_de_passe_err = $email_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
 
    // Validate pseudo
    if(empty(trim($_POST["pseudo"]))){
        $pseudo_err = "Veuillez saisir votre nom d'utilisateur";
    } elseif(!preg_match('/^[a-zA-Z0-9_]+$/', trim($_POST["pseudo"]))){
        $pseudo_err = "Le nom d'utilisatuer doit contenir des lettres et des chiffres seulement";
    } else{
        // Prepare a select statement
        $sql = "SELECT id FROM personnes WHERE login = ?";
        
        if($stmt = mysqli_prepare($con, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "s", $param_pseudo);
            
            // Set parameters
            $param_pseudo = trim($_POST["pseudo"]);
            
            // Attempt to execute the prepared statement
            if(mysqli_stmt_execute($stmt)){
                /* store result */
                mysqli_stmt_store_result($stmt);
                
                if(mysqli_stmt_num_rows($stmt) == 1){
                    $pseudo_err = "Ce nom d'utilisateur existe déja !";
                } else{
                    $pseudo = trim($_POST["pseudo"]);
                }
            } else{
                echo "Oops! Quelque chose ne fonctionne pas correctement";
            }

            // Close statement
            mysqli_stmt_close($stmt);
        }
    }
    
    // Validate mot_de_passe
    if(empty(trim($_POST["mot_de_passe"]))){
        $mot_de_passe_err = "Please enter a mot_de_passe.";     
    } elseif(strlen(trim($_POST["mot_de_passe"])) < 6){
        $mot_de_passe_err = "Le mot de passe doit contenir au moins 6 caractères";
    } else{
        $mot_de_passe = trim($_POST["mot_de_passe"]);
    }
    
    
    //Adresse email
    if(empty(trim($_POST["email"]))){
        $email_err = "Veuillez saisir votre adresse email"; } 
        
    elseif(!preg_match('/^([a-zA-Z0-9\.]+@+[a-zA-Z]+(\.)+[a-zA-Z]{2,3})$/', trim($_POST["email"]))){
        $email_err = "Adresse email invalide";}
    else{
        $email= trim($_POST["email"]);
    }
    
    if(empty($pseudo_err) && empty($mot_de_passe_err) && empty($email_err)){
        
        $sql="INSERT INTO personnes(login,profile,pass,eemail)values('$pseudo','élève externe','$mot_de_passe','$email')";
        $res=mysqli_query($con,$sql); 
        
        
            header("location:Accueil2.html");
        
    }      
    
    mysqli_close($con); 
}
?>