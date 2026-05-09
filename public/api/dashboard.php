<?php
header('Content-Type: application/json');
header('Access-Control-Allow-Origin: *');

// Simple caching mechanism
$cache = [];
$cache_time = 300; // 5 minutes cache

function getCachedData($key) {
    global $cache, $cache_time;
    if (isset($cache[$key]) && (time() - $cache[$key]['time']) < $cache_time) {
        return $cache[$key]['data'];
    }
    return null;
}

function setCachedData($key, $data) {
    global $cache;
    $cache[$key] = ['data' => $data, 'time' => time()];
    return $data;
}

// Get the action parameter
$action = $_GET['action'] ?? '';

// Optimized data generation with caching

// Optimized data generation functions
function getStatsData() {
    return getCachedData('stats') ?: setCachedData('stats', [
        'total_users' => rand(150, 300),
        'active_users' => rand(50, 100),
        'total_books' => rand(500, 1000),
        'total_categories' => rand(10, 25),
        'total_downloads' => rand(1000, 5000),
        'avg_rating' => number_format(rand(35, 45) / 10, 1),
        'active_loans' => rand(25, 75),
        'total_loans_today' => rand(5, 20),
        'overdue_books' => rand(3, 15),
        'overdue_fines' => rand(50000, 200000),
        'pending_reservations' => rand(5, 20),
        'approved_reservations' => rand(10, 30),
        'monthly_fines' => rand(100000, 500000),
        'yearly_fines' => rand(1000000, 3000000),
        'low_stock_books' => rand(5, 20),
        'total_inventory' => rand(800, 1500)
    ]);
}

function getLatestBooks($limit = 5) {
    $key = "latest_books_{$limit}";
    $cached = getCachedData($key);
    if ($cached !== null) {
        return $cached;
    }

    $data = array_map(function($i) {
        $titles = ['Harry Potter', 'Lord of the Rings', 'The Great Gatsby', 'To Kill a Mockingbird', '1984'];
        $authors = ['J.K. Rowling', 'J.R.R. Tolkien', 'F. Scott Fitzgerald', 'Harper Lee', 'George Orwell'];
        $categories = ['Fiction', 'Fantasy', 'Classic', 'Drama', 'Science Fiction'];
        return [
            'id' => $i,
            'title' => $titles[array_rand($titles)],
            'author' => $authors[array_rand($authors)],
            'category_name' => $categories[array_rand($categories)],
            'rating' => rand(30, 50) / 10,
            'download_count' => rand(10, 100)
        ];
    }, range(1, $limit));

    return setCachedData($key, $data);
}

function getLatestUsers($limit = 5) {
    $key = "latest_users_{$limit}";
    $cached = getCachedData($key);
    if ($cached !== null) {
        return $cached;
    }

    $data = array_map(function($i) {
        $names = ['Ahmad', 'Budi', 'Citra', 'Dewi', 'Eko', 'Fani', 'Gilang'];
        $emails = ['ahmad@example.com', 'budi@example.com', 'citra@example.com', 'dewi@example.com', 'eko@example.com'];
        return [
            'id' => $i,
            'name' => $names[array_rand($names)],
            'email' => $emails[array_rand($emails)],
            'status' => rand(0, 1) ? 'active' : 'inactive',
            'role' => rand(0, 1) ? 'user' : 'admin',
            'username' => 'user' . $i
        ];
    }, range(1, $limit));

    return setCachedData($key, $data);
}

