<?php
// config.php - Enhanced Database Configuration
session_start();

// Database configuration
define('DB_HOST', 'localhost');
define('DB_USER', 'root');
define('DB_PASS', '');
define('DB_NAME', 'portfolio_db');

// Application configuration
define('SITE_NAME', 'Fanuel Masuka Portfolio');
define('SITE_URL', 'http://localhost/portfolio');
define('ADMIN_EMAIL', 'admin@fanuelmasuka.com');

// Error reporting (disable in production)
error_reporting(E_ALL);
ini_set('display_errors', 1);

// Timezone
date_default_timezone_set('Africa/Harare');

// Create database connection
function getDBConnection() {
    static $conn = null;
    
    if ($conn === null) {
        $conn = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
        
        if ($conn->connect_error) {
            die("Connection failed: " . $conn->connect_error);
        }
        
        // Set charset to UTF-8
        $conn->set_charset("utf8mb4");
    }
    
    return $conn;
}

// Initialize database tables if they don't exist
function initializeDatabase() {
    $conn = getDBConnection();
    
    // Check if admin_users table exists
    $checkTable = $conn->query("SHOW TABLES LIKE 'admin_users'");
    if ($checkTable->num_rows == 0) {
        // Run database setup
        runDatabaseSetup();
    }
}

