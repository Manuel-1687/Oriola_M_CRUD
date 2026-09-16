<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sign in | Product Desk</title>
    <style>
        :root{--ink:#16252a;--muted:#6c7b7e;--paper:#f5f1e8;--accent:#e4572e;--line:#d8d1c4}*{box-sizing:border-box}body{margin:0;min-height:100vh;background:var(--paper);color:var(--ink);font-family:Georgia,serif;display:grid;place-items:center;padding:24px}main{width:min(430px,100%);background:#fffdf8;border:1px solid var(--line);padding:42px;box-shadow:12px 12px 0 #dce5df}h1{font-size:42px;line-height:1;margin:0 0 10px;letter-spacing:0}p{color:var(--muted);font:15px Arial,sans-serif}.eyebrow{color:var(--accent);font:700 12px Arial,sans-serif;letter-spacing:2px;text-transform:uppercase}label{display:block;font:700 13px Arial,sans-serif;margin:24px 0 8px}input{width:100%;padding:14px;border:1px solid var(--line);background:#fff;font:16px Arial,sans-serif}button{width:100%;margin-top:28px;padding:15px;border:0;background:var(--accent);color:white;font:700 14px Arial,sans-serif;cursor:pointer}button:hover{background:#c94421}.error{padding:12px;background:#fbe3dc;color:#9d3219;font:14px Arial,sans-serif}
    </style>
</head>
<body>
<main>
    <div class="eyebrow">Product Desk</div>
    <h1>Welcome back.</h1>
    <p>Sign in to manage the product inventory.</p>
    <?php if (!empty($error)): ?><div class="error"><?= htmlspecialchars($error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
    <form method="post" action="<?= site_url('/login') ?>">
        <label for="username">Username</label>
        <input id="username" name="username" type="text" autocomplete="username" required>
        <label for="password">Password</label>
        <input id="password" name="password" type="password" autocomplete="current-password" required>
        <button type="submit">Sign in</button>
    </form>
</main>
</body>
</html>
