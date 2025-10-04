<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Minishop Admin Dashboard</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;600;700&display=swap" rel="stylesheet">
  <style>
    * { margin: 0; padding: 0; box-sizing: border-box; font-family: 'Inter', sans-serif; }
    :root {
      --sidebar-width: 200px; --header-height: 60px;
    }
    body { background: #f0f4f8; color: #333; }

    /* Header */
    .header {
      position: fixed; top: 0; left: 0; right: 0; height: var(--header-height);
      display: flex; justify-content: space-between; align-items: center; padding: 0 20px;
      background: #161D31; color: #fff; z-index: 1000;
    }
    .logo img { height: 40px; width: auto; border-radius: 2px; background: #fff; padding: 4px; }
    .user-area { display: flex; align-items: center; }
    .user-info { margin-right: 15px; text-align: right; }
    .user-name { font-weight: 500; font-size: 0.9rem; color: #fff; }
    .user-role { font-size: 0.8rem; color: rgba(255,255,255,0.8); }
    .user-img { width: 35px; height: 35px; border-radius: 50%; background: #fff;
      display: flex; align-items: center; justify-content: center; color: #283046; font-weight: bold; }

    /* Sidebar */
    .sidebar { position: fixed; top: var(--header-height); left: 0; width: var(--sidebar-width);
      height: calc(100vh - var(--header-height)); background: #283046; color: #fff;
      
      overflow-y: auto; transition: all .3s; z-index: 900; }
    .sidebar-menu { padding: 20px 0; }
    .menu-title { padding: 10px 20px; font-size: .7rem; color: rgba(255,255,255,.7); text-transform: uppercase; }
    .menu-item { padding: 12px 20px; display: flex; align-items: center; color: rgba(255,255,255,.9);
      text-decoration: none; transition: all .3s; cursor: pointer; }
    .menu-item:hover, .menu-item.active { background: rgba(255,255,255,.15); border-left: 4px solid #fff; color: #fff; }
    .menu-item i { margin-right: 15px; }
    .menu-dropdown .submenu { display: none; flex-direction: column; background: rgba(255,255,255,.1); }
    .menu-dropdown.open .submenu { display: flex; }
    .dropdown-arrow { margin-left: auto; transition: transform .3s; }
    .menu-dropdown.open .dropdown-arrow { transform: rotate(180deg); }
    
    /* Main content */
    .main-content {
      margin-left: var(--sidebar-width); margin-top: var(--header-height);
      height: calc(100vh - var(--header-height)); background: #f0f4f8;
      overflow-y: auto;
    }
    
    /* Styles for the iframe */
    .content-frame {
      width: 100%;
      height: 100%;
      border: none;
    }

    /* Dashboard content (shown by default) */
    .dashboard-content {
      padding: 20px;
      display: block;
    }

    /* Cards grid */
    .card-grid { display: grid;grid-template-columns: repeat(4, 1fr);gap: 20px;margin-bottom: 30px; }
     .card {padding: 10px 15px 15px 10px;border-radius: 2px;color: #fff;font-weight: 600;font-size: 1rem;display: flex;align-items:flex-start;justify-content: flex-start;min-height: 120px;transition: transform 0.3s;text-align: left; /* ensure left alignment */
    }
    .card:hover { transform: translateY(-5px); }
    .card.green { background: linear-gradient(135deg, #2ecc71, #27ae60); }
    .card.blue { background: linear-gradient(135deg, #3498db, #2980b9); }
    .card.red { background: linear-gradient(135deg, #e74c3c, #c0392b); }
    .card.teal { background: linear-gradient(135deg, #1abc9c, #16a085); }

    /* Responsive cards */
    @media(max-width:1200px){.card-grid{grid-template-columns: repeat(2,1fr)}}
    @media(max-width:768px){.card-grid{grid-template-columns:1fr}}
  </style>
</head>
<body>
  <!-- Header -->
  <header class="header">
    <div class="logo"><img src="{{ asset('storage/img/logo3.png') }}" alt="Frela Admin Logo"></div>
    <div class="user-area">
      <div class="user-info">
        <span class="user-name">Administrator</span>
        <span class="user-role">Administrator</span>
      </div>
      <figure class="user-img">JJ</figure>
    </div>
  </header>

  <!-- Sidebar -->
  <aside class="sidebar">
    <nav class="sidebar-menu">
      <div class="menu-title">Main</div>
      <a class="menu-item active" data-content="dashboard"><i class="fas fa-home"></i><span class="menu-text">Dashboard</span></a>
       <!-- Users Dropdown -->
      <div class="menu-dropdown">
        <a class="menu-item dropdown-toggle"><i class="fas fa-users"></i><span class="menu-text">Users</span><i class="fas fa-chevron-down dropdown-arrow"></i></a>
        <div class="submenu">
          <a class="menu-item" data-content="add-user" data-src="{{ route('admin.users.add') }}"><i class="fas fa-user-plus"></i><span class="menu-text">Add User</span></a>
          <a class="menu-item" data-content="view-users" data-src="{{ route('admin.users') }}"><i class="fas fa-users"></i><span class="menu-text">View Users</span></a>
        </div>
      </div>

        <div class="menu-dropdown">
        <a class="menu-item dropdown-toggle"><i class="fa-solid fa-laptop"></i><span class="menu-text">Products</span><i class="fas fa-chevron-down dropdown-arrow"></i></a>
        <div class="submenu">
          <a class="menu-item" data-content="add-product" data-src="{{ route('admin.products.create') }}"><i class="fas fa-capsules"></i><span class="menu-text">Add</span></a>
          <a class="menu-item" data-content="view-products" data-src="{{ route('admin.products.index') }}"><i class="fas fa-capsules"></i><span class="menu-text">View</span></a>
        </div>
      </div>
      <a class="menu-item" data-content="orders" data-src="{{ route('admin.orders.view') }}"><i class="fas fa-box-open"></i><span class="menu-text">Orders</span></a>
      <a class="menu-item" data-content="settings" data-src="/admin/settings"><i class="fas fa-cog"></i><span class="menu-text">Settings</span></a>
      <form method="POST" action="{{ route('admin.logout') }}" class="menu-item" style="margin:0; padding:0;">
        @csrf
        <button type="submit" style="all: unset; cursor: pointer; display: flex; align-items: center; width: 100%;">
            <i class="fas fa-sign-out-alt"></i>
            <span class="menu-text" style="margin-left: 10px;">Logout</span>
        </button>
    </form>
    
    </nav>
  </aside>

  <!-- Main content area that will hold the iframe and dashboard content -->
  <main class="main-content">
    <!-- Dashboard content (shown by default) -->
    <div id="dashboard-content" class="dashboard-content">
      <div class="card-grid">
        <div class="card green">Total Sales KES {{ number_format($totalSales, 2) }}</div>
        <div class="card blue">New Users  {{ $totalUsers }}</div>
        <div class="card red">Pending Orders  {{ $totalOrders }}</div>
        <div class="card teal">
          <div style="width: 100%;">
              <strong>Top 5 Products sold</strong>
              <ol style="font-size: 0.75rem; margin-top: 5px; padding-left: 15px; line-height: 1.2;">
                  @foreach($topProducts as $item)
                      <li>{{ $item->product->name }} - Sold: {{ $item->total_sold }}</li>
                  @endforeach
              </ol>
          </div>
      </div>
      

      </div>

      <!-- Include orders table below cards -->
      <div id="orders-table">
        @include('admin.orders.view', ['orders' => $orders])
      </div>
    </div>

    <!-- Iframe for loading external content (hidden by default) -->
    <iframe id="content-frame" class="content-frame" src="" style="display:none;" title="Admin Content"></iframe>
  </main>

  <script>
    document.addEventListener('DOMContentLoaded', () => {
      const sidebar = document.querySelector('.sidebar');
      const dashboardContent = document.getElementById('dashboard-content');
      const iframe = document.getElementById('content-frame');

      // Handle sidebar menu item clicks
      sidebar.addEventListener('click', (event) => {
        const clickedItem = event.target.closest('.menu-item');
        if (!clickedItem) return;

        // Reset active state for all menu items
        document.querySelectorAll('.menu-item').forEach(item => {
          item.classList.remove('active');
        });

        // Set active state for the clicked item
        clickedItem.classList.add('active');

        // Handle dropdowns
        if (clickedItem.classList.contains('dropdown-toggle')) {
          clickedItem.closest('.menu-dropdown').classList.toggle('open');
        } else {
          // Check if this is the dashboard item
          const isDashboard = clickedItem.getAttribute('data-content') === 'dashboard';
          
          if (isDashboard) {
            // Show dashboard content, hide iframe
            dashboardContent.style.display = 'block';
            iframe.style.display = 'none';
          } else {
            // Load content into the iframe if a data-src is present
            const pageUrl = clickedItem.getAttribute('data-src');
            if (pageUrl) {
              iframe.src = pageUrl;
              iframe.style.display = 'block';
              dashboardContent.style.display = 'none';
            }
          }
        }
      });
    });
  </script>
</body>
</html>
