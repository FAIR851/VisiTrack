<?php
session_start();
include("connect.php");

if (!isset($_SESSION['email'])) {
    header("Location: index.php");
    exit();
}

$email = $_SESSION['email'];

// Sorting logic
$sort = isset($_GET['sort']) ? $_GET['sort'] : 'visit_time';
$order = isset($_GET['order']) ? $_GET['order'] : 'DESC';

// Search logic
$search = '';
if (isset($_GET['search']) && !empty($_GET['search'])) {
    $search = mysqli_real_escape_string($conn, $_GET['search']);
    $search_condition = "WHERE Lastname LIKE '%$search%' OR Firstname LIKE '%$search%' OR Email LIKE '%$search%'";
} else {
    $search_condition = '';
}

// Pagination logic
$records_per_page = 13;
$page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
if ($page < 1) {
    $page = 1;
}
$offset = ($page - 1) * $records_per_page;

// Get total number of records
$count_query = "SELECT COUNT(*) as total FROM visitors $search_condition";
$count_result = mysqli_query($conn, $count_query);
$total_records = mysqli_fetch_assoc($count_result)['total'];
$total_pages = ceil($total_records / $records_per_page);

// Main query with pagination
$query = "SELECT * FROM visitors $search_condition ORDER BY $sort $order LIMIT $offset, $records_per_page";
$result = mysqli_query($conn, $query);
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Dashboard</title>
    <link rel="stylesheet" href="styless.css">
