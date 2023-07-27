<?php



namespace App\Http\Controllers\Admin;

use App\Events\MahasiswaRegistered; // Mengimpor kelas MahasiswaRegistered dari namespace App\Events
use App\Http\Controllers\Controller; // Mengimpor kelas Controller dari namespace App\Http\Controllers
use App\Imports\UserImport; // Mengimpor kelas UserImport dari namespace App\Imports
use App\Models\User; // Mengimpor kelas User dari namespace App\Models
use App\Models\Mahasiswa; // Mengimpor kelas Mahasiswa dari namespace App\Models
use App\Models\Organisasi; // Mengimpor kelas Organisasi dari namespace App\Models
use Illuminate\Http\Request; // Mengimpor kelas Request dari namespace Illuminate\Http
use Illuminate\Support\Facades\Validator; // Mengimpor kelas Validator dari namespace Illuminate\Support\Facades
use Maatwebsite\Excel\Facades\Excel; // Mengimpor kelas Excel dari namespace Maatwebsite\Excel\Facades
use Illuminate\Support\Facades\Hash; // Mengimpor kelas Hash dari namespace Illuminate\Support\Facades


class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $users = User::role('user')->paginate(10);
        return view('admin.user.index', compact('users'));
    }
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.user.tambahuser');
    }
    public function tambah(Request $request)
    {

        // User::create($request->all());
        // return redirect()->route('admin.user.index')->with('success', 'Data Berhasil di Tambahkan');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
            'name' => 'required|string', // Memvalidasi bahwa atribut 'name' diperlukan dan harus berupa string
            'nim' => 'required', // Memvalidasi bahwa atribut 'nim' diperlukan
            'email' => 'required|unique:users,email', // Memvalidasi bahwa atribut 'email' diperlukan dan harus unik dalam tabel 'users' pada kolom 'email'
            'password' => 'required', // Memvalidasi bahwa atribut 'password' diperlukan
            'foto' => 'image|mimes:jpeg,png,jpg|max:2048'  // Aturan validasi untuk foto (opsional)

        ]);

        $user = new User(); // Membuat instance objek User baru
        $user->name = $request->name; // Mengisi atribut 'name' dengan nilai dari permintaan
        $user->nim = $request->nim; // Mengisi atribut 'nim' dengan nilai dari permintaan
        $user->email = $request->email; // Mengisi atribut 'email' dengan nilai dari permintaan
        $user->password = bcrypt($request->password); // Mengisi atribut 'password' dengan nilai dari permintaan yang di-hash menggunakan bcrypt
        if ($request->hasFile('foto')) {
            $file = $request->file('foto');
            $fileName = time() . '.' . $file->getClientOriginalExtension();
            $file->move(public_path('foto'), $fileName);
            $user->foto = $fileName;
        }
        $user->save(); // Menyimpan objek User ke dalam database


        $nim = $request->nim; // Mengambil nilai 'nim' dari permintaan
        $mahasiswa = Mahasiswa::where('nim', $nim)->first(); // Mencari entitas Mahasiswa berdasarkan 'nim'

        if ($mahasiswa) {
            $mahasiswa->user_id = $user->id; // Mengisi atribut 'user_id' pada entitas Mahasiswa dengan ID pengguna yang baru ditambahkan
            $mahasiswa->save(); // Menyimpan entitas Mahasiswa yang diperbarui ke dalam database
        }

        if ($request->role == 'organisasi') { // Jika peran yang dipilih adalah 'organisasi'
            $user->assignRole('organisasi'); // Memberikan peran 'organisasi' kepada pengguna

            $nimOrganisasi = $request->nim; // Mengambil nilai 'nim' dari permintaan
            $organisasi = Organisasi::where('nim', $nimOrganisasi)->first(); // Mencari entitas Organisasi berdasarkan 'nim'

            if ($organisasi) {
                $organisasi->user_id = $user->id; // Mengisi atribut 'user_id' pada entitas Organisasi dengan ID pengguna yang baru ditambahkan
                $organisasi->save(); // Menyimpan entitas Organisasi yang diperbarui ke dalam database
            }
        } else {
            $user->assignRole('user'); // Memberikan peran 'user' kepada pengguna
        }

        if ($request->role == 'organisasi') {
            return redirect()->route('admin.tambahorganisasi')->with('success', 'Pengguna organisasi berhasil ditambahkan'); // Mengalihkan ke rute admin.tambahorganisasi dengan pesan sukses
        } else {
            return redirect()->route('admin.user.index')->with('success', 'Pengguna berhasil ditambahkan'); // Mengalihkan ke rute admin.user.index dengan pesan sukses
        }
    }
    public function deleteuser($id)
    {
        $data = User::find($id);
        $data->delete();
        return redirect()->back()->with('success', 'Data pengguna berhasil HAPUS');
    }
    public function importUser(Request $request)
    {
        $users = Excel::toCollection(new UserImport, $request->file('file'));

        foreach ($users[0] as $row) {
            $user = new User();
            $user->name = $row['0'];
            $user->nim = $row['1'];
            $user->email = $row['2'];
            $user->password = bcrypt($row['3']); // Meng-hash password
            $user->save();

            $nim = $row['1']; // Menggunakan $row['1'] sebagai NIM, bukan $request->nim
            $mahasiswa = Mahasiswa::where('nim', $nim)->first();

            if ($mahasiswa) {
                $mahasiswa->user_id = $user->id; // Assign ID pengguna ke entitas Mahasiswa
                $mahasiswa->save();
            }

            // Mengatur peran pengguna
            $user->assignRole('user');
        }

        return redirect()->route('admin.user.index')->with('success', 'Data pengguna berhasil diimpor');
    }




    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
