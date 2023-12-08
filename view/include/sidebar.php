  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <div class="dropdown">
   	<a href="index.php" class="brand-link">
        <?php if($_SESSION['login_type'] == 1): ?>
        <h3 class="text-center p-0 m-0"><b>ADMIN</b></h3>
        <?php elseif($_SESSION['login_type'] == 2): ?>
          <h3 class="text-center p-0 m-0"><b>PROJECT MANAGER</b></h3>
       <?php else: ?>
        <h3 class="text-center p-0 m-0"><b>USER</b></h3>
        <?php endif; ?>

    </a>
      
    </div>
    <div class="sidebar pb-4 mb-4">
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column nav-flat" data-widget="treeview" role="menu" data-accordion="false">
          <li class="nav-item dropdown">
            <a href="index.php" class="nav-link nav-home">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
          </li>  
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_project nav-view_project">
              <i class="nav-icon fas fa-layer-group"></i>
              <p>
                Projects
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
            <?php if($_SESSION['login_type'] != 3): ?>
              <li class="nav-item">
                <a href="./index.php?page=new_project" class="nav-link nav-new_project tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
            <?php endif; ?>
              <li class="nav-item">
                <a href="./index.php?page=project_list" class="nav-link nav-project_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li> 
          <li class="nav-item">
                <a href="./index.php?page=task_list" class="nav-link nav-task_list">
                  <i class="fas fa-tasks nav-icon"></i>
                  <p>Task</p>
                </a>
          </li>
          <?php if($_SESSION['login_type'] == 1): ?>
          <li class="nav-item">
            <a href="#" class="nav-link nav-edit_user">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Users
                <i class="right fas fa-angle-left"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">
              <li class="nav-item">
                <a href="./index.php?page=new_user" class="nav-link nav-new_user tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>Add New</p>
                </a>
              </li>
              <li class="nav-item">
                <a href="./index.php?page=user_list" class="nav-link nav-user_list tree-item">
                  <i class="fas fa-angle-right nav-icon"></i>
                  <p>List</p>
                </a>
              </li>
            </ul>
          </li>
        <?php endif; ?>
        </ul>
      </nav>
    </div>
  </aside>
  <script>
  /**
   * Function to set the active state for the navigation link based on the current page and query parameters.
   */
  $(document).ready(function () {
      // Get the page and s (query parameter) values from PHP variables
      var page = '<?php echo isset($_GET['page']) ? $_GET['page'] : 'home' ?>';
      var s = '<?php echo isset($_GET['s']) ? $_GET['s'] : '' ?>';

      // Concatenate s to page if it is not empty
      if (s != '')
          page = page + '_' + s;

      // Check if a navigation link with the specified class exists
      if ($('.nav-link.nav-' + page).length > 0) {
          // Add the 'active' class to the found navigation link
          $('.nav-link.nav-' + page).addClass('active');

          // Check if the navigation link is a tree item
          if ($('.nav-link.nav-' + page).hasClass('tree-item') == true) {
              // Add the 'active' class to the closest parent with the class 'nav-treeview'
              $('.nav-link.nav-' + page).closest('.nav-treeview').siblings('a').addClass('active');

              // Add the 'menu-open' class to the closest parent with the class 'nav-treeview'
              $('.nav-link.nav-' + page).closest('.nav-treeview').parent().addClass('menu-open');
          }

          // Check if the navigation link has the class 'nav-is-tree'
          if ($('.nav-link.nav-' + page).hasClass('nav-is-tree') == true) {
              // Add the 'menu-open' class to the parent of the navigation link
              $('.nav-link.nav-' + page).parent().addClass('menu-open');
          }
      }
  });

  </script>