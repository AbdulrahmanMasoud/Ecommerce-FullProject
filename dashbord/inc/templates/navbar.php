

<nav class="navbar navbar-expand-lg navbar-light bg-light">
<div class="container">
  <a class="navbar-brand" href="index.php">ASM</a>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>

  <div class="collapse navbar-collapse" id="navbarSupportedContent">
    <ul class="navbar-nav mr-auto">
      <li class="nav-item">
        <a class="nav-link" href="category.php">Category</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="items.php">Items</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="members.php">Members</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="comments.php">Comments</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Statestc</a>
      </li>
      <li class="nav-item">
        <a class="nav-link" href="#">Logs</a>
      </li>
      <li class="nav-item dropdown position-absolute">
        <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
          Abdulrahman
        </a>
        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
        <a class="dropdown-item" href="../index.php">Visit Site</a>
          <a class="dropdown-item" href="members.php?page=Edit&id=<?php echo $_SESSION['id']; ?>">Edit Profile</a>
          <a class="dropdown-item" href="#">Setings</a>
          <a class="dropdown-item" href="logout.php">Logout</a>
          
        </div>
      </li>
      
    </ul>
   
  </div>
  </div>
</nav>
