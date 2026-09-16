<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); $editing = !empty($product); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title><?= $editing ? 'Edit' : 'Add' ?> Product | Product Desk</title>
    <style>
        :root{--ink:#16252a;--muted:#6c7b7e;--paper:#f5f1e8;--accent:#e4572e;--line:#d8d1c4}*{box-sizing:border-box}body{margin:0;background:var(--paper);color:var(--ink);font-family:Arial,sans-serif}.shell{width:min(680px,calc(100% - 40px));margin:0 auto;padding:44px 0}.back{color:var(--accent);font-size:13px;font-weight:700;text-decoration:none}.panel{margin-top:24px;background:#fffdf8;border:1px solid var(--line);padding:38px}h1{font:46px/1 Georgia,serif;margin:0 0 10px}.sub{color:var(--muted);margin:0 0 28px}label{display:block;font-weight:700;font-size:13px;margin:20px 0 8px}input,textarea{width:100%;padding:13px;border:1px solid var(--line);background:white;font:16px Arial,sans-serif}textarea{min-height:120px;resize:vertical}.grid{display:grid;grid-template-columns:1fr 1fr;gap:20px}.submit{margin-top:28px;border:0;background:var(--accent);color:white;padding:14px 20px;font-weight:700;cursor:pointer}@media(max-width:600px){.shell{width:min(100% - 28px,680px);padding:24px 0}.panel{padding:25px}.grid{grid-template-columns:1fr}h1{font-size:38px}}
    </style>
</head>
<body>
<div class="shell"><a class="back" href="<?= site_url('/products') ?>">← Back to inventory</a><section class="panel"><h1><?= $editing ? 'Edit product' : 'Add product' ?></h1><p class="sub">Keep your catalog details accurate and up to date.</p>
<form method="post" action="<?= site_url($form_action) ?>">
    <label for="product_name">Product name</label><input id="product_name" name="product_name" maxlength="100" value="<?= htmlspecialchars($product['product_name'] ?? '', ENT_QUOTES, 'UTF-8') ?>" required>
    <label for="description">Description</label><textarea id="description" name="description"><?= htmlspecialchars($product['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></textarea>
    <div class="grid"><div><label for="price">Price</label><input id="price" name="price" type="number" min="0" step="0.01" value="<?= htmlspecialchars($product['price'] ?? '0.00', ENT_QUOTES, 'UTF-8') ?>" required></div><div><label for="quantity">Quantity</label><input id="quantity" name="quantity" type="number" min="0" step="1" value="<?= (int) ($product['quantity'] ?? 0) ?>" required></div></div>
    <button class="submit" type="submit"><?= $editing ? 'Save changes' : 'Create product' ?></button>
</form></section></div>
</body>
</html>
