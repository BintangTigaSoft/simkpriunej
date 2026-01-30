<?php

namespace App\Models;

use CodeIgniter\Model;

class MenuModulModel extends Model
{
    protected $table            = 'menu_modul';
    protected $primaryKey       = 'id';
    protected $useAutoIncrement = true;
    protected $returnType       = 'object';
    protected $useSoftDeletes   = false;
    protected $protectFields    = true;
    protected $allowedFields    = [
        'key', 'parent', 'kode_modul', 'kode_key', 'nama_modul', 
        'kode_grup', 'nama_grup', 'nama_url', 'level1', 'level2',
        'level3', 'level4', 'level5', 'level6', 'level7', 'level8',
        'level9', 'textlevel', 'icon', 'created_at', 'updated_at'
    ];

    protected bool $allowEmptyInserts = false;

    // Dates
    protected $useTimestamps = true;
    protected $dateFormat    = 'datetime';
    protected $createdField  = 'created_at';
    protected $updatedField  = 'updated_at';
    protected $deletedField  = 'deleted_at';

    public function getTree()
    {
        $elements = $this->orderBy('key', 'asc')->findAll();
        return $this->buildTree($elements);
    }

    private function buildTree(array $elements, $parentId = null)
    {
        $branch = [];

        foreach ($elements as $element) {
            if ($element->parent == $parentId) {
                $children = $this->buildTree($elements, $element->key);
                if ($children) {
                    $element->children = $children;
                }
                $branch[] = $element;
            }
        }

        return $branch;
    }
}
