
  </div>
</main>
<footer class="py-3 bg-gray-700 dark:bg-neutral-700 mt-4">

      <div class="inline-flex items-center">
            <div class="ps-5 ms-5">
          <p class="text-sm text-neutral-400">Be Strong!</p>
        </div>
        <div class="border-s border-neutral-700 ps-5 ms-5">
          <p class="text-sm text-neutral-400">2024© Matěj Verner</p>
        </div>
      </div>
</footer>
</body>
</html>

<script>
    document.addEventListener('DOMContentLoaded', function() {
        const errorsDiv = document.getElementById('errors');
        <?php foreach ($errors as $error): ?>
            const errorDiv = document.createElement('div');
            errorDiv.className = 'bg-red-100 border border-red-400 text-red-700 m-8 p-4 rounded';
            errorDiv.textContent = <?= json_encode($error) ?>;
            errorsDiv.appendChild(errorDiv);
        <?php endforeach; ?>

        const messagesDiv = document.getElementById('messages');
        <?php foreach ($messages as $message): ?>
            const messageDiv = document.createElement('div');
            messageDiv.className = 'bg-green-100 border border-green-400 text-green-700 m-8 p-4 rounded';
            messageDiv.textContent = <?= json_encode($message) ?>;
            messagesDiv.appendChild(messageDiv);
        <?php endforeach; ?>
    });
</script>





