<?php

namespace App\Http\Controllers;

use App\Models\Air;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;
use Carbon\Carbon;

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

        if (Auth::attempt($credentials)) {
            $request->session()->regenerate(); // Hindari session fixation
            return redirect()->route('home');
        }

        throw ValidationException::withMessages([
            'email' => 'Email atau password salah.'
        ]);
    }

    public function logout(Request $request){
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
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|unique:users,email',
            'password' => 'required|string|min:6',
        ]);

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
        $air = Air::latest()->first();
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
            'Good' => 'Kualias udara saat ini sangat baik. Debu pabrik semen minimal. ini waktu yang tepat untuk berkegiatan di luar ruangan.',
            'Moderate' => 'Terdeteksi peningkatan partikel PM2.5. Air purifier diaktifkan untuk meminimalkan dampak debu semen pada lingkungan dalam ruangan.',
            'Poor' => 'Kadar NO² dan PM2.5 tinggi. Kemungkinan aktivitas pabrik semen sedang tinggi. air purifier bekerja maksimal untuk menjaga kualitas udara dalam ruangan.',
            'Hazardous' => 'BAHAYA! Tingkat polutan sangat tinggi. Kadar PM2.5, NO² dan CO melebihi ambang batas aman. Segera pindah lokasi yang lebih aman.',
            default => 'Kualias udara saat ini sangat baik. Debu pabrik semen minimal. ini waktu yang tepat untuk berkegiatan di luar ruangan.',
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
            ->orderBy('created_at', 'desc')
            ->get();

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
        $request->validate([
            'pm25' => 'required|float',
            'co' => 'required|float',
            'no2' => 'required|float',
            'temp' => 'required|float',
            'humidity' => 'required|float',
            'air_quality' => 'required|string',
        ]);

        Air::create([
            'pm25' => $request->pm25,
            'co' => $request->co,
            'no2' => $request->no2,
            'temp' => $request->temp,
            'humidity' => $request->humidity,
        ]);

        return response()->json([]);
    }
}
