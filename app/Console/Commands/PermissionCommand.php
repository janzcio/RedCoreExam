<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Artisan;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use App\Models\User;

class PermissionCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $name = 'permissions:update';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Update admin permissions';

    /**
     * List of modules
     *
     * @var array
     */
    protected $modules = [
        'users',
        'roles',
    ];

    /**
     * List of actions
     *
     * @var array
     */
    protected $actions = [
        'list',
        'create',
        'edit',
        'delete',
        'view',
    ];

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $this->prepare();
        $this->core();
        $this->assign();
        $this->info('Permissions updated.');
    }

    /**
     * Prepare tables
     *
     * @return void
     */
    private function prepare()
    {
        Artisan::call('cache:clear');
        Artisan::call('config:cache');
        Artisan::call('cache:forget spatie.permission.cache');
        Schema::disableForeignKeyConstraints();
        DB::table('role_has_permissions')->truncate();
        DB::table('model_has_permissions')->truncate();
        DB::table('permissions')->truncate();
        Schema::disableForeignKeyConstraints();
    }

    /**
     * Processes module permission
     *
     * @return void
     */
    private function core()
    {
        $modules = $this->modules;
        $actions = $this->actions;
        foreach ($modules as $key => $module) {
            $name = str_replace(' ', '-', $module);
            $slug = str_replace(' ', '.', $module);
            $base = [
                'name' => $name,
                'guard_name' => 'users',
            ];
            // get base id after insert
            $id = DB::table('permissions')
                ->insertGetId($base, 'id');
            // structure permissions
            $permissions = [];
            foreach ($actions as $key => $action) {
                $permissions[] = [
                    'name' => $name . '-' . str_replace(' ', '.', $action),
                    'guard_name' => $base['guard_name'],
                ];
            }
            $this->create($permissions);
        }
    }

    /**
     * Create permissions
     *
     * @param array $permissions
     * @return void
     */
    private function create($permissions)
    {
        foreach ($permissions as $permission) {
            Permission::create([
                'name' => $permission['name'],
                'guard_name' => $permission['guard_name'],
            ]);
        }
    }

    /**
     * Assigns permission to user
     *
     * @return void
     */
    private function assign()
    {
        $role = Role::where('name', 'Admin')->first();

        $permissions = Permission::pluck('id', 'id')->all();

        $role->syncPermissions($permissions);

        $user = User::where('email', 'jmi050994@gmail.com')->first();
        
        $user->assignRole($role->id);
    }
}
