  <?php
  if (session_status() === PHP_SESSION_NONE) {
    session_start();
  }
  $userName = $_SESSION['name'] ?? '';
  $userInitial = $userName ? strtoupper(substr($userName,0,1)) : 'U';
  ?>

    <div class="header_content">
          <div class="header-logo"><a href="/HRS/Html/index.php"><img src="/HRS/images/logo.png" alt="logo"></a>
          </div>
          <h2>HR-System</h2>

          <div class="header-actions">
            <?php if (!empty($userName)): ?>
              <div class="user-menu" id="userMenu">
                <button class="user-avatar" id="userAvatar" aria-expanded="false">
                  <span class="avatar-initial"><?php echo htmlspecialchars($userInitial); ?></span>
                </button>
                <div class="user-dropdown" id="userDropdown" aria-hidden="true">
                  <div class="user-info">Hello, <?php echo htmlspecialchars($userName); ?></div>
                  <a href="/HRS/components/Employee-profile.php">Profile</a>
                  <a href="/HRS/components/settings.php">Settings</a>
                  <a href="/HRS/components/logout.php">Logout</a>
                </div>
              </div>
            <?php endif; ?>
          </div>
        </div>

    <script>
      (function(){
        const avatar = document.getElementById('userAvatar');
        const dropdown = document.getElementById('userDropdown');
        if (!avatar || !dropdown) return;
        avatar.addEventListener('click', function(e){
          const expanded = avatar.getAttribute('aria-expanded') === 'true';
          avatar.setAttribute('aria-expanded', String(!expanded));
          dropdown.style.display = expanded ? 'none' : 'block';
          dropdown.setAttribute('aria-hidden', String(expanded));
        });
        document.addEventListener('click', function(e){
          if (!document.getElementById('userMenu').contains(e.target)){
            avatar.setAttribute('aria-expanded', 'false');
            dropdown.style.display = 'none';
            dropdown.setAttribute('aria-hidden', 'true');
          }
        });
      })();
    </script>