<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Core\Csrf;            // single import (outside the class)
use PDO;
use PDOException;

/**
 * Inventory / Stock module controller
 */
class StockController extends Controller
{
    /* ──────────────────────────────────────────────────────────
     |  Reusable helpers
     * ──────────────────────────────────────────────────────── */
    private function dbConn(): PDO               { return $this->db(); }

    private function deleteRow(string $table, string $pk, int $id, string &$msg): void
    {
        $stmt = $this->dbConn()->prepare("DELETE FROM {$table} WHERE {$pk} = ?");
        $stmt->execute([$id]);
        $msg = ucfirst(str_replace('_', ' ', $table)) . ' deleted.';
    }

    private function fetchAll(string $sql, array $args = []): array
    {
        $stmt = $this->dbConn()->prepare($sql);
        $stmt->execute($args);
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    /* =========================================================
     |  SELLERS
     * ======================================================= */
    public function sellers(): void
    {
        $db       = $this->dbConn();
        $error    = $success = null;

        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['seller_name'])) {
                $name = trim($_POST['seller_name']);
                if ($name !== '') {
                    $db->prepare("INSERT INTO sellers (seller_name) VALUES (?)")->execute([$name]);
                    $success = 'Seller added.';
                }
            }

            if (isset($_GET['delete'])) {
                $this->deleteRow('sellers', 'seller_id', (int) $_GET['delete'], $success);
            }

            $sellers = $this->fetchAll("SELECT * FROM sellers ORDER BY seller_id DESC");
        } catch (PDOException $e) {
            $error = $e->getMessage();
            $sellers = [];
        }

        $this->view('stock/sellers', compact('sellers', 'success', 'error'));
    }

    /* =========================================================
     |  BRANDS   (seller-filtered)
     * ======================================================= */
    public function brands(): void
    {
        $db        = $this->dbConn();
        $seller_id = isset($_GET['seller']) ? (int) $_GET['seller'] : 0;
        $error = $success = null;

        // drop-down list
        $sellers = $this->fetchAll(
            "SELECT seller_id, seller_name FROM sellers ORDER BY seller_name"
        );

        // CSRF check on every POST (core/Csrf.php rotates token on success)
        Csrf::verify();

        /* add */
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['brand_name'])) {
            $brand = trim($_POST['brand_name']);
            if ($seller_id && $brand !== '') {
                $db->prepare("INSERT INTO brands (seller_id, brand_name) VALUES (?, ?)")
                   ->execute([$seller_id, $brand]);
                $success = 'Brand added.';
            } else {
                $error = 'Pick a seller and enter a brand name.';
            }
        }

        /* delete */
        if (isset($_POST['delete_brand_id'])) {
            $this->deleteRow('brands', 'brand_id', (int) $_POST['delete_brand_id'], $success);
        }

        /* list */
        $brands = $seller_id
            ? $this->fetchAll(
                "SELECT * FROM brands WHERE seller_id = ? ORDER BY brand_id DESC",
                [$seller_id]
              )
            : [];

        // view expects $current for the selected seller
        $current = $seller_id;
        $this->view('stock/brands', compact(
            'sellers', 'current', 'brands', 'success', 'error'
        ));
    }

    /* =========================================================
     |  PRODUCT LINES
     * ======================================================= */
    public function productLines(): void
    {
        $db       = $this->dbConn();
        $error    = $success = null;

        try {
            if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['line_name'])) {
                $name = trim($_POST['line_name']);
                if ($name !== '') {
                    $db->prepare("INSERT INTO product_lines (line_name) VALUES (?)")->execute([$name]);
                    $success = 'Product line added.';
                }
            }

            if (isset($_GET['delete'])) {
                $this->deleteRow('product_lines', 'line_id', (int) $_GET['delete'], $success);
            }

            $lines = $this->fetchAll("SELECT * FROM product_lines ORDER BY line_id DESC");
        } catch (PDOException $e) {
            $error = $e->getMessage();
            $lines = [];
        }

        $this->view('stock/product-lines', compact('lines', 'success', 'error'));
    }

    /* =========================================================
     |  Placeholder screens (views only)
     * ======================================================= */
    public function products()      { $this->view('stock/products');      }
    public function variations()    { $this->view('stock/variations');    }
    public function mastersku()     { $this->view('stock/mastersku');     }
    public function skuGenerator()  { $this->view('stock/sku_generator'); }
    public function skuList()       { $this->view('stock/sku_list');      }
    public function skuView()       { $this->view('stock/sku_view');      }
    public function map()           { $this->view('stock/map');           }
    public function inventory()     { $this->view('stock/inventory');     }

    /* =========================================================
     |  Code-Masters (still stub logic)
     * ======================================================= */
    public function brandCodes(): void
    {
        $this->view('stock/code_brands');
    }

    public function classCodes(): void
    {
        $this->view('stock/code_classes');
    }

    public function categoryCodes(): void
    {
        $this->view('stock/code_categories');
    }
}
