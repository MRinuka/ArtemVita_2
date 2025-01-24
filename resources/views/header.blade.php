<header class="bg-white text-black px-6 py-4 flex flex-wrap items-center justify-between border border-gray-300 shadow-md">
  <!-- Logo -->
  <div class="text-2xl font-bold mb-2 sm:mb-0 flex-shrink-0">
    <a href="/" class="hover:text-gray-400">AV</a>
  </div>

  <!-- Navigation Links -->
  <nav class="flex space-x-4 mb-2 sm:mb-0">
    <a href="/" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-lg transition duration-300">Home</a>
    <a href="/products" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-lg transition duration-300">Products</a>
    <a href="/painting_dashboard" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-lg transition duration-300">Dashboard</a>
    <a href="/profile" class="text-gray-700 hover:text-blue-500 px-3 py-2 rounded-lg transition duration-300">Profile</a>
  </nav>

  <!-- Search Bar -->
  <div class="relative w-full sm:w-auto sm:flex-none">
    <input 
      type="text" 
      class="w-full sm:w-80 px-4 py-2 rounded-lg border border-gray-600 bg-gray-700 text-white focus:outline-none focus:ring-2 focus:ring-blue-500" 
      placeholder="Search..."
    />
    <button class="absolute top-0 right-3 mt-2">
      <svg xmlns="http://www.w3.org/2000/svg" class="h-5 w-5 text-gray-400 hover:text-white" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M21 21l-4.35-4.35M17.5 10.5a7 7 0 11-14 0 7 7 0 0114 0z" />
      </svg>
    </button>
  </div>
</header>
