<?php defined('PREVENT_DIRECT_ACCESS') OR exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Products | Product Desk</title>
    <style>
        :root{--ink:#16252a;--muted:#6c7b7e;--paper:#f5f1e8;--accent:#e4572e;--line:#d8d1c4}*{box-sizing:border-box}body{margin:0;background:var(--paper);color:var(--ink);font-family:Arial,sans-serif}.shell{width:min(1100px,calc(100% - 40px));margin:0 auto;padding:42px 0}.top{display:flex;justify-content:space-between;align-items:center;border-bottom:1px solid var(--line);padding-bottom:24px}.brand{font:700 28px Georgia,serif}.tag{color:var(--accent);font-size:11px;letter-spacing:2px;text-transform:uppercase}.actions{display:flex;gap:12px;align-items:center}a,button{font:700 13px Arial,sans-serif;text-decoration:none;cursor:pointer}.primary{background:var(--accent);color:white;padding:13px 18px;border:0}.logout{color:var(--muted);background:transparent;border:0;padding:10px}.intro{padding:44px 0 28px;display:flex;justify-content:space-between;align-items:end}.intro h1{font:48px/1 Georgia,serif;margin:0}.intro p{color:var(--muted);margin:12px 0 0}.notice{background:#e4f0e7;padding:13px 16px;margin-bottom:20px;color:#275f3b;font-size:14px}table{width:100%;border-collapse:collapse;background:#fffdf8;border:1px solid var(--line)}th,td{text-align:left;padding:16px;border-bottom:1px solid var(--line)}th{font-size:11px;color:var(--muted);letter-spacing:1px;text-transform:uppercase}td{font-size:14px}td:first-child{font-weight:700;font-family:Georgia,serif;font-size:17px}.muted{color:var(--muted)}.edit{color:var(--accent);margin-right:12px}.delete{border:0;background:none;color:#9d3219;padding:0;font-weight:700}@media(max-width:700px){.shell{width:min(100% - 28px,1100px);padding:24px 0}.top,.intro{align-items:flex-start;gap:20px;flex-direction:column}.intro h1{font-size:40px}table{display:block;overflow-x:auto;white-space:nowrap}}
    </style>
</head>
<body>
<div class="shell">
    <header class="top"><div><div class="tag">Authenticated workspace</div><div class="brand">Product Desk</div></div><div class="actions"><a class="primary" href="<?= site_url('/products/create') ?>">+ Add product</a><form method="post" action="<?= site_url('/logout') ?>"><button class="logout" type="submit">Log out</button></form></div></header>
    <section class="intro"><div><h1>Inventory</h1><p>Track every product in your catalog.</p></div></section>
    <?php if (!empty($message)): ?><div class="notice"><?= htmlspecialchars($message, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
    <?php if (!empty($database_error)): ?><div class="notice" style="background:#fbe3dc;color:#9d3219"><?= htmlspecialchars($database_error, ENT_QUOTES, 'UTF-8') ?></div><?php endif; ?>
    <table>
        <thead><tr><th>Product</th><th>Description</th><th>Price</th><th>Quantity</th><th>Created</th><th>Actions</th></tr></thead>
        <tbody>
        <?php if (empty($products)): ?><tr><td colspan="6" class="muted">No products yet. Add your first product.</td></tr><?php endif; ?>
        <?php foreach ($products as $product): ?><tr>
            <td><?= htmlspecialchars($product['product_name'], ENT_QUOTES, 'UTF-8') ?></td>
            <td class="muted"><?= htmlspecialchars($product['description'] ?? '', ENT_QUOTES, 'UTF-8') ?></td>
            <td>₱<?= number_format((float) $product['price'], 2) ?></td>
            <td><?= (int) $product['quantity'] ?></td>
            <td class="muted"><?= htmlspecialchars($product['created_at'], ENT_QUOTES, 'UTF-8') ?></td>
            <td><a class="edit" href="<?= site_url('/products/edit/' . (int) $product['id']) ?>">Edit</a><form style="display:inline" method="post" action="<?= site_url('/products/delete/' . (int) $product['id']) ?>" onsubmit="return confirm('Delete this product?')"><button class="delete" type="submit">Delete</button></form></td>
        </tr><?php endforeach; ?>
        </tbody>
    </table>
</div>
</body>
</html>
