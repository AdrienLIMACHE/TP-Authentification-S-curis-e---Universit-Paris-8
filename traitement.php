<?php
session_start();

// --- 1. CONNEXION À LA BASE DE DONNÉES ---
$host = 'localhost'; $dbname = 'tp_auth'; $user = 'root'; $pass = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$dbname;charset=utf8", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Erreur de connexion : " . $e->getMessage());
}

// --- 2. TRAITEMENT DU FORMULAIRE ---
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = htmlspecialchars($_POST['username']); 
    $password = $_POST['password'];
    $action = $_POST['action'];

    if ($action === 'register') {
        $_SESSION['current_view'] = "register"; 
        
        $check = $pdo->prepare("SELECT id FROM utilisateurs WHERE username = ?");
        $check->execute([$username]);
        
        if ($check->fetch()) {
            $_SESSION['message'] = "Erreur : Cet identifiant existe déjà.";
            $_SESSION['status'] = "error";
        } else {
            $hashed_pw = password_hash($password, PASSWORD_DEFAULT);
            $insert = $pdo->prepare("INSERT INTO utilisateurs (username, password) VALUES (?, ?)");
            if ($insert->execute([$username, $hashed_pw])) {
                $_SESSION['message'] = "Ajout d'un compte réussi !"; 
                $_SESSION['status'] = "success";
                $_SESSION['current_view'] = "login"; 
            } else {
                $_SESSION['message'] = "Erreur technique.";
                $_SESSION['status'] = "error";
            }
        }

    } elseif ($action === 'login') {
        $_SESSION['current_view'] = "login";
        
        $stmt = $pdo->prepare("SELECT * FROM utilisateurs WHERE username = ?");
        $stmt->execute([$username]);
        $user = $stmt->fetch();

        if ($user && password_verify($password, $user['password'])) {
            $_SESSION['message'] = "Vous êtes connecté"; 
            $_SESSION['status'] = "success";
        } else {
            $_SESSION['message'] = "Erreur. Recommencé"; 
            $_SESSION['status'] = "error";
        }
    }
    
    
    header("Location: index.php");
    exit();
} else {
  
    header("Location: index.php");
    exit();
}
?>