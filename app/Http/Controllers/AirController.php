<?php

namespace App\Http\Controllers;

use App\Models\Air;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Log;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;
use App\Notifications\AirQualityNotification;
use Illuminate\Support\Facades\Mail;
use App\Mail\AirQualityMail;


class AirController extends Controller
{
    public function showLogin()
    {
        return view('welcome');
    }

    public function login(Request $request)
    {
        $credentials = $request->validate([
            'email' => 'required|string|email',
            'password' => 'required|string'
        ]);

        // Coba login
        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Hindari session fixation
            return redirect()->route('home');
        }

        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.'
        ]);
    }

    public function logout(Request $request)
    {
        Auth::logout();
        $request->session()->invalidate();
        //the line above is to clear session data. If this isn't here that would make
        //whatever change an account makes accessible for other users.
        //in short without it, it saves the data to the server not to a specific user
        $request->session()->regenerateToken(); //regenerates new csrf token for the next session

        return redirect()->route('show.login');
    }

    public function showRegister()
    {
        return view('register');
    }

    public function register(Request $request)
    {
        $validated = $request->validate(
            [
                'name' => 'required|string|max:100',
                'email' => 'required|string|email|unique:users,email',
                'password' => 'required|string|min:6',
            ],
            [
                'name.required' => 'Nama wajib diisi',
                'name.max' => 'Nama kepanjangan',
                'email.required' => 'Email wajib diisi',
                'email.email' => 'Email tidak sesuai format',
                'email.unique' => 'Email sudah digunakan',
                'password.required' => 'Password wajib ada',
                'password.min' => 'Password minimal 6 karakter',
            ]
        );

        // Simpan user baru dengan password yang sudah di-hash
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Login langsung setelah register (opsional)
        Auth::login($user);

        return redirect()->route('home');
    }

    public function home()
{
    // Ambil data kualitas udara terbaru
    $air = Air::latest()->first();

    // Menentukan kelas CSS berdasarkan kualitas udara
    $colorClass = match ($air->air_quality) {
        'Good' => 'bg-green-500',
        'Moderate' => 'bg-yellow-400',
        'Poor' => 'bg-orange-500',
        'Hazardous' => 'bg-red-500',
        default => 'bg-gray-500',
    };
    $purifier = match ($air->air_quality) {
        'Good' => 'Tidak Aktif',
        'Moderate' => 'Aktif - Mode Low',
        'Poor' => 'Aktif - Mode Max',
        'Hazardous' => 'Aktif - Mode Max',
        default => 'Tidak Aktif',
    };
    $statusPurifier = match ($air->air_quality) {
        'Good' => 'Kualitas Udara Baik',
        'Moderate' => 'Membersihkan Udara (Kecepatan rendah)',
        'Poor' => 'Membersihkan Udara (Kecepatan maksimal)',
        'Hazardous' => 'Membersihkan Udara (Kecepatan maksimal)',
        default => 'Kualitas Udara Baik',
    };
    $tip1 = match ($air->air_quality) {
        'Good' => 'Kualitas udara saat ini sangat baik. Debu pabrik semen minimal. Ini waktu yang tepat untuk berkegiatan di luar ruangan.',
        'Moderate' => 'Terdeteksi peningkatan partikel PM2.5. Air purifier diaktifkan untuk meminimalkan dampak debu semen pada lingkungan dalam ruangan.',
        'Poor' => 'Kadar NO² dan PM2.5 tinggi. Kemungkinan aktivitas pabrik semen sedang tinggi. Air purifier bekerja maksimal untuk menjaga kualitas udara dalam ruangan.',
        'Hazardous' => 'BAHAYA! Tingkat polutan sangat tinggi. Kadar PM2.5, NO², dan CO melebihi ambang batas aman. Segera pindah lokasi yang lebih aman.',
        default => 'Kualitas udara saat ini sangat baik. Debu pabrik semen minimal. Ini waktu yang tepat untuk berkegiatan di luar ruangan.',
    };
    $tip2 = match ($air->air_quality) {
        'Good' => 'Periksa filter air purifier secara berkala untuk memastikan kinerja optimal saat dibutuhkan.',
        'Moderate' => 'Tutup jendela dan pintu untuk mencegah masuknya polutan dari pabrik semen. Pastikan filter air purifier dalam kondisi baik.',
        'Poor' => 'Tutup jendela dan pintu untuk mencegah masuknya polutan dari pabrik semen. Pastikan filter air purifier dalam kondisi baik.',
        'Hazardous' => '',
        default => 'Periksa filter air purifier secara berkala untuk memastikan kinerja optimal saat dibutuhkan.',
    };
    $border = match ($air->air_quality) {
        'Good' => 'border-green-500',
        'Moderate' => 'border-yellow-500',
        'Poor' => 'border-orange-500',
        'Hazardous' => 'border-red-500',
        default => 'border-gray-500',
    };
    $kondisi = match ($air->air_quality) {
        'Good' => 'bg-green-200',
        'Moderate' => 'bg-yellow-200',
        'Poor' => 'bg-orange-200',
        'Hazardous' => 'bg-red-200',
        default => 'bg-gray-200',
    };

    // Cek apakah kualitas udara "Hazardous" atau "Poor" dan kirimkan email
    if (in_array($air->air_quality, ['Hazardous', 'Poor'])) {
        $user = Auth::user(); // Ambil pengguna yang sedang login
        if ($user) {
            Mail::to($user->email)->send(new AirQualityMail($air)); // Kirim email ke pengguna yang login
            Log::info('Email dikirim ke pengguna karena kualitas udara buruk: ' . $user->email);
        }
    }

    // Kirim data kualitas udara dan info lainnya ke view home
    return view('home', [
        'air' => $air,
        'colorClass' => $colorClass,
        'purifier' => $purifier,
        'statusPurifier' => $statusPurifier,
        'tip1' => $tip1,
        'tip2' => $tip2,
        'border' => $border,
        'kondisi' => $kondisi,
    ]);
}

    public function history()
    {
        $startDate = Carbon::now()->subDays(2)->startOfDay();
        $endDate = Carbon::now()->endOfDay();

        $data = Air::whereBetween('created_at', [$startDate, $endDate])
            ->orderBy('created_at', 'desc')->get();

        $filtered = collect();
        $previousStatus = null;

        foreach ($data as $record) {
            if ($record->air_quality !== $previousStatus) {
                $filtered->push($record);
                $previousStatus = $record->air_quality;
            }
        }
        return view('history', ['history' => $filtered]);
    }

    public function setting()
    {
        $user = Auth::user();
        return view('settings', ['user' => $user]);
    }

    public function sensor(Request $request)
{
    // Validasi data sensor
    $request->validate([
        'pm25' => 'required|numeric',
        'co' => 'required|numeric',
        'no2' => 'required|numeric',
        'temp' => 'required|numeric',
        'humidity' => 'required|numeric',
        'air_quality' => 'required|string',
    ]);

    // Simpan data sensor
    $air = Air::create([
        'pm25' => $request->pm25,
        'co' => $request->co,
        'no2' => $request->no2,
        'temp' => $request->temp,
        'humidity' => $request->humidity,
        'air_quality' => $request->air_quality,
    ]);

    // Log untuk memastikan nilai kualitas udara
    Log::info('Kualitas udara yang disimpan: ' . $air->air_quality);

    // Cek jika kualitas udara adalah "Poor" atau "Hazardous"
    if (in_array($air->air_quality, ['Poor', 'Hazardous'])) {
        // Kirimkan email ke semua pengguna yang terdaftar
        $users = User::all();
        foreach ($users as $user) {
            Mail::to($user->email)->send(new AirQualityMail($air));  // Kirim email
        }

        Log::info('Notifikasi dikirim ke semua pengguna karena kualitas udara buruk.');
    }

    return response()->json(['message' => 'Data saved']);
}

