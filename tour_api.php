<?php
require_once 'config.php';

header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

$action = $_GET['action'] ?? '';

switch($action) {
    
    case 'signup':
        $data = json_decode(file_get_contents('php://input'), true);
        $fullname = $data['name'] ?? '';
        $email = $data['email'] ?? '';
        $password = password_hash($data['password'] ?? '', PASSWORD_DEFAULT);
        
        try {
            $stmt = $pdo->prepare("INSERT INTO users (fullname, email, password) VALUES (?, ?, ?)");
            $stmt->execute([$fullname, $email, $password]);
            echo json_encode(['success' => true, 'message' => 'Registration successful!']);
        } catch(PDOException $e) {
            echo json_encode(['success' => false, 'message' => 'Email already exists!']);
        }
        break;
        
    case 'signin':
        $data = json_decode(file_get_contents('php://input'), true);
        $email = $data['email'] ?? '';
        $password = $data['password'] ?? '';
        
        $stmt = $pdo->prepare("SELECT * FROM users WHERE email = ?");
        $stmt->execute([$email]);
        $user = $stmt->fetch();
        
        if($user && password_verify($password, $user['password'])) {
            echo json_encode([
                'success' => true,
                'message' => 'Login successful!',
                'user' => ['name' => $user['fullname'], 'email' => $user['email']]
            ]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Invalid email or password']);
        }
        break;
        
    case 'save':
        $data = json_decode(file_get_contents('php://input'), true);
        $user_email = $data['email'] ?? '';
        $tour_date = $data['date'] ?? '';
        $travelers = $data['travelers'] ?? 1;
        $attractions = json_encode($data['attractions'] ?? []);
        $accommodation = $data['accommodation'] ?? '';
        $transport = $data['transport'] ?? '';
        $total_cost = $data['totalCost'] ?? 0;
        
        $stmt = $pdo->prepare("INSERT INTO tour_plans (user_email, tour_date, travelers, attractions, accommodation, transport, total_cost) VALUES (?, ?, ?, ?, ?, ?, ?)");
        $stmt->execute([$user_email, $tour_date, $travelers, $attractions, $accommodation, $transport, $total_cost]);
        
        echo json_encode(['success' => true, 'message' => 'Tour plan saved!']);
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}
?>