</head>
<body>
<nav id="sidebar">
        <ul>
            <li><div class="logo-container">
            <img src="logo.png" alt="NTC Logo" class="logo">
            </div>
                <button onclick="toggleSidebar()" id="toggle-btn">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M440-240 200-480l240-240 56 56-183 184 183 184-56 56Zm264 0L464-480l240-240 56 56-183 184 183 184-56 56Z"/></svg>
                </button>
            </li>
            <li class="active">
                <a href="dashboard.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M560-564v-68q33-14 67.5-21t72.5-7q26 0 51 4t49 10v64q-24-9-48.5-13.5T700-600q-38 0-73 9.5T560-564Zm0 220v-68q33-14 67.5-21t72.5-7q26 0 51 4t49 10v64q-24-9-48.5-13.5T700-380q-38 0-73 9t-67 27Zm0-110v-68q33-14 67.5-21t72.5-7q26 0 51 4t49 10v64q-24-9-48.5-13.5T700-490q-38 0-73 9.5T560-454ZM260-320q47 0 91.5 10.5T440-278v-394q-41-24-87-36t-93-12q-36 0-71.5 7T120-692v396q35-12 69.5-18t70.5-6Zm260 42q44-21 88.5-31.5T700-320q36 0 70.5 6t69.5 18v-396q-33-14-68.5-21t-71.5-7q-47 0-93 12t-87 36v394Zm-40 118q-48-38-104-59t-116-21q-42 0-82.5 11T100-198q-21 11-40.5-1T40-234v-482q0-11 5.5-21T62-752q46-24 96-36t102-12q58 0 113.5 15T480-740q51-30 106.5-45T700-800q52 0 102 12t96 36q11 5 16.5 15t5.5 21v482q0 23-19.5 35t-40.5 1q-37-20-77.5-31T700-240q-60 0-116 21t-104 59ZM280-494Z"/></svg>                    <span>Logbook</span>
                </a>
            </li>
            <li>
                <a href="escort.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="M680-360q-42 0-71-29t-29-71q0-42 29-71t71-29q42 0 71 29t29 71q0 42-29 71t-71 29ZM480-160v-56q0-24 12.5-44.5T528-290q36-15 74.5-22.5T680-320q39 0 77.5 7.5T832-290q23 9 35.5 29.5T880-216v56H480Zm-80-320q-66 0-113-47t-47-113q0-66 47-113t113-47q66 0 113 47t47 113q0 66-47 113t-113 47Zm0-160ZM80-160v-112q0-34 17-62.5t47-43.5q60-30 124.5-46T400-440q35 0 70 6t70 14l-34 34-34 34q-18-5-36-6.5t-36-1.5q-58 0-113.5 14T180-306q-10 5-15 14t-5 20v32h240v80H80Zm320-80Zm0-320q33 0 56.5-23.5T480-640q0-33-23.5-56.5T400-720q-33 0-56.5 23.5T320-640q0 33 23.5 56.5T400-560Z"/></svg>
                    <span>Escort</span>
                </a>
            </li>
            <li>
                <a href="archive.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m480-240 160-160-56-56-64 64v-168h-80v168l-64-64-56 56 160 160ZM200-640v440h560v-440H200Zm0 520q-33 0-56.5-23.5T120-200v-499q0-14 4.5-27t13.5-24l50-61q11-14 27.5-21.5T250-840h460q18 0 34.5 7.5T772-811l50 61q9 11 13.5 24t4.5 27v499q0 33-23.5 56.5T760-120H200Zm16-600h528l-34-40H250l-34 40Zm264 300Z"/></svg>
                    <span>Archive</span>
                </a>
            </li>
            <li>
                <a href="logout.php">
                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#e3e3e3"><path d="m480-240 160-160-56-56-64 64v-168h-80v168l-64-64-56 56 160 160ZM200-640v440h560v-440H200Zm0 520q-33 0-56.5-23.5T120-200v-499q0-14 4.5-27t13.5-24l50-61q11-14 27.5-21.5T250-840h460q18 0 34.5 7.5T772-811l50 61q9 11 13.5 24t4.5 27v499q0 33-23.5 56.5T760-120H200Zm16-600h528l-34-40H250l-34 40Zm264 300Z"/></svg>

                    <span>Logout</span>
                </a>
            </li>
        </ul>
    </nav>
    <main>
    <div id="main-content">
        <h1 class="header">VisiTrack</h1>
        <div class="search-sort-container">
            <form method="GET" action="dashboard.php" class="search-form">
                <input type="text" name="search" placeholder="Search visitors..." value="<?php echo htmlspecialchars($search); ?>">
                <button type="submit">
                    <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#5f6368"><path d="M784-120 532-372q-30 24-69 38t-83 14q-109 0-184.5-75.5T120-580q0-109 75.5-184.5T380-840q109 0 184.5 75.5T640-580q0 44-14 83t-38 69l252 252-56 56ZM380-400q75 0 127.5-52.5T560-580q0-75-52.5-127.5T380-760q-75 0-127.5 52.5T200-580q0 75 52.5 127.5T380-400Z"/></svg>
                </button>
            </form>
            <a href="logbook.php" class="register-btn">Register</a>
            <form method="post" action="export.php">
                    <button type="submit" name="export" class="export-btn">EXPORT ALL</button>
            </form>
        </div>
        <div class="table-wrapper">
            <div class="table-container">
                <table>
                    <thead>
                        <tr>
                            <th>Last Name</th>
                            <th>First Name</th>
                            <th>Middle Initial</th>
                            <th>Suffix</th>
                            <th>Email</th>
                            <th>Purpose</th>
                            <th>Zip Code</th>
                            <th>Municipality</th>
                            <th>Barangay</th>
                            <th>Type</th>
                            <th>Time</th>
                            <th>Date</th>
                        </tr>
                    </thead>   
                    <tbody>
                        <?php while ($row = mysqli_fetch_array($result)) { ?>
                            <tr>
                                <td><?php echo htmlspecialchars($row['Lastname']); ?></td>
                                <td><?php echo htmlspecialchars($row['Firstname']); ?></td>
                                <td><?php echo htmlspecialchars($row['Middle_Initial']); ?></td>
                                <td><?php echo htmlspecialchars($row['Suffix']); ?></td>
                                <td><?php echo htmlspecialchars($row['Email']); ?></td>
                                <td><?php echo htmlspecialchars($row['purpose']); ?></td>
                                <td><?php echo htmlspecialchars($row['ZIP_Code']); ?></td>
                                <td><?php echo htmlspecialchars($row['Municipality']); ?></td>
                                <td><?php echo htmlspecialchars($row['Barangay_Village']); ?></td>
                                <td><?php echo htmlspecialchars($row['visitor_type']); ?></td>
                                <td><?php echo date("g:i A", strtotime($row['visit_time'])); ?></td>
                                <td><?php echo htmlspecialchars($row['visit_date']); ?></td>
                            </tr>
                        <?php } ?>
                    </tbody>
                </table>
            </div>
        </div>
        
        <!-- Pagination -->
        <div class="pagination">
            <?php if ($page > 1): ?>
                <a href="?page=1&sort=<?= $sort ?>&order=<?= $order ?>&search=<?= urlencode($search) ?>">First</a>
                <a href="?page=<?= $page - 1 ?>&sort=<?= $sort ?>&order=<?= $order ?>&search=<?= urlencode($search) ?>">Prev</a>
            <?php else: ?>
                <span class="disabled">First</span>
                <span class="disabled">Prev</span>
            <?php endif; ?>
            
            <?php 
            // Show page numbers
            $start_page = max(1, $page - 2);
            $end_page = min($total_pages, $page + 2);
            
            if ($start_page > 1) {
                echo '<span>...</span>';
            }
            
            for ($i = $start_page; $i <= $end_page; $i++): ?>
                <a href="?page=<?= $i ?>&sort=<?= $sort ?>&order=<?= $order ?>&search=<?= urlencode($search) ?>" <?= ($i == $page) ? 'class="active"' : '' ?>><?= $i ?></a>
            <?php endfor; ?>
            
            <?php if ($end_page < $total_pages) {
                echo '<span>...</span>';
            }
            ?>
            
            <?php if ($page < $total_pages): ?>
                <a href="?page=<?= $page + 1 ?>&sort=<?= $sort ?>&order=<?= $order ?>&search=<?= urlencode($search) ?>">Next</a>
                <a href="?page=<?= $total_pages ?>&sort=<?= $sort ?>&order=<?= $order ?>&search=<?= urlencode($search) ?>">Last</a>
            <?php else: ?>
                <span class="disabled">Next</span>
                <span class="disabled">Last</span>
            <?php endif; ?>
        </div>
    </div>
</main>
    <script src="scriptss.js"></script>
</body>
</html>