// Function to run database setup
function runDatabaseSetup() {
    $conn = getDBConnection();
    
    // SQL to create tables and insert default data
    $sql = "
    -- Create admin_users table
    CREATE TABLE IF NOT EXISTS admin_users (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        username VARCHAR(50) UNIQUE NOT NULL,
        password_hash VARCHAR(255) NOT NULL,
        full_name VARCHAR(100),
        email VARCHAR(100),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        last_login TIMESTAMP NULL,
        status ENUM('active', 'inactive') DEFAULT 'active'
    );
    
    -- Create messages table
    CREATE TABLE IF NOT EXISTS messages (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        email VARCHAR(100) NOT NULL,
        subject VARCHAR(200) NOT NULL,
        message TEXT NOT NULL,
        ip_address VARCHAR(45),
        user_agent TEXT,
        status ENUM('unread', 'read', 'replied', 'archived') DEFAULT 'unread',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
    
    -- Create chatbot_conversations table
    CREATE TABLE IF NOT EXISTS chatbot_conversations (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        session_id VARCHAR(100) NOT NULL,
        user_message TEXT NOT NULL,
        bot_response TEXT NOT NULL,
        message_type ENUM('question', 'greeting', 'feedback', 'other') DEFAULT 'question',
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        INDEX (session_id)
    );
    
    -- Create chatbot_feedback table
    CREATE TABLE IF NOT EXISTS chatbot_feedback (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        conversation_id INT(11),
        helpful TINYINT(1),
        feedback TEXT,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        FOREIGN KEY (conversation_id) REFERENCES chatbot_conversations(id) ON DELETE SET NULL
    );
    
    -- Create projects table
    CREATE TABLE IF NOT EXISTS projects (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        title VARCHAR(200) NOT NULL,
        description TEXT NOT NULL,
        image_url VARCHAR(500),
        category ENUM('software', 'data', 'education', 'other') DEFAULT 'software',
        tags TEXT,
        github_url VARCHAR(500),
        live_url VARCHAR(500),
        featured TINYINT(1) DEFAULT 0,
        display_order INT(11) DEFAULT 0,
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
        updated_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
    );
    
    -- Create skills table
    CREATE TABLE IF NOT EXISTS skills (
        id INT(11) AUTO_INCREMENT PRIMARY KEY,
        name VARCHAR(100) NOT NULL,
        category ENUM('software', 'data', 'education', 'other') DEFAULT 'software',
        proficiency INT(11) DEFAULT 50 COMMENT 'Percentage from 0-100',
        display_order INT(11) DEFAULT 0,
        icon_class VARCHAR(50),
        created_at TIMESTAMP DEFAULT CURRENT_TIMESTAMP
    );
    
    -- Insert default admin user (username: fanny, password: masuka@2022)
    INSERT IGNORE INTO admin_users (username, password_hash, full_name, email) 
    VALUES ('fanny', '" . password_hash('masuka@2022', PASSWORD_DEFAULT) . "', 'Fanuel Masuka', 'admin@fanuelmasuka.com');
    
    -- Insert sample projects
    INSERT IGNORE INTO projects (title, description, image_url, category, tags, github_url, live_url, featured, display_order) VALUES
    ('E-Learning Platform', 'A comprehensive online learning platform with course management, video lectures, quizzes, and progress tracking.', 'https://images.unsplash.com/photo-1516321318423-f06f85e504b3?ixlib=rb-4.0.3&auto=format&fit=crop&w=870&q=80', 'software', 'PHP,MySQL,JavaScript,Laravel', 'https://github.com/fanuel/e-learning', 'https://elearning.demo.com', 1, 1),
    ('Sales Data Analytics Dashboard', 'Interactive dashboard for visualizing sales performance, customer demographics, and revenue trends.', 'https://images.unsplash.com/photo-1551288049-bebda4e38f71?ixlib=rb-4.0.3&auto=format&fit=crop&w=870&q=80', 'data', 'Python,Tableau,SQL,Data Visualization', 'https://github.com/fanuel/analytics-dashboard', 'https://analytics.demo.com', 1, 2),
    ('IT Training Curriculum', 'Developed a comprehensive 12-week curriculum for beginner to intermediate software development training.', 'https://images.unsplash.com/photo-1522202176988-66273c2fd55f?ixlib=rb-4.0.3&auto=format&fit=crop&w=871&q=80', 'education', 'Curriculum Design,E-Learning,Instructional Design', 'https://github.com/fanuel/it-curriculum', 'https://curriculum.demo.com', 0, 3),
    ('Inventory Management System', 'Web-based system for tracking inventory, orders, and suppliers with automated reporting features.', 'https://images.unsplash.com/photo-1552664730-d307ca884978?ixlib=rb-4.0.3&auto=format&fit=crop&w=870&q=80', 'software', 'PHP,MySQL,JavaScript,Bootstrap', 'https://github.com/fanuel/inventory-system', 'https://inventory.demo.com', 0, 4),
    ('Customer Churn Prediction Model', 'Machine learning model to predict customer churn with 87% accuracy for a telecom company.', 'https://images.unsplash.com/photo-1555949963-aa79dcee981c?ixlib=rb-4.0.3&auto=format&fit=crop&w=870&q=80', 'data', 'Python,Machine Learning,Pandas,Scikit-learn', 'https://github.com/fanuel/churn-prediction', 'https://churn.demo.com', 1, 5),
    ('Coding Bootcamp Platform', 'Platform for delivering coding bootcamps with interactive coding exercises and mentor support.', 'https://images.unsplash.com/photo-1535223289827-42f1e9919769?ixlib=rb-4.0.3&auto=format&fit=crop&w=870&q=80', 'education', 'React,Node.js,MongoDB,Education', 'https://github.com/fanuel/bootcamp-platform', 'https://bootcamp.demo.com', 0, 6);
    
    -- Insert skills
    INSERT IGNORE INTO skills (name, category, proficiency, display_order, icon_class) VALUES
    -- Software Development Skills
    ('PHP & Laravel', 'software', 90, 1, 'fab fa-php'),
    ('JavaScript & React', 'software', 85, 2, 'fab fa-js-square'),
    ('Python & Django', 'software', 80, 3, 'fab fa-python'),
    ('Java & Spring Boot', 'software', 70, 4, 'fab fa-java'),
    ('Database Design (MySQL, MongoDB)', 'software', 90, 5, 'fas fa-database'),
    ('RESTful APIs', 'software', 85, 6, 'fas fa-code'),
    -- Data Analysis Skills
    ('Python (Pandas, NumPy)', 'data', 85, 1, 'fab fa-python'),
    ('R Programming', 'data', 70, 2, 'fas fa-chart-line'),
    ('SQL for Data Analysis', 'data', 90, 3, 'fas fa-database'),
    ('Data Visualization (Tableau, Power BI)', 'data', 85, 4, 'fas fa-chart-bar'),
    ('Statistical Analysis', 'data', 80, 5, 'fas fa-chart-area'),
    ('Machine Learning Basics', 'data', 75, 6, 'fas fa-brain'),
    -- IT Education Skills
    ('Curriculum Development', 'education', 85, 1, 'fas fa-book'),
    ('Technical Training & Workshops', 'education', 90, 2, 'fas fa-chalkboard-teacher'),
    ('E-Learning Platforms', 'education', 75, 3, 'fas fa-laptop-code'),
    ('Mentorship Programs', 'education', 85, 4, 'fas fa-user-graduate'),
    ('Instructional Design', 'education', 70, 5, 'fas fa-tasks'),
    ('Learning Management Systems', 'education', 80, 6, 'fas fa-graduation-cap');
    ";
    
    // Execute multiple queries
    $conn->multi_query($sql);
    
    // Clear results
    while ($conn->more_results()) {
        $conn->next_result();
    }
    
    error_log("Database initialized successfully");
}

// Initialize database on first run
initializeDatabase();

// Helper functions
function sanitizeInput($data) {
    $conn = getDBConnection();
    return $conn->real_escape_string(trim($data));
}

function redirect($url) {
    header("Location: $url");
    exit();
}

function isLoggedIn() {
    return isset($_SESSION['admin_logged_in']) && $_SESSION['admin_logged_in'] === true;
}

function requireLogin() {
    if (!isLoggedIn()) {
        $_SESSION['redirect_to'] = $_SERVER['REQUEST_URI'];
        redirect('login.php');
    }
}

// Get database connection
$conn = getDBConnection();
?>