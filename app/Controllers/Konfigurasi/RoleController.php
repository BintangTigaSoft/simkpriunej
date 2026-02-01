<?php

namespace App\Controllers\Konfigurasi;

use App\Controllers\BaseController;
use Myth\Auth\Authorization\GroupModel;
use Hermawan\DataTables\DataTable;
use App\Helpers\ResponseFormatter;

class RoleController extends BaseController
{
    protected $groupModel;

    public function __construct()
    {
        $this->groupModel = new GroupModel();
    }

    public function index()
    {
        if ($this->request->isAJAX()) {
            return DataTable::of($this->groupModel->builder()->select('id, name, description'))
                ->add('action', function($row){
                    return '<div class="hstack gap-2 justify-content-end">
                                <a href="javascript:void(0);" class="avatar-text avatar-md bg-soft-info btn-view" data-id="'.$row->id.'"><i class="feather-eye"></i></a>
                                <a href="javascript:void(0);" class="avatar-text avatar-md bg-soft-primary btn-edit" data-id="'.$row->id.'"><i class="feather-edit"></i></a>
                                <a href="javascript:void(0);" class="avatar-text avatar-md bg-soft-danger btn-delete" data-id="'.$row->id.'"><i class="feather-trash"></i></a>
                            </div>';
                })->toJson(true);
        }

        return view('pages/konfigurasi/role/index', ['title' => 'Manajemen Role']);
    }

    public function show($id)
    {
        $data = $this->groupModel->find($id);
        
        if ($data) {
            return ResponseFormatter::success($data);
        } else {
            return ResponseFormatter::error(null, 'Data not found', 404);
        }
    }

    public function create()
    {
        $roleName = $this->request->getPost('role_name');
        
        // Manual Validation
        if (empty($roleName)) {
            return ResponseFormatter::error(['role_name' => 'Role name is required'], 'Validation Failed');
        }
        
        if (strlen($roleName) < 3) {
            return ResponseFormatter::error(['role_name' => 'Role name must be at least 3 characters'], 'Validation Failed');
        }
        
        // Manual Unique Check
        if ($this->groupModel->where('name', $roleName)->first()) {
            return ResponseFormatter::error(['role_name' => 'Role name already exists'], 'Validation Failed');
        }

        $this->groupModel->skipValidation(true)->insert([
            'name' => $roleName,
            'description' => $this->request->getPost('description')
        ]);

        return ResponseFormatter::success(null, 'Role created successfully', 201);
    }

    public function update($id)
    {
        $roleName = $this->request->getPost('role_name');

        // Manual Validation
        if (empty($roleName)) {
            return ResponseFormatter::error(['role_name' => 'Role name is required'], 'Validation Failed');
        }
        
        if (strlen($roleName) < 3) {
            return ResponseFormatter::error(['role_name' => 'Role name must be at least 3 characters'], 'Validation Failed');
        }
        
        // Manual Unique Check (Exclude current ID)
        $existing = $this->groupModel->where('name', $roleName)->first();
        if ($existing && $existing->id != $id) {
            return ResponseFormatter::error(['role_name' => 'Role name already exists'], 'Validation Failed');
        }

        $this->groupModel->skipValidation(true)->update($id, [
            'name' => $roleName,
            'description' => $this->request->getPost('description')
        ]);

        return ResponseFormatter::success(null, 'Role updated successfully');
    }

    public function delete($id)
    {
        if ($this->groupModel->delete($id)) {
            return ResponseFormatter::success(null, 'Role deleted successfully');
        }
        return ResponseFormatter::error(null, 'Failed to delete role', 500);
    }
}
