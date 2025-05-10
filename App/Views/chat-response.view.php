<h2>AI Response:</h2>
<p> <?= htmlspecialchars($response['candidates'][0]['content']['parts'][0]['text']) ?> </p>

<?php if (isset($errors['response'])) : ?>
<p>"<?= htmlspecialchars($errors['response']); ?></p>
<?php endif; ?>