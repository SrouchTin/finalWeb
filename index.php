<?php
include 'backend/server/connection.php';

?>
<!DOCTYPE html>
<html lang="en">

<head>
      <meta charset="UTF-8">
      <meta name="viewport" content="width=device-width, initial-scale=1.0">
      <title>Mini E-commerce</title>
      <!-- Tailwind CSS CDN -->
      <script src="https://cdn.tailwindcss.com"></script>
      <!-- Google Fonts: Inter -->
      <link rel="preconnect" href="https://fonts.googleapis.com">
      <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
      <link href="https://unpkg.com/aos@2.3.1/dist/aos.css" rel="stylesheet">
      <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700;800&display=swap" rel="stylesheet">
      <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css" integrity="..." crossorigin="anonymous" />
      <link rel="stylesheet" href="style/style.css">
      <style>
            * {
                  margin: 0;
                  padding: 0;
                  box-sizing: border-box;
            }

            body {
                  font-family: 'Inter', sans-serif;
            }

            /* Simple aspect ratio for product images, as the plugin is not available via CDN */
            .aspect-1 {
                  aspect-ratio: 1 / 1;
            }

            /* Styles for Modals */
            .modal-backdrop {
                  transition: opacity 0.3s ease;
            }

            .modal-content {
                  transition: transform 0.3s ease;
            }

            /* Styles for active/inactive tabs */
            .tab-active {
                  border-color: #4f46e5;
                  /* indigo-600 */
                  color: #4f46e5;
            }

            .tab-inactive {
                  border-color: transparent;
                  color: #6b7280;
                  /* gray-500 */
            }

            .qr-modal {
                  position: fixed;
                  inset: 0;
                  z-index: 60;
                  display: flex;
                  align-items: center;
                  justify-content: center;
                  background: rgba(0, 0, 0, 0.5);
            }

            .qr-modal-content {
                  background: #fff;
                  border-radius: 1rem;
                  box-shadow: 0 2px 24px rgba(0, 0, 0, 0.2);
                  padding: 2rem;
                  text-align: center;
                  max-width: 350px;
            }

            .qr-modal-close {
                  position: absolute;
                  top: 1rem;
                  right: 1rem;
                  background: none;
                  border: none;
                  font-size: 1.5rem;
                  color: #333;
                  cursor: pointer;
            }
      </style>
</head>

