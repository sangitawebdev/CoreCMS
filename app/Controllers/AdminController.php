<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Option;

class AdminController extends Controller
{
    public function settings()
    {
        if (session_status() === PHP_SESSION_NONE) session_start();

        // Handle POST request
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            // Upload Logo
            if (!empty($_FILES['site_logo']['name'])) {
                $uploadDir = __DIR__ . '/../../public/uploads/';
                if (!is_dir($uploadDir)) mkdir($uploadDir, 0777, true);

                $filename = time() . '_' . basename($_FILES['site_logo']['name']);
                $targetFile = $uploadDir . $filename;

                if (move_uploaded_file($_FILES['site_logo']['tmp_name'], $targetFile)) {
                    Option::set('site_logo', BASE_URL . '/public/uploads/' . $filename);
                }
            }

            // Save theme options
            Option::set('primary_color', $_POST['primary_color'] ?? '#000000');
            Option::set('secondary_color', $_POST['secondary_color'] ?? '#ffffff');
            Option::set('header_text', $_POST['header_text'] ?? '');

            $_SESSION['message'] = '✅ Settings updated successfully!';
            header("Location: " . BASE_URL . "/admin/settings");
            exit;
        }

        // Load current settings
        $data = [
            'logo' => Option::get('site_logo'),
            'primary_color' => Option::get('primary_color') ?: '#000000',
            'secondary_color' => Option::get('secondary_color') ?: '#ffffff',
            'header_text' => Option::get('header_text') ?: ''
        ];

        $this->view('admin/settings', $data);
    }
}
