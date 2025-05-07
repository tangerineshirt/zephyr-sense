<?php

namespace App\Http\Controllers;

use App\Models\Air;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Support\Facades\Auth;

class AirController extends Controller
{
    public function showLogin(){
        return view('welcome');
    }

    public function login(Request $request){
        $validated = $request->validate([
            'email' => 'required|string',
            'password' => 'required|string'
        ]);

        if(Auth::attempt($validated)){
            $request->session()->regenerate();
            return redirect()->route('home');
        }

        throw ValidationException::withMessages([
            'credentials' => 'Sorry, incorrect credentials'
        ]);
    }

    public function home(){
        $air = Air::latest()->first();
        $colorClass = match($air->air_quality) {
            'Good' => 'bg-green-500',
            'Moderate' => 'bg-yellow-400',
            'Poor' => 'bg-orange-500',
            'Hazardous' => 'bg-red-500',
            default => 'bg-gray-500',
        };
        $purifier = match($air->air_quality) {
            'Good' => 'Tidak Aktif',
            'Moderate' => 'Aktif - Mode Low',
            'Poor' => 'Aktif - Mode Max',
            'Hazardous' => 'Aktif - Mode Max',
            default => 'Tidak Aktif',
        };
        $statusPurifier = match($air->air_quality){
            'Good' => 'Kualitas Udara Baik',
            'Moderate' => 'Membersihkan Udara (Kecepatan rendah)',
            'Poor' => 'Membersihkan Udara (Kecepatan maksimal)',
            'Hazardous' => 'Membersihkan Udara (Kecepatan maksimal)',
            default => 'Kualitas Udara Baik',
        };
        $tip1 = match($air->air_quality){
            'Good' => 'Kualias udara saa ini sangat baik. Debu pabrik semen minimal. ini waktu yang tepat untuk berkegiatan diluar ruangan',
            'Moderate' => 'Terdeteksi peningkatan partikel PM2.5. Air purifier diaktiflkan untuk meminimalkan dampak debu semen pada lingkungan dalam ruangan',
            'Poor' => 'Kadar NO² dan PM2.5 tinggi. Kemungkinan aktivitas pabrik semen sedang tinggi. air purifier bekerja maksimal untuk menjaga kualitas udara dalam ruangan',
            'Hazardous' => 'BAHAYA! Tingkat polutan sangat tinggi. Kadar PM2.5, NO² dan CO melebihi ambang batas amann. Segera pindah lokasi yang lebih aman',
            default => 'Kualias udara saa ini sangat baik. Debu pabrik semen minimal. ini waktu yang tepat untuk berkegiatan diluar ruangan',
        };
        return view('home', [
            'air' => $air, 
            'colorClass' => $colorClass,
            'purifier' => $purifier,
            'statusPurifier' => $statusPurifier,
            'tip1' => $tip1,
        ]);
    }
    public function history(){

    }

}
