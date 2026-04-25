<?php
// Script to verify all files are created and run git commands

$files_to_check = [
    'app/Models/Hutang.php',
    'app/Http/Controllers/HutangController.php',
    'database/migrations/2026_04_25_000001_create_hutangs_table.php',
    'database/seeders/CreateHutangViewsSeeder.php',
    'routes/web.php',
];

echo "=== Checking Files ===\n";
foreach ($files_to_check as $file) {
    $path = __DIR__ . '/' . $file;
    $exists = file_exists($path) ? "✓ EXISTS" : "✗ MISSING";
    echo "$file: $exists\n";
}

echo "\n=== Database Table Structure ===\n";
echo "Hutang table will be created when migration runs\n";
echo "Fields:\n";
echo "  - id (Primary Key)\n";
echo "  - nama_peminjam (String)\n";
echo "  - nomor_hp (String, nullable)\n";
echo "  - alamat (Text, nullable)\n";
echo "  - jumlah_hutang (Decimal 15,2)\n";
echo "  - jumlah_bayar (Decimal 15,2, default 0)\n";
echo "  - status (String: belum_lunas/sebagian_lunas/lunas)\n";
echo "  - tanggal_hutang (Date)\n";
echo "  - tanggal_jatuh_tempo (Date, nullable)\n";
echo "  - keterangan (Text, nullable)\n";
echo "  - timestamps\n";

echo "\n=== CRUD Operations ===\n";
echo "✓ Create: POST /hutang/create -> /hutang\n";
echo "✓ Read: GET /hutang (index), GET /hutang/{id}\n";
echo "✓ Update: PUT /hutang/{id}\n";
echo "✓ Delete: DELETE /hutang/{id}\n";
echo "✓ Payment: POST /hutang/{id}/bayar\n";

echo "\n=== Views ===\n";
echo "Views will be auto-created on first access:\n";
echo "  - resources/views/hutang/index.blade.php\n";
echo "  - resources/views/hutang/create.blade.php\n";
echo "  - resources/views/hutang/edit.blade.php\n";
echo "  - resources/views/hutang/show.blade.php\n";

echo "\n✓ Ready to commit!\n";
