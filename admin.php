<?php
// admin.php - Admin panel to view messages
require_once 'config.php';
requireLogin();

// Fetch messages from database
$sql = "SELECT * FROM messages ORDER BY created_at DESC";
$result = $conn->query($sql);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Panel | Fanuel Masuka Portfolio</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
    <style>
        body {
            font-family: 'Roboto', sans-serif;
            background-color: #f5f5f5;
            color: #333;
        }
        
        .admin-container {
            max-width: 1000px;
            margin: 100px auto 50px;
            padding: 30px;
            background-color: white;
            border-radius: 10px;
            box-shadow: 0 5px 15px rgba(0, 0, 0, 0.1);
        }
        
        .admin-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
            padding-bottom: 15px;
            border-bottom: 2px solid #E8F5E9;
        }
        
        .admin-header h1 {
            color: #1A5D3A;
            font-size: 2rem;
        }
        
        .btn {
            display: inline-block;
            padding: 10px 20px;
            background-color: #2E8B57;
            color: white;
            border-radius: 5px;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            cursor: pointer;
            text-decoration: none;
        }
        
        .btn:hover {
            background-color: #1A5D3A;
        }
        
        .messages-table {
            width: 100%;
            border-collapse: collapse;
            margin-top: 20px;
        }
        
        .messages-table th,
        .messages-table td {
            padding: 12px 15px;
            text-align: left;
            border-bottom: 1px solid #ddd;
        }
        
        .messages-table th {
            background-color: #E8F5E9;
            color: #1A5D3A;
            font-weight: 600;
        }
        
        .messages-table tr:hover {
            background-color: rgba(46, 139, 87, 0.05);
        }
        
        .no-messages {
            text-align: center;
            padding: 40px;
            color: #666;
            font-style: italic;
        }
        
        .message-content {
            max-width: 300px;
            white-space: nowrap;
            overflow: hidden;
            text-overflow: ellipsis;
        }
        
        .logout-btn {
            background-color: #dc3545;
        }
        
        .logout-btn:hover {
            background-color: #c82333;
        }
        
        .status-badge {
            padding: 4px 8px;
            border-radius: 12px;
            font-size: 0.8rem;
            font-weight: 500;
        }
        
        .status-unread {
            background-color: #ffcdd2;
            color: #c62828;
        }
        
        .status-read {
            background-color: #c8e6c9;
            color: #2e7d32;
        }
        
        .status-replied {
            background-color: #bbdefb;
            color: #1565c0;
        }
        
        .status-archived {
            background-color: #f5f5f5;
            color: #616161;
        }
    </style>
</head>
<body>
    <div class="admin-container">
        <div class="admin-header">
            <h1><i class="fas fa-user-cog"></i> Messages Dashboard</h1>
            <div>
                <a href="index.php" class="btn">Back to Portfolio</a>
                <a href="logout.php" class="btn logout-btn">Logout</a>
            </div>
        </div>
        
        <?php if ($result->num_rows > 0): ?>
            <table class="messages-table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Subject</th>
                        <th>Message</th>
                        <th>Status</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php while ($row = $result->fetch_assoc()): 
                        $statusClass = 'status-' . $row['status'];
                    ?>
                    <tr>
                        <td><?php echo $row['id']; ?></td>
                        <td><?php echo htmlspecialchars($row['name']); ?></td>
                        <td><?php echo htmlspecialchars($row['email']); ?></td>
                        <td><?php echo htmlspecialchars($row['subject']); ?></td>
                        <td class="message-content" title="<?php echo htmlspecialchars($row['message']); ?>">
                            <?php echo htmlspecialchars($row['message']); ?>
                        </td>
                        <td>
                            <span class="status-badge <?php echo $statusClass; ?>">
                                <?php echo ucfirst($row['status']); ?>
                            </span>
                        </td>
                        <td><?php echo date('M j, Y g:i A', strtotime($row['created_at'])); ?></td>
                    </tr>
                    <?php endwhile; ?>
                </tbody>
            </table>
        <?php else: ?>
            <div class="no-messages">
                <i class="fas fa-inbox fa-3x" style="color: #ddd; margin-bottom: 15px;"></i>
                <h3>No messages yet</h3>
                <p>Messages from the contact form will appear here.</p>
            </div>
        <?php endif; ?>
    </div>
    
    <script>
        // Expand message on click
        document.querySelectorAll('.message-content').forEach(cell => {
            cell.addEventListener('click', function() {
                const fullMessage = this.getAttribute('title');
                if (fullMessage && fullMessage !== this.textContent) {
                    this.textContent = fullMessage;
                    this.style.whiteSpace = 'normal';
                    this.style.maxWidth = 'none';
                }
            });
        });
    </script>
</body>
</html>
<?php $conn->close(); ?>