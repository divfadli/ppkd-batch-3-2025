<?php
// Ambil ID user dari session
$id = $_SESSION['ID_USER'] ?? null;

// Ambil data profil "about"
$about = null;
if ($id) {
    $stmt = $koneksi->prepare("SELECT * FROM abouts WHERE created_by = ?");
    $stmt->bind_param("i", $id);
    $stmt->execute();
    $about = $stmt->get_result()->fetch_assoc();
    $stmt->close();
}

// Ambil 3 pesan terbaru
$stmt = $koneksi->prepare("SELECT * FROM messages ORDER BY created_at DESC LIMIT 3");
$stmt->execute();
$qMessages = $stmt->get_result();
$count_messages = $qMessages->num_rows;
$stmt->close();
?>

<header id="header" class="header fixed-top d-flex align-items-center bg-white shadow-sm">
  <div class="d-flex align-items-center justify-content-between px-3">
    <a href="dashboard" class="logo d-flex align-items-center text-decoration-none">
      <i class="bi bi-grid text-primary fs-4 me-2"></i>
      <span class="fw-bold text-dark d-none d-lg-block">NiceAdmin</span>
    </a>
    <i class="bi bi-list toggle-sidebar-btn fs-4"></i>
  </div>

  <nav class="header-nav ms-auto pe-3">
    <ul class="d-flex align-items-center mb-0">

      <!-- Messages -->
      <li class="nav-item dropdown me-3">
        <a class="nav-link nav-icon position-relative" href="#" data-bs-toggle="dropdown">
          <i class="bi bi-chat-dots fs-5"></i>
          <?php if ($count_messages > 0): ?>
            <span class="badge bg-success badge-number"><?= $count_messages ?></span>
          <?php endif; ?>
        </a>

        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow shadow-lg messages" style="max-height: 420px; overflow-y: auto; width: 320px;">
          <li class="dropdown-header fw-semibold d-flex justify-content-between align-items-center px-3 py-2 bg-light border-bottom">
            <span>You have <?= $count_messages ?> new messages</span>
            <a href="?page=messages" class="small text-decoration-none text-primary fw-semibold">View all</a>
          </li>

          <?php while ($msg = $qMessages->fetch_assoc()): ?>
            <li class="message-item px-3 py-3 hover-bg-light">
              <a href="?page=messages&id=<?= (int) $msg['id'] ?>" class="d-flex align-items-start text-decoration-none text-dark">
                <!-- Avatar -->
                <div class="flex-shrink-0 me-3">
                  <div class="rounded-circle bg-secondary d-flex justify-content-center align-items-center text-white" style="width:40px; height:40px;">
                    <i class="bi bi-person fs-5"></i>
                  </div>
                </div>

                <!-- Message preview -->
                <div class="flex-grow-1">
                  <div class="d-flex justify-content-between align-items-center mb-1">
                    <h6 class="mb-0 fw-semibold text-dark"><?= htmlspecialchars($msg['name']) ?></h6>
                    <small class="text-muted"><?= date("d M H:i", strtotime($msg['created_at'])) ?></small>
                  </div>
                  <p class="mb-0 small text-muted"><?= htmlspecialchars(mb_strimwidth($msg['message'], 0, 45, "...")) ?></p>
                </div>
              </a>
            </li>
            <li><hr class="dropdown-divider my-0"></li>
          <?php endwhile; ?>

          <li class="dropdown-footer text-center py-2">
            <a href="?page=messages" class="text-decoration-none fw-semibold text-primary">Show all messages</a>
          </li>
        </ul>
      </li>

      <!-- Profile -->
      <li class="nav-item dropdown">
        <a class="nav-link nav-profile d-flex align-items-center pe-0" href="#" data-bs-toggle="dropdown">
          <img src="uploads/<?= htmlspecialchars($about['image'] ?? 'default.png') ?>" 
               alt="Profile" class="rounded-circle me-2 profile-img" style="width:35px; height:35px; object-fit:cover;">
          <span class="d-none d-md-block dropdown-toggle fw-semibold"><?= htmlspecialchars($_SESSION['NAME'] ?? '') ?></span>
        </a>
        <ul class="dropdown-menu dropdown-menu-end dropdown-menu-arrow shadow-lg profile">
          <li class="dropdown-header text-center bg-light py-3">
            <h6 class="fw-bold mb-0"><?= htmlspecialchars($_SESSION['NAME'] ?? '') ?></h6>
            <small class="text-muted">Web Designer</small>
          </li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item d-flex align-items-center" href="?page=tambah-user&edit=<?= (int) $id ?>"><i class="bi bi-person me-2 text-primary"></i>My Profile</a></li>
          <li><a class="dropdown-item d-flex align-items-center" href="?page=setting"><i class="bi bi-gear me-2 text-warning"></i>Account Settings</a></li>
          <li><a class="dropdown-item d-flex align-items-center" href="?page=faq"><i class="bi bi-question-circle me-2 text-success"></i>Need Help?</a></li>
          <li><hr class="dropdown-divider"></li>
          <li><a class="dropdown-item d-flex align-items-center text-danger fw-semibold" href="keluar.php"><i class="bi bi-box-arrow-right me-2"></i>Sign Out</a></li>
        </ul>
      </li>

    </ul>
  </nav>
</header>

<style>
/* Hover effect untuk pesan */
.message-item:hover {
  background-color: #f8f9fa;
  border-radius: 8px;
  transition: all 0.2s ease;
}
</style>