<body class="bg-white" id="home">

      <!-- Header Section -->
      <header class="bg-white shadow-md sticky top-0 z-50" data-aos="fade-down">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                  <div class="flex items-center justify-between h-20">
                        <!-- Logo -->
                        <div class="flex-shrink-0">
                              <a href="#home" class="text-2xl font-bold text-gray-800 main-name">T-Shop</a>
                        </div>

                        <!-- Desktop Navigation -->
                        <nav class="hidden lg:flex lg:space-x-8">
                              <ul class="flex content-center items-center gap-7">
                                    <li class="nav-item">
                                          <a class="nav-link" aria-current="page" href="#home">Home</a>
                                    </li>
                                    <li class="nav-item mx-lg-3 ">
                                          <a class="nav-link" href="#shop">Shop</a>
                                    </li>
                                    <li class="nav-item mx-lg-3">
                                          <a class="nav-link" href="#about">About</a>
                                    </li>
                                    <li class="nav-item">
                                          <a class="nav-link" href="#contact">Contact</a>
                                    </li>
                              </ul>
                        </nav>
                        <!-- Icons and Search -->
                        <div class="flex items-center space-x-4">
                              <div class="hidden md:block relative">
                                    <form method="GET" action="">
                                          <div class="relative">
                                                <input type="text" name="search"
                                                      placeholder="Search products..."
                                                      value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                                                      class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                                <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                                      <button type="submit">
                                                            <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                                  viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                                  stroke-linecap="round" stroke-linejoin="round"
                                                                  class="h-5 w-5 text-gray-400">
                                                                  <circle cx="11" cy="11" r="8"></circle>
                                                                  <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                                            </svg>
                                                      </button>
                                                </div>
                                          </div>
                                    </form>
                              </div>
                              <div class="flex items-center space-x-3">
                                    <a href="#" id="auth-icon-link" class="text-gray-600 hover:text-indigo-600 relative">
                                          <!-- User Icon SVG -->
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                                <path d="M20 21v-2a4 4 0 0 0-4-4H8a4 4 0 0 0-4 4v2"></path>
                                                <circle cx="12" cy="7" r="4"></circle>
                                          </svg>
                                    </a>
                                    <a href="#" class="text-gray-600 hover:text-indigo-600 relative">
                                          <!-- Heart Icon SVG -->
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                                <path d="M20.84 4.61a5.5 5.5 0 0 0-7.78 0L12 5.67l-1.06-1.06a5.5 5.5 0 0 0-7.78 7.78l1.06 1.06L12 21.23l7.78-7.78 1.06-1.06a5.5 5.5 0 0 0 0-7.78z"></path>
                                          </svg>
                                          <span class="absolute -top-2 -right-2 bg-indigo-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">3</span>
                                    </a>
                                    <a href="#" id="cart-icon-link" class="text-gray-600 hover:text-indigo-600 relative">
                                          <!-- Shopping Cart Icon SVG -->
                                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                                <circle cx="9" cy="21" r="1"></circle>
                                                <circle cx="20" cy="21" r="1"></circle>
                                                <path d="M1 1h4l2.68 13.39a2 2 0 0 0 2 1.61h9.72a2 2 0 0 0 2-1.61L23 6H6"></path>
                                          </svg>
                                          <span id="cart-count" class="absolute -top-2 -right-2 bg-indigo-600 text-white text-xs rounded-full h-5 w-5 flex items-center justify-center">0</span>
                                    </a>
                              </div>
                              <!-- Mobile Menu Button -->
                              <div class="lg:hidden">
                                    <button id="menu-button" class="text-gray-600 hover:text-indigo-600">
                                          <!-- Menu Icon -->
                                          <svg id="menu-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                                <line x1="3" y1="12" x2="21" y2="12"></line>
                                                <line x1="3" y1="6" x2="21" y2="6"></line>
                                                <line x1="3" y1="18" x2="21" y2="18"></line>
                                          </svg>
                                          <!-- Close Icon -->
                                          <svg id="close-icon" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6 hidden">
                                                <line x1="18" y1="6" x2="6" y2="18"></line>
                                                <line x1="6" y1="6" x2="18" y2="18"></line>
                                          </svg>
                                    </button>
                              </div>
                        </div>
                  </div>
            </div>
            <!-- Mobile Menu -->
            <div id="mobile-menu" class="hidden lg:hidden bg-white border-t border-gray-200">
                  <div class="px-2 pt-2 pb-3 space-y-1 sm:px-3">
                        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Home</a>
                        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Shop</a>
                        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">About</a>
                        <a href="#" class="block px-3 py-2 rounded-md text-base font-medium text-gray-700 hover:text-indigo-600 hover:bg-gray-50">Contact</a>
                  </div>
                  <div class="p-4 border-t border-gray-200">
                        <form method="GET" action="">
                              <div class="relative">
                                    <input type="text" name="search"
                                          placeholder="Search products..."
                                          value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>"
                                          class="w-full pl-4 pr-10 py-2 border border-gray-300 rounded-full focus:outline-none focus:ring-2 focus:ring-indigo-500" />
                                    <div class="absolute inset-y-0 right-0 flex items-center pr-3">
                                          <button type="submit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                                                      viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2"
                                                      stroke-linecap="round" stroke-linejoin="round"
                                                      class="h-5 w-5 text-gray-400">
                                                      <circle cx="11" cy="11" r="8"></circle>
                                                      <line x1="21" y1="21" x2="16.65" y2="16.65"></line>
                                                </svg>
                                          </button>
                                    </div>
                              </div>
                        </form>
                  </div>

            </div>
      </header>

      <main>
            <!-- Hero Section -->
            <section class="relative bg-gray-900 text-white" data-aos="zoom-in-left">
                  <?php
                  $sql = "SELECT * FROM banner ORDER BY id DESC LIMIT 1";
                  $result = $conn->query($sql);
                  while ($row = $result->fetch_assoc()) { ?>
                        <img
                              src="<?php echo $row['img'] ?>"
                              alt="Promotional banner for a summer sale"
                              class="w-full h-96 object-cover opacity-50">
                        <div class="absolute inset-0 flex flex-col items-center justify-center text-center p-4">
                              <h1 class="text-4xl md:text-6xl font-extrabold mb-4 leading-tight"><?php echo $row['name'] ?></h1>
                              <p class="text-lg md:text-xl mb-8 max-w-2xl"><?php echo $row['description'] ?></p>
                              <a href="#" class="bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-3 px-8 rounded-full text-lg transition-transform transform hover:scale-105 duration-300">
                                    <?php echo $row['button'] ?>
                              </a>
                        </div>
                  <?php }
                  ?>
            </section>

            <!-- Featured Products Section -->
            <section class="bg-gray-50 py-16 sm:py-24" id="shop">
                  <div class="container mx-auto px-4 sm:px-6 lg:px-8"  data-aos="zoom-in-down">
                        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 text-center mb-4">Featured Products</h2>
                        <p class="text-center text-lg text-gray-600 mb-12">Handpicked items you're sure to love.</p>

                        <?php
                        $category = isset($_GET['category']) ? $_GET['category'] : 'all';
                        ?>

                        <div class="flex flex-col sm:flex sm:flex-row sm:justify-between my-5 px-2" data-aos="zoom-in-down">
                              <a href="index.php?category=all">
                                    <button class="<?php echo ($category == 'all')
                                                            ? 'bg-gray-900 text-white font-semibold py-2 px-5 rounded-full shadow-lg'
                                                            : 'text-gray-700 font-medium py-2 px-5 border border-gray-300 rounded-full hover:bg-gray-100'; ?>">
                                          All
                                    </button>
                              </a>

                              <div class=" flex flex-col my-5 sm:flex sm:flex-row sm:my-0 gap-5">
                                    <a href="index.php?category=3">
                                          <button class="<?php echo ($category == '3')
                                                                  ? 'bg-gray-900 text-white font-semibold py-2 px-5 rounded-full shadow-lg'
                                                                  : 'text-gray-700 font-medium py-2 px-5 border border-gray-300 rounded-full hover:bg-gray-100'; ?>">
                                                FootWears
                                          </button>
                                    </a>

                                    <a href="index.php?category=2">
                                          <button class="<?php echo ($category == '2')
                                                                  ? 'bg-gray-900 text-white font-semibold py-2 px-5 rounded-full shadow-lg'
                                                                  : 'text-gray-700 font-medium py-2 px-5 border border-gray-300 rounded-full hover:bg-gray-100'; ?>">
                                                Accessories
                                          </button>
                                    </a>

                                    <a href="index.php?category=1">
                                          <button class="<?php echo ($category == '1')
                                                                  ? 'bg-gray-900 text-white font-semibold py-2 px-5 rounded-full shadow-lg'
                                                                  : 'text-gray-700 font-medium py-2 px-5 border border-gray-300 rounded-full hover:bg-gray-100'; ?>">
                                                Apparels
                                          </button>
                                    </a>
                              </div>
                        </div>

                        <div class="grid grid-cols-1 gap-y-10 sm:grid-cols-2 lg:grid-cols-4 xl:gap-x-8" data-aos="zoom-in-up">
                              <?php
                              $category = isset($_GET['category']) ? $_GET['category'] : 'all';
                              $search   = isset($_GET['search']) ? $conn->real_escape_string($_GET['search']) : '';

                              if (!empty($search) && $category != "all") {
                                    // Search AND filter by category
                                    $cat = (int)$category;
                                    $sql = "SELECT * FROM products 
                                    WHERE cat_id = $cat 
                                    AND pro_name LIKE '%$search%'";
                              } elseif (!empty($search)) {
                                    // Search only
                                    $sql = "SELECT * FROM products 
                                    WHERE pro_name LIKE '%$search%'";
                              } elseif ($category != "all") {
                                    // Filter only
                                    $cat = (int)$category;
                                    $sql = "SELECT * FROM products WHERE cat_id = $cat";
                              } else {
                                    // Show all products
                                    $sql = "SELECT * FROM products";
                              }

                              $result = $conn->query($sql);

                              if ($result->num_rows > 0) {
                                    while ($row = $result->fetch_assoc()) { ?>
                                          <div class="group product-card relative bg-white border border-gray-200 rounded-lg shadow-sm overflow-hidden hover:shadow-xl transition-shadow duration-300 sm:mx-2 lg:mx-2 xl:mx-0">
                                                <div class="aspect-1 w-full overflow-hidden">
                                                      <img src="<?php echo $row['img'] ?>" alt="<?php echo $row['pro_name'] ?>"
                                                            class="w-full h-full object-cover object-center group-hover:scale-110 transition-transform duration-500">
                                                </div>
                                                <div class="p-4">
                                                      <h3 class="product-name text-sm text-gray-500"><?php echo $row['pro_name'] ?></h3>
                                                      <p class="text-lg font-semibold text-gray-900 mt-1"><?php echo $row['description'] ?></p>
                                                      <p class="product-price mt-2 text-xl font-bold text-indigo-600"><?php echo "$" . $row['price'] ?></p>
                                                </div>
                                                <div class="absolute bottom-0 left-0 right-0 p-4 bg-white bg-opacity-90 transform translate-y-full group-hover:translate-y-0 transition-transform duration-300 ease-in-out">
                                                      <button class="add-to-cart-btn w-full bg-gray-800 text-white py-2 px-4 rounded-md hover:bg-indigo-600 transition-colors duration-300">Add to Cart</button>
                                                </div>
                                          </div>
                              <?php }
                              } else {
                                    echo "<p class='text-center text-gray-500 col-span-4'>No products found.</p>";
                              }
                              ?>
                        </div>
                  </div>
            </section>

            <!-- Category Showcase Section -->
            <section class="py-16 sm:py-24 bg-white" data-aos="zoom-in" id="about">
                  <div class="container mx-auto px-4 sm:px-6 lg:px-8">
                        <h2 class="text-3xl font-extrabold tracking-tight text-gray-900 text-center mb-12">Shop by Category</h2>
                        <div class="grid grid-cols-1 md:grid-cols-3 gap-8">
                              <!-- Categories -->
                              <?php
                              $sql = "SELECT * FROM categories ORDER BY cat_id DESC LIMIT 3 ";
                              $result = $conn->query($sql);
                              while ($row = $result->fetch_assoc()) { ?>
                                    <a href="#" class="group relative block rounded-lg overflow-hidden">
                                          <img src="<?php echo $row['img'] ?>" alt="Apparel" class="w-full h-80 object-cover transform group-hover:scale-105 transition-transform duration-300">
                                          <div class="absolute inset-0 bg-black bg-opacity-40 flex items-center justify-center">
                                                <h3 class="text-white text-2xl font-bold"><?php echo $row['cat_name'] ?></h3>
                                          </div>
                                    </a>
                              <?php }
                              ?>
                              <!-- Categories -->
                        </div>
                  </div>
            </section>
      </main>

      <!-- Footer Section -->
      <footer class="bg-gray-800 text-white" data-aos="zoom-in-left" id="contact">
            <div class="container mx-auto px-4 sm:px-6 lg:px-8 py-12">
                  <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-8">
                        <!-- About -->
                        <div>
                              <h3 class="text-lg font-semibold mb-4">T-shop</h3>
                              <p class="text-gray-400">Your destination for curated, high-quality products that inspire and delight.</p>
                        </div>
                        <!-- Links -->
                        <div>
                              <h3 class="text-lg font-semibold mb-4">Quick Links</h3>
                              <ul class="space-y-2">
                                    <li><a href="#" class="text-gray-400 hover:text-white">About Us</a></li>
                                    <li><a href="#" class="text-gray-400 hover:text-white">Contact</a></li>
                                    <li><a href="#" class="text-gray-400 hover:text-white">FAQ</a></li>
                                    <li><a href="#" class="text-gray-400 hover:text-white">Shipping & Returns</a></li>
                              </ul>
                        </div>
                        <!-- Social -->
                        <div>
                              <h3 class="text-lg font-semibold mb-4">Follow Us</h3>
                              <div class="flex space-x-4">
                                    <a href="#" class="text-gray-400 hover:text-white"><i class="fa-brands fa-facebook"></i></a>
                                    <a href="#" class="text-gray-400 hover:text-white"><i class="fa-brands fa-telegram"></i></a>
                                    <a href="#" class="text-gray-400 hover:text-white"><i class="fa-brands fa-x-twitter"></i></a>
                              </div>
                        </div>
                        <!-- Newsletter -->
                        <div>
                              <h3 class="text-lg font-semibold mb-4">Newsletter</h3>
                              <p class="text-gray-400 mb-4">Subscribe for the latest deals and drops.</p>
                              <form class="flex">
                                    <input type="email" placeholder="Your email" class="w-full rounded-l-md px-3 py-2 text-gray-800 focus:outline-none" />
                                    <button class="bg-indigo-600 hover:bg-indigo-700 text-white px-4 rounded-r-md">Go</button>
                              </form>
                        </div>
                  </div>
                  <div class="mt-8 border-t border-gray-700 pt-8 text-center ">
                        <p>&copy; 2025. Made by <a href="https://t.me/srouch_tin" target="_blank">Srouch Tin.</a></p>
                  </div>
            </div>
      </footer>

      <!-- Cart Modal -->
      <div id="cart-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <!-- Backdrop -->
            <div class="modal-backdrop-el absolute inset-0 bg-black modal-backdrop opacity-0"></div>
            <!-- Modal Content -->
            <div class="modal-content-box bg-white rounded-lg shadow-xl w-11/12 md:max-w-md mx-auto transform scale-95 modal-content">
                  <div class="flex justify-between items-center p-4 border-b">
                        <h3 class="text-lg font-semibold">Shopping Cart</h3>
                        <button class="close-modal-btn text-gray-500 hover:text-gray-800">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                              </svg>
                        </button>
                  </div>
                  <div id="cart-items" class="p-6 max-h-64 overflow-y-auto">
                        <!-- Cart items will be injected here -->

                        <p class="text-gray-500">Your cart is empty.</p>
                  </div>
                  <div class="p-4 border-t">
                        <div class="flex justify-between items-center gap-4">
                              <button id="clear-cart-btn" class="w-1/2 block text-center bg-gray-200 hover:bg-gray-300 text-gray-800 font-bold py-2 px-4 rounded-md">
                                    Clear
                              </button>
                              <a href="#" class="w-full block text-center bg-indigo-600 hover:bg-indigo-700 text-white font-bold py-2 px-4 rounded-md" id="check_out">
                                    Checkout
                              </a>
                        </div>
                  </div>
            </div>
      </div>

      <!-- Auth (Login/Sign Up) Modal -->
      <div id="auth-modal" class="fixed inset-0 z-50 flex items-center justify-center hidden">
            <!-- Backdrop -->
            <div class="modal-backdrop-el absolute inset-0 bg-black modal-backdrop opacity-0"></div>
            <!-- Modal Content -->
            <div class="modal-content-box bg-white rounded-lg shadow-xl w-11/12 md:max-w-md mx-auto transform scale-95 modal-content">
                  <div class="flex justify-end p-2">
                        <button class="close-modal-btn text-gray-500 hover:text-gray-800">
                              <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="h-6 w-6">
                                    <line x1="18" y1="6" x2="6" y2="18"></line>
                                    <line x1="6" y1="6" x2="18" y2="18"></line>
                              </svg>
                        </button>
                  </div>

                  <div class="px-6 pb-6">
                        <!-- Tabs -->
                        <div class="flex border-b">
                              <button id="login-tab" class="flex-1 py-2 font-semibold border-b-2 tab-active">Login</button>
                              <button id="signup-tab" class="flex-1 py-2 font-semibold border-b-2 tab-inactive">Sign Up</button>
                        </div>

                        <!-- Login Form -->
                        <div id="login-form-container">
                              <form method="post" action="backend/server/checkLogin.php" id="login-form" class="mt-6">
                                    <div class="space-y-4">
                                          <div>
                                                <label for="login-email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                                <input type="email" id="login-email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                          </div>
                                          <div>
                                                <label for="login-password" class="block text-sm font-medium text-gray-700">Password</label>
                                                <input type="password" id="login-password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                          </div>
                                    </div>
                                    <div class="mt-6">
                                          <button type="submit" name="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Sign in
                                          </button>
                                    </div>
                                    <div class="mt-4 text-sm text-center">
                                          <a href="#" class="font-medium text-indigo-600 hover:text-indigo-500"> Forgot your password? </a>
                                    </div>
                              </form>
                        </div>

                        <!-- Sign Up Form -->
                        <div id="signup-form-container" class="hidden">
                              <form method="post" action="backend/server/insert.php" id="signup-form" class="mt-6">
                                    <div class="space-y-4">
                                          <div>
                                                <label for="signup-name" class="block text-sm font-medium text-gray-700">Full Name</label>
                                                <input type="text" id="signup-name" name="name" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                          </div>
                                          <div>
                                                <label for="signup-email" class="block text-sm font-medium text-gray-700">Email Address</label>
                                                <input type="email" id="signup-email" name="email" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                          </div>
                                          <div>
                                                <label for="signup-password" class="block text-sm font-medium text-gray-700">Password</label>
                                                <input type="password" id="signup-password" name="password" required class="mt-1 block w-full px-3 py-2 border border-gray-300 rounded-md shadow-sm placeholder-gray-400 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 sm:text-sm">
                                          </div>
                                    </div>
                                    <div class="mt-6">
                                          <button type="submit" name="submit" class="w-full flex justify-center py-2 px-4 border border-transparent rounded-md shadow-sm text-sm font-medium text-white bg-indigo-600 hover:bg-indigo-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500">
                                                Create Account
                                          </button>
                                    </div>
                              </form>
                        </div>
                  </div>
            </div>
      </div>
      <div class="check-qr">
            <div id="qr-modal" class="qr-modal hidden">
                  <div class="qr-modal-content relative">
                        <button class="qr-modal-close" id="qr-modal-close">&times;</button>
                        <h2 class="text-xl font-bold mb-4">Scan to Pay</h2>
                        <img src="image/QR.png" alt="QR Code" class="mx-auto mb-4" style="max-width:200px;">
                        <p class="text-gray-600">Use your mobile banking app to scan and complete payment.</p>
                  </div>
            </div>
            <script>
                  document.addEventListener('DOMContentLoaded', () => {
                        const qrModal = document.getElementById('qr-modal');
                        const qrModalClose = document.getElementById('qr-modal-close');
                        const checkoutBtn = document.getElementById('check_out');

                        checkoutBtn.addEventListener('click', function(e) {
                              e.preventDefault();
                              qrModal.classList.remove('hidden');
                        });

                        qrModalClose.addEventListener('click', function() {
                              qrModal.classList.add('hidden');
                        });

                        qrModal.addEventListener('click', function(e) {
                              if (e.target === qrModal) {
                                    qrModal.classList.add('hidden');
                              }
                        });
                  });
            </script>
      </div>

      <!-- JavaScript for Mobile Menu and Modals -->
      <script>
            document.addEventListener('DOMContentLoaded', () => {

                  // --- Mobile Menu Toggle ---
                  const menuButton = document.getElementById('menu-button');
                  const mobileMenu = document.getElementById('mobile-menu');
                  const menuIcon = document.getElementById('menu-icon');
                  const closeIcon = document.getElementById('close-icon');

                  menuButton.addEventListener('click', () => {
                        mobileMenu.classList.toggle('hidden');
                        menuIcon.classList.toggle('hidden');
                        closeIcon.classList.toggle('hidden');
                  });

                  // --- Generic Modal Logic ---
                  const openModal = (modal) => {
                        const modalBackdrop = modal.querySelector('.modal-backdrop-el');
                        const modalContentBox = modal.querySelector('.modal-content-box');
                        modal.classList.remove('hidden');
                        setTimeout(() => {
                              modalBackdrop.classList.replace('opacity-0', 'opacity-50');
                              modalContentBox.classList.replace('scale-95', 'scale-100');
                        }, 10);
                  };

                  const closeModal = (modal) => {
                        const modalBackdrop = modal.querySelector('.modal-backdrop-el');
                        const modalContentBox = modal.querySelector('.modal-content-box');
                        modalBackdrop.classList.replace('opacity-50', 'opacity-0');
                        modalContentBox.classList.replace('scale-100', 'scale-95');
                        setTimeout(() => {
                              modal.classList.add('hidden');
                        }, 300);
                  };

                  document.querySelectorAll('.close-modal-btn').forEach(btn => {
                        btn.addEventListener('click', () => closeModal(btn.closest('.fixed')));
                  });

                  document.querySelectorAll('.modal-backdrop-el').forEach(backdrop => {
                        backdrop.addEventListener('click', () => closeModal(backdrop.closest('.fixed')));
                  });


                  // --- Cart Functionality ---
                  const cartModal = document.getElementById('cart-modal');
                  const addToCartButtons = document.querySelectorAll('.add-to-cart-btn');
                  const cartItemsContainer = document.getElementById('cart-items');
                  const cartCountElement = document.getElementById('cart-count');
                  const cartIconLink = document.getElementById('cart-icon-link');
                  const clearCartBtn = document.getElementById('clear-cart-btn'); // Get the Clear button

                  const getCart = () => JSON.parse(sessionStorage.getItem('cart')) || [];
                  const saveCart = (cart) => sessionStorage.setItem('cart', JSON.stringify(cart));

                  const updateCartDisplay = () => {
                        const cart = getCart();
                        cartCountElement.textContent = cart.length;

                        if (cart.length === 0) {
                              cartItemsContainer.innerHTML = '<p class="text-gray-500">Your cart is empty.</p>';
                              return;
                        }

                        // Pass both the item and index to the map function
                        cartItemsContainer.innerHTML = cart.map((item, index) => `
                        <div class="flex justify-between items-center py-2 border-b last:border-b-0 gap-3">
                              <div class="flex items-center gap-3">
                              <img src="${item.image}" alt="${item.name}" class="w-12 h-12 object-cover rounded">
                              <div>
                                    <p class="font-semibold">${item.name}</p>
                                    <p class="text-sm text-gray-500 ms-2">${item.price}</p>
                              </div>
                              </div>
                              <button class="delete-item-btn p-1 text-gray-400 hover:text-red-500" data-index="${index}">
                              <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="lucide lucide-trash-2">
                                    <path d="M3 6h18"/>
                                    <path d="M19 6v14c0 1-1 2-2 2H7c-1 0-2-1-2-2V6"/>
                                    <path d="M8 6V4c0-1 1-2 2-2h4c1 0 2 1 2 2v2"/>
                                    <line x1="10" x2="10" y1="11" y2="17"/>
                                    <line x1="14" x2="14" y1="11" y2="17"/>
                              </svg>
                              </button>
                        </div>
                  `).join('');

                        let total = cart.reduce((sum, item) => {
                              if (!item.price) return sum; // Skip if price is undefined or empty
                              let cleanPrice = String(item.price).replace(/[^0-9.]/g, "");
                              let numericPrice = parseFloat(cleanPrice);
                              return sum + (isNaN(numericPrice) ? 0 : numericPrice);
                        }, 0);

                        
                        // Append total row
                        cartItemsContainer.innerHTML += `
                  <div class="flex justify-between items-center py-3 font-bold text-lg">
                        <span>Total:</span>
                        <span>${total.toFixed(2)}$</span>
                  </div>
                  `;

                  };

                  cartItemsContainer.addEventListener('click', (e) => {
                        if (e.target.closest('.delete-item-btn')) {
                              const index = parseInt(e.target.closest('.delete-item-btn').dataset.index, 10);

                              let cart = getCart();
                              cart.splice(index, 1);
                              saveCart(cart);

                              updateCartDisplay();
                        }
                  });

                  // Event listener for the 'Clear' button
                  clearCartBtn.addEventListener('click', () => {
                        sessionStorage.removeItem('cart');
                        updateCartDisplay();
                  });

                  addToCartButtons.forEach(button => {
                        button.addEventListener('click', (e) => {
                              e.preventDefault();
                              const card = button.closest('.product-card');
                              const productName = card.querySelector('.product-name').textContent;
                              const productPrice = card.querySelector('.product-price').textContent;
                              const productImage = card.querySelector('img').getAttribute('src');

                              const cart = getCart();
                              cart.push({
                                    name: productName,
                                    price: productPrice,
                                    image: productImage
                              });

                              saveCart(cart);
                              updateCartDisplay();
                        });
                  });

                  cartIconLink.addEventListener('click', (e) => {
                        e.preventDefault();
                        openModal(cartModal);
                  });

                  const checkoutBtn = document.getElementById('check_out');
                  checkoutBtn.addEventListener('click', () => {
                        // Hide the cart modal
                        closeModal(cartModal);
                        // Show QR modal (already handled in the QR modal script)
                        sessionStorage.removeItem('cart');
                        updateCartDisplay();
                  });

                  // Call updateCartDisplay() on page load to initialize the cart view
                  updateCartDisplay();

                  // --- Auth Modal Functionality ---
                  const authModal = document.getElementById('auth-modal');
                  const authIconLink = document.getElementById('auth-icon-link');
                  const loginTab = document.getElementById('login-tab');
                  const signupTab = document.getElementById('signup-tab');
                  const loginFormContainer = document.getElementById('login-form-container');
                  const signupFormContainer = document.getElementById('signup-form-container');
                  const loginForm = document.getElementById('login-form');
                  const signupForm = document.getElementById('signup-form');

                  authIconLink.addEventListener('click', (e) => {
                        e.preventDefault();
                        openModal(authModal);
                  });

                  loginTab.addEventListener('click', () => {
                        loginTab.classList.replace('tab-inactive', 'tab-active');
                        signupTab.classList.replace('tab-active', 'tab-inactive');
                        loginFormContainer.classList.remove('hidden');
                        signupFormContainer.classList.add('hidden');
                  });

                  signupTab.addEventListener('click', () => {
                        signupTab.classList.replace('tab-inactive', 'tab-active');
                        loginTab.classList.replace('tab-active', 'tab-inactive');
                        signupFormContainer.classList.remove('hidden');
                        loginFormContainer.classList.add('hidden');
                  });



                  // --- Initial Setup ---

            });
      </script>
      <script src="https://unpkg.com/aos@2.3.1/dist/aos.js"></script>
      <script>
            AOS.init();
      </script>
</body>

</html>