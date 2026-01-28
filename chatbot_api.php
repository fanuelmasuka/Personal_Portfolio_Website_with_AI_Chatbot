<?php
// chatbot_api.php - Backend API for AI Chatbot
require_once 'config.php';
session_start();

header('Content-Type: application/json');

// Generate or retrieve session ID
if (!isset($_SESSION['chatbot_session_id'])) {
    $_SESSION['chatbot_session_id'] = uniqid('chat_', true);
}

$session_id = $_SESSION['chatbot_session_id'];

// Handle different request types
$action = $_POST['action'] ?? 'process_message';

switch ($action) {
    case 'process_message':
        processMessage();
        break;
    case 'get_conversations':
        getConversations();
        break;
    case 'save_feedback':
        saveFeedback();
        break;
    default:
        echo json_encode(['error' => 'Invalid action']);
        break;
}

function processMessage() {
    global $conn, $session_id;
    
    $user_message = trim($_POST['message'] ?? '');
    
    if (empty($user_message)) {
        echo json_encode(['error' => 'Message is required']);
        return;
    }
    
    // Generate bot response
    $bot_response = generateBotResponse($user_message);
    
    // Save conversation to database
    $stmt = $conn->prepare("INSERT INTO chatbot_conversations (session_id, user_message, bot_response) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $session_id, $user_message, $bot_response);
    
    if ($stmt->execute()) {
        $conversation_id = $stmt->insert_id;
        echo json_encode([
            'success' => true,
            'response' => $bot_response,
            'conversation_id' => $conversation_id,
            'timestamp' => date('g:i A')
        ]);
    } else {
        echo json_encode(['error' => 'Failed to save conversation']);
    }
    
    $stmt->close();
}

function generateBotResponse($message) {
    $message = strtolower(trim($message));
    
    // Enhanced response logic
    $responses = [
        'skills' => [
            'patterns' => ['skill', 'what can you do', 'expert', 'technology', 'programming', 'coding'],
            'response' => "Fanuel has extensive skills in three key areas:\n\n" .
                         "🏗️ **Software Development**:\n" .
                         "• PHP & Laravel (Expert)\n" .
                         "• JavaScript & React (Advanced)\n" .
                         "• Python & Django (Advanced)\n" .
                         "• Java & Spring Boot (Intermediate)\n" .
                         "• Database Design (MySQL, MongoDB)\n" .
                         "• RESTful APIs (Advanced)\n\n" .
                         "📊 **Data Analysis**:\n" .
                         "• Python (Pandas, NumPy)\n" .
                         "• R Programming\n" .
                         "• SQL for Data Analysis\n" .
                         "• Data Visualization (Tableau, Power BI)\n" .
                         "• Statistical Analysis\n" .
                         "• Machine Learning Basics\n\n" .
                         "👨‍🏫 **IT Education**:\n" .
                         "• Curriculum Development\n" .
                         "• Technical Training & Workshops\n" .
                         "• E-Learning Platforms\n" .
                         "• Mentorship Programs\n" .
                         "• Instructional Design"
        ],
        
        'projects' => [
            'patterns' => ['project', 'work', 'portfolio', 'built', 'developed', 'application'],
            'response' => "Fanuel has worked on several impressive projects:\n\n" .
                         "1. **E-Learning Platform** - Full-stack platform with course management\n" .
                         "2. **Sales Data Analytics Dashboard** - Interactive visualization tool\n" .
                         "3. **IT Training Curriculum** - 12-week coding bootcamp program\n" .
                         "4. **Inventory Management System** - Web-based tracking system\n" .
                         "5. **Customer Churn Prediction Model** - ML model with 87% accuracy\n" .
                         "6. **Coding Bootcamp Platform** - Interactive learning environment\n\n" .
                         "Each project demonstrates his ability to solve real-world problems using technology."
        ],
        
        'contact' => [
            'patterns' => ['contact', 'email', 'phone', 'reach', 'hire', 'collaborate'],
            'response' => "You can contact Fanuel through multiple channels:\n\n" .
                         "📧 **Email**: fanuel.masuka@example.com\n" .
                         "📱 **Phone**: +1 (123) 456-7890\n" .
                         "📍 **Location**: Harare, Zimbabwe\n\n" .
                         "He's available for:\n" .
                         "• Software development projects\n" .
                         "• Data analysis consulting\n" .
                         "• IT education partnerships\n" .
                         "• Technical mentorship\n\n" .
                         "You can also use the contact form on this website for direct communication."
        ],
        
        'experience' => [
            'patterns' => ['experience', 'year', 'background', 'career', 'work history', 'professional'],
            'response' => "Fanuel has over 5 years of professional experience:\n\n" .
                         "🔧 **Software Development**:\n" .
                         "• Full-stack web application development\n" .
                         "• API design and implementation\n" .
                         "• Database architecture and optimization\n" .
                         "• Agile development methodologies\n\n" .
                         "📈 **Data Analysis**:\n" .
                         "• Business intelligence and reporting\n" .
                         "• Predictive modeling and analytics\n" .
                         "• Data visualization and dashboard creation\n" .
                         "• Statistical analysis and interpretation\n\n" .
                         "🎓 **IT Education**:\n" .
                         "• Curriculum development for tech programs\n" .
                         "• Workshop facilitation and training\n" .
                         "• E-learning platform implementation\n" .
                         "• Student mentorship and guidance"
        ],
        
        'education' => [
            'patterns' => ['education', 'degree', 'learn', 'teach', 'train', 'instruct'],
            'response' => "As an IT Educator, Fanuel focuses on:\n\n" .
                         "• Developing comprehensive technical curricula\n" .
                         "• Creating engaging learning materials\n" .
                         "• Facilitating hands-on coding workshops\n" .
                         "• Mentoring aspiring developers\n" .
                         "• Implementing e-learning solutions\n" .
                         "• Assessing learning outcomes\n\n" .
                         "His educational approach combines theoretical knowledge with practical application."
        ],
        
        'default' => [
            'response' => "I'm Fanuel's AI assistant. I can help you learn about:\n\n" .
                         "• His technical skills and expertise\n" .
                         "• Recent projects and portfolio work\n" .
                         "• Professional experience and background\n" .
                         "• Contact information and availability\n" .
                         "• IT education and training services\n\n" .
                         "What specific information would you like to know?"
        ]
    ];
    
    // Check for matching patterns
    foreach ($responses as $key => $data) {
        if ($key === 'default') continue;
        
        foreach ($data['patterns'] as $pattern) {
            if (strpos($message, $pattern) !== false) {
                return $data['response'];
            }
        }
    }
    
    // Special greetings
    if (preg_match('/^(hello|hi|hey|greetings)/i', $message)) {
        return "Hello! I'm Fanuel's AI Assistant. I can help you learn more about his skills, projects, and experience. What would you like to know?";
    }
    
    if (preg_match('/^(thank|thanks|appreciate)/i', $message)) {
        return "You're welcome! I'm here to help. If you have more questions about Fanuel's work or background, feel free to ask.";
    }
    
    if (preg_match('/^(bye|goodbye|see you)/i', $message)) {
        return "Goodbye! Feel free to return if you have more questions about Fanuel's portfolio. Have a great day!";
    }
    
    return $responses['default']['response'];
}

function getConversations() {
    global $conn, $session_id;
    
    $stmt = $conn->prepare("SELECT user_message, bot_response, created_at FROM chatbot_conversations WHERE session_id = ? ORDER BY created_at ASC");
    $stmt->bind_param("s", $session_id);
    $stmt->execute();
    $result = $stmt->get_result();
    
    $conversations = [];
    while ($row = $result->fetch_assoc()) {
        $conversations[] = $row;
    }
    
    echo json_encode(['conversations' => $conversations]);
    $stmt->close();
}

function saveFeedback() {
    global $conn;
    
    $conversation_id = intval($_POST['conversation_id'] ?? 0);
    $helpful = intval($_POST['helpful'] ?? 0);
    $feedback = trim($_POST['feedback'] ?? '');
    
    if ($conversation_id > 0) {
        $stmt = $conn->prepare("INSERT INTO chatbot_feedback (conversation_id, helpful, feedback) VALUES (?, ?, ?)");
        $stmt->bind_param("iis", $conversation_id, $helpful, $feedback);
        
        if ($stmt->execute()) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['error' => 'Failed to save feedback']);
        }
        
        $stmt->close();
    } else {
        echo json_encode(['error' => 'Invalid conversation ID']);
    }
}

$conn->close();
?>