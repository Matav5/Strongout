<header class="flex flex-wrap md:justify-start md:flex-nowrap z-50 w-full text-sm">
  <nav class="mt-6 relative max-w-[85rem] w-full bg-white border border-gray-200 rounded-[36px] mx-2 py-3 px-4 md:flex md:items-center md:justify-between md:py-0 md:px-6 lg:px-8 xl:mx-auto dark:bg-neutral-800 dark:border-neutral-700" aria-label="Global">
    <div class="flex items-center justify-between">
      <div class="image-container w-24 h-24">
        <a href="/index.php"><img src="/public/transparent.png" alt="Strongout Logo" class="footer-logo w-full h-full object-contain"></a>
      </div>
      <div class="md:hidden">
        <button type="button" id="navbar-toggle" class="hs-collapse-toggle size-8 flex justify-center items-center text-sm font-semibold rounded-full border border-gray-200 text-gray-800 hover:bg-gray-100 disabled:opacity-50 disabled:pointer-events-none dark:text-white dark:border-neutral-700 dark:hover:bg-neutral-700" aria-controls="navbar-collapse-with-animation" aria-label="Toggle navigation">
          <svg class="hs-collapse-open:hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><line x1="3" x2="21" y1="6" y2="6"/><line x1="3" x2="21" y1="12" y2="12"/><line x1="3" x2="21" y1="18" y2="18"/></svg>
          <svg class="hs-collapse-open:block hidden flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M18 6 6 18"/><path d="m6 6 12 12"/></svg>
        </button>
      </div>
    </div>
    <div id="navbar-collapse-with-animation" class="hs-collapse hidden overflow-hidden transition-all duration-300 basis-full grow md:block">
      <div class="flex flex-col gap-y-4 gap-x-0 mt-5 md:flex-row md:items-center md:justify-end md:gap-y-0 md:gap-x-7 md:mt-0 md:ps-7">
        <?php
        $current_page = basename($_SERVER['PHP_SELF']);
        ?>
        <a class="font-medium md:py-6 <?= $current_page == 'index.php' ? 'text-blue-600 dark:text-blue-500 ' : 'text-gray-500 dark:text-neutral-400 ' ?>" href="index.php">Domů</a>

        <a class="font-medium hover:text-gray-400 md:py-6 dark:hover:text-neutral-500 <?= $current_page == 'workouts.php' ?'text-blue-600 dark:text-blue-500 ' : 'text-gray-500 dark:text-neutral-400 ' ?>" href="workouts.php">Plány</a>
        <a class="font-medium hover:text-gray-400 md:py-6 dark:hover:text-neutral-500 <?= $current_page == 'addPlan.php' ?'text-blue-600 dark:text-blue-500 ' : 'text-gray-500 dark:text-neutral-400 ' ?>" href="addPlan.php">Přidat Plán</a>
        <a class="font-medium hover:text-gray-400 md:py-6  dark:hover:text-neutral-500 <?= $current_page == 'upload.php' ?'text-blue-600 dark:text-blue-500 ' : 'text-gray-500 dark:text-neutral-400 ' ?>" href="upload.php">Nahrát</a>

        <a class="flex items-center gap-x-2 font-medium text-gray-500 hover:text-blue-600 md:border-s md:border-gray-300 md:my-6 md:ps-6 dark:border-neutral-700 dark:text-neutral-400 dark:hover:text-blue-500" href="login.php">
          <svg class="flex-shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><path d="M19 21v-2a4 4 0 0 0-4-4H9a4 4 0 0 0-4 4v2"/><circle cx="12" cy="7" r="4"/></svg>
          <?=$jePrihlaseny ? $prezdivka: "Přihlásit se" ?>
        </a>
      </div>
    </div>
  </nav>
</header>
<main id="content">
  <div class="max-w-[85rem] mx-auto bg-white mb-6">
    