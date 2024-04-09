<nav class="navbar navbar-expand-lg bg-body-tertiary fixed-top" data-bs-theme="dark">
  <div class="container-fluid mx-3">
    <a class="navbar-brand" href="#">CyberInsecurity Bank</a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ms-auto ">
        <li class="nav-item">
          <a class="nav-link active" aria-current="page" href="/">Home</a>
        </li>
        <?php if(isset($_SESSION['user'])): ?>
          <li class="nav-item">
          <a class="nav-link active" href="">Benvenuto <?= $_SESSION['user']['email'] ?></a>
          </li>
          <li class="nav-item">
          <a class="nav-link active" href="/profile">Profilo</a>
          </li>
        <form method="POST" action="/logout">
        <input type="hidden" name="csrf_token" value="<?php echo csrfToken(); ?>">
          <button class="nav-link active">Logout</button>
        </form>
        <?php else: ?>
        <li class="nav-item">
          <a class="nav-link active" href="/login">Login</a>
        </li>
        <?php endif ?>
      </ul>
    </div>
  </div>
</nav>