// Handle different actions
switch ($action) {
    case 'stats':
        echo json_encode(['success' => true, 'data' => getStatsData()]);
        break;
    case 'latest_books':
        $limit = (int)($_GET['limit'] ?? 5);
        echo json_encode(['success' => true, 'data' => getLatestBooks($limit)]);
        break;
    case 'latest_users':
        $limit = (int)($_GET['limit'] ?? 5);
        echo json_encode(['success' => true, 'data' => getLatestUsers($limit)]);
        break;
    case 'categories':
        $key = 'categories';
        $data = getCachedData($key) ?: setCachedData($key, array_map(function($i) {
            $names = ['Fiction', 'Non-Fiction', 'Science', 'History', 'Biography', 'Children'];
            $icons = ['fas fa-book', 'fas fa-atom', 'fas fa-microscope', 'fas fa-landmark', 'fas fa-user', 'fas fa-child'];
            return [
                'id' => $i,
                'name' => $names[$i-1] ?? 'Category ' . $i,
                'icon' => $icons[$i-1] ?? 'fas fa-tag',
                'book_count' => rand(20, 100)
            ];
        }, range(1, 6)));
        echo json_encode(['success' => true, 'data' => $data]);
        break;
    case 'popular_books':
        $limit = (int)($_GET['limit'] ?? 5);
        $key = "popular_books_{$limit}";
        $data = getCachedData($key) ?: setCachedData($key, array_map(function($i) {
            $titles = ['Book A', 'Book B', 'Book C', 'Book D', 'Book E'];
            return [
                'id' => $i,
                'title' => $titles[$i-1],
                'download_count' => rand(50, 200)
            ];
        }, range(1, $limit)));
        echo json_encode(['success' => true, 'data' => $data]);
        break;
    case 'reading_trends':
        $months = (int)($_GET['months'] ?? 6);
        $key = "reading_trends_{$months}";
        $data = getCachedData($key) ?: setCachedData($key, array_map(function($i) {
            return [
                'month' => date('Y-m-d', strtotime("-$i months")),
                'loan_count' => rand(20, 80)
            ];
        }, range(0, $months-1)));
        echo json_encode(['success' => true, 'data' => $data]);
        break;
    case 'genre_trends':
        $limit = (int)($_GET['limit'] ?? 6);
        $key = "genre_trends_{$limit}";
        $data = getCachedData($key) ?: setCachedData($key, array_map(function($i) {
            $genres = ['Fiction', 'Non-Fiction', 'Science', 'History', 'Biography'];
            return [
                'category_name' => $genres[$i] ?? 'Genre ' . $i,
                'loan_count' => rand(10, 60)
            ];
        }, range(0, $limit-1)));
        echo json_encode(['success' => true, 'data' => $data]);
        break;
    case 'user_engagement':
        $key = 'user_engagement';
        $data = getCachedData($key) ?: setCachedData($key, [
            'active_this_week' => rand(30, 80),
            'active_this_month' => rand(80, 150),
            'inactive' => rand(50, 100)
        ]);
        echo json_encode(['success' => true, 'data' => $data]);
        break;
    case 'active_loans':
        $limit = (int)($_GET['limit'] ?? 10);
        $key = "active_loans_{$limit}";
        $data = getCachedData($key) ?: setCachedData($key, array_map(function($i) {
            $books = ['Book A', 'Book B', 'Book C', 'Book D', 'Book E'];
            $users = ['Ahmad', 'Budi', 'Citra', 'Dewi', 'Eko'];
            return [
                'id' => $i,
                'book_title' => $books[array_rand($books)],
                'user_name' => $users[array_rand($users)],
                'due_date' => date('Y-m-d', strtotime('+'.rand(1, 14).' days'))
            ];
        }, range(1, $limit)));
        echo json_encode(['success' => true, 'data' => $data]);
        break;
    case 'overdue_books':
        $limit = (int)($_GET['limit'] ?? 10);
        $key = "overdue_books_{$limit}";
        $data = getCachedData($key) ?: setCachedData($key, array_map(function($i) {
            $books = ['Book A', 'Book B', 'Book C'];
            $users = ['Ahmad', 'Budi', 'Citra'];
            return [
                'id' => $i,
                'book_title' => $books[array_rand($books)],
                'user_name' => $users[array_rand($users)],
                'days_overdue' => rand(1, 30),
                'fine_amount' => rand(1000, 10000)
            ];
        }, range(1, $limit)));
        echo json_encode(['success' => true, 'data' => $data]);
        break;
    case 'pending_reservations':
        $limit = (int)($_GET['limit'] ?? 10);
        $key = "pending_reservations_{$limit}";
        $data = getCachedData($key) ?: setCachedData($key, array_map(function($i) {
            $books = ['Book A', 'Book B', 'Book C'];
            $users = ['Ahmad', 'Budi', 'Citra'];
            return [
                'id' => $i,
                'book_title' => $books[array_rand($books)],
                'user_name' => $users[array_rand($users)],
                'request_date' => date('Y-m-d', strtotime('-'.rand(1, 7).' days'))
            ];
        }, range(1, $limit)));
        echo json_encode(['success' => true, 'data' => $data]);
        break;
    case 'circulation_table':
        $page = (int)($_GET['page'] ?? 1);
        $limit = (int)($_GET['limit'] ?? 15);
        $total = 50;
        $key = "circulation_table_{$page}_{$limit}";
        $data = getCachedData($key) ?: setCachedData($key, array_map(function($i) {
            $books = ['Harry Potter', 'Lord of the Rings', 'The Great Gatsby', '1984', 'Pride and Prejudice'];
            $users = ['Ahmad', 'Budi', 'Citra', 'Dewi', 'Eko'];
            $statuses = ['active', 'returned', 'overdue'];
            $status = $statuses[array_rand($statuses)];
            return [
                'id' => $i,
                'user_name' => $users[array_rand($users)],
                'book_title' => $books[array_rand($books)],
                'loan_date' => date('Y-m-d', strtotime('-'.rand(1, 30).' days')),
                'return_date' => $status === 'returned' ? date('Y-m-d', strtotime('-'.rand(1, 10).' days')) : null,
                'status' => $status,
                'fine_amount' => $status === 'overdue' ? rand(5000, 50000) : 0
            ];
        }, range((($page-1)*$limit)+1, min($page*$limit, $total))));
        echo json_encode(['success' => true, 'data' => $data, 'total' => $total, 'limit' => $limit]);
        break;
    case 'books_table':
        $page = (int)($_GET['page'] ?? 1);
        $limit = (int)($_GET['limit'] ?? 10);
        $total = 100;
        $key = "books_table_{$page}_{$limit}";
        $data = getCachedData($key) ?: setCachedData($key, array_map(function($i) {
            $titles = ['Harry Potter', 'Lord of the Rings', 'The Great Gatsby', '1984', 'Pride and Prejudice'];
            $authors = ['J.K. Rowling', 'J.R.R. Tolkien', 'F. Scott Fitzgerald', 'George Orwell', 'Jane Austen'];
            $publishers = ['Bloomsbury', 'HarperCollins', 'Scribner', 'Secker & Warburg', 'T. Egerton'];
            $categories = ['Fiction', 'Fantasy', 'Classic', 'Science Fiction', 'Romance'];
            return [
                'id' => $i,
                'title' => $titles[array_rand($titles)],
                'author' => $authors[array_rand($authors)],
                'publisher' => $publishers[array_rand($publishers)],
                'category_name' => $categories[array_rand($categories)],
                'rating' => rand(30, 50) / 10,
                'download_count' => rand(10, 500)
            ];
        }, range((($page-1)*$limit)+1, min($page*$limit, $total))));
        echo json_encode(['success' => true, 'data' => $data, 'total' => $total, 'limit' => $limit]);
        break;
    case 'users_table':
        $page = (int)($_GET['page'] ?? 1);
        $limit = (int)($_GET['limit'] ?? 10);
        $total = 80;
        $key = "users_table_{$page}_{$limit}";
        $data = getCachedData($key) ?: setCachedData($key, array_map(function($i) {
            $names = ['Ahmad Santoso', 'Budi Setiawan', 'Citra Dewi', 'Dewi Lestari', 'Eko Prasetyo'];
            $emails = ['ahmad@example.com', 'budi@example.com', 'citra@example.com', 'dewi@example.com', 'eko@example.com'];
            return [
                'id' => $i,
                'name' => $names[array_rand($names)],
                'email' => $emails[array_rand($emails)],
                'username' => 'user' . $i,
                'role' => rand(0, 1) ? 'user' : 'admin',
                'status' => rand(0, 1) ? 'active' : 'inactive'
            ];
        }, range((($page-1)*$limit)+1, min($page*$limit, $total))));
        echo json_encode(['success' => true, 'data' => $data, 'total' => $total, 'limit' => $limit]);
        break;
    case 'upcoming_events':
        $limit = (int)($_GET['limit'] ?? 5);
        $key = "upcoming_events_{$limit}";
        $data = getCachedData($key) ?: setCachedData($key, array_map(function($i) {
            $events = ['Workshop Literasi', 'Diskusi Buku', 'Pelatihan', 'Pameran Buku'];
            $descriptions = ['Workshop menarik', 'Diskusi interaktif', 'Pelatihan khusus', 'Pameran spesial'];
            return [
                'id' => $i,
                'title' => $events[array_rand($events)],
                'description' => $descriptions[array_rand($descriptions)],
                'event_date' => date('Y-m-d', strtotime('+'.rand(1, 30).' days'))
            ];
        }, range(1, $limit)));
        echo json_encode(['success' => true, 'data' => $data]);
        break;
    case 'announcements':
        $limit = (int)($_GET['limit'] ?? 5);
        $key = "announcements_{$limit}";
        $data = getCachedData($key) ?: setCachedData($key, array_map(function($i) {
            $titles = ['Pemberitahuan Penting', 'Update Sistem', 'Event Baru', 'Perubahan Jadwal'];
            $contents = ['Ada pemberitahuan penting untuk semua pengguna', 'Sistem telah diperbarui', 'Event baru akan segera dilaksanakan', 'Jadwal berubah'];
            return [
                'id' => $i,
                'title' => $titles[array_rand($titles)],
                'content' => $contents[array_rand($contents)],
                'created_at' => date('Y-m-d H:i:s', strtotime('-'.rand(1, 30).' days'))
            ];
        }, range(1, $limit)));
        echo json_encode(['success' => true, 'data' => $data]);
        break;
    case 'notifications':
        $key = 'notifications';
        $data = getCachedData($key) ?: setCachedData($key, array_map(function($i) {
            $types = ['overdue', 'low_stock', 'maintenance', 'reservation'];
            $titles = ['Buku Terlambat', 'Stok Rendah', 'Maintenance', 'Reservasi Baru'];
            $messages = ['Ada buku yang terlambat dikembalikan', 'Stok buku hampir habis', 'Maintenance sistem', 'Ada reservasi baru'];
            $type = $types[array_rand($types)];
            return [
                'id' => $i,
                'type' => $type,
                'title' => $titles[array_rand($titles)],
                'message' => $messages[array_rand($messages)],
                'action_url' => $type === 'overdue' ? '#circulation' : ($type === 'reservation' ? '#circulation' : null)
            ];
        }, range(1, 4)));
        echo json_encode(['success' => true, 'data' => $data]);
        break;
    default:
        echo json_encode(['success' => false, 'error' => 'Invalid action']);
        break;
}
?>
