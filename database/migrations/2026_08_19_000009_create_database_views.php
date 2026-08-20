<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        DB::statement(<<<'SQL'
            CREATE OR REPLACE VIEW v_dashboard_metrics AS
            SELECT
                (SELECT COALESCE(SUM(stock), 0) FROM products) AS total_alat,
                (SELECT COUNT(*) FROM customers) AS total_pengguna,
                (SELECT COALESCE(SUM(total), 0) FROM orders WHERE status = 'Selesai') AS total_pendapatan,
                (SELECT COUNT(*) FROM orders) AS pesanan_terbaru
        SQL);

        DB::statement(<<<'SQL'
            CREATE OR REPLACE VIEW v_order_details AS
            SELECT
                o.id,
                o.customer_id,
                o.schema_id,
                o.customer AS customer_name,
                o.skema AS skema_name,
                o.qty,
                o.total,
                o.status,
                o.tanggal,
                o.image,
                o.created_at,
                o.updated_at,
                c.email AS customer_email,
                c.phone AS customer_phone,
                s.harga AS schema_harga,
                s.satuan AS schema_satuan
            FROM orders o
            LEFT JOIN customers c ON c.id = o.customer_id
            LEFT JOIN `schemas` s ON s.id = o.schema_id
        SQL);
    }

    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS v_order_details');
        DB::statement('DROP VIEW IF EXISTS v_dashboard_metrics');
    }
};