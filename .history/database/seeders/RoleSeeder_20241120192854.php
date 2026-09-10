use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    public function run()
    {
        // Tạo roles
        Role::create(['name' => 'spadmin']);
        Role::create(['name' => 'admin']);
        Role::create(['name' => 'user']);

        // Chuyển đổi users hiện tại
        \App\Models\User::where('role', 'spadmin')->get()->each(function ($user) {
            $user->assignRole('spadmin');
        });
        \App\Models\User::where('role', 'admin')->get()->each(function ($user) {
            $user->assignRole('admin');
        });
        \App\Models\User::where('role', 'user')->get()->each(function ($user) {
            $user->assignRole('user');
        });
    }
} 