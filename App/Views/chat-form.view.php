<h1>Chat with AI</h1>
<form method="post" action="/chat">
    <label for="userInput">Ask something:</label>
    <input type="text" id="userInput" name="userInput" required>
    <button type="submit">Send</button>
</form>

<?php if (isset($errors['input'])) : ?>
<p><?= htmlspecialchars($errors['input']); ?></p>
<?php endif; ?>
<?php if (isset($errors['message'])) : ?>
<p><?= htmlspecialchars($errors['message']); ?></p>
<?php endif; ?>