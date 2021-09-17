<nav class="col-md-2 d-none d-md-block bg-light sidebar">
      <div class="sidebar-sticky">
        <ul class="nav flex-column">

          <?php 


            $uri = $_SERVER['REQUEST_URI']; 
            $uriAr = explode("/", $uri);
            $page = end($uriAr);

          ?>

               <!-- Pour jengu store -->
               <li class="nav-item">
            <a style="color:#007bff;" class="nav-link <?php echo ($page == 'index.php') ? 'active' : ''; ?>">
              ---------BOUTIQUE----------
            </a>
          </li>

          <li class="nav-item">
            <a class="nav-link <?php echo ($page == '' || $page == 'index.php') ? 'active' : ''; ?>" href="index.php">
              <span data-feather="home"></span>
              Tableau de bord <span class="sr-only">(current)</span>
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'customer_orders.php') ? 'active' : ''; ?>" href="customer_orders.php">
              <span data-feather="file"></span>
              Commandes
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'products.php') ? 'active' : ''; ?>" href="products.php">
              <span data-feather="shopping-cart"></span>
              Produits
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'brands.php') ? 'active' : ''; ?>" href="brands.php">
              <span data-feather="shopping-cart"></span>
              Marques
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'categories.php') ? 'active' : ''; ?>" href="categories.php">
              <span data-feather="shopping-cart"></span>
              Categories
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'customers.php') ? 'active' : ''; ?>" href="customers.php">
              <span data-feather="users"></span>
              Clients
            </a>
          </li>

            <!-- Pour Jengu Communication -->
          <hr>
          <li class="nav-item">
            <a style="color:#007bff;" class="nav-link <?php echo ($page == 'products-info.php') ? 'active' : ''; ?>">
              ---------FREELANCE----------
            </a>
          </li>
              
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'products-info.php') ? 'active' : ''; ?>" href="products-info.php">
              <span data-feather="users"></span>
              Réalisations
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'categorie-info.php') ? 'active' : ''; ?>" href="categorie-info.php">
              <span data-feather="users"></span>
              Categories 
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'brands-info.php') ? 'active' : ''; ?>" href="brands-info.php">
              <span data-feather="users"></span>
              Types
            </a>
          </li>
          <li class="nav-item">
            <a class="nav-link <?php echo ($page == 'freelance.php') ? 'active' : ''; ?>" href="freelance.php">
              <span data-feather="plus"></span>
              Ajout de Freelance
            </a>
          </li>
                
    
        </ul>
       
      </div>
    </nav>

    


    <main role="main" class="col-md-9 ml-sm-auto col-lg-10 px-4">
      <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pt-3 pb-2 mb-3 border-bottom">
        <h1 class="h2">Hello <?php echo $_SESSION["admin_name"]; ?></h1>
        <div class="btn-toolbar mb-2 mb-md-0">
          <div class="btn-group mr-2">
            <button type="button" class="btn btn-sm btn-outline-secondary">Share</button>
            <button type="button" class="btn btn-sm btn-outline-secondary">Export</button>
          </div>
          <button type="button" class="btn btn-sm btn-outline-secondary dropdown-toggle">
            <span data-feather="calendar"></span>
            Cette semaine
          </button>
        </div>
      </div>