public function addAirQuality(Request $request)
{
    // Validasi input
    $request->validate([
        'pm25' => 'required|numeric',
        'co' => 'required|numeric',
        'no2' => 'required|numeric',
        'temp' => 'required|numeric',
        'humidity' => 'required|numeric',
        'air_quality' => 'required|string',
    ]);

    // Simpan data ke dalam database
    $air = Air::create([
        'pm25' => $request->pm25,
        'co' => $request->co,
        'no2' => $request->no2,
        'temp' => $request->temp,
        'humidity' => $request->humidity,
        'air_quality' => $request->air_quality,
    ]);

    // Kirim email jika kualitas udara "Hazardous" atau "Poor"
    if (in_array($air->air_quality, ['Hazardous', 'Poor'])) {
        $users = User::all(); // Ambil semua pengguna yang terdaftar
        foreach ($users as $user) {
            Mail::to($user->email)->send(new AirQualityMail($air)); // Kirim email
        }
    }

    return response()->json(['message' => 'Air quality data added successfully']);
}


public function updateAirQuality($id, Request $request)
{
    // Validasi input
    $request->validate([
        'pm25' => 'required|numeric',
        'co' => 'required|numeric',
        'no2' => 'required|numeric',
        'temp' => 'required|numeric',
        'humidity' => 'required|numeric',
        'air_quality' => 'required|string',
    ]);

    // Temukan data yang akan diperbarui
    $air = Air::findOrFail($id); // Cari berdasarkan ID

    // Update data
    $air->update([
        'pm25' => $request->pm25,
        'co' => $request->co,
        'no2' => $request->no2,
        'temp' => $request->temp,
        'humidity' => $request->humidity,
        'air_quality' => $request->air_quality,
    ]);

    // Kirim email jika kualitas udara "Hazardous" atau "Poor"
    if (in_array($air->air_quality, ['Hazardous', 'Poor'])) {
        $users = User::all(); // Ambil semua pengguna yang terdaftar
        foreach ($users as $user) {
            Mail::to($user->email)->send(new AirQualityMail($air)); // Kirim email
        }
    }

    return response()->json(['message' => 'Air quality data updated successfully']);
}

}