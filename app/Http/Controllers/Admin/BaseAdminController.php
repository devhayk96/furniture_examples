<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller as Controller;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Http\JsonResponse;

use Illuminate\Contracts\View\View as ContractsView;
use Illuminate\Contracts\View\Factory as ViewFactory;
use phpDocumentor\Reflection\PseudoTypes\HtmlEscapedString;
use Spatie\Permission\Models\Permission;


abstract class BaseAdminController extends Controller
{
    protected $per_page = 10;

    protected $permissionKeyName;

    public function __construct()
    {
        $this->permissionKeyName = $permissionKeyName = $this->resourceName();
        $this->middleware(["permission:{$permissionKeyName} view,admin"])->only('index');
        $this->middleware(["permission:{$permissionKeyName} viewPersonal,admin"])->only('show');
        $this->middleware(["permission:{$permissionKeyName} create,admin"])->only(['create', 'store']);
        $this->middleware(["permission:{$permissionKeyName} update,admin"])->only(['edit', 'update']);
        $this->middleware(["permission:{$permissionKeyName} delete,admin"])->only(['delete', 'destroy']);
    }

    abstract protected function tableColumnsCount(): int;

    abstract protected function resourceName(): string;

    abstract protected function getModel();
    abstract protected function getFields(): array ;

    /**
     * Display a listing of the resource.
     *
     * @return ViewFactory|ContractsView|JsonResponse
     * @throws \Exception
     */
    public function index()
    {
        $model = $this->getModel();
        $filters = generate_filters($this->filters());

        if (request()->ajax()){
            try {
                $model = $model->filter(request())->paginate($this->per_page);
                $data['success'] = true;
                $data['table'] = generate_table($model, $this->getfields(), $this->resourceName(), $this->tableColumnsCount());
                return response()->json($data);
            } catch (\Exception $exception) {
                return response()->json(['success' => false, 'message' => __('admin.something_wrong')]);
            }
        }
        $create_button = $this->createButton();
        $model = $model->paginate($this->per_page);
        $table = generate_table($model, $this->getfields(), $this->resourceName(), $this->tableColumnsCount());
        return view("admin.{$this->resourceName()}.index", compact('model', 'filters', 'table', 'create_button'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return ViewFactory|ContractsView
     */
    public function create()
    {
        return view("admin.{$this->resourceName()}.create");
    }

    /**
     * Checking if an auth admin has permission to create a resource
     *
     * @return string|HtmlEscapedString
     */
    protected function createButton()
    {
        $permission_exists = Permission::where(['name' => "{$this->permissionKeyName} create"])->exists();
        return $permission_exists && current_admin()->can("{$this->permissionKeyName} create")
            ? '<a href="'. route("{$this->resourceName()}.create") .'" class="btn btn-outline-success text-capitalize">+ '. __('admin.add') .'</a>'
            : '';
    }


    /**
     * Checking if the current model has filters method
     *
     * @return |null
     */
    protected function filters()
    {
        return method_exists($this->getModel(), 'filters') ? $this->getModel()->filters() : [];
    }
}
