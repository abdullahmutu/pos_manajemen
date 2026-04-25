<?php
// Git operations script
$repo_path = __DIR__;
chdir($repo_path);

echo "=== Git Status ===\n";
$output = shell_exec('git status --porcelain 2>&1');
echo $output . "\n";

echo "=== Adding files ===\n";
$commands = [
    'git add app/Models/Hutang.php',
    'git add app/Http/Controllers/HutangController.php',
    'git add database/migrations/2026_04_25_000001_create_hutangs_table.php',
    'git add database/seeders/CreateHutangViewsSeeder.php',
    'git add database/seeders/DatabaseSeeder.php',
    'git add routes/web.php',
    'git add toko_ku.sql',
];

foreach ($commands as $cmd) {
    echo "Running: $cmd\n";
    $result = shell_exec($cmd . ' 2>&1');
    if ($result) {
        echo "  Result: $result";
    }
}

echo "\n=== Committing ===\n";
$commit_msg = 'feat: tambah tabel hutang dengan CRUD lengkap

- Buat tabel hutang di database
- Buat Model Hutang dengan accessor sisa_hutang  
- Buat HutangController dengan CRUD operations
- Tambah routes untuk hutang resource
- Buat 4 blade templates (index, create, edit, show)
- View otomatis dibuat saat controller diakses
- Fitur pembayaran cicilan dengan status tracking

Co-authored-by: Copilot <223556219+Copilot@users.noreply.github.com>';

$commit_cmd = 'git commit -m "' . addslashes($commit_msg) . '"';
echo "Executing commit...\n";
$result = shell_exec($commit_cmd . ' 2>&1');
echo $result;

echo "\n=== Showing commits ===\n";
$log = shell_exec('git log --oneline -5 2>&1');
echo $log;

echo "\n=== Current branch ===\n";
$branch = shell_exec('git branch -v 2>&1');
echo $branch;

echo "\n=== Ready to push ===\n";
echo "Run: git push origin [branch_name]\n";
