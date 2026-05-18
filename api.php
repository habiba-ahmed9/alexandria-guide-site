<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');
header('Access-Control-Allow-Methods: GET, POST, OPTIONS');
header('Access-Control-Allow-Headers: Content-Type');

require_once 'config.php';

$method = $_SERVER['REQUEST_METHOD'];
$action = isset($_GET['action']) ? $_GET['action'] : '';

switch($action) {
    
    case 'signup':
        if($method == 'POST') {
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
        }
        break;
        
    case 'signin':
        if($method == 'POST') {
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
        }
        break;
        
    case 'save-tour':
        if($method == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $user_email = $data['email'] ?? '';
            $attractions = json_encode($data['attractions'] ?? []);
            $tour_date = $data['tourDate'] ?? '';
            $travelers = $data['travelers'] ?? 1;
            $accommodation = $data['accommodation'] ?? '';
            $transport = $data['transport'] ?? '';
            $total_cost = $data['totalCost'] ?? 0;
            
            $stmt = $pdo->prepare("INSERT INTO tour_plans (user_email, attractions, tour_date, travelers, accommodation, transport, total_cost) VALUES (?, ?, ?, ?, ?, ?, ?)");
            $stmt->execute([$user_email, $attractions, $tour_date, $travelers, $accommodation, $transport, $total_cost]);
            
            echo json_encode(['success' => true, 'message' => 'Tour plan saved!']);
        }
        break;
        
    case 'get-tour':
        if($method == 'GET') {
            $email = $_GET['email'] ?? '';
            $stmt = $pdo->prepare("SELECT * FROM tour_plans WHERE user_email = ? ORDER BY created_at DESC LIMIT 1");
            $stmt->execute([$email]);
            $plan = $stmt->fetch();
            
            if($plan) {
                $plan['attractions'] = json_decode($plan['attractions'], true);
                echo json_encode(['success' => true, 'plan' => $plan]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No tour plan found']);
            }
        }
        break;
        
    case 'contact':
        if($method == 'POST') {
            $data = json_decode(file_get_contents('php://input'), true);
            $name = $data['name'] ?? '';
            $email = $data['email'] ?? '';
            $subject = $data['subject'] ?? '';
            $message = $data['message'] ?? '';
            
            $stmt = $pdo->prepare("INSERT INTO contact_messages (name, email, subject, message) VALUES (?, ?, ?, ?)");
            $stmt->execute([$name, $email, $subject, $message]);
            
            echo json_encode(['success' => true, 'message' => 'Message sent successfully!']);
        }
        break;
        
    default:
        echo json_encode(['success' => false, 'message' => 'Invalid action']);
        break;
}
?>