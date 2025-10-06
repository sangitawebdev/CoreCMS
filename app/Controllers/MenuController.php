<?php
namespace App\Controllers;

use App\Core\Controller;
use App\Models\Menu;
use App\Models\MenuItem;

class MenuController extends Controller
{
	public function index()
	{
		$menus = Menu::getAll();
		$this->view('admin/menus/index', ['menus' => $menus]);
	}

    // public function edit($menu_id)
    // {
    //     $menu = Menu::getById($menu_id);
    //     $items = MenuItem::getByMenu($menu_id);
    //     $tree = $this->buildTree($items);

    //     $this->view('admin/menus/edit', [
    //         'menu' => $menu,
    //         'items' => $tree
    //     ]);
    // }
	public function edit($menu_id)
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			$data = [
				'name' => $_POST['name'],
				'slug' => $_POST['slug'],
				'type' => $_POST['type'] ?? null
			];
			Menu::update(
				$menu_id,
				$_POST['name'],
				$_POST['slug'],
				$_POST['type'] ?? ''
			);        
			header('Location: ' . BASE_URL . '/admin/menu');
			// header('Location: ' . BASE_URL . '/admin/menu/edit/' . $menu_id);
			exit;
		}

		$menu = Menu::getById($menu_id);
		$items = MenuItem::getByMenu($menu_id);
		$tree = $this->buildTree($items);

		$this->view('admin/menus/edit', [
			'menu' => $menu,
			'items' => $tree
		]);
	}
	private function buildTree($items, $parent_id = null)
	{
		$branch = [];
		foreach ($items as $item) {
			if ($item['parent_id'] == $parent_id) {
				$children = $this->buildTree($items, $item['id']);
				if ($children) $item['children'] = $children;
				$branch[] = $item;
			}
		}
		return $branch;
	}
	public function store() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			Menu::create($_POST['name'], $_POST['slug'],$_POST['type']);
			header('Location: ' . BASE_URL . '/admin/menu');
			exit;
		}
	}

	public function add() {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			Menu::create($_POST['name'], $_POST['slug'] ,$_POST['type']);
			header('Location: ' . BASE_URL . '/admin/menu');
			exit;
		}

		$this->view('admin/menus/add');
	}

	public function view($view, $data = []) {
		extract($data);
		require __DIR__ . '/../Views/' . $view . '.php';
	}

    // public function update($id)
    // {
    //     if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    //         MenuItem::update($id, $_POST);
    //         header('Location: ' . BASE_URL . '/admin/menu/edit/' . $_POST['menu_id']);
    //         exit;
    //     }
    // }
	public function update($menu_id)
	{
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			Menu::update(
				$menu_id,
				$_POST['name'],
				$_POST['slug'],
				$_POST['type'] ?? null
			);

	        // header('Location: ' . BASE_URL . '/admin/menu/edit/' . $menu_id);
			header('Location: ' . BASE_URL . '/admin/menu');
			exit;
		}
	}
	public function delete($id)
	{
		Menu::delete($id);
		MenuItem::delete($id);
		header('Location: ' . BASE_URL . '/admin/menu/');
		exit;
	}
	public function menuItemAdd($menuId) {
		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			MenuItem::create([
				'menu_id' => $menuId,
				'title' => $_POST['title'],
				'url' => $_POST['url'],
				'parent_id' => $_POST['parent_id'] ?: null,
				'position' => $_POST['position'] ?: 0,
			]);
			header('Location: ' . BASE_URL . '/admin/menu/edit/' . $menuId);
			exit;
		}

		$menu = Menu::getById($menuId);

		$items = MenuItem::getByMenu($menuId);
		require __DIR__ . '/../Views/admin/menus/menu-item-add.php';
	}
	public function menuItems($menuId) {
		$menu = Menu::getById($menuId);
		$items = MenuItem::getByMenu($menuId);
		$tree = $this->buildTree($items);
		$this->view('admin/menus/items', [
			'menu' => $menu,
			'items' => $tree
		]);
	}
	public function menuItemEdit($menuId, $itemId) {
		$item = MenuItem::getById($itemId);
		$menu = Menu::getById($menuId);
		$items = MenuItem::getByMenu($menuId); 

		if ($_SERVER['REQUEST_METHOD'] === 'POST') {
			MenuItem::update($itemId, [
				'title' => $_POST['title'],
				'url' => $_POST['url'],
				'parent_id' => $_POST['parent_id'] ?: null,
				'position' => $_POST['position'] ?: 0,
			]);
			header('Location: ' . BASE_URL . '/admin/menu/edit/' . $menuId);
			exit;
		}

		$this->view('admin/menus/menu-item-edit', [
			'item' => $item,
			'menu' => $menu,
			'items' => $items
		]);
	}
	public function menuItemDelete($menuId, $itemId) {
		MenuItem::delete($itemId);
		header('Location: ' . BASE_URL . '/admin/menu/edit/' . $menuId);
		exit;
	}

}
